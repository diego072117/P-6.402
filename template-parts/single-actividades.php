<?php

/**
 * Template para el detalle de ACTIVIDADES
 */

if (have_posts()) :
    while (have_posts()) : the_post();

        // Obtener el contenido del post
        $contenido = get_the_content();

        // Extraer todas las imágenes del contenido (bloques de imagen)
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $contenido, $matches);
        $imagenes_encontradas = $matches[1] ?? array();

        // Imagen por defecto
        $imagen_default = get_template_directory_uri() . '/assets/images/img-slider2.png';

        // Asegurar que siempre tengamos 9 imágenes
        $imagenes_galeria = array();
        for ($i = 0; $i < 9; $i++) {
            $imagenes_galeria[] = isset($imagenes_encontradas[$i]) ? $imagenes_encontradas[$i] : $imagen_default;
        }

        // Obtener título
        $titulo = get_the_title();

        // EXTRAER DESCRIPCIÓN SIN EL TÍTULO
        // 1. Remover todos los H1s del contenido
        $contenido_limpio = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $contenido);

        // 2. Remover todas las imágenes
        $contenido_limpio = preg_replace('/<img[^>]*>/i', '', $contenido_limpio);

        // 3. Remover el título si aparece como texto
        $contenido_limpio = str_replace($titulo, '', $contenido_limpio);

        // 4. Limpiar HTML y espacios
        $descripcion = wp_strip_all_tags($contenido_limpio);
        $descripcion = preg_replace('/\s+/', ' ', $descripcion);
        $descripcion = trim($descripcion);
?>

        <!-- Sección Detalle de Actividad -->
        <section class="mt-[60px] lg:mt-[120px] bg-white flex justify-center px-[30px] lg:px-0">
            <div class="flex flex-col w-full lg:w-[762px] items-start gap-[40px]">

                <!-- Título -->
                <h2 class="text-negro font-[Montserrat] text-[28px] lg:text-[32px] font-bold leading-[115%] self-stretch"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($titulo); ?>
                </h2>

                <!-- Descripción (sin título) -->
                <p class="text-negro font-[Montserrat] text-[16px] lg:text-[18px] font-medium leading-[24px] self-stretch"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($descripcion); ?>
                </p>

                <!-- Galería 3x3 -->
                <div class="grid grid-cols-3 gap-[16px] w-full">
                    <?php foreach ($imagenes_galeria as $index => $imagen_url) : ?>
                        <div class="w-full aspect-[254/275] cursor-pointer overflow-hidden rounded-md hover:opacity-90 transition-opacity duration-300"
                            onclick="openGalleryModal(<?php echo $index; ?>)">
                            <img src="<?php echo esc_url($imagen_url); ?>"
                                alt="Imagen <?php echo $index + 1; ?>"
                                class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>

        <!-- Sección Slider - Qué está pasando (Actividades) -->
        <?php
        get_template_part('template-parts/noticias-slider', null, array(
            'categoria' => 'actividades',
            'numero_posts' => 6,
            'orderby' => 'modified',
            'texto_boton' => 'Más actividades',
            'url_boton' => home_url('/actividades'),
            'texto_vacio' => 'No hay actividades disponibles en este momento.'
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


        <!-- Modal de Galería (Lightbox) -->
        <div id="gallery-modal"
            class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center p-4"
            onclick="closeGalleryModal(event)">

            <!-- Botón Cerrar (X) -->
            <button onclick="closeGalleryModal(event)"
                class="absolute top-4 right-4 text-white text-4xl font-bold hover:text-gray-300 transition z-10 w-12 h-12 flex items-center justify-center">
                &times;
            </button>

            <!-- Flecha Izquierda -->
            <button onclick="prevImage(event)"
                class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-5xl font-bold hover:text-gray-300 transition z-10 w-16 h-16 flex items-center justify-center">
                &#8249;
            </button>

            <!-- Imagen -->
            <div class="max-w-[90vw] max-h-[90vh] flex items-center justify-center" onclick="event.stopPropagation()">
                <img id="modal-image"
                    src=""
                    alt="Imagen ampliada"
                    class="max-w-full max-h-full object-contain rounded-lg">
            </div>

            <!-- Flecha Derecha -->
            <button onclick="nextImage(event)"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-5xl font-bold hover:text-gray-300 transition z-10 w-16 h-16 flex items-center justify-center">
                &#8250;
            </button>

            <!-- Contador de imágenes -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white text-lg font-[Montserrat]">
                <span id="current-image-number">1</span> / <?php echo count($imagenes_galeria); ?>
            </div>
        </div>

        <!-- Pasar datos de imágenes al JavaScript -->
        <script>
            window.galleryImagesData = <?php echo json_encode($imagenes_galeria); ?>;
        </script>

<?php
    endwhile;
endif;
?>