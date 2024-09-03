<?php
require_once 'connect.php';

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

function validateDataRegister($data)
{

    $db = new Database();
    $conn = $db->connect();

    // Validação básica
    if (empty($data['nome_completo']) && empty($data['email']) && empty($data['senha'])) {
        $response['status'] = 'error';
        $response['message'] = 'Todos os campos são obrigatórios!';
        echo json_encode($response);
        exit;
    }

    // Validação de Nome Completo
    if (empty($data['nome_completo'])) {
        $response['status'] = 'error';
        $response['message'] = 'Nome Completo Obrigatório!';
        echo json_encode($response);
        exit;
    }

    // Validação de E-mail
    if (empty($data['email'])) {
        $response['status'] = 'error';
        $response['message'] = 'E-mail Obrigatório!';
        echo json_encode($response);
        exit;
    } else {
        $emailValidator = new EmailValidator();
        if (!$emailValidator->isValid($data['email'], new RFCValidation())) {
            $response['status'] = 'error';
            $response['message'] = 'E-mail Inválido!';
            echo json_encode($response);
            exit;
        }

        // Verificar se o e-mail já está em uso
        $query = 'SELECT id FROM tb_user WHERE email = :email';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $data['email']);
        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $response['status'] = 'error';
            $response['message'] = 'E-mail já está em uso!';
            echo json_encode($response);
            exit;
        }
    }

    // Validação de Senha
    if (empty($data['senha'])) {
        $response['status'] = 'error';
        $response['message'] = 'Senha Obrigatória!';
        echo json_encode($response);
        exit;
    }
}
