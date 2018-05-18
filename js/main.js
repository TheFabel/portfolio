system_window_open = false;
pressed = false;
$(".lang-change").on("click", function()
{
	to_change = $(this).attr("data-to_change");
	document.cookie = "lang="+to_change+"; expires=Thu, 18 Dec 2020 12:00:00 UTC; path=/";
	location.reload();
})
$('div.contact-me').click(function()
{
	scroll_el = "section.contact-me"
    if ($(scroll_el).length != 0)
    {
    	$('html, body').animate({ scrollTop: $(scroll_el).offset().top }, 500);
    }
    return false;
})
$(".work-photo").on("click", function()
{
	el = $(this);
	$(".work-modal-window").addClass("window-shown");
	$(".window-image a").attr("href", el.attr("data-url"));
	$(".window-image a img").delay(100).queue(function(next){$(this).attr("src", "images/" + el.attr("data-screen") + "-screen.png"); next();});
})
$(".work-modal-window, .system-window-overlay").on("click", function(e)
{
	if(e.target === this)
		closeWindow()
})
$(".window-close, .system-window-close").on("click", function()
{
	closeWindow()
})
$(document).keyup(function(e)
{
	if (e.keyCode == 27)
	{
		closeWindow()
	}
	if(e.keyCode == 13 && system_window_open)
		closeWindow();
});
function closeWindow()
{
	$(".work-modal-window").add(".system-window-overlay").removeClass("window-shown");
	$(".window-image a img").delay(300).queue(function(next){$(this).attr("src", "images/loading.gif"); next();});
	system_window_open = false;
}
$(".mail-message").on("keydown", function(e)
{
  if (e.ctrlKey && e.keyCode == 13)
	{
		e.preventDefault();
    $(".contact-me_form").submit();
  }
})
var timeout;
$(".contact-me_form").on("submit", function(e)
{
	e.preventDefault();
	if(pressed) return false;
	console.log("clicked");
	subject = $(".mail-subject");
	message = $(".mail-message");
	if(subject.val().length < 4)
	{
		clearTimeout(timeout);
		$(".form-prompt").attr("data-prompt", "shown");
		$(".form-prompt").text(l.subject_error);
		timeout = setTimeout(function(){$(".form-prompt").attr("data-prompt", "hidden");}, 2000);
		return false;
	}
	if(message.val().length < 20)
	{
		clearTimeout(timeout);
		$(".form-prompt").attr("data-prompt", "shown");
		$(".form-prompt").text(l.message_error);
		timeout = setTimeout(function(){$(".form-prompt").attr("data-prompt", "hidden");}, 2000);
		return false;
	}
	$.ajax(
	{
		url: "server/mail.php",
		type: "post",
		data:
		{
			subject: $(".mail-subject").val(),
			message: $(".mail-message").val(),
			key: $(".mail-key").val()
		},
		beforeSend: function()
		{
			$(".mail-message").blur();
			pressed = true;
			setTimeout(function()
			{
				system_window_open = true;
			}, 100);
		},
		success: function(data)
		{
			$(".system-window-overlay").addClass("window-shown");
			$(".system-window-overlay .system-window-message").text(data);
			pressed = false;
		}
	})
})
