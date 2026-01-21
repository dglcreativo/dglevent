<?php
global $bp_counter;
if(!isset($bp_counter)){
    $bp_counter = 0;
}
$bp_counter++;

$bp_image = get_field('bp_image');
$bp_title = get_field('bp_title');
$bp_category = get_field('bp_category');
$bp_services = get_field('bp_services');
$bp_p = get_field('bp_p');
$bp_tags = get_field('bp_add_tag');
$bp_bg = get_field('bp_bg');
$bp_color = get_field('bp_color');
$bp_order = get_field('bp_order');

wp_register_style('new-banner-premium-style', false);
wp_enqueue_style('new-banner-premium-style');

$custom_css = "
        .premium{$bp_counter}.section-banner-premium{
            background-color: {$bp_bg};
            color: {$bp_color};
            flex-direction: {$bp_order};
        }
        .premium{$bp_counter}.section-banner-premium .banner-premium{
            flex-direction: {$bp_order};
        }";
        wp_add_inline_style( 'new-banner-premium-style', $custom_css );


?>

<section class="premium<?php echo esc_attr($bp_counter); ?> section-banner-premium">
    
        <div class="banner-premium">
            <div class="figure-banner-premium">
                <div class="figure-premium" style="background-image: url(<?php echo esc_attr($bp_image); ?>)">
                    
                </div>
            </div>

            <div class="info-banner-premium">
                <div class="banner-title-premium">
                    <h1 class="title-premium"><?php echo esc_html($bp_title); ?></h1>
                </div>

                <div class="banner-tag">                    
                    <h6 class="tag-title"><?php echo esc_html($bp_category); ?></h6>
                </div>
                
                <div class="banner-job">                    
                    <h5 class="job-title"><?php echo esc_html($bp_services); ?></h5>
                </div>
                
                <div class="banner-premium-p">                    
                    <p><?php echo esc_html($bp_p); ?></p>
                </div>
                <?php if(!empty($bp_tags)): ?>
                <div class="banner-services">                    
                    <h6>Servicios Fundamentales:</h6>
                </div>
                
                <div class="banner-categories tagcloud">
                    <?php
                    foreach ($bp_tags as $tag):
                        $tag_title = $tag['bp_tag_title'];
                        $tag_link = $tag['bp_tag_link'];
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

