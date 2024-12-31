<?php
require '../models/user.php';
require '../controllers/registerController.php';
require '../controllers/loginController.php';
require '../controllers/ForgotPasswordController.php';


$pdo = new PDO('mysql:host=localhost;dbname=sae_manager', 'root', 'root');

$userModel = new User($pdo);
$registerController = new RegisterController($userModel);
$loginController = new loginController($userModel);
$forgotPasswordController = new ForgotPasswordController($userModel);

$action = $_GET['action'] ?? 'register';

switch ($action) {
    case 'register':
        $registerController->inscription();
        break;
    case 'success':
        $loginController->login();
        break;
    case 'login':
        $loginController->login();
        break;
    case 'logout':
        $loginController->logout();
        break;
    case 'forgot_password':
        $forgotPasswordController->handleRequest();
        break;
    case 'dashboard':
        require '../views/dashboard.php';
        break;
    default:
        echo "<h1>Page introuvable</h1>";
}
