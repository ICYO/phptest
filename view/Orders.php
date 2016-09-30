<?php
function main()
{
	$data = $_SESSION['user'];
	$data['css'] = [
		'/css/main/main.css',
		'/css/basic/dock.css'
		];
	$data['js'] = ['/js/main/main.js'];
	$html = [
		'static/html/basic/header.php',
		'static/html/basic/dock.php',
		'static/html/main/main.php',
		'static/html/basic/footer.php'
		];
	$page = new View();
	$page->display($html, $data);
}

function test()
{
    $test = new Image('1475078209.png', Image::MODEPNG);
	$test->makemark('1475077905.jpg', Image::MODEJPEG);
	$test->flip();
	$test->send();

	$html = ['static/html/test.php'];
	$page = new View();
	$page->display($html, $data);
}