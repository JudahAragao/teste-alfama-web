<?php

function validarCPF($cpf)
{
    // Remove caracteres não numéricos
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

    // CPF deve ter exatamente 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    // Calcula e valida o primeiro dígito verificador
    if (!validarDigito($cpf, 9)) {
        return false;
    }

    // Calcula e valida o segundo dígito verificador
    return validarDigito($cpf, 10);
}

function validarDigito($cpf, $posicao)
{
    $sum = 0;
    for ($i = 0; $i < $posicao; $i++) {
        $sum += $cpf[$i] * ($posicao + 1 - $i);
    }

    $remainder = $sum % 11;
    $digit = $remainder < 2 ? 0 : 11 - $remainder;

    return $cpf[$posicao] == $digit;
}