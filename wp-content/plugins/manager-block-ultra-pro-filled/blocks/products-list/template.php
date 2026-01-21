<?php
global $new_counter;
if(!isset($new_counter)){
    $new_counter = 0;
}
$new_counter++;

$product_bg1 = get_field('product_bg1');
$product_bg2 = get_field('product_bg2');
$fluid = get_field('product_cf') ? 'container-fluid' : 'container';
$product_padding_top = get_field('product_padding_top');
$product_padding_bottom = get_field('product_padding_bottom');
$product_order = get_field('product_order');
$product_title = get_field('product_title');
$product_color_title = get_field('product_color_title');
$product_d = get_field('product_description');
$product_color_d = get_field('product_color_description');
$product_add_item = get_field('product_add_item');


wp_register_style('new-product-style', false);
wp_enqueue_style('new-product-style');

$custom_css = "
        .product{$new_counter} .product-title{
            color: {$product_color_title};
        }
        .product{$new_counter} .product-d{
            color: {$product_color_d};
        }
        .product{$new_counter}.section-product{
            background-image: linear-gradient(to right, {$product_bg1}, {$product_bg2});
            padding-top: {$product_padding_top}px;
            padding-bottom: {$product_padding_bottom}px;
        }
        .product{$new_counter}.section-product .new-product{
            flex-direction: {$product_order};
        }
        ";
if($product_order == 'row-reverse'){
    $custom_css .= ".product{$new_counter} .info-product{padding: 5% 8% 0% 1%;}";
}
        wp_add_inline_style( 'new-product-style', $custom_css );


?>

<section class="product<?php echo esc_attr($new_counter); ?> section-product">
    <div class="<?php echo esc_attr($fluid) ?>">
        <div class="row">
            <div class="col-12">
                <div class="info-product">
                    <?php if($product_title != ''): ?>
                        <div class="box-product-title">
                            <h1 class="product-title"><?php echo esc_html($product_title); ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php if($product_d != ''): ?>
                        <div class="box-product-description">
                            <p class="product-d"><?php echo esc_html($product_d); ?></p>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="new-product">
                    <div class="product-list" id="productBlock">
                        <?php
                        foreach ($product_add_item as $item):
                            $product_id = $item['product_id_list'];

                            if ( $product_id ) {
                                $product = wc_get_product( $product_id );
                                if ( $product && $product->get_status() === 'publish' ) { ?>
                                <div class="product-item">
                                    <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="product-link">
                                        <div class="product-image">
                                            <?php echo $product->get_image('medium'); ?>
                                        </div>

                                        <h3 class="product-name"><?php echo esc_html( $product->get_name() ); ?></h3>
                                    </a>

                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>

                                    <div class="product-add-to-cart">
                                        <?php
                                        echo do_shortcode('[add_to_cart id="' . $product_id . '" show_price="false" style=""]');
                                        ?>
                                    </div>

                                </div>
                            <?php
                            }
                            }
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

