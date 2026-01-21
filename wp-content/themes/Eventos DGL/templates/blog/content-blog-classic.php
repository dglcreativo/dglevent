<?php

$col_class = 'vivero-blog-classic mb-5';

$post_format = get_post_format();
if(!$post_format){
    $post_format = 'standard';
}
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($col_class); ?>>
    <?php get_template_part('templates/format/format', $post_format) ?>
    <?php if ($post_format != 'quote' && $post_format != 'status' && $post_format != 'link' && $post_format != 'image') : ?>
        <?php the_excerpt();
        $type_button = function_exists('get_field') && get_field('banner_type_button') ? 'btn btn-blue' : '';?>
        <?php $btn_classes = $type_button;  ?>
        <?php if(!$btn_classes){
            $btn_classes = 'btn btn-primary';
        } else {
            $btn_classes = $type_button;
        } ?>
            <a class="<?php echo esc_attr($btn_classes);?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html__('leer más', 'new');?></a>
    <?php endif; ?>
</article>

