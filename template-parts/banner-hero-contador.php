<?php
/**
 * Template part: Hero Banner Principal
 * 
 * @param bool $mostrar_fondo - true: muestra imagen de fondo, false: sin imagen de fondo
 */

// Obtener parámetro
$args = wp_parse_args($args ?? [], [
    'mostrar_fondo' => true
]);

$mostrar_fondo = $args['mostrar_fondo'];

// Leer valores del Customizer
$banner_descripcion = get_theme_mod('banner_descripcion', 'Buscamos justicia para las 6.402 personas asesinadas y presentadas como falsas muertes en combate por el Ejército de Colombia.');
$banner_titulo_parte1 = get_theme_mod('banner_titulo_parte1', '¡Si nos unimos,');
$banner_titulo_parte2 = get_theme_mod('banner_titulo_parte2', 'todxs conoceremos la verdad!');
$banner_texto_boton = get_theme_mod('banner_texto_boton', 'Apoya con tu firma');
$banner_url_boton = get_theme_mod('banner_url_boton', 'https://www.change.org/');

// Obtener datos del contador
$datos_contador = obtener_datos_contador_firmas();

// Definir el estilo de fondo condicionalmente
$background_style = $mostrar_fondo 
    ? "background-image: url('" . esc_url(get_template_directory_uri()) . "/assets/images/image1.png');" 
    : "";
?>

<!-- Hero Banner Principal -->
<section class="min-h-[550px] md:h-[400px] lg:h-[550px] flex-shrink-0 bg-center bg-cover bg-no-repeat py-12 lg:py-0"
    style="<?php echo $background_style; ?>">

    <div class="container mx-auto px-[30px] sm:px-[60px] md:px-[90px] lg:px-[60px] xl:px-[120px] h-full">
        <div class="flex flex-col lg:flex-row items-center justify-center lg:justify-start h-full gap-6 lg:gap-[20px] xl:gap-[24px]">

            <!-- Columna Izquierda - Texto -->
            <div class="flex flex-col justify-center items-center lg:items-start w-full lg:w-[450px] xl:w-[532px] max-w-[315px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-none flex-shrink-0 gap-6 lg:gap-[28px] xl:gap-[33.44px]">

                <!-- Descripción DINÁMICA -->
                <p class="self-stretch:text-left text-black font-sans text-[16px] md:text-[17px] lg:text-[16px] xl:text-[18px] not-italic font-medium leading-[24px]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($banner_descripcion); ?>
                </p>

                <!-- Título principal DINÁMICO -->
                <h1 class="self-stretch lg:text-left font-sans text-[28px] md:text-[34px] lg:text-[32px] xl:text-[40px] not-italic font-bold leading-[36px] md:leading-[44px] lg:leading-[44px] xl:leading-[52px]">
                    <span class="text-[#A13E18]"><?php echo esc_html($banner_titulo_parte1); ?></span>
                    <span class="text-black"> <?php echo esc_html($banner_titulo_parte2); ?></span>
                </h1>
            </div>

            <!-- Columna Derecha - Contador -->
            <div class="flex flex-col w-full lg:w-[500px] xl:w-[605.237px] max-w-[315px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-none gap-4 lg:gap-0">

                <!-- Card con contador DINÁMICO -->
                <div class="flex w-full h-[144.19px] md:h-[200px] lg:h-[240px] xl:h-[266.877px] p-[16px] md:p-[24px] lg:p-[24px] xl:p-[29.614px] flex-col justify-center items-center gap-[16px] md:gap-[20px] lg:gap-[24px] xl:gap-[29.614px] flex-shrink-0
                            rounded-[18.509px] border-[1.851px] border-[#D1D9E2]
                            backdrop-blur-[2px] shadow-sm"
                    style="background: rgba(150, 150, 150, 0.3); background-blend-mode: multiply;">

                    <!-- Ya somos [DINÁMICO] -->
                    <div class="flex flex-row gap-[8px] md:gap-[12px] lg:gap-[12px] xl:gap-[15px] self-stretch">
                        <span class="text-black font-sans text-[19.45px] md:text-[28px] lg:text-[30px] xl:text-[36px] not-italic font-medium"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Ya somos
                        </span>
                        <span class="text-black font-sans text-[34.57px] md:text-[50px] lg:text-[54px] xl:text-[64px] not-italic font-bold"
                            style="line-height: 12.967px;">
                            <?php echo esc_html(number_format($datos_contador['actuales'], 0, ',', '.')); ?>
                        </span>
                    </div>

                    <!-- Barra de progreso DINÁMICA -->
                    <div class="relative flex items-center self-stretch h-[8px] md:h-[12px] lg:h-[12px] xl:h-[14.807px] rounded-[9.254px] bg-[#D1D9E2]">
                        <!-- Línea de progreso -->
                        <div class="absolute left-0 h-[8px] md:h-[12px] lg:h-[12px] xl:h-[14.807px] bg-[#A13E18] transition-all duration-1000 ease-out"
                            style="width: <?php echo esc_attr($datos_contador['porcentaje']); ?>%; border-radius: 9.254px 0 0 9.254px;"></div>

                        <!-- Punto de control -->
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/ControlPoint.svg"
                            alt="Control Point"
                            class="absolute w-[20px] md:w-[30px] lg:w-[32px] xl:w-[37.02px] h-[20px] md:h-[30px] lg:h-[32px] xl:h-[37.02px] z-10 transition-all duration-1000 ease-out"
                            style="left: <?php echo esc_attr($datos_contador['porcentaje']); ?>%; transform: translateX(-50%);" />
                    </div>

                    <!-- Ayúdanos a llegar a [META DINÁMICA] -->
                    <div class="flex flex-row items-center justify-center gap-[8px] md:gap-[20px] lg:gap-[24px] xl:gap-[30px] self-stretch text-center">
                        <span class="text-black font-sans text-[9.725px] md:text-[14px] lg:text-[15px] xl:text-[18px] not-italic font-medium whitespace-nowrap"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Ayúdanos a llegar a
                        </span>
                        <span class="text-black font-sans text-[21px] md:text-[30px] lg:text-[34px] xl:text-[40px] not-italic font-bold"
                            style="line-height: 12.967px;">
                            <?php echo esc_html(number_format($datos_contador['meta'], 0, ',', '.')); ?>
                        </span>
                        <span class="text-black font-sans text-[9.725px] md:text-[14px] lg:text-[15px] xl:text-[18px] not-italic font-medium whitespace-nowrap"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Antes de noviembre
                        </span>
                    </div>

                    <!-- Botón "Apoyar" - SOLO DESKTOP (DINÁMICO) -->
                    <div class="hidden lg:flex self-stretch">
                        <a href="<?php echo esc_url($banner_url_boton); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="bg-[#9B3B0A] text-white font-bold px-8 py-3 rounded-md hover:bg-[#7d2f08] transition mt-2">
                            <?php echo esc_html($banner_texto_boton); ?>
                        </a>
                    </div>
                </div>

                <!-- Botón "Apoya con tu firma" - SOLO MOBILE (DINÁMICO) -->
                <a href="<?php echo esc_url($banner_url_boton); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="lg:hidden w-full bg-[#A13E18] text-white font-bold text-[16px] px-8 py-4 rounded-[6px] hover:bg-[#7d2f08] transition text-center">
                    <?php echo esc_html($banner_texto_boton); ?>
                </a>
            </div>

        </div>
    </div>
</section>