<?php
session_start();
include_once 'controllers/UserController.php';

$userController = new UserController();

$action = $_GET['action'] ?? 'home';

switch ($action) {

    case 'login':
        $userController->login();
        break;
    case 'register':
        $userController->register();
        break;
    case 'update':
        $userController->update();
        break;
    case 'sign-out':
        $userController->signOut();
        break;
    default:
    case 'home':
        $userController->home();
        break;
}
