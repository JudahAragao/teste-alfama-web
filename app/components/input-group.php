<?php
function inputGroup($label, $type = 'text', $name = '', $value = '', $placeholder = '', $attributes = [], $small) {
    // Inicia a string do grupo de formulários
    $inputGroup = "<div class=\"group-input\">\n";

    // Adiciona o label
    if ($label) {
        $inputGroup .= "<label for=\"$name\" class=\"form-label\">$label</label>\n";
    }

    // Inicia a tag do input
    $inputGroup .= "<input type=\"$type\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\" id=\"$name\" class=\"form-control\"";

    // Adiciona os atributos adicionais
    foreach ($attributes as $key => $val) {
        $inputGroup .= " $key=\"$val\"";
    }

    $inputGroup .= ">";

    if (!empty($small)) {
        $inputGroup .= "<small class=\"form-text text-muted form-small\">$small</small>";
    }
    

    // Fecha a tag do input
    $inputGroup .= "\n</div>\n";
    
    // Retorna o HTML do grupo de formulários
    return $inputGroup;
}
?>