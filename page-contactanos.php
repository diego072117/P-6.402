<?php

/**
 * Template Name: Contáctanos
 * Página: Contáctanos
 */

get_header();

// ===================================
// VARIABLES DE CAMPOS CUSTOM
// ===================================
$contacto_titulo = get_theme_mod('contacto_titulo', 'CONTÁCTANOS');
$contacto_texto_1 = get_theme_mod('contacto_texto_1', '¿Tienes más ideas para apoyar o preguntas?');
$contacto_texto_2 = get_theme_mod('contacto_texto_2', '¿Eres periodista o necesitas más información?');
$contacto_texto_3 = get_theme_mod('contacto_texto_3', '¡La búsqueda de verdad y justicia es de todos!');
$contacto_email = get_theme_mod('contacto_email', 'justiciaparalas6402@gmail.com');
$contacto_texto_inferior = get_theme_mod('contacto_texto_inferior', 'También puedes escribirnos directamente a:');
?>

<!-- Sección Contáctanos -->
<section class="relative w-full h-[638px] flex-shrink-0"
    style="
        background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/bg-image3.png');
        background-position: right bottom;
        background-size: cover;
        background-repeat: no-repeat;
    ">

    <!-- Contenedor Principal -->
    <div class="container mx-auto h-full px-4 lg:px-[120px] flex items-center">

        <!-- Contenedor Secundario -->
        <div class="flex flex-col lg:flex-row w-full max-w-[1152px] mx-auto justify-between items-center gap-12 lg:gap-8">

            <!-- Columna Izquierda: Texto -->
            <div class="flex w-full lg:w-[427px] flex-col items-start gap-6 flex-shrink-0">

                <!-- Título -->
                <h1 class="font-lava text-[64px] sm:text-[80px] lg:text-[96px] text-[#A13E18] leading-[120%]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    <?php echo esc_html($contacto_titulo); ?>
                </h1>

                <!-- Textos -->
                <div class="flex flex-col gap-1 self-stretch">
                    <p class="text-negro font-sans text-[18px] font-medium leading-[24px]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($contacto_texto_1); ?>
                    </p>

                    <p class="text-negro font-sans text-[18px] font-medium leading-[24px]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($contacto_texto_2); ?>
                    </p>

                    <p class="text-negro font-sans text-[18px] font-medium leading-[24px]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($contacto_texto_3); ?>
                    </p>
                </div>

            </div>

            <!-- Columna Derecha: Formulario -->
            <div class="flex w-full lg:w-[641px] flex-col justify-center items-start gap-6 flex-shrink-0">

                <!-- Formulario -->
                <form class="w-full flex flex-col gap-6">

                    <!-- Input Nombre -->
                    <input
                        type="text"
                        name="nombre"
                        placeholder="Nombre"
                        required
                        class="flex h-[54px] w-full px-4 justify-center items-center bg-white border border-gray-300 rounded-md text-negro font-montserrat text-[16px] focus:outline-none focus:ring-2 focus:ring-[#A13E18] focus:border-transparent" />

                    <!-- Input Correo Electrónico -->
                    <input
                        type="email"
                        name="email"
                        placeholder="Correo electrónico"
                        required
                        class="flex h-[54px] w-full px-4 justify-center items-center bg-white border border-gray-300 rounded-md text-negro font-montserrat text-[16px] focus:outline-none focus:ring-2 focus:ring-[#A13E18] focus:border-transparent" />

                    <!-- Textarea Mensaje -->
                    <textarea
                        name="mensaje"
                        placeholder="Mensaje"
                        required
                        rows="3"
                        class="flex h-[96px] w-full px-4 py-3 justify-start items-start resize-none bg-white border border-gray-300 rounded-md text-negro font-montserrat text-[16px] focus:outline-none focus:ring-2 focus:ring-[#A13E18] focus:border-transparent"></textarea>

                    <!-- Botón Enviar -->
                    <button
                        type="submit"
                        class="flex h-[54px] px-8 py-4 justify-center items-center gap-2.5 w-full rounded-md bg-[#A13E18] text-white font-montserrat text-[16px] font-semibold hover:bg-[#8B3214] transition-colors">
                        Enviar
                    </button>

                </form>

                <!-- Texto Inferior -->
                <div class="w-full lg:w-[433px] flex flex-col gap-2">
                    <p class="text-negro font-montserrat text-[16px] font-medium leading-[24px]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($contacto_texto_inferior); ?>
                    </p>
                    <a href="mailto:<?php echo esc_attr($contacto_email); ?>"
                        class="text-negro font-montserrat text-[16px] font-medium leading-[24px] hover:text-[#A13E18] transition-colors"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($contacto_email); ?>
                    </a>
                </div>

            </div>

        </div>

    </div>

</section>

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
$GLOBALS['footer_margin_top_desktop'] = '10px';
get_footer();
?>

<?php get_footer(); ?>