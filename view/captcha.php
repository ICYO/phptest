<?php
function captcha() {
	$ca = new Captcha();
	$ca->create(6);
	$ca->rand_point(150);
	$ca->print_image();
	
	session_start();
	$_SESSION['captcha'] = $ca->words;
}