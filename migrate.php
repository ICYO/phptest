<?php
$db = new mysqlIO();

$db->make_field = "id int not null AUTO_INCREMENT unique primary key";
$db->make_field = "name varchar(25) not null";
$db->make_field = "email varchar(100) not null unique";
$db->make_field = "password varchar(200) not null";
$db->make_field = "age int";
$db->make_field = "manager int";

if ($db->create_dict('users'))
	echo "<font color=\"green\"> create dict users sunccess.</font>";
else
	echo "<font color=\"red\"> fail to create dict users.</font>";
?>
