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
<section class="relative w-full h-auto lg:h-[638px] flex-shrink-0"
    style="
        background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/<?php echo wp_is_mobile() ? 'image1.png' : 'bg-image3.png'; ?>');
        background-position: <?php echo wp_is_mobile() ? 'center' : 'right bottom'; ?>;
        background-size: cover;
        background-repeat: no-repeat;
    ">

    <!-- Contenedor Principal -->
    <div class="container mx-auto h-full px-6 lg:px-[120px] py-12 lg:py-0 flex items-center">

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

                <!-- Mensajes de estado como Toast (top-center) -->
                <?php if (isset($_GET['contacto'])) : ?>
                    <div id="toast-notification">
                        <?php if ($_GET['contacto'] === 'exito') : ?>
                            <div class="flex items-center w-full max-w-md p-4 text-gray-500 bg-white rounded-lg shadow-2xl border-l-4 border-green-500 animate-slide-down" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-green-500 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <span class="mb-1 text-sm font-semibold text-gray-900">¡Mensaje enviado!</span>
                                    <div class="text-sm font-normal text-gray-600">Te contactaremos pronto.</div>
                                </div>
                                <button type="button" onclick="cerrarToast()" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
                                    <span class="sr-only">Cerrar</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        <?php elseif ($_GET['contacto'] === 'error') : ?>
                            <div class="flex items-center w-full max-w-md p-4 text-gray-500 bg-white rounded-lg shadow-2xl border-l-4 border-red-500 animate-slide-down" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-red-500 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <span class="mb-1 text-sm font-semibold text-gray-900">Error al enviar</span>
                                    <div class="text-sm font-normal text-gray-600">Completa todos los campos.</div>
                                </div>
                                <button type="button" onclick="cerrarToast()" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
                                    <span class="sr-only">Cerrar</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        <?php elseif ($_GET['contacto'] === 'email_invalido') : ?>
                            <div class="flex items-center w-full max-w-md p-4 text-gray-500 bg-white rounded-lg shadow-2xl border-l-4 border-yellow-500 animate-slide-down" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-yellow-500 bg-yellow-100 rounded-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <span class="mb-1 text-sm font-semibold text-gray-900">Email inválido</span>
                                    <div class="text-sm font-normal text-gray-600">Verifica tu correo electrónico.</div>
                                </div>
                                <button type="button" onclick="cerrarToast()" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
                                    <span class="sr-only">Cerrar</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        <?php elseif ($_GET['contacto'] === 'error_db') : ?>
                            <div class="flex items-center w-full max-w-md p-4 text-gray-500 bg-white rounded-lg shadow-2xl border-l-4 border-red-500 animate-slide-down" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-red-500 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm font-normal">
                                    <span class="mb-1 text-sm font-semibold text-gray-900">Error de servidor</span>
                                    <div class="text-sm font-normal text-gray-600">Contáctanos por email directamente.</div>
                                </div>
                                <button type="button" onclick="cerrarToast()" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
                                    <span class="sr-only">Cerrar</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Formulario -->
                <form method="POST" action="" class="w-full flex flex-col gap-6">
                    <?php wp_nonce_field('contacto_form_action', 'contacto_nonce'); ?>
                    <input type="hidden" name="contacto_form_submit" value="1">

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
                        class="flex h-[54px] px-8 py-4 justify-center items-center gap-2.5 w-full rounded-md bg-[#A13E18] text-white font-montserrat text-[16px] font-semibold hover:bg-[#8B3214] transition-colors duration-300 transform hover:scale-[1.02]">
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
<div class="block lg:hidden w-full lg:mt-[60px]">
    <?php get_template_part('template-parts/banner-hero-contador', null, ['mostrar_fondo' => true]); ?>
</div>

<?php
$GLOBALS['footer_margin_top_mobile'] = '0px';
$GLOBALS['footer_margin_top_desktop'] = '10px';
get_footer();
?>