<footer class="relative mt-[60px] lg:mt-[180px] w-full">
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

            <!-- Columna Centro - Menú de navegación (SOLO DESKTOP) -->
            <nav class="hidden lg:flex gap-8">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-principal',
                    'container' => false,
                    'menu_class' => 'flex gap-8 items-center',
                    'fallback_cb' => false,
                    'link_before' => '<span class="text-negro font-[Montserrat] text-[16px] font-medium hover:text-[#A13E18] transition">',
                    'link_after' => '</span>',
                ));
                ?>
            </nav>

            <!-- Columna Derecha / Centro Mobile - Texto y Botón -->
            <div class="flex flex-col items-center lg:items-start gap-[24px] lg:gap-2 text-center lg:text-left">
                <p class="text-negro font-[Montserrat] text-[14px] font-medium leading-normal">
                    Buscamos #JusticiaParaLas6402<br>
                    víctimas de ejecuciones<br>
                    extrajudiciales
                </p>

                <!-- Botón (SOLO MOBILE) -->
                <button class="lg:hidden flex w-full max-w-[375px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                    Apoya con tu firma
                </button>

                <p class="text-negro font-[Montserrat] text-[14px] font-normal leading-normal lg:mt-2">
                    © <?php echo date('Y'); ?> Justicia para las 6402.<br>
                    Todos los derechos reservados
                </p>
            </div>

        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>