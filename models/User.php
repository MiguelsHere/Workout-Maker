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

    public function login(): bool
    {

        $query = "SELECT id_user, user_name, password_hash FROM user WHERE user_name = :username";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);

        $stmt->execute();

        if ($stmt->rowCount()) {
            $row = $stmt->fetch();
            if (password_verify($this->password, $row['password_hash'])) {
                $_SESSION['id_user'] = $row['id_user'];
                return true;
            }
            return false;
        }
        return false;
    }
}
