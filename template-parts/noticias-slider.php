<?php
/**
 * Componente: Slider Genérico (Noticias/Actividades)
 * Carrusel con navegación por flechas y dots
 * 
 * Parámetros:
 * - categoria: Slug de la categoría a mostrar (ej: 'noticias', 'actividades')
 * - numero_posts: Número de posts a mostrar (por defecto 6)
 * - orderby: Ordenar por 'date' o 'modified' (por defecto 'modified')
 * - texto_boton: Texto del botón al final (ej: 'Más noticias', 'Más actividades')
 * - url_boton: URL del botón (por defecto '/categoria')
 * - texto_vacio: Mensaje cuando no hay posts (ej: 'No hay noticias disponibles')
 */

// Obtener parámetros
$categoria = isset($args['categoria']) ? $args['categoria'] : 'noticias';
$numero_posts = isset($args['numero_posts']) ? $args['numero_posts'] : 6;
$orderby = isset($args['orderby']) ? $args['orderby'] : 'modified';
$texto_boton = isset($args['texto_boton']) ? $args['texto_boton'] : 'Más ' . $categoria;
$url_boton = isset($args['url_boton']) ? $args['url_boton'] : home_url('/' . $categoria);
$texto_vacio = isset($args['texto_vacio']) ? $args['texto_vacio'] : 'No hay contenido disponible en este momento.';

/**
 * Query para obtener los posts
 */
$args_query = array(
    'post_type'      => 'post',
    'posts_per_page' => $numero_posts,
    'category_name'  => $categoria,
    'orderby'        => $orderby,
    'order'          => 'DESC',
    'post_status'    => 'publish'
);

$query_posts = new WP_Query($args_query);

/**
 * Función helper para obtener extracto limpio (sin H1s)
 */
if (!function_exists('obtener_extracto_limpio_slider')) {
    function obtener_extracto_limpio_slider($post_id)
    {
        $contenido = get_post_field('post_content', $post_id);
        $contenido = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $contenido);
        $contenido = wp_strip_all_tags($contenido);
        $contenido = preg_replace('/\s+/', ' ', $contenido);
        $contenido = trim($contenido);
        
        // Limitar a 200 caracteres
        if (strlen($contenido) > 200) {
            $contenido = substr($contenido, 0, 197) . '...';
        }
        
        return $contenido;
    }
}

/**
 * Función helper para obtener los dos H1s del contenido
 */
if (!function_exists('obtener_titulos_noticia')) {
    function obtener_titulos_noticia($post_id)
    {
        $contenido = get_post_field('post_content', $post_id);
        $titulos = array('titulo1' => '', 'titulo2' => '');

        preg_match_all('/<h1[^>]*>(.*?)<\/h1>/is', $contenido, $matches);

        if (!empty($matches[1])) {
            $titulos['titulo1'] = wp_strip_all_tags($matches[1][0] ?? '');
            $titulos['titulo2'] = wp_strip_all_tags($matches[1][1] ?? '');
        }

        return $titulos;
    }
}
?>

<!-- Sección Slider - Noticias -->
<section class="mt-[60px] lg:mt-[180px] bg-white">

    <?php if ($query_posts->have_posts()) : ?>

        <!-- Contenedor general -->
        <div class="relative flex justify-center items-center w-full max-w-[1151px] mx-auto">

            <!-- Flecha Izquierda -->
            <button
                id="arrow-left-noticias"
                class="hidden lg:flex absolute left-[-80px] top-1/2 -translate-y-1/2 z-10 w-[68px] h-[68px] items-center justify-center transition drop-shadow-md"
                aria-label="Anterior">
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon-left.svg"
                    alt="Flecha izquierda"
                    class="w-[68px] h-[68px]" />
            </button>

            <!-- Wrapper del slider -->
            <div id="slider-wrapper-noticias" class="overflow-hidden w-full px-0 md:px-6">
                <!-- Contenedor de slides -->
                <div id="slider-container-noticias" class="flex justify-start gap-0 md:gap-6 transition-transform duration-500 ease-in-out">

                    <?php
                    $slide_count = 0;
                    while ($query_posts->have_posts()) : $query_posts->the_post();
                        $slide_count++;

                        // Obtener datos del post
                        $post_url = get_permalink();
                        $post_extracto = obtener_extracto_limpio_slider(get_the_ID());
                        $post_imagen = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        $post_fecha = get_the_date('d M Y');

                        // Extraer los dos H1s del contenido
                        $titulos = obtener_titulos_noticia(get_the_ID());

                        // Limitar títulos a 30 caracteres en total
                        $titulo1 = !empty($titulos['titulo1']) ? $titulos['titulo1'] : '';
                        $titulo2 = !empty($titulos['titulo2']) ? $titulos['titulo2'] : '';
                        $longitud_total = mb_strlen($titulo1 . ' ' . $titulo2);

                        if ($longitud_total > 30) {
                            $limite_titulo1 = min(mb_strlen($titulo1), 15);
                            $titulo1 = mb_substr($titulo1, 0, $limite_titulo1);
                            $resto = 30 - $limite_titulo1;
                            $titulo2 = mb_substr($titulo2, 0, $resto) . '...';
                        }

                        // Si no hay imagen destacada, usar placeholder
                        if (!$post_imagen) {
                            $post_imagen = get_template_directory_uri() . '/assets/images/img-slider2.png';
                        }
                    ?>

                        <!-- Card Noticia -->
                        <div class="slide-noticia flex min-w-full md:min-w-[375px] w-full md:w-[375px] flex-col justify-start items-center gap-6 flex-shrink-0 bg-[#F8F8F8] rounded-[6px] shadow-sm p-[60px_30px]">

                            <!-- Imagen (clickeable) -->
                            <a href="<?php echo esc_url($post_url); ?>" class="block w-full h-[254px] self-stretch">
                                <img
                                    src="<?php echo esc_url($post_imagen); ?>"
                                    alt="<?php echo esc_attr($titulo1 . ' ' . $titulo2); ?>"
                                    class="w-full h-full object-cover rounded-md" />
                            </a>

                            <!-- Títulos extraídos del contenido -->
                            <h3 class="self-stretch text-left leading-[48px] font-display font-bold tracking-tight uppercase">
                                <?php if (!empty($titulo1)) : ?>
                                    <span class="block text-[48px] text-[#000000]">
                                        <?php echo esc_html($titulo1); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if (!empty($titulo2)) : ?>
                                    <span class="block text-[48px] text-[#EAA40C]">
                                        <?php echo esc_html($titulo2); ?>
                                    </span>
                                <?php endif; ?>
                            </h3>

                            <!-- Extracto -->
                            <p class="self-stretch text-[#000000] text-[16px] font-[500] leading-[24px] font-[Montserrat] text-left">
                                <?php echo esc_html($post_extracto); ?>
                            </p>

                            <!-- Fecha de publicación -->
                            <div class="self-stretch flex justify-start">
                                <span class="text-[#666] text-[14px] font-[Montserrat] italic">
                                    <?php echo esc_html($post_fecha); ?>
                                </span>
                            </div>

                            <!-- Botón "Leer más" -->
                            <a href="<?php echo esc_url($post_url); ?>"
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
                id="arrow-right-noticias"
                class="hidden lg:flex absolute right-[-80px] top-1/2 -translate-y-1/2 z-10 w-[68px] h-[68px] items-center justify-center transition drop-shadow-md"
                aria-label="Siguiente">
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon-right.svg"
                    alt="Flecha derecha"
                    class="w-[68px] h-[68px]" />
            </button>

        </div>

        <!-- Indicadores (solo mobile) -->
        <div id="slider-dots-noticias" class="flex justify-center items-center gap-2 mt-6 md:hidden"></div>

        <!-- Botón personalizado -->
        <div class="flex justify-center w-full mt-8">
            <a href="<?php echo esc_url($url_boton); ?>"
                class="flex w-full max-w-[315px] lg:w-auto px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                <?php echo esc_html($texto_boton); ?>
            </a>
        </div>

    <?php else : ?>

        <!-- Mensaje personalizado cuando no hay posts -->
        <div class="flex justify-center items-center py-12">
            <p class="text-[#666] text-[18px] font-[Montserrat]">
                <?php echo esc_html($texto_vacio); ?>
            </p>
        </div>

    <?php endif; ?>

</section>