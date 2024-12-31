<?php
require '../models/user.php';
require '../controllers/registerController.php';
require '../controllers/loginController.php';

$pdo = new PDO('mysql:host=localhost;dbname=sae_manager', 'root', 'root');

$userModel = new User($pdo);
$registerController = new RegisterController($userModel);
$loginController = new loginController($userModel);

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
    case 'dashboard':
        echo "<h1>Bienvenue dans le tableau de bord</h1>";
        break;
    default:
        echo "<h1>Page introuvable</h1>";
}
