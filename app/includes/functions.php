<?php

// Formular Título de acordo com a rota
function getTitle($action)
{
    $defaultRoute = 'Home';
    $prefixTitle = 'AlfamaWeb | ';
    $defaultTitle = $prefixTitle . $defaultRoute; // Para caso existice uma home

    switch ($action) {
        case 'login':
            return $prefixTitle . 'Login';
        case 'register':
            return $prefixTitle . 'Cadastro';
        case 'profile':
            return $prefixTitle . 'Perfil';
        case '404':
            return $prefixTitle . '404 Not Found';
        default:
            header('Location: http://teste_alfama_web.local/?action=404');
            return $defaultTitle;
    }
}


function getAction()
{
    return $_GET['action'] ?? '';
}
