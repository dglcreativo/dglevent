<?php
global $new_options;
$new_heading_blog_normal = isset($new_options['new_heading_blog_normal']) ? $new_options['new_heading_blog_normal'] : 'center';



$post_id = get_the_ID();
if (is_single() || is_singular('post') && has_post_thumbnail($post_id)) {
    ?>
    <figure class="entry-header vivero-heading-thumbnails">

    <?php
    the_post_thumbnail('vivero_heading_page');
    ?>

        <div class="heading-page-h1-img">
            <h1 class="entry-title"><?php vivero_get_page_title(); ?></h1>
    <?php //the_excerpt(); ?>
        </div>
        <div class="overlay-heading"></div>
    </figure>
<?php
} else if (is_home()) {

    if($new_heading_blog_normal == 'center'){
        $blog_page_id = get_option('page_for_posts'); // ID de la página asignada para el blog
        if ($blog_page_id && has_post_thumbnail($blog_page_id)) { ?>
            <div class="vivero-heading-thumbnails">
                <?php echo get_the_post_thumbnail($blog_page_id, 'vivero_heading_page'); ?>
                <div class="heading-page-h1-img">
                    <h1 class="entry-title"><?php vivero_get_page_title(); ?></h1>
                </div>
                <div class="overlay-heading"></div>
            </div>

        <?php }
    } else {
        if($new_heading_blog_normal == 'left'){ ?>
            <div class="page-heading section vivero-heading-page">

                <div class="container">

                    <div class="heading-page-h1">
                        <h1 class="entry-title"><?php vivero_get_page_title(); ?></h1>
                    </div>
                </div>
            </div>
        <?php } else {
            if($new_heading_blog_normal == 'classic'){
                $blog_page_id = get_option('page_for_posts');
                $blog_page_title = get_the_title($blog_page_id);
                $blog_page_excerpt = get_the_excerpt($blog_page_id)?>
            <div class="page-heading-small section vivero-heading-page">

                <div class="container phs-flex">

                    <div class="heading-page-h1">
                        <h1 class="entry-title"><?php echo $blog_page_title; ?></h1>
                    </div>
                    <p><?php echo $blog_page_excerpt; ?></p>
                </div>
            </div>
            <?php }
        }
    } ?>




<?php }// Si es una página y tiene imagen destacada, mostrarla
elseif (is_page() && has_post_thumbnail($post_id)) {
    ?>
    <figure class="entry-header vivero-heading-thumbnails">
        <?php the_post_thumbnail('vivero_heading_page'); ?>
        <div class="heading-page-h1-img">
            <h1 class="entry-title"><?php vivero_get_page_title(); ?></h1>
            <?php the_excerpt(); ?>
        </div>
        <div class="overlay-heading"></div>
    </figure>
<?php
} else {
    ?>
    <div class="page-heading section vivero-heading-page">

        <div class="container">

            <div class="heading-page-h1">
                <h1 class="entry-title"><?php vivero_get_page_title(); ?></h1>
            </div>
        </div>
    </div>
<?php } ?>



