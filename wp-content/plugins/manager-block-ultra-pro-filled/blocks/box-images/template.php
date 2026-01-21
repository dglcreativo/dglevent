<?php
/**
 * Template for block: Box Images
 */

$bi_image = get_field('bi_image');
$bi_title = get_field('bi_title');
$bi_subtitle = get_field('bi_subtitle');
$bi_p = get_field('bi_p');
$bi_text_b = get_field('bi_text_b');
$bi_link_b = get_field('bi_link_b');
?>

<section class="section-box-image" style="background-image: url(<?php echo esc_attr($bi_image); ?>)">
    
    <div class="container">
        <div class="box-image-info">
            <h1><?php echo esc_html($bi_title); ?></h1>
            <h2><?php echo esc_html($bi_subtitle); ?></h2>
            <p><?php echo esc_html($bi_p); ?></p>
            <?php
            if($bi_text_b != ''):
            ?>
            <div class="tagcloud">
                <a class="btn btn-outline-dark" href="<?php echo esc_attr($bi_link_b); ?>"><?php echo esc_html($bi_text_b); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
</section>
