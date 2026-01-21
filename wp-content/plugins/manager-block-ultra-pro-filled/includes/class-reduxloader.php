<?php
namespace ManagerBlock;

defined('ABSPATH') || exit;

class ReduxLoader {
    public static function init() {
        if (!class_exists('includes\redux-framework\redux-core\ReduxFramework') && file_exists(MB_PLUGIN_PATH . 'includes/redux-framework/redux-framework.php')) {
            require_once MB_PLUGIN_PATH . 'includes/redux-framework/redux-framework.php';
        }

        if (file_exists(MB_PLUGIN_PATH . 'includes/redux-config.php')) {
            require_once MB_PLUGIN_PATH . 'includes/redux-config.php';
        }
    }
}