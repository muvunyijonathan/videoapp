<?php
$host = 'sql306.iceiy.com';
$dbname = 'icei_39302709_videochat';
$user = 'icei_39302709';
$pass = '1234567890'; // Ton mot de passe de connexion à VistaPanel

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}
?>
