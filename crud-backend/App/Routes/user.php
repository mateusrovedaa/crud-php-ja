<?php

use App\Controllers\UserController;

// fix CORS OPTIONS problem
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    exit();
}

$router->get('/users', function () {  
    $userController = new UserController();
    $usersData = $userController->index();
    
    echo json_encode($usersData);
});

$router->get('/users/{id}', function ($id) {  
    $userController = new UserController();
    $userData = $userController->getOne($id);
    
    echo $userData;
});

$router->post('/users', function () {
    $request = json_decode(file_get_contents('php://input'), true);

    $userController = new UserController();
    $userData = $userController->store($request);

    echo $userData;
});

$router->put('/users/{id}', function ($id) {  
    $request = json_decode(file_get_contents('php://input'), true);

    $userController = new UserController();
    $userData = $userController->update($request, $id);

    echo $userData;
});

$router->delete('/users/{id}', function ($id) {  
    $userController = new UserController();
    $userData = $userController->delete($id);

    echo json_decode($userData);
});