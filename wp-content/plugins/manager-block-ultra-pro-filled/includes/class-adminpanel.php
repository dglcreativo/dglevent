<?php

namespace ManagerBlock;

defined('ABSPATH') || exit;

class AdminPanel {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    public static function add_admin_menu() {
        add_menu_page(
                'Manager Block Ultra Pro',
                'Manager Block',
                'manage_options',
                'manager-block-ultra-pro-settings',
                [__CLASS__, 'admin_page'],
                'dashicons-layout',
                90
        );
    }

    public static function register_settings() {
        register_setting('manager_block_settings_group', 'manager_block_enabled_blocks');

        add_settings_section(
                'manager_block_general_section',
                'Ajustes de Bloques Activos',
                null,
                'manager-block-ultra-pro-settings'
        );

        add_settings_field(
                'manager_block_enabled_blocks',
                'Bloques disponibles',
                [__CLASS__, 'enabled_blocks_callback'],
                'manager-block-ultra-pro-settings',
                'manager_block_general_section'
        );
    }

    public static function get_available_blocks() {
        return [
            'box-images' => 'Imagen + Información',
            'title-subtitle' => 'Titulo y Subtitulo',
            'slider-premium' => 'Carousel',
            'section-boxed' => 'Doble imagen con texto',
            'list-block' => 'Listados',
            'banner-text' => 'Textos',
            'banner-services' => 'Servicios',
            'banner-main' => 'Banner Titulo',
            'box-color' => 'Cajas de información',
            'banner-premium' => 'Información del Proyecto',
            'fixed-block' => 'Bloque Fijo e Imagenes',
            'grid-main' => 'InfoGrid',
            'images-effect' => 'Efectos de Imagenes',
            'accordion' => 'Acordeón',
            'comments-slider' => 'Carousel de Comentarios',
            'content-box' => 'Cajas de Contenido',
            'carousel-horizontal' => 'Galeria Horizontal',
            'products-list' => 'Lista de Productos',
        ];
    }

    public static function enabled_blocks_callback() {
        $enabled_blocks = get_option('manager_block_enabled_blocks', []);
        if (!is_array($enabled_blocks)) {
            $enabled_blocks = [];
        }

        $blocks = self::get_available_blocks();

        foreach ($blocks as $slug => $label) {
            $checked = in_array($slug, $enabled_blocks) ? 'checked' : '';
            echo '<label style="display:block; margin-bottom:8px;">';
            echo '<input type="checkbox" name="manager_block_enabled_blocks[]" value="' . esc_attr($slug) . '" ' . $checked . '> ' . esc_html($label);
            echo '</label>';
        }
    }

    public static function admin_page() {
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'settings';

        echo '<div class="wrap">';
        echo '<h1>Manager Block Ultra Pro</h1>';
        echo '<nav class="nav-tab-wrapper">';
        echo '<a href="?page=manager-block-ultra-pro-settings&tab=settings" class="nav-tab ' . ($tab == 'settings' ? 'nav-tab-active' : '') . '">Ajustes</a>';
        echo '<a href="?page=manager-block-ultra-pro-settings&tab=examples" class="nav-tab ' . ($tab == 'examples' ? 'nav-tab-active' : '') . '">Ejemplos de bloques</a>';
        echo '<a href="?page=manager-block-ultra-pro-settings&tab=documentation" class="nav-tab ' . ($tab == 'documentation' ? 'nav-tab-active' : '') . '">Documentación</a>';
        switch ($tab) {
        case 'documentation':
            self::render_documentation_tab();
            break;
    }
        echo '</nav>';

        if ($tab == 'settings') {
            echo '<form method="post" action="options.php">';
            settings_fields('manager_block_settings_group');
            do_settings_sections('manager-block-ultra-pro-settings');
            submit_button();
            echo '</form>';
        } elseif ($tab == 'examples') {
            self::show_block_examples();
        }

        echo '</div>';
    }

    public static function show_block_examples() {

        $blocks = self::get_available_blocks();
        echo '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(333px, 1fr)); gap: 20px; margin-top: 20px;">';
        foreach ($blocks as $slug => $label) {
            $image_url = plugin_dir_url(__FILE__) . 'examples/' . $slug . '.png'; // o .png, según prefieras
            echo '<div style="border:1px solid #ddd; padding:15px; text-align:center; border-radius:8px; background:#fff;">';
            echo '<h3>' . esc_html($label) . '</h3>';
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($label) . '" style="max-width:100%; height:auto; border-radius:6px;">';
            echo '</div>';
        }
        echo '</div>';
    }

    public static function render_documentation_tab() {
        $readme_file = plugin_dir_path(__FILE__) . '../docs/readme.md';

        if (file_exists($readme_file)) {
            require_once plugin_dir_path(__FILE__) . 'Parsedown.php';
            $parsedown = new \Parsedown();
            $markdown = file_get_contents($readme_file);
            $html = $parsedown->text($markdown);
            echo '<div class="manager-block-docs">' . $html . '</div>';
        } else {
            echo '<p>No se encontró el archivo de documentación.</p>';
        }
    }

}
