<?php
if (!defined('ABSPATH')) {
    exit;
}
$pb_header_body = get_field('pb_header_body');
if($pb_header_body == '0'):
    $pb_header = '0px 0px';
else:
    $pb_header = $pb_header_body.'px' . ' ' . '0px';
endif;

get_header('eventos');

if (is_home() && is_front_page() == false) {
    $page_for_posts = get_option('page_for_posts');
    $blog_page = get_post($page_for_posts);
    $new_wp_meta = get_post_meta($page_for_posts);
}
$container = function_exists('get_field') && get_field('container_fluid_body') == '0' ? 'container' : 'container-fluid';

    ?>

    <div class="site-content section-blog" id="content" style="padding: <?php echo esc_attr($pb_header); ?>">
        <div class="<?php echo esc_attr($container); ?>">
            <main id="main" class="site-main row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <?php get_template_part('templates/blog/content', 'calendar'); ?>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>


                <div class="col-md-12">
                    <?php
                    $fecha_click = isset($_GET['fecha_filtro']) ? $_GET['fecha_filtro'] : '';
                    $hoy_raw = date('Ymd');

                    // 1. Traemos todos los posts para filtrarlos manualmente
                    $args = array(
                        'post_type'      => 'eventos',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish'
                    );

                    $blog_query = new WP_Query($args);
                    $eventos_finales = array();

                    if($blog_query->have_posts()):
                        while($blog_query->have_posts()) : $blog_query->the_post();
                            $fechas_repetidor = get_field('fecha_evento');
                            $post_valido = false;
                            $fecha_para_ordenar = '';

                            if ($fechas_repetidor && is_array($fechas_repetidor)) {
                                foreach ($fechas_repetidor as $f) {
                                    $inicio = $f['fecha'];
                                    $fin = $f['segunda_fecha'];
                                    $es_consecutivo = $f['fechas_consecutivas'];

                                    if ($fecha_click) {
                                        if ($es_consecutivo && !empty($fin)) {
                                            // Comprobamos si el día clicado está DENTRO del rango
                                            if ($fecha_click >= $inicio && $fecha_click <= $fin) {
                                                $post_valido = true;
                                                $fecha_para_ordenar = $inicio; // Mantenemos el orden por el inicio del evento
                                                break;
                                            }
                                        } else {
                                            // Comprobación de día único
                                            if ($inicio === $fecha_click) {
                                                $post_valido = true;
                                                $fecha_para_ordenar = $inicio;
                                                break;
                                            }
                                        }
                                    } else {
                                        // Lógica normal para mostrar eventos futuros (sin filtro)
                                        if ($inicio >= $hoy_raw || ($es_consecutivo && $fin >= $hoy_raw)) {
                                            $post_valido = true;
                                            $fecha_para_ordenar = $inicio;
                                        }
                                    }
                                }
                            }

                            if ($post_valido) {
                                $eventos_finales[] = array(
                                    'ID'    => get_the_ID(),
                                    'fecha' => $fecha_para_ordenar
                                );
                            }
                        endwhile;
                        wp_reset_postdata();

                        // 2. ORDENACIÓN
                        usort($eventos_finales, function($a, $b) {
                            return strcmp($a['fecha'], $b['fecha']);
                        });

                        // 3. MOSTRAR RESULTADOS
                        if (!empty($eventos_finales)): ?>

                            <?php if ($fecha_click): ?>
                                <div style="background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-left: 4px solid #000;">
                                    Filtrando por el día: <strong><?php echo date('d/m/Y', strtotime($fecha_click)); ?></strong>
                                    <a href="<?php echo explode('?', $_SERVER['REQUEST_URI'])[0]; ?>" style="float:right; color:red;">Limpiar filtro</a>
                                </div>
                            <?php endif; ?>

                            <div class="new-classic">
                                <?php
                                foreach ($eventos_finales as $item) :
                                    $post = get_post($item['ID']);
                                    setup_postdata($post);
                                    get_template_part('templates/blog/content-blog', 'learn');
                                endforeach;
                                ?>
                            </div>

                        <?php else: ?>

                            <div class="no-events-error" style="text-align: center; padding: 50px 20px; border: 2px dashed #ccc;">
                                <h3 style="color: #999;">Lo sentimos</h3>
                                <p>No se han encontrado eventos para el día <strong><?php echo date('d/m/Y', strtotime($fecha_click)); ?></strong>.</p>
                                <a href="<?php echo explode('?', $_SERVER['REQUEST_URI'])[0]; ?>" class="btn btn-primary">
                                    Ver todos los próximos eventos
                                </a>
                            </div>

                        <?php endif;
                    endif; ?>
                </div>
            </main>
        </div>
    </div>
<?php

get_footer();
