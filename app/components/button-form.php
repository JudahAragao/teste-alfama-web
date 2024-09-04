<?php
function buttonForm($text = 'Enviar', $type = 'button', $class = 'btn btn-primary', $attributes = [], $svgIconPath = '') {
    // Inicia a tag do botão
    $button = "<button type=\"$type\" class=\"$class\"";

    // Adiciona os atributos adicionais
    foreach ($attributes as $key => $val) {
        $button .= " $key=\"$val\"";
    }

    // Fecha a tag de abertura do botão
    $button .= ">";

    // Adiciona o SVG se o caminho for fornecido e o arquivo existir
    if (!empty($svgIconPath) && file_exists($svgIconPath)) {
        $button .= "<img src=\"$svgIconPath\" alt=\"icon\" class=\"me-2\" style=\"width: 16px; height: 16px;\">";
    }

    // Fecha a tag do botão e insere o texto
    $button .= "$text</button>\n";

    // Retorna o HTML do botão
    return $button;
}
?>
