<div id="manager_right_title">
	MESAGES
</div>
<div class="manager_right_field">
	<div class="field_key">
		ID
	</div>
	<div class="field_msg" id="field_id"><?php echo $user['id']; ?></div>
</div>
<div class="manager_right_field">
	<div class="field_key">
		姓 名
	</div>
	<div class="field_msg" id="field_name"><?php echo $user['name']; ?></div>
</div>
<div class="manager_right_field">
	<div class="field_key">
		email
	</div>
	<div class="field_msg" id="field_email">
		<a href="http://<?php echo $user['email']; ?>">
			<?php echo $user['email']; ?>
		</a>
	</div>
</div>
<div class="manager_right_field">
	<div class="field_key">
		年 龄
	</div>
	<div class="field_msg" id="field_age"><?php echo $user['age']; ?> 岁</div>
</div>
<div class="manager_right_field">
	<div class="field_key">
		管 理
	</div>
	<div class="field_msg" id="field_manager">
		<?php if($user['manager'] == 1) { ?>
			是
		<?php } else {echo "否";} ?>
	</div>
</div>
