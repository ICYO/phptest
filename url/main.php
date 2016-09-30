<?php
require_once('view/login.php');
require_once('view/regest.php');
require_once('view/Orders.php');
require_once('view/Manager.php');
require_once("view/captcha.php");


$url_list =
[
	@url('$', 'login'),
	@url('/captcha$', 'captcha'),
	@url('/regest$', 'regest'),
	@url('/main$', 'main'),
	@url('/logout$', 'logout'),
	@url('/manager$', 'manager'),
	@url('/manager/ctrl$', 'manager_ctrl'),
	@url('/manager/ctrl/([0-9]+)$', 'manager_ctrl'),
	@url('/manager/info/([0-9]+)$', 'usermsg'),
	@url('/manager/change_submit$', 'manage_change_submit'),
	@url('/manager/change/([0-9]+)$', 'usercg'),
	@url('/userdel$', 'userdel'),
	@url('/test$', 'test')
];

match_url($url_list);