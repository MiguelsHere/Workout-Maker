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

    public $newPassword;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listAll()
    {

        $query = "SELECT user_name FROM user;";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listPublic()
    {
        $query = "SELECT user_name FROM user WHERE is_public = 1;";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register(): bool
    {
        try {

            $hash = password_hash($this->password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user(user_name, password_hash) VALUES (:username, :hash);";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":username", $this->userName);
            $stmt->bindParam(":hash", $hash);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            $_SESSION['alert'] = "Erro, nome de utilizador indisponivel.";
            return false;
        }
    }

    public function login(): bool
    {
        try {
            $query = "SELECT user_id, password_hash FROM user WHERE user_name = :username;";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":username", $this->userName);

            $stmt->execute();

            $row = $stmt->fetch();

            if ($row) {
                if (password_verify($this->password, $row['password_hash'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $row['user_id'];
                    return true;
                }
            }
            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        } catch (PDOException $e) {
            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }

    public function newPassword(): bool
    {
        try {
            $query = "SELECT password_hash FROM user WHERE user_id = :user_id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":user_id", $this->userId);

            $stmt->execute();

            $row = $stmt->fetch();

            if (password_verify($this->password, $row['password_hash'])) {

                $hash = password_hash($this->newPassword, PASSWORD_DEFAULT);

                $query = "UPDATE user SET password_hash = :new_password WHERE user_id = :user_id";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(":new_password", $hash);
                $stmt->bindParam(":user_id", $this->userId);

                $stmt->execute();

                $_SESSION['alert'] = "Palavra-passe substituida com sucesso.";

                return true;
            }
            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        } catch (PDOException $e) {
            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }

    public function update(): bool
    {
        try {
            $query = "UPDATE user SET user_description =:user_description, birth_date=:birth_date, height_cm =:height_cm , weight_kg = :weight_kg) WHERE user_id = :user_id;";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":user_description", $this->userDescription);
            $stmt->bindParam(":birth_date", $this->birthDate);
            $stmt->bindParam(":height_cm", $this->heightCm);
            $stmt->bindParam(":weight_kg", $this->weightKg);
            $stmt->bindParam(":user_id", $this->userId);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }



    public function delete(): bool
    {
        try {
            $query = "SELECT user_id, password_hash FROM user WHERE user_id = :user_id;";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":user_id", $this->userId);

            $stmt->execute();

            $row = $stmt->fetch();

            if ($row) {
                if (password_verify($this->password, $row['password_hash'])) {

                    $query = "DELETE FROM user WHERE user_id = :user_id";

                    $stmt = $this->conn->prepare($query);

                    $stmt->bindParam(":user_id", $this->userId);

                    $stmt->execute();
                    
                    $_SESSION = [];
                    session_destroy();

                    return true;
                }
            }
            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        } catch (PDOException $e) {
            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }

    public function signOut(): bool
    {
        $_SESSION = [];
        session_destroy();

        return true;
    }
}
