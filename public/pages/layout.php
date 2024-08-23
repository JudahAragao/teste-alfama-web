<?php
// Inclua o arquivo com as funções
include(BASE_PATH . '/app/includes/functions.php');

// Obtendo a ação a partir do parâmetro da URL
$action = getAction();

// Verifique se a ação é uma string vazia
if (empty($action)) {
    header('Location: http://teste_alfama_web.local/?action=login');
    exit;
}

// Obtenha o título correspondente
$title = getTitle($action);

// Inclua o arquivo da página correspondente
$pageFile = BASE_PATH . '/public/pages/' . $action . '/' . $action . '.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="icon" type="image/gif" href="/public/gif/favicon.gif">
    <link rel="stylesheet" href="/public/css/globals.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Link para css dinamico... muda conforme a action -->
    <link rel="stylesheet" href="/public/pages/<?php echo htmlspecialchars($action); ?>/<?php echo htmlspecialchars($action); ?>.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid">
    <div class="alert" id="alert" role="alert"></div>
        <?php
        if (file_exists($pageFile)) {
            include($pageFile);
        } else {
            echo '<h1>Página não encontrada.</h1>';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>