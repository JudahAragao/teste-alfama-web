<?php
include 'input-group.php'; // Caminho correto para o arquivo input-group.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_completo = htmlspecialchars(trim($_POST['nome_completo'] ?? ''));
    $telefone = htmlspecialchars(trim($_POST['telefone'] ?? ''));
    $empresa = htmlspecialchars(trim($_POST['empresa'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $cpf = htmlspecialchars(trim($_POST['cpf'] ?? ''));
    $endereco = htmlspecialchars(trim($_POST['endereco'] ?? ''));
?>
    <div class="inputs-left">
        <?php
        echo inputGroup('Nome completo', 'nome_completo', 'nome_completo', $nome_completo, 'Digite seu nome completo', ['required' => 'true'], '');
        echo inputGroup('Telefone', 'telefone', 'telefone', $telefone, 'Digite seu telefone', ['required' => 'true'], '');
        echo inputGroup('Empresa', 'empresa', 'empresa', $empresa, 'Digite sua empresa', ['required' => 'true'], '');
        ?>
    </div>
    <div class="inputs-right">
        <?php
        echo inputGroup('Email', 'email', 'email', $email, 'Digite seu email', ['required' => 'true'], '');
        echo inputGroup('CPF', 'cpf', 'cpf', $cpf, 'Digite seu CPF', ['required' => 'true'], '');
        echo inputGroup('Endereço', 'endereco', 'endereco', $endereco, 'Digite seu endereço', ['required' => 'true'], '');
        ?>
    </div>
<?php
}
?>