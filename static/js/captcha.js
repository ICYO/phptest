$(document).ready(function(){
	$("#cap_img").load("index.php/captcha");
	$("#cap_img").click(function(){
		$(this).load("index.php/captcha");
	});
});
