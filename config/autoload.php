<?php
/**
 * Created by PhpStorm.
 * User: zheka
 * Date: 19.07.17
 * Time: 14:00
 */

//TODO: don't work need fix
//require_once(__DIR__ . '/../vendor/autoload.php');

// autoload function
function __autoload($class) {

	// convert namespace to full file path
	$class = __DIR__ . '/../' .str_replace('\\', '/', $class) . '.php';
	require_once($class);

}