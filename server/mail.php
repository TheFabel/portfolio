<?php
session_start();
$lang = "ru";
if(isset($_COOKIE['lang']))
	$lang = $_COOKIE['lang'];
$l = require("../languages/{$lang}.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


if(!isset($_POST['subject']) || !isset($_POST['message']) || !isset($_POST['key']) || strlen($_POST['subject']) < 4 || strlen($_POST['message']) < 20)
  die("Недостаточно данных");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';
$ip = $_SERVER['REMOTE_ADDR'];
if($ip === "::1")
  die("Неверный запрос");

$time = 3600;

if(isset($_COOKIE['sent']))
{
  die($l['already_sent']);
}
else
{
  if(!isset($_POST['key']) || !isset($_SESSION['key']) || $_POST['key'] != $_SESSION['key'])
  {
    echo $l['key_error'];
  }
  else
  {

    $date = date("Y/m/d/H:i:s");

    $query = $conn->prepare("SELECT * FROM users WHERE ip = :ip");
    $query->bindParam(":ip", $ip);
    $query->execute();
    $result = $query->fetchAll();

    $num = count($result);
    if($num > 0)
    {
      foreach($result as $r)
      {
        $timestamp = strtotime($r['time']);
        if((time() - $time) > $timestamp)
        {
          sendMessage($_POST['subject'], $_POST['message'], "UPDATE users SET time = :date WHERE ip = :ip");
        }
        else
        {
          die($l['already_sent']);
        }
      }
    }
    else
    {
      sendMessage($_POST['subject'], $_POST['message'], "INSERT INTO users (ip, time) VALUES (:ip, :date)");
    }
  }
}

function sendMessage($subject, $message, $query)
{
  try
  {
    global $ip, $time, $date,$l;
    $template = file_get_contents('mail-template.php');
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
    $d = "";
    foreach($details as $key => $value)
    {
      $d .= "<p>{$key} - {$value}</p>";
    }
    $template = str_replace("%sender_info%", $ip.$d, $template);
    $template = str_replace("%message%", $message, $template);
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "465";
    $mail->Username = "";
    $mail->Password = "";
    $mail->SetFrom("");
    $mail->Subject = "Сообщение с сайта anashkin.ml - ".$message;
    $mail->MsgHTML($template);
    $mail->IsHTML(true);
    $mail->AddAddress("");
    if(!$mail->Send())
    {
      echo "Mailer Error: " . $mail->ErrorInfo;
      die();
    }

    query($query, $ip, $date);
    setcookie("sent", "true", time() + $time, "/");
    unset($_SESSION['key']);
    echo $l['message_sent'];
  }
  catch(\Exception $e)
  {
    echo $e->errorMessage();
  }
}

function query($query, $ip, $date)
{
  global $conn;
  try
  {
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':ip', $ip);
    $stmt->bindParam(':date', $date);

    $stmt->execute();

  }
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}
?>
