<?php
session_start();
header('Content-Type: application/json');
require_once 'connect.php';
require_once './validators/validation_login.php';

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

    // Recebimento dos dados
    $data = [
        'email' => trim($_POST["email"] ?? ''),
        'senha' => trim($_POST["senha"] ?? ''),
    ];

    // Validação
    validateDataLogin($data);

    // Verificação das credenciais
    $query = 'SELECT id, senha FROM tb_user WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $data['email']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($data['senha'], $user['senha'])) {
        // Credenciais válidas, cria a sessão
        $_SESSION['user_id'] = $user['id'];
        $response['status'] = 'success';
        $response['message'] = 'Login realizado com sucesso!';
        $response['redirect'] = 'http://teste_alfama_web.local/?action=profile'; // Redireciona para a página de perfil
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Credenciais inválidas!';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response);
