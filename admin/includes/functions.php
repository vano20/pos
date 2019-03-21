<?php 

function classAutoLoader($class) {

	$class = strtolower($class);

	$path = "includes/{$class}.php";

	is_file($path) && !class_exists($class) ? require_once($path) : die("{$class}.php not found !");
}

spl_autoload_register('classAutoLoader');

//redirect function
function redirect($url) {
	header("Location: {$url}");
}

?>