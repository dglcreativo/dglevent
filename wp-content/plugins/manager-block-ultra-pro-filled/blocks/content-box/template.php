<?php
global $content_counter;
if(!isset($content_counter)){
    $content_counter = 0;
}
$content_counter++;

$add_section_content_box = get_field('add_section_content_box');
$content_box_bg1 = get_field('content_box_bg1');
$content_box_bg2 = get_field('content_box_bg2');
$content_box_title = get_field('content_box_title');
$content_box_color_t = get_field('content_box_color_t');
$fluid = get_field('content_box_cf') ? 'container-fluid' : 'container';
$content_box_align = get_field('content_box_align');
$content_box_padding_top = get_field('content_box_padding_top');
$content_box_padding_bottom = get_field('content_box_padding_bottom');

wp_register_style('new-content-box-style', false);
wp_enqueue_style('new-content-box-style');

$custom_css = "
        .content-box{$content_counter}.section-content-box{
            background-image: linear-gradient(to right, {$content_box_bg1}, {$content_box_bg2});      
            padding-top: {$content_box_padding_top}px;
            padding-bottom: {$content_box_padding_bottom}px;
        }
        .content-box{$content_counter} .content-title{
            text-align: {$content_box_align};
        }
        .content_box{$content_counter} .content_box-title{
            color: {$content_box_color_t};
        }
        ";


wp_add_inline_style( 'new-content-box-style', $custom_css );

?>

<section class="content-box<?php echo esc_attr($content_counter); ?> section-content-box">
    <div class="container">
        <div class="content-title">
            <h2 class="content-box-title"><?php echo esc_html($content_box_title); ?></h2>
        </div>
        <?php foreach ($add_section_content_box as $content):
            $add_section_content_box_info = $content['add_section_content_box_info'];

            $total_items = count($add_section_content_box_info);
            $item_index = 0;
        ?>
        <div class="main-content-box">
            <?php foreach ($add_section_content_box_info as $item):
                $content_box_title_item = $item['content_box_title_item'];
                $content_box_d_item = $item['content_box_d_item'];
            ?>
            <div class="content-section">
                <div class="content-box">
                    <div class="icon-box-wrapper">
                        <div class="icon-box-content">
                            <p class="icon-box-title"><span><?php echo esc_html($content_box_title_item) ?></span></p>
                            <p class="icon-box-description"><?php echo esc_html($content_box_d_item ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($item_index < $total_items - 1): ?>
            <div class="separator">
                <div class="divider">
                    <span class="divider-separator"></span>
                </div>
            </div>
            <?php endif;
            $item_index++;
            endforeach; ?>
        </div>
        <?php endforeach; ?>

    </div>
</section>
