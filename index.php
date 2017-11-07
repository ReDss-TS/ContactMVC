<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


//system files
session_start();
//session_destroy();
include_once 'includes/autoloadClasses.php';

//call Router;
$router = new CoreRouter();
try {
	//set_exception_handler('pageNotFound'); //TODO how should i do it?
	$router->start();
} catch (ExceptionErrorPage $e) {
	$e->createPage();
}


