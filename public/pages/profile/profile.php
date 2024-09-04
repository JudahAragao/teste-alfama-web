<?php
session_start();
include 'app/components/input-group.php';
include 'app/components/button-form.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: http://teste_alfama_web.local/?action=login'); // Redireciona para a página de login se não estiver autenticado
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<div>
    <?php include(BASE_PATH . '/app/components/header-loged.php'); ?>
</div>

<div class="container-profile">
    <div class="content-profile">
        <form id="form-profile">
            <div class="header-form">
                <div class="container-profile-photo">
                    <div class="profile-photo" id="profilePhoto">
                        <input type="file" id="foto_perfil" accept=".jpg,.jpeg,.png,.gif" style="display: none;" name="foto_perfil">
                    </div>
                    <label for="foto_perfil" class="btn btn-profile-photo">
                        <img id="profileImage" src="public/svg/icon-photo.svg" alt="Foto de Perfil">
                    </label>
                </div>
                <h3 id="nome_completo_title"></h3>
                <div class="funcao-container" style="display: flex; justify-content: center; align-items: center; margin-top: 6px;">
                    <input type="text" id="funcaoInput" value="" style="display: none; margin-right: 6px;" class="form-control" name="funcao">
                    <p id="funcaoText" style="margin-right: 6px;">Inserir cargo / função!</p>
                    <button id="editFuncao" type="button" class="btn btn-light">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </div>
            </div>
            <div class="body-form">
                <div class="inputs-left">
                    <?php
                    echo inputGroup('Nome completo', 'nome_completo', 'nome_completo', '', 'Digite seu nome completo', ['required' => 'true'], '');
                    echo inputGroup('Telefone', 'telefone', 'telefone', '', 'Digite seu telefone', [], '');
                    echo inputGroup('Empresa', 'empresa', 'empresa', '', 'Digite seu empresa', [], '');
                    ?>
                </div>
                <div class="inputs-right">
                    <?php
                    echo inputGroup('Email', 'email', 'email', '', 'Digite seu email', ['required' => 'true'], '');
                    echo inputGroup('CPF', 'cpf', 'cpf', '', 'Digite seu CPF', [], '');
                    echo inputGroup('Endereço', 'endereco', 'endereco', '', 'Digite seu endereco', [], '');
                    ?>
                </div>
            </div>
            <div class="footer-form">
                <?php
                echo buttonForm('Atualizar cadastro', 'submit', 'btn btn-submit', ['id' => 'submitSave'], '');
                ?>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {

            var userId = <?php echo json_encode($user_id); ?>;

            if (userId) {
                // Carrega os dados do usuário ao carregar a página
                $.ajax({
                    url: 'http://teste_alfama_web.local/app/includes/process_get_user.php', // Substitua pelo caminho correto do seu script PHP
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            alert(response.message);
                        } else {
                            const user = response.user;

                            // Preenche os campos com os dados do usuário
                            $('#funcaoText').text(user.funcao || 'Inserir cargo / função!');
                            $('#funcaoInput').val(user.funcao);
                            $('#nome_completo').val(user.nome_completo);
                            $('#nome_completo_title').text(user.nome_completo);
                            $('#email').val(user.email);
                            $('#telefone').val(user.telefone);
                            $('#cpf').val(user.cpf);
                            $('#empresa').val(user.empresa);
                            $('#endereco').val(user.endereco);

                            // Preenche a foto de perfil como background, se existir
                            if (user.foto_perfil) {
                                $('#profilePhoto').css('background-image', 'url("data:image/jpeg;base64,' + user.foto_perfil + '")');
                            }
                        }
                    },
                    error: function() {
                        alert('Erro ao carregar os dados do usuário.');
                    }
                });
            }

            // Função para enviar o arquivo via AJAX quando o input muda
            $('#foto_perfil').change(function() {
                var fileInput = $(this)[0];
                var formData = new FormData();

                if (fileInput.files.length > 0) {
                    formData.append('foto_perfil', fileInput.files[0]);

                    $.ajax({
                        url: 'http://teste_alfama_web.local/app/includes/process_upload_imagem.php',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
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
                            $('#alert').text('Erro ao processar a requisição.').addClass("alert-danger vibrate").fadeIn();
                            setTimeout(() => {
                                $('#alert').fadeOut('Slow');
                            }, 5000);
                        }
                    });
                }
            });

            $('#submitSave').click((event) => {
                event.preventDefault();

                var funcao = $('#funcaoInput').val();
                var nome_completo = $('#nome_completo').val();
                var email = $('#email').val();
                var telefone = $('#telefone').val();
                var cpf = $('#cpf').val();
                var empresa = $('#empresa').val();
                var endereco = $('#endereco').val();

                $('#alert').removeClass("alert-danger alert-success vibrate").hide();

                $.ajax({
                    url: 'http://teste_alfama_web.local/app/includes/process_update_user.php',
                    method: 'POST',
                    data: {
                        id: userId,
                        funcao,
                        nome_completo,
                        email,
                        telefone,
                        cpf,
                        empresa,
                        endereco
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
                        $('#alert').text('Erro ao processar a requisição.').addClass("alert-danger vibrate").fadeIn();
                        setTimeout(() => {
                            $('#alert').fadeOut('Slow');
                        }, 5000);
                    }
                });
            });

            // Quando o botão de editar função é clicado
            $('#editFuncao').click(function() {
                // Alterna entre mostrar e esconder o input e o texto
                $('#funcaoInput').toggle(); // Alterna a visibilidade do input
                $('#funcaoText').toggle(); // Alterna a visibilidade do texto
            });

            // Função para exibir a pré-visualização da imagem
            $('#foto_perfil').change(function() {
                var file = $(this)[0].files[0];
                if (file) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Define a imagem como background da div
                        $('#profilePhoto').css('background-image', 'url(' + e.target.result + ')');
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</div>