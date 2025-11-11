<?php

/**
 * Template Name: Qué puedo hacer
 * Página: Qué puedo hacer
 */

get_header();

// Leer valores del Customizer para Banner Hero
$slides_data = array(
    array(
        'imagen_id' => get_theme_mod('banner_hero_que_puedo_hacer_slide1_imagen', ''),
        'texto' => get_theme_mod('banner_hero_que_puedo_hacer_slide1_texto', 'Únete a la causa por la justicia'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_que_puedo_hacer_slide2_imagen', ''),
        'texto' => get_theme_mod('banner_hero_que_puedo_hacer_slide2_texto', 'Tu apoyo hace la diferencia'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_que_puedo_hacer_slide3_imagen', ''),
        'texto' => get_theme_mod('banner_hero_que_puedo_hacer_slide3_texto', 'Participa activamente en la búsqueda de verdad'),
    ),
);

$intervalo = get_theme_mod('banner_hero_que_puedo_hacer_intervalo', 5);

// Leer valores del Customizer para Sección "Si tod@s nos unimos"
$si_todos_titulo_parte1 = get_theme_mod('si_todos_titulo_parte1', '¡Si tod-s nos unimos,');
$si_todos_titulo_parte2 = get_theme_mod('si_todos_titulo_parte2', 'tod-s conoceremos la verdad!');
$si_todos_parrafo1 = get_theme_mod('si_todos_parrafo1', 'Bajo la política de la "seguridad democrática" miles de personas fueron ejecutadas extrajudicialmente y presentadas como baja en combate (mal llamados falsos positivos) por el Ejército colombiano.');
$si_todos_parrafo2 = get_theme_mod('si_todos_parrafo2', 'Las familias de miles de víctimas de estas ejecuciones extrajudiciales esperan respuesta de la querella interpuesta en 2023 en Argentina. Sin embargo, en año y medio, no ha habido avances significativos ni apertura formal de la investigación contra el expresidente Uribe Vélez.');

// Leer valores del Customizer para Sección "Firma esta petición"
$firma_peticion_titulo = get_theme_mod('firma_peticion_titulo', 'Firma esta petición');
$firma_peticion_texto1 = get_theme_mod('firma_peticion_texto1', 'Las víctimas exigen el avance de las investigaciones y tú puedes apoyar firmando la petición de Change');
$firma_peticion_texto2 = get_theme_mod('firma_peticion_texto2', 'Buscamos conseguir al menos 6402 firmas antes de noviembre para llevarlas ante la justicia Argentina.');
$firma_peticion_instrucciones = get_theme_mod('firma_peticion_instrucciones', '1. Abre el enlace en el botón.<br>2. Escribe tu nombre, apellido y un correo válido.<br>3. Comparte con tus amigxs que también quieren verdad y justicia.');
$firma_peticion_recordatorio = get_theme_mod('firma_peticion_recordatorio', 'Recuerda: No necesitas documento de identificación y puedes desmarcar la opción para que tu firma no sea visible públicamente.');
$firma_peticion_boton_texto = get_theme_mod('firma_peticion_boton_texto', 'Firmar petición');
$firma_peticion_boton_url = get_theme_mod('firma_peticion_boton_url', 'https://www.change.org/');

// Obtener datos del contador de firmas
$datos_contador = obtener_datos_contador_firmas();


// Leer valores del Customizer para Sección "Comparte"
$comparte_titulo = get_theme_mod('comparte_titulo', 'COMPARTE');
$comparte_texto_descripcion = get_theme_mod('comparte_texto_descripcion', 'Dale espacio a la verdad y la justicia en tus redes sociales');
$comparte_texto_secundario = get_theme_mod('comparte_texto_secundario', 'Tu familia, amigos, colegas también pueden apoyar para que conozcamos la verdad y se haga justicia.');
$comparte_imagen_izquierda_id = get_theme_mod('comparte_imagen_izquierda', '');
$comparte_imagen_izquierda_url = $comparte_imagen_izquierda_id ? wp_get_attachment_image_url($comparte_imagen_izquierda_id, 'large') : '';
$comparte_instrucciones = get_theme_mod('comparte_instrucciones', '1. Comparte en tus historias o por mensaje directo en tus redes sociales.<br>2. Sigue el hashtag y comparte las publicaciones en tus historias.<br>3. Participa de los eventos en tu ciudad.');

// Leer valores del Customizer para "Préstale tu ventana"
$prestale_ventana_titulo = get_theme_mod('prestale_ventana_titulo', 'PRÉSTALE TU VENTANA A LA VERDAD Y LA JUSTICIA');
$prestale_ventana_subtitulo = get_theme_mod('prestale_ventana_subtitulo', 'Descarga y comparte');

// Card 1
$prestale_card1_imagen_id = get_theme_mod('prestale_card1_imagen', '');
$prestale_card1_imagen_url = $prestale_card1_imagen_id ? wp_get_attachment_image_url($prestale_card1_imagen_id, 'large') : '';
$prestale_card1_texto = get_theme_mod('prestale_card1_texto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis...');
$prestale_card1_boton_texto = get_theme_mod('prestale_card1_boton_texto', 'Descarga el afiche');
$prestale_card1_archivo_id = get_theme_mod('prestale_card1_archivo', '');
$prestale_card1_archivo_url = $prestale_card1_archivo_id ? wp_get_attachment_url($prestale_card1_archivo_id) : '#';

// Card 2
$prestale_card2_imagen_id = get_theme_mod('prestale_card2_imagen', '');
$prestale_card2_imagen_url = $prestale_card2_imagen_id ? wp_get_attachment_image_url($prestale_card2_imagen_id, 'large') : '';
$prestale_card2_texto = get_theme_mod('prestale_card2_texto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis...');
$prestale_card2_boton_texto = get_theme_mod('prestale_card2_boton_texto', 'Descarga la infografía');
$prestale_card2_archivo_id = get_theme_mod('prestale_card2_archivo', '');
$prestale_card2_archivo_url = $prestale_card2_archivo_id ? wp_get_attachment_url($prestale_card2_archivo_id) : '#';

// Leer valores del Customizer para Sección "Apoya"
$apoya_titulo = get_theme_mod('apoya_titulo', 'APOYA');

// Card 1
$apoya_card1_imagen_id = get_theme_mod('apoya_card1_imagen', '');
$apoya_card1_imagen_url = $apoya_card1_imagen_id ? wp_get_attachment_image_url($apoya_card1_imagen_id, 'large') : '';
$apoya_card1_titulo = get_theme_mod('apoya_card1_titulo', '¿Eres una organización de la sociedad civil?');
$apoya_card1_texto = get_theme_mod('apoya_card1_texto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.');
$apoya_card1_boton_texto = get_theme_mod('apoya_card1_boton_texto', 'Descarga kit de incidencia');
$apoya_card1_archivo_id = get_theme_mod('apoya_card1_archivo', '');
$apoya_card1_archivo_url = $apoya_card1_archivo_id ? wp_get_attachment_url($apoya_card1_archivo_id) : '#';

// Card 2
$apoya_card2_imagen_id = get_theme_mod('apoya_card2_imagen', '');
$apoya_card2_imagen_url = $apoya_card2_imagen_id ? wp_get_attachment_image_url($apoya_card2_imagen_id, 'large') : '';
$apoya_card2_titulo = get_theme_mod('apoya_card2_titulo', '¿Eres una organización internacional?');
$apoya_card2_texto = get_theme_mod('apoya_card2_texto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.');
$apoya_card2_boton_texto = get_theme_mod('apoya_card2_boton_texto', 'Descarga kit de apoyo internacional');
$apoya_card2_archivo_id = get_theme_mod('apoya_card2_archivo', '');
$apoya_card2_archivo_url = $apoya_card2_archivo_id ? wp_get_attachment_url($apoya_card2_archivo_id) : '#';

// Leer valores del Customizer para Sección "En Redes"
$redes_titulo = get_theme_mod('redes_titulo', 'EN REDES');
$redes_texto = get_theme_mod('redes_texto', 'Sigue la conversación y comparte tus mensajes en redes sociales con el hashtag');
$redes_hashtag = get_theme_mod('redes_hashtag', '#JusticiaParaLas6402');
$redes_facebook_texto = get_theme_mod('redes_facebook_texto', 'Facebook');
$redes_facebook_url = get_theme_mod('redes_facebook_url', 'https://www.facebook.com/');
$redes_instagram_texto = get_theme_mod('redes_instagram_texto', 'Instagram');
$redes_instagram_url = get_theme_mod('redes_instagram_url', 'https://www.instagram.com/');
$redes_twitter_texto = get_theme_mod('redes_twitter_texto', 'X (Twitter)');
$redes_twitter_url = get_theme_mod('redes_twitter_url', 'https://twitter.com/');

?>

<!-- Banner Hero Animado - Qué Puedo Hacer -->
<?php
get_template_part('template-parts/banner-hero', null, array(
    'slides' => $slides_data,
    'intervalo' => $intervalo
));
?>

<!-- Sección ¡Si tod@s nos unimos, tod@s conoceremos la verdad! -->
<section class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex flex-col items-start gap-[32px] w-full max-w-[1152px]">

        <!-- Título -->
        <h2 class="font-lava text-left leading-[115%]">
            <span class="text-[32px] lg:text-[48px] text-negro">
                <?php echo esc_html($si_todos_titulo_parte1); ?>
            </span>
            <span class="text-[32px] lg:text-[48px] text-[#A13E18]">
                <?php echo esc_html($si_todos_titulo_parte2); ?>
            </span>
        </h2>

        <!-- Primer párrafo -->
        <p class="self-stretch text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($si_todos_parrafo1); ?>
        </p>

        <!-- Segundo párrafo -->
        <p class="self-stretch text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($si_todos_parrafo2); ?>
        </p>

        <!-- Botón -->
        <a href="<?php echo esc_url(home_url('/conocenos')); ?>"
            class="flex px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold hover:bg-[#8a3315] transition-colors duration-300">
            Conócenos
        </a>

    </div>
</section>

<!-- Sección Firma esta petición -->
<section id="firma" class="mt-[60px] lg:mt-[120px] bg-[#F8F8F8] lg:bg-white flex justify-center px-[30px] lg:px-0 py-[40px] lg:py-0">
    <div class="inline-flex flex-col items-center gap-[24px] w-full max-w-[788px]">

        <!-- Título Principal -->
        <h2 class="self-stretch text-[#A13E18] text-center font-[Montserrat] text-[48px] lg:text-[64px] font-bold leading-[120%]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo esc_html($firma_peticion_titulo); ?>
        </h2>

        <!-- Texto 1 -->
        <p class="self-stretch text-negro text-left font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($firma_peticion_texto1); ?>
        </p>

        <!-- Texto 2 -->
        <p class="self-stretch text-negro text-left font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($firma_peticion_texto2); ?>
        </p>

        <!-- Instrucciones -->
        <div class="self-stretch text-negro font-[Montserrat] text-[18px] font-medium leading-[24px] text-left"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($firma_peticion_instrucciones); ?>
        </div>

        <!-- Recordatorio -->
        <p class="self-stretch text-negro text-left font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($firma_peticion_recordatorio); ?>
        </p>

        <!-- Número de Firmas Verificadas -->
        <div class="flex flex-col items-center gap-[8px] self-stretch">
            <span class="text-negro text-center font-[Montserrat] text-[48px] lg:text-[64px] font-bold leading-[120%]"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html(number_format($datos_contador['actuales'], 0, ',', '.')); ?>
            </span>
            <span class="text-negro text-center font-[Montserrat] text-[24px] font-bold leading-[120%]"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                Firmas verificadas
            </span>
        </div>

        <!-- Botón Firmar Petición -->
        <a href="<?php echo esc_url($firma_peticion_boton_url); ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="flex h-[56px] px-[32px] py-[12px] justify-center items-center gap-[10px] self-stretch rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] text-[16px] font-bold hover:bg-[#d28f00] transition-colors duration-300">
            <?php echo esc_html($firma_peticion_boton_texto); ?>
        </a>

    </div>
</section>

<!-- Sección Qué puedo hacer -->
<?php get_template_part('template-parts/que-puedo-hacer'); ?>


<!-- Sección Comparte -->
<section id="comparte" class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full max-w-[1152px] flex-col gap-[40px]">

        <!-- Título Principal -->
        <h2 class="text-[#A13E18] font-lava text-[48px] leading-[115%] text-left"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo esc_html($comparte_titulo); ?>
        </h2>

        <!-- Texto Descriptivo -->
        <p class="self-stretch text-negro text-left font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($comparte_texto_descripcion); ?>
        </p>

        <!-- Texto Secundario -->
        <p class="self-stretch text-negro text-left font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo wp_kses_post($comparte_texto_secundario); ?>
        </p>

        <!-- Bloque: Imagen izquierda + Columna derecha -->
        <div class="flex flex-col lg:flex-row w-full gap-[24px] lg:gap-0">

            <!-- Columna Izquierda: Imagen -->
            <div class="w-full lg:w-[576px] h-[264px] flex-shrink-0">
                <?php if ($comparte_imagen_izquierda_url) : ?>
                    <img src="<?php echo esc_url($comparte_imagen_izquierda_url); ?>"
                        alt="<?php echo esc_attr($comparte_titulo); ?>"
                        class="w-full h-full object-cover">
                <?php else : ?>
                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">Imagen no disponible</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Columna Derecha: Instrucciones -->
            <div class="flex flex-1 p-[32px] lg:p-[72px_65px] flex-col items-end gap-[32px] bg-[#ECECEC] ">
                <div class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px] text-left w-full"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo wp_kses_post($comparte_instrucciones); ?>
                </div>
            </div>

        </div>

        <!-- Subsección: Préstale tu ventana -->
        <div class="flex pt-[30px] flex-col items-center gap-[24px] w-full">
            <div class="bg-[#F8F8F8] px-[30px] py-[40px] flex flex-col items-center gap-[24px]">

                <!-- Título "Préstale tu ventana..." -->
                <h3 class="w-full text-[#A13E18] text-center font-lava text-[48px] leading-[115%]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($prestale_ventana_titulo); ?>
                </h3>

                <!-- Subtítulo "Descarga y comparte" -->
                <p class="text-negro text-center font-[Montserrat] text-[24px] font-bold leading-[115%]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($prestale_ventana_subtitulo); ?>
                </p>

                <!-- Cards: Afiche e Infografía -->
                <div class="flex flex-col lg:flex-row w-full max-w-[1152px] gap-[24px] justify-center items-stretch">

                    <!-- Card 1 -->
                    <div class="flex w-full lg:w-[375px] p-[30px] lg:p-[60px_30px] flex-col justify-center items-center gap-[24px] rounded-lg">

                        <!-- Imagen Card 1 -->
                        <?php if ($prestale_card1_imagen_url) : ?>
                            <img src="<?php echo esc_url($prestale_card1_imagen_url); ?>"
                                alt="Card 1"
                                class="h-[254px] w-full object-cover rounded-lg">
                        <?php else : ?>
                            <div class="h-[254px] w-full bg-gray-300 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500">Sin imagen</span>
                            </div>
                        <?php endif; ?>

                        <!-- Texto Card 1 -->
                        <p class="text-negro text-left font-[Montserrat] text-[16px] font-medium leading-[24px]"
                            style="font-feature-settings: 'liga' off, 'clig' off;">
                            <?php
                            $texto_card1 = wp_kses_post($prestale_card1_texto);
                            $limite = 150; // Límite de caracteres
                            if (strlen($texto_card1) > $limite) {
                                echo substr($texto_card1, 0, $limite) . '...';
                            } else {
                                echo $texto_card1;
                            }
                            ?>
                        </p>

                        <!-- Botón Descargar Card 1 -->
                        <a href="<?php echo esc_url($prestale_card1_archivo_url); ?>"
                            download
                            class="flex w-full h-[56px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] text-[16px] font-bold hover:bg-[#d28f00] transition-colors duration-300">
                            <?php echo esc_html($prestale_card1_boton_texto); ?>
                        </a>
                    </div>

                    <!-- Card 2 -->
                    <div class="flex w-full lg:w-[375px] p-[30px] lg:p-[60px_30px] flex-col justify-center items-center gap-[24px] rounded-lg">

                        <!-- Imagen Card 2 -->
                        <?php if ($prestale_card2_imagen_url) : ?>
                            <img src="<?php echo esc_url($prestale_card2_imagen_url); ?>"
                                alt="Card 2"
                                class="h-[254px] w-full object-cover rounded-lg">
                        <?php else : ?>
                            <div class="h-[254px] w-full bg-gray-300 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500">Sin imagen</span>
                            </div>
                        <?php endif; ?>

                        <!-- Texto Card 2 -->
                        <p class="text-negro text-left font-[Montserrat] text-[16px] font-medium leading-[24px]"
                            style="font-feature-settings: 'liga' off, 'clig' off;">
                            <?php
                            $texto_card2 = wp_kses_post($prestale_card2_texto);
                            $limite = 150; // Límite de caracteres
                            if (strlen($texto_card2) > $limite) {
                                echo substr($texto_card2, 0, $limite) . '...';
                            } else {
                                echo $texto_card2;
                            }
                            ?>
                        </p>

                        <!-- Botón Descargar Card 2 -->
                        <a href="<?php echo esc_url($prestale_card2_archivo_url); ?>"
                            download
                            class="flex w-full h-[56px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] text-[16px] font-bold hover:bg-[#d28f00] transition-colors duration-300">
                            <?php echo esc_html($prestale_card2_boton_texto); ?>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<!-- Sección Apoya -->
<section id="apoya" class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full max-w-[1152px] flex-col items-start gap-[32px]">

        <!-- Título Principal -->
        <h2 class="h-[48px] self-stretch text-[#A13E18] font-lava text-[48px] leading-[115%] text-left"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo esc_html($apoya_titulo); ?>
        </h2>

        <!-- Contenedor de Cards - CAMBIO AQUÍ: items-center por items-stretch -->
        <div class="flex flex-col lg:flex-row items-stretch gap-[20px] self-stretch w-full">

            <!-- Card 1: Sociedad Civil - AGREGADO: h-full -->
            <div class="flex w-full lg:w-[566px] h-full p-[40px] lg:p-[74px] flex-col justify-start items-start gap-[32px] lg:gap-[52px] bg-[#ECECEC] rounded-lg"
                style="box-shadow: 0 -8px 20px 0 rgba(144, 144, 144, 0.02);">

                <!-- Imagen Card 1 -->
                <div class="h-[254px] lg:h-[274px] w-full flex-shrink-0">
                    <?php if ($apoya_card1_imagen_url) : ?>
                        <img src="<?php echo esc_url($apoya_card1_imagen_url); ?>"
                            alt="<?php echo esc_attr($apoya_card1_titulo); ?>"
                            class="w-full h-full object-cover">
                    <?php else : ?>
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">Imagen no disponible</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Título Card 1 -->
                <h3 class="self-stretch text-negro text-left font-[Montserrat] text-[24px] lg:text-[32px] font-bold leading-[115%]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($apoya_card1_titulo); ?>
                </h3>

                <!-- Texto Card 1 - AGREGADO: flex-grow para ocupar espacio disponible -->
                <p class="self-stretch flex-grow text-negro text-left font-[Montserrat] text-[16px] lg:text-[18px] font-medium leading-[24px]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo wp_kses_post($apoya_card1_texto); ?>
                </p>

                <!-- Botón Descargar Card 1 - AGREGADO: mt-auto para empujar al final -->
                <a href="<?php echo esc_url($apoya_card1_archivo_url); ?>"
                    download
                    class="flex w-full lg:w-[290px] px-[32px] py-[16px] justify-center items-center gap-[10px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold hover:bg-[#8a3315] transition-colors duration-300 mt-auto">
                    <?php echo esc_html($apoya_card1_boton_texto); ?>
                </a>
            </div>

            <!-- Card 2: Organización Internacional - AGREGADO: h-full -->
            <div class="flex w-full lg:w-[566px] h-full p-[40px] lg:p-[74px] flex-col justify-start items-start gap-[32px] lg:gap-[52px] bg-[#ECECEC] rounded-lg"
                style="box-shadow: 0 -8px 20px 0 rgba(144, 144, 144, 0.02);">

                <!-- Imagen Card 2 -->
                <div class="h-[254px] lg:h-[274px] w-full flex-shrink-0">
                    <?php if ($apoya_card2_imagen_url) : ?>
                        <img src="<?php echo esc_url($apoya_card2_imagen_url); ?>"
                            alt="<?php echo esc_attr($apoya_card2_titulo); ?>"
                            class="w-full h-full object-cover">
                    <?php else : ?>
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">Imagen no disponible</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Título Card 2 -->
                <h3 class="self-stretch text-negro text-left font-[Montserrat] text-[24px] lg:text-[32px] font-bold leading-[115%]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($apoya_card2_titulo); ?>
                </h3>

                <!-- Texto Card 2 - AGREGADO: flex-grow para ocupar espacio disponible -->
                <p class="self-stretch flex-grow text-negro text-left font-[Montserrat] text-[16px] lg:text-[18px] font-medium leading-[24px]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo wp_kses_post($apoya_card2_texto); ?>
                </p>

                <!-- Botón Descargar Card 2 - AGREGADO: mt-auto para empujar al final -->
                <a href="<?php echo esc_url($apoya_card2_archivo_url); ?>"
                    download
                    class="flex w-full lg:w-[370px] px-[32px] py-[16px] justify-center items-center gap-[10px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold hover:bg-[#8a3315] transition-colors duration-300 mt-auto">
                    <?php echo esc_html($apoya_card2_boton_texto); ?>
                </a>
            </div>

        </div>

    </div>
</section>

<!-- Sección En Redes -->
<section id="redes" class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full max-w-[762px] flex-col items-center gap-[24px]">

        <!-- Título -->
        <h2 class="flex h-[37px] flex-col justify-center self-stretch text-[#A13E18] text-center font-lava text-[48px] leading-[115%]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo esc_html($redes_titulo); ?>
        </h2>

        <!-- Texto Descriptivo -->
        <p class="h-[48px] self-stretch text-negro text-left font-[Montserrat] text-[18px] font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            <?php echo esc_html($redes_texto); ?>
            <span class="font-bold"><?php echo esc_html($redes_hashtag); ?></span>
        </p>

        <!-- Contenedor de Botones -->
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-[24px] mt-3">

            <!-- Botón Facebook -->
            <a href="<?php echo esc_url($redes_facebook_url); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="flex w-[145px] px-[32px] py-[16px] justify-center items-center gap-[10px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] hover:bg-[#8a3315] transition-colors duration-300">
                <?php echo esc_html($redes_facebook_texto); ?>
            </a>

            <!-- Botón Instagram -->
            <a href="<?php echo esc_url($redes_instagram_url); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="flex w-[145px] px-[32px] py-[16px] justify-center items-center gap-[10px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] hover:bg-[#8a3315] transition-colors duration-300">
                <?php echo esc_html($redes_instagram_texto); ?>
            </a>

            <!-- Botón X (Twitter) -->
            <a href="<?php echo esc_url($redes_twitter_url); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="flex w-[145px] px-[32px] py-[16px] justify-center items-center gap-[10px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] hover:bg-[#8a3315] transition-colors duration-300">
                <?php echo esc_html($redes_twitter_texto); ?>
            </a>

        </div>

    </div>
</section>

<?php get_footer(); ?>