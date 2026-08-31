<?php
include_once 'controllers/UserController.php';

$userController = new UserController();

$action = $_GET['action'];

switch ($action) {
    default:
    case 'register':
        $userController->register();
        break;
}
