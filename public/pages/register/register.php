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
                <h1> Criar conta </h1>

                <?php
                echo buttonForm('Entrar com a conta Google', 'button', 'btn btn-google', ['id' => 'googleButton'], 'public/svg/icon-google.svg');
                ?>

                <div class="hr-with-text">
                    <span>ou</span>
                </div>

                <form id="form-register">
                    <?php
                    echo inputGroup('Nome completo', 'nome_completo', 'nome_completo', '', 'Digite seu nome completo', ['required' => 'true'], '');
                    echo inputGroup('Email', 'email', 'email', '', 'Digite seu email', ['required' => 'true'], '');
                    echo inputGroup('Senha', 'password', 'senha', '', 'Insira sua senha', ['required' => 'true'], 'Inserir mais de 8 caracteres');
                    echo buttonForm('Criar conta', 'submit', 'btn btn-submit', ['id' => 'submitRegister'], '');
                    ?>
                </form>
                <a href="http://teste_alfama_web.local/?action=login">
                    <p> Ja tem uma conta? <span class="underline">Faça login</span> </p>
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(() => {
            $('#submitRegister').click((event) => {
                event.preventDefault();

                var nome_completo = $('#nome_completo').val();
                var email = $('#email').val();
                var senha = $('#senha').val();

                $('#alert').removeClass("alert-danger alert-success vibrate").hide();

                $.ajax({
                    url: 'http://teste_alfama_web.local/app/includes/process_register.php',
                    method: 'POST',
                    data: {
                        nome_completo,
                        email,
                        senha
                    },
                    dataType: 'json',
                    success: (result) => {
                        if (result.status === 'success') {
                            $('#form-register').trigger("reset");
                            $('#alert').removeClass("alert-danger").addClass("alert-success").text(result.message).fadeIn();
                        } else {
                            $('#alert').removeClass("alert-success").addClass("alert-danger vibrate").text(result.message).fadeIn();
                        }
                        setTimeout(() => {
                            $('#alert').fadeOut('Slow');
                        }, 5000);
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        $('#alert').html('Erro ao processar a requisição.').addClass("alert-danger vibrate").fadeIn();
                        setTimeout(() => {
                            $('#alert').fadeOut('Slow');
                        }, 5000);
                    }
                });
            });
        });
    </script>

    <div class="col-banner">
        <?php include(BASE_PATH . '/app/components/banner-login-register.php'); ?>
    </div>
</div>