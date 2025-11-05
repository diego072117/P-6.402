<?php
// Cargar estilos y scripts
function tema_custom_scripts()
{
    // Cargar Tailwind CSS (debe ir al final para que no sea sobrescrito)
    wp_enqueue_style(
        'tailwind-css',
        get_template_directory_uri() . '/assets/css/output.css',
        array(), // sin dependencias
        filemtime(get_template_directory() . '/assets/css/output.css') // evita caché
    );

    // Cargar custom.css DESPUÉS de Tailwind
    wp_enqueue_style(
        'custom-css',
        get_template_directory_uri() . '/assets/css/custom.css',
        array('tailwind-css'), // Depende de Tailwind
        filemtime(get_template_directory() . '/assets/css/custom.css') // Evita caché
    );

    // Cargar JS personalizado
    wp_enqueue_script(
        'custom-js',
        get_template_directory_uri() . '/assets/js/custom.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/custom.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'tema_custom_scripts');

// Soporte para características de WordPress
function tema_custom_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'menu-principal' => __('Menú Principal', 'tema-custom'),
    ));
}
add_action('after_setup_theme', 'tema_custom_setup');

require get_template_directory() . '/inc/class-tailwind-nav-walker.php';


/**
 * ============================================
 * CUSTOMIZER - BANNER HOME (NATIVO)
 * ============================================
 */

function justicia_customize_register($wp_customize)
{

    // ===================================
    // SECCIÓN: Banner Principal
    // ===================================
    $wp_customize->add_section('banner_home_section', array(
        'title'      => __('Banner Principal (Home)', 'tema-custom'),
        'priority'   => 30,
        'description' => 'Personaliza los textos del banner principal de la página de inicio'
    ));

    // -----------------------------------
    // CAMPO 1: Descripción del Banner
    // -----------------------------------
    $wp_customize->add_setting('banner_descripcion', array(
        'default'   => 'Buscamos justicia para las 6.402 personas asesinadas y presentadas como falsas muertes en combate por el Ejército de Colombia.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('banner_descripcion_control', array(
        'label'      => __('Descripción del Banner', 'tema-custom'),
        'section'    => 'banner_home_section',
        'settings'   => 'banner_descripcion',
        'type'       => 'textarea',
        'description' => 'Texto descriptivo que aparece arriba del título'
    ));

    // -----------------------------------
    // CAMPO 2: Título Parte 1 (Naranja)
    // -----------------------------------
    $wp_customize->add_setting('banner_titulo_parte1', array(
        'default'   => '¡Si nos unimos,',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('banner_titulo_parte1_control', array(
        'label'      => __('Título - Parte 1 (Color Naranja)', 'tema-custom'),
        'section'    => 'banner_home_section',
        'settings'   => 'banner_titulo_parte1',
        'type'       => 'text',
        'description' => 'Primera parte del título principal'
    ));

    // -----------------------------------
    // CAMPO 3: Título Parte 2 (Negro)
    // -----------------------------------
    $wp_customize->add_setting('banner_titulo_parte2', array(
        'default'   => 'todxs conoceremos la verdad!',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('banner_titulo_parte2_control', array(
        'label'      => __('Título - Parte 2 (Color Negro)', 'tema-custom'),
        'section'    => 'banner_home_section',
        'settings'   => 'banner_titulo_parte2',
        'type'       => 'text',
        'description' => 'Segunda parte del título principal'
    ));

    // -----------------------------------
    // CAMPO 4: Texto del Botón
    // -----------------------------------
    $wp_customize->add_setting('banner_texto_boton', array(
        'default'   => 'Apoya con tu firma',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('banner_texto_boton_control', array(
        'label'      => __('Texto del Botón', 'tema-custom'),
        'section'    => 'banner_home_section',
        'settings'   => 'banner_texto_boton',
        'type'       => 'text',
    ));

    // -----------------------------------
    // CAMPO 5: URL del Botón
    // -----------------------------------
    $wp_customize->add_setting('banner_url_boton', array(
        'default'   => 'https://www.change.org/',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('banner_url_boton_control', array(
        'label'      => __('URL del Botón (Change.org)', 'tema-custom'),
        'section'    => 'banner_home_section',
        'settings'   => 'banner_url_boton',
        'type'       => 'url',
        'description' => 'URL completa de la petición'
    ));

    // -----------------------------------
    // CAMPO 6: Meta de Firmas
    // -----------------------------------
    $wp_customize->add_setting('banner_meta_firmas', array(
        'default'   => '6402',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('banner_meta_firmas_control', array(
        'label'      => __('Meta de Firmas (Objetivo)', 'tema-custom'),
        'section'    => 'banner_home_section',
        'settings'   => 'banner_meta_firmas',
        'type'       => 'number',
        'description' => 'Número total de firmas objetivo (ej: 6402)',
        'input_attrs' => array(
            'min' => 1,
            'step' => 1,
        ),
    ));

    // -----------------------------------
    // CAMPO 7: ID del Archivo Excel
    // -----------------------------------
    $wp_customize->add_setting('banner_excel_id', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_excel_id_control', array(
        'label'      => __('Archivo de Firmas (Excel/CSV)', 'tema-custom'),
        'section'    => 'banner_home_section',
        'settings'   => 'banner_excel_id',
        'mime_type'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv',
        'description' => 'Sube el archivo Excel o CSV con las firmas. El contador se actualizará automáticamente.',
    )));


    // ===================================
    // SECCIÓN: Conoce Más
    // ===================================
    $wp_customize->add_section('conoce_mas_section', array(
        'title'      => __('Sección "Conoce Más"', 'tema-custom'),
        'priority'   => 35,
        'description' => 'Personaliza los textos de la sección Conoce Más'
    ));

    // -----------------------------------
    // CAMPO 1: Título Parte 1 (Negro)
    // -----------------------------------
    $wp_customize->add_setting('conoce_titulo_parte1', array(
        'default'   => 'CONOCE MÁS',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('conoce_titulo_parte1_control', array(
        'label'      => __('Título - Parte 1 (Color Negro)', 'tema-custom'),
        'section'    => 'conoce_mas_section',
        'settings'   => 'conoce_titulo_parte1',
        'type'       => 'text',
        'description' => 'Primera línea del título'
    ));

    // -----------------------------------
    // CAMPO 2: Título Parte 2 (Naranja)
    // -----------------------------------
    $wp_customize->add_setting('conoce_titulo_parte2', array(
        'default'   => 'SOBRE NOSOTROS',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('conoce_titulo_parte2_control', array(
        'label'      => __('Título - Parte 2 (Color Naranja)', 'tema-custom'),
        'section'    => 'conoce_mas_section',
        'settings'   => 'conoce_titulo_parte2',
        'type'       => 'text',
        'description' => 'Segunda línea del título'
    ));

    // -----------------------------------
    // CAMPO 3: Descripción
    // -----------------------------------
    $wp_customize->add_setting('conoce_descripcion', array(
        'default'   => 'Cansadas de esperar a la justicia colombiana, víctimas y organizaciones de derechos humanos acudieron a la justicia universal en Argentina. En noviembre de 2023, se interpuso una querella (denuncia) para esclarecer la responsabilidad de Uribe Vélez en las ejecuciones extrajudiciales (mal llamados "falsos positivos") durante su mandato. Sin embargo, no ha habido avances significativos ni apertura formal de la investigación.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('conoce_descripcion_control', array(
        'label'      => __('Descripción', 'tema-custom'),
        'section'    => 'conoce_mas_section',
        'settings'   => 'conoce_descripcion',
        'type'       => 'textarea',
        'description' => 'Texto descriptivo del contenido'
    ));

    // -----------------------------------
    // CAMPO 4: URL del Botón
    // -----------------------------------
    $wp_customize->add_setting('conoce_url_boton', array(
        'default'   => '#conocenos',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('conoce_url_boton_control', array(
        'label'      => __('URL del Botón "Conoce más"', 'tema-custom'),
        'section'    => 'conoce_mas_section',
        'settings'   => 'conoce_url_boton',
        'type'       => 'url',
        'description' => 'Enlace al que redirige el botón (puede ser una ancla #conocenos o una página completa)'
    ));

    // ===================================
    // SECCIÓN: Qué puedo hacer?
    // ===================================
    $wp_customize->add_section('que_puedo_hacer_section', array(
        'title'      => __('Sección "Qué puedo hacer?"', 'tema-custom'),
        'priority'   => 40,
        'description' => 'Personaliza los textos de la sección Qué puedo hacer'
    ));

    // -----------------------------------
    // CAMPO 1: Título Parte 1 (Negro)
    // -----------------------------------
    $wp_customize->add_setting('que_hacer_titulo_parte1', array(
        'default'   => 'QUÉ PUEDO',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('que_hacer_titulo_parte1_control', array(
        'label'      => __('Título - Parte 1 (Color Negro)', 'tema-custom'),
        'section'    => 'que_puedo_hacer_section',
        'settings'   => 'que_hacer_titulo_parte1',
        'type'       => 'text',
    ));

    // -----------------------------------
    // CAMPO 2: Título Parte 2 (Naranja)
    // -----------------------------------
    $wp_customize->add_setting('que_hacer_titulo_parte2', array(
        'default'   => 'HACER?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('que_hacer_titulo_parte2_control', array(
        'label'      => __('Título - Parte 2 (Color Naranja)', 'tema-custom'),
        'section'    => 'que_puedo_hacer_section',
        'settings'   => 'que_hacer_titulo_parte2',
        'type'       => 'text',
    ));

    // -----------------------------------
    // CAMPO 3: Subtítulo
    // -----------------------------------
    $wp_customize->add_setting('que_hacer_subtitulo', array(
        'default'   => 'Lucha por la verdad y justicia de todxs',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('que_hacer_subtitulo_control', array(
        'label'      => __('Subtítulo', 'tema-custom'),
        'section'    => 'que_puedo_hacer_section',
        'settings'   => 'que_hacer_subtitulo',
        'type'       => 'text',
    ));

    // -----------------------------------
    // CAMPO 4: Descripción
    // -----------------------------------
    $wp_customize->add_setting('que_hacer_descripcion', array(
        'default'   => 'Contamos con apoyo de:',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('que_hacer_descripcion_control', array(
        'label'      => __('Descripción', 'tema-custom'),
        'section'    => 'que_puedo_hacer_section',
        'settings'   => 'que_hacer_descripcion',
        'type'       => 'text',
    ));

    // -----------------------------------
    // CAMPO 5: URL del Botón
    // -----------------------------------
    $wp_customize->add_setting('que_hacer_url_boton', array(
        'default'   => '#que-puedo-hacer',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('que_hacer_url_boton_control', array(
        'label'      => __('URL del Botón "Conoce cómo apoyar"', 'tema-custom'),
        'section'    => 'que_puedo_hacer_section',
        'settings'   => 'que_hacer_url_boton',
        'type'       => 'url',
        'description' => 'Enlace al que redirige el botón'
    ));

    // ===================================
    // SECCIÓN: Historias de las Víctimas
    // ===================================
    $wp_customize->add_section('historias_victimas_section', array(
        'title'      => __('Historias de las Víctimas', 'tema-custom'),
        'priority'   => 45,
        'description' => 'Configura las 3 historias destacadas con sus PDFs individuales'
    ));

    // -----------------------------------
    // HISTORIA 1
    // -----------------------------------
    $wp_customize->add_setting('historia1_nombre', array(
        'default'   => 'María López Pérez',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('historia1_nombre_control', array(
        'label'      => __('Historia 1 - Nombre', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_nombre',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('historia1_descripcion', array(
        'default'   => 'Madre de Juan López, víctima de ejecución extrajudicial en 2008. Busca justicia desde hace 15 años.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('historia1_descripcion_control', array(
        'label'      => __('Historia 1 - Descripción', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_descripcion',
        'type'       => 'textarea',
    ));

    $wp_customize->add_setting('historia1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'historia1_imagen_control', array(
        'label'      => __('Historia 1 - Imagen', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_imagen',
        'mime_type'  => 'image',
        'description' => 'Imagen circular de la víctima',
    )));

    $wp_customize->add_setting('historia1_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'historia1_pdf_control', array(
        'label'      => __('Historia 1 - PDF', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_pdf',
        'mime_type'  => 'application/pdf',
        'description' => 'PDF de esta historia específica',
    )));

    // -----------------------------------
    // HISTORIA 2
    // -----------------------------------
    $wp_customize->add_setting('historia2_nombre', array(
        'default'   => 'José Martínez García',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('historia2_nombre_control', array(
        'label'      => __('Historia 2 - Nombre', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_nombre',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('historia2_descripcion', array(
        'default'   => 'Padre que busca verdad y justicia después de 15 años. Su hijo fue presentado como falso positivo.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('historia2_descripcion_control', array(
        'label'      => __('Historia 2 - Descripción', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_descripcion',
        'type'       => 'textarea',
    ));

    $wp_customize->add_setting('historia2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'historia2_imagen_control', array(
        'label'      => __('Historia 2 - Imagen', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_imagen',
        'mime_type'  => 'image',
        'description' => 'Imagen circular de la víctima',
    )));

    $wp_customize->add_setting('historia2_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'historia2_pdf_control', array(
        'label'      => __('Historia 2 - PDF', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_pdf',
        'mime_type'  => 'application/pdf',
        'description' => 'PDF de esta historia específica',
    )));

    // -----------------------------------
    // HISTORIA 3
    // -----------------------------------
    $wp_customize->add_setting('historia3_nombre', array(
        'default'   => 'Ana García Rodríguez',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('historia3_nombre_control', array(
        'label'      => __('Historia 3 - Nombre', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_nombre',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('historia3_descripcion', array(
        'default'   => 'Madre de víctima que no se rinde en su búsqueda de justicia. Busca esclarecer la verdad.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('historia3_descripcion_control', array(
        'label'      => __('Historia 3 - Descripción', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_descripcion',
        'type'       => 'textarea',
    ));

    $wp_customize->add_setting('historia3_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'historia3_imagen_control', array(
        'label'      => __('Historia 3 - Imagen', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_imagen',
        'mime_type'  => 'image',
        'description' => 'Imagen circular de la víctima',
    )));

    $wp_customize->add_setting('historia3_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'historia3_pdf_control', array(
        'label'      => __('Historia 3 - PDF', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_pdf',
        'mime_type'  => 'application/pdf',
        'description' => 'PDF de esta historia específica',
    )));

    // -----------------------------------
    // URL de la sección en Conócenos
    // -----------------------------------
    $wp_customize->add_setting('historias_url_seccion', array(
        'default'   => '/conocenos#historias-victimas',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('historias_url_seccion_control', array(
        'label'      => __('URL "Lee más historias" (Sección en Conócenos)', 'tema-custom'),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historias_url_seccion',
        'type'       => 'url',
        'description' => 'Enlace del botón "Lee más historias"',
    ));

    // ===================================
    // SECCIÓN: Footer
    // ===================================
    $wp_customize->add_section('footer_section', array(
        'title'      => __('Footer', 'tema-custom'),
        'priority'   => 50,
        'description' => 'Personaliza los textos del footer'
    ));

    // -----------------------------------
    // CAMPO 1: Texto Principal
    // -----------------------------------
    $wp_customize->add_setting('footer_texto_principal', array(
        'default'   => 'Buscamos #JusticiaParaLas6402 víctimas de ejecuciones extrajudiciales',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('footer_texto_principal_control', array(
        'label'      => __('Texto Principal', 'tema-custom'),
        'section'    => 'footer_section',
        'settings'   => 'footer_texto_principal',
        'type'       => 'textarea',
        'description' => 'Texto que aparece en el footer (usa Shift+Enter para saltos de línea)',
    ));

    // -----------------------------------
    // CAMPO 2: Texto del Botón (Mobile)
    // -----------------------------------
    $wp_customize->add_setting('footer_boton_texto', array(
        'default'   => 'Apoya con tu firma',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('footer_boton_texto_control', array(
        'label'      => __('Texto del Botón (Mobile)', 'tema-custom'),
        'section'    => 'footer_section',
        'settings'   => 'footer_boton_texto',
        'type'       => 'text',
    ));

    // -----------------------------------
    // CAMPO 3: URL del Botón (Mobile)
    // -----------------------------------
    $wp_customize->add_setting('footer_boton_url', array(
        'default'   => '#firmar',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('footer_boton_url_control', array(
        'label'      => __('URL del Botón (Mobile)', 'tema-custom'),
        'section'    => 'footer_section',
        'settings'   => 'footer_boton_url',
        'type'       => 'url',
        'description' => 'Enlace del botón "Apoya con tu firma"',
    ));

    // -----------------------------------
    // CAMPO 4: Texto Copyright
    // -----------------------------------
    $wp_customize->add_setting('footer_copyright', array(
        'default'   => 'Justicia para las 6402. Todos los derechos reservados',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('footer_copyright_control', array(
        'label'      => __('Texto de Copyright', 'tema-custom'),
        'section'    => 'footer_section',
        'settings'   => 'footer_copyright',
        'type'       => 'text',
        'description' => 'Texto del copyright (el año se añade automáticamente)',
    ));

    // ===================================
    // SECCIÓN: Banner Hero (Componente Reutilizable)
    // ===================================
    $wp_customize->add_section('banner_hero_section', array(
        'title'      => __('Banner Hero Animado - Conocenos', 'tema-custom'),
        'priority'   => 55,
        'description' => 'Configura el banner animado con 3 slides (usado en Conócenos y otras páginas)'
    ));

    // -----------------------------------
    // CONFIGURACIÓN GENERAL
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_intervalo', array(
        'default'   => '5',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('banner_hero_intervalo_control', array(
        'label'      => __('Intervalo de Cambio (segundos)', 'tema-custom'),
        'section'    => 'banner_hero_section',
        'settings'   => 'banner_hero_intervalo',
        'type'       => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 15,
            'step' => 1,
        ),
        'description' => 'Tiempo entre cada slide (3-15 segundos)',
    ));

    // -----------------------------------
    // SLIDE 1
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_slide1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_slide1_imagen_control', array(
        'label'      => __('Slide 1 - Imagen de Fondo', 'tema-custom'),
        'section'    => 'banner_hero_section',
        'settings'   => 'banner_hero_slide1_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_slide1_texto', array(
        'default'   => 'Buscamos #JusticiaParaLas6402 víctimas de ejecuciones extrajudiciales',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_slide1_texto_control', array(
        'label'      => __('Slide 1 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_section',
        'settings'   => 'banner_hero_slide1_texto',
        'type'       => 'textarea',
        'description' => 'Presiona Enter para saltos de línea',
    ));

    // -----------------------------------
    // SLIDE 2
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_slide2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_slide2_imagen_control', array(
        'label'      => __('Slide 2 - Imagen de Fondo', 'tema-custom'),
        'section'    => 'banner_hero_section',
        'settings'   => 'banner_hero_slide2_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_slide2_texto', array(
        'default'   => 'Luchamos por la verdad y la justicia para todas las víctimas',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_slide2_texto_control', array(
        'label'      => __('Slide 2 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_section',
        'settings'   => 'banner_hero_slide2_texto',
        'type'       => 'textarea',
    ));

    // -----------------------------------
    // SLIDE 3
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_slide3_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_slide3_imagen_control', array(
        'label'      => __('Slide 3 - Imagen de Fondo', 'tema-custom'),
        'section'    => 'banner_hero_section',
        'settings'   => 'banner_hero_slide3_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_slide3_texto', array(
        'default'   => 'Unidos por la memoria de las 6.402 víctimas',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_slide3_texto_control', array(
        'label'      => __('Slide 3 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_section',
        'settings'   => 'banner_hero_slide3_texto',
        'type'       => 'textarea',
    ));


    // ===================================
    // SECCIÓN: Video + Texto (Conócenos)
    // ===================================
    $wp_customize->add_section('conocenos_video_section', array(
        'title'      => __('Conócenos - Video + Texto', 'tema-custom'),
        'priority'   => 60,
        'description' => 'Sección con video embebido y texto explicativo'
    ));

    // -----------------------------------
    // CAMPO 1: Código HTML del Video
    // -----------------------------------
    $wp_customize->add_setting('conocenos_video_embed', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_video_url'
    ));

    $wp_customize->add_control('conocenos_video_embed_control', array(
        'label' => __('URL del Video', 'tema-custom'),
        'section' => 'conocenos_video_section',
        'settings' => 'conocenos_video_embed',
        'type' => 'url', // Cambiar a tipo URL
        'description' => 'Pega la URL completa del video de YouTube, Instagram o Vimeo. Ejemplos:<br>
    • YouTube: https://www.youtube.com/watch?v=ABC123<br>
    • Instagram: https://www.instagram.com/reel/ABC123/<br>
    • Vimeo: https://vimeo.com/123456789',
    ));

    // -----------------------------------
    // CAMPO 2: Texto Descriptivo
    // -----------------------------------
    $wp_customize->add_setting('conocenos_video_texto', array(
        'default'   => 'En noviembre de 2023, se interpuso una querella en Argentina para esclarecer la responsabilidad de Álvaro Uribe Vélez en las ejecuciones extrajudiciales (mal llamados "falsos positivos") durante su mandato. El primer paso es la apertura de la investigación que podría llevar –a largo plazo– a la captura, extradición y condena del investigado si se le encuentra culpable.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('conocenos_video_texto_control', array(
        'label'      => __('Texto Descriptivo', 'tema-custom'),
        'section'    => 'conocenos_video_section',
        'settings'   => 'conocenos_video_texto',
        'type'       => 'textarea',
        'description' => 'Texto que acompaña al video',
    ));

    // ===================================
    // SECCIÓN: Por Qué Argentina
    // ===================================
    $wp_customize->add_section('argentina_section', array(
        'title'      => __('Conócenos - Por Qué Argentina', 'tema-custom'),
        'priority'   => 65,
        'description' => 'Sección "¿Por qué buscar justicia en Argentina?"'
    ));

    // -----------------------------------
    // CAMPO 1: Título Parte 1 (Negro)
    // -----------------------------------
    $wp_customize->add_setting('argentina_titulo_parte1', array(
        'default'   => 'POR QUÉ BUSCAR JUSTICIA',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('argentina_titulo_parte1_control', array(
        'label'      => __('Título - Parte 1 (Color Negro)', 'tema-custom'),
        'section'    => 'argentina_section',
        'settings'   => 'argentina_titulo_parte1',
        'type'       => 'text',
        'description' => 'Primera línea del título'
    ));

    // -----------------------------------
    // CAMPO 2: Título Parte 2 (Naranja)
    // -----------------------------------
    $wp_customize->add_setting('argentina_titulo_parte2', array(
        'default'   => 'EN ARGENTINA?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('argentina_titulo_parte2_control', array(
        'label'      => __('Título - Parte 2 (Color Naranja)', 'tema-custom'),
        'section'    => 'argentina_section',
        'settings'   => 'argentina_titulo_parte2',
        'type'       => 'text',
        'description' => 'Segunda línea del título'
    ));

    // -----------------------------------
    // CAMPO 3: Texto Descriptivo
    // -----------------------------------
    $wp_customize->add_setting('argentina_texto', array(
        'default'   => '• La demanda se realiza desde el principio de jurisdicción universal, que aplica en todo el mundo.<br>• Bajo la jurisdicción universal, los crímenes de lesa humanidad pueden ser investigados y juzgados en otro país (por ejemplo, Argentina) cuando no hay garantías de justicia suficientes donde fue cometido.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('argentina_texto_control', array(
        'label'      => __('Texto Descriptivo', 'tema-custom'),
        'section'    => 'argentina_section',
        'settings'   => 'argentina_texto',
        'type'       => 'textarea',
        'description' => 'Texto con bullet points. Usa &lt;br&gt; para saltos de línea.'
    ));

    // ===================================
    // SECCIÓN: Por Qué NO en Colombia
    // ===================================
    $wp_customize->add_section('colombia_section', array(
        'title'      => __('Conócenos - Por Qué NO en Colombia', 'tema-custom'),
        'priority'   => 70, // Prioridad después de Argentina (65)
        'description' => 'Sección "¿Por qué NO en Colombia?"'
    ));

    // -----------------------------------
    // CAMPO 1: Título Parte 1 (Negro)
    // -----------------------------------
    $wp_customize->add_setting('colombia_titulo_parte1', array(
        'default'   => '¿POR QUÉ NO',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('colombia_titulo_parte1_control', array(
        'label'      => __('Título - Parte 1 (Color Negro)', 'tema-custom'),
        'section'    => 'colombia_section',
        'settings'   => 'colombia_titulo_parte1',
        'type'       => 'text',
        'description' => 'Primera línea del título'
    ));

    // -----------------------------------
    // CAMPO 2: Título Parte 2 (Naranja)
    // -----------------------------------
    $wp_customize->add_setting('colombia_titulo_parte2', array(
        'default'   => 'EN COLOMBIA?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('colombia_titulo_parte2_control', array(
        'label'      => __('Título - Parte 2 (Color Naranja)', 'tema-custom'),
        'section'    => 'colombia_section',
        'settings'   => 'colombia_titulo_parte2',
        'type'       => 'text',
        'description' => 'Segunda línea del título'
    ));

    // -----------------------------------
    // CAMPO 3: Texto Descriptivo
    // -----------------------------------
    $wp_customize->add_setting('colombia_texto', array(
        'default'   => '• La Jurisdicción Especial para la Paz (JEP), no tiene competencia para juzgar a presidentes de la República.<br>• Aunque la Comisión de Acusaciones puede investigar a expresidentes, en más de 60 años ningún alto funcionario ha sido llevado a juicio.<br>• De las dos denuncias que ha recibido la Comisión por ejecuciones extrajudiciales, ninguna ha sido abierta formalmente e inclusive una lleva 10 años en etapa preliminar.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post' // Permite <br>
    ));

    $wp_customize->add_control('colombia_texto_control', array(
        'label'      => __('Texto Descriptivo', 'tema-custom'),
        'section'    => 'colombia_section',
        'settings'   => 'colombia_texto',
        'type'       => 'textarea',
        'description' => 'Texto con bullet points. Usa &lt;br&gt; para saltos de línea.'
    ));

    // -----------------------------------
    // CAMPO 4: Texto Descriptivo 2 (Segunda columna)
    // -----------------------------------
    $wp_customize->add_setting('colombia_texto_2', array(
        'default'   => '• Las investigaciones son designadas "a dedo" por el presidente de la Comisión de Acusaciones: no hay imparcialidad.<br>• Si bien el expresidente Álvaro Uribe Vélez fue condenado por la justicia ordinaria por otros delitos, ésta no le puede juzgar por crímenes cometidos durante su mandato presidencial.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('colombia_texto_2_control', array(
        'label'      => __('Texto Descriptivo 2 (Segunda imagen)', 'tema-custom'),
        'section'    => 'colombia_section',
        'settings'   => 'colombia_texto_2',
        'type'       => 'textarea',
        'description' => 'Texto para la segunda columna con imagen co2.png. Usa &lt;br&gt; para saltos de línea.'
    ));

    // ===================================
    // SECCIÓN: Qué son las Ejecuciones Extrajudiciales
    // ===================================
    $wp_customize->add_section('ejecuciones_section', array(
        'title'      => __('Conócenos - Qué son las Ejecuciones', 'tema-custom'),
        'priority'   => 75,
        'description' => 'Sección "¿Qué son las ejecuciones extrajudiciales?"'
    ));

    // -----------------------------------
    // CAMPO 1: Título Principal (Blanco)
    // -----------------------------------
    $wp_customize->add_setting('ejecuciones_titulo_parte1', array(
        'default'   => 'QUÉ SON LA EJECUCIONES EXTRAJUDICIALES O MAL LLAMADAS',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('ejecuciones_titulo_parte1_control', array(
        'label'      => __('Título - Parte 1 (Color Blanco)', 'tema-custom'),
        'section'    => 'ejecuciones_section',
        'settings'   => 'ejecuciones_titulo_parte1',
        'type'       => 'text',
        'description' => 'Primera parte del título'
    ));

    // -----------------------------------
    // CAMPO 2: Título "Falsos Positivos" (Amarillo)
    // -----------------------------------
    $wp_customize->add_setting('ejecuciones_titulo_parte2', array(
        'default'   => '"FALSOS POSITIVOS"?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('ejecuciones_titulo_parte2_control', array(
        'label'      => __('Título - Parte 2 (Color Amarillo)', 'tema-custom'),
        'section'    => 'ejecuciones_section',
        'settings'   => 'ejecuciones_titulo_parte2',
        'type'       => 'text',
        'description' => 'Segunda parte del título (amarillo)'
    ));

    // -----------------------------------
    // CAMPO 3: Texto Columna 1
    // -----------------------------------
    $wp_customize->add_setting('ejecuciones_texto_1', array(
        'default'   => '• Personas civiles desarmadas que fueron asesinadas y presentadas por miembros del Ejército como integrantes de grupos al margen de la ley dados en baja en combate.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('ejecuciones_texto_1_control', array(
        'label'      => __('Texto - Columna 1', 'tema-custom'),
        'section'    => 'ejecuciones_section',
        'settings'   => 'ejecuciones_texto_1',
        'type'       => 'textarea',
        'description' => 'Texto de la primera columna. Usa &lt;br&gt; para saltos de línea.'
    ));

    // -----------------------------------
    // CAMPO 4: Texto Columna 2
    // -----------------------------------
    $wp_customize->add_setting('ejecuciones_texto_2', array(
        'default'   => '• Es un crimen de lesa humanidad: fue sistemático y generalizado en todo el país bajo la Política de Seguridad Democrática.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('ejecuciones_texto_2_control', array(
        'label'      => __('Texto - Columna 2', 'tema-custom'),
        'section'    => 'ejecuciones_section',
        'settings'   => 'ejecuciones_texto_2',
        'type'       => 'textarea',
        'description' => 'Texto de la segunda columna.'
    ));

    // -----------------------------------
    // CAMPO 5: Texto Columna 3
    // -----------------------------------
    $wp_customize->add_setting('ejecuciones_texto_3', array(
        'default'   => '• El gobierno de Uribe Vélez incorporó políticas dirigidas a entregar estímulos y beneficios a militares y civiles por el asesinato de combatientes de grupos guerrilleros, presión por resultados que derivó en asesinato de civiles.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('ejecuciones_texto_3_control', array(
        'label'      => __('Texto - Columna 3', 'tema-custom'),
        'section'    => 'ejecuciones_section',
        'settings'   => 'ejecuciones_texto_3',
        'type'       => 'textarea',
        'description' => 'Texto de la tercera columna.'
    ));

    // ===================================
    // SECCIÓN: ¿Por Qué Se Demanda a Uribe?
    // ===================================
    $wp_customize->add_section('por_que_uribe_section', array(
        'title'      => __('Conócenos - ¿Por Qué Demanda a Uribe?', 'tema-custom'),
        'priority'   => 65,
        'description' => 'Sección con 4 bloques explicativos (Desktop: grid 2x2, Mobile: carrusel)'
    ));

    // TÍTULO DE LA SECCIÓN
    $wp_customize->add_setting('por_que_uribe_titulo', array(
        'default'   => '¿POR QUÉ SE DEMANDA A URIBE?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('por_que_uribe_titulo_control', array(
        'label'      => __('Título de la Sección', 'tema-custom'),
        'section'    => 'por_que_uribe_section',
        'settings'   => 'por_que_uribe_titulo',
        'type'       => 'text',
    ));

    // -----------------------------------
    // BLOQUE 1 (Superior Izquierdo - Amarillo Mostaza)
    // -----------------------------------
    $wp_customize->add_setting('por_que_uribe_bloque1_texto', array(
        'default'   => 'Promovió políticas que incentivaron las ejecuciones extrajudiciales',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('por_que_uribe_bloque1_texto_control', array(
        'label'      => __('Bloque 1 - Texto', 'tema-custom'),
        'section'    => 'por_que_uribe_section',
        'settings'   => 'por_que_uribe_bloque1_texto',
        'type'       => 'textarea',
        'description' => 'Bloque superior izquierdo (fondo amarillo mostaza)',
    ));

    // -----------------------------------
    // BLOQUE 2 (Superior Derecho - Naranja Rojizo)
    // -----------------------------------
    $wp_customize->add_setting('por_que_uribe_bloque2_texto', array(
        'default'   => 'Como Comandante Supremo de las Fuerzas Militares era responsable de supervisar y controlar',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('por_que_uribe_bloque2_texto_control', array(
        'label'      => __('Bloque 2 - Texto', 'tema-custom'),
        'section'    => 'por_que_uribe_section',
        'settings'   => 'por_que_uribe_bloque2_texto',
        'type'       => 'textarea',
        'description' => 'Bloque superior derecho (fondo naranja rojizo, con imagen de Uribe)',
    ));

    // -----------------------------------
    // BLOQUE 3 (Inferior Izquierdo - Naranja Oscuro)
    // -----------------------------------
    $wp_customize->add_setting('por_que_uribe_bloque3_texto', array(
        'default'   => 'Conocía de los crímenes y no hizo nada para detenerlos',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('por_que_uribe_bloque3_texto_control', array(
        'label'      => __('Bloque 3 - Texto', 'tema-custom'),
        'section'    => 'por_que_uribe_section',
        'settings'   => 'por_que_uribe_bloque3_texto',
        'type'       => 'textarea',
        'description' => 'Bloque inferior izquierdo (fondo naranja oscuro, con número 6402)',
    ));

    // -----------------------------------
    // BLOQUE 4 (Inferior Derecho - Amarillo)
    // -----------------------------------
    $wp_customize->add_setting('por_que_uribe_bloque4_texto', array(
        'default'   => 'No investigó ni sancionó a los responsables',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('por_que_uribe_bloque4_texto_control', array(
        'label'      => __('Bloque 4 - Texto', 'tema-custom'),
        'section'    => 'por_que_uribe_section',
        'settings'   => 'por_que_uribe_bloque4_texto',
        'type'       => 'textarea',
        'description' => 'Bloque inferior derecho (fondo amarillo)',
    ));

    // ===================================
    // SECCIÓN: Quiénes Somos?
    // ===================================
    $wp_customize->add_section('quienes_somos_section', array(
        'title'      => __('Conócenos - Quiénes Somos?', 'tema-custom'),
        'priority'   => 70,
        'description' => 'Sección con imagen y texto sobre la campaña'
    ));

    // TÍTULO
    $wp_customize->add_setting('quienes_somos_titulo', array(
        'default'   => 'QUIÉNES SOMOS?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('quienes_somos_titulo_control', array(
        'label'      => __('Título', 'tema-custom'),
        'section'    => 'quienes_somos_section',
        'settings'   => 'quienes_somos_titulo',
        'type'       => 'text',
    ));

    // TEXTO PRINCIPAL
    $wp_customize->add_setting('quienes_somos_texto', array(
        'default'   => 'La campaña #JusticiaParaLas6402 es una iniciativa liderada por quienes interpusieron la querella en Argentina: las víctimas de ejecuciones extrajudiciales y organizaciones que tienen décadas de experiencia en la defensa de los derechos humanos, como la Corporación Jurídica Libertad (CJL) que trabaja principalmente en Antioquia, el Comité de Solidaridad con los Presos Políticos (CSPP) y el Colectivo de Abogados y Abogadas José Alvear Restrepo (Cajar), en el marco del Espacio de Litigio Estratégico.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('quienes_somos_texto_control', array(
        'label'      => __('Texto Descriptivo', 'tema-custom'),
        'section'    => 'quienes_somos_section',
        'settings'   => 'quienes_somos_texto',
        'type'       => 'textarea',
    ));

    // TEXTO DEL BOTÓN
    $wp_customize->add_setting('quienes_somos_boton_texto', array(
        'default'   => 'Descargar documento',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('quienes_somos_boton_texto_control', array(
        'label'      => __('Texto del Botón', 'tema-custom'),
        'section'    => 'quienes_somos_section',
        'settings'   => 'quienes_somos_boton_texto',
        'type'       => 'text',
    ));

    // PDF PARA DESCARGAR
    $wp_customize->add_setting('quienes_somos_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'quienes_somos_pdf_control', array(
        'label'      => __('PDF para Descargar', 'tema-custom'),
        'section'    => 'quienes_somos_section',
        'settings'   => 'quienes_somos_pdf',
        'description' => 'Sube el archivo PDF que se descargará al hacer clic en el botón',
    )));

    // ===================================
    // SECCIÓN: Las Víctimas Que Demandan
    // ===================================
    $wp_customize->add_section('victimas_demandan_section', array(
        'title'      => __('Conócenos - Las Víctimas Que Demandan', 'tema-custom'),
        'priority'   => 75,
        'description' => 'Sección con tarjetas de víctimas (Desktop: 2 cards, Mobile: carrusel)'
    ));

    // TÍTULO PARTE 1
    $wp_customize->add_setting('victimas_demandan_titulo1', array(
        'default'   => 'LAS VÍCTIMAS',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('victimas_demandan_titulo1_control', array(
        'label'      => __('Título - Parte 1 (Negro)', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victimas_demandan_titulo1',
        'type'       => 'text',
    ));

    // TÍTULO PARTE 2
    $wp_customize->add_setting('victimas_demandan_titulo2', array(
        'default'   => 'QUE DEMANDAN',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('victimas_demandan_titulo2_control', array(
        'label'      => __('Título - Parte 2 (Naranja)', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victimas_demandan_titulo2',
        'type'       => 'text',
    ));

    // DESCRIPCIÓN
    $wp_customize->add_setting('victimas_demandan_descripcion', array(
        'default'   => 'La querella fue interpuesta a nombre de 11 víctimas de ejecuciones extrajudiciales. Cuatro de ellas son víctimas identificadas -sus familiares son demandantes reconocidas en el proceso jurídico- y otras siete son víctimas sin identificar. Estas son sus historias:',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('victimas_demandan_descripcion_control', array(
        'label'      => __('Descripción', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victimas_demandan_descripcion',
        'type'       => 'textarea',
    ));

    // -----------------------------------
    // VÍCTIMA 1
    // -----------------------------------
    $wp_customize->add_setting('victima1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'victima1_imagen_control', array(
        'label'      => __('Víctima 1 - Imagen', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victima1_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('victima1_nombre', array(
        'default'   => 'Lorem ipsum consectetur',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('victima1_nombre_control', array(
        'label'      => __('Víctima 1 - Nombre', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victima1_nombre',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('victima1_descripcion', array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('victima1_descripcion_control', array(
        'label'      => __('Víctima 1 - Descripción (máx 98 caracteres)', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victima1_descripcion',
        'type'       => 'textarea',
    ));

    // -----------------------------------
    // VÍCTIMA 2
    // -----------------------------------
    $wp_customize->add_setting('victima2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'victima2_imagen_control', array(
        'label'      => __('Víctima 2 - Imagen', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victima2_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('victima2_nombre', array(
        'default'   => 'Lorem ipsum consectetur',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('victima2_nombre_control', array(
        'label'      => __('Víctima 2 - Nombre', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victima2_nombre',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('victima2_descripcion', array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('victima2_descripcion_control', array(
        'label'      => __('Víctima 2 - Descripción (máx 98 caracteres)', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victima2_descripcion',
        'type'       => 'textarea',
    ));

    // BOTÓN
    $wp_customize->add_setting('victimas_boton_texto', array(
        'default'   => 'Descargar las imágenes',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('victimas_boton_texto_control', array(
        'label'      => __('Texto del Botón', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victimas_boton_texto',
        'type'       => 'text',
    ));

    // PDF DEL BOTÓN
    $wp_customize->add_setting('victimas_boton_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'victimas_boton_pdf_control', array(
        'label'      => __('PDF para Descargar', 'tema-custom'),
        'section'    => 'victimas_demandan_section',
        'settings'   => 'victimas_boton_pdf',
        'description' => 'Sube el archivo PDF de las imágenes',
    )));

    // ===================================
    // SECCIÓN: Banner Hero - ¿Qué está pasando?
    // ===================================
    $wp_customize->add_section('banner_hero_que_pasa_section', array(
        'title'      => __('Banner Hero - ¿Qué está pasando?', 'tema-custom'),
        'priority'   => 56,
        'description' => 'Configura el banner animado para la página ¿Qué está pasando? (3 slides independientes)'
    ));

    // -----------------------------------
    // CONFIGURACIÓN GENERAL
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_que_pasa_intervalo', array(
        'default'   => '5',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('banner_hero_que_pasa_intervalo_control', array(
        'label'      => __('Intervalo de Cambio (segundos)', 'tema-custom'),
        'section'    => 'banner_hero_que_pasa_section',
        'settings'   => 'banner_hero_que_pasa_intervalo',
        'type'       => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 15,
            'step' => 1,
        ),
        'description' => 'Tiempo entre cada slide (3-15 segundos)',
    ));

    // -----------------------------------
    // SLIDE 1
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_que_pasa_slide1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_que_pasa_slide1_imagen_control', array(
        'label'      => __('Slide 1 - Imagen de Fondo', 'tema-custom'),
        'section'    => 'banner_hero_que_pasa_section',
        'settings'   => 'banner_hero_que_pasa_slide1_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_que_pasa_slide1_texto', array(
        'default'   => 'Mantente informado sobre el caso',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_que_pasa_slide1_texto_control', array(
        'label'      => __('Slide 1 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_que_pasa_section',
        'settings'   => 'banner_hero_que_pasa_slide1_texto',
        'type'       => 'textarea',
        'description' => 'Presiona Enter para saltos de línea',
    ));

    // -----------------------------------
    // SLIDE 2
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_que_pasa_slide2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_que_pasa_slide2_imagen_control', array(
        'label'      => __('Slide 2 - Imagen de Fondo', 'tema-custom'),
        'section'    => 'banner_hero_que_pasa_section',
        'settings'   => 'banner_hero_que_pasa_slide2_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_que_pasa_slide2_texto', array(
        'default'   => 'Últimas noticias del proceso judicial',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_que_pasa_slide2_texto_control', array(
        'label'      => __('Slide 2 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_que_pasa_section',
        'settings'   => 'banner_hero_que_pasa_slide2_texto',
        'type'       => 'textarea',
    ));

    // -----------------------------------
    // SLIDE 3
    // -----------------------------------
    $wp_customize->add_setting('banner_hero_que_pasa_slide3_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_que_pasa_slide3_imagen_control', array(
        'label'      => __('Slide 3 - Imagen de Fondo', 'tema-custom'),
        'section'    => 'banner_hero_que_pasa_section',
        'settings'   => 'banner_hero_que_pasa_slide3_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_que_pasa_slide3_texto', array(
        'default'   => 'Avances en la búsqueda de justicia',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_que_pasa_slide3_texto_control', array(
        'label'      => __('Slide 3 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_que_pasa_section',
        'settings'   => 'banner_hero_que_pasa_slide3_texto',
        'type'       => 'textarea',
    ));

    // ===================================
    // BANNER HERO - PÁGINA NOTICIAS
    // ===================================
    $wp_customize->add_section('banner_hero_noticias_section', array(
        'title'      => __('Banner Hero - Página Noticias', 'tema-custom'),
        'priority'   => 35,
        'description' => 'Configuración del banner animado para la página Noticias (3 slides)'
    ));

    // INTERVALO DE ROTACIÓN
    $wp_customize->add_setting('banner_hero_noticias_intervalo', array(
        'default'   => 5,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('banner_hero_noticias_intervalo_control', array(
        'label'      => __('Intervalo de rotación (segundos)', 'tema-custom'),
        'section'    => 'banner_hero_noticias_section',
        'settings'   => 'banner_hero_noticias_intervalo',
        'type'       => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 10,
            'step' => 1,
        ),
    ));

    // --- SLIDE 1 ---
    $wp_customize->add_setting('banner_hero_noticias_slide1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_noticias_slide1_imagen_control', array(
        'label'      => __('Slide 1 - Imagen', 'tema-custom'),
        'section'    => 'banner_hero_noticias_section',
        'settings'   => 'banner_hero_noticias_slide1_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_noticias_slide1_texto', array(
        'default'   => 'Mantente al día con las últimas noticias',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_noticias_slide1_texto_control', array(
        'label'      => __('Slide 1 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_noticias_section',
        'settings'   => 'banner_hero_noticias_slide1_texto',
        'type'       => 'textarea',
    ));

    // --- SLIDE 2 ---
    $wp_customize->add_setting('banner_hero_noticias_slide2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_noticias_slide2_imagen_control', array(
        'label'      => __('Slide 2 - Imagen', 'tema-custom'),
        'section'    => 'banner_hero_noticias_section',
        'settings'   => 'banner_hero_noticias_slide2_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_noticias_slide2_texto', array(
        'default'   => 'Información actualizada sobre el caso',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_noticias_slide2_texto_control', array(
        'label'      => __('Slide 2 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_noticias_section',
        'settings'   => 'banner_hero_noticias_slide2_texto',
        'type'       => 'textarea',
    ));

    // --- SLIDE 3 ---
    $wp_customize->add_setting('banner_hero_noticias_slide3_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_noticias_slide3_imagen_control', array(
        'label'      => __('Slide 3 - Imagen', 'tema-custom'),
        'section'    => 'banner_hero_noticias_section',
        'settings'   => 'banner_hero_noticias_slide3_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_noticias_slide3_texto', array(
        'default'   => 'Sigue los avances del proceso',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_noticias_slide3_texto_control', array(
        'label'      => __('Slide 3 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_noticias_section',
        'settings'   => 'banner_hero_noticias_slide3_texto',
        'type'       => 'textarea',
    ));

    // ===================================
    // BANNER HERO - PÁGINA QUÉ PUEDO HACER
    // ===================================
    $wp_customize->add_section('banner_hero_que_puedo_hacer_section', array(
        'title'      => __('Banner Hero - Qué Puedo Hacer', 'tema-custom'),
        'priority'   => 36,
        'description' => 'Configuración del banner animado para la página Qué Puedo Hacer (3 slides)'
    ));

    // INTERVALO DE ROTACIÓN
    $wp_customize->add_setting('banner_hero_que_puedo_hacer_intervalo', array(
        'default'   => 5,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('banner_hero_que_puedo_hacer_intervalo_control', array(
        'label'      => __('Intervalo de rotación (segundos)', 'tema-custom'),
        'section'    => 'banner_hero_que_puedo_hacer_section',
        'settings'   => 'banner_hero_que_puedo_hacer_intervalo',
        'type'       => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 10,
            'step' => 1,
        ),
    ));

    // --- SLIDE 1 ---
    $wp_customize->add_setting('banner_hero_que_puedo_hacer_slide1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_que_puedo_hacer_slide1_imagen_control', array(
        'label'      => __('Slide 1 - Imagen', 'tema-custom'),
        'section'    => 'banner_hero_que_puedo_hacer_section',
        'settings'   => 'banner_hero_que_puedo_hacer_slide1_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_que_puedo_hacer_slide1_texto', array(
        'default'   => 'Únete a la causa por la justicia',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_que_puedo_hacer_slide1_texto_control', array(
        'label'      => __('Slide 1 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_que_puedo_hacer_section',
        'settings'   => 'banner_hero_que_puedo_hacer_slide1_texto',
        'type'       => 'textarea',
    ));

    // --- SLIDE 2 ---
    $wp_customize->add_setting('banner_hero_que_puedo_hacer_slide2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_que_puedo_hacer_slide2_imagen_control', array(
        'label'      => __('Slide 2 - Imagen', 'tema-custom'),
        'section'    => 'banner_hero_que_puedo_hacer_section',
        'settings'   => 'banner_hero_que_puedo_hacer_slide2_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_que_puedo_hacer_slide2_texto', array(
        'default'   => 'Tu apoyo hace la diferencia',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_que_puedo_hacer_slide2_texto_control', array(
        'label'      => __('Slide 2 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_que_puedo_hacer_section',
        'settings'   => 'banner_hero_que_puedo_hacer_slide2_texto',
        'type'       => 'textarea',
    ));

    // --- SLIDE 3 ---
    $wp_customize->add_setting('banner_hero_que_puedo_hacer_slide3_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_hero_que_puedo_hacer_slide3_imagen_control', array(
        'label'      => __('Slide 3 - Imagen', 'tema-custom'),
        'section'    => 'banner_hero_que_puedo_hacer_section',
        'settings'   => 'banner_hero_que_puedo_hacer_slide3_imagen',
        'mime_type'  => 'image',
    )));

    $wp_customize->add_setting('banner_hero_que_puedo_hacer_slide3_texto', array(
        'default'   => 'Participa activamente en la búsqueda de verdad',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('banner_hero_que_puedo_hacer_slide3_texto_control', array(
        'label'      => __('Slide 3 - Texto', 'tema-custom'),
        'section'    => 'banner_hero_que_puedo_hacer_section',
        'settings'   => 'banner_hero_que_puedo_hacer_slide3_texto',
        'type'       => 'textarea',
    ));

    // ===================================
    // SECCIÓN: Si tod@s nos unimos (Qué Puedo Hacer)
    // ===================================
    $wp_customize->add_section('si_todos_nos_unimos_section', array(
        'title'      => __('Qué Puedo Hacer - Si tod@s nos unimos', 'tema-custom'),
        'priority'   => 80,
        'description' => 'Personaliza la sección "Si tod@s nos unimos"'
    ));

    // Título Parte 1 (Negro)
    $wp_customize->add_setting('si_todos_titulo_parte1', array(
        'default'   => '¡Si tod@s nos unimos,',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('si_todos_titulo_parte1_control', array(
        'label'      => __('Título - Parte 1 (Negro)', 'tema-custom'),
        'section'    => 'si_todos_nos_unimos_section',
        'settings'   => 'si_todos_titulo_parte1',
        'type'       => 'text',
    ));

    // Título Parte 2 (Café)
    $wp_customize->add_setting('si_todos_titulo_parte2', array(
        'default'   => 'tod@s conoceremos la verdad!',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('si_todos_titulo_parte2_control', array(
        'label'      => __('Título - Parte 2 (Café)', 'tema-custom'),
        'section'    => 'si_todos_nos_unimos_section',
        'settings'   => 'si_todos_titulo_parte2',
        'type'       => 'text',
    ));

    // Párrafo 1
    $wp_customize->add_setting('si_todos_parrafo1', array(
        'default'   => 'Bajo la política de la "seguridad democrática" miles de personas fueron ejecutadas extrajudicialmente y presentadas como baja en combate (mal llamados falsos positivos) por el Ejército colombiano.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('si_todos_parrafo1_control', array(
        'label'      => __('Párrafo 1', 'tema-custom'),
        'section'    => 'si_todos_nos_unimos_section',
        'settings'   => 'si_todos_parrafo1',
        'type'       => 'textarea',
    ));

    // Párrafo 2
    $wp_customize->add_setting('si_todos_parrafo2', array(
        'default'   => 'Las familias de miles de víctimas de estas ejecuciones extrajudiciales esperan respuesta de la querella interpuesta en 2023 en Argentina. Sin embargo, en año y medio, no ha habido avances significativos ni apertura formal de la investigación contra el expresidente Uribe Vélez.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('si_todos_parrafo2_control', array(
        'label'      => __('Párrafo 2', 'tema-custom'),
        'section'    => 'si_todos_nos_unimos_section',
        'settings'   => 'si_todos_parrafo2',
        'type'       => 'textarea',
    ));

    // ===================================
    // SECCIÓN: Firma esta petición (Qué Puedo Hacer)
    // ===================================
    $wp_customize->add_section('firma_peticion_section', array(
        'title'      => __('Qué Puedo Hacer - Firma esta petición', 'tema-custom'),
        'priority'   => 85,
        'description' => 'Personaliza la sección "Firma esta petición"'
    ));

    // Título Principal
    $wp_customize->add_setting('firma_peticion_titulo', array(
        'default'   => 'Firma esta petición',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('firma_peticion_titulo_control', array(
        'label'      => __('Título Principal', 'tema-custom'),
        'section'    => 'firma_peticion_section',
        'settings'   => 'firma_peticion_titulo',
        'type'       => 'text',
    ));

    // Texto 1
    $wp_customize->add_setting('firma_peticion_texto1', array(
        'default'   => 'Las víctimas exigen el avance de las investigaciones y tú puedes apoyar firmando la petición de Change',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('firma_peticion_texto1_control', array(
        'label'      => __('Texto 1', 'tema-custom'),
        'section'    => 'firma_peticion_section',
        'settings'   => 'firma_peticion_texto1',
        'type'       => 'textarea',
    ));

    // Texto 2
    $wp_customize->add_setting('firma_peticion_texto2', array(
        'default'   => 'Buscamos conseguir al menos 6402 firmas antes de noviembre para llevarlas ante la justicia Argentina.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('firma_peticion_texto2_control', array(
        'label'      => __('Texto 2', 'tema-custom'),
        'section'    => 'firma_peticion_section',
        'settings'   => 'firma_peticion_texto2',
        'type'       => 'textarea',
    ));

    // Instrucciones (lista numerada)
    $wp_customize->add_setting('firma_peticion_instrucciones', array(
        'default'   => '1. Abre el enlace en el botón.<br>2. Escribe tu nombre, apellido y un correo válido.<br>3. Comparte con tus amigxs que también quieren verdad y justicia.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('firma_peticion_instrucciones_control', array(
        'label'      => __('Instrucciones', 'tema-custom'),
        'section'    => 'firma_peticion_section',
        'settings'   => 'firma_peticion_instrucciones',
        'type'       => 'textarea',
        'description' => 'Usa &lt;br&gt; para saltos de línea'
    ));

    // Texto recordatorio
    $wp_customize->add_setting('firma_peticion_recordatorio', array(
        'default'   => 'Recuerda: No necesitas documento de identificación y puedes desmarcar la opción para que tu firma no sea visible públicamente.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('firma_peticion_recordatorio_control', array(
        'label'      => __('Texto Recordatorio', 'tema-custom'),
        'section'    => 'firma_peticion_section',
        'settings'   => 'firma_peticion_recordatorio',
        'type'       => 'textarea',
    ));

    // Texto del Botón
    $wp_customize->add_setting('firma_peticion_boton_texto', array(
        'default'   => 'Firmar petición',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('firma_peticion_boton_texto_control', array(
        'label'      => __('Texto del Botón', 'tema-custom'),
        'section'    => 'firma_peticion_section',
        'settings'   => 'firma_peticion_boton_texto',
        'type'       => 'text',
    ));

    // URL del Botón
    $wp_customize->add_setting('firma_peticion_boton_url', array(
        'default'   => 'https://www.change.org/',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('firma_peticion_boton_url_control', array(
        'label'      => __('URL del Botón (Change.org)', 'tema-custom'),
        'section'    => 'firma_peticion_section',
        'settings'   => 'firma_peticion_boton_url',
        'type'       => 'url',
    ));

    // ===================================
    // SECCIÓN: Comparte (Qué Puedo Hacer)
    // ===================================
    $wp_customize->add_section('comparte_section', array(
        'title'      => __('Qué Puedo Hacer - Comparte', 'tema-custom'),
        'priority'   => 86,
        'description' => 'Personaliza la sección "Comparte"'
    ));

    // Título "COMPARTE"
    $wp_customize->add_setting('comparte_titulo', array(
        'default'   => 'COMPARTE',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('comparte_titulo_control', array(
        'label'      => __('Título Principal', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'comparte_titulo',
        'type'       => 'text',
    ));

    // Texto descriptivo
    $wp_customize->add_setting('comparte_texto_descripcion', array(
        'default'   => 'Dale espacio a la verdad y la justicia en tus redes sociales',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('comparte_texto_descripcion_control', array(
        'label'      => __('Texto Descriptivo', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'comparte_texto_descripcion',
        'type'       => 'textarea',
    ));

    // Texto secundario
    $wp_customize->add_setting('comparte_texto_secundario', array(
        'default'   => 'Tu familia, amigos, colegas también pueden apoyar para que conozcamos la verdad y se haga justicia.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('comparte_texto_secundario_control', array(
        'label'      => __('Texto Secundario', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'comparte_texto_secundario',
        'type'       => 'textarea',
    ));

    // Imagen izquierda (ilustración/foto)
    $wp_customize->add_setting('comparte_imagen_izquierda', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'comparte_imagen_izquierda_control', array(
        'label'      => __('Imagen Izquierda', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'comparte_imagen_izquierda',
        'mime_type'  => 'image',
    )));

    // Lista de instrucciones (columna derecha)
    $wp_customize->add_setting('comparte_instrucciones', array(
        'default'   => '1. Comparte en tus historias o por mensaje directo en tus redes sociales.<br>2. Sigue el hashtag y comparte las publicaciones en tus historias.<br>3. Participa de los eventos en tu ciudad.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('comparte_instrucciones_control', array(
        'label'      => __('Instrucciones (Lista)', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'comparte_instrucciones',
        'type'       => 'textarea',
        'description' => 'Usa &lt;br&gt; para saltos de línea'
    ));

    // ===================================
    // SUBSECCIÓN: Préstale tu ventana
    // ===================================

    // Título "Préstale tu ventana..."
    $wp_customize->add_setting('prestale_ventana_titulo', array(
        'default'   => 'PRÉSTALE TU VENTANA A LA VERDAD Y LA JUSTICIA',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('prestale_ventana_titulo_control', array(
        'label'      => __('Título "Préstale tu ventana"', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_ventana_titulo',
        'type'       => 'text',
    ));

    // Subtítulo "Descarga y comparte"
    $wp_customize->add_setting('prestale_ventana_subtitulo', array(
        'default'   => 'Descarga y comparte',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('prestale_ventana_subtitulo_control', array(
        'label'      => __('Subtítulo', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_ventana_subtitulo',
        'type'       => 'text',
    ));

    // Card 1: Imagen
    $wp_customize->add_setting('prestale_card1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'prestale_card1_imagen_control', array(
        'label'      => __('Card 1 - Imagen', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card1_imagen',
        'mime_type'  => 'image',
    )));

    // Card 1: Texto
    $wp_customize->add_setting('prestale_card1_texto', array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis...',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('prestale_card1_texto_control', array(
        'label'      => __('Card 1 - Texto', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card1_texto',
        'type'       => 'textarea',
    ));

    // Card 1: Texto del botón
    $wp_customize->add_setting('prestale_card1_boton_texto', array(
        'default'   => 'Descarga el afiche',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('prestale_card1_boton_texto_control', array(
        'label'      => __('Card 1 - Texto del Botón', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card1_boton_texto',
        'type'       => 'text',
    ));

    // Card 1: Archivo PDF/Imagen para descargar
    $wp_customize->add_setting('prestale_card1_archivo', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'prestale_card1_archivo_control', array(
        'label'      => __('Card 1 - Archivo para Descargar', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card1_archivo',
        'mime_type'  => 'application/pdf,image',
    )));

    // Card 2: Imagen
    $wp_customize->add_setting('prestale_card2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'prestale_card2_imagen_control', array(
        'label'      => __('Card 2 - Imagen', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card2_imagen',
        'mime_type'  => 'image',
    )));

    // Card 2: Texto
    $wp_customize->add_setting('prestale_card2_texto', array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis...',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('prestale_card2_texto_control', array(
        'label'      => __('Card 2 - Texto', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card2_texto',
        'type'       => 'textarea',
    ));

    // Card 2: Texto del botón
    $wp_customize->add_setting('prestale_card2_boton_texto', array(
        'default'   => 'Descarga la infografía',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('prestale_card2_boton_texto_control', array(
        'label'      => __('Card 2 - Texto del Botón', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card2_boton_texto',
        'type'       => 'text',
    ));

    // Card 2: Archivo PDF/Imagen para descargar
    $wp_customize->add_setting('prestale_card2_archivo', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'prestale_card2_archivo_control', array(
        'label'      => __('Card 2 - Archivo para Descargar', 'tema-custom'),
        'section'    => 'comparte_section',
        'settings'   => 'prestale_card2_archivo',
        'mime_type'  => 'application/pdf,image',
    )));

    // ===================================
    // SECCIÓN: Apoya (Qué Puedo Hacer)
    // ===================================
    $wp_customize->add_section('apoya_section', array(
        'title'      => __('Qué Puedo Hacer - Apoya', 'tema-custom'),
        'priority'   => 87,
        'description' => 'Personaliza la sección "Apoya"'
    ));

    // Título Principal
    $wp_customize->add_setting('apoya_titulo', array(
        'default'   => 'APOYA',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('apoya_titulo_control', array(
        'label'      => __('Título Principal', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_titulo',
        'type'       => 'text',
    ));

    // ===================================
    // Card 1: Sociedad Civil
    // ===================================

    // Card 1: Imagen
    $wp_customize->add_setting('apoya_card1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'apoya_card1_imagen_control', array(
        'label'      => __('Card 1 - Imagen', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card1_imagen',
        'mime_type'  => 'image',
    )));

    // Card 1: Título
    $wp_customize->add_setting('apoya_card1_titulo', array(
        'default'   => '¿Eres una organización de la sociedad civil?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('apoya_card1_titulo_control', array(
        'label'      => __('Card 1 - Título', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card1_titulo',
        'type'       => 'text',
    ));

    // Card 1: Texto
    $wp_customize->add_setting('apoya_card1_texto', array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('apoya_card1_texto_control', array(
        'label'      => __('Card 1 - Texto', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card1_texto',
        'type'       => 'textarea',
    ));

    // Card 1: Texto del Botón
    $wp_customize->add_setting('apoya_card1_boton_texto', array(
        'default'   => 'Descarga kit de incidencia',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('apoya_card1_boton_texto_control', array(
        'label'      => __('Card 1 - Texto del Botón', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card1_boton_texto',
        'type'       => 'text',
    ));

    // Card 1: Archivo para Descargar
    $wp_customize->add_setting('apoya_card1_archivo', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'apoya_card1_archivo_control', array(
        'label'      => __('Card 1 - Archivo para Descargar', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card1_archivo',
        'mime_type'  => 'application/pdf,application/zip',
    )));

    // ===================================
    // Card 2: Organización Internacional
    // ===================================

    // Card 2: Imagen
    $wp_customize->add_setting('apoya_card2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'apoya_card2_imagen_control', array(
        'label'      => __('Card 2 - Imagen', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card2_imagen',
        'mime_type'  => 'image',
    )));

    // Card 2: Título
    $wp_customize->add_setting('apoya_card2_titulo', array(
        'default'   => '¿Eres una organización internacional?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('apoya_card2_titulo_control', array(
        'label'      => __('Card 2 - Título', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card2_titulo',
        'type'       => 'text',
    ));

    // Card 2: Texto
    $wp_customize->add_setting('apoya_card2_texto', array(
        'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('apoya_card2_texto_control', array(
        'label'      => __('Card 2 - Texto', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card2_texto',
        'type'       => 'textarea',
    ));

    // Card 2: Texto del Botón
    $wp_customize->add_setting('apoya_card2_boton_texto', array(
        'default'   => 'Descarga kit de apoyo internacional',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('apoya_card2_boton_texto_control', array(
        'label'      => __('Card 2 - Texto del Botón', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card2_boton_texto',
        'type'       => 'text',
    ));

    // Card 2: Archivo para Descargar
    $wp_customize->add_setting('apoya_card2_archivo', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'apoya_card2_archivo_control', array(
        'label'      => __('Card 2 - Archivo para Descargar', 'tema-custom'),
        'section'    => 'apoya_section',
        'settings'   => 'apoya_card2_archivo',
        'mime_type'  => 'application/pdf,application/zip',
    )));

    // ===================================
    // SECCIÓN: Contáctanos
    // ===================================
    $wp_customize->add_section('contactanos_section', array(
        'title'      => __('Contáctanos', 'tema-custom'),
        'priority'   => 90,
        'description' => 'Personaliza la página de Contáctanos'
    ));

    // Título Principal
    $wp_customize->add_setting('contacto_titulo', array(
        'default'   => 'CONTÁCTANOS',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('contacto_titulo_control', array(
        'label'      => __('Título Principal', 'tema-custom'),
        'section'    => 'contactanos_section',
        'settings'   => 'contacto_titulo',
        'type'       => 'text',
    ));

    // Texto 1
    $wp_customize->add_setting('contacto_texto_1', array(
        'default'   => '¿Tienes más ideas para apoyar o preguntas?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('contacto_texto_1_control', array(
        'label'      => __('Texto 1', 'tema-custom'),
        'section'    => 'contactanos_section',
        'settings'   => 'contacto_texto_1',
        'type'       => 'text',
    ));

    // Texto 2
    $wp_customize->add_setting('contacto_texto_2', array(
        'default'   => '¿Eres periodista o necesitas más información?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('contacto_texto_2_control', array(
        'label'      => __('Texto 2', 'tema-custom'),
        'section'    => 'contactanos_section',
        'settings'   => 'contacto_texto_2',
        'type'       => 'text',
    ));

    // Texto 3
    $wp_customize->add_setting('contacto_texto_3', array(
        'default'   => '¡La búsqueda de verdad y justicia es de todos!',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('contacto_texto_3_control', array(
        'label'      => __('Texto 3', 'tema-custom'),
        'section'    => 'contactanos_section',
        'settings'   => 'contacto_texto_3',
        'type'       => 'text',
    ));

    // Texto Inferior (encima del email)
    $wp_customize->add_setting('contacto_texto_inferior', array(
        'default'   => 'También puedes escribirnos directamente a:',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('contacto_texto_inferior_control', array(
        'label'      => __('Texto Inferior (antes del email)', 'tema-custom'),
        'section'    => 'contactanos_section',
        'settings'   => 'contacto_texto_inferior',
        'type'       => 'text',
    ));

    // Email de Contacto
    $wp_customize->add_setting('contacto_email', array(
        'default'   => 'justiciaparalas6402@gmail.com',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_email'
    ));

    $wp_customize->add_control('contacto_email_control', array(
        'label'      => __('Email de Contacto', 'tema-custom'),
        'section'    => 'contactanos_section',
        'settings'   => 'contacto_email',
        'type'       => 'email',
    ));
}
add_action('customize_register', 'justicia_customize_register');

/**
 * Sanitización para URLs de video (YouTube, Instagram, Vimeo)
 */
function sanitize_video_url($input)
{
    if (empty($input)) {
        return '';
    }

    $input = trim($input);

    $allowed_domains = array(
        'youtube.com',
        'youtu.be',
        'youtube-nocookie.com',
        'instagram.com',
        'www.instagram.com',
        'vimeo.com'
    );

    foreach ($allowed_domains as $domain) {
        if (strpos($input, $domain) !== false) {
            return esc_url_raw($input);
        }
    }

    return '';
}

/**
 * ============================================
 * CONTADOR DE FIRMAS - LEER ARCHIVO
 * ============================================
 */

/**
 * Obtener el total de firmas desde el archivo Excel/CSV
 * 
 * @return int Número de firmas actuales
 */
function obtener_total_firmas()
{
    // Obtener el ID del archivo desde el Customizer
    $archivo_id = get_theme_mod('banner_excel_id');

    if (empty($archivo_id)) {
        // Si no hay archivo, retornar 0
        return 0;
    }

    // Intentar obtener desde caché (1 hora)
    $cache_key = 'total_firmas_count_' . $archivo_id;
    $total_firmas = get_transient($cache_key);

    if (false !== $total_firmas) {
        // Retornar valor en caché
        return intval($total_firmas);
    }

    // Obtener la ruta del archivo
    $archivo_path = get_attached_file($archivo_id);

    if (!file_exists($archivo_path)) {
        error_log('❌ Archivo de firmas no encontrado: ' . $archivo_path);
        return 0;
    }

    $total_firmas = 0;
    $extension = strtolower(pathinfo($archivo_path, PATHINFO_EXTENSION));

    try {
        if ($extension === 'csv') {
            // Leer archivo CSV
            $total_firmas = contar_firmas_csv($archivo_path);
        } elseif (in_array($extension, ['xlsx', 'xls'])) {
            // Leer archivo Excel con PhpSpreadsheet
            $total_firmas = contar_firmas_excel($archivo_path);
        } else {
            error_log('❌ Formato de archivo no soportado: ' . $extension);
            return 0;
        }

        // Guardar en caché por 1 hora
        set_transient($cache_key, $total_firmas, HOUR_IN_SECONDS);

        error_log('✅ Firmas contadas: ' . $total_firmas);
    } catch (Exception $e) {
        error_log('❌ Error al leer archivo: ' . $e->getMessage());
        return 0;
    }

    return intval($total_firmas);
}

/**
 * Contar firmas de un archivo CSV
 */
function contar_firmas_csv($archivo_path)
{
    $conteo = 0;

    if (($handle = fopen($archivo_path, 'r')) !== false) {
        while (($data = fgetcsv($handle)) !== false) {
            $conteo++;
        }
        fclose($handle);

        // Restar 1 para excluir la fila del encabezado
        if ($conteo > 0) {
            $conteo = $conteo - 1;
        }
    }

    return $conteo;
}

/**
 * Contar firmas de un archivo Excel (xlsx/xls)
 * Requiere PhpSpreadsheet
 */
function contar_firmas_excel($archivo_path)
{
    // Verificar si PhpSpreadsheet está disponible
    $vendor_path = get_template_directory() . '/vendor/autoload.php';

    if (!file_exists($vendor_path)) {
        error_log('❌ PhpSpreadsheet no instalado. Por favor instalar con: composer require phpoffice/phpspreadsheet');
        return 0;
    }

    require_once $vendor_path;

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_path);
    $sheet = $spreadsheet->getActiveSheet();

    // Contar filas (excluyendo encabezado)
    $total_filas = $sheet->getHighestRow();
    return max(0, $total_filas - 1);
}

/**
 * Obtener datos completos del contador
 * 
 * @return array Datos del contador (actuales, meta, porcentaje, etc.)
 */
function obtener_datos_contador_firmas()
{
    // Obtener meta desde Customizer (con fallback a 6402)
    $meta_firmas = get_theme_mod('banner_meta_firmas', 6402);
    $firmas_actuales = obtener_total_firmas();

    // Calcular porcentaje (máximo 100%)
    $porcentaje = 0;
    if ($meta_firmas > 0) {
        $porcentaje = ($firmas_actuales / $meta_firmas) * 100;
        $porcentaje = min($porcentaje, 100);
    }

    return array(
        'actuales' => $firmas_actuales,
        'meta' => $meta_firmas,
        'porcentaje' => round($porcentaje, 2),
        'faltan' => max(0, $meta_firmas - $firmas_actuales),
    );
}

/**
 * Limpiar caché de firmas manualmente
 * Útil cuando se actualiza el archivo
 */
function limpiar_cache_firmas()
{
    $archivo_id = get_theme_mod('banner_excel_id');
    if ($archivo_id) {
        delete_transient('total_firmas_count_' . $archivo_id);
        error_log('🔄 Caché de firmas limpiado');
    }
}


/**
 * ============================================
 * EXTRAER H1s DEL CONTENIDO DE LA NOTICIA
 * ============================================
 */

/**
 * Extrae los dos primeros H1 del contenido de una entrada
 * 
 * @param int $post_id ID de la entrada
 * @return array Array con ['titulo1' => '', 'titulo2' => '']
 */
function obtener_titulos_noticia($post_id)
{
    $contenido = get_post_field('post_content', $post_id);

    // Extraer todos los H1s del contenido
    preg_match_all('/<h1[^>]*>(.*?)<\/h1>/is', $contenido, $matches);

    $titulos = array(
        'titulo1' => '',
        'titulo2' => ''
    );

    if (!empty($matches[1])) {
        // Limpiar HTML de los títulos y decodificar entidades
        $titulos['titulo1'] = !empty($matches[1][0]) ? wp_strip_all_tags($matches[1][0]) : '';
        $titulos['titulo2'] = !empty($matches[1][1]) ? wp_strip_all_tags($matches[1][1]) : '';
    }

    return $titulos;
}

/**
 * ============================================
 * ESTADÍSTICAS DEL ARCHIVO CSV
 * ============================================
 */

/**
 * Obtener estadísticas completas del archivo CSV
 * SIN CACHÉ - Siempre lee el archivo fresco
 */
function obtener_estadisticas_csv()
{
    // Obtener el ID del archivo desde el Customizer
    $archivo_id = get_theme_mod('banner_excel_id');

    if (empty($archivo_id)) {
        return array(
            'personas' => 0,
            'ciudades' => 0,
            'paises' => 0
        );
    }

    // Obtener la ruta del archivo
    $archivo_path = get_attached_file($archivo_id);

    if (!file_exists($archivo_path)) {
        error_log('❌ Archivo CSV no encontrado en: ' . $archivo_path);
        return array(
            'personas' => 0,
            'ciudades' => 0,
            'paises' => 0
        );
    }

    // Leer directamente sin caché
    try {
        $estadisticas = procesar_estadisticas_csv($archivo_path);
        return $estadisticas;
    } catch (Exception $e) {
        error_log('❌ Error al calcular estadísticas: ' . $e->getMessage());
        return array(
            'personas' => 0,
            'ciudades' => 0,
            'paises' => 0
        );
    }
}

/**
 * Procesar archivo CSV y calcular estadísticas
 * VERSIÓN SIMPLIFICADA Y ROBUSTA
 */
function procesar_estadisticas_csv($archivo_path)
{
    // Leer archivo completo
    $contenido = file_get_contents($archivo_path);

    if ($contenido === false) {
        error_log('❌ No se pudo leer el archivo');
        return array('personas' => 0, 'ciudades' => 0, 'paises' => 0);
    }

    // Detectar y convertir UTF-16 a UTF-8
    $bom = substr($contenido, 0, 2);
    if ($bom === "\xFF\xFE" || $bom === "\xFE\xFF") {
        error_log('🔄 Convirtiendo UTF-16 a UTF-8');
        $contenido = mb_convert_encoding($contenido, 'UTF-8', 'UTF-16LE');
    }

    // Separar en líneas y limpiar
    $lineas = explode("\n", $contenido);
    $lineas = array_filter(array_map('trim', $lineas));

    if (empty($lineas)) {
        return array('personas' => 0, 'ciudades' => 0, 'paises' => 0);
    }

    // Primera línea = encabezado
    $encabezado_raw = array_shift($lineas);

    // Detectar delimitador
    $delimitador = "\t"; // Por defecto TAB
    if (substr_count($encabezado_raw, ',') > substr_count($encabezado_raw, "\t")) {
        $delimitador = ',';
    }

    error_log('🔍 Delimitador detectado: ' . ($delimitador === "\t" ? 'TAB' : 'COMA'));

    // Parsear encabezado
    $encabezado = str_getcsv($encabezado_raw, $delimitador);
    $encabezado = array_map('trim', $encabezado);

    error_log('📋 Columnas encontradas: ' . implode(', ', $encabezado));

    // Buscar índices de columnas
    $indice_ciudad = false;
    $indice_pais = false;

    foreach ($encabezado as $i => $columna) {
        $col_lower = strtolower($columna);

        if (in_array($col_lower, ['ciudad', 'city'])) {
            $indice_ciudad = $i;
            error_log('✅ Columna Ciudad encontrada en índice ' . $i);
        } elseif (in_array($col_lower, ['país', 'pais', 'country', 'pa�s'])) {
            $indice_pais = $i;
            error_log('✅ Columna País encontrada en índice ' . $i);
        }
    }

    // Contadores
    $total_personas = 0;
    $ciudades_unicas = array();
    $paises_unicos = array();

    // Procesar cada línea
    foreach ($lineas as $linea) {
        if (empty($linea)) continue;

        $data = str_getcsv($linea, $delimitador);

        // Contar como persona si la línea tiene datos
        if (!empty($data[0])) {
            $total_personas++;
        }

        // Contar ciudades únicas
        if ($indice_ciudad !== false && isset($data[$indice_ciudad])) {
            $ciudad = trim($data[$indice_ciudad]);
            if (!empty($ciudad) && $ciudad !== '""' && $ciudad !== '"') {
                $ciudades_unicas[$ciudad] = true;
            }
        }

        // Contar países únicos
        if ($indice_pais !== false && isset($data[$indice_pais])) {
            $pais = trim($data[$indice_pais]);
            if (!empty($pais) && $pais !== '""' && $pais !== '"') {
                $paises_unicos[$pais] = true;
            }
        }
    }

    $resultado = array(
        'personas' => $total_personas,
        'ciudades' => count($ciudades_unicas),
        'paises' => count($paises_unicos)
    );

    error_log('📊 RESULTADO FINAL: ' . print_r($resultado, true));
    error_log('📊 Ciudades únicas: ' . implode(', ', array_keys($ciudades_unicas)));
    error_log('📊 Países únicos: ' . implode(', ', array_keys($paises_unicos)));

    return $resultado;
}


/* ============================================
   AJAX: Cargar Más Noticias
   ============================================ */

// Endpoint para usuarios autenticados
add_action('wp_ajax_cargar_mas_noticias', 'ajax_cargar_mas_noticias');

// Endpoint para usuarios NO autenticados
add_action('wp_ajax_nopriv_cargar_mas_noticias', 'ajax_cargar_mas_noticias');

function ajax_cargar_mas_noticias()
{
    // Verificar nonce de seguridad
    check_ajax_referer('cargar_noticias_nonce', 'nonce');

    // Obtener parámetros
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $por_carga = isset($_POST['por_carga']) ? intval($_POST['por_carga']) : 6;
    $contador_inicio = isset($_POST['contador']) ? intval($_POST['contador']) : 1;

    // Query de noticias
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $por_carga,
        'category_name' => 'noticias',
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'offset' => $offset
    );

    $noticias_query = new WP_Query($args);
    $imagen_fallback = get_template_directory_uri() . '/assets/images/img-slider2.png';

    $html_desktop = '';
    $html_mobile = '';
    $counter = $contador_inicio;

    if ($noticias_query->have_posts()) {
        while ($noticias_query->have_posts()) : $noticias_query->the_post();
            $permalink = get_permalink();
            $fecha = get_the_date('d/m/Y');

            // Obtener extracto limpio
            $contenido = get_post_field('post_content', get_the_ID());
            $contenido = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $contenido);
            $contenido = wp_strip_all_tags($contenido);
            $contenido = preg_replace('/\s+/', ' ', $contenido);
            $excerpt = trim($contenido);

            if (strlen($excerpt) > 335) {
                $excerpt = substr($excerpt, 0, 332) . '...';
            }

            $imagen_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            if (!$imagen_url) {
                $imagen_url = $imagen_fallback;
            }

            // HTML Desktop
            $html_desktop .= '
            <div class="flex flex-col justify-center items-center gap-[24px] w-[375px] px-[30px] py-[60px] bg-[#F8F8F8] hover:shadow-xl transition-shadow duration-300">
                <div class="w-full h-[254px] overflow-hidden rounded-md">
                    <img src="' . esc_url($imagen_url) . '"
                        alt="Noticia ' . $counter . '"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="flex flex-col justify-center items-start gap-[16px] w-full text-left">
                    <h3 class="font-[Montserrat] font-bold leading-[100%] text-[42px] text-black">
                        Noticia <span class="text-[#F8A60E]">' . $counter . '</span>
                    </h3>
                    <p class="w-full text-black font-[Montserrat] text-[16px] font-medium leading-[24px]">
                        ' . esc_html($excerpt) . '
                    </p>
                    <p class="text-gray-500 font-[Montserrat] text-[14px] font-medium">
                        ' . esc_html($fecha) . '
                    </p>
                    <a href="' . esc_url($permalink) . '"
                        class="flex w-[315px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-black font-[Montserrat] text-[16px] font-bold hover:bg-[#d89400] transition-colors duration-300">
                        Leer más
                    </a>
                </div>
            </div>';

            // HTML Mobile
            $html_mobile .= '
            <div class="w-full flex flex-col items-center">
                <div class="w-full h-[306px] overflow-hidden">
                    <img src="' . esc_url($imagen_url) . '"
                        alt="Noticia ' . $counter . '"
                        class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col justify-center items-start gap-[24px] w-[90%] max-w-[375px] px-[30px] py-[60px] bg-[#F8F8F8] hover:shadow-xl transition-shadow duration-300 mt-[-60px] rounded-b-md">
                    <h3 class="font-[Montserrat] font-bold leading-[100%] text-[32px] text-black text-left">
                        Noticia <span class="text-[#F8A60E]">' . $counter . '</span>
                    </h3>
                    <p class="text-black font-[Montserrat] text-[16px] font-medium leading-[24px] text-left">
                        ' . esc_html($excerpt) . '
                    </p>
                    <p class="text-gray-500 font-[Montserrat] text-[14px] font-medium text-left">
                        ' . esc_html($fecha) . '
                    </p>
                    <a href="' . esc_url($permalink) . '"
                        class="flex w-full max-w-[315px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-black font-[Montserrat] text-[16px] font-bold hover:bg-[#d89400] transition-colors duration-300">
                        Leer más
                    </a>
                </div>
            </div>';

            $counter++;
        endwhile;
    }

    wp_reset_postdata();

    // Responder con JSON
    wp_send_json_success(array(
        'html_desktop' => $html_desktop,
        'html_mobile' => $html_mobile,
        'nuevo_offset' => $offset + $por_carga,
        'nuevo_contador' => $counter,
        'tiene_mas' => $noticias_query->found_posts > 0
    ));
}

// Agregar nonce a JavaScript
add_action('wp_enqueue_scripts', 'agregar_nonce_noticias');
function agregar_nonce_noticias()
{
    wp_localize_script('custom-js', 'noticiasAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('cargar_noticias_nonce')
    ));
}



/* ============================================
   AJAX: Cargar Más Actividades
   ============================================ */

// Endpoint para usuarios autenticados
add_action('wp_ajax_cargar_mas_actividades', 'ajax_cargar_mas_actividades');

// Endpoint para usuarios NO autenticados
add_action('wp_ajax_nopriv_cargar_mas_actividades', 'ajax_cargar_mas_actividades');

function ajax_cargar_mas_actividades()
{
    // Verificar nonce de seguridad
    check_ajax_referer('cargar_actividades_nonce', 'nonce');

    // Obtener parámetros
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $por_carga = isset($_POST['por_carga']) ? intval($_POST['por_carga']) : 6;
    $contador_inicio = isset($_POST['contador']) ? intval($_POST['contador']) : 1;

    // Query de actividades
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $por_carga,
        'category_name' => 'actividades',
        'orderby' => 'modified',
        'order' => 'DESC',
        'post_status' => 'publish',
        'offset' => $offset
    );

    $actividades_query = new WP_Query($args);
    $imagen_fallback = get_template_directory_uri() . '/assets/images/img-slider2.png';

    $html_desktop = '';
    $html_mobile = '';
    $counter = $contador_inicio;

    if ($actividades_query->have_posts()) {
        while ($actividades_query->have_posts()) : $actividades_query->the_post();
            $permalink = get_permalink();
            $fecha = get_the_date('d/m/Y');

            $imagen_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            if (!$imagen_url) {
                $imagen_url = $imagen_fallback;
            }

            // HTML Desktop
            $html_desktop .= '
            <a href="' . esc_url($permalink) . '"
                class="relative w-full h-[455px] bg-cover bg-center hover:shadow-xl transition-all duration-300 hover:scale-105 overflow-hidden group cursor-pointer"
                style="background-image: url(\'' . esc_url($imagen_url) . '\');">
                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                <div class="relative z-10 p-[24px] flex flex-col justify-start items-start">
                    <div class="backdrop-blur-md rounded-lg p-[16px] inline-block">
                        <h3 class="font-[Montserrat] font-bold leading-[100%] text-[32px] text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                            Actividad ' . $counter . '
                        </h3>
                        <p class="text-white font-[Montserrat] text-[14px] font-medium mt-[8px] drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                            ' . esc_html($fecha) . '
                        </p>
                    </div>
                </div>
            </a>';

            // HTML Mobile
            $html_mobile .= '
            <a href="' . esc_url($permalink) . '"
                class="relative w-full h-[306px] bg-cover bg-center hover:shadow-xl transition-all duration-300 overflow-hidden"
                style="background-image: url(\'' . esc_url($imagen_url) . '\');">
                <div class="relative z-10 p-[24px] flex flex-col justify-start items-start">
                    <div class="backdrop-blur-md rounded-lg p-[16px] inline-block">
                        <h3 class="font-[Montserrat] font-bold leading-[100%] text-[28px] text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                            Actividad ' . $counter . '
                        </h3>
                        <p class="text-white font-[Montserrat] text-[14px] font-medium mt-[8px] drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                            ' . esc_html($fecha) . '
                        </p>
                    </div>
                </div>
            </a>';

            $counter++;
        endwhile;
    }

    wp_reset_postdata();

    // Responder con JSON
    wp_send_json_success(array(
        'html_desktop' => $html_desktop,
        'html_mobile' => $html_mobile,
        'nuevo_offset' => $offset + $por_carga,
        'nuevo_contador' => $counter,
        'tiene_mas' => $actividades_query->found_posts > 0
    ));
}

// Agregar nonce para actividades
add_action('wp_enqueue_scripts', 'agregar_nonce_actividades');
function agregar_nonce_actividades()
{
    wp_localize_script('custom-js', 'actividadesAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('cargar_actividades_nonce')
    ));
}

