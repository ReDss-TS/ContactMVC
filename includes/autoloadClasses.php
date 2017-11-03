<?php

function __autoload($class_name) 
{
	$bigLetters = preg_replace('~[^A-Z]~','',$class_name);
	$length = strlen($bigLetters);
    //$filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';
	$filename = ltrim(preg_replace( '~[A-Z]~', DIRECTORY_SEPARATOR.'$0', $class_name.'.php'), DIRECTORY_SEPARATOR);
	for ($i = 1; $i <= $length; $i++) {
		if (!file_exists($filename)) {
	    	$filename = substr_replace($filename, '', strripos($filename, DIRECTORY_SEPARATOR), 1);
	    	$i++;
	    } else {
	    	var_dump($filename);
	    	include $filename;
	    	break;
	    }
	}
}

