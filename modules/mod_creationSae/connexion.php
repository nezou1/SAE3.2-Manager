<?php
$host = 'database-etudiants.iut.univ-paris8.fr';
$dbname = 'dutinfopw201629';
$username = 'dutinfopw201629';
$password = 'nedyjunu';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
