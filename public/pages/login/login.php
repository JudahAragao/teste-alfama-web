<?php
session_start();
include 'app/components/input-group.php';
include 'app/components/button-form.php';

// Verifica se o usuário está autenticado
if (isset($_SESSION['user_id'])) {
    header('Location: http://teste_alfama_web.local/?action=profile'); // Redireciona para a página de login se não estiver autenticado
    exit;
}
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
                    echo inputGroup('Email', 'email', 'email', '', 'Digite seu email', ['required' => 'true'], '', 'emailError');
                    echo inputGroup('Senha', 'password', 'senha', '', 'Insira sua senha', ['required' => 'true'], '', 'passwordError');

                    ?>
                    <a href="">
                        <p class="contrast">Esqueceu sua senha?</p>
                    </a>
                    <?php

                    echo buttonForm('Entrar', 'submit', 'btn btn-submit', ['id' => 'submitLogin'], '');
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

    <script type="text/javascript">
        $(document).ready(() => {
            $('#submitLogin').click((event) => {
                event.preventDefault();

                var email = $('#email').val();
                var senha = $('#senha').val();

                $('#alert').removeClass("alert-danger alert-success vibrate").hide();

                $.ajax({
                    url: 'http://teste_alfama_web.local/app/includes/process_login.php',
                    method: 'POST',
                    data: {
                        email,
                        senha
                    },
                    dataType: 'json',
                    success: (result) => {
                        if (result.status === 'success') {
                            window.location.href = result.redirect; // Redireciona para a página de perfil
                        } else {
                            $('#alert').removeClass("alert-success").addClass("alert-danger vibrate").html(result.message).fadeIn();
                        }
                        setTimeout(() => {
                            $('#alert').fadeOut('Slow');
                        }, 3000);
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        $('#alert').html('Erro ao processar a requisição.').addClass("alert-danger vibrate").fadeIn();
                        setTimeout(() => {
                            $('#alert').fadeOut('Slow');
                        }, 3000);
                    }
                });
            });
        });
    </script>

    <div class="col-banner">
        <?php include(BASE_PATH . '/app/components/banner-login-register.php'); ?>
    </div>
</div>