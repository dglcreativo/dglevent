<?php
$col_class = 'col-md-12 services-classic vivero-blog-classic';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($col_class); ?>>
    <?php

    $meta = array(1 => '1', 2 => '1', 3 => '1');
    $display_meta = false;
    foreach ($meta as $value) {
        if ($value == 1) {
            $display_meta = true;
        }
    }

    if ($display_meta):
        ?>
    <div class="entry-header vivero-thumbnails vivero-redux-meta">
        <div class="entry-meta">
            <?php if ($meta['1'] == 1) : ?>
                <span class="time updated"><?php the_time(get_option('date_format'), '', '', FALSE) ?></span>
            <?php
            endif;
            if ($meta['2'] == 1) :
                ?>
                <span class="author vcard"><?php _e('por ', 'new'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php the_author(); ?></a></span>
            <?php endif; ?>
            <?php if ($meta['3'] == 1) :
                $terms = get_the_terms(get_the_ID(), 'dgl_redux_category'); // Cambia 'categoria_producto' por el slug de tu taxonomía
                if (!empty($terms) && !is_wp_error($terms)) {

                foreach ($terms as $term) {
                    echo '<a class="redux-cat-meta" href="' . get_term_link($term) . '">' . '<span class="category">' . _e('en', 'new') . ' ' . the_category('&nbsp;&bull;&nbsp;') . esc_html($term->name) . '</span> </a>';
                }

            } ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="type-service">

        <div class="info-services">
            <h4 class="carousel-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
            <?php the_excerpt(); ?>
            <?php
            $terms = get_the_terms(get_the_ID(), 'dgl_redux_category'); // Cambia 'categoria_producto' por el slug de tu taxonomía

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<ul class="banner-categories tagcloud">';
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
