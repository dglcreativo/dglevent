<?php

add_action('init', 'register_event_post_type', 0);

if (!function_exists('register_event_post_type')) {

    function register_event_post_type() {

        $labels = array(
            'name' => esc_html__('Eventos', 'Post Type General Name', 'new'),
            'singular_name' => esc_html__('Evento', 'Post Type Singular Name', 'new'),
            'menu_name' => esc_html__('Eventos', 'new'),
            'name_admin_bar' => esc_html__('Eventos', 'new'),
            'archives' => esc_html__('Item Archives', 'new'),
            'attributes' => esc_html__('Item Attributes', 'new'),
            'parent_item_colon' => esc_html__('Parent Item:', 'new'),
            'all_items' => esc_html__('Todos los Eventos', 'new'),
            'add_new_item' => esc_html__('Añadir Nuevo Evento', 'new'),
            'add_new' => esc_html__('Añadir Nuevo', 'new'),
            'new_item' => esc_html__('Nuevo Evento', 'new'),
            'edit_item' => esc_html__('Editar Evento', 'new'),
            'update_item' => esc_html__('Update Item', 'new'),
            'view_item' => esc_html__('View Item', 'new'),
            'view_items' => esc_html__('View Items', 'new'),
            'search_items' => esc_html__('Search Item', 'new'),
            'not_found' => esc_html__('Not found', 'new'),
            'not_found_in_trash' => esc_html__('Not found in Trash', 'new'),
            'featured_image' => esc_html__('Imagen Destacada', 'new'),
            'set_featured_image' => esc_html__('Set featured image', 'new'),
            'remove_featured_image' => esc_html__('Eliminar Imagen', 'new'),
            'use_featured_image' => esc_html__('Usar como imagen destacada', 'new'),
            'insert_into_item' => esc_html__('Insertar en el Evento', 'new'),
            'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'new'),
            'items_list' => esc_html__('Lista de Eventos', 'new'),
            'items_list_navigation' => esc_html__('Items list navigation', 'new'),
            'filter_items_list' => esc_html__('Filter items list', 'new'),
        );

        $args = array(
            'label' => esc_html__('Eventos', 'new'),
            'description' => esc_html__('Bloques de contenido, que se pueden cargar en cualquier lugar.', 'new'),
            'labels' => $labels,
            'supports' => array('title', 'custom-fields', 'thumbnail'), // 💡 Añadí 'editor' por si acaso
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_rest' => true, // 👈 ¡ESTE ES EL CAMBIO CLAVE!
            'show_in_menu' => true,
            'menu_position' => 2,
            'menu_icon' => 'dashicons-admin-page',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('eventos', $args);
    }

}

// Create department taxonomy
add_action('init', 'register_projects_taxonomy', 0);
function register_projects_taxonomy() {
    $labels = array(
        "name" => esc_html__('Categorias', 'new'),
        "singular_name" => esc_html__('Categoria', 'new'),
        "separate_items_with_commas" => esc_html__('Separa por comas los tipos de categorias.', 'new'),
        "choose_from_most_used" => esc_html__('Escoje los mas usados.', 'new'),
    );

    $args = array(
        "label" => esc_html__('Categorias', 'new'),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array("slug" => get_option('new_project_base_slug', 'eventos-categorias'), "with_front" => true),
        "show_admin_column" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "show_in_quick_edit" => true,
    );
    register_taxonomy("eventos-categorias", array("eventos"), $args);
}
