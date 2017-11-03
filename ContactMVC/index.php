<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//system files
include_once 'includes/autoloadClasses.php';

//call Router;
$router = new CoreRouter();
try {
	$router->start();
} catch (ExceptionErrorPage $e) {
	$e->pageNotFound();
}
