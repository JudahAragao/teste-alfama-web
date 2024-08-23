<?php
include 'app/components/input-group.php';
include 'app/components/button-form.php';
?>

<div class="d-flex m-0">
    <div class="col-form">
        <div>
            <?php include(BASE_PATH . '/app/components/header-login-register.php'); ?>
        </div>
        <div class="container-form">
            <div class="content-form">
                <h1> Criar conta </h1>

                <?php
                echo buttonForm('Entrar com a conta Google', 'button', 'btn btn-google', ['id' => 'googleButton'], 'public/svg/icon-google.svg');
                ?>

                <div class="hr-with-text">
                    <span>ou</span>
                </div>

                <form id="form-register">
                    <?php
                    echo inputGroup('Nome completo', 'nome_completo', 'nome_completo', '', 'Digite seu nome completo', ['required' => 'true'],'');
                    echo inputGroup('Email', 'email', 'email', '', 'Digite seu email', ['required' => 'true'],'');
                    echo inputGroup('Senha', 'password', 'senha', '', 'Insira sua senha', ['required' => 'true'],'Inserir mais de 8 caracteres');
                    echo buttonForm('Criar conta', 'submit', 'btn btn-submit', ['id' => 'saveButton'], '');
                    ?>
                </form>
                <a href="http://teste_alfama_web.local/?action=login">
                    <p> Ja tem uma conta? <span class="underline">Faça login</span> </p>
                </a>
            </div>
        </div>
    </div>


    <div class="col-banner">
        <?php include(BASE_PATH . '/app/components/banner-login-register.php'); ?>
    </div>
</div>