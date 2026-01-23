<?php

if(!defined('ABSPATH')){
    exit;
}

get_header();

if (is_home() && is_front_page() == false) {
    $page_for_posts = get_option( 'page_for_posts' );
    $blog_page = get_post($page_for_posts);
    $new_wp_meta = get_post_meta( $page_for_posts );
}


$blog_column = is_active_sidebar( 'sidebar-default' ) ? '8' : '12';
?>

<div class="site-conten section-page" id="content">
    <div class="container">
        <main id="main" class="site-main section-blog row">

            <div class="col-md-<?php echo esc_attr($blog_column) ?>">
                <?php
                if(have_posts()):
                ?>
                <div class="vivero-classic">
                    <?php while(have_posts()) : the_post();
                        get_template_part('templates/blog/content-blog', 'classic');
                    endwhile;
                    ?>
                </div>
                <?php vivero_get_pagination(); ?>
                <?php endif; ?>
            </div>
            
            <?php if(is_active_sidebar('sidebar-default')) : ?>
            <aside class="sidebar col-md-4">
                <section><?php dynamic_sidebar('sidebar-default'); ?></section>
            </aside>
            <?php endif; ?>

        </main>
    </div>
</div>
<?php 
get_footer();