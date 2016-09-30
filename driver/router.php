<?php
function url($seturl, $func)
{
	// error_reporting( E_ALL&~E_NOTICE );
	$script_uri = $_SERVER['REQUEST_URI'];
	$matched = false;
	preg_match("{/index.php{$seturl}}", $script_uri, $matched);

    if ($matched):
		$ct = count($matched);
		if ($ct != 1):
			$varswap = array();
		    for ($c=1; $c<$ct; $c++)
				$varswap[] = $matched[$c];

			call_user_func_array($func, $varswap);
			return true;
	    endif;
		call_user_func($func);
		return true;
	endif;

	return false;
}

function match_url($url_list)
{
	foreach ($url_list as $url) {
		if ($url === true):
			return ;
		endif;
	}
	echo $_SERVER['REQUEST_URI'];
	echo "404 not found";
}