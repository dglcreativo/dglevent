<div class="site-content" id="content">
    <div class="container">
        <main id="main" class="site-main section-blog row">

            <div class="col-md-<?php echo esc_attr($data['blog_column']) ?>">
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

