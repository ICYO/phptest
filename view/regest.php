<?php

function regest_turns()
{
	$user = new OrderUser();
	$user->name = $_POST['name'];
	$user->email = $_POST['email'];
	$user->captcha = $_POST['captcha'];
	$user->setpasswd($_POST['pwd']);
	$user->manager = 0;
	if (isset($_POST['age']))
		$user->age = $_POST['age'];

	global $data;
	if (! $user->regest()):
		$data['err'] = $user->error;
	    return FALSE;
	endif;

	return TRUE;
}

function regest_check()
{
	if (isset($_POST['email']) or
		isset($_POST['name']) or
		isset($_POST['password']) or
		isset($_POST['age']) or
		isset($_POST['captcha'])
		)
		return true;
	return false;
}

function regest() {
	if (isset($_SESSION['user']))
		header("Location:/index.php/main");

	global $data;
	if (regest_check())
		if (regest_turns()) {
			header("Location:/index.php");
			exit;
		}

	$data['js'] = [
	'/js/captcha.js',
	'/js/login.js'
	];
	$data['css'] = ['/css/login.css'];
	require('static/html/regest.php');
}