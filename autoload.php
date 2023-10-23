<?php
/**
 * Created by PhpStorm.
 * User: huidaoli
 * Date: 2023/10/23
 * Time: 2:04 PM
 */

function classLoader($class)
{
	$path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
	$file = __DIR__ . '/src/' . $path . '.php';

	if (file_exists($file)) {
		require_once $file;
	}
}
spl_autoload_register('classLoader');