<?php

/**
 * Componente: Grid de Actividades
 * Muestra actividades en formato de tarjetas horizontales (3x2)
 * 
 * Uso:
 * get_template_part('template-parts/actividades-grid', null, array(
 *     'numero_actividades' => 6  // Por defecto 6, usa -1 para todas
 * ));
 */

// Obtener parámetro de número de actividades (por defecto 6)
$numero_actividades = isset($args['numero_actividades']) ? $args['numero_actividades'] : 6;

// Obtener las actividades
$args_query = array(
    'post_type' => 'post',
    'posts_per_page' => $numero_actividades, // 6 por defecto, -1 para todas
    'category_name' => 'actividades',
    'orderby' => 'modified',
    'order' => 'DESC',
    'post_status' => 'publish'
);

$actividades_query = new WP_Query($args_query);

// Imagen fallback
$imagen_fallback = get_template_directory_uri() . '/assets/images/img-slider2.png';
?>

<!-- Sección Actividades -->
<section class="bg-white flex justify-center">
    <div class="w-full max-w-[1153px]">

        <?php if ($actividades_query->have_posts()) : ?>

            <!-- Grid Desktop: 3 columnas -->
            <div class="hidden lg:grid lg:grid-cols-3 gap-[32px] mb-[40px]">
                <?php
                $counter = 1;
                while ($actividades_query->have_posts()) : $actividades_query->the_post();

                    // Obtener datos
                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');

                    // Obtener imagen destacada o fallback
                    $imagen_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    if (!$imagen_url) {
                        $imagen_url = $imagen_fallback;
                    }
                ?>

                    <!-- Card Actividad Desktop -->
                    <a href="<?php echo esc_url($permalink); ?>"
                        class="relative w-full h-[455px] bg-cover bg-center hover:shadow-xl transition-all duration-300 hover:scale-105 overflow-hidden group cursor-pointer"
                        style="background-image: url('<?php echo esc_url($imagen_url); ?>');">

                        <!-- Overlay oscuro en hover -->
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>

                        < <!-- Contenido superpuesto con blur -->
                            <div class="relative z-10 p-[24px] flex flex-col justify-start items-start">

                                <!-- Contenedor con blur de fondo (sin negro) -->
                                <div class="backdrop-blur-md rounded-lg p-[16px] inline-block">
                                    <!-- Título con número -->
                                    <h3 class="font-[Montserrat] font-bold leading-[100%] text-[32px] text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                                        Actividad <?php echo $counter; ?>
                                    </h3>

                                    <!-- Fecha -->
                                    <p class="text-white font-[Montserrat] text-[14px] font-medium mt-[8px] drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                                        <?php echo esc_html($fecha); ?>
                                    </p>
                                </div>

                            </div>
                    </a>

                <?php
                    $counter++;
                endwhile;
                ?>
            </div>

            <!-- Mobile: Grid Vertical -->
            <div class="lg:hidden flex flex-col items-center gap-[40px] mb-[40px]">
                <?php
                $counter = 1;
                $actividades_query->rewind_posts();
                while ($actividades_query->have_posts()) : $actividades_query->the_post();

                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');

                    $imagen_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    if (!$imagen_url) {
                        $imagen_url = $imagen_fallback;
                    }
                ?>

                    <!-- Card Mobile -->
                    <a href="<?php echo esc_url($permalink); ?>"
                        class="relative w-full h-[306px] bg-cover bg-center hover:shadow-xl transition-all duration-300 overflow-hidden"
                        style="background-image: url('<?php echo esc_url($imagen_url); ?>');">

                        <!-- Contenido superpuesto con blur -->
                        <div class="relative z-10 p-[24px] flex flex-col justify-start items-start">

                            <!-- Contenedor con blur de fondo (sin negro) -->
                            <div class="backdrop-blur-md rounded-lg p-[16px] inline-block">
                                <!-- Título con número -->
                                <h3 class="font-[Montserrat] font-bold leading-[100%] text-[28px] text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                                    Actividad <?php echo $counter; ?>
                                </h3>

                                <!-- Fecha -->
                                <p class="text-white font-[Montserrat] text-[14px] font-medium mt-[8px] drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                                    <?php echo esc_html($fecha); ?>
                                </p>
                            </div>

                        </div>
                    </a>

                <?php
                    $counter++;
                endwhile;
                ?>
            </div>

            <!-- Botón Ver Todas las Actividades -->
            <div class="flex justify-center">
                <a href="<?php echo esc_url(home_url('/actividades')); ?>"
                    class="px-[48px] py-[14px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold rounded-[6px] hover:bg-[#8a3315] transition-colors duration-300">
                    Ver todas las actividades
                </a>
            </div>

        <?php else : ?>

            <!-- Mensaje si no hay actividades -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-[32px] text-center">
                <p class="text-red-600 font-[Montserrat] text-[18px] font-medium">
                    No se encontraron actividades. Por favor, intenta más tarde.
                </p>
            </div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </div>
</section>