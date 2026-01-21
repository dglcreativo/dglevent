<?php
$post_id = get_the_ID();
if (has_post_thumbnail($post_id)):
    ?>
    <header class="entry-header vivero-thumbnails">
        <?php
        if (is_single()) {
            the_post_thumbnail('new_container_full');
        } else {
            the_post_thumbnail('new_post_img');
        }
        ?>
        <?php
        $meta = array(1 => '1', 2 => '1', 3 => '1');
        $display_meta = false;
        foreach ($meta as $value) {
            if ($value == 1) {
                $display_meta = true;
            }
        }

        if ($display_meta):
            ?>
            <div class="entry-meta">
                <?php if ($meta['1'] == 1) : ?>
                    <span class="time updated"><?php the_time(get_option('date_format'), '', '', FALSE) ?></span>
                <?php
                endif;
                if ($meta['2'] == 1) :
                    ?>
                    <span class="author vcard"><?php _e('por ', 'new'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php the_author(); ?></a></span>
                <?php endif; ?>
                <?php if ($meta['3'] == 1) : ?>
                    <span class="category"><?php _e('en', 'new'); ?> <?php the_category('&nbsp;&bull;&nbsp;'); ?></span>
            <?php endif; ?>
            </div>
    <?php endif; ?>
    </header>
<?php
else:


    $meta = array(1 => '1', 2 => '1', 3 => '1');
    $display_meta = false;
    foreach ($meta as $value) {
        if ($value == 1) {
            $display_meta = true;
        }
    }

    if ($display_meta):
        ?>
        <div class="entry-meta">
            <?php if ($meta['1'] == 1) : ?>
                <span class="time updated"><?php the_time(get_option('date_format'), '', '', FALSE) ?></span>
            <?php
            endif;
            if ($meta['2'] == 1) :
                ?>
                <span class="author vcard"><?php _e('por ', 'new'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php the_author(); ?></a></span>
            <?php endif; ?>
        <?php if ($meta['3'] == 1) : ?>
                <span class="category"><?php _e('en', 'new'); ?> <?php the_category('&nbsp;&bull;&nbsp;'); ?></span>
        <?php endif; ?>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?php if (is_single()) : ?>
    <h1 class="entry-title"><?php the_title(); ?></h1>
<?php else : ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php endif;
