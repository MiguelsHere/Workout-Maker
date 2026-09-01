<?php
session_start();
include_once 'controllers/UserController.php';

$userController = new UserController();

$action = $_GET['action'] ?? 'register';

switch ($action) {
    case 'login':
        $userController->login();
        break;
    default:
    case 'register':
        $userController->register();
        break;
}
