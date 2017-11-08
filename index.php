<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


//system files
session_start();
//session_destroy();
include_once 'includes/autoloadClasses.php';

$CoreExceptionHandler = new CoreExceptionHandler();
set_exception_handler([$CoreExceptionHandler, 'handle']); //TODO how should i do it?

//call Router;
$router = new CoreRouter();
//try {
	
	$router->start();
//} catch (ExceptionErrorPage $e) {
	//$e->createPage();
//}
