<?php

/**
 * Template Name: Conócenos
 * Página: Conócenos
 */

get_header();

// Leer valores del Customizer
$slides_data = array(
    array(
        'imagen_id' => get_theme_mod('banner_hero_slide1_imagen', ''),
        'texto' => get_theme_mod('banner_hero_slide1_texto', 'Texto de banner 1'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_slide2_imagen', ''),
        'texto' => get_theme_mod('banner_hero_slide2_texto', 'Texto de banner 2'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_slide3_imagen', ''),
        'texto' => get_theme_mod('banner_hero_slide3_texto', 'Texto de banner 3'),
    ),
);

$intervalo = get_theme_mod('banner_hero_intervalo', 5);

// Leer valores del Customizer - Video + Texto
$video_embed = get_theme_mod('conocenos_video_embed', '');
$video_texto = get_theme_mod('conocenos_video_texto', 'En noviembre de 2023, se interpuso una querella en Argentina para esclarecer la responsabilidad de Álvaro Uribe Vélez en las ejecuciones extrajudiciales (mal llamados "falsos positivos") durante su mandato. El primer paso es la apertura de la investigación que podría llevar –a largo plazo– a la captura, extradición y condena del investigado si se le encuentra culpable.');

//Sección Por Qué Argentina
$argentina_titulo_parte1 = get_theme_mod('argentina_titulo_parte1', 'POR QUÉ BUSCAR JUSTICIA');
$argentina_titulo_parte2 = get_theme_mod('argentina_titulo_parte2', 'EN ARGENTINA?');
$argentina_texto = get_theme_mod('argentina_texto', '• La demanda se realiza desde el principio de jurisdicción universal, que aplica en todo el mundo.<br>• Bajo la jurisdicción universal, los crímenes de lesa humanidad pueden ser investigados y juzgados en otro país (por ejemplo, Argentina) cuando no hay garantías de justicia suficientes donde fue cometido.');

// --- Sección Por Qué NO en Colombia ---

// 1. Leer valores del Customizer
$colombia_titulo_parte1 = get_theme_mod('colombia_titulo_parte1', '¿POR QUÉ NO');
$colombia_titulo_parte2 = get_theme_mod('colombia_titulo_parte2', 'EN COLOMBIA?');
$colombia_texto = get_theme_mod('colombia_texto', '• La Jurisdicción Especial para la Paz (JEP), no tiene competencia para juzgar a presidentes de la República.<br>• Aunque la Comisión de Acusaciones puede investigar a expresidentes, en más de 60 años ningún alto funcionario ha sido llevado a juicio.<br>• De las dos denuncias que ha recibido la Comisión por ejecuciones extrajudiciales, ninguna ha sido abierta formalmente e inclusive una lleva 10 años en etapa preliminar.');
$colombia_texto_2 = get_theme_mod('colombia_texto_2', '• Las investigaciones son designadas "a dedo" por el presidente de la Comisión de Acusaciones: no hay imparcialidad.<br>• Si bien el expresidente Álvaro Uribe Vélez fue condenado por la justicia ordinaria por otros delitos, ésta no le puede juzgar por crímenes cometidos durante su mandato presidencial.');


// Sección Qué son las Ejecuciones Extrajudiciales
$ejecuciones_titulo_parte1 = get_theme_mod('ejecuciones_titulo_parte1', 'QUÉ SON LA EJECUCIONES EXTRAJUDICIALES O MAL LLAMADAS');
$ejecuciones_titulo_parte2 = get_theme_mod('ejecuciones_titulo_parte2', '"FALSOS POSITIVOS"?');
$ejecuciones_texto_1 = get_theme_mod('ejecuciones_texto_1', '• Personas civiles desarmadas que fueron asesinadas y presentadas por miembros del Ejército como integrantes de grupos al margen de la ley dados en baja en combate.');
$ejecuciones_texto_2 = get_theme_mod('ejecuciones_texto_2', '• Es un crimen de lesa humanidad: fue sistemático y generalizado en todo el país bajo la Política de Seguridad Democrática.');
$ejecuciones_texto_3 = get_theme_mod('ejecuciones_texto_3', '• El gobierno de Uribe Vélez incorporó políticas dirigidas a entregar estímulos y beneficios a militares y civiles por el asesinato de combatientes de grupos guerrilleros, presión por resultados que derivó en asesinato de civiles.');

// Sección Por Qué Se Demanda a Uribe
$por_que_uribe_titulo = get_theme_mod('por_que_uribe_titulo', '¿POR QUÉ SE DEMANDA A URIBE?');
$por_que_uribe_bloque1_texto = get_theme_mod('por_que_uribe_bloque1_texto', 'Promovió políticas que incentivaron las ejecuciones extrajudiciales');
$por_que_uribe_bloque2_texto = get_theme_mod('por_que_uribe_bloque2_texto', 'Como Comandante Supremo de las Fuerzas Militares era responsable de supervisar y controlar');
$por_que_uribe_bloque3_texto = get_theme_mod('por_que_uribe_bloque3_texto', 'Conocía de los crímenes y no hizo nada para detenerlos');
$por_que_uribe_bloque4_texto = get_theme_mod('por_que_uribe_bloque4_texto', 'No investigó ni sancionó a los responsables');


// Sección Quiénes Somos
$quienes_somos_titulo = get_theme_mod('quienes_somos_titulo', 'QUIÉNES SOMOS?');
$quienes_somos_texto = get_theme_mod('quienes_somos_texto', 'La campaña #JusticiaParaLas6402 es una iniciativa liderada por quienes interpusieron la querella en Argentina: las víctimas de ejecuciones extrajudiciales y organizaciones que tienen décadas de experiencia en la defensa de los derechos humanos, como la Corporación Jurídica Libertad (CJL) que trabaja principalmente en Antioquia, el Comité de Solidaridad con los Presos Políticos (CSPP) y el Colectivo de Abogados y Abogadas José Alvear Restrepo (Cajar), en el marco del Espacio de Litigio Estratégico.');
$quienes_somos_boton_texto = get_theme_mod('quienes_somos_boton_texto', 'Descargar documento');
$quienes_somos_pdf = get_theme_mod('quienes_somos_pdf', '');

// Sección Las Víctimas Que Demandan
$victimas_titulo1 = get_theme_mod('victimas_demandan_titulo1', 'LAS VÍCTIMAS');
$victimas_titulo2 = get_theme_mod('victimas_demandan_titulo2', 'QUE DEMANDAN');
$victimas_descripcion = get_theme_mod('victimas_demandan_descripcion', 'La querella fue interpuesta a nombre de 11 víctimas de ejecuciones extrajudiciales. Cuatro de ellas son víctimas identificadas -sus familiares son demandantes reconocidas en el proceso jurídico- y otras siete son víctimas sin identificar. Estas son sus historias:');

// Víctimas
$victimas = array(
    array(
        'imagen_id' => get_theme_mod('victima1_imagen', ''),
        'nombre' => get_theme_mod('victima1_nombre', 'Lorem ipsum consectetur'),
        'descripcion' => get_theme_mod('victima1_descripcion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,')
    ),
    array(
        'imagen_id' => get_theme_mod('victima2_imagen', ''),
        'nombre' => get_theme_mod('victima2_nombre', 'Lorem ipsum consectetur'),
        'descripcion' => get_theme_mod('victima2_descripcion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,')
    )
);

$victimas_boton_texto = get_theme_mod('victimas_boton_texto', 'Descargar las imágenes');
$victimas_boton_pdf = get_theme_mod('victimas_boton_pdf', '');

?>

<!-- Banner Hero Animado - Pasando parámetros del Customizer -->
<?php
get_template_part('template-parts/banner-hero', null, array(
    'slides' => $slides_data,
    'intervalo' => $intervalo
));
?>

<!-- Sección Video + Texto -->
<section class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex flex-col lg:flex-row w-full lg:w-[1153px] lg:h-[324px] justify-center items-center gap-[32px] lg:gap-[52px]">

        <!-- Columna Izquierda (Desktop) / Abajo (Mobile) - Video -->
        <div class="order-2 lg:order-1 w-full lg:w-[555px] lg:self-stretch flex items-center justify-center">
            <?php
            $video_url = get_theme_mod('conocenos_video_embed', '');
            $video_embed = '';
            $is_instagram = false;

            if (!empty($video_url)) {
                $video_url = trim($video_url);

                // YOUTUBE
                if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $matches);

                    if (!empty($matches[1])) {
                        $youtube_id = $matches[1];
                        $video_embed = '<iframe 
            src="https://www.youtube.com/embed/' . esc_attr($youtube_id) . '" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen
            loading="lazy"></iframe>';
                    }
                }
                // INSTAGRAM
                elseif (strpos($video_url, 'instagram.com') !== false) {
                    $is_instagram = true;
                    preg_match('/\/(?:p|reel)\/([a-zA-Z0-9_-]+)/', $video_url, $matches);

                    if (!empty($matches[1])) {
                        $instagram_code = $matches[1];
                        $video_embed = '<div class="instagram-wrapper">
            <iframe 
                src="https://www.instagram.com/p/' . esc_attr($instagram_code) . '/embed/captioned/" 
                frameborder="0" 
                scrolling="no" 
                allowtransparency="true"
                sandbox="allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox allow-top-navigation"
                loading="lazy"
                allow=""></iframe>
        </div>';
                    }
                }
                // VIMEO
                elseif (strpos($video_url, 'vimeo.com') !== false) {
                    preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches);

                    if (!empty($matches[1])) {
                        $vimeo_id = $matches[1];
                        $video_embed = '<iframe 
            src="https://player.vimeo.com/video/' . esc_attr($vimeo_id) . '" 
            frameborder="0" 
            allow="autoplay; fullscreen; picture-in-picture" 
            allowfullscreen
            loading="lazy"></iframe>';
                    }
                }
            }

            if (!empty($video_embed)) :
            ?>
                <!-- Código HTML del video embebido -->
                <div class="conocenos-video-container <?php echo $is_instagram ? 'instagram-container' : 'youtube-container'; ?> w-full rounded-lg overflow-hidden shadow-lg">
                    <?php echo $video_embed; ?>
                </div>
            <?php else : ?>
                <!-- Placeholder si no hay video -->
                <div class="w-full h-[300px] lg:h-full bg-gray-300 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">No hay video configurado</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Columna Derecha (Desktop) / Arriba (Mobile) - Texto -->
        <div class="order-1 lg:order-2 flex flex-col justify-center items-start w-full lg:flex-1 gap-[16px]">
            <p class="text-negro font-[Montserrat] text-[16px] lg:text-[18px] font-medium leading-[24px] text-left"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo wp_kses_post($video_texto); ?>
            </p>
        </div>

    </div>
</section>

<!-- Sección Por Qué Argentina -->
<section id="por_que_argentina" class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex flex-col lg:flex-row w-full lg:w-[1153px] justify-center items-stretch gap-0">

        <div class="order-1 lg:order-2 w-full lg:w-[576px] lg:h-[478px] flex-shrink-0 overflow-hidden hidden lg:block">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/ar1.png"
                alt=""
                class="w-full h-full object-cover lg:scale-120">
        </div>

        <div class="order-2 lg:order-1 flex flex-col items-start gap-[32px] flex-1 bg-[#ECECEC] px-[30px] py-[40px] lg:px-[65px] lg:py-[72px]"
            style="box-shadow: 0 -8px 20px 0 rgba(144, 144, 144, 0.02);">

            <h2 class="hidden lg:block font-lava text-[48px] leading-[115%] text-left"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <span class="block text-negro">
                    <?php echo esc_html($argentina_titulo_parte1); ?>
                </span>
                <span class="block text-[#A13E18]">
                    <?php echo esc_html($argentina_titulo_parte2); ?>
                </span>
            </h2>

            <div class="lg:hidden w-full max-w-[335px]">
                <h2 class="font-lava text-left">
                    <span class="block text-[42px] leading-[100%] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($argentina_titulo_parte1); ?>
                    </span>
                    <span class="block text-[42px] leading-[100%] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($argentina_titulo_parte2); ?>
                    </span>
                </h2>
            </div>

            <div class="lg:hidden w-full h-[254px] self-stretch overflow-hidden">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/ar1.png"
                    alt=""
                    class="w-full h-full object-cover scale-120">
            </div>

            <div class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px] text-left"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo wp_kses_post($argentina_texto); ?>
            </div>

        </div>

    </div>
</section>

<!-- Sección Por Qué NO en Colombia -->
<section id="por_que_no_en_colombia" class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex flex-col w-full lg:w-[1153px] gap-0">

        <!-- PRIMER BLOQUE: Imagen izquierda + Texto derecha -->
        <div class="flex flex-col lg:flex-row w-full justify-center items-stretch gap-0">

            <!-- Columna Izquierda (Desktop) - Imagen -->
            <div class="order-2 lg:order-1 w-full lg:w-[576px] lg:h-[478px] flex-shrink-0 overflow-hidden hidden lg:flex items-center justify-center bg-white">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/co1.png"
                    alt=""
                    class="w-full h-full object-contain"
                    style="transform: scale(1.5); box-shadow: 0 -8px 20px 0 rgba(144, 144, 144, 0.02);">
            </div>

            <!-- Columna Derecha (Desktop) / Arriba (Mobile) - Contenido -->
            <div class="order-1 lg:order-2 flex flex-col items-start gap-[32px] flex-1 bg-white px-[30px] py-[40px] lg:px-[65px] lg:py-[72px]">

                <!-- Título Desktop -->
                <h2 class="hidden lg:block font-lava text-[48px] leading-[115%] text-left">
                    <span class="block text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($colombia_titulo_parte1); ?>
                    </span>
                    <span class="block text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($colombia_titulo_parte2); ?>
                    </span>
                </h2>

                <!-- Título Mobile -->
                <div class="lg:hidden w-full max-w-[335px]">
                    <h2 class="font-lava text-left">
                        <span class="block text-[42px] leading-[100%] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                            <?php echo esc_html($colombia_titulo_parte1); ?>
                        </span>
                        <span class="block text-[42px] leading-[100%] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                            <?php echo esc_html($colombia_titulo_parte2); ?>
                        </span>
                    </h2>
                </div>

                <!-- Texto -->
                <div class="text-negro font-[Montserrat] text-[18px] lg:text-[18px] font-medium leading-[24px] text-left"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo wp_kses_post($colombia_texto); ?>
                </div>

                <!-- Imagen Mobile (después del texto) -->
                <div class="lg:hidden w-full h-[254px] self-stretch overflow-hidden">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/co1.png"
                        alt=""
                        class="w-full h-full object-contain scale-120">
                </div>

            </div>
        </div>

        <!-- SEGUNDO BLOQUE: Texto izquierda + Imagen derecha -->
        <div class="flex flex-col lg:flex-row w-full justify-center items-stretch gap-0">

            <!-- Columna Izquierda (Desktop) - Contenido -->
            <div class="order-1 lg:order-1 flex flex-col items-start gap-[32px] flex-1 bg-white px-[30px] py-[40px] lg:px-[65px] lg:py-[72px]">

                <!-- Texto -->
                <div class="text-negro font-[Montserrat] text-[18 px] lg:text-[18px] font-medium leading-[24px] text-left"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo wp_kses_post($colombia_texto_2); ?>
                </div>

                <!-- Imagen Mobile (después del texto) -->
                <div class="lg:hidden w-full h-[254px] self-stretch overflow-hidden">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/co2.png"
                        alt=""
                        class="w-full h-full object-contain scale-120">
                </div>

            </div>

            <!-- Columna Derecha (Desktop) - Imagen -->
            <div class="order-2 lg:order-2 w-full lg:w-[576px] lg:h-[478px] flex-shrink-0 overflow-hidden hidden lg:flex items-center justify-center bg-white">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/co2.png"
                    alt=""
                    class="w-full h-full object-contain"
                    style="transform: scale(1.3); box-shadow: 0 -8px 20px 0 rgba(144, 144, 144, 0.02);">
            </div>

        </div>

    </div>
</section>

<!-- Sección Qué son las Ejecuciones Extrajudiciales -->
<section id="ejecucuciones_extrajudiciales" class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-0 overflow-hidden">
    <div class="relative w-full h-auto lg:h-[375px] flex items-center justify-center"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/bg-paper-cono.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">

        <!-- Contenedor Principal -->
        <div class="flex flex-col lg:flex-row items-center justify-between w-full h-full px-[30px] lg:px-[60px] py-[40px] lg:py-0 gap-[32px] lg:gap-[40px]">

            <!-- Imagen Megáfono (Solo Desktop) -->
            <div class="hidden lg:flex w-[223px] h-[223px] flex-shrink-0 items-center justify-center -mt-[130px]">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/mega.png"
                    alt="Megáfono"
                    class="w-full h-full object-contain">
            </div>

            <!-- Contenido Central: Título + 3 Columnas -->
            <div class="flex flex-col items-center lg:items-start flex-1 gap-[24px] lg:gap-[32px]">

                <!-- Título -->
                <h2 class="font-lava text-left lg:text-center text-white text-[24px] lg:text-[48px] leading-tight uppercase">
                    <?php echo esc_html($ejecuciones_titulo_parte1); ?>
                    <span class="text-[#EAA40C] block lg:inline">
                        <?php echo esc_html($ejecuciones_titulo_parte2); ?>
                    </span>
                </h2>

                <!-- Tres Columnas de Texto -->
                <div class="flex flex-col lg:flex-row gap-[24px] lg:gap-[32px] w-full">
                    <!-- Columna 1 -->
                    <div class="flex-1 text-white font-[Montserrat] text-[16px] font-medium leading-[22px] lg:leading-[24px] text-left"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo wp_kses_post($ejecuciones_texto_1); ?>
                    </div>

                    <!-- Columna 2 -->
                    <div class="flex-1 text-white font-[Montserrat] text-[16px] font-medium leading-[22px] lg:leading-[24px] text-left"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo wp_kses_post($ejecuciones_texto_2); ?>
                    </div>

                    <!-- Columna 3 -->
                    <div class="flex-1 text-white font-[Montserrat] text-[16px] font-medium leading-[22px] lg:leading-[24px] text-left"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo wp_kses_post($ejecuciones_texto_3); ?>
                    </div>
                </div>

            </div>

            <!-- Imagen Signo de Interrogación (Solo Desktop) -->
            <div class="hidden lg:flex w-[223px] h-[223px] flex-shrink-0 items-center justify-center mt-[90px]">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/img-slider2.png"
                    alt="Signo de interrogación"
                    class="w-full h-full object-contain">
            </div>


        </div>

    </div>
</section>

<!-- Sección Por Qué Se Demanda a Uribe -->
<section id="por_que_se_demanda_uribe" class="mt-[60px] lg:mt-[120px] bg-white flex flex-col items-center lg:px-0">

    <!-- Título -->
    <h2
        class="font-lava text-[28px] sm:text-[32px] lg:text-[48px] uppercase 
         text-left mb-[30px] lg:mb-[60px] w-full max-w-[1152px] px-[20px] lg:px-20px">
        <span class="text-negro block lg:inline">
            <?php echo esc_html(explode('A URIBE', $por_que_uribe_titulo)[0]); ?>
        </span>
        <span class="text-[#A13E18] block lg:inline">A URIBE?</span>
    </h2>
    <!-- DESKTOP: Grid 2x2 SIN GAP -->
    <div class="hidden lg:grid lg:grid-cols-2 lg:gap-0 w-[1152px] h-[1152px]">

        <!-- Bloque 1 -->
        <div class="w-[576px] h-[576px] bg-cover bg-center flex items-center justify-center p-[40px]"
            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu1.png'); background-size: cover;">
            <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                <p class="text-negro font-[Montserrat] text-[24px] font-bold leading-[32px] text-center">
                    <?php echo wp_kses_post($por_que_uribe_bloque1_texto); ?>
                </p>
            </div>
        </div>

        <!-- Bloque 2 -->
        <div class="w-[576px] h-[576px] bg-cover bg-center flex items-center justify-center p-[40px]"
            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu2.png'); background-size: cover;">
            <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                <p class="text-white font-[Montserrat] text-[24px] font-bold leading-[32px] text-center">
                    <?php echo wp_kses_post($por_que_uribe_bloque2_texto); ?>
                </p>
            </div>
        </div>

        <!-- Bloque 3 -->
        <div class="w-[576px] h-[576px] bg-cover bg-center flex items-center justify-center p-[40px]"
            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu3.png'); background-size: cover;">
            <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                <p class="text-white font-[Montserrat] text-[24px] font-bold leading-[32px] text-center">
                    <?php echo wp_kses_post($por_que_uribe_bloque3_texto); ?>
                </p>
            </div>
        </div>

        <!-- Bloque 4 -->
        <div class="w-[576px] h-[576px] bg-cover bg-center flex items-center justify-center p-[40px]"
            style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu4.png'); background-size: cover;">
            <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                <p class="text-negro font-[Montserrat] text-[24px] font-bold leading-[32px] text-center">
                    <?php echo wp_kses_post($por_que_uribe_bloque4_texto); ?>
                </p>
            </div>
        </div>

    </div>

    <!-- MOBILE: Carrusel -->
    <div class="lg:hidden w-full relative overflow-hidden" id="por-que-uribe-slider-wrapper">
        <div class="flex transition-transform duration-500 ease-in-out" id="por-que-uribe-slider-container">

            <!-- Slide 1 -->
            <div class="por-que-uribe-slide w-full flex-shrink-0">
                <div class="relative w-full h-[375px] overflow-hidden bg-cover bg-center flex items-center justify-center p-[30px]"
                    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu1.png');">
                    <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                        <p class="text-negro font-[Montserrat] text-[20px] font-bold leading-[28px] text-center z-10">
                            <?php echo wp_kses_post($por_que_uribe_bloque1_texto); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="por-que-uribe-slide w-full flex-shrink-0">
                <div class="relative w-full h-[375px] overflow-hidden bg-cover bg-center flex items-center justify-center p-[30px]"
                    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu2.png');">
                    <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                        <p class="text-white font-[Montserrat] text-[20px] font-bold leading-[28px] text-center z-10">
                            <?php echo wp_kses_post($por_que_uribe_bloque2_texto); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="por-que-uribe-slide w-full flex-shrink-0">
                <div class="relative w-full h-[375px] overflow-hidden bg-cover bg-center flex items-center justify-center p-[30px]"
                    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu3.png');">
                    <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                        <p class="text-white font-[Montserrat] text-[20px] font-bold leading-[28px] text-center z-10">
                            <?php echo wp_kses_post($por_que_uribe_bloque3_texto); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="por-que-uribe-slide w-full flex-shrink-0">
                <div class="relative w-full h-[375px] overflow-hidden bg-cover bg-center flex items-center justify-center p-[30px]"
                    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pu4.png');">
                    <div class="backdrop-blur-sm bg-black/20 rounded-lg p-[20px]">
                        <p class="text-negro font-[Montserrat] text-[20px] font-bold leading-[28px] text-center z-10">
                            <?php echo wp_kses_post($por_que_uribe_bloque4_texto); ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Indicadores (Dots) -->
        <div class="flex justify-center items-center gap-2 mt-[20px]" id="por-que-uribe-slider-dots"></div>
    </div>

</section>

<!-- Sección Quiénes Somos -->
<section id="quienes_somos" class="mt-[60px] lg:mt-[120px] bg-white flex flex-col items-center px-[30px] lg:px-0">

    <!-- TÍTULO MOBILE -->
    <h2 class="block font-lava text-[32px] leading-[100%] text-center uppercase mb-[30px] lg:hidden">
        <span class="text-negro">QUIÉNES </span>
        <span class="text-[#A13E18]">SOMOS?</span>
    </h2>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="flex flex-col lg:flex-row w-full max-w-[1267px] items-center lg:items-start justify-center relative">

        <!-- COLUMNA IZQUIERDA (IMAGEN) -->
        <div class="order-2 lg:order-1 w-full lg:w-[634px] flex justify-center lg:justify-end relative z-[1]">
            <img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/mqe.png"
                alt="Quiénes Somos"
                class="w-full max-w-[480px] lg:max-w-[634px] h-auto lg:h-[590px] object-contain lg:object-cover lg:translate-y-[-25px] shadow-[0_-8px_20px_rgba(144,144,144,0.02)] hover:scale-105 transition-transform duration-300"
                style="object-position: center;" />
        </div>

        <!-- COLUMNA DERECHA (CUADRO GRIS) -->
        <div class="order-3 lg:order-2 flex flex-col w-full lg:w-[633px] bg-[#ECECEC] p-[30px] lg:p-[72px] items-start gap-[24px] flex-shrink-0 shadow-[0_4px_20px_rgba(0,0,0,0.05)] z-[2] lg:-ml-[130px] mt-[-30px] lg:mt-[0px]">

            <!-- TÍTULO DESKTOP -->
            <h2 class="hidden lg:block font-lava text-[48px] leading-[115%] text-left uppercase">
                <span class="text-negro">QUIÉNES </span>
                <span class="text-[#A13E18]">SOMOS?</span>
            </h2>

            <!-- TEXTO -->
            <p class="text-black font-[Montserrat] text-[18px] font-medium leading-[24px] text-center lg:text-left">
                <?php echo wp_kses_post($quienes_somos_texto); ?>
            </p>

            <!-- BOTÓN DE DESCARGA -->
            <?php if (!empty($quienes_somos_pdf)) : ?>
                <a href="<?php echo esc_url($quienes_somos_pdf); ?>"
                    download
                    class="flex w-full lg:w-[240px] h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold hover:bg-[#8a3315] transition-colors duration-300 self-center lg:self-start">
                    <?php echo esc_html($quienes_somos_boton_texto); ?>
                </a>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Sección Las Víctimas Que Demandan -->
<section id="victimas_demandan_que" class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex flex-col items-center w-full max-w-[1153px] gap-[24px]">

        <!-- Título -->
        <h2 class="font-lava text-[32px] lg:text-[48px] text-center uppercase leading-tight">
            <span class="text-negro"><?php echo esc_html($victimas_titulo1); ?> </span>
            <span class="text-[#A13E18]"><?php echo esc_html($victimas_titulo2); ?></span>
        </h2>

        <!-- Descripción con borde azul -->
        <div class="w-full max-w-[860px] h-auto bg-white">
            <p class="text-negro font-[Montserrat] text-[18px] font-normal leading-[24px] text-left">
                <?php echo wp_kses_post($victimas_descripcion); ?>
            </p>
        </div>

        <!-- Desktop: 2 Cards -->
        <div class="hidden lg:flex gap-[32px] w-full justify-center">
            <?php foreach ($victimas as $victima) :
                $imagen_url = $victima['imagen_id'] ? wp_get_attachment_image_url($victima['imagen_id'], 'thumbnail') : '';
                $descripcion_truncada = strlen($victima['descripcion']) > 98
                    ? substr($victima['descripcion'], 0, 95) . '...'
                    : $victima['descripcion'];
            ?>
                <!-- Card Víctima Desktop -->
                <div class="flex flex-col w-[371px] h-auto p-[32px] bg-[#F5F5F5] rounded-lg gap-[16px]">
                    <div class="flex items-center gap-[16px]">
                        <?php if ($imagen_url) : ?>
                            <div class="w-[54px] h-[54px] rounded-full overflow-hidden bg-gray-300 flex-shrink-0">
                                <img src="<?php echo esc_url($imagen_url); ?>"
                                    alt="<?php echo esc_attr($victima['nombre']); ?>"
                                    class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>

                        <h3 class="text-black font-[Montserrat] text-[24px] font-bold leading-[24px] w-[288px]"
                            style="font-feature-settings: 'liga' off, 'clig' off;">
                            <?php echo esc_html($victima['nombre']); ?>
                        </h3>
                    </div>

                    <p class="text-black font-[Montserrat] text-[18px] font-normal leading-[24px]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($descripcion_truncada); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Mobile: Carrusel (AJUSTADO para no romper el flujo) -->
        <div class="lg:hidden w-full flex flex-col items-center">
            <div class="relative w-full overflow-hidden mt-[10px]" id="victimas-slider-wrapper">
                <div class="flex transition-transform duration-500 ease-in-out" id="victimas-slider-container">
                    <?php foreach ($victimas as $victima) :
                        $imagen_url = $victima['imagen_id'] ? wp_get_attachment_image_url($victima['imagen_id'], 'thumbnail') : '';
                        $descripcion_truncada = strlen($victima['descripcion']) > 98
                            ? substr($victima['descripcion'], 0, 95) . '...'
                            : $victima['descripcion'];
                    ?>
                        <!-- Slide -->
                        <div class="victimas-slide w-full flex-shrink-0 px-[10px] flex justify-center">
                            <div class="flex flex-col w-full max-w-[350px] h-auto p-[24px] items-start gap-[16px] bg-[#F5F5F5] rounded-lg shadow-sm">
                                <div class="flex items-center gap-[16px]">
                                    <?php if ($imagen_url) : ?>
                                        <div class="w-[54px] h-[54px] rounded-full overflow-hidden bg-gray-300 flex-shrink-0">
                                            <img src="<?php echo esc_url($imagen_url); ?>"
                                                alt="<?php echo esc_attr($victima['nombre']); ?>"
                                                class="w-full h-full object-cover">
                                        </div>
                                    <?php endif; ?>

                                    <h3 class="text-black font-[Montserrat] text-[20px] font-bold leading-[24px]"
                                        style="font-feature-settings: 'liga' off, 'clig' off;">
                                        <?php echo esc_html($victima['nombre']); ?>
                                    </h3>
                                </div>

                                <p class="text-black font-[Montserrat] text-[16px] font-normal leading-[22px]"
                                    style="font-feature-settings: 'liga' off, 'clig' off;">
                                    <?php echo esc_html($descripcion_truncada); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Dots -->
                <div class="flex justify-center items-center gap-2 mt-[20px]" id="victimas-slider-dots"></div>
            </div>
        </div>

        <!-- Botón -->
        <?php if (!empty($victimas_boton_pdf)) : ?>
            <a href="<?php echo esc_url($victimas_boton_pdf); ?>"
                download
                class="flex w-full lg:w-auto px-[36px] py-[12px] justify-center items-center gap-[10px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] text-[14px] lg:text-[16px] font-bold hover:bg-[#8a3315] transition-colors duration-300 mt-[10px]">
                <?php echo esc_html($victimas_boton_texto); ?>
            </a>
        <?php endif; ?>

    </div>
</section>

<!-- Hero Banner Desktop -->
<div class="hidden lg:block w-full">
    <?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => false]); ?>
</div>

<!-- Hero Banner Mobile -->
<div class="block lg:hidden w-full mt-[60px]">
    <?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => true]); ?>
</div>





<?php
$GLOBALS['footer_margin_top_mobile'] = '0px';
$GLOBALS['footer_margin_top_desktop'] = '100px';
get_footer();
?>