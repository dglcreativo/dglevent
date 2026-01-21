<?php
$args = array(
    'post_type' => 'vivero_slider',
);

$the_query = new WP_Query($args);
if ($the_query->have_posts()):
    while ($the_query->have_posts()):
        $the_query->the_post();

        $image = get_field('sl_image');
        $title = get_field('sl_title');
        $desc = get_field('sl_subtitle');
        ?> 
        <section id="slider" class="vivero-slider" style="background-image: url(<?php echo esc_attr($image); ?>)">
            <div class="info-slider">
                <h1><?php echo esc_html($title); ?></h1>
                <p><?php echo esc_html($desc); ?></p>
            </div>
        </section>

        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>

