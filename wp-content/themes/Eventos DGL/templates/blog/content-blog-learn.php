<?php
$esPropio = get_field('es_propio');
$imagenExterna = get_field('imagen_externo');
$fechaEvento = get_field('fecha_evento');
$descripcion_evento = get_field('descripcion_evento');
$lugar_evento = get_field('lugar_imagen');
$url_evento_externo = get_field('url_evento_externo');

$classPropio = '';
if (!$esPropio):
    $classPropio = 'externo';
endif;

$col_class = 'new-blog-classic';

?>
<article id="post-<?php the_ID(); ?>" class="new-blog-classic <?php echo esc_attr($classPropio); ?>">
    <?php if ($esPropio): ?>
    <a href="<?php the_permalink(); ?>">
        <?php else : ?>
        <a href="<?php echo $url_evento_externo; ?>" target="_blank">
            <?php endif; ?>
            <?php $post_id = get_the_ID();

            if (has_post_thumbnail($post_id)):
                ?>
                <header class="entry-header new-thumbnails">
                    <?php
                    if (is_single()) {
                        the_post_thumbnail('new_container_full');
                    } else {
                        the_post_thumbnail('new_post_img');
                    }
                    ?>
                    <?php if (!$esPropio): ?>
                        <img class="img-externa-thumbnail" src="<?php echo esc_url($imagenExterna); ?>" alt="Evento"
                             width="35%">
                    <?php endif; ?>
                </header>
            <?php endif; ?>
            <div class="entry-meta">

        <span class="time updated">
        <?php
        if ($fechaEvento && is_array($fechaEvento)):

            $num_fechas = count($fechaEvento);

            if ($num_fechas > 1):
                // --- CASO: VARIAS FECHAS ---
                $primera_raw = $fechaEvento[0]['fecha'];
                $d_obj = DateTime::createFromFormat('Ymd', $primera_raw);

                if ($d_obj):
                    $timestamp = $d_obj->getTimestamp(); ?>
                    <div class="evento-container">
                        <span class="txt-previo"></span>
                        <span class="fecha-desglosada">
                            <span class="f-dia-nombre"></span>
                            <span class="f-dia-num" style="font-size:20px;"></span>
                            <span class="f-mes">Varias Fechas</span>
                            <span class="f-year"></span>
                        </span>
                    </div>
                <?php endif;

            else:
                // --- CASO: SOLO UNA FECHA ---
                foreach ($fechaEvento as $fechas):
                    $itemFecha = $fechas['fecha'];
                    $d_obj = DateTime::createFromFormat('Ymd', $itemFecha);

                    if ($d_obj):
                        $timestamp = $d_obj->getTimestamp(); ?>
                        <div class="evento-container">
                            <span class="f-dia-nombre"><?php echo wp_date('l', $timestamp); ?></span>
                            <span class="f-dia-num"
                                  style="font-size:20px;"><?php echo wp_date('j', $timestamp); ?></span>
                            <span class="f-mes"><?php echo wp_date('M', $timestamp); ?></span>
                            <span class="f-year"><?php echo wp_date('Y', $timestamp); ?></span>
                        </div>
                    <?php endif;
                endforeach;
            endif;

        endif;
        ?>
    </span>
            </div>

            <?php get_template_part('templates/format/format', 'grid');

            if ($esPropio) {
                // Si es propio, priorizamos el lugar del evento
                if ($lugar_evento != '') {
                    echo '<p>' . esc_html($lugar_evento) . '</p>';
                } else {
                    // Si no hay lugar pero es propio, ponemos descripción
                    if ($descripcion_evento) {
                        $descripcion_corta = mb_strimwidth($descripcion_evento, 0, 100, "...");
                        echo '<p>' . esc_html($descripcion_corta) . '</p>';
                    }
                }
            } else {
                // AQUÍ ESdonde entra cuando NO es propio
                if ($descripcion_evento) {
                    $descripcion_corta = mb_strimwidth($descripcion_evento, 0, 100, "...");
                    echo '<p>' . esc_html($descripcion_corta) . '</p>';
                }
            }
            ?>
            </div>
        </a>
</article>

