<?php
$esPropio = get_field('es_propio');
$urlEventoExterno = get_field('url_evento_externo');
$titulo_evento = get_field('titulo_del_evento');



if (is_single()) : ?>
    <h1 class="entry-title"><?php the_title(); ?></h1>
<?php else : ?>
    <div class="content-entry">
    <?php
    if (!$esPropio): ?>
        <h2 class="entry-title"><a href="<?php echo esc_url($urlEventoExterno); ?>"
                                   title="<?php the_title_attribute(); ?>" target="_blank"><?php echo esc_html($titulo_evento) ?></a>
        </h2>
    <?php else:
        if ($esPropio):
            ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"
                                       title="<?php the_title_attribute(); ?>"><?php echo esc_html($titulo_evento) ?></a>
            </h2>

        <?php
        endif;
    endif;
    ?>
<?php endif;

