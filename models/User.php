<?php

class User
{
    private $conn;

    public $userId;
    public $userName;
    public $password;
    public $userDescription;
    public $birthDate;
    public $heightCm;
    public $weightKg;

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

        $stmt->bindParam(":username", $this->userName);
        $stmt->bindParam(":hash", $hash);

        $stmt->execute();

        return true;
    }

    public function login(): bool
    {

        $query = "SELECT user_id, password_hash FROM user WHERE user_name = :username;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->userName);

        $stmt->execute();

        $row = $stmt->fetch();

        if ($row) {
            if (password_verify($this->password, $row['password_hash'])) {
                $_SESSION['user_id'] = $row['user_id'];
                return true;
            }
            return false;
        }
        return false;
    }

    public function update(): bool
    {
        $query = "UPDATE user SET user_description, birth_date, height_cm, weight_kg) VALUES(:user_description, :birth_date, :height_cm, :weight_kg) WHERE user_id = :user_id;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_description", $this->userDescription);
        $stmt->bindParam(":birth_date", $this->birthDate);
        $stmt->bindParam(":height_cm", $this->heightCm);
        $stmt->bindParam(":weight_kg", $this->weightKg);
        $stmt->bindParam(":user_id", $this->userId);

        $stmt->execute();


        return true;
    }
}
