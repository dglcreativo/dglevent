<?php
global $carousel_h_counter;
if(!isset($carousel_h_counter)){
    $carousel_h_counter = 0;
}
$carousel_h_counter++;

$add_cp_items = get_field('add_cp_items');
$carousel_h_padding_top = get_field('carousel_h_padding_top');
$carousel_h_padding_bottom = get_field('carousel_h_padding_bottom');
$carousel_h_title = get_field('carousel_h_title');
$carousel_h_color_title = get_field('carousel_h_color_title');
$carousel_h_color_item_title = get_field('carousel_h_colo_item_title');

wp_register_style('new-carousel-horizontal-style', false);
wp_enqueue_style('new-carousel-horizontal-style');

$custom_css = "
        .carousel-h{$carousel_h_counter}.section-img-carousel{
            padding-top: {$carousel_h_padding_top}px;
            padding-bottom: {$carousel_h_padding_bottom}px;
        }
        .carousel-h{$carousel_h_counter} .carousel-h-title{
            color: {$carousel_h_color_title};
        }
        .carousel-h{$carousel_h_counter} .carousel-title{
            color: {$carousel_h_color_item_title};
        }
        ";

wp_add_inline_style( 'new-carousel-horizontal-style', $custom_css );
?>

<section class="carousel-h<?php echo esc_attr($carousel_h_counter); ?> section-img-carousel">
    <div class="container">
    <?php if($carousel_h_title != ''): ?>
        <h2 class="carousel-h-title"><?php echo esc_html($carousel_h_title) ?></h2>
    <?php endif; ?>
    </div>
    <div class="images-carousel">
        <?php
        foreach ($add_cp_items as $item):
            $cp_image_id = $item['cp_image']; //ACF puesto para obtener ID de la imagen
            $cp_title = $item['cp_title'];
            $cp_link = $item['cp_link'];
            //Obtener los datos de la imagen usando el tamaño personalizado.
            $image_data = wp_get_attachment_image_src( $cp_image_id, '' );
            if ($image_data) {
                $cp_image_url = esc_url($image_data[0]);
            } else {
                $cp_image_url = '';
            }
        ?>
        <article class="item-carousel">
            <a href="<?php echo esc_attr($cp_link); ?>">
                <div class="carousel-thumbnail">
                    <img src="<?php echo esc_attr($cp_image_url); ?>" alt="<?php echo esc_html($cp_title); ?>">
                </div>
                <div class="carousel-overlay">
                    <h4 class="carousel-title"><?php echo esc_html($cp_title); ?></h4>
                </div>
            </a>
        </article>
        <?php endforeach; ?>
    </div>		
</section>