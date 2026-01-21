<?php ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
<?php
vivero_get_pre_loader_theme();
vivero_get_header_theme();
if(!is_front_page()){
    vivero_get_heading();
}


