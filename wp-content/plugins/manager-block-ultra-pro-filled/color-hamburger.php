<?php
function change_hamburguer_color() {
    global $new_options; // Reemplaza 'new' con el nombre de tu variable global de Redux

    // Verifica si el campo de color está definido y tiene un valor
    if (isset($new_options['hamburguer_color']) && !empty($new_options['hamburguer_color'])) {
        $hamburguer_color = $new_options['hamburguer_color'];

        // Código SVG codificado en Base64 para el icono de hamburguesa
        $svg_data = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><path stroke="' . $hamburguer_color . '" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"/></svg>';

        // Codifica el SVG a base64
        $encoded_svg = 'data:image/svg+xml;utf8,' . rawurlencode($svg_data);

        // Genera el CSS para sobrescribir el color del icono
        $custom_css = '
        .navbar-toggler-icon {
            background-image: url("' . $encoded_svg . '")!important;
        }';

        // Imprime el CSS en el head del documento
        echo '<style type="text/css">' . $custom_css . '</style>';
    }
}
// Agrega la función al hook 'wp_head'
add_action('wp_head', 'change_hamburguer_color');