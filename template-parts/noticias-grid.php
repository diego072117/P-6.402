<?php

/**
 * Componente: Grid de Noticias
 * Muestra las 6 últimas noticias en formato de tarjetas (3x2)
 */

// Obtener parámetro de número de noticias (por defecto 6)
$numero_noticias = isset($args['numero_noticias']) ? $args['numero_noticias'] : 6;

// Obtener las 6 últimas noticias
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $numero_noticias, // -1 trae todas las noticias
    'category_name' => 'noticias', // Slug de la categoría
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
);

$noticias_query = new WP_Query($args);

// Imagen fallback
$imagen_fallback = get_template_directory_uri() . '/assets/images/img-slider2.png';

/**
 * Función helper para obtener extracto limpio (sin H1s)
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
?>

<!-- Sección Noticias -->
<section class="mt-[60px] lg:mt-[120px] bg-white flex justify-center  lg:px-0">
    <div class="w-full max-w-[1153px]">

        <?php if ($noticias_query->have_posts()) : ?>

            <!-- Grid Desktop: 3 columnas x 2 filas -->
            <div class="hidden lg:grid lg:grid-cols-3 gap-[32px] mb-[40px]">
                <?php
                $counter = 1;
                while ($noticias_query->have_posts()) : $noticias_query->the_post();

                    // Obtener datos
                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');

                    // Obtener extracto limpio (sin H1s)
                    $excerpt = obtener_extracto_limpio(get_the_ID());

                    // Limitar resumen a 335 caracteres
                    if (strlen($excerpt) > 335) {
                        $excerpt = substr($excerpt, 0, 332) . '...';
                    }

                    // Obtener imagen destacada o fallback
                    $imagen_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if (!$imagen_url) {
                        $imagen_url = $imagen_fallback;
                    }
                ?>

                    <!-- Card Noticia -->
                    <div class="flex flex-col justify-center items-center gap-[24px] w-[375px] px-[30px] py-[60px] bg-[#F8F8F8] hover:shadow-xl transition-shadow duration-300">

                        <!-- Imagen -->
                        <div class="w-full h-[254px] overflow-hidden rounded-md">
                            <img src="<?php echo esc_url($imagen_url); ?>"
                                alt="Noticia <?php echo $counter; ?>"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>

                        <!-- Contenido -->
                        <div class="flex flex-col justify-center items-start gap-[16px] w-full text-left">
                            <!-- Título con número -->
                            <h3 class="font-[Montserrat] font-bold leading-[100%] text-[42px] text-black">
                                Noticia <span class="text-[#F8A60E]"><?php echo $counter; ?></span>
                            </h3>

                            <!-- Resumen -->
                            <p class="w-full text-black font-[Montserrat] text-[16px] font-medium leading-[24px]">
                                <?php echo esc_html($excerpt); ?>
                            </p>

                            <!-- Fecha -->
                            <p class="text-gray-500 font-[Montserrat] text-[14px] font-medium">
                                <?php echo esc_html($fecha); ?>
                            </p>

                            <!-- Botón -->
                            <a href="<?php echo esc_url($permalink); ?>"
                                class="flex w-[315px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-black font-[Montserrat] text-[16px] font-bold hover:bg-[#d89400] transition-colors duration-300">
                                Leer más
                            </a>
                        </div>
                    </div>



                <?php
                    $counter++;
                endwhile;
                ?>
            </div>

            <!-- Mobile: Grid Vertical -->
            <div class="lg:hidden flex flex-col items-center gap-[40px] mb-[40px]">
                <?php
                $counter = 1;
                $noticias_query->rewind_posts();
                while ($noticias_query->have_posts()) : $noticias_query->the_post();

                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');

                    // Obtener extracto limpio
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

                        <!-- Imagen -->
                        <div class="w-full h-[306px] overflow-hidden">
                            <img src="<?php echo esc_url($imagen_url); ?>"
                                alt="Noticia <?php echo $counter; ?>"
                                class="w-full h-full object-cover">
                        </div>

                        <!-- Contenedor del texto -->
                        <div class="flex flex-col justify-center items-start gap-[24px] w-[90%] max-w-[375px] px-[30px] py-[60px] bg-[#F8F8F8] hover:shadow-xl transition-shadow duration-300 mt-[-60px] rounded-b-md">

                            <!-- Título con número -->
                            <h3 class="font-[Montserrat] font-bold leading-[100%] text-[32px] text-black text-left">
                                Noticia <span class="text-[#F8A60E]"><?php echo $counter; ?></span>
                            </h3>

                            <!-- Resumen -->
                            <p class="text-black font-[Montserrat] text-[16px] font-medium leading-[24px] text-left">
                                <?php echo esc_html($excerpt); ?>
                            </p>

                            <!-- Fecha -->
                            <p class="text-gray-500 font-[Montserrat] text-[14px] font-medium text-left">
                                <?php echo esc_html($fecha); ?>
                            </p>

                            <!-- Botón -->
                            <a href="<?php echo esc_url($permalink); ?>"
                                class="flex w-full max-w-[315px] px-[32px] py-[12px] justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-black font-[Montserrat] text-[16px] font-bold hover:bg-[#d89400] transition-colors duration-300">
                                Leer más
                            </a>
                        </div>
                    </div>


                <?php
                    $counter++;
                endwhile;
                ?>
            </div>

            <!-- Botón Más Noticias -->
            <div class="flex justify-center">
                <a href="<?php echo esc_url(home_url('/noticias')); ?>"
                    class="px-[48px] py-[14px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold rounded-[6px] hover:bg-[#8a3315] transition-colors duration-300">
                    Más noticias
                </a>
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