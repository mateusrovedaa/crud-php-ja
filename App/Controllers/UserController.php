<?php

namespace App\Controllers;

use App\Models\User;
use App\DAO\UserDAO;

class UserController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function store($request)
    {
        try{
            $name = $request['name'];
            $email = $request['email'];
    
            $user = new User($name, $email);
            $createdUser = $this->userDAO->create($user);
    
            http_response_code(201);
            return $createdUser;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Error to insert user: " . $e->getMessage();
        }
        
    }
}
