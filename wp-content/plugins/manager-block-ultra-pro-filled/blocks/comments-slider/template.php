<?php
global $cc_counter;
if(!isset($cc_counter)){
    $cc_counter = 0;
}
$cc_counter++;

$i = 0;

$cc_bg1 = get_field('cc_bg1');
$cc_bg2 = get_field('cc_bg2');
$cc_width = get_field('cc_width');
$cc_auto = get_field('cc_auto') ? '0 auto' : '';
$cc_color_comment = get_field('cc_color_comment');
$fluid = get_field('cc_cf') ? 'container-fluid' : 'container';
$cc_align = get_field('cc_align');
$cc_padding_top = get_field('cc_padding_top');
$cc_padding_bottom = get_field('cc_padding_bottom');
$cc_img_top = get_field('cc_img_top');
$cc_add_comment = get_field('cc_add_comment');


wp_register_style('new-comments-slider-style', false);
wp_enqueue_style('new-comments-slider-style');

$custom_css = "
        .comment{$cc_counter}.section-comments-slider{
            background-image: linear-gradient(to right, {$cc_bg1}, {$cc_bg2});
            text-align: {$cc_align};
            padding-top: {$cc_padding_top}px;
            padding-bottom: {$cc_padding_bottom}px;
        }
        .comment{$cc_counter} .banner__d{
            color: {$cc_color_comment};
        }
        .comment{$cc_counter} .carousel-item{
            color: {$cc_color_comment};
        }
        ";

if($cc_auto){
    $custom_css .= ".comment{$cc_counter} .container-box{$cc_width}{
            margin: {$cc_auto};
        }";
}
        wp_add_inline_style( 'new-comments-slider-style', $custom_css );

?>

<section class="comment<?php echo $cc_counter; ?> section-comments-slider">
    <div class="<?php echo esc_attr($fluid) ?>">
        <div class="row">
            <div class="col-12 container-box<?php echo esc_attr($cc_width);?>">
                <img src="<?php echo esc_attr($cc_img_top) ?>" alt="Comments Slider">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        foreach ($cc_add_comment as $comment) :
                            $cc_comment = $comment['cc_comment'];
                            $cc_author = $comment['cc_author'];
                            $cc_profession = $comment['cc_profession'];
                            $active_class = ( $i == 0 ) ? 'active' : '';
                        ?>
                        <div class="carousel-item <?php echo esc_attr($active_class); ?>">
                            <p class="cc-comment"><?php echo esc_html($cc_comment); ?></p>
                            <h2 class="cc-author"><?php echo esc_html($cc_author); ?></h2>
                            <h6 class="cc-profession"><?php echo esc_html($cc_profession); ?></h6>
                        </div>
                        <?php $i++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>