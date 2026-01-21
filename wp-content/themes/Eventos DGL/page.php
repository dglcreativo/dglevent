<?php

if(!is_front_page()):
    $section_page = 'section-page';
endif;

$container = function_exists('get_field') && get_field('container_fluid_body') == '0' ? 'container' : 'container-fluid p-0';
$pb_header_body = get_field('pb_header_body');
if($pb_header_body == '0'):
    $pb_header = '0px 0px';
else:
    $pb_header = $pb_header_body.'px' . ' ' . '0px';
endif;
get_header();

while (have_posts()) : the_post();
    ?>

<div class="site-content <?php echo esc_attr($section_page); ?>" id="content" style="padding: <?php echo esc_attr($pb_header); ?>">

        <div class="<?php echo esc_attr($container); ?>">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php
                    wp_link_pages(array(
                        'before' => '<ul class="page-numbers p-numbers"><li>',
                        'after' => '</li></ul>',
                        'separator' => '</li><li>',
                    ));
                    ?>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->
        </div>

    </div>

<?php
endwhile;

get_footer();

