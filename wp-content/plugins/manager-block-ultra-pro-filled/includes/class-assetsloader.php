<?php
namespace ManagerBlock;

defined('ABSPATH') || exit;

class AssetsLoader {
    public static function init() {
        add_action('enqueue_block_editor_assets', [__CLASS__, 'editor_assets']);//Editor de gutenber
        add_action('wp_enqueue_scripts', [__CLASS__, 'frontend_assets']);//Front
        add_action('admin_enqueue_scripts', [__CLASS__, 'admin_assets']);//Back de wordpress
    }

    public static function editor_assets() {
        wp_enqueue_style('mb-editor-style', MB_PLUGIN_URL . 'assets/editor.css');
    }

    public static function frontend_assets() {
        wp_enqueue_style('mb-frontend-style', MB_PLUGIN_URL . 'assets/frontend.css');
        wp_enqueue_style('buttons-style', MB_PLUGIN_URL . 'assets/frontend/buttons.css');
    }

    public static function admin_assets() {
        wp_enqueue_style('mb-admin-style', MB_PLUGIN_URL . 'assets/admin/admin.css');
    }
}