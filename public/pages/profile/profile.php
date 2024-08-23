<?php
include 'app/components/input-group.php';
include 'app/components/button-form.php';
?>

<div>
    <?php include(BASE_PATH . '/app/components/header-loged.php'); ?>
</div>
<div class="container-profile">
    <div class="content-profile">
        <form id="form-profile">
            <div class="header-form">
                <div class="profile-photo">
                    <?php
                    echo buttonForm('', 'button', 'btn btn-profile-photo', ['id' => 'saveButton'], 'public/svg/icon-photo.svg');
                    ?>
                </div>
                <h3>Maria Angélica Oliveira</h3>
                <p>Corretora</p>
            </div>
            <div class="body-form">
                <div class="inputs-left">
                    <?php
                    echo inputGroup('Nome completo', 'nome_completo', 'nome_completo', '', 'Digite seu nome completo', ['required' => 'true'], '');
                    echo inputGroup('Telefone', 'telefone', 'telefone', '', 'Digite seu telefone', ['required' => 'true'], '');
                    echo inputGroup('Empresa', 'empresa', 'empresa', '', 'Digite seu empresa', ['required' => 'true'], '');
                    ?>
                </div>
                <div class="inputs-right">
                    <?php
                    echo inputGroup('Email', 'email', 'email', '', 'Digite seu email', ['required' => 'true'], '');
                    echo inputGroup('CPF', 'cpf', 'cpf', '', 'Digite seu CPF', ['required' => 'true'], '');
                    echo inputGroup('Endereço', 'endereco', 'endereco', '', 'Digite seu endereco', ['required' => 'true'], '');
                    ?>
                </div>
            </div>
            <div class="footer-form">
                <?php
                echo buttonForm('Atualizar cadastro', 'submit', 'btn btn-submit', ['id' => 'saveButton'], '');
                ?>
            </div>
        </form>
    </div>
</div>