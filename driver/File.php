<?php
class File
{
	private $obj = null; // FILE object.
	public $max_size = 0;
	public $file = array(); // index of effective files.
	public $file_num;
	public $file_hash = array();
	public $file_mime = null;
	public $file_name = array();
	public $file_tmp = null;
	public $save_path = './';
	private $notice = array(
		'repeat' => [],
		'type_error' => [],
		'post_null' => false,
		'io_error' => [],
		'date' => ''
		);

	const TEXT = ['text/txt',
				  'text/plain',
				  'text/html',
				  'application/pdf',
				  'application/msword',
		];
	const IMAGE = ['image/png',
				   'image/x-png',
				   'image/jpeg',
				   'image/jpg',
				   'image/gif',
				   'image/bmp',
				   'image/x-icon',
				   'image/icon',
				   'image/svg+xml'
		];

	public function __construct(string $filename)
	{
		$this->notice['date'] = time();
		$this->db = new mysqlIO();
		
		$this->obj = &$_FILES[$filename];
//	Multi file:
	    if (is_array($_FILES[$filename]['tmp_name'])) {

		    foreach($_FILES[$filename]['tmp_name'] as $key => $val)
			    if ($val != null) {
					$this->file[] = $key; // save effective files.
					$this->file_num++;
				}
			if ($this->file_num == 0) {
				$this->notice['post_null'] = true;
				return false;
			}
		}
//   Single file:
		else {
			if ($_FILES[$filename]['tmp_name'] != null) {
				$this->file[] = $_FILES[$filename]['tmp_name'];
				$this->file_num++;
			}
			else
				return false;
		}
		$this->hash_file_array();
	}

	public function type_mach(array $mime)
	{
		foreach ($this->file as $key)
			if (! in_array($this->obj['type'][$key], $mime) or
				! $this->file_num) {
				$this->notice['type_error'][$key] = $this->obj['type'][$key];
			    return false;
			}
		return true;
	}

	public function save(string $table)
	{
		foreach ($this->file_hash as $key => $once) {
			$sql = "select 1 from $table where md5 = '{$once}'";
			$test = $this->db->idb->query($sql);

			if ($test->num_rows == 0) {
				$filename = $this->make_file_path($this->obj['name'][$key]);
				$path = "{$this->save_path}$filename";
				$data = [
					'uid' => $_SESSION['user']['id'],
					'filename' => $filename,
					'md5' => $once,
					'src' => $path,
					'mime' => $this->obj['type'][$key]
					];
				echo $data['src'];
				if (! $this->db->insert($table, $data)) {
				    $this->error_log(1, 'insert', __LINE__);
					return false;
				}

				$tmp_file = $this->obj['tmp_name'][$key];
				if (! move_uploaded_file($tmp_file, $path)) {
					$this->error_log(1, 'move_upload_file', __LINE__);
					return false;
				}
			} // end if;
			else
				$this->notice['repeat'][$key] = [$this->obj['name'][$key]];
		} // end of foreach;

		return true;
	}

//	delete from $table where [$pk_array] (primary key):
	public function delete(string $table, array $pk_array)
	{
		if (count($pk_array) > 1) {
			$this->error_log(2, __FUNCTION__, __LINE__);
			return false;
		}
		$row = $this->db->select_once(['src'], $table, $pk_array);
		
		if (unlink($row['src']) and $this->db->delete($table, $pk_array))
		    return true;
		$this->error_log(1, __FUNCTION__, __LINE__);
		return false;
	}

	public function send(string $table, array $info)
	{
		$row = $this->db->select_once(['filename', 'mime'], 'image', $info);
	    header("Content-Type: {$row['mime']}");
		header("Location: /media/{$row['filename']}");
	}

	private function make_file_path($name)
	{
		$suffix = pathinfo($name, PATHINFO_EXTENSION);
		$swap = time();
		echo pathinfo($name, PATHINFO_EXTENSION);
		return "{$swap}.{$suffix}";
	}

	private function hash_file_array()
	{
	    foreach ($this->file as $key) {
			$md5 = md5_file($this->obj['tmp_name'][$key]);
			$this->file_hash[$key] = $md5;
		}
	}

	private function error_log($num, $func, $line)
	{
		$err1 = __CLASS__."::$func() notice: Execution Error, unexpected result in ".$line;
		$err2 = __CLASS__."::$func() notice: Non-standard parameters in ".__LINE__;

		$fname = "err$num";
		$this->notice['io_error'][] = $$fname;
	}

	public function __get($method)
	{
		if (isset($this->notice[$method]))
			return $this->notice[$method];

		die("Call undefined method '$method' in class ".__CLASS__ .'()');
	}

}
