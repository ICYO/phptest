$(document).ready(function(){
	$(".obj_btn_info").click(function(){
		var i = $(this).val()
		$("#manager_usermsg").load("/index.php/manager/info/" + i);
	});

	$(".obj_btn_del").click(function(){
		var i = $(this).val()
		$.post("/index.php/userdel", {id:i}, function(){
			$("#manager_left").load("/index.php/manager/ctrl");
		});
	});

	$(".obj_btn_cg").click(function(){
		var i = $(this).val();
		$("#manager_usermsg").load("/index.php/manager/change/" + i);
	});

});

$(document).ready(function(){
	$(".paging_btn").click(function(){
		$("#manager_left").load("/index.php/manager/ctrl/"+$(this).val());
	});
	$(".manager_obj:odd").css('background', '#90EE90');
});

// table ctrl
$(document).ready(function(){
	var m = [];
	$(".obj_field_i").each(function(){
		m.push($(this).width());
	});
	var wt = Math.max.apply(null, m);
	$(".obj_field_i").css('width', wt);
	
	var m = [];
	$(".obj_field_n").each(function(){
		m.push($(this).width());
	});
	var wt = Math.max.apply(null, m);
	$(".obj_field_n").css('width', wt);

	var m = [];
	$(".obj_field_e").each(function(){
		m.push($(this).width());
	});
	var wt = Math.max.apply(null, m);
	$(".obj_field_e").css('width', wt);

	var m = [];
	$(".obj_field_m").each(function(){
		m.push($(this).width());
	});
	var wt = Math.max.apply(null, m);
	$(".obj_field_m").css({'width':wt, "text-align":"center"});
});
