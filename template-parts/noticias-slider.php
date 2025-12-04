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
 * - show_button: Mostrar botón al final (true por defecto, false para ocultarlo)
 * - show_title: Mostrar título "¿Qué está pasando?" (false por defecto, true para mostrarlo)
 */

// Obtener parámetros
$categoria = isset($args['categoria']) ? $args['categoria'] : 'noticias';
$numero_posts = isset($args['numero_posts']) ? $args['numero_posts'] : 6;
$orderby = isset($args['orderby']) ? $args['orderby'] : 'modified';
$texto_boton = isset($args['texto_boton']) ? $args['texto_boton'] : 'Más ' . $categoria;
$url_boton = isset($args['url_boton']) ? $args['url_boton'] : home_url('/' . $categoria);
$texto_vacio = isset($args['texto_vacio']) ? $args['texto_vacio'] : 'No hay contenido disponible en este momento.';
$show_button = isset($args['show_button']) ? $args['show_button'] : true; // Por defecto true
$show_title = isset($args['show_title']) ? $args['show_title'] : false; // Por defecto false

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
        if (strlen($contenido) > 210) {
            $contenido = substr($contenido, 0, 210) . '...';
        }
        
        return $contenido;
    }
}

/**
 * Función helper para limitar título
 */
if (!function_exists('limitar_titulo_slider')) {
    function limitar_titulo_slider($titulo, $limite = 30)
    {
        if (mb_strlen($titulo) > $limite) {
            return mb_substr($titulo, 0, $limite) . '...';
        }
        return $titulo;
    }
}
?>

<!-- Sección Slider - Noticias -->
<section class="mt-[60px] lg:mt-[180px] bg-white">
    <div class="container mx-auto px-[30px] sm:px-[60px] md:px-[90px] lg:px-[60px] xl:px-[120px]">

        <?php if ($show_title) : ?>
            <!-- Título: ¿Qué está pasando? -->
            <h2 class="flex flex-col lg:flex-row leading-[48px] font-lava tracking-tight uppercase w-full text-left mb-10 lg:mb-[60px]">
                <span
                    class="text-[36px] lg:text-[48px] text-[#000000] lg:mr-[8px]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; line-height: 100%;">
                    ¿Qué está
                </span>
                <span
                    class="text-[36px] lg:text-[48px] text-[#A13E18]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; line-height: 100%;">
                    pasando?
                </span>
            </h2>
        <?php endif; ?>

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
                            $post_titulo = limitar_titulo_slider(get_the_title(), 70);
                            $post_extracto = obtener_extracto_limpio_slider(get_the_ID());
                            $post_imagen = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                            $post_fecha = get_the_date('d M Y');

                            // Si no hay imagen destacada, usar placeholder
                            if (!$post_imagen) {
                                $post_imagen = get_template_directory_uri() . '/assets/images/img-slider2.png';
                            }
                        ?>

                            <!-- Card Noticia -->
                            <div class="slide-noticia flex flex-col min-w-full md:min-w-[375px] w-full md:w-[375px] h-full min-h-[700px] px-[30px] py-[60px] bg-[#F8F8F8] rounded-[6px] shadow-sm flex-shrink-0">

                                <!-- Imagen (clickeable) -->
                                <a href="<?php echo esc_url($post_url); ?>" class="w-full h-[254px] overflow-hidden rounded-md flex-shrink-0">
                                    <img
                                        src="<?php echo esc_url($post_imagen); ?>"
                                        alt="<?php echo esc_attr($post_titulo); ?>"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                                </a>

                                <!-- Contenedor con flexbox para empujar el botón abajo -->
                                <div class="flex flex-col justify-between flex-1 mt-[24px]">
                                    
                                    <!-- Contenido superior -->
                                    <div class="flex flex-col gap-[16px] w-full">
                                        <!-- Título -->
                                        <a href="<?php echo esc_url($post_url); ?>" class="w-full">
                                            <h3 class="font-[Montserrat] font-bold leading-[110%] text-[20px] text-black hover:text-[#F8A60E] transition-colors duration-300 break-words text-left">
                                                <?php echo esc_html($post_titulo); ?>
                                            </h3>
                                        </a>

                                        <!-- Extracto -->
                                        <p class="w-full text-[#000000] text-[16px] font-[500] leading-[24px] font-[Montserrat] text-left break-words">
                                            <?php echo esc_html($post_extracto); ?>
                                        </p>

                                        <!-- Fecha de publicación -->
                                        <p class="text-gray-500 font-[Montserrat] text-[14px] font-medium">
                                            <?php echo esc_html($post_fecha); ?>
                                        </p>
                                    </div>

                                    <!-- Botón "Leer más" - siempre abajo -->
                                    <a href="<?php echo esc_url($post_url); ?>"
                                        class="flex w-[315px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-black font-[Montserrat] text-[16px] font-bold hover:bg-[#d89400] transition-colors duration-300 mt-[16px]">
                                        Lee más
                                    </a>
                                </div>

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

            <!-- Botón personalizado - Solo se muestra si show_button es true -->
            <?php if ($show_button) : ?>
                <div class="flex justify-center w-full mt-8">
                    <a href="<?php echo esc_url($url_boton); ?>"
                        class="flex w-full max-w-[315px] lg:w-auto px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                        <?php echo esc_html($texto_boton); ?>
                    </a>
                </div>
            <?php endif; ?>

        <?php else : ?>

            <!-- Mensaje personalizado cuando no hay posts -->
            <div class="flex justify-center items-center py-12">
                <p class="text-[#666] text-[18px] font-[Montserrat]">
                    <?php echo esc_html($texto_vacio); ?>
                </p>
            </div>

        <?php endif; ?>

    </div>
</section>