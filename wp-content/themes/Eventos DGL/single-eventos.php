<?php
if(!defined('ABSPATH')){
    exit;
}

get_header('eventos');

?>

<div class="site-content section-page" id="content">
    <div class="container">
        <main id="main" class="site-main section-blog">
            <div class="row">
                <div id="primary" class="col-md-12">
                    <div class="new-single-post">
                        <?php
                        if(have_posts()):
                            while(have_posts()) : the_post() ?>
                                <?php get_template_part( 'templates/blog/content-learn', 'single' ); ?>
                            <?php endwhile; ?>
                        <?php else:
                            get_template_part('content', 'none');
                        endif;?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php get_footer(); ?>

