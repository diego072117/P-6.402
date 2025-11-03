<?php

/**
 * Template part: Detalle de NOTICIAS
 */
if (have_posts()) :
    while (have_posts()) : the_post();
        // Obtener datos
        $titulos = obtener_titulos_noticia(get_the_ID());
        $fecha = get_the_date('d M Y'); // Formato: 03 Nov 2025
        $imagen = get_the_post_thumbnail_url(get_the_ID(), 'large');

        // Obtener autor
        $autor_id = get_the_author_meta('ID');
        $autor_nombre = get_the_author();
        $autor_avatar = get_avatar_url($autor_id, array('size' => 54));

        // Separar el contenido en dos partes y LIMPIAR TÍTULOS
        $contenido = get_the_content();

        // IMPORTANTE: Remover TODOS los H1s del contenido antes de procesarlo
        $contenido = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $contenido);

        // Ahora sí separar en párrafos
        $parrafos = explode('</p>', $contenido);

        // Limpiar párrafos vacíos
        $parrafos = array_filter($parrafos, function ($p) {
            return !empty(trim(strip_tags($p)));
        });

        // Reindexar array
        $parrafos = array_values($parrafos);

        $descripcion1 = !empty($parrafos[0]) ? $parrafos[0] . '</p>' : '';
        $descripcion2 = count($parrafos) > 1 ? implode('</p>', array_slice($parrafos, 1)) : '';

        // Leer valores del Customizer para esta página
        $slides_data = array(
            array(
                'imagen_id' => get_theme_mod('banner_hero_noticias_slide1_imagen', ''),
                'texto' => get_theme_mod('banner_hero_noticias_slide1_texto', 'Mantente al día con las últimas noticias'),
            ),
            array(
                'imagen_id' => get_theme_mod('banner_hero_noticias_slide2_imagen', ''),
                'texto' => get_theme_mod('banner_hero_noticias_slide2_texto', 'Información actualizada sobre el caso'),
            ),
            array(
                'imagen_id' => get_theme_mod('banner_hero_noticias_slide3_imagen', ''),
                'texto' => get_theme_mod('banner_hero_noticias_slide3_texto', 'Sigue los avances del proceso'),
            ),
        );

        $intervalo = get_theme_mod('banner_hero_noticias_intervalo', 5);
?>

        <!-- Banner Hero Animado - Noticias -->
        <?php
        get_template_part('template-parts/banner-hero', null, array(
            'slides' => $slides_data,
            'intervalo' => $intervalo
        ));
        ?>

        <!-- DETALLE DE LA NOTICIA -->
        <section class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
            <!-- Contenedor principal: width: 762px en desktop -->
            <div class="flex w-full lg:w-[762px] flex-col items-start gap-[40px]">

                <!-- Título 1 + Título 2 concatenados -->
                <h1 class="leading-[40px] lg:leading-[48px] font-display font-bold tracking-tight uppercase text-left w-full self-stretch">
                    <span class=" text-[36px] lg:text-[48px] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($titulos['titulo1']); ?>
                    </span>
                    <?php if (!empty($titulos['titulo2'])) : ?>
                        <span class=" text-[36px] lg:text-[48px] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                            <?php echo esc_html($titulos['titulo2']); ?>
                        </span>
                    <?php endif; ?>
                </h1>

                <!-- Fecha de publicación -->
                <p class="text-negro font-[Montserrat] text-[14px] lg:text-[16px] font-medium leading-[24px] text-left self-stretch" style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($fecha); ?>
                </p>

                <!-- Descripción 1 (primer párrafo) -->
                <div class="text-negro font-[Montserrat] text-[16px] lg:text-[18px] font-medium leading-[24px] text-left self-stretch" style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo wp_kses_post($descripcion1); ?>
                </div>

                <!-- Imagen: height: 350px, align-self: stretch -->
                <?php if ($imagen) : ?>
                    <div class="w-full self-stretch h-[250px] lg:h-[350px]">
                        <img
                            src="<?php echo esc_url($imagen); ?>"
                            alt="<?php echo esc_attr($titulos['titulo1']); ?>"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                <?php endif; ?>

                <!-- Descripción 2 (resto del contenido) -->
                <?php if (!empty($descripcion2)) : ?>
                    <div class="text-negro font-[Montserrat] text-[16px] lg:text-[18px] font-medium leading-[24px] text-left self-stretch" style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo wp_kses_post($descripcion2); ?>
                    </div>
                <?php endif; ?>

                <!-- Información del autor -->
                <div class="flex items-start gap-[16px] w-full self-stretch">
                    <!-- Avatar circular del autor -->
                    <div class="w-[54px] h-[54px] rounded-full overflow-hidden bg-gray-300 flex-shrink-0">
                        <img
                            src="<?php echo esc_url($autor_avatar); ?>"
                            alt="<?php echo esc_attr($autor_nombre); ?>"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Información del autor -->
                    <div class="flex flex-col gap-[4px]">
                        <p class="text-negro font-[Montserrat] text-[14px] font-semibold leading-[20px]">
                            <?php echo esc_html($autor_nombre); ?>
                        </p>
                        <p class="text-gray-600 font-[Montserrat] text-[12px] font-medium leading-[18px]">
                            Autor
                        </p>
                        <p class="text-gray-500 font-[Montserrat] text-[12px] font-medium leading-[18px]">
                            Publicado el <?php echo esc_html($fecha); ?>
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- Sección Slider - Qué está pasando (Noticias) -->
        <?php
        get_template_part('template-parts/noticias-slider', null, array(
            'numero_noticias' => 6,
            'orderby' => 'modified'  // 'date' o 'modified'
        ));
        ?>

        <!-- Hero Banner Desktop -->
        <div class="hidden lg:block w-full">
            <?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => false]); ?>
        </div>

        <!-- Hero Banner Mobile -->
        <div class="block lg:hidden w-full mt-[60px]">
            <?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => true]); ?>
        </div>

<?php
    endwhile;
endif;
