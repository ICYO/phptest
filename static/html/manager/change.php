<style>
.manager_right_field input {
	height:25px;
	width:50%;
	margin:0;
	padding:0;
	border:0;
}

#manager_table {
	float:left;
	margin:0;
	padding:0;
}
#change_sub {
	height:30px;
	margin:4px 100px;
	border:0;
	background:#6495ED;
	color:white;
}


</style>
<table id="manager_table">
<div id="manager_right_title">
	EDIT
</div>
<div class="manager_right_field">
	<div class="field_key">
		ID
	</div>
	<div class="field_msg" id="change_id"><?php echo $user['id']; ?></div>
</div>

<div class="manager_right_field">
	<div class="field_key">
		姓 名
	</div>
	<input type="text" class="field_msg" id="change_name" value="<?php echo $user['name']; ?>" />
</div>
<div class="manager_right_field">
	<div class="field_key">
		email
	</div>
	<input type="text" class="field_msg" id="change_email" value="<?php echo $user['email']; ?>" />
</div>
<div class="manager_right_field">
	<div class="field_key">
		年 龄
	</div>
	<input type="text" class="field_msg" id="change_age" value="<?php echo $user['age']; ?>" />
</div>
<div class="manager_right_field">
	<div class="field_key">
		管 理
	</div>
	<div class="field_msg" id="field_manager">
		<select id="change_manager">
			<?php if($user['manager'] == 1) { ?>
				<option value=1 selected>是</option>
				<option value=0>否</option>
			<?php } else { ?>
				<option value=1>是</option>
				<option value=0 selected>否</option>
			<?php } ?>
		</select>
	</div>
</div>
<button id="change_sub">change</button>
</table>

<script>
	$(document).ready(function(){
		$("#change_sub").click(function(){
			$.post("/index.php/manager/change_submit", {
				id : $("#change_id").text(),
				name : $("#change_name").val(),
				email : $("#change_email").val(),
				age : $("#change_age").val(),
				manager : $("#change_manager").val()
			}, function() {
				$("#manager_left").load("/index.php/manager/ctrl");
			});
		});
	});
</script>
