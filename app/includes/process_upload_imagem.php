<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'connect.php'; // Inclua seu script de conexão com o banco de dados
require_once '../src/User/UserImageUpdate.php';

$response = [];

try {
    $db = new Database();
    $conn = $db->connect(); // Conexão PDO com o banco de dados

    if (!$conn) {
        $response['status'] = 'error';
        $response['message'] = 'Não foi possível conectar ao banco de dados!';
        echo json_encode($response);
        exit;
    }

    $userImageUpdate = new UserImageUpdate($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Verifica se o usuário está autenticado
        session_start();
        if (!isset($_SESSION['user_id'])) {
            $response['status'] = 'error';
            $response['message'] = 'Usuário não autenticado.';
            echo json_encode($response);
            exit;
        }

        // Verifica se o arquivo foi enviado
        if (!isset($_FILES['foto_perfil']) || $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_OK) {
            $response['status'] = 'error';
            $response['message'] = 'Nenhum arquivo enviado ou erro no upload.';
            echo json_encode($response);
            exit;
        }

        // Recebe e valida o arquivo
        $fileTmpPath = $_FILES['foto_perfil']['tmp_name'];
        $fileData = file_get_contents($fileTmpPath);
        $fileSize = $_FILES['foto_perfil']['size'];
        $imageFileType = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));

        // Verifica se o arquivo é uma imagem real
        $check = getimagesize($fileTmpPath);
        if ($check === false) {
            $response['status'] = 'error';
            $response['message'] = 'O arquivo não é uma imagem.';
            echo json_encode($response);
            exit;
        }

        // Limita o tamanho do arquivo
        if ($fileSize > 500000) { // 500KB
            $response['status'] = 'error';
            $response['message'] = 'Desculpe, o arquivo é muito grande.';
            echo json_encode($response);
            exit;
        }

        // Limita os formatos de arquivo permitidos
        if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
            $response['status'] = 'error';
            $response['message'] = 'Desculpe, apenas arquivos JPG, JPEG, PNG & GIF são permitidos.';
            echo json_encode($response);
            exit;
        }

        // Chama o método de atualização
        $response = $userImageUpdate->updateUserImage($fileData);
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response);
