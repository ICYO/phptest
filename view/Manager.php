<?php

function manager_check()
{
	if (isset($_SESSION['user']) and $_SESSION['user']['manager'] == 1)
		return true;
	header("Location:/index.php");
}

function manager()
{
	manager_check();

	$data = $_SESSION['user'];
	$data['css'] = [
		'/css/manager/main.css',
		'/css/basic/dock.css',
	    '/css/manager/ctrl.css'
		];
	$data['js'] = ['/js/manager/main.js'];
	$html = [
		'static/html/basic/header.php',
		'static/html/basic/dock.php',
		'static/html/manager/main.php',
		'static/html/basic/footer.php'
		];
	$page = new View();
	$page->display($html, $data);
}

function usermsg($id)
{
	manager_check();

	$obj = new mysqlIO();
	$data['user'] = $obj->select_once(['id', 'name', 'age', 'email', 'manager'], 'users', ['id' => $id]);
	$html = ['static/html/manager/massage.php'];

	$page = new View();
	$page->display($html, $data);
}

function userdel()
{
	manager_check();

	$obj = new mysqlIO();
	$obj->delete('users', ['id' => $_POST['id']]);
	return true;
}

function manager_ctrl($pg=1)
{
	manager_check();

	$page = new PageObj(6, 'users');
	$page->init(['id', 'name', 'email', 'manager']);
	$data['all_pg'] = ceil($page->obj_num / 6);

	if ($pg > $data['all_pg'])
		$pg = $data['all_pg'];
	elseif ($pg < 1)
		$pg = 1;
	$data['user_obj'] = $page->get($pg, PageObj::ASC);

	$data['pg'] = $pg;
	$html = ['static/html/manager/ctrl.php'];

	$page = new View();
	$page->display($html, $data);
}

function usercg($id)
{
	manager_check();

	$obj = new mysqlIO();
	$data['user'] = $obj->select_once(['id', 'name', 'age', 'email', 'manager'], 'users', ['id' => $id]);
	$html = ['static/html/manager/change.php'];

	$page = new View();
	$page->display($html, $data);
}

function manage_change_submit()
{
	manager_check();
	if (isset($_POST['name']))
		header("Location: /index.php");

	$obj = new mysqlIO();
	$val = [
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'age' => $_POST['age'],
		'manager' => $_POST['manager']
		];
    return $obj->update('users', $val, ['id' => $_POST['id']]);
}