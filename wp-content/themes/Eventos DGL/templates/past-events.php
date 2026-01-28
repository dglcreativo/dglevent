<?php
/* Template Name: Histórico de Eventos Pasados */

get_header('eventos');

$container = function_exists('get_field') && get_field('container_fluid_body') == '0' ? 'container' : 'container-fluid';
$hoy_raw = date('Ymd');
?>

    <div class="site-content section-blog" id="content">
        <div class="<?php echo esc_attr($container); ?>">
            <main id="main" class="site-main row">
                <?php the_content(); ?>
                <div class="col-md-12 mt-4">
                    <?php
                    // 1. Traemos todos los eventos (publicados)
                    $args = array(
                        'post_type'      => 'eventos',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish'
                    );

                    $query_pasados = new WP_Query($args);
                    $eventos_pasados = array();

                    if($query_pasados->have_posts()):
                        while($query_pasados->have_posts()) : $query_pasados->the_post();
                            $fechas_repetidor = get_field('fecha_evento');
                            $es_pasado = false;
                            $ultima_fecha_evento = '';

                            if ($fechas_repetidor && is_array($fechas_repetidor)) {
                                // Encontramos la fecha más lejana del evento
                                foreach ($fechas_repetidor as $f) {

                                    /** * CORRECCIÓN AQUÍ:
                                     * Solo si 'fechas_consecutivas' es true, usamos la segunda fecha.
                                     * Si no, usamos solo la fecha principal.
                                     */
                                    $fecha_final_bloque = (!empty($f['fechas_consecutivas']) && !empty($f['segunda_fecha'])) ? $f['segunda_fecha'] : $f['fecha'];

                                    if ($ultima_fecha_evento === '' || $fecha_final_bloque > $ultima_fecha_evento) {
                                        $ultima_fecha_evento = $fecha_final_bloque;
                                    }
                                }

                                // Si la fecha más lejana es menor que hoy, el evento ya pasó por completo
                                if ($ultima_fecha_evento !== '' && $ultima_fecha_evento < $hoy_raw) {
                                    $es_pasado = true;
                                }
                            }

                            if ($es_pasado) {
                                $eventos_pasados[] = array(
                                    'ID'    => get_the_ID(),
                                    'fecha' => $ultima_fecha_evento // Ordenaremos por la fecha en que terminó
                                );
                            }
                        endwhile;
                        wp_reset_postdata();

                        // 2. ORDENACIÓN (De más reciente a más antiguo)
                        usort($eventos_pasados, function($a, $b) {
                            return strcmp($b['fecha'], $a['fecha']);
                        });

                        // 3. MOSTRAR RESULTADOS
                        if (!empty($eventos_pasados)): ?>
                            <div class="new-classic">
                                <?php
                                foreach ($eventos_pasados as $item) :
                                    $post = get_post($item['ID']);
                                    setup_postdata($post);
                                    // Reutilizamos tu diseño de tarjeta actual
                                    get_template_part('templates/blog/content-blog', 'learn');
                                endforeach;
                                wp_reset_postdata();
                                ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center" style="padding: 50px;">
                                <p>No hay eventos registrados en el histórico.</p>
                            </div>
                        <?php endif;
                    endif; ?>
                </div>
            </main>
        </div>
    </div>

<?php get_footer(); ?>