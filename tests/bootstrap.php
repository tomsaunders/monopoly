<?php
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(dirname(__FILE__)));
spl_autoload_register(function ($class){
	$file = strtolower($class) . '.php';
	if (stream_resolve_include_path($file)){
		require $file;
	}
});
