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

    public function home(): void
    {
        include_once 'views/home.php';
    }

    public function list(): void
    {
        if ($_SESSION['user_id'] == 1) {

            if ($this->user->listAll()) {
                $workouts = $this->user->listAll();
            }
        } else {
            if ($this->user->listPublic()) {
                $workouts = $this->user->listAll();
            }
        }

        include 'views/user/user_list';
    }

    public function register(): void
    {
        if (empty($_SESSION['user_id'])) {
            if (isset($_POST['user_name']) & isset($_SESSION['password'])) {
                $this->user->userName = $_POST['user_name'];
                $this->user->password = $_POST['password'];

                if ($this->user->register()) {
                    header("Location: index.php?action=login");
                    exit;
                }
                header("Location: index.php?action=register");
                exit;
            }
        } else {
            header("Location: index.php");
            exit;
        }

        include 'views/user/user_register.php';
    }

    public function login(): void
    {
        if (empty($_SESSION['user_id'])) {
            if (!empty($_POST['user_name']) & !empty($_SESSION['password'])) {
                $this->user->userName = $_POST['user_name'];
                $this->user->password = $_POST['password'];

                if ($this->user->login()) {
                    header("Location: index.php?action=update");
                    exit;
                }
                header("Location: index.php?action=login");
                exit;
            }
        } else {
            header("Location: index.php");
            exit;
        }


        include 'views/user/user_login.php';
    }

    public function newPassword(): void
    {

        if ($_SESSION['user_id']) {
            $this->user->userId = (int) $_SESSION['user_id'];

            if (!empty($_POST['password']) & !empty($_SESSION['new_password'])) {
                $this->user->password = $_POST['password'];
                $this->user->newPassword = $_POST['new_password'];

                if ($this->user->newPassword()) {
                    header("Location: index.php?action=new-password");
                    exit;
                }
            }
        } else {
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/user/user_password.php';
    }

    public function update(): void
    {
        if ($_SESSION['user_id']) {
            $this->user->userId = (int) $_SESSION['user_id'];

            if ($_POST) {
                $this->user->userDescription = $_POST['user_description'];
                $this->user->birthDate = $_POST['birth_date'];
                $this->user->heightCm = (float) $_POST['height_cm'];
                $this->user->weightKg = (float) $_POST['weight_kg'];

                if ($this->user->update()) {
                    header("Location: index.php?action=update");
                    exit;
                }
            }
        } else {
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/user/user_profile.php';
    }

    public function signOut(): void
    {
        if ($_SESSION['user_id']) {
            if ($this->user->signOut()) {
                header("Location: index.php");
            }
        }
    }
}
