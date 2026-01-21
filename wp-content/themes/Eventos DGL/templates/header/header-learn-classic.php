<?php
global $new_options;

if (isset($new_options['header_width_classic'])) {
    $container = $new_options['header_width_classic'] == '0' ? 'container' : 'container-fluid';
}
$style_nav = $new_options['new_type_navigation'];
if($style_nav == '1'){
    $style_nav = '';
} else {
    $style_nav = 'fill-style';
}
?>

<header id="header" class="header-classic mainheader site-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="<?php echo esc_attr($container); ?>" >

            <div class="site-branding">
                <?php vivero_get_logo_theme(); ?>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end site-navigation <?php echo esc_attr($style_nav); ?>" id="main-menu-content">
                <?php vivero_get_navigation_theme(/*array('vivero-theme-navigation'),*/ array('navbar-nav', 'ms-auto')); ?>
            </div>
        </div>
    </nav>
</header>