<?php
global $bp_counter;
if(!isset($bp_counter)){
    $bp_counter = 0;
}
$bp_counter++;

$bt_h1_title = get_field('bt-h1-title');
$bt_title_button = get_field('bt_title_button');
$bt_link_buttom = get_field('bt_link_buttom');
$bt_bg_b = get_field('bt_bg_b');
$bt_color_b = get_field('bt_color_b');
$bt_type_btn = get_field('bt_type_button');

if(!empty($bt_type_btn)):
    $type_btn = $bt_type_btn;
else :
    $type_btn = 'banner__btn';
endif;

wp_register_style('new-banner-main-style', false);
wp_enqueue_style('new-banner-main-style');

$custom_css = "
        .main{$bp_counter}.section-banner-main{
            background-color: {$bt_bg_b};
            color: {$bt_color_b};
        }";
        wp_add_inline_style( 'new-banner-main-style', $custom_css );


?>

<section class="main<?php echo esc_attr($bp_counter); ?> section-banner-main">
    
        <div class="info-banner-main">
            <div class="banner-main">
                <div class="banner-title-main">
                    <h1 class="title-main"><?php echo esc_html($bt_h1_title); ?></h1>
                </div>
                <?php if($bt_title_button  != ''): ?>
                    <?php if($type_btn != 'btn-cta') : ?>
                        <a href="<?php echo esc_html($bt_link_buttom ) ?>" class="<?php echo esc_attr($type_btn); ?>"><?php echo esc_html($bt_title_button ) ?></a>
                    <?php else : ?>
                        <a href="<?php echo esc_html($bt_link_buttom ) ?>" class="<?php echo esc_attr($type_btn); ?>">
                            <span><?php echo esc_html($bt_title_button ) ?></span>
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

