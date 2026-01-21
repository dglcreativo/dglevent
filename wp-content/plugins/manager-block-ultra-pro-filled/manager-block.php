<?php
/**
 * Plugin Name: Manager Block Ultra Pro
 * Description: Plugin premium para la creación de bloques Gutenberg con ACF y panel de administración.
 * Version: 1.0.0
 * Author: Luis Moreno
 * License: GPL2+
 */

defined('ABSPATH') || exit;

define('MB_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MB_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once MB_PLUGIN_PATH . 'includes/class-loader.php';

use ManagerBlock\ManagerBlock;

ManagerBlock::init();