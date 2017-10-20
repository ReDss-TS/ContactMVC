<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//system files
require_once('core/Router.php');

//call Router;
$router = new Router();
$router->start();
