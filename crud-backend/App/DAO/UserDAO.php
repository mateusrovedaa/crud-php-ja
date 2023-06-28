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

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY id";
            $stmt = $this->connection->query($sql);
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            return $users;
        } catch (\Exception $e) {
            throw new \Exception("Error to get users: " . $e->getMessage());
        }
    }

    public function getUserById($userId)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$userId]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();
            
            if ($user) {
                $userData = new User($user["name"], $user["email"], $user["id"]);
                return $userData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception("Error to insert user: " . $e->getMessage());
        }
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

    public function update(User $user)
    {
        try {
            $sql = "UPDATE $this->table SET name = ?, email = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$user->getName(), $user->getEmail(), $user->getId()]);
            
            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $userData = $this->getUserById($user->getId());
                return $userData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception("Error to update user: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $userToDelete = $this->getUserById($id);
            
            if ($userToDelete) {
                $sql = "DELETE FROM $this->table WHERE id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id]);
                $this->db->closeConnection();
            } 
            return $userToDelete;
        } catch (\Exception $e) {
            throw new \Exception("Error to delete user: " . $e->getMessage());
        }
    }
}
