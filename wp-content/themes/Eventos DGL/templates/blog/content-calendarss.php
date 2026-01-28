<div class="col-md-12">
    <div class="calendario-full-line">
        <?php
        // 1. LÓGICA DE FECHAS
        $mes_actual = isset($_GET['mes']) ? $_GET['mes'] : date('m');
        $anio_actual = isset($_GET['anio']) ? $_GET['anio'] : date('Y');
        $fecha_click = isset($_GET['fecha_filtro']) ? $_GET['fecha_filtro'] : '';

        $fecha_base = DateTime::createFromFormat('Y-m-d', "$anio_actual-$mes_actual-01");

        // Meses para los laterales
        $mes_ant = clone $fecha_base;
        $mes_ant->modify('-1 month');
        $mes_sig = clone $fecha_base;
        $mes_sig->modify('+1 month');

        // RECOPILAR EVENTOS
        $fechas_totales = [];
        $q_todas = new WP_Query(['post_type' => 'eventos', 'posts_per_page' => -1]);
        if ($q_todas->have_posts()) {
            while ($q_todas->have_posts()) {
                $q_todas->the_post();
                $rep = get_field('fecha_evento');
                if ($rep) {
                    foreach ($rep as $f) {
                        $inicio = $f['fecha'];
                        if ($f['fechas_consecutivas'] && !empty($f['segunda_fecha'])) {
                            $periodo = new DatePeriod(new DateTime($inicio), new DateInterval('P1D'), (new DateTime($f['segunda_fecha']))->modify('+1 day'));
                            foreach ($periodo as $d) {
                                $fechas_totales[] = $d->format("Ymd");
                            }
                        } else {
                            $fechas_totales[] = $inicio;
                        }
                    }
                }
            }
        }
        wp_reset_postdata();
        $fechas_totales = array_unique($fechas_totales);
        ?>

        <div class="timeline-container">
            <a href="?mes=<?php echo $mes_ant->format('m'); ?>&anio=<?php echo $mes_ant->format('Y'); ?>"
               class="nav-mes">
                <span class="flecha"><i class="fas fa-arrow-left"></i></span>
            </a>

            <div class="mes-actual-label">
                <?php echo wp_date('F Y', $fecha_base->getTimestamp()); ?>
            </div>

            <div class="swiper-container-dias">
                <div class="swiper-wrapper">
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
                        <div class="swiper-slide">
                            <a href="?fecha_filtro=<?php echo $fecha_comp; ?>&mes=<?php echo $mes_actual; ?>&anio=<?php echo $anio_actual; ?>"
                                <?php echo ($es_hoy) ? 'id="dia-inicio"' : ''; ?>
                               class="dia-item <?php echo $tiene_evento ? 'con-evento' : ''; ?> <?php echo $es_hoy ? 'es-hoy' : ''; ?> <?php echo $esta_seleccionado ? 'activo' : ''; ?>">

                                <!--<span class="dia-nombre"><?php /*echo wp_date('D', $ts); */?></span>-->
                                <span class="dia-num"><?php echo $i; ?></span>

                                <?php if ($tiene_evento): ?>
                                    <span class="punto-evento"></span>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <a href="?mes=<?php echo $mes_sig->format('m'); ?>&anio=<?php echo $mes_sig->format('Y'); ?>"
               class="nav-mes">
                <span class="nombre-mes-nav"><?php echo wp_date('F Y', $mes_sig->getTimestamp()); ?></span>
            </a>
        </div>
    </div>
</div>

<style>
    /* Contenedor principal alineado */
    .timeline-container {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px 0 25px 0;
        background: #fff;
        overflow: hidden; /* Evita scrolls raros */
        margin-bottom: 10px;
    }

    /* Meses Laterales y Actual */
    .nav-mes {
        text-decoration: none !important;
        color: #999;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        flex-shrink: 0;
    }

    .mes-actual-label {
        font-weight: 900;
        text-transform: uppercase;
        font-size: 13px;
        flex-shrink: 0;
    }

    /* SWIPER: Ocultar barras por completo */
    .swiper-container-dias {
        flex-grow: 1;
        overflow: hidden;
        position: relative;
        padding-bottom: 10px; /* Espacio para el punto */
        margin-top: 10px;
    }

    .swiper-wrapper {
        scrollbar-width: none; /* Firefox */
    }

    .swiper-wrapper::-webkit-scrollbar {
        display: none; /* Chrome/Safari */
    }

    .swiper-free-mode > .swiper-wrapper {
        transition-timing-function: ease-out;
        margin: 6px auto;
    }


    /* DÍAS */
    .swiper-slide {
        width: auto !important;
    }

    .dia-item {
        text-align: center;
        text-decoration: none !important;
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 20px;
        position: relative;
    }

    .dia-nombre {
        font-size: 10px;
        color: #bbb;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .dia-num {
        font-size: 14px;
        line-height: 1;
    }

    /* ESTADO ACTIVO (ROJO) */
    .dia-item.activo .dia-num,
    .dia-item.activo .dia-nombre {
        color: #ff0000 !important;
    }

    /* HOY (Subrayado discreto) */
    .dia-item.es-hoy .dia-num {
        font-size: 20px;
        margin-top: -6px;
        border-bottom: 2px solid #000;
    }

    .dia-item.activo.es-hoy .dia-num {
        border-bottom-color: #ff0000;
    }

    /* PUNTO ROJO DE EVENTO */
    .punto-evento {
        width: 5px;
        height: 5px;
        background-color: #ff0000;
        border-radius: 50%;
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            const swiperDias = new Swiper('.swiper-container-dias', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                freeMode: true,
                grabCursor: true,
                on: {
                    init: function () {
                        // Centrar el día de hoy o el seleccionado al cargar
                        const target = document.querySelector('.dia-item.activo') || document.querySelector('#dia-inicio');
                        if (target) {
                            const slides = Array.from(document.querySelectorAll('.swiper-slide'));
                            const index = slides.indexOf(target.parentElement);
                            this.slideTo(index, 0);
                        }
                    },
                },
            });
        }
    });
</script>