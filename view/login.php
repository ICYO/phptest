<?php

function login_check()
{
	if (isset($_POST['email']) or
		isset($_POST['password']) or
		isset($_POST['captcha'])
		)
		return true;
	return false;
}

function login_turns()
{
	$user = new OrderUser();
	$user->email = $_POST['email'];
	$user->captcha = $_POST['captcha'];
	$user->setpasswd($_POST['pwd']);

	if (! $user->login()):
		global $data;
		$data['err'] = $user->error;
	    $data['back'] = [
			'email' => $_POST['email'],
			'pwd'   => $_POST['pwd']
			];
	    return FALSE;
	endif;

	return TRUE;
}

function login() {
	if (isset($_SESSION['user']))
		header("Location:/index.php/main");

	if (login_check())
		if (login_turns()) {
			header("Location:/index.php/main");
			exit;
		}
	global $data;

	$data['js'] = [
	'/js/captcha.js',
	'/js/login.js'
	];

	$data['css'] = ['css/login.css'];
	require('static/html/login.php');
}

function logout()
{
	session_start();
	session_destroy();
// User::logout();
	header("Location:/index.php");
}