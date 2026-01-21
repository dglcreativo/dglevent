<?php

function vivero_scripts_styles(){
    global $new_options;
    $new_options_custom_css = "";
    //Fuentes de google fonts
    wp_enqueue_style('googleFonts-a', 'https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap', array(), '1.0.0');
    wp_enqueue_style('googleFonts-b', 'https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), '1.0.0');
    wp_enqueue_style('googleFonts-c', 'https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap', array(), '1.0.0');
    //Bootstrap
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', 'jquery', '', true);
    wp_enqueue_style('font-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');




    //Estilo Principal
    wp_enqueue_style( 'new-style', get_stylesheet_uri() );
    //wp_enqueue_style( 'new-admin-dashboard', get_template_directory_uri().'/css/admin-dashboard.css' );
    //slickNav
    //wp_enqueue_style('slicknavCSS', get_template_directory_uri() . '/css/slicknav.min.css', array(), '1.0.0');
    //wp_enqueue_script('slicknavJS', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('ion-icon-ems', 'https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js', 'jquery', '', true);
    wp_enqueue_script('ion-icon', 'https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js', 'jquery', '', true);
    //Custom Script
    wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0', true);

    /**
     * Options from Theme Settings
     */
    if (class_exists('ReduxFrameworkPlugin')) {
        
        /** Imagen del preloader * */
        if (!empty($new_options['preloader_img']['url'])) {
            $new_options_custom_css .= "#loader-logo{ background: url({$new_options['preloader_img']['url']}) no-repeat scroll center 0 / contain; }";
        }

        if ($new_options['preloader_img_default'] == '1' && (empty($new_options['preloader_img']['url']))) {
            $new_options_custom_css .= "#loader-logo{ background: none; }";
        }
        /** Altura cabecera */
        if(!empty($new_options['header_hight_classic'])){
            $new_options_custom_css.= ".header-classic.site-header .site-branding{min-height: {$new_options['header_hight_classic']}px;}";
        }
        /** Posición logotipo*/
        if(!empty($new_options['logo_position_hight_classic'])){
            $new_options_custom_css .= ".header-classic a.logo>img, .header-classic a.site-title{padding-top: {$new_options['logo_position_hight_classic']}px}";
        }
        /** Tamaño logotipo */
        if (!empty($new_options['logo_max_dimensions']['width'])) {
            $new_options_custom_css .= ".mainheader a.logo > img{max-width: {$new_options['logo_max_dimensions']['width']}px; max-height: {$new_options['logo_max_dimensions']['height']}px;}";
        }
        /** Espaciado entre enlaces del menu */
        if(!empty($new_options['nav_item_padding'])) {
            $new_options_custom_css .= ".nav-menu > .menu-item > a{padding-left: {$new_options['nav_item_padding']['width']}px; padding-right: {$new_options['nav_item_padding']['width']}px;}";
        }
        
    }

    if(function_exists('get_field')){
        /** Independientes header */
        $page_id = get_the_ID();
        $bg_header = get_field('bg_header');
        if(!empty($bg_header)){
            $new_options_custom_css .= ".page-id-{$page_id} .mainheader.header-classic{background-color: {$bg_header};}";
        }
        /** Independientes body */
        $bg_body = get_field('bg_body');
        if(!empty($bg_body)){
            $new_options_custom_css .= "body{background-color: {$bg_body};}";
        }
        /** Independientes footer */
        $bg_footer = get_field('bg_footer');
        if(!empty($bg_footer)){
            $new_options_custom_css .= "footer{background-color: {$bg_footer};}";
        }

    }
    wp_add_inline_style('new-style', $new_options_custom_css);
}
add_action('wp_enqueue_scripts', 'vivero_scripts_styles');

add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style( 'new-admin-dashboard', get_template_directory_uri().'/css/admin-dashboard.css' );
    wp_enqueue_style('font-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

});

