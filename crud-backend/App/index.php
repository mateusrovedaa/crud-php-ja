<?php

require_once __DIR__ . '/../vendor/autoload.php';


use Bramus\Router\Router;

$router = new Router();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json, text/plain, */*');

require_once __DIR__ . '/Routes/user.php';

$router->run();
