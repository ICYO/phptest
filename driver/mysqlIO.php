<?php
require_once("interface/DataBase.php");


class mysqlIO implements DataBase {

	public $host = 'localhost';
	public $user = 'root';
	public $password = 'blldxt';
	public $dbname = 'stu';
	public $port = 3306;

	private $make_field = array();

	public function __construct()
	{
		$idb = new mysqli(
			$this->host,
			$this->user,
			$this->password,
		    $this->dbname
			) or die('Unale to connect');
		$this->idb = &$idb;
	}

	public function __destruct()
	{
		if (isset($this->idb))
			return $this->idb->close();
		return false;
	}

//	create database $name:
	public function create_dict(string $name)
	{
		$fields = implode(', ', $this->make_field);
		$sql = "CREATE TABLE $name ($fields)";

		$result = $this->idb->query($sql);
		if ($result)
			return true;
	    return false;
	}

	public function drop_dict(string $name)
	{
		$sql = "CREATE TABLE $name";
		if($result = $this->idb->query($sql))
			return true;
		die(__CLASS__." error: fail to drop table in ".__FILE__);
	}

	public function insert(string $dict, array $data)
	{
//	log [var]:	
		$swap_key = [];
		$swap_var = [];
		foreach ($data as $key => $var) {
			$swap_key[] = $key;
			$swap_val[] = "'$var'";
		}
//  end log [var];
//	array to string:
		$key = implode(',', $swap_key);
		$val = implode(',', $swap_val);
//	make sql:
		$sql = "insert into $dict ({$key}) values ({$val})";
		if ($this->idb->query($sql))
			return true;
		return false;
	}

	public function update(string $dict, array $val, array $info=[])
	{
		if ($val != []):
			$swap = array();
		    foreach ($val as $key => $var) {
				$i = "$key = '$var'";
				$swap[] = $i;
			}
			$val_sql = implode(', ', $swap); // make [val];
		else:
		    die(__FUNCTION__."must set field in ".__FILE__);
		endif;
		if ($info != []):
			$swap = array();
		    foreach ($info as $key => $var) {
				$i = "$key = '$var'";
				$swap[] = $i;
			}
			$info_sql = implode(', ', $swap); // make [val];
			$sql = "UPDATE $dict SET $val_sql WHERE $info_sql";
			echo $sql;
		else:
			$sql = "UPDATE $dict SET $val";
		endif;

	    if ($this->idb->query($sql))
			return true;
	    return false;
	}

	public function delete(string $dict, array $info)
	{
		$swap = array();
		foreach ($info as $key => $var) {
		    $s = "$key = '$var'";
			$swap[] = $s;
		}
		$swap_sql = implode(' and ', $swap);
		$sql = "delete from $dict where $swap_sql";
		return $this->idb->query($sql);
	}

	public function select(array $val, string $dict, array $info=[])
	{
		$val_sql = implode(',', $val); // make [val];

		if ($info != []):
			$swap = array();
		    foreach ($info as $key => $var) {
				$i = "$key = '$var'";
				$swap[] = $i;
			}
			$info_sql = implode(' and ', $swap); // make [info];
			$sql = "select $val_sql from $dict where $info_sql";
		else:
			$sql = "SELECT $val_sql from $dict";
		endif;

	    $res = $this->idb->query($sql);
		if ($res === false)
			return array(); // null return [];
		
		$row = $res->fetch_all(MYSQLI_ASSOC);
		return $row;
	}

	public function custom_query($sql, $val=null)
	{
		$res = $this->idb->query($sql, $val);
		if (! $res)
		    die("error of query in " . __FILE__ . __LINE__);
		return $res;
	}

	public function select_once(array $val, string $dict, array $info=[])
	{
		$val_sql = implode(',', $val); // make [val];

		if ($info != []):
			$swap = array();
		    foreach ($info as $key => $var) {
				$i = "$key = '$var'";
				$swap[] = $i;
			}
			$info_sql = implode(' and ', $swap); // make [info];
			$sql = "select $val_sql from $dict where $info_sql";
		else:
			$sql = "SELECT $val_sql from $dict";
		endif;

	    $res = $this->idb->query($sql);	
		$row = $res->fetch_array();
		return $row;
	}

	public function __set($field, $value)
	{
		if (isset($this->$field))
			$this->$field[] = $value;
	}
	
}

//$test = new mysqlIO();
//$test->dbname = 'stu';
//$re = $test->update('student', ['name' => 'KK'], ['id' => 1]);
//print_r($re);
