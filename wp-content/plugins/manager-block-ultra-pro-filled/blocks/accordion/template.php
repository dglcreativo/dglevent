<?php
global $new_counter;
if(!isset($new_counter)){
    $new_counter = 0;
}
$new_counter++;

$accordion_bg1 = get_field('accordion_bg1');
$accordion_bg2 = get_field('accordion_bg2');
$fluid = get_field('accordion_cf') ? 'container-fluid' : 'container';
$accordion_padding_top = get_field('accordion_padding_top');
$accordion_padding_bottom = get_field('accordion_padding_bottom');
$accordion_order = get_field('accordion_order');
$accordion_img = get_field('accordion_img');
$accordion_title = get_field('accordion_title');
$accordion_color_title = get_field('accordion_color_title');
$accordion_d = get_field('accordion_description');
$accordion_color_d = get_field('accordion_color_description');
$accordion_add_item = get_field('accordion_add_item');
$accordion_type_btn = get_field('accordion_type_button');
$accordion_btn= get_field('btn_title_accordion');
$accordion_link = get_field('btn_link_accordion');

if(!empty($accordion_type_btn)):
    $type_btn = $accordion_type_btn;
else :
    $type_btn = 'banner__btn';
endif;


wp_register_style('new-accordion-style', false);
wp_enqueue_style('new-accordion-style');

$custom_css = "
        .accordion{$new_counter} .accordion-title{
            color: {$accordion_color_title};
        }
        .accordion{$new_counter} .accordion-d{
            color: {$accordion_color_d};
        }
        .accordion{$new_counter}.section-accordion{
            background-image: linear-gradient(to right, {$accordion_bg1}, {$accordion_bg2});
            padding-top: {$accordion_padding_top}px;
            padding-bottom: {$accordion_padding_bottom}px;
        }
        .accordion{$new_counter}.section-accordion .new-accordion{
            flex-direction: {$accordion_order};
        }
        .card{
            border: none;
            background-color: transparent;
        }
        .card-header{
            background: transparent;
            border-bottom: 3px solid #222030;
        }
        .card-body{
            border-bottom: 3px solid #222030;
            padding: 1.25rem 1.25rem 4rem;
        }
        ";
if($accordion_order == 'row-reverse'){
    $custom_css .= ".accordion{$new_counter} .info-accordion{padding: 5% 8% 0% 1%;}";
}
        wp_add_inline_style( 'new-accordion-style', $custom_css );


?>

<section class="accordion<?php echo esc_attr($new_counter); ?> section-accordion">
    <div class="<?php echo esc_attr($fluid) ?>">
        <div class="row">
            <div class="col-12">
                <div class="new-accordion">
                    <div class="figure-accordion">
                        <div class="figure-premium">
                            <img src="<?php echo esc_attr($accordion_img); ?>" alt="Img Acordeon">
                        </div>
                    </div>

                    <div class="info-accordion">
                        <?php if($accordion_title != ''): ?>
                        <div class="box-accordion-title">
                            <h1 class="accordion-title"><?php echo esc_html($accordion_title); ?></h1>
                        </div>
                        <?php endif; ?>
                        <?php if($accordion_d != ''): ?>
                        <div class="box-accordion-description">
                            <p class="accordion-d"><?php echo esc_html($accordion_d); ?></p>
                        </div>
                        <?php endif; ?>
                        <div class="accordion" id="accordionBlock">
                            <?php
                            foreach ($accordion_add_item as $item):
                            $item_title = $item['accordion_item_title'];
                            $item_text = $item['accordion_item_content'];
                            $item_text_sanitize = wp_kses_post($item_text);
                            global $counter_foreach;
                            if(!isset($counter_foreach)){
                                $counter_foreach = 0;
                            }
                            $counter_foreach++;
                            ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo esc_attr($counter_foreach); ?>">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo esc_attr($counter_foreach); ?>" aria-expanded="true" aria-controls="collapse<?php echo esc_attr($counter_foreach); ?>">
                                            <?php echo esc_html(wp_kses_post($item_title)); ?>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse<?php echo esc_attr($counter_foreach); ?>" class="collapse" aria-labelledby="heading<?php echo esc_attr($counter_foreach); ?>" data-parent="#accordionBlock">
                                    <div class="card-body">
                                        <?php echo $item_text_sanitize; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if($accordion_btn!= ''): ?>
                            <?php if($type_btn != 'btn-cta') : ?>
                                <a href="<?php echo esc_html($accordion_link) ?>" class="<?php echo esc_attr($type_btn); ?>"><?php echo esc_html($accordion_btn) ?></a>
                            <?php else : ?>
                                <a href="<?php echo esc_html($accordion_link) ?>" class="<?php echo esc_attr($type_btn); ?>">
                                    <span><?php echo esc_html($accordion_btn) ?></span>
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
        </div>
    </div>
</section>

