<?php
global $new_options;
$active_slider = $new_options['center_header_slider_on'];


if ($active_slider == true && is_front_page()):
    ?>
    <header id="header" class="header-center-slider mainheader site-header">
        <div class="p-absolute">
            <div class="container" >
                <div class="wrap-relative row">
                    <div class="col-12 site-branding justify-content-center">
    <?php vivero_get_logo_theme(); ?>
                    </div>
                    <div class="col-12 site-navigation">
    <?php vivero_get_navigation_theme(array('vivero-theme-navigation'), array('d-flex', 'justify-content-center', 'pb-3')); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php get_template_part('includes/slider'); ?>
        <div class="overlay-heading-slider"></div>

    </header>

<?php else:
    ?>

    <header id="header" class="header-center mainheader site-header">
        <div class="container" >
            <div class="wrap-relative row">
                <div class="col-12 site-branding justify-content-center">
    <?php vivero_get_logo_theme(); ?>
                </div>
                <div class="col-12 site-navigation">
    <?php vivero_get_navigation_theme(array('vivero-theme-navigation'), array('d-flex', 'justify-content-center', 'pb-3')); ?>
                </div>
            </div>
        </div>
    </header>
<?php endif; 