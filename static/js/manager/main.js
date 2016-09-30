$(document).ready(function(){
	$("#manager_left").load("/index.php/manager/ctrl");

	$(window).resize(function(){
		if ($("#manager_page").width() < 800) {
			$("#manager_page").css({"margin":"70px 2% 0 2%", "width":"100%"})

			$("#manager_left").css({"width":"100%", "margin":"0"});
			$("#manager_usermsg").css({"width":"100%"})
		}
		else {
			$("#manager_page").css({"margin":"70px auto 0 auto", "width":"90%"})

			$("#manager_left").css({"width":"57%", "margin":"0 4% 0 0"});
			$("#manager_usermsg").css({"width":"37%"})
		}
	});
});
