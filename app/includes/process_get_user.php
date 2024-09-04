<?php
header('Content-Type: application/json');
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

require_once 'connect.php'; // Caminho corrigido
require_once '../src/User/UserGet.php';

try {
    $db = new Database();
    $conn = $db->connect();

    if (!$conn) {
        throw new Exception("Falha na conexão com o banco de dados.");
    }

    $userId = $_SESSION['user_id'];
    $userGet = new UserGet($conn);
    $user = $userGet->getUserById($userId);

    if ($user) {
        // Converte o BLOB da imagem de perfil para Base64
        if ($user['foto_perfil']) {
            $user['foto_perfil'] = base64_encode($user['foto_perfil']);
        }

        $response['error'] = false;
        $response['user'] = $user;
    } else {
        $response['error'] = true;
        $response['message'] = 'Usuário não encontrado.';
    }

    // Retorna os dados do usuário em formato JSON
    echo json_encode(['error' => false, 'user' => $user]);
} catch (Exception $e) {
    echo json_encode(['error' => true, 'message' => $e->getMessage()]);
    exit;
}
