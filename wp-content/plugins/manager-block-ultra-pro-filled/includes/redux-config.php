<?php

/**
 * For full documentation, please visit: http://docs.reduxframework.com/
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 */

if ( ! class_exists( 'Redux' ) ) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "new";
require_once dirname(__FILE__).'/sections/layout.php';

//Estilos del Theme Options
function plugin_redux_styles() {
    wp_enqueue_style('DGL style plugin', plugin_dir_url(__FILE__) . 'css/admin.css');
}

add_action('admin_enqueue_scripts', 'plugin_redux_styles');


/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.
$theme_version = $theme->get( 'Version' );

$args = array(
    'opt_name' => 'new',
    'dev_mode' => false,
    'display_name' => 'Opciones Tema',
    'display_version' => '1.0',
    'page_slug' => 'new-theme-options',
    'page_title' => 'Opciones Tema',
    'intro_text' => 'Opciones del tema personalizado de Luis Moreno para su versión ' . $theme_version,
    'footer_text' => 'Gracias por usar estas opciones para la visualiación de tu web',
    'admin_bar' => TRUE,
    'menu_type' => 'menu',
    'menu_title' => 'Opciones tema',
    'allow_sub_menu' => TRUE,
    'page_parent_post_type' => 'your_post_type',
    'page_priority' => 1,
    'customizer' => false,
    'default_show' => TRUE,
    'default_mark' => '',
    'class' => 'new',
    'hints' => array(
        'icon_position' => 'right',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'light',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'duration' => '500',
                'event' => 'mouseleave unfocus',
            ),
        ),
    ),
    'output' => TRUE,
    'output_tag' => TRUE,
    'settings_api' => TRUE,
    'cdn_check_time' => '1440',
    'compiler' => TRUE,
    'global_variable' => 'new_options',
    'page_permissions' => 'manage_options',
    'save_defaults' => TRUE,
    'show_import_export' => true,
    'transient_time' => '3600',
    'network_sites' => TRUE,
    'system_info' => TRUE,
    'show_options_object' => false,
    //'templates_path' => dirname(__FILE__) ."/redux-templates/panel",
    'menu_icon'        => plugin_dir_url( __FILE__ ) ."/img/logo-redux.png",
    'admin_bar_icon' => "new-icon",
    'footer_credit'  => "templates.dglcreativo.x10host.com",
);


Redux::setArgs( $opt_name, $args );

