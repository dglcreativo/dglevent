<div class="col-md-12">
    <div class="calendario-ocg-style" style="position: relative; overflow: hidden;">

        <?php
        // 1. LÓGICA DE FECHAS
        $mes_actual = isset($_GET['mes']) ? $_GET['mes'] : date('m');
        $anio_actual = isset($_GET['anio']) ? $_GET['anio'] : date('Y');
        $fecha_click = isset($_GET['fecha_filtro']) ? $_GET['fecha_filtro'] : '';

        $fecha_base = DateTime::createFromFormat('Y-m-d', "$anio_actual-$mes_actual-01");
        $nombre_mes = wp_date('F Y', $fecha_base->getTimestamp());

        $mes_ant = clone $fecha_base; $mes_ant->modify('-1 month');
        $mes_sig = clone $fecha_base; $mes_sig->modify('+1 month');

        // Obtener eventos una sola vez
        $fechas_totales = [];
        $q_todas = new WP_Query(['post_type' => 'eventos', 'posts_per_page' => -1]);

        if($q_todas->have_posts()){
            while($q_todas->have_posts()){
                $q_todas->the_post();
                $rep = get_field('fecha_evento');

                if($rep){
                    foreach($rep as $f){
                        $inicio = $f['fecha']; // Ymd
                        $es_consecutivo = $f['fechas_consecutivas'];
                        $fin = $f['segunda_fecha']; // Ymd

                        if ($es_consecutivo && !empty($fin)) {
                            // SI ES RANGO: Generamos todos los días intermedios
                            $periodo = new DatePeriod(
                                new DateTime($inicio),
                                new DateInterval('P1D'),
                                (new DateTime($fin))->modify('+1 day') // Incluimos el día final
                            );

                            foreach ($periodo as $date) {
                                $fechas_totales[] = $date->format("Ymd");
                            }
                        } else {
                            // SI ES FECHA ÚNICA
                            $fechas_totales[] = $inicio;
                        }
                    }
                }
            }
        }
        wp_reset_postdata();

        // Eliminamos duplicados por si varios eventos coinciden el mismo día
        $fechas_totales = array_unique($fechas_totales);
        ?>

        <div class="calendario-header" style="display: flex; justify-content: space-between; align-items: center; padding: 0 40px; margin-bottom: 20px;">
            <a href="?mes=<?php echo $mes_ant->format('m'); ?>&anio=<?php echo $mes_ant->format('Y'); ?>" class="btn-nav-cal">&#10094;</a>
            <h3 style="margin:0; font-size: 1.3rem; text-transform: uppercase; font-weight: bold;"><?php echo $nombre_mes; ?></h3>
            <a href="?mes=<?php echo $mes_sig->format('m'); ?>&anio=<?php echo $mes_sig->format('Y'); ?>" class="btn-nav-cal">&#10095;</a>
        </div>

        <div class="dias-wrapper" style="position: relative; display: flex; align-items: center;">
            <button type="button" class="s-arrow s-left" onclick="scrollCal(-300)">&#10094;</button>

            <div id="calendario-scroll" class="dias-scroll">
                <?php
                $num_dias_mes = $fecha_base->format('t');
                for ($i = 1; $i <= $num_dias_mes; $i++) {
                    $dia_f = sprintf("%02d", $i);
                    $fecha_comp = $anio_actual . $mes_actual . $dia_f;
                    $ts = DateTime::createFromFormat('Ymd', $fecha_comp)->getTimestamp();

                    $tiene_evento = in_array($fecha_comp, $fechas_totales);
                    $es_hoy = ($fecha_comp == date('Ymd'));
                    $esta_seleccionado = ($fecha_comp == $fecha_click);
                    ?>
                    <a href="?fecha_filtro=<?php echo $fecha_comp; ?>&mes=<?php echo $mes_actual; ?>&anio=<?php echo $anio_actual; ?>"
                        <?php echo ($es_hoy) ? 'id="dia-inicio"' : ''; ?>
                       class="dia-item <?php echo $tiene_evento ? 'con-evento' : ''; ?> <?php echo $es_hoy ? 'es-hoy' : ''; ?> <?php echo $esta_seleccionado ? 'activo' : ''; ?>">
                        <span class="dia-nombre"><?php echo wp_date('D', $ts); ?></span>
                        <div class="num-circulo"><?php echo $i; ?></div>
                    </a>
                <?php } ?>
            </div>

            <button type="button" class="s-arrow s-right" onclick="scrollCal(300)">&#10095;</button>
        </div>
    </div>
</div>

<style>
    /* CSS UNIFICADO Y SEGURO */
    .calendario-ocg-style { padding: 20px 0; border-bottom: 1px solid #eee; }
    .btn-nav-cal { font-size: 16px; color: #000; text-decoration: none; }

    .dias-scroll {
        display: flex;
        overflow-x: auto;
        gap: 15px;
        padding: 10px 0;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
    }
    .dias-scroll::-webkit-scrollbar { display: none; } /* Chrome/Safari */

    .dia-item { min-width: 50px; text-align: center; text-decoration: none !important; color: #333; }
    .dia-nombre { display: block; font-size: 10px; color: #aaa; text-transform: uppercase; }
    .num-circulo { width: 40px; height: 40px; line-height: 40px; border-radius: 50%; margin: 5px auto; transition: 0.3s; }

    .dia-item.con-evento .num-circulo { background: #000; color: #fff; }
    .dia-item.es-hoy .num-circulo { border: 2px solid #000; }
    .dia-item.activo .num-circulo { background: #ff0000 !important; color: #fff; }

    /* FLECHAS DE LOS DÍAS */
    .s-arrow {
        background: #fff;
        border: transparent;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer;
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
    }
    .s-left { margin-right: 10px; }
    .s-right { margin-left: 10px; }
    .s-arrow:hover { color: #000; }
</style>

<script>
    // FUNCIÓN DE SCROLL MANUAL
    function scrollCal(distancia) {
        const contenedor = document.getElementById('calendario-scroll');
        if (contenedor) {
            contenedor.scrollBy({ left: distancia, behavior: 'smooth' });
        }
    }

    // POSICIONAMIENTO INICIAL
    window.addEventListener("load", function() {
        const contenedor = document.getElementById('calendario-scroll');
        const diaInicio = document.getElementById('dia-inicio');
        if (contenedor && diaInicio) {
            // Un pequeño retraso para asegurar que el scroll se aplique bien
            setTimeout(() => {
                contenedor.scrollLeft = diaInicio.offsetLeft - 60;
            }, 100);
        }
    });
</script>
