<?php

class User
{
    private $conn;

    public $username;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register(): bool
    {
        //Depois colocar query para ver ser username já existe

        $hash = password_hash($this->password, PASSWORD_ARGON2ID);

        $query = "INSERT INTO user(user_name, password_hash) VALUES (:username, :hash);";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":hash", $hash);

        $stmt->execute();

        return true;
    }
}
