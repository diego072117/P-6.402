<?php

/**
 * Template Part: Banner Hero Animado
 * 
 * Componente reutilizable que REQUIERE parámetros del padre
 * 
 * Uso OBLIGATORIO con parámetros:
 * get_template_part('template-parts/banner-hero', null, array(
 *     'slides' => array(
 *         array('imagen_id' => 123, 'texto' => 'Texto 1'),
 *         array('imagen_id' => 124, 'texto' => 'Texto 2'),
 *         array('imagen_id' => 125, 'texto' => 'Texto 3'),
 *     ),
 *     'intervalo' => 5
 * ));
 */

// Verificar que se pasaron los parámetros requeridos
if (empty($args['slides']) || !is_array($args['slides'])) {
    error_log('Banner Hero: No se pasaron slides como parámetros');
    return;
}

$slides = $args['slides'];
$intervalo = isset($args['intervalo']) ? (int)$args['intervalo'] : 5;

// Validar que haya al menos 1 slide
if (count($slides) === 0) {
    return;
}

// Generar ID único para este banner
$banner_id = 'banner-hero-' . uniqid();
?>

<!-- Banner Hero Animado -->
<section id="<?php echo esc_attr($banner_id); ?>"
    class="banner-hero-container relative w-full h-[250px] lg:h-[550px] overflow-hidden"
    data-intervalo="<?php echo esc_attr($intervalo * 1000); ?>">

    <!-- Slides -->
    <?php foreach ($slides as $index => $slide) :
        $imagen_url = !empty($slide['imagen_id']) ? wp_get_attachment_image_url($slide['imagen_id'], 'full') : get_template_directory_uri() . '/assets/images/image1.png';
        $texto = isset($slide['texto']) ? $slide['texto'] : '';
        $is_active = ($index === 0) ? 'active' : '';
    ?>

        <div class="banner-hero-slide <?php echo $is_active; ?> absolute inset-0 w-full h-full bg-cover bg-center"
            style="background-image: url('<?php echo esc_url($imagen_url); ?>');">

            <!-- Overlay oscuro -->
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>

            <!-- Texto centrado con animación -->
            <div class="absolute inset-0 flex items-center justify-center px-[30px] lg:px-[120px]">
                <h2 class="banner-hero-text text-white text-center font-display font-bold text-[24px] leading-[32px] lg:text-[48px] lg:leading-[56px] uppercase tracking-tight whitespace-pre-line">
                    <?php echo esc_html($texto); ?>
                </h2>
            </div>
        </div>

    <?php endforeach; ?>

    <!-- Barra de progreso vertical (lado derecho) -->
    <div class="banner-hero-progress-container absolute top-0 right-0 h-full w-[4px] bg-white bg-opacity-20 z-10">
        <div class="banner-hero-progress-bar absolute top-0 left-0 w-full bg-white bg-opacity-80 transition-none"
            style="height: 0%;"></div>
    </div>

    <!-- Indicadores de puntos -->
    <div class="banner-hero-dots absolute bottom-[20px] lg:bottom-[40px] left-0 right-0 flex justify-center items-center gap-2 z-10">
        <?php for ($i = 0; $i < count($slides); $i++) : ?>
            <button class="banner-hero-dot <?php echo ($i === 0) ? 'active' : ''; ?> w-[10px] h-[10px] rounded-full bg-white transition-all duration-300"
                data-slide="<?php echo $i; ?>"
                aria-label="Ir a slide <?php echo $i + 1; ?>">
            </button>
        <?php endfor; ?>
    </div>

</section>