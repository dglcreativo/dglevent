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

function filter_recent_posts_by_blog( $args ) {

    if ( is_author() ) {
        // Para asegurar que el widget de Entradas Recientes muestre todos los tipos
        // de contenido, debemos establecer post_type a un array de los tipos que usamos.
        $args['post_type'] = array('post', 'learn');
        return $args;
    }
    // Identifica si la página actual es un archivo o una entrada singular del CPT 'learn'
    $es_blog_cpt = is_post_type_archive('learn') || is_singular('learn') ||
        is_tax('dgl_redux_category') || is_tax('dgl_redux_tag');

    // Identifica si la página actual es el blog estándar
    $es_blog_estandar = is_home() || ( is_single() && get_post_type() === 'post' ) ||
        is_category() || is_tag();

    // ➡️ Bloque A: Lógica para el Blog del CPT ('learn')
    if ( $es_blog_cpt ) {
        $args['post_type'] = 'learn';
        // Si tienes tax_query aquí, asegúrate de que esté correcto y definido.
        // Si no lo necesitas, omite $args['tax_query']
    }

    // ➡️ Bloque B: Lógica para el Blog Estándar ('post')
    elseif ( $es_blog_estandar ) {
        $args['post_type'] = 'post';
        // Si tienes tax_query aquí, asegúrate de que esté correcto y definido.
    }

    return $args;
}
add_filter( 'widget_posts_args', 'filter_recent_posts_by_blog' );


/**
 * Filtra el widget de Categorías para mostrar solo taxonomías del CPT 'learn'
 * o del CPT 'post' según el contexto de la página.
 */
function filter_widget_cat_by_blog( $args ) {

    if ( is_author() ) {
        $args['taxonomy'] = array('category', 'dgl_redux_category');
        return $args;
    }

    $es_blog_cpt = is_post_type_archive('learn') || is_singular('learn') ||
        is_tax('dgl_redux_category') || is_tax('dgl_redux_tag');

    $es_blog_standar = is_home() || ( is_single() && get_post_type() === 'post' ) ||
        is_category() || is_tag();

    if ( $es_blog_cpt ) {
        $args['taxonomy'] = 'dgl_redux_category';
    }
    elseif ( $es_blog_standar ) {
        $args['taxonomy'] = 'category';
    }

    return $args;
}

add_filter( 'widget_categories_args', 'filter_widget_cat_by_blog' );


/**
 * Filtra el widget de Nube de Etiquetas para mostrar solo taxonomías del CPT 'learn'
 * o del CPT 'post' según el contexto de la página.
 */
function filter_widget_tax_by_blog( $args ) {

    if ( is_author() ) {

        $args['taxonomy'] = array('post_tag', 'dgl_redux_tag');
        return $args;
    }

    $es_blog_cpt = is_post_type_archive('learn') || is_singular('learn') ||
        is_tax('dgl_redux_category') || is_tax('dgl_redux_tag');

    $es_blog_estandar = is_home() || ( is_single() && get_post_type() === 'post' ) ||
        is_category() || is_tag();

    if ( $es_blog_cpt ) {
        $args['taxonomy'] = 'dgl_redux_tag';
    } elseif ( $es_blog_estandar ) {
        $args['taxonomy'] = 'post_tag';
    }

    return $args;
}

add_filter( 'widget_tag_cloud_args', 'filter_widget_tax_by_blog' );

/**
 * Asocia las categorías (Taxonomías) con su CPT correcto en las páginas de archivo.
 * Esto evita que una categoría estándar muestre entradas del CPT 'learn'.
 */
function associate_taxonomies_with_cpt_in_file( $query ) {

    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->is_category() ) {
        $query->set( 'post_type', 'post' );
    }

    if ( $query->is_tax( 'dgl_redux_category' ) ) {
        $query->set( 'post_type', 'learn' );
    }
}

add_action( 'pre_get_posts', 'associate_taxonomies_with_cpt_in_file' );

/**
 * Asocia las etiquetas (Taxonomías) con su CPT correcto en las páginas de archivo.
 * Esto evita que una etiqueta estándar muestre entradas del CPT 'learn'.
 */
function associate_taxonomies_tag_with_cpt_in_file( $query ) {

    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->is_tag() ) {
        $query->set( 'post_type', 'post' );
    }

    if ( $query->is_tax( 'dgl_redux_tag' ) ) {
        $query->set( 'post_type', 'learn' );
    }
}

add_action( 'pre_get_posts', 'associate_taxonomies_tag_with_cpt_in_file' );

/**
 * Modifica la consulta en el archivo de autor para incluir el CPT 'learn'
 * junto con el tipo de contenido estándar 'post'.
 */
function include_cpt_in_author_file( $query ) {

    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->is_author() ) {
        $post_types = $query->get( 'post_type' );

        if ( empty( $post_types ) ) {
            $post_types = array( 'post' );
        }

        if ( ! is_array( $post_types ) ) {
            $post_types = array( $post_types );
        }

        $post_types[] = 'learn';
        $query->set( 'post_type', $post_types );
    }
}

add_action( 'pre_get_posts', 'include_cpt_in_author_file' );