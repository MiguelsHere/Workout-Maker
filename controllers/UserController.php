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
            $this->user->userName = (string) $_POST['userName'];
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
            $this->user->userName = (string) $_POST['userName'];
            $this->user->password = (string) $_POST['password'];

            if ($this->user->login()) {
                header("Location: index.php?action=updateInfo");
                exit;
            }
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/user/user_login.php';
    }

    public function updateInfo()
    {
        if (empty($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        if ($_POST) {
            $this->user->userDescription = (string) $_POST['userDescription'];
            $this->user->birthDate = (string) $_POST['birthDate'];
            $this->user->heightCm = (float) $_POST['heightCm'];
            $this->user->weightKg = (float) $_POST['weightKg'];

            if ($this->user->updateInfo()) {
                header("Location: index.php?action=updateInfo");
                exit;
            }
        }

        include 'views/user/user_profile.php';
    }
}
