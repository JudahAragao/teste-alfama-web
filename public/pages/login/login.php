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
                <h1> Fazer login </h1>

                <a href="http://teste_alfama_web.local/?action=register">
                    <p> Nova conta? <span>Cadastre-se gratuitamente</span> </p>
                </a>

                <form id="form-login">
                    <?php
                    echo inputGroup('Email', 'email', 'email', '', 'Digite seu email', ['required' => 'true'],'');
                    echo inputGroup('Senha', 'password', 'senha', '', 'Insira sua senha', ['required' => 'true'],'');

                    ?>
                    <a href="">
                        <p class="contrast">Esqueceu sua senha?</p>
                    </a>
                    <?php

                    echo buttonForm('Entrar', 'submit', 'btn btn-submit', ['id' => 'saveButton'], '');
                    ?>
                </form>
                <?php
                echo buttonForm('Entrar com a conta Google', 'button', 'btn btn-google', ['id' => 'googleButton'], 'public/svg/icon-google.svg');
                ?>
            </div>
        </div>
        <div class="footer-form">
            <a href="https://alfamaweb.com/politica-privacidade" target="_blank" rel="noopener noreferrer">Política de Privacidade</a>
        </div>
    </div>


    <div class="col-banner">
        <?php include(BASE_PATH . '/app/components/banner-login-register.php'); ?>
    </div>
</div>