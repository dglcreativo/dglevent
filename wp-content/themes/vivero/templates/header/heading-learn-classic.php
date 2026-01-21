<?php
global $new_options;
$new_display_heading = get_option_theme('heading_onoff', false, '1');
$service_p = $new_options['text_p_services'];

if (isset($new_options['header_width_classic'])) {
    $container = $new_options['header_width_classic'] == '0' ? 'container' : 'container-fluid';
}

$active_redux_learn_bg = get_option_theme('active_redux_learn_bg', false, '1');
if($active_redux_learn_bg == '0'):
    $active_bg_learn = '';
else:
    $active_bg_learn = 'learn-redux-blog';
endif;
?>

<?php
if ($new_display_heading != '0'): ?>
    <?php if($active_redux_learn_bg): ?>
    <div class="page-heading section <?php echo esc_attr($active_bg_learn);?>">
        <div class="<?php echo esc_attr($container); ?>">
            <?php if($active_redux_learn_bg): ?>
            <div class="heading-page-h1-img">
                <h1 class="entry-title"><?php vivero_get_page_title(); ?></h1>
                <p><?php echo esc_html($service_p); ?></p>
            </div>
            <?php endif; ?>
            <div class="overlay-heading"></div>
        </div>
    </div>
    <?php else: ?>
        <div class="page-heading section">
            <div class="<?php echo esc_attr($container); ?>">
                <div class="heading-page-portfolio-h1">
                    <h1 class="entry-title"><?php vivero_get_page_title(); ?></h1>
                </div>
                <p><?php echo esc_html($service_p); ?></p>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

