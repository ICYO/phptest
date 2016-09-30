$(document).ready(function(){
	
	$("#dock_mng").click(function(){
		$(".manage_plus").slideToggle(50);
	});

	$(".dock_btn").mousemove(function(){
		$(this).css("color", "#20AA76");
	});
	$(".dock_btn").mouseleave(function(){
		$(this).css("color", "white");
	});

	$(window).resize(function() {
		if ($("#dock_main").width() < 800) {
			$("#dock_menu").hide();
			$("#dock_bar").css({"width":"100%", "margin":"0 1% 0 1%"});

			$("#dock_menu_key").show();
		}
		else {
			$("#dock_menu").show();
			$("#dock_bar").css({"width":"90%", "margin":"0 auto"});

			$("#dock_menu_key").hide();
		}
	});
});
