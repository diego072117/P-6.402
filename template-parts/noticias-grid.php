<?php

/**
 * Componente: Grid de Noticias
 * Muestra noticias en formato de tarjetas con opción de paginación AJAX
 * 
 * Parámetros:
 * - numero_noticias: Número inicial de noticias (por defecto 6)
 * - paginado: true = carga AJAX, false = botón redirige (por defecto false)
 * - noticias_por_carga: Cuántas noticias cargar en cada clic (por defecto 6)
 */

// Obtener parámetros
$numero_noticias = isset($args['numero_noticias']) ? $args['numero_noticias'] : 6;
$paginado = isset($args['paginado']) ? $args['paginado'] : false;
$noticias_por_carga = isset($args['noticias_por_carga']) ? $args['noticias_por_carga'] : 6;

// Obtener las noticias iniciales
$args_query = array(
    'post_type' => 'post',
    'posts_per_page' => $numero_noticias,
    'category_name' => 'noticias',
    'orderby' => 'modified',
    'order' => 'DESC',
    'post_status' => 'publish'
);

$noticias_query = new WP_Query($args_query);

// Imagen fallback
$imagen_fallback = get_template_directory_uri() . '/assets/images/img-slider2.png';

/**
 * Función helper para obtener extracto limpio (sin H1s)
 */
if (!function_exists('obtener_extracto_limpio')) {
    function obtener_extracto_limpio($post_id)
    {
        $contenido = get_post_field('post_content', $post_id);
        $contenido = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $contenido);
        $contenido = wp_strip_all_tags($contenido);
        $contenido = preg_replace('/\s+/', ' ', $contenido);
        $contenido = trim($contenido);
        return $contenido;
    }
}

/**
 * Función helper para limitar título
 */
if (!function_exists('limitar_titulo')) {
    function limitar_titulo($titulo, $limite = 60)
    {
        if (mb_strlen($titulo) > $limite) {
            return mb_substr($titulo, 0, $limite) . '...';
        }
        return $titulo;
    }
}

// Contar total de noticias disponibles
$total_query = new WP_Query(array(
    'post_type' => 'post',
    'category_name' => 'noticias',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids'
));
$total_noticias = $total_query->found_posts;
wp_reset_postdata();
?>

<!-- Sección Noticias -->
<section class="mt-[60px] lg:mt-[120px] bg-white flex justify-center lg:px-0">
    <div class="w-full max-w-[1153px]">

        <?php if ($noticias_query->have_posts()) : ?>

            <!-- Grid Desktop: 3 columnas -->
            <div id="noticias-grid-desktop" class="hidden lg:grid lg:grid-cols-3 gap-[32px] mb-[40px]">
                <?php
                while ($noticias_query->have_posts()) : $noticias_query->the_post();
                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');
                    $titulo = limitar_titulo(get_the_title(), 30);
                    $excerpt = obtener_extracto_limpio(get_the_ID());
                    if (strlen($excerpt) > 335) {
                        $excerpt = substr($excerpt, 0, 332) . '...';
                    }
                    $imagen_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if (!$imagen_url) {
                        $imagen_url = $imagen_fallback;
                    }
                ?>
                    <!-- Card Noticia -->
                    <div class="flex flex-col w-[375px] h-full min-h-[700px] px-[30px] py-[60px] bg-[#F8F8F8] hover:shadow-xl transition-shadow duration-300">
                        <a href="<?php echo esc_url($permalink); ?>" class="w-full h-[254px] overflow-hidden rounded-md flex-shrink-0">
                            <img src="<?php echo esc_url($imagen_url); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </a>
                        
                        <div class="flex flex-col justify-between flex-1 mt-[24px]">
                            <div class="flex flex-col gap-[16px] w-full text-left">
                                <a href="<?php echo esc_url($permalink); ?>" class="w-full">
                                    <h3 class="font-[Montserrat] font-bold leading-[110%] text-[28px] text-black hover:text-[#F8A60E] transition-colors duration-300 break-words">
                                        <?php echo esc_html($titulo); ?>
                                    </h3>
                                </a>
                                <p class="w-full text-black font-[Montserrat] text-[16px] font-medium leading-[24px] break-words">
                                    <?php echo esc_html($excerpt); ?>
                                </p>
                                <p class="text-gray-500 font-[Montserrat] text-[14px] font-medium">
                                    <?php echo esc_html($fecha); ?>
                                </p>
                            </div>
                            
                            <a href="<?php echo esc_url($permalink); ?>"
                                class="flex w-[315px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-black font-[Montserrat] text-[16px] font-bold hover:bg-[#d89400] transition-colors duration-300 mt-[16px]">
                                Lee más
                            </a>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
            </div>

            <!-- Mobile: Grid Vertical -->
            <div id="noticias-grid-mobile" class="lg:hidden flex flex-col items-center gap-[40px] mb-[40px]">
                <?php
                $noticias_query->rewind_posts();
                while ($noticias_query->have_posts()) : $noticias_query->the_post();
                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');
                    $titulo = limitar_titulo(get_the_title(), 30);
                    $excerpt = obtener_extracto_limpio(get_the_ID());
                    if (strlen($excerpt) > 335) {
                        $excerpt = substr($excerpt, 0, 332) . '...';
                    }
                    $imagen_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if (!$imagen_url) {
                        $imagen_url = $imagen_fallback;
                    }
                ?>
                    <!-- Card Mobile -->
                    <div class="w-full flex flex-col items-center">
                        <a href="<?php echo esc_url($permalink); ?>" class="w-full h-[306px] overflow-hidden">
                            <img src="<?php echo esc_url($imagen_url); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                class="w-full h-full object-cover">
                        </a>
                        <div class="flex flex-col justify-between w-[90%] max-w-[375px] min-h-[500px] px-[30px] py-[60px] bg-[#F8F8F8] hover:shadow-xl transition-shadow duration-300 mt-[-60px] rounded-b-md">
                            <div class="flex flex-col gap-[24px] w-full">
                                <a href="<?php echo esc_url($permalink); ?>" class="w-full">
                                    <h3 class="font-[Montserrat] font-bold leading-[110%] text-[24px] text-black text-left hover:text-[#F8A60E] transition-colors duration-300 break-words">
                                        <?php echo esc_html($titulo); ?>
                                    </h3>
                                </a>
                                <p class="text-black font-[Montserrat] text-[16px] font-medium leading-[24px] text-left break-words">
                                    <?php echo esc_html($excerpt); ?>
                                </p>
                                <p class="text-gray-500 font-[Montserrat] text-[14px] font-medium text-left">
                                    <?php echo esc_html($fecha); ?>
                                </p>
                            </div>
                            
                            <a href="<?php echo esc_url($permalink); ?>"
                                class="flex w-full max-w-[315px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-black font-[Montserrat] text-[16px] font-bold hover:bg-[#d89400] transition-colors duration-300 mt-[24px]">
                                Lee más
                            </a>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
            </div>

            <!-- Botón Más Noticias -->
            <div class="flex justify-center">
                <?php if ($paginado) : ?>
                    <!-- Botón con AJAX -->
                    <button id="cargar-mas-noticias"
                        data-offset="<?php echo $numero_noticias; ?>"
                        data-por-carga="<?php echo $noticias_por_carga; ?>"
                        data-total="<?php echo $total_noticias; ?>"
                        class="flex w-full sm:w-[370px] px-8 py-4 justify-center items-center gap-2.5
                            bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold 
                            rounded-[6px] hover:bg-[#8a3315] transition-colors duration-300 
                            disabled:opacity-50 disabled:cursor-not-allowed lg:ml-4">

                        <span class="btn-text">Más noticias</span>
                        <span class="btn-loading hidden">Cargando...</span>
                    </button>
                <?php else : ?>
                    <!-- Botón con redirección -->
                    <a href="<?php echo esc_url(home_url('/noticias')); ?>"
                        class="flex w-full sm:w-[370px] px-8 py-4 justify-center items-center gap-2.5
                            bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold 
                            rounded-[6px] hover:bg-[#8a3315] transition-colors duration-300 lg:ml-4">
                        Más noticias
                    </a>
                <?php endif; ?>
            </div>

        <?php else : ?>

            <!-- Mensaje de error -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-[32px] text-center">
                <p class="text-red-600 font-[Montserrat] text-[18px] font-medium">
                    No se pudieron cargar las noticias. Por favor, intenta más tarde.
                </p>
            </div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </div>
</section>