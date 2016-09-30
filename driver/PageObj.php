<?php
class PageObj
{
    const DESC = 'ORDER BY id DESC';
	const ASC = 'ORDER BY id ASC';

	public $table;
	public $pk = 'id';
	private $plus_sql;

	public function __construct(int $page, $table)
	{
		$this->page = $page;
		$this->table = $table;
		$this->db = new mysqlIO();
	}

//	select [$data], where [$plus]:
	public function init(array $data, array $plus=[])
	{
		$this->data = implode(',', $data);
		$this->plus_sql = $this->make_str($plus);

		$sql = "select count({$this->pk}) from {$this->table} $plus_sql";
		$num = $this->db->custom_query($sql);
	    $this->obj_num = $num->fetch_row()[0]; // no compatibility
		
	}

	public function get($num, $sort='')
	{
	    if (--$num < 0)
			return [];

		$start = $num * $this->page;
		$end = $start+$this->page;
		$sql = "select {$this->data} from {$this->table} {$this->plus_sql} $sort limit $start, $end";

	    $res = $this->db->custom_query($sql);
	    return $res->fetch_all(MYSQLI_ASSOC); // no compatibility
	}

	private function make_str(array $data)
	{
		if ($data == [])
			return "";
		
		$arr_sql = [];
		foreach($data as $key => $val)
			$arr_sql[] = "$key = '$val'";

	    return "where " . implode(' and ', $arr_sql);
	}
}
