<?php
/**
 * Template for block: List Block
 */

global $new_options;
$main_color = $new_options['new_color_primary'];

$add_list_block = get_field('add_bl_list');
$btn_general = get_field('bl_general_btn');
$btn_general_link = get_field('bl_link_general');
$pt = get_field('bl_pt');
$pb = get_field('bl_pb');
$bg_color = get_field('bl_bg_color');
?>

<section class="section-list-block" style="padding-top: <?php echo esc_attr($pt); ?>px; padding-bottom: <?php echo esc_attr($pb); ?>px; background-color: <?php echo esc_attr($bg_color); ?> ">
    <div class="container">
        <div class="list-block-info">
            <?php 
            foreach ($add_list_block as $bl_item):
                $bl_cat = $bl_item['bl_category'];
                $bl_title = $bl_item['bl_title'];
                $bl_p = $bl_item['bl_p'];
                $bl_btn = $bl_item['bl_btn_title'];
                $bl_link = $bl_item['bl_btn_link'];
                $bl_add_item = $bl_item['add_bl_item'];
                
                wp_register_style('new-lists-style', false);
                wp_enqueue_style('new-lists-style');

                    if($bl_add_item):
                        $border_cat = 'border-category';
                        $border_b = '1px solid ' . $main_color;
                    else :
                        $border_cat = 'catgory';
                    endif;

                    $custom_css = ".list-block-border-category{border-bottom: {$border_b};}";

                wp_add_inline_style( 'new-lists-style', $custom_css );
            ?>
                <div class="list-block-info-item">
                    <h6 class="list-block-<?php echo esc_attr($border_cat); ?>"><?php echo esc_html($bl_cat); ?></h6>

                    <?php if($bl_title != ''): ?>
                    <h3 class="list-block-title"><?php echo esc_html($bl_title); ?></h3>
                    <?php endif; ?>

                    <?php if($bl_p != ''): ?>
                    <p class="list-block-p"><?php echo esc_html($bl_p); ?></p>
                    <?php endif; ?>

                    <?php if($bl_add_item): ?>
                    <ul>
                        <?php
                        foreach ($bl_add_item as $bl):
                            $bl_link_li = $bl['bl_item_link'];
                            $bl_title_li = $bl['bl_item_list'];
                        ?>
                        <li><a href="<?php echo esc_attr($bl_link_li); ?>"><?php echo esc_html($bl_title_li); ?></a></li>
                        <?php  endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if($bl_btn != ''): ?>
                    <a href="<?php echo esc_attr($bl_link); ?>" class="btn btn-outline-dark"><?php echo esc_html($bl_btn); ?></a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if($btn_general != ''): ?>
        <div class="list-block-btn-section">
            <a href="<?php echo esc_attr($btn_general_link); ?>" class="btn btn-primary"><?php echo esc_html($btn_general) ?></a>
        </div>
        <?php endif; ?>
    </div>
</section>
