<?php
// Configurações do banco
$host = 'localhost';
$db   = 'magic_gym';
$user = 'root';
$pass = ''; // Geralmente vazio no XAMPP, ou 'root' no MAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>