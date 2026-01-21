<?php
global $fx_counter;
if(!isset($fx_counter)){
    $fx_counter = 0;
}
$fx_counter++;

$fx_padding_top = get_field('fx_padding_top');
$fx_padding_bottom = get_field('fx_padding_bottom');
$fx_title = get_field('fx_title');
$fx_subtitle = get_field('fx_subtitle');
$fx_p = get_field('fx_d');
$fx_link_b = get_field('fx_btn_link');
$fx_text_b = get_field('fx_btn_text');
$fx_type_btn = get_field('fx_type_button');
$fx_adds = get_field('fx_add_img');

if(!empty($fx_type_btn)):
    $type_btn = $fx_type_btn;
else :
    $type_btn = 'banner__btn';
endif;

wp_register_style('new-fixed-block-style', false);
wp_enqueue_style('new-fixed-block-style');

$custom_css = "
    .fixed{$fx_counter}.section-fixed-block{
        padding-top: {$fx_padding_top}px;
        padding-bottom: {$fx_padding_bottom}px;
    }
";

wp_add_inline_style('new-fixed-block-style', $custom_css);
?>

<section class="fixed<?php echo $fx_counter; ?> section-fixed-block">
    <div class="figure-fixed-block">
<?php
foreach ($fx_adds as $img) :
    $fx_img = $img['fx_img'];
    $fx_img_text = $img['fx_img_text'];
    $fx_img_link = $img['fx_img_link'];
    ?>
            <div class="fixed-images">
                <a href="<?php echo esc_attr($fx_img_link); ?>">
                    <img src="<?php echo esc_attr($fx_img); ?>" alt="<?php echo esc_html($fx_img_text); ?>"/>
                    <h6><?php echo esc_html($fx_img_text); ?></h6>
                    <div class="overlay-heading-slider"></div>
                </a>
            </div>
    <?php
endforeach;
?>
    </div>

    <div class="info-fixed-block">
        <?php if($fx_title != ''): ?>
        <h3><?php echo esc_html($fx_title); ?></h3>
        <?php endif; ?>
        <?php if($fx_subtitle != ''): ?>
        <h6><?php echo esc_html($fx_subtitle); ?></h6>
        <?php endif; ?>
        <?php if($fx_p != ''): ?>
        <p><?php echo esc_html($fx_p); ?></p>
        <?php endif; ?>
        <?php if($fx_text_b != ''): ?>
            <?php if($type_btn != 'btn-cta') : ?>
                <a href="<?php echo esc_html($fx_link_b) ?>" class="<?php echo esc_attr($type_btn); ?>"><?php echo esc_html($fx_text_b) ?></a>
            <?php else : ?>
                <a href="<?php echo esc_html($fx_link_b) ?>" class="<?php echo esc_attr($type_btn); ?>">
                    <span><?php echo esc_html($fx_text_b) ?></span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </a>
            <?php endif; ?>
        <?php endif; ?>
</section>
