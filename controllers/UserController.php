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
                header("Location: index.php");
                exit;
            }
        }

        include 'views/user/user_register.php';
    }
}
