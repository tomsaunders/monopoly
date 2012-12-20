<?php
spl_autoload_register(function ($class){
	require strtolower($class).'.php';
});