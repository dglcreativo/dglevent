<?php
if (!class_exists('Redux')) {
    return;
}

global $new_options;

// Iconos menu
$patterns_dir = plugin_dir_path(__FILE__) . '../../admin/img/menu/';
$patterns_uri = plugin_dir_url(__FILE__) . '../../admin/img/menu/';

// Obtener todos los archivos SVG
$files = glob($patterns_dir . "*.svg");

// Limpiar las opciones del select
$field['choices'] = array();

// Llenar el select con los archivos encontrados
if (!empty($files)) {
    foreach ($files as $file) {
        $name = basename($file, '.svg'); // Nombre del archivo sin extensión
        $url = $patterns_uri . $name . '.svg'; // URL del archivo
        $field['choices'][$url] = $name; // URL como valor y nombre como etiqueta
    }
}


Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'new'),
    'icon' => 'el-icon-star',
    'fields' => array(
        array(
            'id' => 'preloader_onoff',
            'type' => 'switch',
            'title' => esc_html__('Activar Preloader', 'new'),
            'default' => '0', // 1 = on | 0 = off
            'on' => 'Si',
            'off' => 'No',
            'compiler' => true,
        ),
        array(
            'id' => 'preloader_img',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Imagen del Cargador', 'new'),
            'subtitle' => esc_html__('Pon el logo de tu empresa en el cargador de tu web.', 'new'),
            'description' => esc_html__('Carga una .PNG con fondo transparente. Dimensiones max: 1044 x 492 px.', 'new'),
            'default' => array(
                'url' => ''
            ),
            'required' => array(
                array('preloader_onoff', 'equals', '1'),
            )
        ),
        array(
            'id' => 'preloader_img_default',
            'type' => 'checkbox',
            'title' => esc_html__('Quitar imagen por defecto', 'new'),
            'subtitle' => esc_html__('Quita la imagen por defecto del tema.', 'new'),
            'default' => '1',
            'required' => array(
                array('preloader_onoff', 'equals', '1'),
            )
        ),
        array(
            'id'        => 'heading_onoff',
            'type'      => 'checkbox',
            'title'     => esc_html__('Mostrar titulo de pagina?', 'new'),
            'default'   => '1', // 1 = on | 0 = off
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'     => esc_html__('Colores', 'new'),
    'icon'      => 'fa fa-paint-brush',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'    => 'new_info_color',
            'type'  => 'info',
            'title' => esc_html__('Colores principales del tema', 'new'),
            'desc'  => esc_html__('Usa estos colores para mejorar el aspecto de tu web o darse la apariencia que tu deseas.', 'new'),
        ),
        array(
            'id'            => 'new_color_primary',
            'type'          => 'color',
            'title'         => esc_html__('Color Principal del tema', 'new'),
            'subtitle'      => esc_html__('Define el color que va a destacar en tu tema', 'new'),
            'transparent'   => false,
            'output'        => array(
                'background-color'  => '.btn-primary, .page-heading, .page-heading-small, .page-numbers li .current, .page-numbers li>a:hover,  a.tag-cloud-link:hover, aside .widget .widget-title:before, .site-footer .widget .widget-title:before, .prefooter .widget .widget-title:before, .item-carousel .carousel-overlay, .barra-lateral .boton, .widget_media_gallery .gallery a:hover, .box-color-item:hover, .prev-post a:hover, .next-post a:hover',
                'color'             => '.btn-primary:hover, a:hover, a:active, .new-classic .entry-meta>a:hover>.category, a:not([class*="hover"]) .item-title:hover, a.item-title:hover, .wpcf7-form .select:after, .wpcf7-form .name:after, .wpcf7-form .email:after, .wpcf7-form .date:after, .wpcf7-form .phone:after, .wpcf7-form .time:after, .wpcf7-form label, input.search-submit[type="submit"]:hover, .widget_archive > ul > li a:before, .widget_categories > ul > li a:before, .widget_pages > ul > li a:before, .widget_meta > ul > li a:before, .current-menu-item a, .menu-item a:hover, .sticky-header .current-menu-item a',
                'border-color'      => '.btn-primary, .btn-primary:hover, .paging-navigation .page-numbers .current, input:focus, textarea:focus, .wpcf7-form input:focus, .wpcf7-form input:focus, .form-control:focus',
                'border-bottom'     =>'aside .widget .widget-title:before',
            ),
            'default'       => '#7b8aa9'
        ),
        array(
            'id'   => 'new_info__bg_color_',
            'type' => 'info',
            'title'    => esc_html__('Background Colors', 'new'),
        ),
        array(
            'id'       => 'site_background_color',
            'type'     => 'color',
            'title'    => esc_html__('Color de Fondo', 'new'),
            'subtitle' => esc_html__('Escoge el color de fondo de tu sitio web.', 'new'),
            'output'      => array( 
                    'background-color' => 'body .site-content',
            ),

            'default'  => '#ffffff',
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'     => esc_html__('Header', 'new'),
    'icon'      => 'fa fa-window-maximize',
    'fields'    => array(
        array(
            'id'   => 'info_header_settings',
            'type' => 'info',
            'title'    => esc_html__('Header layout', 'new'),
        ),
        array(
            'id'       => 'header_width_classic',
            'type'     => 'switch',
            'title'    => esc_html__('Activar Full-Width Header', 'new'),
            'default'  => '0',
            'on'       => 'On',
            'off'       => 'Off',
        ),
        array(
            'id'       => 'new_header_type',
            'type'     => 'image_select',
            'title'    => esc_html__('Elija el diseño del Header', 'new'),
            'subtitle' => esc_html__('Escoge entre cabecera clasica o centrada.', 'new'),
            'compiler' => true,
            'options'  => array(
                'classic'      => array(
                    'alt'   => 'Classic',
                    'img'   => plugin_dir_url(__FILE__).'img/header-classic.png'
                ),
            ),
            'default' => 'classic'
        ),

        // CLASSIC HEADER OPTIONS
        array(
            'id'        => 'header_hight_classic',
            'type'      => 'slider',
            'title'     => __('Altura de la Cabecera', 'new'),
            'subtitle'  => __('Control de altura en la cabecera desktop.', 'new'),
            'desc'      => __('Min: 48px, Max: 180px.', 'new'),
            "default"   => 120,
            "min"       => 48,
            "step"      => 2,
            "max"       => 180,
            'display_value' => 'text',
            'compiler' => true,
            'required' => array(
                array('new_header_type','equals','classic'),
            )
        ),
        array(
            'id'        => 'logo_position_hight_classic',
            'type'      => 'slider',
            'title'     => __('Posición del Logo', 'new'),
            'subtitle'  => __('Define la posición del logo en la cabecera.', 'new'),
            'desc'      => __('Default: 15px', 'new'),
            "default"   => 15,
            "min"       => 5,
            "step"      => 1,
            "max"       => 120,
            'display_value' => 'text',
            'compiler' => true,
            'required' => array(
                array('new_header_type','equals','classic'),
            )
        ),
        array(
            'id'   => 'info_classic_header_settings',
            'type' => 'info',
            'title'    => esc_html__('Fondo del Classic Header', 'new'),
            'required' => array(
                array('new_header_type','equals','classic'),
            )
        ),
        array(
            'id'       => 'classic_header_background',
            'type'     => 'background',
            'title'    => esc_html__( 'Opciones del Fondo', 'new' ),
            'subtitle'    => esc_html__( 'Los colores predeterminados se configuran en la configuración de navegación principal.', 'new' ),
            'transparent' => false,
            'background-attachment' => false,
            'output'   => array( '.main-header.header-classic' ),
            'required' => array(
                array('new_header_type','equals','classic'),
            ),
            'compiler' => true,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Logo', 'new'),
    'icon' => 'fa fa-coffee',
    'fields' => array(
        array(
            'id' => 'info_logo_settings',
            'type' => 'info',
            'title' => esc_html__('Cargar Imagen del Logotipo', 'new'),
            'desc' => esc_html__('Carga un logotipo para tu web.', 'new'),
        ),
        array(
            'id' => 'logo_upload_dark',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Logotipo', 'new'),
            'subtitle' => esc_html__('Logotipo para fondos claros.', 'new'),
            'description' => esc_html__('Sube una imagen .PNG con el fondo transparente.', 'new'),
            'default' => array(
                'url' => ''
            ),
        ),
        array(
            'id' => 'logo_upload_light',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Sticky Logo', 'new'),
            'subtitle' => esc_html__('Logotipo para fondos oscuros o transparente cuyo fondo sea oscuro.', 'new'),
            'description' => esc_html__('Sube una imagen .PNG con el fondo transparente.', 'new'),
            'default' => array(
                'url' => ''
            ),
        ),
        array(
            'id' => 'info_logo_textbased_settings',
            'type' => 'info',
            'title' => esc_html__('Text based logo', 'new'),
            'desc' => esc_html__('Displayed if no Logo image is selected, or used as logo link title attribute.', 'new'),
        ),
        array(
            'id' => 'text_logo',
            'type' => 'text',
            'title' => esc_html__('Text based logo text', 'new'),
            'desc' => esc_html__('Accepts HTML tags.', 'new'),
            'validate' => 'html',
            'default' => 'DGL Theme',
        ),
        array(
            'id' => 'info_logo_size_settings',
            'type' => 'info',
            'title' => esc_html__('Desktop logo size', 'new'),
        ),
        array(
            'id' => 'logo_max_dimensions',
            'type' => 'dimensions',
            'title' => __('Maximum Logo width and height', 'new'),
            'default' => array(
                'Width' => '300',
                'Height' => '72',
            ),
            'units' => false,
            'compiler' => true,
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'     => esc_html__('Navegación', 'new'),
    'icon'      => 'fa fa-navicon',
    'fields'    => array(
        array(
            'id'   => 'info_navstyle_settings',
            'type' => 'info',
            'title'    => esc_html__('Estilo de navegación principal', 'new'),
        ),
        array(
            'id'       => 'new_type_navigation',
            'type'     => 'select',
            'title'    => esc_html__('Estilo de Navegación', 'new'), 
            'subtitle' => esc_html__('Elige el tipo de navegación que deseas para tu header classic', 'new'),
            'options'  => array(
                '1' => 'Normal',
                '2' => 'Fill'
            ),
            'default'  => '1',
        ),
        array(
            'id'       => 'nav_item_color_normal',
            'type'     => 'color',
            'title'    => esc_html__( 'Color del estilo normal', 'new' ),
            'subtitle'    => esc_html__( 'Establece el color del texto el enlace del menu normal.', 'new' ),
            // 'default'  => '',
            'output' =>  array( 'color' => '.menu-item a:not(.current-menu-item a):not(:hover)' ),
            'transparent' => false,
            'required' => array(
                array('new_type_navigation','equals','1'),
            )
        ),
        array(
            'id'       => 'nav_item_color_fill',
            'type'     => 'color',
            'title'    => esc_html__( 'Color del estilo Fill', 'new' ),
            'subtitle'    => esc_html__( 'Establece el color del texto el enlace del menu fill.', 'new' ),
            // 'default'  => '',
            'output' =>  array(
                'color' => '.menu-item a:not(.current-menu-item a):not(:hover)',
             ),
            'transparent' => false,
            'required' => array(
                array('new_type_navigation','equals','2'),
            )
        ),
        array(
            'id'       => 'nav_item_bg_fill',
            'type'     => 'color',
            'title'    => esc_html__( 'Color fondo boton', 'new' ),
            'subtitle'    => esc_html__( 'Establece el color del active y del hover del menu fill.', 'new' ),
            // 'default'  => '',
            'output' =>  array(
                'background-color' => '.site-navigation.fill-style .current-menu-item > a, .site-navigation.fill-style .nav-menu > li > a:hover',
             ),
            'transparent' => false,
            'required' => array(
                array('new_type_navigation','equals','2'),
            )
        ),
        array(
            'id'       => 'border-triangle',
            'type'     => 'border',
            'title'    => esc_html__('Color del triangulo submenu', 'new'),
            'subtitle' => esc_html__('Cambiar el color del triangulo del submenu', 'new'),
            'output'   => array('.menu-item-has-children > a::after'),
            'default'  => array(
                'border-color'  => '#1e73be', 
                'border-style'  => 'solid', 
                'border-top'    => '5px', 
                //'border-right'  => '5px', 
                'border-bottom' => '0px', 
                //'border-left'   => '5px'
            ),
            // Clave para desactivar el control de vinculación de lados
            'all'      => false, 
            
            // *** CLAVES PARA CONTROLAR LA VISIBILIDAD DE LOS CAMPOS ***
            'top'      => true,    // Muestra el campo Top
            'right'    => false,   // Oculta el campo Right
            'bottom'   => true,    // Muestra el campo Bottom
            'left'     => false,   // Oculta el campo Left
            'required' => array(
                array('new_type_navigation','equals','2'),
            )
        ),
        array(
            'id'       => 'nav_item_padding',
            'type'     => 'dimensions',
            'title'    => __('Padding de elementos de navegación', 'new'),
            'desc'     => esc_html__('Establezca el espacio entre los elementos del menú en el escritorio en píxeles. Se recomienda mantener esto por debajo de 30 px. ', 'new'),
            'default'  => array(
                'width'   => '11',
            ),
            'units' => false,
            'height' => false,
            'compiler' => true,
        ),
        array(
            'id'   => 'info_navstypo_settings',
            'type' => 'info',
            'title'    => esc_html__('Fuentes de navegación principal', 'new'),
        ),
        array(
            'id'          => 'first-lvl-menu',
            'type'        => 'typography',
            'title'       => esc_html__('Nivel 1 del Menu', 'new'),
            'font-backup' => false,
            'text-align' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'line-height' => false,
            'color' => false,
            'output'      => array('.site-navigation .nav-menu > li > a, .nav-menu > ul > li > a'),
            'units'       =>'px',
            'default'     => array(
                'font-size'   => '12px',
                'text-transform' => 'uppercase',
                'letter-spacing' => '1px',
            ),
            'compiler' => true,
        ),

        array(
            'id'          => 'second-lvl-menu',
            'type'        => 'typography',
            'title'       => esc_html__('Submenu', 'new'),
            'font-backup' => false,
            'text-align' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'line-height' => false,
            'color' => false,
            'output'      => array('.nav-menu > li > ul.sub-menu .menu-item > a, .nav-menu > li > ul.sub-menu .menu-item > span'),
            'units'       =>'px',
            'default'     => array(
                'font-size'   => '12px',
                'text-transform' => 'uppercase',
                'letter-spacing' => '1px',

            )
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'     => esc_html__('Menu Reponsive', 'new'),
    'icon'      => 'fa fa-paint-brush',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'    => 'new_info_hamburger',
            'type'  => 'info',
            'title' => esc_html__('Color de la hamburguesa', 'new'),
            'desc'  => esc_html__('Elige el color de la hamburguesa desplegable.', 'new'),
        ),
        array(
            'id'       => 'hamburguer_color',
            'type'     => 'color',
            'title'    => esc_html__('Color del icono de hamburguesa', 'new'),
            'subtitle' => esc_html__('Establece el color del icono de la hamburguesa de Bootstrap.', 'new'),
            'output' =>  array( 'border-color' => '.navbar-light .navbar-toggler' ),
            'transparent' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'new'),
    'icon' => 'el-icon-inbox',
    'fields' => array(
        array(
            'id' => 'info_footer_settings',
            'type' => 'info',
            'title' => esc_html__('Opciones del Footer', 'new'),
        ),
        array(
            'id' => 'mainfooter-sidebars',
            'type' => 'select',
            'title' => esc_html__('Numero de columnas', 'new'),
            'subtitle' => __('Selecciona el numero de areas que quieres en el footer.', 'new'),
            'default' => '3',
            'options' => array(
                '1' => '1 columna',
                '2' => '2 columnas',
                '3' => '3 columnas',
                '4' => '4 columnas'
            ),
        ),
        array(
            'id'          => 'widget_menu_footer',
            'type'        => 'typography',
            'title'       => esc_html__('Tipografia Footer', 'new'),
            'font-backup' => false,
            'text-align' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'line-height' => false,
            'color' => false,
            'output'      => array('.widget_recent_entries>ul>li>a'),
            'units'       =>'px',
            'default'     => array(
                'font-size'   => '12px',
                'text-transform' => 'lowercase',
                'letter-spacing' => '0px',
            ),
            'compiler' => true,
        ),
        array(
            'id' => 'footer_text_colors',
            'type' => 'select',
            'title' => esc_html__('Color de los textos', 'new'),
            'subtitle' => esc_html__('Cambia el color del texto de blanco a negro dependiendo del color de tu footer', 'new'),
            'default' => 'text-dark',
            'options' => array(
                'text-dark' => 'Negro',
                'text-light' => 'Blanco',
            ),
        ),
        array(
            'id' => 'footer_link_colors',
            'type' => 'color',
            'title' => esc_html__('Color de los enlaces', 'new'),
            'subtitle' => esc_html__('Cambiar el color de los enlaces del footer.', 'new'),
            'output' => array('.widgets a'),
        ),
        array(
            'id' => 'footer_link_colors_hover',
            'type' => 'color',
            'title' => esc_html__('Color Hover de los enlaces', 'new'),
            'subtitle' => esc_html__('Cambiar el color al pasar por encima de los enlaces del footer.', 'new'),
            'output' => array('.widgets a:hover'),
        ),
        array(
            'id'       => 'border-b-links-a',
            'type'     => 'border',
            'title'    => esc_html__('Color border menus footer', 'new'),
            'subtitle' => esc_html__('Cambiar el color del borde inferior de tus menus.', 'new'),
            'output'   => array('.widget_archive>ul>li, .widget_categories>ul>li, .widget_meta>ul>li, .widget_pages>ul>li, .widget_recent_entries>ul>li, .wp-block-archives>li, .wp-block-latest-posts:not(.is-grid)>li'),
            'default'  => array(
                'border-color'  => '#ffffff', 
                'border-style'  => 'solid', 
                //'border-top'    => '5px', 
                //'border-right'  => '5px', 
                'border-bottom' => '1px', 
                //'border-left'   => '5px'
            ),
            // Clave para desactivar el control de vinculación de lados
            'all'      => false, 
            
            // *** CLAVES PARA CONTROLAR LA VISIBILIDAD DE LOS CAMPOS ***
            'top'      => false,    // Muestra el campo Top
            'right'    => false,   // Oculta el campo Right
            'bottom'   => true,    // Muestra el campo Bottom
            'left'     => false,   // Oculta el campo Left
        ),
        array(
            'id' => 'footer_background',
            'type' => 'background',
            'title' => esc_html__('Footer Background', 'new'),
            'subtitle' => esc_html__('Defines the style of footer background.', 'new'),
            'transparent' => false,
            'background-attachment' => false,
            'output' => array('.site-footer'),
        ),
        array(
            'id' => 'footer_spacing',
            'type' => 'spacing',
            'output' => '.site-footer .main-footer',
            'mode' => 'padding',
            'units' => 'px',
            'units_extended' => 'false',
            'title' => __('Footer Padding', 'new'),
            'subtitle' => __('Sets spacing for footer widgets (in pixels).', 'new'),
            'left' => false,
            'right' => false,
            'display_units' => false,
            'default' => array(
                'padding-top' => '60',
                'padding-bottom' => '10',
                'units' => 'px',
            )
        ),

        array(
            'id' => 'espcial_footer_settings',
            'type' => 'info',
            'title' => esc_html__('Separador del los titulos', 'new'),
        ),
        array(
            'id' => 'border_widget_title_colors_big',
            'type' => 'border',
            'title' => esc_html__('Color Separador Largo', 'new'),
            'subtitle' => esc_html__('Cambiar el color del separador mas largo de tu tiutlo del widget.', 'new'),
            'output' => array('.site-footer .widget .widget-title:after'),
            'default'  => array(
                'border-color'  => '#ffffff', 
                'border-style'  => 'solid', 
                //'border-top'    => '5px', 
                //'border-right'  => '5px', 
                'border-bottom' => '2px', 
                //'border-left'   => '5px'
            ),
            // Clave para desactivar el control de vinculación de lados
            'all'      => false, 
            
            // *** CLAVES PARA CONTROLAR LA VISIBILIDAD DE LOS CAMPOS ***
            'top'      => false,    // Muestra el campo Top
            'right'    => false,   // Oculta el campo Right
            'bottom'   => true,    // Muestra el campo Bottom
            'left'     => false,   // Oculta el campo Left
        ),
        array(
            'id' => 'border_widget_title_colors_small',
            'type' => 'border',
            'title' => esc_html__('Color Separador Corto', 'new'),
            'subtitle' => esc_html__('Cambiar el color del separador mas corto de tu tiutlo del widget.', 'new'),
            'output' => array('.site-footer .widget .widget-title:before'),
            'default'  => array(
                'border-color'  => '#ffffff', 
                'border-style'  => 'solid', 
                //'border-top'    => '5px', 
                //'border-right'  => '5px', 
                'border-bottom' => '2px', 
                //'border-left'   => '5px'
            ),
            // Clave para desactivar el control de vinculación de lados
            'all'      => false, 
            
            // *** CLAVES PARA CONTROLAR LA VISIBILIDAD DE LOS CAMPOS ***
            'top'      => false,    // Muestra el campo Top
            'right'    => false,   // Oculta el campo Right
            'bottom'   => true,    // Muestra el campo Bottom
            'left'     => false,   // Oculta el campo Left
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Blog', 'new'),
    'icon' => 'fas fa-project-diagram',
    'fields' => array(
        array(
            'id' => 'info_blog_textbased',
            'type' => 'info',
            'title' => esc_html__('Textos para el titulo del blog', 'new'),
            'desc' => esc_html__('Modifica el texto que aparece en el blog.', 'new'),
        ),
        array(
            'id' => 'text_title_blog',
            'type' => 'text',
            'title' => esc_html__('Titulo', 'new'),
            'desc' => esc_html__('Acepta etiquetas HTML.', 'new'),
            'validate' => 'html',
            'default' => 'Mi Blog',
        ),
        array(
            'id' => 'vivero_text_p_blog',
            'type' => 'text',
            'title' => esc_html__('Texto Descripción', 'new'),
            'desc' => esc_html__('Acepta etiquetas HTML.', 'new'),
            'validate' => 'html',
            'default' => 'Toma inspiración en mis Noticias.',
        ),
        array(
            'id' => 'info_blog_heading_normal',
            'type' => 'info',
            'title' => esc_html__('Cambio del heading del blog', 'new'),
            'desc' => esc_html__('Modifica los headind del blog para dar otro aspecto diferente', 'new'),
        ),
        array(
            'id'       => 'new_heading_blog_normal',
            'type'     => 'image_select',
            'title'    => esc_html__('Elija el diseño del Heading', 'new'),
            'subtitle' => esc_html__('Escoge entre heading left o center.', 'new'),
            'compiler' => true,
            'options'  => array(
                'classic'      => array(
                    'alt'   => 'Clasico',
                    'img'   => plugin_dir_url(__FILE__).'img/heading-classic.png'
                ),
                'center'      => array(
                    'alt'   => 'Centrado',
                    'img'   => plugin_dir_url(__FILE__).'img/heading-centered.png'
                ),
                'left'      => array(
                    'alt'   => 'Izquierda',
                    'img'   => plugin_dir_url(__FILE__).'img/heading-left.png'
                ),
            ),
            'default' => 'center'
        ),
        
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Heading Blog Redux', 'new'),
    'icon' => 'fas fa-concierge-bell',
    'fields' => array(
        array(
            'id' => 'info_services_textbased',
            'type' => 'info',
            'title' => esc_html__('Textos para el titulo de pagina', 'new'),
            'desc' => esc_html__('Modifica el texto que aparece en esta sección.', 'new'),
        ),
        array(
            'id' => 'text_title_services',
            'type' => 'text',
            'title' => esc_html__('Titulo', 'new'),
            'desc' => esc_html__('Acepta etiquetas HTML.', 'new'),
            'validate' => 'html',
            'default' => 'Aprende Redux Framework',
        ),
        array(
            'id' => 'text_p_services',
            'type' => 'text',
            'title' => esc_html__('Texto Descripción', 'new'),
            'desc' => esc_html__('Acepta etiquetas HTML.', 'new'),
            'validate' => 'html',
            'default' => 'y crea tus propias opciones para tu tema de wordpress.',
        ),
        array(
            'id' => 'info_redux_bg_learn',
            'type' => 'info',
            'title' => esc_html__('Imagen del heading', 'new'),
            'desc' => esc_html__('Dale otro aspecto a tu web con la imagen de fondo.', 'new'),
        ),
        array(
            'id' => 'active_redux_learn_bg',
            'type' => 'switch',
            'title' => esc_html__('Activar Imagen del Heading', 'new'),
            'default' => '0', // 1 = on | 0 = off
            'on' => 'Si',
            'off' => 'No',
            'compiler' => true,
        ),
        array(
            'id' => 'redux_learn_bg',
            'type' => 'background',
            'title' => esc_html__('Imagen del heading', 'new'),
            'desc' => esc_html__('Ponle fondo de imagen a tu heading.', 'new'),
            'transparent' => false,
            'background-attachment' => false,
            'output' => array('.page-heading.learn-redux-blog'),
            'required' => array(
                array('active_redux_learn_bg', 'equals', '1'),
            )
        ),
        
    )
));