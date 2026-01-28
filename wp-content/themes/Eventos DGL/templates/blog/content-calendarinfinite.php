<div class="col-md-12">
    <div class="calendario-ocg-layout-final">
        <?php
        // 1. FECHA DE REFERENCIA (Hoy)
        $fecha_referencia = new DateTime();
        $fecha_click = isset($_GET['fecha_filtro']) ? $_GET['fecha_filtro'] : '';

        // 2. LÓGICA DE EVENTOS (Tu Query de ACF se mantiene igual)
        $fechas_totales = [];
        $q_todas = new WP_Query(['post_type' => 'eventos', 'posts_per_page' => -1]);
        if($q_todas->have_posts()){
            while($q_todas->have_posts()){
                $q_todas->the_post();
                $rep = get_field('fecha_evento');
                if($rep){
                    foreach($rep as $f){
                        $inicio = $f['fecha'];
                        if ($f['fechas_consecutivas'] && !empty($f['segunda_fecha'])) {
                            $periodo = new DatePeriod(new DateTime($inicio), new DateInterval('P1D'), (new DateTime($f['segunda_fecha']))->modify('+1 day'));
                            foreach ($periodo as $d) { $fechas_totales[] = $d->format("Ymd"); }
                        } else { $fechas_totales[] = $inicio; }
                    }
                }
            }
        }
        wp_reset_postdata();
        ?>

        <div class="event-main-wrapper">
            <div class="nav-arrow prev-btn">&#10094;</div>

            <div class="mes-actual-info">
                <span id="label-mes-dinamico"><?php echo wp_date('F Y', $fecha_referencia->getTimestamp()); ?></span>
            </div>

            <div class="swiper-container-calendario">
                <div class="swiper-wrapper">
                    <?php
                    // BUCLE: -1 (Mes Anterior), 0 (Mes Actual), 1 (Mes Siguiente)
                    for ($m = -2; $m <= 3; $m++) {
                        $mes_iterar = clone $fecha_referencia;
                        $mes_iterar->modify("first day of this month");
                        $mes_iterar->modify("$m month");

                        $num_dias = $mes_iterar->format('t');
                        $m_nombre_label = wp_date('F Y', $mes_iterar->getTimestamp());
                        $anio_n = $mes_iterar->format('Y');
                        $mes_n = $mes_iterar->format('m');

                        // SEPARADOR VISUAL DE MES
                        ?>
                        <div class="swiper-slide slide-mes-separador" data-mes-actual="<?php echo $m_nombre_label; ?>">
                            <div class="separador-txt"><?php echo $m_nombre_label; ?></div>
                        </div>

                        <?php
                        for ($i = 1; $i <= $num_dias; $i++) {
                            $dia_f = sprintf("%02d", $i);
                            $fecha_comp = $anio_n . $mes_n . $dia_f;
                            $ts = DateTime::createFromFormat('Ymd', $fecha_comp)->getTimestamp();

                            $tiene_evento = in_array($fecha_comp, $fechas_totales);
                            $es_hoy = ($fecha_comp == date('Ymd'));
                            $esta_seleccionado = ($fecha_comp == $fecha_click);
                            ?>
                            <div class="swiper-slide slide-dia" data-mes-actual="<?php echo $m_nombre_label; ?>">
                                <a href="?fecha_filtro=<?php echo $fecha_comp; ?>"
                                    <?php echo ($es_hoy) ? 'id="dia-inicio"' : ''; ?>
                                   class="dia-item <?php echo $tiene_evento ? 'con-evento' : ''; ?> <?php echo $es_hoy ? 'es-hoy' : ''; ?> <?php echo $esta_seleccionado ? 'activo' : ''; ?>">
                                    <!--<span class="dia-nombre"><?php /*echo wp_date('D', $ts); */?></span>-->
                                    <span class="dia-num"><?php echo $i; ?></span>
                                    <?php if($tiene_evento): ?> <span class="punto-evento"></span> <?php endif; ?>
                                </a>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>

            <!--<div class="nav-arrow next-btn">&#10095;</div>-->
        </div>
    </div>
</div>

<style>
    .event-main-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0 25px 0;
    }

    .mes-actual-info {
        min-width: 115px;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 13px;
    }

    .nav-arrow { cursor: pointer; font-size: 18px; color: #ccc; transition: 0.3s; flex-shrink: 0; }
    .nav-arrow:hover { color: #ff0000; }

    .swiper-container-calendario { flex-grow: 1; overflow: hidden; }

    /* Días y Separadores */
    .slide-dia { width: auto !important; }
    .slide-mes-separador {
        width: auto !important;
        padding: 0 15px;
        display: flex;
        align-items: center;
    }
    .separador-txt { font-weight: 400; text-transform: lowercase; font-size: 13px; color: #000; white-space: nowrap; }

    .dia-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 25px;
        text-decoration: none !important;
        position: relative;
    }
    .dia-nombre { font-size: 8px; color: #bbb; text-transform: uppercase; font-weight: 700; }
    .dia-num { font-size: 13px; font-weight: 800; color: #333; line-height: 1; margin-top: 2px; }

    /* Estados */
    .dia-item.activo .dia-num, .dia-item.activo .dia-nombre { color: #ff0000 !important; }
    .dia-item.es-hoy .dia-num { border-bottom: 2px solid #000; }
    .punto-evento {
        width: 4px; height: 4px; background: #ff0000; border-radius: 50%;
        position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%);
    }
    .swiper-free-mode>.swiper-wrapper {
        transition-timing-function: ease-out;
        margin: 5px auto;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            const labelMes = document.getElementById('label-mes-dinamico');

            const swiperCal = new Swiper('.swiper-container-calendario', {
                slidesPerView: 'auto',
                spaceBetween: 2,
                freeMode: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.next-btn',
                    prevEl: '.prev-btn',
                },
                on: {
                    init: function () {
                        // Centrar el día actual al cargar
                        const hoy = document.querySelector('#dia-inicio');
                        if (hoy) {
                            const slides = Array.from(this.slides);
                            const index = slides.indexOf(hoy.parentElement);
                            this.slideTo(index, 0);
                        }
                    },
                    // Al mover el slider, actualizamos el texto del mes de la izquierda
                    activeIndexChange: function() {
                        actualizarLabel(this);
                    },
                    setTranslate: function() {
                        actualizarLabel(this);
                    }
                },
            });

            function actualizarLabel(instance) {
                // Buscamos el slide que está actualmente visible al principio del contenedor
                const activeSlide = instance.slides[instance.activeIndex];
                if (activeSlide) {
                    const mesData = activeSlide.getAttribute('data-mes-actual');
                    if (mesData && labelMes.innerText !== mesData) {
                        labelMes.innerText = mesData;
                    }
                }
            }
        }
    });
</script>