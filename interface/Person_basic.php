<?php
/*
 * Person_basic interface dependent on DataBase.
 * Person_basic used by index.php and regest.php
 * 2016-09-24 21:15
 */

interface Person_basic {

//	user regest: make sure [email] is unique, and then save information by interface DataBase
	public function regest(); // return boolean;
//	user login: check email(empty) and password, load user information from DataBase
	public function login();
//	improving information: update user info. send array(val) to DataBase and update()
	public function update_msg();
//	write:
//	public function write();
}