<?php
/*
 * DataBase drive one storage media, and provides basic methods
 * Person_basic use by interface Person_basic
 * 2016-09-24 20:24
 */


interface DataBase
{
//	create table $name;
	public function create_dict(string $name);
//	drop table $name;
	public function drop_dict(string $name);
//	insert into $dict ([key]) values ([val])
	public function insert(string $dict, array $data);
//	delete from $dict where [key] = [val]
	public function delete(string $dict, array $info);
//	select ([$val]) from $dict where [key] = [val], return array with data or empty array
	public function select(array $val, string $dict, array $info=[]);
//	UPDATE $dict SET {[val]} where {[info]}
//	public function update(string $dict, array $val, array $info=[]);
}