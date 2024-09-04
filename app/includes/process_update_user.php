<?php
header('Content-Type: application/json');
require_once 'connect.php';
require_once './validators/validation_user_update.php';
require_once '../src/User/UserGet.php';
require_once '../src/User/UserUpdate.php';

$response = [];

try {
    $db = new Database();
    $conn = $db->connect();

    // Checar conexão com banco de dados
    if (!$conn) {
        $response['status'] = 'error';
        $response['message'] = 'Não foi possível conectar ao banco de dados!';
        echo json_encode($response);
        exit;
    }

    // Verifica se o ID do usuário foi passado
    $userId = $_POST['id'] ?? null;
    if (!$userId) {
        $response['status'] = 'error';
        $response['message'] = 'ID do usuário não fornecido!';
        echo json_encode($response);
        exit;
    }

    // Instancia as classes
    $userGet = new UserGet($conn);
    $userUpdate = new UserUpdate($conn);

    // Pega os dados do usuário para exibição no formulário
    $user = $userGet->getUserById($userId);

    // Recebe os dados do formulário e atualiza o usuário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'id' => $userId,
            'nome_completo' => trim($_POST['nome_completo'] ?? $user['nome_completo']),
            'funcao' => trim($_POST['funcao'] ?? $user['funcao']),
            'telefone' => trim($_POST['telefone'] ?? $user['telefone']),
            'email' => trim($_POST['email'] ?? $user['email']),
            'empresa' => trim($_POST['empresa'] ?? $user['empresa']),
            'cpf' => trim($_POST['cpf'] ?? $user['cpf']),
            'endereco' => trim($_POST['endereco'] ?? $user['endereco'])
        ];

        // Validação
        validateDataUserUpdate($data);

        // Chama o método de atualização
        $response = $userUpdate->updateUser($data);
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
