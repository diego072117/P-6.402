<?php

/**
 * Template Name: ¿Qué está pasando?
 * Página: ¿Qué está pasando?
 */

// Leer valores del Customizer para esta página
$slides_data = array(
    array(
        'imagen_id' => get_theme_mod('banner_hero_que_pasa_slide1_imagen', ''),
        'texto' => get_theme_mod('banner_hero_que_pasa_slide1_texto', 'Mantente informado sobre el caso'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_que_pasa_slide2_imagen', ''),
        'texto' => get_theme_mod('banner_hero_que_pasa_slide2_texto', 'Últimas noticias del proceso judicial'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_que_pasa_slide3_imagen', ''),
        'texto' => get_theme_mod('banner_hero_que_pasa_slide3_texto', 'Avances en la búsqueda de justicia'),
    ),
);

$intervalo = get_theme_mod('banner_hero_que_pasa_intervalo', 5);

get_header();
?>

<!-- Banner Hero Animado - ¿Qué está pasando? -->
<?php
get_template_part('template-parts/banner-hero', null, array(
    'slides' => $slides_data,
    'intervalo' => $intervalo
));
?>

<!-- Sección Noticias -->
<?php
get_template_part('template-parts/noticias-grid', null, array(
    'numero_noticias' => 6,
    'paginado' => false
));
?>

<!-- Sección Actividades-->
<section class="mt-[60px] lg:mt-[120px] bg-white flex flex-col items-center">
    <div class="w-full max-w-[1153px]">

        <!-- Título Desktop -->
        <div class="hidden lg:block w-full mb-[40px] px-[30px] lg:px-0">
            <h2 class="font-display text-[48px] font-bold leading-tight uppercase text-left">
                <span class="text-negro">NUESTRAS </span>
                <span class="text-[#A13E18]">ACTIVIDADES</span>
            </h2>
        </div>

        <!-- Título Mobile -->
        <div class="lg:hidden w-full mb-[40px] px-[30px] lg:px-0">
            <h2 class="font-display text-[48px] font-bold leading-[40px] uppercase text-left">
                <span class="block text-negro">NUESTRAS</span>
                <span class="block text-[#A13E18]">ACTIVIDADES</span>
            </h2>
        </div>

        <?php
        get_template_part('template-parts/actividades-grid', null, array(
            'numero_actividades' => 6,
            'paginado' => false
        ));
        ?>


    </div>
</section>


<!-- Sección CTA: ¡Si nos unimos! -->
<section class="relative w-full flex justify-center items-center bg-white py-[30px] mt-[100px] lg:px-0 overflow-hidden">

    <!-- Fondo SOLO visible en mobile -->
    <div class="absolute inset-0 lg:hidden">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image1.png"
            alt="Fondo CTA móvil"
            class="w-full h-full object-cover">
    </div>

    <!-- Contenedor principal -->
    <div class="relative w-full max-w-[1153px] flex flex-col lg:flex-row justify-between items-center gap-[40px] z-10">

        <!-- Columna Izquierda (Texto) -->
        <div class="flex-1 text-left">
            <h2 class="font-[Montserrat] font-bold text-[40px] leading-[52px] tracking-[0]">
                <span class="text-[#A13E18]">¡Si nos unimos, </span>
                <span class="text-black block lg:inline">todxs conoceremos la verdad!</span>
            </h2>
        </div>

        <!-- Columna Derecha (Botón dentro de contenedor) -->
        <div class="flex w-full lg:w-[605px] p-[30px] flex-col justify-center items-start gap-[30px] 
                rounded-[18.5px] lg:border lg:border-[#D1D9E2] 
                bg-transparent lg:bg-[#E6E9EC] 
                backdrop-blur-sm lg:backdrop-blur-0">

            <a href="#"
                class="flex w-full py-[16px] px-[32px] justify-center items-center gap-[10px] rounded-[6px] 
                bg-[#A13E18] text-white font-[Montserrat] text-[16px] font-semibold 
                hover:bg-[#8b3013] transition-colors duration-300">
                Apoya con tu firma
            </a>
        </div>

    </div>
</section>





<?php
$GLOBALS['footer_margin_top_mobile'] = '0px';
$GLOBALS['footer_margin_top_desktop'] = '120px';
get_footer();
?>