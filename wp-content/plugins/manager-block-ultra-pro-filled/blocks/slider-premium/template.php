<?php
/**
 * Template for block: Slider Premium
 */

global $sp_counter;
if(!isset($sp_counter)){
    $sp_counter = 0;
}
$sp_counter++;

$bp_image = get_field('sp_image');
$bp_image_two = get_field('sp_image_two');
$bp_image_trhee = get_field('sp_image_trhee');
$bp_title = get_field('sp_title');
$bp_services = get_field('sp_services');
$bp_tags = get_field('sp_add_tag');
$bp_bg = get_field('sp_bg');
$bp_color = get_field('sp_color');
$bp_order = get_field('sp_order');

wp_register_style('new-slider-premium-style', false);
wp_enqueue_style('new-slider-premium-style');

$custom_css = "
        .premium{$sp_counter}.section-slider-premium{
            background-color: {$bp_bg};
            color: {$bp_color};
            flex-direction: {$bp_order};
        }
        .premium{$sp_counter}.section-slider-premium .slider-premium{
            flex-direction: {$bp_order};
        }";
        wp_add_inline_style( 'new-slider-premium-style', $custom_css );


?>

<section class="premium<?php echo esc_attr($sp_counter); ?> section-slider-premium">
    
        <div class="slider-premium">
            <div class="figure-slider-premium">
                <div class="figure-s-premium active" style="background-image: url(<?php echo esc_attr($bp_image); ?>)"></div>
                <div class="figure-s-premium" style="background-image: url(<?php echo esc_attr($bp_image_two); ?>)"></div>
                <div class="figure-s-premium" style="background-image: url(<?php echo esc_attr($bp_image_trhee); ?>)"></div>
            </div>

            <div class="info-slider-premium">
                <div class="banner-title-premium">
                    <h1 class="title-premium"><?php echo esc_html($bp_title); ?></h1>
                </div>
                
                <div class="banner-job">                    
                    <h5 class="job-title"><?php echo esc_html($bp_services); ?></h5>
                </div>
                
                <?php if(!empty($bp_tags)): ?>
                
                <div class="banner-categories tagcloud">
                    <?php
                    foreach ($bp_tags as $tag):
                        $tag_title = $tag['sp_tag_title'];
                        $tag_link = $tag['sp_tag_link'];
                    ?>
                        <a href="<?php echo esc_html($tag_link); ?>" class="tag-cloud-link"><?php echo esc_html($tag_title); ?></a>
                    <?php
                    // Agregar '-' solo si NO es el último elemento
                    if ($tag !== end($bp_tags)) {
                        echo ' - ';
                    }
                    endforeach;
                    ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    
</section>


