<?php
class View
{
	public function __construct() {
		ob_start("ob_gzhandler");
	}

	public function display(array $html, $data=null, $safe=true)
	{
		if ($data != null)
			foreach($data as $key => $val)
				$$key = $val;

		foreach($html as $once)
			include_once($once);
		$view = ob_get_contents();

		ob_end_clean();

		echo $view;
	}
}