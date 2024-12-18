<?php
require '../models/user.php';
require '../controllers/registerController.php';

$pdo = new PDO('mysql:host=localhost;dbname=sae_manager', 'root', 'root');

$userModel = new User($pdo);
$registerController = new RegisterController($userModel);

$action = $_GET['action'] ?? 'register';

switch ($action) {
    case 'register':
        $registerController->inscription();
        break;
    case 'success':
        echo "<h1>Inscription réussie !</h1>";
        break;
    default:
        echo "<h1>Page introuvable</h1>";
}
