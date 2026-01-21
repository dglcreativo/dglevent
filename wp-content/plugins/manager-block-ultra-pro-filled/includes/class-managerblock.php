<?php
namespace ManagerBlock;

defined('ABSPATH') || exit;

class ManagerBlock {
    public static function init() {
        BlocksRegister::init();
        AcfJson::init();
        ReduxLoader::init();
        AssetsLoader::init();
        AdminPanel::init();
        Updater::init();
        
        if (file_exists(MB_PLUGIN_PATH . 'post-types.php')) {
            require_once MB_PLUGIN_PATH . 'post-types.php';
        }

        if (file_exists(MB_PLUGIN_PATH . 'color-hamburger.php')) {
            require_once MB_PLUGIN_PATH . 'color-hamburger.php';
        }


        add_filter('block_categories_all', [__CLASS__, 'add_custom_category'], 10, 2);
    }

    public static function add_custom_category($categories, $context) {
        return array_merge(
            [['slug' => 'vivero-manager-block', 'title' => __('LM Manager Blocks', 'manager-block')]],
            $categories
        );
    }
}