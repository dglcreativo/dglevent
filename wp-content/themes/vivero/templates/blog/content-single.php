
<?php
$post_type = get_post_type();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 vivero-blog-classic'); ?>>

    <?php /*// get the right post format template
    $post_format = get_post_format();
    if ($post_format == false) {
        $post_format = 'standard';
    };
    get_template_part('templates/format/format', $post_format);
    */?>
    <div class="entry-content">

        <?php the_content(); ?>
        <?php wp_link_pages( array(
            'before'      => '<ul class="page-numbers p-numbers"><li>',
            'after'       => '</li></ul>',
            'separator'   =>  '</li><li>',
        ) );
        ?>

        <?php if ($post_type == "post") : ?>

            <section class="row">
                <div class="post-navigation col-md-12">

                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();

                    if (empty( $prev_post ) &&  empty( $next_post ) ):?>
                        <p></p>
                    <?php else : ?>
                        <div class="wrapper clearfix">

                            <?php if (!empty( $prev_post )): ?>
                                <?php
                                $prev_thumbnail_id = get_post_thumbnail_id( $prev_post->ID );
                                $prev_thumbnail_src = wp_get_attachment_image_src($prev_thumbnail_id, 'large');
                                ?>
                                <div class="text-left prev-post <?php if ($prev_thumbnail_id != "") :?>bg-img<?php endif;?> "
                                    <?php if ($prev_thumbnail_id != "") :?>
                                        style='background-image:url("<?php echo esc_url($prev_thumbnail_src[0]);?>");'
                                    <?php endif;?>>

                                    <a class="equal-height-item" href="<?php echo esc_url(get_permalink($prev_post->ID));?>">
								<span class="text-uppercase primary-color" >
									<?php esc_html_e( 'Anterior', 'new' );?>
								</span>
                                        <h4><?php echo esc_html($prev_post->post_title); ?></h4>
                                    </a>
                                </div>
                            <?php endif;?>

                            <?php if (!empty( $next_post )): ?>
                                <?php
                                $next_thumbnail_id = get_post_thumbnail_id( $next_post->ID );
                                $next_thumbnail_src = wp_get_attachment_image_src($next_thumbnail_id, 'large');
                                ?>
                                <div class="text-right next-post <?php if ($next_thumbnail_id != "") :?>bg-img<?php endif;?>"
                                    <?php if ($next_thumbnail_id != "") :?>
                                        style='background-image:url("<?php echo esc_url($next_thumbnail_src[0]);?>");'
                                    <?php endif;?>>

                                    <a class="equal-height-item" href="<?php echo esc_url(get_permalink($next_post->ID));?>">
								<span class="text-uppercase primary-color" >
									<?php esc_html_e( 'Siguiente', 'new' );?>
								</span>
                                        <h4><?php echo esc_html($next_post->post_title); ?></h4>
                                    </a>
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endif;?>
                </div>
            </section>
            <?php
            if (!function_exists('wp_link_pages')) {
                posts_nav_link();
            }
            if (!function_exists('posts_nav_link')) {
                wp_link_pages();
            }
            ?>
        <?php endif; ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->

