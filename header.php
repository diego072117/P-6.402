<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="bg-blanco-gris relative">
        <div class="flex items-center px-4 lg:px-[120px] py-6 gap-2.5">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
                        alt="<?php bloginfo('name'); ?>"
                        class="h-[73.69px] w-[60px]">
                </a>
            </div>

            <!-- Menú de navegación - DESKTOP -->
            <nav class="hidden lg:flex lg:flex-1 lg:justify-center lg:items-center lg:gap-6">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-principal',
                    'container' => false,
                    'menu_class' => 'flex gap-6 items-center',
                    'fallback_cb' => false,
                    'link_before' => '<span class="text-negro font-bold text-lg leading-6">',
                    'link_after' => '</span>',
                ));
                ?>
            </nav>

            <!-- Buscador - DESKTOP -->
            <div class="hidden lg:flex lg:h-12 lg:px-8 justify-center items-center gap-[10px] rounded-[5px] border border-[#404040]">
                <span class="text-[#404040] text-center font-sans text-[16px] font-medium leading-[24px]">Buscar</span>
                <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="flex items-center gap-[10px]">
                    <input type="search" name="s" placeholder="" class="w-[175px] h-[25px] rounded-[4px] bg-[#D9D9D9]">
                    <button type="submit">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" alt="Buscar" class="w-6 h-6">
                    </button>
                </form>
            </div>

            <!-- Botón Hamburguesa - MOBILE -->
            <button id="mobile-menu-toggle" class="lg:hidden ml-auto flex items-center justify-center w-10 h-10" aria-label="Abrir menú">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                    <path d="M0 13.3451H18V11.1209H0V13.3451ZM0 7.78465H18V5.56047H0V7.78465ZM0 0V2.22419H18V0H0Z" fill="black" />
                </svg>
            </button>
        </div>

        <!-- Menú Mobile Desplegable -->
        <div id="mobile-menu" class="hidden fixed inset-0 z-[9999] lg:hidden" style="display: none;">
            <!-- Overlay oscuro de fondo -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <!-- Contenedor del menú centrado -->
            <div id="mobile-menu-content"
                class="relative flex w-full h-[700px] flex-col items-center gap-[86px] bg-[#F8F8F8] px-8 pt-[70px] pb-8 transform translate-y-0 transition-transform duration-300 ease-out overflow-y-auto">


                <!-- Header con logo y botón cerrar -->
                <div class="flex items-center justify-between w-full">
                    <a href="<?php echo home_url(); ?>" class="mx-auto">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
                            alt="<?php bloginfo('name'); ?>"
                            class="h-[73.69px] w-[60px]">
                    </a>

                    <!-- Botón cerrar con círculo -->
                    <button id="mobile-menu-close"
                        class="absolute right-10 top-[85px] flex items-center justify-center w-30 h-30 rounded-full bg-[#9CA3AF] hover:bg-[#B0B6BD] transition"
                        aria-label="Cerrar menú">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none">
                            <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="white" />
                        </svg>
                    </button>


                </div>

                <!-- Menú de navegación mobile -->
                <nav class="flex flex-col items-center gap-[32px] self-stretch">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-principal',
                        'container' => false,
                        'menu_class' => 'flex flex-col items-center gap-[32px] w-full',
                        'fallback_cb' => false,
                        'link_before' => '<span class="text-negro font-bold text-xl leading-6">',
                        'link_after' => '</span>',
                    ));
                    ?>
                </nav>

                <!-- Buscador mobile -->
                <div class="w-full mt-auto">
                    <form role="search" method="get" action="<?php echo home_url('/'); ?>"
                        class="w-full flex items-center gap-2 px-4 py-3 rounded-[5px] border border-[#404040] bg-white">
                        <span class="text-[#404040] font-sans text-[14px] font-medium">Buscar</span>
                        <input type="search" name="s" placeholder="" class="flex-1 h-[25px] rounded-[4px] bg-[#D9D9D9] border-0">
                        <button type="submit">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" alt="Buscar" class="w-5 h-5">
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </header>