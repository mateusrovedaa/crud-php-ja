<?php

namespace App\DAO;

use App\Models\User;
use App\Core\Database;

class UserDAO
{
    private $table = 'users';
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function create(User $user)
    {
        try {
            $sql = "INSERT INTO $this->table (name, email) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute([$user->getName(), $user->getEmail()]);

            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $userId = $this->connection->lastInsertId(); 
                $userData = $this->getUserById($userId); 
                return $userData; 
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception("Error to insert user: " . $e->getMessage());
        }
    }

    public function getUserById($userId)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$userId]);
            $user = $stmt->fetch();

            $userData = [
                "id" => $user["id"],
                "name" => $user["name"],
                "email" => $user["email"]
            ];

            return $userData;
        } catch (\Exception $e) {
            throw new \Exception("Error to insert user: " . $e->getMessage());
        }
    }
}
