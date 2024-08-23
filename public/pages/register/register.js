// $(document).ready(function () {
//     $('#form-register').submit(function (event) {
//         event.preventDefault(); // Evita o envio padrão do formulário

//         var formData = new FormData(this);

//         $.ajax({
//             url: 'router.php',
//             type: 'POST',
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function (data) {
//                 try {
//                     if (data.status === 'success') {
//                         alert('Formulário enviado com sucesso!');
//                         $('#form-register')[0].reset(); // Limpa o formulário
//                     } else {
//                         // Limpa mensagens de erro anteriores
//                         $('#nameError').text('');
//                         $('#emailError').text('');
//                         $('#passwordError').text('');

//                         // Exibe mensagens de erro
//                         if (data.errors && data.errors.nome_completo) {
//                             $('#nameError').text(data.errors.nome_completo);
//                         }
//                         if (data.errors && data.errors.email) {
//                             $('#emailError').text(data.errors.email);
//                         }
//                         if (data.errors && data.errors.senha) {
//                             $('#passwordError').text(data.errors.senha);
//                         }
//                     }
//                 } catch (e) {
//                     console.error('Erro ao processar a resposta:', e);
//                 }
//             },
//             error: function (jqXHR, textStatus, errorThrown) {
//                 console.error('Erro:', textStatus, errorThrown);
//                 console.log('Resposta do servidor:', jqXHR.responseText); // Adicione isto para ver a resposta crua
//             },
//             dataType: 'json' // Use json para que jQuery faça o parsing automático
//         });
//     });
// });
