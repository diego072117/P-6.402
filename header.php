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

<header class="bg-blanco-gris relative z-50 shadow-md"> <?php // Añadido z-50 y shadow-md para que el header esté por encima del contenido y tenga una sombra sutil ?>
        <div class="flex items-center px-4 lg:px-[120px] py-6 gap-2.5">
            <div class="flex-shrink-0">
                
                <?php // HU-001: Si no es la página de inicio, el logo es un enlace. Si ya está en Home, no es un enlace. ?>
                <?php if ( ! is_front_page() ) : ?>
                    <a href="<?php echo esc_url( home_url('/') ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg"
                             alt="<?php bloginfo('name'); ?>"
                             class="h-[73.69px] w-[60px]">
                    </a>
                <?php else : ?>
                    <span class="block"> <?php // Usamos un <span> en lugar de <a> en el Home ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg"
                             alt="<?php bloginfo('name'); ?>"
                             class="h-[73.69px] w-[60px]">
                    </span>
                <?php endif; ?>

            </div>

            <nav class="hidden lg:flex lg:flex-1 lg:justify-center lg:items-center lg:gap-6">
                <?php
                // AÑADIMOS EL 'walker'
                wp_nav_menu(array(
                    'theme_location' => 'menu-principal',
                    'container'      => false,
                    'menu_class'     => 'flex gap-6 items-center', // Clases para el <ul> principal
                    'fallback_cb'    => false,
                    'link_before'    => '', // El Walker se encarga de esto
                    'link_after'     => '', // El Walker se encarga de esto
                    'depth'          => 2, // Limitar a 2 niveles (principal + submenú)
                    'walker'         => new Tailwind_Nav_Walker([
                        'menu_type' => 'desktop' // Le decimos al Walker que es el menú de escritorio
                    ])
                ));
                ?>
            </nav>

            <div class="hidden lg:flex lg:h-12 lg:px-8 justify-center items-center gap-[10px] rounded-[5px] border border-[#404040]">
                <span class="text-[#404040] text-center font-sans text-[16px] font-medium leading-[24px]">Buscar</span>
                <form role="search" method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="flex items-center gap-[10px]">
                    <label for="search-desktop" class="sr-only">Buscar</label> <?php // Añadido por accesibilidad ?>
                    <input type="search" id="search-desktop" name="s" value="<?php echo get_search_query(); ?>" placeholder="" class="w-[175px] h-[25px] rounded-[4px] bg-[#D9D9D9] border-0">
                    <button type="submit">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/search.svg" alt="Buscar" class="w-6 h-6">
                    </button>
                </form>
            </div>

            <button id="mobile-menu-toggle" class="lg:hidden ml-auto flex items-center justify-center w-10 h-10" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                    <path d="M0 13.3451H18V11.1209H0V13.3451ZM0 7.78465H18V5.56047H0V7.78465ZM0 0V2.22419H18V0H0Z" fill="black" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="fixed inset-0 z-[9999] bg-white w-full h-full transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden" role="dialog" aria-modal="true" aria-labelledby="mobile-menu-title">
            
            <div id="mobile-menu-content"
                 class="relative flex w-full h-full flex-col items-center gap-[86px] bg-white px-8 pt-[70px] pb-8 overflow-y-auto">

                <div class="flex items-center justify-center w-full relative h-[73.69px]">
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="mx-auto" id="mobile-menu-title">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg"
                             alt="<?php bloginfo('name'); ?> - Inicio"
                             class="h-[73.69px] w-[60px]">
                    </a>

                    <button id="mobile-menu-close"
                            class="absolute right-0 top-1/2 -translate-y-1/2 flex items-center justify-center w-10 h-10"
                            aria-label="Cerrar menú">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="black"/>
                        </svg>
                    </button>
                </div>

                <nav class="flex flex-col items-center gap-[32px] self-stretch">
                    <?php
                    // AÑADIMOS EL 'walker'
                    wp_nav_menu(array(
                        'theme_location' => 'menu-principal',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col items-center gap-[32px] w-full', // Clases para el <ul> principal
                        'fallback_cb'    => false,
                        'link_before'    => '', // El Walker se encarga de esto
                        'link_after'     => '', // El Walker se encarga de esto
                        'depth'          => 2,
                        'walker'         => new Tailwind_Nav_Walker([
                            'menu_type' => 'mobile' // Le decimos al Walker que es el menú de móvil
                        ])
                    ));
                    ?>
                </nav>

                <div class="w-full mt-auto">
                    <form role="search" method="get" action="<?php echo esc_url( home_url('/') ); ?>"
                          class="w-full flex items-center gap-2 px-4 py-3 rounded-[5px] border border-[#404040] bg-white">
                        <label for="search-mobile" class="text-[#404040] font-sans text-[14px] font-medium">Buscar</label>
                        <input type="search" id="search-mobile" name="s" value="<?php echo get_search_query(); ?>" placeholder="" class="flex-1 h-[25px] rounded-[4px] bg-[#D9D9D9] border-0">
                        <button type="submit" aria-label="Ejecutar búsqueda">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/search.svg" alt="" class="w-5 h-5"> <?php // alt vacío porque el botón tiene aria-label ?>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </header>