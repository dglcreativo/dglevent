<?php
/**
 * Template for block: Section Boxed
 */

$bxd_cat = get_field('bxd_category');
$bxd_title = get_field('bxd_title');
$bxd_p = get_field('bxd_p');
$bxd_link = get_field('bxd_link');
$bxd_title_b = get_field('bxd_title_b');
$bxd_img_one = get_field('bxd_one_img');
$bxd_img_two = get_field('bxd_two_img');
$bxd_invert = get_field('bxd_invert_text');

if($bxd_invert == '1'){
    $invert = 'invert';
}
?>

<section class="boxed section-section-boxed container-box90 <?php echo esc_attr($invert); ?>">
    
    
        <div class="boxed-info">
            <div class="boxed-color-category">
                <h6><?php echo esc_html($bxd_cat); ?></h6>
            </div>


            <div class="boxed-color-title">
                <h3><?php echo esc_html($bxd_title); ?></h3>
            </div>


            <div class="boxed-color-p">
                <p><?php echo esc_html($bxd_p); ?></p>
            </div>

            <?php if($bxd_title_b != ''): ?>
            <div class="boxed-color-link">
                <a href="<?php echo esc_html($bxd_link); ?>" class="btn btn-primary">
                    <span><?php echo esc_html($bxd_title_b); ?> <i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i></span>	
                </a>
            </div>
            <?php endif; ?>
        </div>
        <figure class="box-figure-one">
            <img src="<?php echo esc_html($bxd_img_one); ?>" alt="<?php echo esc_html($bxd_title); ?>">
        </figure>
        <figure class="box-figure-two">
            <img src="<?php echo esc_html($bxd_img_two); ?>" alt="<?php echo esc_html($bxd_title); ?>">
        </figure>
    
    
</section>


