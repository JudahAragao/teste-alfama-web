<?php 

function validarTelefone($telefone) 
{
    // Expressão regular para validar números de telefone
    $regex = '/^(\+\d{1,3}\s?)?(\(?\d{2}\)?[\s.-]?)\d{4,5}[\s.-]?\d{4}$/';

    return preg_match($regex, $telefone);
}