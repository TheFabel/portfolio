<?php
session_start();
$lang = "ru";
$to_change = "en";
if(isset($_COOKIE['lang']))
	$lang = $_COOKIE['lang'];
if($lang == "ru")
	$to_change = "en";
else
	$to_change = "ru";
$l = require("languages/{$lang}.php");
function RandomString($length)
{
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
$key = crypt(RandomString(20), "sta");
$_SESSION['key'] = $key;
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<head>
	<meta charset="UTF-8">
	<title><?=$l['title']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Портфолио Анашкина Александра">
	<meta name="keywords" content="Анашкин Александр, портфолио Анашкина Александра">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/roboto.css">
	<link rel="stylesheet" href="fonts/FontAwesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="fonts/devicon/devicon.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/media.css">
</head>
<body><script type="text/javascript">
	t = performance.now();
</script>
	<section class="header">
		<!-- <div class="container clearfix"> -->
			<div class="header-menu">
				<div class="container clearfix">
					<div class="contact-me">
						<i class="fa fa-comments"></i>
						<span><?=$l['contact_me']?></span>
					</div>
					<div class="contact-links">
						<ul>
							<li class="contact-link"><a href="" target="_blank"><i class="fab fa-facebook" title="Facebook"></i></a></li>
							<li class="contact-link"><a href="" target="_blank"><i class="fab fa-vk" title="VK"></i></a></li>
							<li class="contact-link"><a href="https://github.com/TheFabel" target="_blank"><i class="fab fa-github" title="Github"></i></a></li>
							<li class="contact-link"><a href="mailto:anashkin522a@gmail.com"><i class="fas fa-envelope" title="Mail"></i></a></li>
							<li class="contact-link phone_number">+380501073060</li>
							<li class="has-dropdown">
								<img src="images/<?=$lang?>.png" alt="Country flag" style="width: 15px; cursor: pointer;">
								<div class="dropdown">
									<img class="lang-change" src="images/<?=$to_change?>.png" alt="Country flag" style="width: 15px; cursor: pointer;" data-to_change="<?=$to_change?>">
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="header-info">
				<div class="container clearfix">
					<h1 class="title"><?=$l['about_me_title']?></h1>
					<div class="line"></div>
					<div class="info-about">
						<h1 class="name">
							<?=$l['my_name']?>
						</h1>
						<div class="about">
							<p><?=$l['about_me']?></p>
							<a href="#" target="_blank" class="download_link"><?=$l['download_resume']?></a>
						</div>
					</div>
					<div class="info-image">
						<img src="images/350x350.png" alt="Profile image">
					</div>
				</div>
			</div>
		<!-- </div> -->
	</section>
	<section class="skills">
		<div class="container">
			<h1 class="title"><?=$l['skills_title']?></h1>
			<div class="line"></div>
			<div class="skills-list clearfix">
				<h2 class="small-title">Front-end</h2>
				<div class="skill-item">
					<i class="devicon-html5-plain"></i>
					<p>HTML 5</p>
				</div>
				<div class="skill-item">
					<i class="devicon-css3-plain"></i>
					<p>CSS 3</p>
				</div>
				<div class="skill-item">
					<i class="devicon-sass-plain"></i>
					<p>SASS</p>
				</div>
				<div class="skill-item">
					<i class="devicon-javascript-plain"></i>
					<p>JavaScript</p>
				</div>
				<div class="skill-item">
					<i class="devicon-jquery-plain"></i>
					<p>jQuery</p>
				</div>
			</div>
			<div class="skills-list clearfix">
				<h2 class="small-title">Back-end</h2>
				<div class="skill-item">
					<i class="devicon-php-plain"></i>
					<p>PHP</p>
				</div>
				<div class="skill-item">
					<i class="devicon-mysql-plain"></i>
					<p>MySQL</p>
				</div>
				<div class="skill-item">
					<i class="devicon-postgresql-plain"></i>
					<p>PostgreSQL</p>
				</div>
				<div class="skill-item">
					<img src="images/ms-access.png" class="custom-icon" alt="MS Access icon">
					<p>Microsoft Access</p>
				</div>
			</div>
			<div class="skills-list clearfix">
				<h2 class="small-title">Other</h2>
				<div class="skill-item">
					<i class="devicon-csharp-plain"></i>
					<p><?=$l['c#']?></p>
				</div>
				<div class="skill-item">
					<i class="devicon-java-plain"></i>
					<p><?=$l['java']?></p>
				</div>
				<div class="skill-item">
					<i class="devicon-wordpress-plain"></i>
					<p>WordPress</p>
				</div>
				<div class="skill-item">
					<i class="devicon-photoshop-plain"></i>
					<p>Adobe Photoshop</p>
				</div>
				<div class="skill-item">
					<img src="images/english.png" class="custom-icon" alt="MS Access icon">
					<p>English (intermediate)</p>
				</div>
			</div>
		</div>
	</section>

	<section class="works">
		<div class="container">
			<h1 class="title"><?=$l['works_title']?></h1>
			<div class="line"></div>
			<h2 class="small-title"><?=$l['works_small_title']?></h2>
			<div class="works-list clearfix">
				<div class="work appsreview">
					<div class="work-photo" data-screen="appsreview" data-url="http://appsreview.club">
						<img src="images/appsreview.png" alt="Site logo">
					</div>
					<div class="work-desc">
						<p>WordPress</p>
					</div>
				</div>
				<div class="work">
					<div class="work-photo" data-screen="topchat" data-url="https://topchat.reviews">
						<img src="images/topchat.png" alt="Site logo">
					</div>
					<div class="work-desc">
						<p>WordPress</p>
					</div>
				</div>
				<div class="work">
					<div class="work-photo" data-screen="chainedfuture" data-url="http://chainedfuture.com">
						<p>ChainedFuture</p>
					</div>
					<div class="work-desc">
						<p>WordPress</p>
					</div>
				</div>
				<div class="work">
					<div class="work-photo" data-screen="tropical" data-url="http://tropical.land">
						<p>TropicalLand</p>
					</div>
					<div class="work-desc">
						<p>WordPress</p>
					</div>
				</div>
				<div class="work">
					<div class="work-photo" data-screen="shop" data-url="http://thefabelshop.ml">
						<p>SHOP</p>
					</div>
					<div class="work-desc">
						<p>HTML, CSS, JavaScript, jQuery, PHP, MySQL</p>
					</div>
				</div>
				<div class="work">
					<div class="work-photo" data-screen="thefabel-1" data-url="http://thefabel.ml/01">
						<p><?=$l['work_1']?></p>
					</div>
					<div class="work-desc">
						<p>HTML, CSS, JavaScript, jQuery</p>
					</div>
				</div>
				<div class="work">
					<div class="work-photo" data-screen="thefabel-2" data-url="http://thefabel.ml/02">
						<p><?=$l['work_2']?></p>
					</div>
					<div class="work-desc">
						<p>HTML, CSS, JavaScript, jQuery</p>
					</div>
				</div>
				<div class="work">
					<div class="work-photo" data-screen="thefabel-3" data-url="http://thefabel.ml/03">
						<p><?=$l['work_3']?></p>
					</div>
					<div class="work-desc">
						<p>HTML, CSS, not responsive</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="work-modal-window">
		<div class="work-modal-window-inner">
			<div class="window-close">X</div>
			<h1 class="small-title"><?=$l['works_small_title_2']?></h1>
			<div class="window-image">
				<a href="#" target="_blank">
					<img src="images/loading.gif" alt="Site screenshot">
				</a>
			</div>
		</div>
	</div>
	<section class="about-me">
		<div class="container">
			<h1 class="title"><?=$l['about_me_section']?></h1>
			<div class="line"></div>
			<ul>
				<?php foreach($l['about_me_list'] as $li): ?>
					<li class="clearfix">
						<div class="about-me-image">
							<img src="<?=$li['image']?>" alt="About me image">
						</div>
						<div class="about-me-desc">
							<div class="info-time"><?=$li['time']?></div>
							<div class="info-title"><?=$li['title']?></div>
							<div class="info-desc">
								<?php foreach($li['desc'] as $p): ?>
									<p><?=$p?></p>
								<?php endforeach; ?>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<section class="contact-me">
		<div class="container">
			<h1 class="title"><?=$l['contact_me_title']?></h1>
			<div class="line"></div>
			<h1 class="small-title"><?=$l['contact_me_small_title']?> <a href="mailto:anashkin522a@gmail.com">anashkin522a@gmail.com</a></h1>
			<form action="" method="post" class="contact-me_form">
				<input type="text" class="mail-subject" placeholder="<?=$l['subject']?>">
				<div class="textarea-wrapper">
					<textarea name="message" class="mail-message" placeholder="<?=$l['message']?>"></textarea>
				</div>
				<input type="submit" class="mail-submit" value="<?=$l['send']?>">
				<input type="hidden" class="mail-key" value="<?=$key?>">
				<div class="form-prompt"></div>
			</form>
		</div>
	</section>
	<div class="system-window-overlay">
		<div class="system-window">
			<div class="system-window-title"><?=$l['system_window_title']?></div>
			<div class="system-window-message"></div>
			<div class="system-window-close"><?=$l['system_window_close']?></div>
		</div>
	</div>
	<footer>
		<div class="container">
			<span class="copyright">
				© <?=$l['my_name']?> 2018
			</span>
			<div class="contact-links">
				<ul>
					<li class="contact-link"><a href="" target="_blank"><i class="fab fa-facebook" title="Facebook"></i></a></li>
					<li class="contact-link"><a href="" target="_blank"><i class="fab fa-vk" title="VK"></i></a></li>
					<li class="contact-link"><a href="https://github.com/TheFabel" target="_blank"><i class="fab fa-github" title="Github"></i></a></li>
					<li class="contact-link"><a href="mailto:anashkin522a@gmail.com"><i class="fas fa-envelope" title="Mail"></i></a></li>
					<li class="contact-link phone_number">+380501073060</li>
				</ul>
			</div>
		</div>
	</footer>
	<script src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){console.log(performance.now() - t)})
	</script>
	<script src="js/main.js"></script>
	<script src="languages/<?=$lang?>.js"></script>
</body>
</html>
