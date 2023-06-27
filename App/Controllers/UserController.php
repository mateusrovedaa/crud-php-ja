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

    public function index()
    {
        try {
            $users = $this->userDAO->getAll();
            http_response_code(201);
            return $users;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Error to get users: " . $e->getMessage();
        }
    }

    public function getOne($id)
    {
        try {
            $user = $this->userDAO->getUserById($id);
            if ($user) {
                http_response_code(201);
                return $user;
            } else {
                http_response_code(404);
                return "User not found";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Error to get user: " . $e->getMessage();
        }
    }

    public function store($request)
    {
        try {
            $user = new User($request['name'], $request['email']);
            $createdUser = $this->userDAO->create($user);
            http_response_code(201);
            return $createdUser;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Error to insert user: " . $e->getMessage();
        }
    }

    public function update($request, $id)
    {
        try {
            $user = new User($request['name'], $request['email'], $id);
            $updatedUser = $this->userDAO->update($user);
            if ($updatedUser) {
                http_response_code(201);
                return $updatedUser;
            } else {
                http_response_code(404);
                return "User not found";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Error to update user: " . $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $deletedUser = $this->userDAO->delete($id);
            if ($deletedUser) {
                http_response_code(201);
                return "User " . $id . " deleted";
            } else {
                http_response_code(404);
                return "User not found";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Error to update user: " . $e->getMessage();
        }
    }
}
