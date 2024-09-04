<?php
header('Content-Type: application/json');
require_once 'connect.php';
require_once './validators/validation_register.php';
require_once '../src/User/UserRegister.php';

$response = [];

try {
    $db = new Database();
    $conn = $db->connect(); // Agora $conn é uma conexão PDO válida

    // Checar conexão com banco de dados
    if (!$conn) {
        $response['status'] = 'error';
        $response['message'] = 'Não foi possível conectar ao banco de dados!';
        echo json_encode($response);
        exit;
    }

    $userRegistration = new UserRegistration($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebimento dos dados
        $data = [
            'nome_completo' => trim($_POST["nome_completo"] ?? ''),
            'email' => trim($_POST["email"] ?? ''),
            'senha' => trim($_POST["senha"] ?? ''),
        ];

        // Validação
        validateDataRegister($data);


        $response = $userRegistration->register($data);
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response);
