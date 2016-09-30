<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title ?></title>
		<link rel="stylesheet" href="/css/basic/header.css" type="text/css" />
		<?php if(isset($data['css'])) { foreach($data['css'] as $url) { ?>
			<link rel="stylesheet" href="<?php echo $url ?>" type="text/css" />
		<?php }} ?>
		<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
