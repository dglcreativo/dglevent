<?php

//La función get_option_theme busca una opción específica dentro de las configuraciones del tema. Si la opción no está definida o está vacía, usa un valor por defecto si se proporciona. Dependiendo del valor del parámetro $echo, imprime o devuelve el valor de la opción encontrada o el valor por defecto
if (!function_exists('get_option_theme')) {

    function get_option_theme($the_new_option, $echo = true, $default = false)
    {
        $html_class = "";

        $new_options = get_option('new', new_default_option_theme());
        if (!isset($new_options[$the_new_option]) || $new_options[$the_new_option] == "") {
            if ($default) {
                if ($echo) {
                    echo esc_attr($default);
                } else {
                    return $default;
                }
            }
        } else {
            $html_class .= $new_options[$the_new_option];
        }

        if ($echo) {
            echo esc_attr($html_class);
        } else {
            return $html_class;
        }
    }
}

//Obterner Preloader
if (!function_exists('vivero_get_pre_loader_theme')) {

    function vivero_get_pre_loader_theme() {
        global $new_options;
        if (empty($new_options)) {
            $new_options = new_default_option_theme();
        }

        if (isset($new_options['preloader_onoff']) && $new_options['preloader_onoff'] == 1) {
            return( get_template_part('templates/header/preloader'));
        }
    }

}

if(!function_exists('new_default_option_theme')):

    function new_default_option_theme(){

    }
endif;

if(!function_exists('vivero_get_header_theme')):

    function vivero_get_header_theme(){
        global $new_options;
        if(empty($new_options)){
            $new_options = new_default_option_theme();
        }
        if(isset($new_options['new_header_type'])){
            return get_template_part('templates/header/header', $new_options['new_header_type']);
        } else{
            return get_template_part('templates/header/header', 'classic');
        }
    }
endif;

if(!function_exists('new_get_calendar_event')):

    function new_get_calendar_event(){
        global $new_options;
        if(empty($new_options)){
            $new_options = new_default_option_theme();
        }
        if(isset($new_options['new_calendar_event'])){
            return get_template_part('templates/blog/content', $new_options['new_calendar_event']);
        } else{
            return get_template_part('templates/blog/content', 'calendarss');
        }
    }
endif;

if(!function_exists('vivero_get_header_theme_learn')):

    function vivero_get_header_theme_learn(){
        // get meta
        if (is_home() && is_front_page() == false) {
            $page_for_posts = get_option( 'page_for_posts' );
            $new_wp_meta = get_post_meta( $page_for_posts );
        } else if (is_archive() ) {
            $new_wp_meta = array();
        } else {
            $new_wp_meta = get_post_meta( get_the_ID() );
        }

        if ( is_archive() || is_single() || is_page() || is_404() || (is_home() && is_front_page() == false)) {
            get_template_part( 'templates/header/header-learn', 'classic' );
        }

    }
endif;

//La función get_logo_theme en PHP está diseñada para obtener y mostrar el logo del tema en un sitio de WordPress. Esta función verifica si existen diferentes configuraciones para logos claros y oscuros, y luego genera el HTML correspondiente para mostrar el logo basado en la disponibilidad de estas configuraciones.
if (!function_exists('vivero_get_logo_theme')) :

    function vivero_get_logo_theme() {
        global $new_options;

        $logo_light = false;
        $logo_dark = false;
        $logos = 0;

        if (isset($new_options['text_logo']) && $new_options['text_logo'] != '') {
            $logo_text = $new_options['text_logo'];
        } else {
            $logo_text = get_bloginfo('name');
        }
        if (isset($new_options['logo_upload_light']['url']) && $new_options['logo_upload_light']['url'] != "") {
            $logo_light = $new_options['logo_upload_light']['url'];
            $logo = $logo_light;
            $logos++;
        }
        if (isset($new_options['logo_upload_dark']['url']) && $new_options['logo_upload_dark']['url'] != "") {
            $logo_dark = $new_options['logo_upload_dark']['url'];
            $logo = $logo_dark;
            $logos++;
        }
        if ($logos == 0) :
            ?>
            <a class="site-title logo" href="<?php echo esc_url(home_url('/')); ?>"><span class="h1"><?php echo wp_kses_post($logo_text); ?></span></a>

        <?php elseif ($logos == 1) : ?>

            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($logo_text); ?>" class="logo logo-default">
                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($logo_text); ?>" />
            </a>

        <?php else : ?>

            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($logo_text); ?>" class="logo logo-light">
                <img src="<?php echo esc_url($logo_light); ?>" alt="<?php echo esc_attr($logo_text); ?>" />
            </a>
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($logo_text); ?>" class="logo logo-dark">
                <img src="<?php echo esc_url($logo_dark); ?>" alt="<?php echo esc_attr($logo_text); ?>" />
            </a>
        <?php
        endif;
    }

endif;

//La función get_navigation_theme está diseñada para generar un menú de navegación en WordPress, permitiendo la personalización de las clases de contenedor y de menú mediante parámetros de entrada. Utiliza la función wp_nav_menu para renderizar el menú con las clases especificadas y una envoltura personalizada definida por nav_wrap_theme.
if (!function_exists('vivero_get_navigation_theme')) {

    function vivero_get_navigation_theme(/*$container_classes = array(),*/ $menu_classes = array()) {


        /*$html_container_classes = 'vivero-nav';
        if (is_array($container_classes)) {
            $html_container_classes .= ' ' . implode(" ", $container_classes);
        }*/

        $html_menu_classes = 'nav-menu';
        if (is_array($menu_classes)) {
            $html_menu_classes .= ' ' . implode(" ", $menu_classes);
        }

        wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => $html_menu_classes,
                /*'container_class' => $html_container_classes,*/
                /*'items_wrap' => nav_wrap_theme(),*/
            )
        );
        
    }

}

//La función nav_wrap_theme en PHP está diseñada para generar una envoltura de elementos (items_wrap) personalizada para un menú de navegación en un tema de WordPress. La función utiliza sprintf para crear una cadena HTML que envuelve los elementos del menú en una lista desordenada (<ul>).
if (!function_exists('nav_wrap_theme')) {

    function nav_wrap_theme() {

        $last_tab_html = '';
        $search_icon = false;
        $woocart = false;
        $cta_button = false;
        $search_HTML_class = '';
        

//        $menu_id = 'primary';
//        $menu_class = 'nav navbar-nav menu-list';
//        $items_wrap = sprintf('<ul id="%s" class="%s">%%3$s</ul>', $menu_id, $menu_class);

//        return $items_wrap;
        $wrap = '<ul id="%1$s" class="%2$s">';
        $wrap .= '%3$s';
        $wrap .= $last_tab_html; //Por si quiero un cta button, search icon o el cart
        $wrap .= '</ul>';

        return $wrap;
    }

}

if(!function_exists('vivero_get_heading')) {

    function vivero_get_heading()
    {

        // get meta
        if (is_home() && is_front_page() == false) {
            $page_for_posts = get_option('page_for_posts');
            $new_wp_meta = get_post_meta($page_for_posts);
        } else if (is_archive()) {
            $new_wp_meta = array();
        } else {
            $new_wp_meta = get_post_meta(get_the_ID());
        }

        if (is_archive() || is_single() || is_page() || is_404() || (is_home() && is_front_page() == false)) {
            get_template_part('templates/header/heading', 'page');
        }

    }

}
    if(!function_exists('vivero_get_heading_learn')) {

        function vivero_get_heading_learn() {

            // get meta
            if (is_home() && is_front_page() == false) {
                $page_for_posts = get_option( 'page_for_posts' );
                $new_wp_meta = get_post_meta( $page_for_posts );
            } else if (is_archive() ) {
                $new_wp_meta = array();
            } else {
                $new_wp_meta = get_post_meta( get_the_ID() );
            }

            if ( is_archive() || is_single() || is_page() || is_404() || (is_home() && is_front_page() == false)) {
                get_template_part( 'templates/header/heading-learn', 'classic' );
            }

        }
    }

/* Page title */
if(!function_exists('vivero_get_page_title')) {
    function vivero_get_page_title() {
        global $new_options;
        $title_services = $new_options['text_title_services'];
        $title_project = $new_options['text_title_project'];
        $title_blog = $new_options['text_title_blog'];
        $p_blog = $new_options['new_text_p_blog'];
        if(is_home() && is_front_page()) {
            //echo bloginfo ( 'description' );
        } else if( is_home() && !is_front_page()) {
            if($title_blog && $p_blog) {
                echo esc_html__($title_blog, 'new');
                echo '<p>' . $p_blog . '</p>'; //echo get_the_title(get_option('page_for_posts'));
            }else {
                echo get_the_title(get_option('page_for_posts'));
                echo '<p>' . get_the_excerpt(get_option('page_for_posts')) . '</p>';
            }
        } else if(is_front_page()) {

        }else if(is_single()) {
             echo get_the_title();
        }else if( is_day() ) {
            echo esc_html__('Daily Archives', 'new') . ': ' . get_the_date();
        } else if( is_month() ) {
            echo esc_html__('Monthly Archives', 'new') . ': ' . get_the_time('F');
        } else if( is_year() ) {
            echo esc_html__('Yearly Archives', 'new') . ': ' . get_the_time('Y');
        } else if( is_search() ) {
            echo esc_html__('Buscar Resultados', 'new');
        } else if( is_tag() ) {
            echo single_tag_title('', false);
        } else if( is_category() ) {
            echo single_cat_title('', false);
        }  else if( is_tax() ) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            echo esc_html($term->name);
        } else if( is_404() ) {
            echo esc_html__('Página no encontrada', 'new');
        } else if( is_author() ) {
            echo esc_html__('Articulos de', 'new') . ' ' . get_the_author();
        } else if(is_post_type_archive('portfolio')) {
            echo esc_html__($title_project, 'new');
        }else if(is_post_type_archive('eventos')) {
            echo esc_html__($title_services, 'new');
        }else {
            echo get_the_title();
        }
    }
}

if(!function_exists('vivero_get_pagination')) {

    function vivero_get_pagination() {

        if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
            return;
        }

        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';


        $links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 3,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => esc_html__( '&larr;', 'new' ),
            'next_text' => esc_html__( '&rarr;', 'new' ),
            'type'      => 'list',
        ) );

        if ( $links ) : ?>
            <nav class="navigation paging-navigation clearfix">
                <h3 class="screen-reader-text"><?php _e( 'Posts navigation', 'new' ); ?></h3>
                <?php echo wp_kses_post($links);?>
            </nav>
        <?php
        endif;
    }
}

/**
 * Redes Sociales
 */
function social_links(){
    global $new_options;

    if( !empty($new_options['facebook'])) { ?>
        <a href="<?php echo $new_options['facebook'] ?>" target="&quot;_blank&quot;"  title="facebook"><i class="fab fa-facebook"></i></a>
    <?php } ?>
    <?php if( !empty($new_options['twitter'])) { ?>
        <a href="<?php echo $new_options['twitter'] ?>" target="&quot;_blank&quot;" title="twitter"><i class="fab fa-twitter"></i></a>
    <?php } ?>
    <?php if( !empty($new_options['linkedin'])) { ?>
        <a href="<?php echo $new_options['linkedin'] ?>" target="&quot;_blank&quot;" title="linkedin"><i class="fab fa-linkedin"></i></a>
    <?php } ?>
    <?php if( !empty($new_options['instagram'])) { ?>
        <a href="<?php echo $new_options['instagram'] ?>" target="&quot;_blank&quot;" title="instagram"><i class="fab fa-instagram"></i></a>
    <?php } ?>
    <?php if( !empty($new_options['github'])) { ?>
        <a href="<?php echo $new_options['github'] ?>" target="&quot;_blank&quot;" title="github"><i class="fab fa-github"></i></a>
    <?php }
}

function shortcode_ultimos_eventos($atts) {
    // Configuramos opciones del shortcode
    $args_atts = shortcode_atts(array(
        'cantidad' => 3,
    ), $atts);

    // Usamos la función de WordPress para obtener la fecha local correcta
    $hoy_num = (int)current_time('Ymd');

    // 1. Consulta inicial
    $args = array(
        'post_type'      => 'eventos',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );

    $query = new WP_Query($args);
    $eventos_proximos = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $current_id = get_the_ID();

            // Traemos el campo sin formatear para evitar desfases de zona horaria en la lógica
            $fechas = get_field('fecha_evento');
            $fecha_referencia = 0;

            if ($fechas && is_array($fechas)) {
                foreach ($fechas as $f) {
                    if (empty($f['fecha'])) continue;

                    // Limpieza por si acaso hay caracteres no numéricos
                    $inicio = (int)preg_replace('/[^0-9]/', '', $f['fecha']);

                    if (!empty($f['fechas_consecutivas']) && !empty($f['segunda_fecha'])) {
                        $fin = (int)preg_replace('/[^0-9]/', '', $f['segunda_fecha']);
                    } else {
                        $fin = $inicio;
                    }

                    // Si el evento termina hoy o en el futuro
                    if ($fin >= $hoy_num) {
                        $fecha_referencia = $inicio;
                        break;
                    }
                }
            }

            if ($fecha_referencia >= $hoy_num) {
                $eventos_proximos[] = array(
                    'ID'    => $current_id,
                    'fecha' => $fecha_referencia
                );
            }
        }
        wp_reset_postdata();
    }

    // 2. Ordenar por fecha más cercana
    usort($eventos_proximos, function($a, $b) {
        return $a['fecha'] - $b['fecha'];
    });

    // 3. Limitar cantidad
    $eventos_proximos = array_slice($eventos_proximos, 0, (int)$args_atts['cantidad']);

    // 4. Generar el HTML
    ob_start();
    if (!empty($eventos_proximos)) {
        echo '<div class="section-blog">';
        echo '<div class="container">';
        echo '<div class="shc-event">';

        global $post; // Declaramos la global para asegurar compatibilidad
        foreach ($eventos_proximos as $item) {
            $post = get_post($item['ID']);
            setup_postdata($post);

            echo '<div class="new-classic" style="grid-template-columns: none">';
            // Aquí es donde se pinta la fecha.
            get_template_part('templates/blog/content-blog', 'learn');
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>No hay eventos próximos.</p>';
    }

    return ob_get_clean();
}
add_shortcode('ultimos_eventos', 'shortcode_ultimos_eventos');

