<?php
session_start();

include_once 'controllers/UserController.php';
include_once 'controllers/WorkoutController.php';

$userController = new UserController();
$workoutController = new WorkoutController();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'list-workout':
        $workoutController->list();
        break;
    case 'create':
        $workoutController->create();
        break;
    case 'list-user':
        $userController->list();
        break;
    case 'new-password':
        $userController->newPassword();
        break;
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
