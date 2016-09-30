<?php
namespace driver;
spl_autoload_register(function ($class) {
		if (file_exists("driver/{$class}.php"))
		    include(__DIR__ . "/driver/{$class}.php");
		
		elseif (file_exists(__DIR__ . "/{$class}.php"))
			require_once(__DIR__ . "/{$class}.php");
		
		elseif (file_exists("object/{$class}.php"))
			require_once("object/{$class}.php");
		
		else
			exit(__FILE__ . " -- fail to load class $class, no such file");
	});