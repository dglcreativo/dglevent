<?php

$fecha_evento = get_field('fecha_evento');
$imagenes_evento = get_field('imagenes_evento');
$lugar_imagen = get_field('lugar_imagen');
$subtitulo_evento = get_field('subtitulo_evento');
$titulo_evento = get_field('titulo_del_evento');
$organizadores = get_field('organizadores');
$titulo_intervienen = get_field('titulo_para_intervinientes_o_compositores');
$intervienen = get_field('intervienen');
$descripcion_evento = get_field('descripcion_evento');
$titulo_programa = get_field('titulo_programa');
$programas = get_field('programas');

?>
<article id="post-<?php the_ID(); ?>">

    <div class="entry-content">

        <div class="row">
            <div class="col-md-6">
                <?php
                $hoy = date('Ymd');
                $fecha_mas_proxima = null;
                $hora_mostrar = '';

                if ($fecha_evento) :
                    foreach ($fecha_evento as $f) {
                        $fecha_item = $f['fecha'];
                        $fecha_fin = $f['segunda_fecha'];
                        $es_rango = $f['fechas_consecutivas'];
                        $hora_item = isset($f['hora_evento']) ? $f['hora_evento'] : '';

                        if (!$es_rango && $fecha_item >= $hoy) {
                            if (!$fecha_mas_proxima || $fecha_item < $fecha_mas_proxima) {
                                $fecha_mas_proxima = $fecha_item;
                                $hora_mostrar = $hora_item;
                            }
                        }
                        elseif ($es_rango && !empty($fecha_fin)) {
                            if ($fecha_fin >= $hoy) {
                                $proxima_temp = ($fecha_item < $hoy) ? $hoy : $fecha_item;
                                if (!$fecha_mas_proxima || $proxima_temp < $fecha_mas_proxima) {
                                    $fecha_mas_proxima = $proxima_temp;
                                    $hora_mostrar = $hora_item;
                                }
                            }
                        }
                    }

                    if (!$fecha_mas_proxima) {
                        $fecha_mas_proxima = $fecha_evento[0]['fecha'];
                        $hora_mostrar = $fecha_evento[0]['hora_evento'];
                    }

                    $d_obj = DateTime::createFromFormat('Ymd', $fecha_mas_proxima);
                    if ($d_obj) :
                        $timestamp = $d_obj->getTimestamp();
                        ?>
                        <div class="evento-info-header">
                            <div class="f-col-izquierda">
                                <span class="f-dia-nombre"><?php echo wp_date('l', $timestamp); ?></span>
                                <div class="f-grupo-dia">
                                    <span class="f-dia-num"><?php echo wp_date('j', $timestamp); ?></span>
                                    <div class="f-mes-anio">
                                        <span class="f-mes"><?php echo wp_date('F', $timestamp); ?></span>
                                        <span class="f-year"><?php echo wp_date('Y', $timestamp); ?></span>
                                    </div>
                                </div>
                            </div>

                            <?php if ($hora_mostrar) : ?>
                                <div class="f-col-derecha">
                                    <span class="f-hora-label">Hora</span>
                                    <span class="f-hora-valor"><?php echo esc_html($hora_mostrar); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;
                endif;
                ?>

                <div class="titulo-imagen-d">
                    <p><?php echo esc_html($lugar_imagen); ?></p>
                </div>

                <?php if ($subtitulo_evento != ''): ?>
                    <div class="subtitulo-evento">
                        <h5><?php echo esc_html($subtitulo_evento); ?></h5>
                    </div>
                <?php endif; ?>

                <div class="titulo-evento">
                    <h1><?php echo esc_html($titulo_evento); ?></h1>
                </div>

                <div class="organizadores">
                    <?php
                    foreach ($organizadores as $organizador):
                        $item_org = $organizador['organizador'];
                        ?>
                        <p><?php echo esc_html($item_org); ?></p>
                    <?php endforeach;
                    ?>
                </div>

                <?php if ($titulo_intervienen != ''): ?>
                    <div class="titulo-intervienen">
                        <p><?php echo esc_html($titulo_intervienen); ?></p>
                    </div>
                <?php endif; ?>

                <div class="intervienen">
                    <?php
                    foreach ($intervienen as $interviene):
                        $item_artista = $interviene['artista'];
                        $item_instrumento = $interviene['instrumento'];
                        $item_que = $interviene['que_instrumento'];

                        if (!$item_instrumento): ?>
                            <p><?php echo esc_html($item_artista); ?></p>
                        <?php else: ?>
                            <p><?php echo esc_html($item_artista); ?>, <span><?php echo esc_html($item_que); ?></span>
                            </p>

                        <?php endif;
                    endforeach;
                    ?>
                </div>

                <div class="descripcion-evento">
                    <p><?php echo esc_html($descripcion_evento); ?></p>
                </div>

                <?php if ($titulo_intervienen != ''): ?>
                    <div class="titulo-programas">
                        <p><?php echo esc_html($titulo_programa); ?></p>
                    </div>

                    <div class="programas">
                        <?php
                        foreach ($programas as $programa):
                            $item_prog = $programa['programa'];
                            ?>
                            <p><?php echo esc_html($item_prog); ?></p>
                        <?php endforeach;
                        ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="col-md-6">
                <div class="fechas-single">
                    <div class="accordion" id="accordionBlock">
                        <div class="card">
                            <div class="card-header" id="heading-fechas">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapse-fechas" aria-expanded="true"
                                            aria-controls="collapse-fechas">
                                        Fechas del Evento
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse-fechas" class="collapse" aria-labelledby="heading-fechas"
                                 data-parent="#accordionBlock">
                                <div class="card-body">
                                    <?php
                                    foreach ($fecha_evento as $fechas):
                                        $item_fecha = $fechas['fecha'];
                                        $item_consecutivo = $fechas['fechas_consecutivas'];
                                        $item_fecha_dos = $fechas['segunda_fecha'];

                                        // Función interna para no repetir código de formateo
                                        $formatear = function ($fecha_raw) {
                                            if (!$fecha_raw) return '';
                                            $d_obj = DateTime::createFromFormat('Ymd', $fecha_raw);
                                            if (!$d_obj) return $fecha_raw;
                                            $ts = $d_obj->getTimestamp();

                                            return '
                                <span class="f-dia-nombre">' . wp_date('l', $ts) . '</span>
                                <span class="f-dia-num">' . wp_date('j', $ts) . '</span>
                                <span class="f-mes">' . wp_date('F', $ts) . '</span>
                                <span class="f-año">' . wp_date('Y', $ts) . '</span>';
                                        };
                                        ?>
                                        <div class="la-fecha" style="margin-bottom: 10px;">
                                            <?php if (!$item_consecutivo): ?>
                                                <p><?php echo $formatear($item_fecha); ?></p>
                                            <?php else: ?>
                                                <p>
                                                    <small style="font-size: 0.7rem; display:block;">Rango de
                                                        fechas:</small>
                                                    <span class="desde-wrap">
                                        <small>Del </small><?php echo $formatear($item_fecha); ?>
                                    </span>
                                                    <span class="al-wrap">
                                        <small>al </small><?php echo $formatear($item_fecha_dos); ?>
                                    </span>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="imagenes-single">
                    <?php
                    foreach ($imagenes_evento as $imagenes):
                        $imagen_evento = $imagenes['imagen_eventos'];
                        ?>
                        <img src="<?php echo esc_url($imagen_evento); ?>" alt="">
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

    </div><!-- .entry-content -->
</article><!-- #post-## -->

