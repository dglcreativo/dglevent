<?php
if(!defined('ABSPATH')){
    exit;
}
global $new_options;
$vertical = isset($new_options['new_header_type']) ? $new_options['new_header_type'] : 'classic';

get_header('learn');

vivero_get_heading_learn();
?>
<div class="site-content" id="content">
    <div class="container">
        <main id="main" class="site-main section-blog-redux row">
            <div id="primary" class="col-md-12">
                <?php
                if(have_posts()):
                    $type_blog = 'learn';
                    ?>
                    <div class="row <?php echo esc_attr($type_blog); ?>">
                        <?php while(have_posts()) : the_post() ?>
                            <?php get_template_part('templates/blog/content', 'learn') ?>
                        <?php endwhile; ?>
                    </div>
                    <?php vivero_get_pagination();
                else:
                    get_template_part('content', 'none');
                endif;?>
            </div>
            <aside class="sidebar col-md-12">
                <section class=" widget-redux-learn-bt"><?php dynamic_sidebar('sidebar-learn'); ?></section>
            </aside>
        </main>
    </div>
</div>

<?php
get_footer();
?>