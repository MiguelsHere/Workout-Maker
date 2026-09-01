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
            $this->user->username = (string) $_POST['username'];
            $this->user->password = (string) $_POST['password'];

            if ($this->user->register()) {
                header("Location: index.php?action=login");
                exit;
            }
        }

        include 'views/user/user_register.php';
    }

    public function login()
    {
        if ($_POST) {
            $this->user->username = (string) $_POST['username'];
            $this->user->password = (string) $_POST['password'];

            if ($this->user->login()) {
                header("Location: index.php?action=login");
                exit;
            } else {
                header("Location: index.php?action=login");
                exit;
            }
        }

        include 'views/user/user_login.php';
    }
}
