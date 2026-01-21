<?php
namespace ManagerBlock;

defined('ABSPATH') || exit;

class BlocksRegister {
    public static function init() {
        add_action('acf/init', [__CLASS__, 'register_blocks']);
    }

    public static function register_blocks() {
        // Bloques disponibles
        $available_blocks = [
            'box-images',
            'title-subtitle',
            'slider-premium',
            'section-boxed',
            'list-block',
            'banner-text',
            'banner-services',
            'banner-main',
            'box-color',
            'banner-premium',
            'fixed-block',
            'grid-main',
            'images-effect',
            'accordion',
            'comments-slider',
            'content-box',
            'carousel-horizontal',
            'products-list',
        ];

        // Obtener los bloques habilitados desde la base de datos
        $enabled_blocks = get_option('manager_block_enabled_blocks', []);
        if (!is_array($enabled_blocks)) {
            $enabled_blocks = [];
        }

        // Registrar solo los bloques habilitados
        foreach ($available_blocks as $block) {
            if (in_array($block, $enabled_blocks)) {
                register_block_type(MB_PLUGIN_PATH . 'blocks/' . $block);
            }
        }
    }
}