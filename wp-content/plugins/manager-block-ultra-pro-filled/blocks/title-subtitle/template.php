<?php
/**
 * Template for block: Title Subtitle
 */

global $ts_counter;
if(!isset($ts_counter)){
    $ts_counter = 0;
}
$ts_counter++;

$banner_bg1 = get_field('ts_bg1');
$banner_bg2 = get_field('ts_bg2');
$banner_title = get_field('ts_text');
$banner_color_t = get_field('ts_color_t');
$banner_description = get_field('ts_subtitle');
$banner_color_d = get_field('ts_color_d');
$fluid = get_field('ts_text_cf') ? 'container-fluid' : 'container';
$banner_align = get_field('ts_align');




wp_register_style('new-ts-text-style', false);
wp_enqueue_style('new-ts-text-style');

$custom_css = "
        .banner{$ts_counter}.section-title-subtitle{
            background-image: linear-gradient(to right, {$banner_bg1}, {$banner_bg2});
            text-align: {$banner_align};
        }
        .banner{$ts_counter}.section-title-subtitle .ts__title{
            color: {$banner_color_t};
        }
        .banner{$ts_counter}.section-title-subtitle .ts__d{
            color: {$banner_color_d};
        }";
if($banner_title == ''){
    $custom_css .= ".banner{$ts_counter}.section-title-subtitle{padding:10px 0;}";
}
        wp_add_inline_style( 'new-ts-text-style', $custom_css );

?>

<section class="banner<?php echo $ts_counter; ?> section-title-subtitle">
    <div class="<?php echo esc_attr($fluid) ?>">
        <div class="row">
            <div class="col-12">
                <h2 class="ts__title"><?php echo esc_html($banner_title) ?></h2>
                <p class="ts__d"><?php echo esc_html($banner_description) ?></p>
            </div>
        </div>
    </div>
</section>
