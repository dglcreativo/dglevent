<?php
if(!defined('ABSPATH')){
    exit;
}
global $new_options;
$vertical = isset($new_options['new_header_type']) ? $new_options['new_header_type'] : 'classic';

get_header();

?>
<div class="site-content section-page" id="content">
    <div class="container">
        <main id="main" class="site-main section-blog row">
            <div id="primary" class="col-md-8">
                <?php
                if(have_posts()):
                    $type_blog = 'classic';
                    ?>
                    <div class="row <?php echo esc_attr($type_blog); ?>">
                        <?php while(have_posts()) : the_post() ?>
                            <?php get_template_part('templates/blog/content-blog', 'classic') ?>
                        <?php endwhile; ?>
                    </div>
                    <?php vivero_get_pagination();
                else:
                    get_template_part('content', 'none');
                endif;?>
            </div>
            <aside class="sidebar col-md-4">
                <section><?php dynamic_sidebar('sidebar-default'); ?></section>
            </aside>
        </main>
    </div>
</div>

<?php
get_footer();
?>


