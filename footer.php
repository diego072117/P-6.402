<?php
/**
 * Obtener textos del Customizer para el Footer
 */
$footer_texto_principal = get_theme_mod('footer_texto_principal', 'Buscamos #JusticiaParaLas6402 víctimas de ejecuciones extrajudiciales');
$footer_boton_texto = get_theme_mod('footer_boton_texto', 'Apoya con tu firma');
$footer_boton_url = get_theme_mod('footer_boton_url', '#firmar');
$footer_copyright = get_theme_mod('footer_copyright', 'Justicia para las 6402. Todos los derechos reservados');

// Obtener márgenes personalizados o usar valores por defecto
$margin_top_mobile = isset($GLOBALS['footer_margin_top_mobile']) ? $GLOBALS['footer_margin_top_mobile'] : '60px';
$margin_top_desktop = isset($GLOBALS['footer_margin_top_desktop']) ? $GLOBALS['footer_margin_top_desktop'] : '180px';
?>

<footer class="relative w-full" style="margin-top: <?php echo esc_attr($margin_top_mobile); ?>;">
    <style>
        @media (min-width: 1024px) {
            footer {
                margin-top: <?php echo esc_attr($margin_top_desktop); ?> !important;
            }
        }
    </style>

    <!-- Contenedor del footer con imagen de fondo -->
    <div class="relative flex w-full px-[30px] lg:px-16 py-[40px] lg:py-[30px] justify-center items-center"
        style="
        background: url('<?php echo get_template_directory_uri(); ?>/assets/images/image1.png') lightgray 50% / cover no-repeat;
        backdrop-filter: blur(39.5px);
     ">

        <!-- Contenido del footer -->
        <div class="relative z-10 flex flex-col lg:flex-row w-full max-w-[375px] lg:max-w-[1312px] mx-auto justify-center lg:justify-between items-center gap-[32px] lg:gap-0">

            <!-- Columna Izquierda - Logo -->
            <div class="flex-shrink-0">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
                        alt="<?php bloginfo('name'); ?>"
                        class="h-[60px] w-auto">
                </a>
            </div>

            <!-- Columna Centro - Menú de navegación (SOLO DESKTOP, SIN SUBITEMS) -->
            <nav class="hidden lg:flex gap-8">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-principal',
                    'container' => false,
                    'menu_class' => 'flex gap-8 items-center',
                    'fallback_cb' => false,
                    'depth' => 1,
                    'link_before' => '<span class="text-negro font-[Montserrat] text-[16px] font-medium hover:text-[#A13E18] transition">',
                    'link_after' => '</span>',
                ));
                ?>
            </nav>

            <!-- Columna Derecha / Centro Mobile - Texto y Botón DINÁMICOS -->
            <div class="flex flex-col items-center lg:items-start gap-[24px] lg:gap-2 text-center lg:text-left">
                
                <!-- Texto Principal (editable) -->
                <p class="text-negro font-[Montserrat] text-[14px] font-medium leading-normal whitespace-pre-line">
                    <?php echo esc_html($footer_texto_principal); ?>
                </p>

                <!-- Botón (SOLO MOBILE, editable) -->
                <a href="<?php echo esc_url($footer_boton_url); ?>"
                   class="lg:hidden flex w-full max-w-[375px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                    <?php echo esc_html($footer_boton_texto); ?>
                </a>

                <!-- Copyright (editable con año automático) -->
                <p class="text-negro font-[Montserrat] text-[14px] font-normal leading-normal lg:mt-2">
                    © <?php echo date('Y'); ?> <?php echo esc_html($footer_copyright); ?>
                </p>
            </div>

        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>