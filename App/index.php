<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

require_once __DIR__ . '/Routes/user.php';

$router->run();