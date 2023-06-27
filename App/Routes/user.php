<?php

use App\Controllers\UserController;

$router->get('/users', function () {  
    $userController = new UserController();
    $usersData = $userController->index();
    
    header('Content-Type: application/json');
    echo json_encode($usersData);
});

$router->get('/users/{id}', function ($id) {  
    $userController = new UserController();
    $userData = $userController->getOne($id);
    
    header('Content-Type: application/json');
    echo json_encode($userData);
});

$router->post('/users', function () {
    $request = json_decode(file_get_contents('php://input'), true);

    $userController = new UserController();
    $userData = $userController->store($request);

    header('Content-Type: application/json');
    echo json_encode($userData);
});

$router->put('/users/{id}', function ($id) {  
    $request = json_decode(file_get_contents('php://input'), true);

    $userController = new UserController();
    $userData = $userController->update($request, $id);

    header('Content-Type: application/json');
    echo json_encode($userData);
});

$router->delete('/users/{id}', function ($id) {  
    $userController = new UserController();
    $userData = $userController->delete($id);

    header('Content-Type: application/json');
    echo json_encode($userData);
});