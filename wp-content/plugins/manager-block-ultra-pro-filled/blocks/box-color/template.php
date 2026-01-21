<?php
global $new_options;

$add_bx_items = get_field('bx_add_item');

?>

<section class="boxcolor section-box-color container-box">
    <?php
    foreach ($add_bx_items as $item):
        $primary_color = $new_options['new_color_primary'];
        global $bx_counter;
        if(!isset($bx_counter)){
            $bx_counter = 0;
        }
        $bx_counter++;
        
        $bx_cat = $item['bx_category'];
        $bx_title = $item['bx_title'];
        $bx_p = $item['bx_description'];
        $bx_title_b = $item['bx_title_button'];
        $bx_link = $item['bx_link_button'];
        $bx_bg = $item['bx_bg_color'];
        $bx_color = $item['bx_color_text'];
        
        wp_register_style('new-box-color-style', false);
        wp_enqueue_style('new-box-color-style');

        $custom_css = "
            .box{$bx_counter}.box-color-item{ background-color:{$bx_bg}; color: {$bx_color};}
            .box-color-item:hover{ background-color: {$primary_color}}";
        wp_add_inline_style( 'new-box-color-style', $custom_css );
    ?>
    
        <div class="box<?php echo esc_attr($bx_counter); ?> box-color-item">

            <div class="box-color-category">
                <h6><?php echo esc_html($bx_cat); ?></h6>
            </div>


            <div class="box-color-title">
                <h3><?php echo esc_html($bx_title); ?></h3>
            </div>

            <?php if($bx_p  != ""): ?>
            <div class="box-color-p">
                <p><?php echo esc_html($bx_p); ?></p>
            </div>
            <?php endif; ?>

            <?php if($bx_title_b != ""): ?>
            <div class="box-color-link">
                <a href="<?php echo esc_html($bx_link); ?>" class="btn btn-outline-light">
                    <span><?php echo esc_html($bx_title_b); ?> <i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i></span>	
                </a>
            </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    		
</section>

