<?php
namespace ManagerBlock;

defined('ABSPATH') || exit;

class AcfJson {
    public static function init() {
        add_filter('acf/settings/save_json', [__CLASS__, 'save_json']);
        add_filter('acf/settings/load_json', [__CLASS__, 'load_json']);
    }

    public static function save_json($path) {
        return MB_PLUGIN_PATH . 'acf-json/';
    }

    public static function load_json($paths) {
        unset($paths[0]);
        $paths[] = MB_PLUGIN_PATH . 'acf-json/';
        return $paths;
    }
}