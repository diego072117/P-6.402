<?php

/**
 * Obtener datos del Customizer
 */
$banner_descripcion = get_theme_mod('banner_descripcion', 'Buscamos justicia para las 6.402 personas asesinadas y presentadas como falsas muertes en combate por el Ejército de Colombia.');
$banner_titulo_parte1 = get_theme_mod('banner_titulo_parte1', '¡Si nos unimos,');
$banner_titulo_parte2 = get_theme_mod('banner_titulo_parte2', 'todxs conoceremos la verdad!');
$banner_texto_boton = get_theme_mod('banner_texto_boton', 'Apoya con tu firma');
$banner_url_boton = get_theme_mod('banner_url_boton', 'https://www.change.org/');

/**
 * Obtener datos del contador
 */
$datos_contador = obtener_datos_contador_firmas();

/**
 * Obtener datos del Customizer para "Conoce Más"
 */
$conoce_titulo_parte1 = get_theme_mod('conoce_titulo_parte1', 'CONOCE MÁS');
$conoce_titulo_parte2 = get_theme_mod('conoce_titulo_parte2', 'SOBRE NOSOTROS');
$conoce_descripcion = get_theme_mod('conoce_descripcion', 'Cansadas de esperar a la justicia colombiana, víctimas y organizaciones de derechos humanos acudieron a la justicia universal en Argentina. En noviembre de 2023, se interpuso una querella (denuncia) para esclarecer la responsabilidad de Uribe Vélez en las ejecuciones extrajudiciales (mal llamados "falsos positivos") durante su mandato. Sin embargo, no ha habido avances significativos ni apertura formal de la investigación.');
$conoce_url_boton = get_theme_mod('conoce_url_boton', '#conocenos');

/**
 * Query para obtener las 3 noticias más recientes
 */
$args_noticias = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'category_name'  => 'noticias', // Slug de la categoría
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$query_noticias = new WP_Query($args_noticias);

/**
 * Obtener datos del Customizer para "Qué puedo hacer?"
 */
$que_hacer_titulo_p1 = get_theme_mod('que_hacer_titulo_parte1', 'QUÉ PUEDO');
$que_hacer_titulo_p2 = get_theme_mod('que_hacer_titulo_parte2', 'HACER?');
$que_hacer_subtitulo = get_theme_mod('que_hacer_subtitulo', 'Lucha por la verdad y justicia de todxs');
$que_hacer_descripcion = get_theme_mod('que_hacer_descripcion', 'Contamos con apoyo de:');
$que_hacer_url_boton = get_theme_mod('que_hacer_url_boton', '#que-puedo-hacer');

/**
 * Obtener estadísticas del CSV
 */
$estadisticas = obtener_estadisticas_csv();


/**
 * Obtener datos del Customizer para Historias
 */
$historias = array(
    array(
        'nombre' => get_theme_mod('historia1_nombre', 'María López Pérez'),
        'descripcion' => get_theme_mod('historia1_descripcion', 'Madre de Juan López, víctima de ejecución extrajudicial.'),
        'imagen_id' => get_theme_mod('historia1_imagen', ''),
        'pdf_id' => get_theme_mod('historia1_pdf', ''),
    ),
    array(
        'nombre' => get_theme_mod('historia2_nombre', 'José Martínez García'),
        'descripcion' => get_theme_mod('historia2_descripcion', 'Padre que busca verdad y justicia.'),
        'imagen_id' => get_theme_mod('historia2_imagen', ''),
        'pdf_id' => get_theme_mod('historia2_pdf', ''),
    ),
    array(
        'nombre' => get_theme_mod('historia3_nombre', 'Ana García Rodríguez'),
        'descripcion' => get_theme_mod('historia3_descripcion', 'Madre que no se rinde en su búsqueda.'),
        'imagen_id' => get_theme_mod('historia3_imagen', ''),
        'pdf_id' => get_theme_mod('historia3_pdf', ''),
    ),
);

$historias_url_seccion = get_theme_mod('historias_url_seccion', '/conocenos#historias-victimas');

// Función auxiliar para formatear números (200000 -> 200k)
function formatear_numero($numero)
{
    if ($numero >= 1000000) {
        return round($numero / 1000000, 1) . 'M';
    } elseif ($numero >= 1000) {
        return round($numero / 1000, 1) . 'k';
    }
    return $numero;
}

get_header();
?>

<!-- Hero Banner Principal -->
<section class="min-h-[550px] md:h-[400px] lg:h-[550px] flex-shrink-0 bg-center bg-cover bg-no-repeat py-12 lg:py-0"
    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image1.png');">

    <div class="container mx-auto px-[30px] sm:px-[60px] md:px-[90px] lg:px-[60px] xl:px-[120px] h-full">
        <div class="flex flex-col lg:flex-row items-center justify-center lg:justify-start h-full gap-6 lg:gap-[20px] xl:gap-[24px]">

            <!-- Columna Izquierda - Texto -->
            <div class="flex flex-col justify-center items-center lg:items-start w-full lg:w-[450px] xl:w-[532px] max-w-[315px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-none flex-shrink-0 gap-6 lg:gap-[28px] xl:gap-[33.44px]">

                <!-- Descripción DINÁMICA -->
                <p class="self-stretch:text-left text-black font-sans text-[16px] md:text-[17px] lg:text-[16px] xl:text-[18px] not-italic font-medium leading-[24px]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($banner_descripcion); ?>
                </p>

                <!-- Título principal DINÁMICO -->
                <h1 class="self-stretch lg:text-left font-sans text-[28px] md:text-[34px] lg:text-[32px] xl:text-[40px] not-italic font-bold leading-[36px] md:leading-[44px] lg:leading-[44px] xl:leading-[52px]">
                    <span class="text-[#A13E18]"><?php echo esc_html($banner_titulo_parte1); ?></span>
                    <span class="text-black"> <?php echo esc_html($banner_titulo_parte2); ?></span>
                </h1>
            </div>

            <!-- Columna Derecha - Contador -->
            <div class="flex flex-col w-full lg:w-[500px] xl:w-[605.237px] max-w-[315px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-none gap-4 lg:gap-0">

                <!-- Card con contador DINÁMICO -->
                <div class="flex w-full h-[144.19px] md:h-[200px] lg:h-[240px] xl:h-[266.877px] p-[16px] md:p-[24px] lg:p-[24px] xl:p-[29.614px] flex-col justify-center items-center gap-[16px] md:gap-[20px] lg:gap-[24px] xl:gap-[29.614px] flex-shrink-0
                            rounded-[18.509px] border-[1.851px] border-[#D1D9E2]
                            backdrop-blur-[2px] shadow-sm"
                    style="background: rgba(150, 150, 150, 0.3); background-blend-mode: multiply;">

                    <!-- Ya somos [DINÁMICO] -->
                    <div class="flex flex-row gap-[8px] md:gap-[12px] lg:gap-[12px] xl:gap-[15px] self-stretch">
                        <span class="text-black font-sans text-[19.45px] md:text-[28px] lg:text-[30px] xl:text-[36px] not-italic font-medium"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Ya somos
                        </span>
                        <span class="text-black font-sans text-[34.57px] md:text-[50px] lg:text-[54px] xl:text-[64px] not-italic font-bold"
                            style="line-height: 12.967px;">
                            <?php echo esc_html(number_format($datos_contador['actuales'], 0, ',', '.')); ?>
                        </span>
                    </div>

                    <!-- Barra de progreso DINÁMICA -->
                    <div class="relative flex items-center self-stretch h-[8px] md:h-[12px] lg:h-[12px] xl:h-[14.807px] rounded-[9.254px] bg-[#D1D9E2]">
                        <!-- Línea de progreso -->
                        <div class="absolute left-0 h-[8px] md:h-[12px] lg:h-[12px] xl:h-[14.807px] bg-[#A13E18] transition-all duration-1000 ease-out"
                            style="width: <?php echo esc_attr($datos_contador['porcentaje']); ?>%; border-radius: 9.254px 0 0 9.254px;"></div>

                        <!-- Punto de control -->
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/ControlPoint.svg"
                            alt="Control Point"
                            class="absolute w-[20px] md:w-[30px] lg:w-[32px] xl:w-[37.02px] h-[20px] md:h-[30px] lg:h-[32px] xl:h-[37.02px] z-10 transition-all duration-1000 ease-out"
                            style="left: <?php echo esc_attr($datos_contador['porcentaje']); ?>%; transform: translateX(-50%);" />
                    </div>

                    <!-- Ayúdanos a llegar a [META DINÁMICA] -->
                    <div class="flex flex-row items-center justify-center gap-[8px] md:gap-[20px] lg:gap-[24px] xl:gap-[30px] self-stretch text-center">
                        <span class="text-black font-sans text-[9.725px] md:text-[14px] lg:text-[15px] xl:text-[18px] not-italic font-medium whitespace-nowrap"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Ayúdanos a llegar a
                        </span>
                        <span class="text-black font-sans text-[21px] md:text-[30px] lg:text-[34px] xl:text-[40px] not-italic font-bold"
                            style="line-height: 12.967px;">
                            <?php echo esc_html(number_format($datos_contador['meta'], 0, ',', '.')); ?>
                        </span>
                        <span class="text-black font-sans text-[9.725px] md:text-[14px] lg:text-[15px] xl:text-[18px] not-italic font-medium whitespace-nowrap"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Antes de noviembre
                        </span>
                    </div>

                    <!-- Botón "Apoyar" - SOLO DESKTOP (DINÁMICO) -->
                    <div class="hidden lg:flex self-stretch">
                        <a href="<?php echo esc_url($banner_url_boton); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="bg-[#9B3B0A] text-white font-bold px-8 py-3 rounded-md hover:bg-[#7d2f08] transition mt-2">
                            <?php echo esc_html($banner_texto_boton); ?>
                        </a>
                    </div>
                </div>

                <!-- Botón "Apoya con tu firma" - SOLO MOBILE (DINÁMICO) -->
                <a href="<?php echo esc_url($banner_url_boton); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="lg:hidden w-full bg-[#A13E18] text-white font-bold text-[16px] px-8 py-4 rounded-[6px] hover:bg-[#7d2f08] transition text-center">
                    <?php echo esc_html($banner_texto_boton); ?>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Sección Conoce Más -->
<section class="flex flex-col lg:flex-row mt-[60px] lg:mt-[180px] items-center justify-center lg:gap-[50px] overflow-visible px-[30px] lg:px-0">

    <!-- Título Mobile DINÁMICO -->
    <div class="lg:hidden w-full max-w-[287px] sm:max-w-[287px] md:max-w-[500px] mb-8">
        <h2 class="leading-[40px] font-display font-bold tracking-tight uppercase text-left">
            <span class="block text-[48px] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($conoce_titulo_parte1); ?>
            </span>
            <span class="block text-[48px] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($conoce_titulo_parte2); ?>
            </span>
        </h2>
    </div>

    <!-- Columna Izquierda - Imagen -->
    <div class="w-full sm:w-full sm:max-w-none md:max-w-[500px] lg:max-w-[620px] h-[306px] sm:h-[450px] md:h-[550px] lg:h-[650px] flex-shrink-0 lg:-mr-[150px] flex items-center justify-center mb-[-23px] lg:mb-0 self-stretch overflow-hidden">
        <img
            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/bg-image2-nw.png"
            alt="<?php echo esc_attr($conoce_titulo_parte1 . ' ' . $conoce_titulo_parte2); ?>"
            class="w-full h-full object-contain scale-120 sm:scale-100 lg:scale-120"
            style="box-shadow: 0 -8px 20px 0 rgba(144, 144, 144, 0.02);">
    </div>

    <!-- Columna Derecha - Contenido -->
    <div
        class="relative z-20 flex w-full sm:max-w-[400px] md:max-w-[500px] lg:max-w-none lg:w-[633px] lg:h-[574px] p-[32px] sm:p-[40px] md:p-[56px] lg:p-[72px] flex-col items-start gap-[24px] flex-shrink-0"
        style="
            background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/bg-image3.png');
            background-position: right bottom;
            background-size: 200% 100%;
            background-repeat: no-repeat;
        ">

        <!-- Título principal (solo visible en desktop) DINÁMICO -->
        <h2 class="hidden lg:block leading-[55.2px] font-display font-bold tracking-tight uppercase">
            <span class="block text-[48px] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($conoce_titulo_parte1); ?>
            </span>
            <span class="block text-[48px] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($conoce_titulo_parte2); ?>
            </span>
        </h2>

        <!-- Descripción DINÁMICA -->
        <p
            class="self-stretch text-black font-[Montserrat] text-[16px] sm:text-[18px] not-italic font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($conoce_descripcion); ?>
        </p>

        <!-- Botón (solo visible en desktop) DINÁMICO -->
        <a href="<?php echo esc_url($conoce_url_boton); ?>"
            class="hidden lg:flex justify-center items-center gap-[10px] w-[170px] px-[32px] py-[16px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold text-[16px] leading-[20px] hover:bg-[#7d2f08] transition mt-[12px]">
            Conoce más
        </a>
    </div>

    <!-- Botón externo (solo visible en mobile y tablet) DINÁMICO -->
    <div class="flex lg:hidden justify-center mt-[24px] w-full">
        <a href="<?php echo esc_url($conoce_url_boton); ?>"
            class="flex justify-center items-center gap-[10px] w-full max-w-[400px] sm:max-w-[450px] h-[56px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold text-[16px] leading-[20px] hover:bg-[#7d2f08] transition px-[32px]">
            Conoce más
        </a>
    </div>

</section>

<!-- Sección Slider - Qué está pasando (Noticias) -->
<section class="mt-[60px] lg:mt-[180px] bg-white">

    <?php if ($query_noticias->have_posts()) : ?>

        <!-- Contenedor general -->
        <div class="relative flex justify-center items-center w-full max-w-[1151px] mx-auto">

            <!-- Flecha Izquierda -->
            <button
                id="arrow-left"
                class="hidden lg:flex absolute left-[-80px] top-1/2 -translate-y-1/2 z-10 w-[68px] h-[68px] items-center justify-center transition drop-shadow-md"
                aria-label="Anterior">
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon-left.svg"
                    alt="Flecha izquierda"
                    class="w-[68px] h-[68px]" />
            </button>

            <!-- Wrapper del slider -->
            <div id="slider-wrapper" class="overflow-hidden w-full px-0 md:px-6">
                <!-- Contenedor de slides -->
                <div id="slider-container" class="flex justify-start gap-0 md:gap-6 transition-transform duration-500 ease-in-out">

                    <?php
                    $slide_count = 0;
                    while ($query_noticias->have_posts()) : $query_noticias->the_post();
                        $slide_count++;

                        // Obtener datos de la noticia
                        $noticia_url = get_permalink();
                        $noticia_extracto = get_the_excerpt();
                        $noticia_imagen = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        $noticia_fecha = get_the_date('d M Y');

                        // IMPORTANTE: Extraer los dos H1s del contenido
                        $titulos = obtener_titulos_noticia(get_the_ID());

                        // Si no hay imagen destacada, usar placeholder
                        if (!$noticia_imagen) {
                            $noticia_imagen = get_template_directory_uri() . '/assets/images/placeholder-noticia.png';
                        }
                    ?>

                        <!-- Card Noticia <?php echo $slide_count; ?> -->
                        <div
                            id="slide-<?php echo $slide_count; ?>"
                            class="slide flex min-w-full md:min-w-[375px] w-full md:w-[375px] flex-col justify-start items-center gap-6 flex-shrink-0 bg-[#F8F8F8] rounded-[6px] shadow-sm p-[60px_30px]">

                            <!-- Imagen (clickeable) -->
                            <a href="<?php echo esc_url($noticia_url); ?>" class="block w-full h-[254px] self-stretch">
                                <img
                                    src="<?php echo esc_url($noticia_imagen); ?>"
                                    alt="<?php echo esc_attr($titulos['titulo1'] . ' ' . $titulos['titulo2']); ?>"
                                    class="w-full h-full object-cover rounded-md" />
                            </a>

                            <!-- Títulos extraídos del contenido (clickeables) -->
                            <h3 class="self-stretch text-left leading-[48px] font-display font-bold tracking-tight uppercase">
                                <a href="<?php echo esc_url($noticia_url); ?>" class="hover:opacity-80 transition-opacity">
                                    <?php if (!empty($titulos['titulo1'])) : ?>
                                        <span class="block text-[48px] text-[#000000]">
                                            <?php echo esc_html($titulos['titulo1']); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if (!empty($titulos['titulo2'])) : ?>
                                        <span class="block text-[48px] text-[#EAA40C]">
                                            <?php echo esc_html($titulos['titulo2']); ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </h3>

                            <!-- Extracto de la noticia -->
                            <p class="self-stretch text-[#000000] text-[16px] font-[500] leading-[24px] font-[Montserrat] text-left">
                                <?php echo esc_html($noticia_extracto); ?>
                            </p>

                            <!-- Fecha de publicación -->
                            <div class="self-stretch flex justify-start">
                                <span class="text-[#666] text-[14px] font-[Montserrat] italic">
                                    <?php echo esc_html($noticia_fecha); ?>
                                </span>
                            </div>

                            <!-- Botón "Leer más" -->
                            <a href="<?php echo esc_url($noticia_url); ?>"
                                class="flex w-full md:w-[315px] justify-center items-center gap-[10px] px-[32px] py-[12px] rounded-[5px] bg-[#EAA40C] text-black font-bold transition hover:bg-[#d28f00]">
                                Leer más
                            </a>
                        </div>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                </div>
            </div>

            <!-- Flecha Derecha -->
            <button
                id="arrow-right"
                class="hidden lg:flex absolute right-[-80px] top-1/2 -translate-y-1/2 z-10 w-[68px] h-[68px] items-center justify-center transition drop-shadow-md"
                aria-label="Siguiente">
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon-right.svg"
                    alt="Flecha derecha"
                    class="w-[68px] h-[68px]" />
            </button>

        </div>

        <!-- Indicadores (solo mobile) -->
        <div id="slider-dots" class="flex justify-center items-center gap-2 mt-6 md:hidden"></div>

        <!-- Botón "Más noticias" -->
        <div class="flex justify-center w-full mt-8">
            <?php
            // Obtener URL de la categoría Noticias
            $categoria_noticias = get_category_by_slug('noticias');
            $url_mas_noticias = $categoria_noticias ? get_category_link($categoria_noticias->term_id) : '#';
            ?>
            <a href="<?php echo esc_url($url_mas_noticias); ?>"
                class="flex w-full max-w-[315px] lg:w-auto px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Más noticias
            </a>
        </div>

    <?php else : ?>

        <!-- Mensaje si no hay noticias -->
        <div class="flex justify-center items-center py-12">
            <p class="text-[#666] text-[18px] font-[Montserrat]">
                No hay noticias disponibles en este momento.
            </p>
        </div>

    <?php endif; ?>

</section>

<!-- Sección Qué puedo hacer -->
<section class="mt-[60px] lg:mt-[180px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full lg:w-[1151px] flex-col items-center lg:items-start">

        <!-- Bloque superior: título + subtítulo + texto DINÁMICO -->
        <div class="flex flex-col items-center lg:items-start gap-[24px] w-full">

            <!-- Título DINÁMICO -->
            <h2 class="flex flex-col lg:flex-row leading-[48px] font-display font-bold tracking-tight uppercase w-full text-left">
                <span
                    class="text-[36px] lg:text-[48px] text-[#000000] lg:mr-[8px]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; font-weight: 700; line-height: 100%;">
                    <?php echo esc_html($que_hacer_titulo_p1); ?>
                </span>
                <span
                    class="text-[36px] lg:text-[48px] text-[#A13E18]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; font-weight: 700; line-height: 100%;">
                    <?php echo esc_html($que_hacer_titulo_p2); ?>
                </span>
            </h2>

            <!-- Subtítulo DINÁMICO -->
            <h3
                class="text-negro font-[Montserrat] text-[18px] lg:text-[20px] font-bold leading-[24px] text-left w-full"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($que_hacer_subtitulo); ?>
            </h3>

            <!-- Texto apoyo DINÁMICO -->
            <p
                class="text-negro font-[Montserrat] text-[14px] lg:text-[16px] font-medium leading-[24px] text-left w-full"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($que_hacer_descripcion); ?>
            </p>
        </div>

        <!-- Bloque inferior: estadísticas y botón DINÁMICO -->
        <div class="flex flex-col items-center w-full mt-[32px]">

            <!-- Estadísticas DINÁMICAS desde CSV -->
            <div class="flex flex-col lg:flex-row justify-center lg:justify-between items-center w-full max-w-[375px] lg:max-w-[1000px] gap-[40px] lg:gap-0">

                <!-- Personas (desde CSV) -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html(formatear_numero($estadisticas['personas'])); ?>
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Personas
                    </span>
                </div>

                <!-- Ciudades (desde CSV) + Botón en desktop -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($estadisticas['ciudades']); ?>
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Ciudades
                    </span>
                </div>

                <!-- Países (desde CSV) -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($estadisticas['paises']); ?>
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Países
                    </span>
                </div>
            </div>

            <!-- Botón SOLO en desktop, debajo de Ciudades -->
            <a href="<?php echo esc_url($que_hacer_url_boton); ?>"
                class="hidden lg:flex mt-[32px] w-[221px] h-[48px] justify-center items-center rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Conoce cómo apoyar
            </a>

            <!-- Botón SOLO en mobile, centrado abajo -->
            <a href="<?php echo esc_url($que_hacer_url_boton); ?>"
                class="lg:hidden mt-[40px] flex w-full max-w-[375px] h-[48px] justify-center items-center rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Conoce cómo apoyar
            </a>
        </div>

    </div>
</section>

<!-- Sección Historias de las víctimas -->
<section class="mt-[60px] lg:mt-[180px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full lg:w-[1153px] flex-col items-start gap-8">

        <!-- Título -->
        <h2 class="leading-[40px] lg:leading-[48px] font-display font-bold tracking-tight uppercase text-left w-full">
            <span class="block lg:inline text-[36px] lg:text-[48px] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">HISTORIAS DE </span>
            <span class="block lg:inline text-[36px] lg:text-[48px] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">LAS VÍCTIMAS</span>
        </h2>

        <!-- Wrapper del carrusel (mobile) / Grid (desktop) -->
        <div class="w-full">

            <!-- Mobile: Carrusel -->
            <div id="historias-slider-wrapper" class="overflow-hidden w-full lg:hidden">
                <div id="historias-slider-container" class="flex gap-0 transition-transform duration-500 ease-in-out">

                    <?php foreach ($historias as $historia) :
                        $imagen_url = $historia['imagen_id'] ? wp_get_attachment_image_url($historia['imagen_id'], 'thumbnail') : '';
                        $pdf_url = $historia['pdf_id'] ? wp_get_attachment_url($historia['pdf_id']) : '#';
                    ?>

                        <!-- Card Historia Mobile -->
                        <div class="historias-slide flex min-w-full w-full flex-col justify-between items-start bg-[#F5F5F5] rounded-lg p-[32px] h-[455px]">
                            <div class="flex flex-col items-start gap-[24px] self-stretch">

                                <!-- Imagen circular -->
                                <?php if ($imagen_url) : ?>
                                    <div class="w-[54px] h-[54px] rounded-full overflow-hidden bg-gray-300">
                                        <img src="<?php echo esc_url($imagen_url); ?>"
                                            alt="<?php echo esc_attr($historia['nombre']); ?>"
                                            class="w-full h-full object-cover">
                                    </div>
                                <?php else : ?>
                                    <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                                <?php endif; ?>

                                <!-- Nombre -->
                                <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                                    <?php echo esc_html($historia['nombre']); ?>
                                </h3>

                                <!-- Descripción -->
                                <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                                    <?php echo esc_html($historia['descripcion']); ?>
                                </p>
                            </div>

                            <!-- Botón Ver historia (Descarga PDF individual) -->
                            <a href="<?php echo esc_url($pdf_url); ?>"
                                download
                                class="flex w-full h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                                Ver historia
                            </a>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Desktop: Grid de 3 cards -->
            <div class="hidden lg:flex gap-6 w-full">

                <?php foreach ($historias as $historia) :
                    $imagen_url = $historia['imagen_id'] ? wp_get_attachment_image_url($historia['imagen_id'], 'thumbnail') : '';
                    $pdf_url = $historia['pdf_id'] ? wp_get_attachment_url($historia['pdf_id']) : '#';
                ?>

                    <!-- Card Historia Desktop -->
                    <div class="flex w-[352px] h-[455px] p-[32px] flex-col justify-between items-start bg-[#F5F5F5] rounded-lg">
                        <div class="flex flex-col items-start gap-[24px] self-stretch">

                            <!-- Imagen circular -->
                            <?php if ($imagen_url) : ?>
                                <div class="w-[54px] h-[54px] rounded-full overflow-hidden bg-gray-300">
                                    <img src="<?php echo esc_url($imagen_url); ?>"
                                        alt="<?php echo esc_attr($historia['nombre']); ?>"
                                        class="w-full h-full object-cover">
                                </div>
                            <?php else : ?>
                                <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                            <?php endif; ?>

                            <!-- Nombre -->
                            <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                                <?php echo esc_html($historia['nombre']); ?>
                            </h3>

                            <!-- Descripción -->
                            <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                                <?php echo esc_html($historia['descripcion']); ?>
                            </p>
                        </div>

                        <!-- Botón Leer historia (Descarga PDF individual) -->
                        <a href="<?php echo esc_url($pdf_url); ?>"
                            download
                            class="flex w-[288px] h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                            Leer historia
                        </a>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>

        <!-- Indicadores (solo mobile) -->
        <div id="historias-slider-dots" class="flex justify-center items-center gap-2 w-full lg:hidden"></div>

        <!-- Botón "Lee más historias" (Va a la sección en Conócenos) -->
        <div class="flex justify-center w-full">
            <a href="<?php echo esc_url($historias_url_seccion); ?>"
                class="flex w-full lg:w-auto px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Lee más historias
            </a>
        </div>

    </div>
</section>

<?php get_footer(); ?>