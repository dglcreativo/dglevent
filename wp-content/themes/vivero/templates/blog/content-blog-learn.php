<?php
$col_class = 'col-md-12 services-classic';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($col_class); ?>>

    <div class="type-service">

        <div class="info-services">
            <h4 class="carousel-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
            <?php the_excerpt(); ?>
            <?php
            $terms = get_the_terms(get_the_ID(), 'learn'); // Cambia 'categoria_producto' por el slug de tu taxonomía

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<ul class="banner-categories tag-cloud">';
                foreach ($terms as $term) {
                    echo '<a class="tag-cloud-link" href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a>';
                }
                echo '</ul>';
            }
            ?>
        </div>

        <div class="figure-services">
            <?php the_post_thumbnail('new_post_img'); ?>
        </div>

    </div>
</article>


