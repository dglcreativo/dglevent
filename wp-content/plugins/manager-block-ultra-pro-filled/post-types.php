<?php

/* Proyectos */

add_action('init', 'register_projects_type');
add_action('init', 'register_projects_taxonomy', 0);

function register_projects_type() {
    $labels = array(
        "name" => esc_html__('Proyectos', 'new'),
        "singular_name" => esc_html__('Proyecto', 'new'),
        "menu_name" => esc_html__('Proyectos', 'new'),
        "all_items" => esc_html__('Proyectos', 'new'),
        "add_new_item" => esc_html__('Añadir Nuevo Proyecto', 'new'),
        "edit_item" => esc_html__('Editar Proyecto', 'new'),
        "new_item" => esc_html__('Nuevo Proyecto', 'new'),
        "view_item" => esc_html__('Ver Proyecto', 'new'),
        "search_items" => esc_html__('Buscar Proyectos', 'new'),
        "not_found" => esc_html__('No encontrado', 'new'),
    );

    $args = array(
        "label" => esc_html__('Proyecto', 'new'),
        "labels" => $labels,
        "description" => "Proyectos que se ofrecen",
        "public" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => get_option('new_base_slug', 'projects'), "with_front" => false),
        "query_var" => true,
        "menu_icon" => "dashicons-admin-users",
        "supports" => array("title", "editor", "thumbnail", "excerpt"),
    );
    register_post_type("projects", $args);
}

// Create department taxonomy

function register_projects_taxonomy() {
    $labels = array(
        "name" => esc_html__('Tipo de Proyecto', 'new'),
        "singular_name" => esc_html__('Tipo', 'new'),
        "separate_items_with_commas" => esc_html__('Separa por comas los tipos de Proyecto.', 'new'),
        "choose_from_most_used" => esc_html__('Escoje los mas usados.', 'new'),
    );

    $args = array(
        "label" => esc_html__('Proyectos', 'new'),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array("slug" => get_option('new_project_base_slug', 'project'), "with_front" => true),
        "show_admin_column" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "show_in_quick_edit" => true,
    );
    register_taxonomy("project", array("projects"), $args);
}
