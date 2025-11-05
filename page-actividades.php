<?php

/**
 * Template Name: Actividades
 * Página: Actividades
 */

get_header();
?>

<!-- Sección Actividades con Paginación -->
<section class="mt-[60px] lg:mt-[120px] bg-white flex flex-col items-center">
    <div class="w-full max-w-[1153px]">

        <!-- Título Desktop -->
        <div class="hidden lg:block w-full mb-[40px] px-[30px] lg:px-0">
            <h2 class="font-lava text-[48px] leading-tight uppercase text-left">
                <span class="text-negro">NUESTRAS </span>
                <span class="text-[#A13E18]">ACTIVIDADES</span>
            </h2>
        </div>

        <!-- Título Mobile -->
        <div class="lg:hidden w-full mb-[40px] px-[30px] lg:px-0">
            <h2 class="font-lava text-[48px] leading-[40px] uppercase text-left">
                <span class="block text-negro">NUESTRAS</span>
                <span class="block text-[#A13E18]">ACTIVIDADES</span>
            </h2>
        </div>

    </div>
</section>

<!-- Grid de Actividades con Paginación AJAX -->
<div class="w-full h-[800px] lg:h-[1100px] overflow-y-auto pr-[10px]" style="scrollbar-width: thin; scrollbar-color: #A13E18 #f0f0f0;">
    <?php
    get_template_part('template-parts/actividades-grid', null, array(
        'numero_actividades' => 6,
        'paginado' => true,
        'actividades_por_carga' => 6
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