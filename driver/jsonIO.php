<?php
require_once("interface/DataBase.php");


class jsonIO implements DataBase {

	public $io_file;

	public function __construct(string $file)
	{
	    $this->io_file = $file;

		if (! file_exists($this->io_file)):
			$check = fopen($this->io_file, "w");
//		    file_put_contents($this->io_file, json_encode(array('data' => [])));
		    if (! $check)
				$this->create_err(__FUNCTION__);
			fclose($check);
		endif;

		$swap = file_get_contents($this->io_file);
		$this->data = json_decode($swap, TRUE);
	}

//	create one dictionary:
	public function create_dict(string $name)
	{
		if (! empty($this->data))
			foreach($this->data as $table => $row) {
				if ($name == $table)
					return FALSE;
			}
		$this->data[$name] = [];
		$swap = json_encode($this->data);
		$this->write($swap);
		return TRUE;
	}

//	drop one dictionary:
	public function drop_dict(string $name)
	{
		if (empty($this->data))
			return FALSE;

		foreach ($this->data as $table => $row) {
			if ($name == $table):
				unset($this->data[$table]);
			    $this->write(json_encode($this->data));
				return TRUE;
			endif;
		}
		return FALSE;
	}

//	insert one array data in to dict:
	public function insert(string $dict, array $data)
	{
		$this->data[$dict][] = $data;
		return $this->write(json_encode($this->data)) ? : FALSE;
	}

	public function update(string $dict, array $data)
	{
		foreach ($this->data['dict'] as $row => $l) {
			foreach ($data as $key => $val)
				if ($row == $key)
					$swap = $row;
		}
		foreach ($data as $key => $val)
			$this->data[$dict][$swap] = [$key => $val];

		return $this->write(json_encode($this->data)) ? : FALSE;
	}

//	delete one row from dict:
	public function delete(string $dict, array $info)
	{
		$swap = array();
		$del_num = 0;

		foreach($this->data[$dict] as $num => $row) {
			foreach($info as $key => $var) {
				if ($var == $row[$key])
					$swap[] = $num;
			}
		} // end of check.

	    rsort($swap);
	    $fac = array_count_values($swap);
		foreach($fac as $id => $time) {
			if($time == count($info)):
				unset($this->data[$dict][$id]);
			    $del_num += 1;
			endif;
		}

		if ($del_num == 0)
			return FALSE;
	    $this->write(json_encode($this->data));
		return $del_num;
	} // end of function delete.

//	select [val] from dict where array [info]:
	public function select(array $val, string $dict, array $info=[])
	{
		$swap = array();
		$requires = array();
		
		foreach($this->data[$dict] as $num => $row) {
			foreach($info as $key => $var) {
				if ($var == $row[$key])
					$swap[] = $num;
			}
		} // end of check.

	    $fac = array_count_values($swap);
		foreach($fac as $id => $time)
			if($time == count($info))
			    $requires[] = $this->data[$dict][$id];

		// make query set:
		if (count($val) == 1 AND $val[0] == '*')
		    return $requires;

		// make custom set:
		$custom_set = array();
		foreach($requires as $once) {
			$min = [];
			foreach($val as $key) {
			    $min[] = $once[$key];
			}
		    $custom_set[] = $min;
		}

		return $custom_set;
	}
	
//	public function update()

//	write data to io file:
	private function write($data)
	{
		if (file_put_contents($this->io_file, $data) === FALSE)
			die("fail to write in Data file");
		return TRUE;
	}

//	print error and exit:
	private function create_err($func)
	{
		die(__CLASS__ .  " error: fail to create data file <b>{$this->io_file}</b>, in ". __FILE__);
	}

}

//$test = new jsonIO('DataBase.json');
//$data = ['id' => 3, 'name' => 'Lee', 'age' => 12];
//$test->insert('test4', $data);
//$test->delete('test4', $data);
//print_r($test->select(['*'], 'test4', ['age' => 12]));
?>