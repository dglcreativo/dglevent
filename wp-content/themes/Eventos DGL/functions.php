<?php

if (!function_exists('new_setup')):

    function new_setup() {

        global $content_width;
        if (!isset($content_width)) {
            $content_width = 1140;
        }

        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('custom-logo', array(
            'flex-width' => true,
            'flex-height' => true
        ));
        add_theme_support('gutenberg', array(
            'color' => array(
                '#d41616',
            )
        ));
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));
        add_theme_support('post-formats', array(
            'aside',
            'gallery',
            'link',
            'image',
            'quote',
            'video',
            'audio',
            'chat'
        ));
        add_theme_support('custom-background', apply_filters('new_custom_bg_args', array(
            'default-color' => '#ffffff',
            'default-image' => '',
        )));

        add_post_type_support('page', 'excerpt'); //Añadir el extracto a las paginas

        register_nav_menus(array(
            'primary' => __('Menu Principal', 'new'),
        ));

        /* image sizes */
        add_image_size('new_container_full', 1140, 640, true);
        add_image_size('new_post_img', 750, 500, true);
        add_image_size('vivero_heading_page', 1920, 300, true);

        //add_editor_style( array('css/editor-style.css'));
    }

endif;
add_action('after_setup_theme', 'new_setup');

//cambiar a return_false si quieres ls widgets clasicos
add_filter('use_widgets_block_editor', '__return_false');

//Carga de estilos y scripts
require get_template_directory() . '/includes/admin/enqueue.php';
//Carga de funciones
require get_template_directory() . '/includes/admin/helpers.php';
//Carga de funciones
require get_template_directory() . '/includes/admin/register-sidebars.php';

add_filter('use_block_editor_for_post_type', 'desactivar_gutenberg_eventos', 10, 2);
function desactivar_gutenberg_eventos($can_edit, $post_type) {
    if ($post_type === 'eventos') { // Asegúrate de que 'eventos' sea el slug real de tu CPT
        return false;
    }
    return $can_edit;
}