<?php
session_start();
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destrói a sessão

$response = [
    'status' => 'success',
    'message' => 'Logout realizado com sucesso.'
];

header('Content-Type: application/json');
echo json_encode($response);
exit();
