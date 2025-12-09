<?php
require 'db.php';
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['email'], $data['senha'])) {
    $email = strtolower(trim($data['email']));
    $senha = $data['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_nome'] = $user['nome'];
        echo json_encode(['success' => true, 'email' => $user['email'], 'nome' => $user['nome']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'E-mail ou senha incorretos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos.']);
}
?>