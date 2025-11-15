<?php
/**
 * Componente: Grid de Actividades
 * Muestra actividades en formato de tarjetas con opción de paginación AJAX
 * 
 * Parámetros:
 * - numero_actividades: Número inicial de actividades (por defecto 6)
 * - paginado: true = carga AJAX, false = botón redirige (por defecto false)
 * - actividades_por_carga: Cuántas actividades cargar en cada clic (por defecto 6)
 */

// Obtener parámetros
$numero_actividades = isset($args['numero_actividades']) ? $args['numero_actividades'] : 6;
$paginado = isset($args['paginado']) ? $args['paginado'] : false;
$actividades_por_carga = isset($args['actividades_por_carga']) ? $args['actividades_por_carga'] : 6;

// Obtener las actividades iniciales
$args_query = array(
    'post_type' => 'post',
    'posts_per_page' => $numero_actividades,
    'category_name' => 'actividades',
    'orderby' => 'modified',
    'order' => 'DESC',
    'post_status' => 'publish'
);

$actividades_query = new WP_Query($args_query);

// Imagen fallback
$imagen_fallback = get_template_directory_uri() . '/assets/images/img-slider2.png';

/**
 * Función helper para limitar título
 */
if (!function_exists('limitar_titulo_actividad')) {
    function limitar_titulo_actividad($titulo, $limite = 50)
    {
        if (mb_strlen($titulo) > $limite) {
            return mb_substr($titulo, 0, $limite) . '...';
        }
        return $titulo;
    }
}

// Contar total de actividades disponibles
$total_query = new WP_Query(array(
    'post_type' => 'post',
    'category_name' => 'actividades',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids'
));
$total_actividades = $total_query->found_posts;
wp_reset_postdata();
?>

<!-- Sección Actividades -->
<section class="bg-white flex justify-center px-[30px] lg:px-0">
    <div class="w-full max-w-[1153px]">

        <?php if ($actividades_query->have_posts()) : ?>

            <!-- Grid Desktop: 3 columnas -->
            <div id="actividades-grid-desktop" class="hidden lg:grid lg:grid-cols-3 gap-[32px] mb-[40px]">
                <?php
                while ($actividades_query->have_posts()) : $actividades_query->the_post();

                    // Obtener datos
                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');
                    $titulo = limitar_titulo_actividad(get_the_title(), 20);

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

                        <!-- Contenido superpuesto con blur -->
                        <div class="relative z-10 p-[24px] flex flex-col justify-start items-start">
                            <!-- Contenedor con blur de fondo -->
                            <div class="backdrop-blur-md rounded-lg p-[16px] inline-block max-w-[90%]">
                                <!-- Título del post -->
                                <h3 class="font-[Montserrat] font-bold leading-[110%] text-[28px] text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] break-words">
                                    <?php echo esc_html($titulo); ?>
                                </h3>
                                <!-- Fecha -->
                                <p class="text-white font-[Montserrat] text-[14px] font-medium mt-[8px] drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                                    <?php echo esc_html($fecha); ?>
                                </p>
                            </div>
                        </div>
                    </a>

                <?php
                endwhile;
                ?>
            </div>

            <!-- Mobile: Grid Vertical -->
            <div id="actividades-grid-mobile" class="lg:hidden flex flex-col items-center gap-[40px] mb-[40px]">
                <?php
                $actividades_query->rewind_posts();
                while ($actividades_query->have_posts()) : $actividades_query->the_post();

                    $permalink = get_permalink();
                    $fecha = get_the_date('d/m/Y');
                    $titulo = limitar_titulo_actividad(get_the_title(), 20);

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
                            <!-- Contenedor con blur de fondo -->
                            <div class="backdrop-blur-md rounded-lg p-[16px] inline-block max-w-[90%]">
                                <!-- Título del post -->
                                <h3 class="font-[Montserrat] font-bold leading-[110%] text-[24px] text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] break-words">
                                    <?php echo esc_html($titulo); ?>
                                </h3>
                                <!-- Fecha -->
                                <p class="text-white font-[Montserrat] text-[14px] font-medium mt-[8px] drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                                    <?php echo esc_html($fecha); ?>
                                </p>
                            </div>
                        </div>
                    </a>

                <?php
                endwhile;
                ?>
            </div>

            <!-- Botón Ver Todas las Actividades (SIEMPRE VISIBLE) -->
            <div class="flex justify-center">
                <?php if ($paginado) : ?>
                    <!-- Botón con AJAX -->
                    <button id="cargar-mas-actividades"
                        data-offset="<?php echo $numero_actividades; ?>"
                        data-por-carga="<?php echo $actividades_por_carga; ?>"
                        data-total="<?php echo $total_actividades; ?>"
                        class="px-[48px] py-[14px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold rounded-[6px] hover:bg-[#8a3315] transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="btn-text">Conoce más</span>
                        <span class="btn-loading hidden">Cargando...</span>
                    </button>
                <?php else : ?>
                    <!-- Botón con redirección -->
                    <a href="<?php echo esc_url(home_url('/actividades')); ?>"
                        class="px-[48px] py-[14px] bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-bold rounded-[6px] hover:bg-[#8a3315] transition-colors duration-300">
                        Ver todas las actividades
                    </a>
                <?php endif; ?>
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