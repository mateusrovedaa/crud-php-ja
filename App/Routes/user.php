<?php
use App\Controllers\UserController;

$router->post('/users', function () {
    $request = json_decode(file_get_contents('php://input'), true);

    $userController = new UserController();
    $userData = $userController->store($request);

    header('Content-Type: application/json');
    echo json_encode($userData);
});