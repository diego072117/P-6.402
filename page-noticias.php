<?php

/**
 * Template Name: Noticias
 * Página: Noticias
 */

// Leer valores del Customizer para esta página
$slides_data = array(
    array(
        'imagen_id' => get_theme_mod('banner_hero_noticias_slide1_imagen', ''),
        'texto' => get_theme_mod('banner_hero_noticias_slide1_texto', 'Mantente al día con las últimas noticias'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_noticias_slide2_imagen', ''),
        'texto' => get_theme_mod('banner_hero_noticias_slide2_texto', 'Información actualizada sobre el caso'),
    ),
    array(
        'imagen_id' => get_theme_mod('banner_hero_noticias_slide3_imagen', ''),
        'texto' => get_theme_mod('banner_hero_noticias_slide3_texto', 'Sigue los avances del proceso'),
    ),
);

$intervalo = get_theme_mod('banner_hero_noticias_intervalo', 5);

get_header();
?>

<!-- Banner Hero Animado - Noticias -->
<?php
get_template_part('template-parts/banner-hero', null, array(
    'slides' => $slides_data,
    'intervalo' => $intervalo
));
?>

<!-- Contenedor con scroll vertical -->
<div class="w-full h-[800px] lg:h-[1800px] overflow-y-auto pr-[10px]" style="scrollbar-width: thin; scrollbar-color: #A13E18 #f0f0f0;">
    <?php
    get_template_part('template-parts/noticias-grid', null, array(
        'numero_noticias' => 6,    
        'paginado' => true,          
        'noticias_por_carga' => 6     
    ));
    ?>
</div>

<!-- Hero Banner Desktop -->
<div class="hidden lg:block w-full">
    <?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => false]); ?>
</div>

<!-- Hero Banner Mobile -->
<div class="block lg:hidden w-full mt-[60px]">
    <?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => true]); ?>
</div>

<?php
$GLOBALS['footer_margin_top_mobile'] = '0px';
$GLOBALS['footer_margin_top_desktop'] = '100px';
get_footer();
?>