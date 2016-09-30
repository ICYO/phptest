<!DOCTYPE html>
<html>
	<head>
		<title>
			login page
		</title>
		<?php if(isset($data['css'])) { foreach($data['css'] as $css) { ?>
			<link rel="stylesheet" href="<?php echo $css ?>" type="text/css" />
		<?php }} ?>

		<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js">
		</script>
	</head>

	<body>
		<form id="login_form" method="POST" action="index.php">
			<p>login</p>
			<input type="email", name="email" class="login_input" id="email" <?php if(isset($data['back'])) {echo "value=\"{$data['back']['email']}\"";} ?> placeholder="email" />
			<input type="password", name="pwd" class="login_input" id="pwd" <?php if(isset($data['back'])) {echo "value=\"{$data['back']['pwd']}\"";}?> placeholder="password" />
			<input type="text", name="captcha" class="login_input" id="captcha" placeholder="captcha" />
			<div id="cap_img"></div>
			<?php if(isset($data['err'])) { ?>
				<div id="error"><?php echo $data['err']; ?></div>
			<?php } ?>
			<input type="submit" id="sub" />
			<a href="index.php/regest">regest</a>
		</form>
	</body>

	<?php if(isset($data['js'])) { foreach($data['js'] as $js) { ?>
		<script src="<?php echo $js; ?>"></script>
	<?php }} ?>
</html>
