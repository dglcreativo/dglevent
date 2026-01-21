<?php

if(!defined('ABSPATH')){
    exit;
}

global $new_options;
$vertical = isset($new_options['new_header_type']) ? $new_options['new_header_type'] : 'classic';

get_header('learn');

vivero_get_heading();

?>

<div class="site-content" id="content">
    <div class="container">
        <main id="main" class="site-main section-blog row">
            <div id="primary" class="w-100">
                <?php
                if(have_posts()):
                    while(have_posts()) : the_post() ?>
                        <?php get_template_part( 'templates/blog/content-learn', 'single' ); ?>
                    <?php endwhile; ?>
                <?php else:
                    get_template_part('content', 'none');
                endif;?>
            </div>
        </main>
    </div>
</div>

<?php get_footer(); ?>


