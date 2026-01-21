<?php
namespace ManagerBlock;

defined('ABSPATH') || exit;

spl_autoload_register(function ($class) {
    if (strpos($class, 'ManagerBlock') !== false) {
        $file = plugin_dir_path(__DIR__) . 'includes/class-' . strtolower(str_replace('ManagerBlock\\', '', $class)) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});