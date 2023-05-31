<?php
require_once('autoload.php');
error_reporting(0);

$router = new Router();

$router->get('/', 'ProductController::list');
$router->post('/index.php/create', 'ProductController::create');
$router->post('/index.php/delete', 'ProductController::remove');

$router->authenticateRoutes();


