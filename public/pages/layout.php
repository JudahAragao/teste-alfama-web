<?php
// Inclua o arquivo com as funções
include(BASE_PATH . '/includes/functions.php');

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

</head>
<body>
    <?php
        if (file_exists($pageFile)) {
            include($pageFile);
        } else {
            echo '<h1>Página não encontrada.</h1>';
        }
    ?>
</body>
</html>
