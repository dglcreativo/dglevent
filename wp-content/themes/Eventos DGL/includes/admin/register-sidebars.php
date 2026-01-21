<?php

if(!defined('ABSPATH')){
    exit;
}

function vivero_register_sidebar(){

    register_sidebar( array(
        'name' => esc_html__( 'Sidebar Blog', 'new' ),
        'id' => 'sidebar-default',
        'class' => 'default',
        'description' => esc_html__( 'Este es el sidebar por defecto. ', 'new' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar( array(
        'name' => esc_html__( 'Sidebar Learn Redux', 'new' ),
        'id' => 'sidebar-learn',
        'class' => 'default',
        'description' => esc_html__( 'Este es el sidebar para Redux Learn. ', 'new' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // footer widgets
    $sidebar_number_f="4";
    if (isset($new_options['mainfooter-sidebars'])) {
        $sidebar_number_f = $new_options['mainfooter-sidebars'];
    }
    for($i='1'; $i <= $sidebar_number_f; $i++) {
        $sidebar_id = "sidebar-footer-".$i;
        $sidebar_name = "Footer ".$i;
        register_sidebar(
            array(
                'name' => $sidebar_name,
                'id' => $sidebar_id,
                'class' => 'sidebar-footer',
                'description' => esc_html__( 'Esta es el área de widgets, que se muestra en el pie de página.', 'newtheme' ),
                'before_widget' => '<div id="%1$s" class="section widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    
    //single blog
    register_sidebar( array(
        'name' => esc_html__( 'Posts Individuales', 'new' ),
        'id' => 'sidebar-single',
        'class' => 'vivero-single-post',
        'description' => esc_html__( 'Este es el sidebar para las entradas individuales. ', 'new' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

}
add_action( 'widgets_init', 'vivero_register_sidebar' );

