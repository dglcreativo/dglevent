<?php
global $bs_counter;
if(!isset($bs_counter)){
    $bs_counter = 0;
}
$bs_counter++;

$bs_image = get_field('bs_image');
$bs_image_size = get_field('bs_image_size');
$bs_title = get_field('bs_title');
$bs_services = get_field('bs_services');
$bs_p = get_field('bs_p');
$bs_btn_title = get_field('bs_btn_title');
$bs_link = get_field('bs_btn_link');
$bs_bg = get_field('bs_bg');
$bs_color = get_field('bs_color');
$bs_order = get_field('bs_order');
$bs_type_btn = get_field('bs_type_button');

if(!empty($bs_type_btn)):
    $type_btn = $bs_type_btn;
else :
    $type_btn = 'banner__btn';
endif;

wp_register_style('new-banner-services-b-style', false);
wp_enqueue_style('new-banner-services-b-style');

$custom_css = "
        .services-b{$bs_counter}.section-banner-services-b{
            background-color: {$bs_bg};
            color: {$bs_color};
            flex-direction: {$bs_order};
        }
        .services-b{$bs_counter}.section-banner-services-b .banner-services-b{
            flex-direction: {$bs_order};
        }";

if($bs_image_size == 'cover'){
    $custom_css .= ".services-b{$bs_counter} .figure-services-b{
        background-size: {$bs_image_size};
        }";
} elseif ($bs_image_size == 'contain'){
    $custom_css .= ".services-b{$bs_counter} .figure-services-b{
        background-size: {$bs_image_size};
        background-repeat: no-repeat;
        }";
}
        wp_add_inline_style( 'new-banner-services-b-style', $custom_css );


?>

<section class="services-b<?php echo esc_attr($bs_counter); ?> section-banner-services-b">
    
        <div class="banner-services-b">
            <div class="figure-banner-services-b">
                <div class="figure-services-b" style="background-image: url(<?php echo esc_attr($bs_image); ?>)">
                    
                </div>
            </div>

            <div class="info-banner-services-b">
                <div class="banner-job-services-b">
                    <h5 class="services-b-title"><?php echo esc_html($bs_services); ?></h5>
                </div>

                <div class="banner-title-services-b">
                    <h1 class="title-services-b"><?php echo esc_html($bs_title); ?></h1>
                </div>
                
                <?php if($bs_p != ''): ?>
                <div class="banner-services-b-p">                    
                    <p><?php echo esc_html($bs_p); ?></p>
                </div>
                <?php endif; ?>

                <?php if($bs_btn_title != ''): ?>
                    <?php if($type_btn != 'btn-cta') : ?>
                        <a href="<?php echo esc_html($bs_link) ?>" class="<?php echo esc_attr($type_btn); ?>"><?php echo esc_html($bs_btn_title) ?></a>
                    <?php else : ?>
                        <a href="<?php echo esc_html($bs_link) ?>" class="<?php echo esc_attr($type_btn); ?>">
                            <span><?php echo esc_html($bs_btn_title) ?></span>
                            <svg width="13px" height="10px" viewBox="0 0 13 10">
                                <path d="M1,5 L11,5"></path>
                                <polyline points="8 1 12 5 8 9"></polyline>
                            </svg>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                
            </div>
        </div>
    
</section>

