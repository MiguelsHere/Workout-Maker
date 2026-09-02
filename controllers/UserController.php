<?php
include_once 'config/Database.php';
include_once 'models/User.php';

class UserController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register()
    {
        if ($_POST) {
            $this->user->userName = (string) $_POST['user_name'];
            $this->user->password = (string) $_POST['password'];

            if ($this->user->register()) {
                header("Location: index.php?action=login");
                exit;
            }
            header("Location: index.php?action=register");
            exit;
        }

        include 'views/user/user_register.php';
    }

    public function login()
    {
        if ($_POST) {
            $this->user->userName = (string) $_POST['user_name'];
            $this->user->password = (string) $_POST['password'];

            if ($this->user->login()) {
                header("Location: index.php?action=update");
                exit;
            }
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/user/user_login.php';
    }

    public function update()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $this->user->userId = (int) $_SESSION['user_id'];

        if ($_POST) {
            $this->user->userDescription = (string) $_POST['user_escription'];
            $this->user->birthDate = (string) $_POST['birth_date'];
            $this->user->heightCm = (float) $_POST['height_cm'];
            $this->user->weightKg = (float) $_POST['weight_kg'];

            if ($this->user->update()) {
                header("Location: index.php?action=update");
                exit;
            }
        }

        include 'views/user/user_profile.php';
    }
}
