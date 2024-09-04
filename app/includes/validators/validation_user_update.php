<?php

require_once 'validation_cpf.php';
require_once 'validation_telefone.php';

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

function validateDataUserUpdate($data)
{

    // Validação básica
    if (empty($data['nome_completo']) && empty($data['email']))  {
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

    if (!empty($data['telefone']) && !validarTelefone($data['telefone'])) {
        $response['status'] = 'error';
        $response['message'] = 'Telefone inválido!';
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
    }

    if (!empty($data['cpf']) && !validarCPF($data['cpf'])) {
        $response['status'] = 'error';
        $response['message'] = 'CPF inválido!';
        echo json_encode($response);
        exit;
    }
}
