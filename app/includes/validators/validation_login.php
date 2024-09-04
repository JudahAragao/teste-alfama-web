<?php

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

function validateDataLogin($data)
{

    // Validação básica
    if (empty($data['email']) && empty($data['senha'])) {
        $response['status'] = 'error';
        $response['message'] = 'Todos os campos são obrigatórios!';
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

    // Validação de Senha
    if (empty($data['senha'])) {
        $response['status'] = 'error';
		$response['message'] = 'Senha Obrigatória!';
        echo json_encode($response);
        exit;
    }
}
