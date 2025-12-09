<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nome'], $data['email'], $data['senha'])) {
    $nome = $data['nome'];
    $email = strtolower(trim($data['email']));
    $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT);

    // Verificar se email já existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'E-mail já cadastrado.']);
        exit;
    }

    // Inserir
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $email, $senhaHash])) {
        session_start();
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_email'] = $email;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
}
?>