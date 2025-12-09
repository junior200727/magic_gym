<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nome'], $data['cpf'], $data['email'], $data['modalidade'], $data['horario'])) {
    $stmt = $pdo->prepare("INSERT INTO matriculas (nome, cpf, email, modalidade, horario) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$data['nome'], $data['cpf'], $data['email'], $data['modalidade'], $data['horario']])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar matrícula.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
}
?>