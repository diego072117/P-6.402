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

    // Si tienes custom.css, asegúrate de cargarlo DESPUÉS de Tailwind
    // wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css', ['tailwind-css'], '1.0');

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
    $wp_customize->add_section( 'historias_victimas_section' , array(
        'title'      => __( 'Historias de las Víctimas', 'tema-custom' ),
        'priority'   => 45,
        'description' => 'Configura las 3 historias destacadas con sus PDFs individuales'
    ) );

    // -----------------------------------
    // HISTORIA 1
    // -----------------------------------
    $wp_customize->add_setting( 'historia1_nombre', array(
        'default'   => 'María López Pérez',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'historia1_nombre_control', array(
        'label'      => __( 'Historia 1 - Nombre', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_nombre',
        'type'       => 'text',
    ) );

    $wp_customize->add_setting( 'historia1_descripcion', array(
        'default'   => 'Madre de Juan López, víctima de ejecución extrajudicial en 2008. Busca justicia desde hace 15 años.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ) );
    $wp_customize->add_control( 'historia1_descripcion_control', array(
        'label'      => __( 'Historia 1 - Descripción', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_descripcion',
        'type'       => 'textarea',
    ) );

    $wp_customize->add_setting( 'historia1_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'historia1_imagen_control', array(
        'label'      => __( 'Historia 1 - Imagen', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_imagen',
        'mime_type'  => 'image',
        'description' => 'Imagen circular de la víctima',
    ) ) );

    $wp_customize->add_setting( 'historia1_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'historia1_pdf_control', array(
        'label'      => __( 'Historia 1 - PDF', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia1_pdf',
        'mime_type'  => 'application/pdf',
        'description' => 'PDF de esta historia específica',
    ) ) );

    // -----------------------------------
    // HISTORIA 2
    // -----------------------------------
    $wp_customize->add_setting( 'historia2_nombre', array(
        'default'   => 'José Martínez García',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'historia2_nombre_control', array(
        'label'      => __( 'Historia 2 - Nombre', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_nombre',
        'type'       => 'text',
    ) );

    $wp_customize->add_setting( 'historia2_descripcion', array(
        'default'   => 'Padre que busca verdad y justicia después de 15 años. Su hijo fue presentado como falso positivo.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ) );
    $wp_customize->add_control( 'historia2_descripcion_control', array(
        'label'      => __( 'Historia 2 - Descripción', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_descripcion',
        'type'       => 'textarea',
    ) );

    $wp_customize->add_setting( 'historia2_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'historia2_imagen_control', array(
        'label'      => __( 'Historia 2 - Imagen', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_imagen',
        'mime_type'  => 'image',
        'description' => 'Imagen circular de la víctima',
    ) ) );

    $wp_customize->add_setting( 'historia2_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'historia2_pdf_control', array(
        'label'      => __( 'Historia 2 - PDF', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia2_pdf',
        'mime_type'  => 'application/pdf',
        'description' => 'PDF de esta historia específica',
    ) ) );

    // -----------------------------------
    // HISTORIA 3
    // -----------------------------------
    $wp_customize->add_setting( 'historia3_nombre', array(
        'default'   => 'Ana García Rodríguez',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'historia3_nombre_control', array(
        'label'      => __( 'Historia 3 - Nombre', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_nombre',
        'type'       => 'text',
    ) );

    $wp_customize->add_setting( 'historia3_descripcion', array(
        'default'   => 'Madre de víctima que no se rinde en su búsqueda de justicia. Busca esclarecer la verdad.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ) );
    $wp_customize->add_control( 'historia3_descripcion_control', array(
        'label'      => __( 'Historia 3 - Descripción', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_descripcion',
        'type'       => 'textarea',
    ) );

    $wp_customize->add_setting( 'historia3_imagen', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'historia3_imagen_control', array(
        'label'      => __( 'Historia 3 - Imagen', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_imagen',
        'mime_type'  => 'image',
        'description' => 'Imagen circular de la víctima',
    ) ) );

    $wp_customize->add_setting( 'historia3_pdf', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'historia3_pdf_control', array(
        'label'      => __( 'Historia 3 - PDF', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historia3_pdf',
        'mime_type'  => 'application/pdf',
        'description' => 'PDF de esta historia específica',
    ) ) );

    // -----------------------------------
    // URL de la sección en Conócenos
    // -----------------------------------
    $wp_customize->add_setting( 'historias_url_seccion', array(
        'default'   => '/conocenos#historias-victimas',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ) );
    $wp_customize->add_control( 'historias_url_seccion_control', array(
        'label'      => __( 'URL "Lee más historias" (Sección en Conócenos)', 'tema-custom' ),
        'section'    => 'historias_victimas_section',
        'settings'   => 'historias_url_seccion',
        'type'       => 'url',
        'description' => 'Enlace del botón "Lee más historias"',
    ) );
}
add_action('customize_register', 'justicia_customize_register');

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
function obtener_estadisticas_csv() {
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
function procesar_estadisticas_csv($archivo_path) {
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