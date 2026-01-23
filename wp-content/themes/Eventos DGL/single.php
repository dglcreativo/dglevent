<?php
if(!defined('ABSPATH')){
    exit;
}

global $new_options;
$vertical = isset($new_options['new_header_type']) ? $new_options['new_header_type'] : 'classic';

$blog_column = is_active_sidebar( 'sidebar-single' ) ? '8' : '12';

get_header();

?>

<div class="site-content section-page" id="content">
    <div class="container">
        <main id="main" class="site-main section-blog row">
            <div id="primary" class="col-md-<?php echo esc_attr($blog_column) ?>">
                <?php
                if(have_posts()):
                     while(have_posts()) : the_post() ?>
                         <?php get_template_part( 'templates/blog/content', 'single' ); ?>
                        <?php endwhile; ?>
                <?php else:
                    get_template_part('content', 'none');
                endif;?>
            </div>
            <?php if(is_active_sidebar('sidebar-single')) : ?>
            <aside class="sidebar col-md-4">
                <section><?php dynamic_sidebar('sidebar-single'); ?></section>
            </aside>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php get_footer(); ?>
