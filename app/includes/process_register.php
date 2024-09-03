<?php
header('Content-Type: application/json');
require_once 'connect.php';
require_once './validators/validation_register.php';

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
        'nome_completo' => trim($_POST["nome_completo"] ?? ''),
        'email' => trim($_POST["email"] ?? ''),
        'senha' => trim($_POST["senha"] ?? ''),
    ];

    // Validação
    validateDataRegister($data);

    // Hash da senha com bcrypt
    $hashedPassword = password_hash($data['senha'], PASSWORD_BCRYPT);
    
    $query = 'INSERT INTO tb_user (nome_completo, email, senha) VALUES (:nome_completo, :email, :senha)';
    $stmt = $conn->prepare($query);
    
    $stmt->bindParam(':nome_completo', $data['nome_completo']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':senha', $hashedPassword);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Cadastro realizado com sucesso. <br/> Vá para a página de login!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Erro ao inserir os dados.';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response);
