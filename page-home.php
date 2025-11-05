<?php


/**
 * Obtener datos del Customizer para "Conoce Más"
 */
$conoce_titulo_parte1 = get_theme_mod('conoce_titulo_parte1', 'CONOCE MÁS');
$conoce_titulo_parte2 = get_theme_mod('conoce_titulo_parte2', 'SOBRE NOSOTROS');
$conoce_descripcion = get_theme_mod('conoce_descripcion', 'Cansadas de esperar a la justicia colombiana, víctimas y organizaciones de derechos humanos acudieron a la justicia universal en Argentina. En noviembre de 2023, se interpuso una querella (denuncia) para esclarecer la responsabilidad de Uribe Vélez en las ejecuciones extrajudiciales (mal llamados "falsos positivos") durante su mandato. Sin embargo, no ha habido avances significativos ni apertura formal de la investigación.');
$conoce_url_boton = get_theme_mod('conoce_url_boton', '#conocenos');

/**
 * Obtener extracto limpio (sin H1s)
 */
function obtener_extracto_limpio($post_id)
{
    $contenido = get_post_field('post_content', $post_id);

    // Remover todos los H1s del contenido
    $contenido = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $contenido);

    // Limpiar HTML y obtener texto plano
    $contenido = wp_strip_all_tags($contenido);

    // Limpiar espacios múltiples
    $contenido = preg_replace('/\s+/', ' ', $contenido);
    $contenido = trim($contenido);

    return $contenido;
}

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

get_header();
?>

<!-- Hero Banner Principal -->
<?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => true]); ?>

<!-- Sección Conoce Más -->
<section class="flex flex-col lg:flex-row mt-[60px] lg:mt-[180px] items-center justify-center lg:gap-[50px] overflow-visible px-[30px] lg:px-0">

    <!-- Título Mobile DINÁMICO -->
    <div class="lg:hidden w-full max-w-[287px] sm:max-w-[287px] md:max-w-[500px] mb-8">
        <h2 class="leading-[40px] font-lava tracking-tight uppercase text-left">
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
        <h2 class="hidden lg:block leading-[55.2px] font-lava tracking-tight uppercase">
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
<?php
get_template_part('template-parts/noticias-slider', null, array(
    'categoria' => 'noticias',
    'numero_posts' => 6,
    'orderby' => 'modified',
    'texto_boton' => 'Más noticias',
    'url_boton' => home_url('/noticias'),
    'texto_vacio' => 'No hay noticias disponibles en este momento.'
));
?>

<!-- Sección Qué puedo hacer -->
<?php get_template_part('template-parts/que-puedo-hacer'); ?>

<!-- Sección Historias de las víctimas -->
<section class="mt-[60px] lg:mt-[180px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full lg:w-[1153px] flex-col items-start gap-8">

        <!-- Título -->
        <h2 class="leading-[40px] lg:leading-[48px] font-lava tracking-tight uppercase text-left w-full">
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