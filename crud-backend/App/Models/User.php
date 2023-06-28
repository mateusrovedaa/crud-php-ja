<?php

namespace App\Models;

class User
{
    private $id;
    private $name;
    private $email;

    public function __construct($name, $email, $id = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function __toString()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ]);
    }
}
