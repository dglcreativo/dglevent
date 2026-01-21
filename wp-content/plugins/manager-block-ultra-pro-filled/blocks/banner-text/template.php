<?php
global $counter;
if(!isset($counter)){
    $counter = 0;
}
$counter++;

$banner_bg1 = get_field('banner_bg1');
$banner_bg2 = get_field('banner_bg2');
$banner_width = get_field('banner_width');
$banner_auto = get_field('banner_auto') ? '0 auto' : '';
$banner_cat = get_field('title_banner_cat');
$banner_color_cat = get_field('banner_color_cat');
$banner_title = get_field('title_banner_text');
$banner_color_t = get_field('banner_color_t');
$banner_description = get_field('description_banner_text');
$banner_color_d = get_field('banner_color_d');
$banner_btn = get_field('btn_title_banner_text');
$banner_link = get_field('link_banner_text');
$fluid = get_field('banner_text_cf') ? 'container-fluid' : 'container';
$banner_align = get_field('banner_align');
$banner_type_btn = get_field('banner_type_button');
$banner_padding_top = get_field('banner_padding_top');
$banner_padding_bottom = get_field('banner_padding_bottom');

if(!empty($banner_type_btn)):
    $type_btn = $banner_type_btn;
else :
    $type_btn = 'banner__btn';
endif;

wp_register_style('new-banner-text-style', false);
wp_enqueue_style('new-banner-text-style');

$custom_css = "
        .banner{$counter}.section-banner-text{
            background-image: linear-gradient(to right, {$banner_bg1}, {$banner_bg2});
            text-align: {$banner_align};
            padding-top: {$banner_padding_top}px;
            padding-bottom: {$banner_padding_bottom}px;
        }
        .banner{$counter} .banner__cat{
            color: {$banner_color_cat};
        }
        .banner{$counter} .banner__title{
            color: {$banner_color_t};
        }
        .banner{$counter} .banner__d{
            color: {$banner_color_d};
        }";

if($banner_btn == ''){
    $custom_css .= ".banner{$counter} p{margin-bottom: 0px;}";
}
if(($banner_cat == '' && $banner_description == '' && $banner_btn == '') || ($banner_description == '' && $banner_btn == '')){
    $custom_css .= ".banner{$counter} .banner__title{margin-bottom: 0px;}";
}
if($banner_title == '' && $banner_description == '' && $banner_btn == ''){
    $custom_css .= ".banner{$counter} .banner__cat{margin-bottom: 0px;}";
}
if($banner_auto){
    $custom_css .= ".banner{$counter} .container-box{$banner_width}{
            margin: {$banner_auto};
        }";
}
        wp_add_inline_style( 'new-banner-text-style', $custom_css );

?>

<section class="banner<?php echo $counter; ?> section-banner-text">
    <div class="<?php echo esc_attr($fluid) ?>">
        <div class="row">
            <div class="col-12 container-box<?php echo esc_attr($banner_width);?>">

                <?php if($banner_cat != ''): ?>
                <h6 class="banner__cat"><?php echo esc_html($banner_cat) ?></h6>
                <?php endif; ?>

                <?php if($banner_title != ''): ?>
                <h2 class="banner__title"><?php echo esc_html($banner_title) ?></h2>
                <?php endif; ?>

                <?php if($banner_description != ''): ?>
                <p class="banner__d"><?php echo esc_html($banner_description) ?></p>
                <?php endif; ?>

                <?php if($banner_btn != ''): ?>
                    <?php if($type_btn != 'btn-cta') : ?>
                        <a href="<?php echo esc_html($banner_link) ?>" class="<?php echo esc_attr($type_btn); ?>"><?php echo esc_html($banner_btn) ?></a>
                    <?php else : ?>
                        <a href="<?php echo esc_html($banner_link) ?>" class="<?php echo esc_attr($type_btn); ?>">
                            <span><?php echo esc_html($banner_btn) ?></span>
                            <svg width="13px" height="10px" viewBox="0 0 13 10">
                                <path d="M1,5 L11,5"></path>
                                <polyline points="8 1 12 5 8 9"></polyline>
                            </svg>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>