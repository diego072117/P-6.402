<?php
// Cargar estilos y scripts
function tema_custom_scripts()
{
    // Cargar Tailwind CSS (debe ir al final para que no sea sobrescrito)
    wp_enqueue_style(
        'tailwind-css',
        get_template_directory_uri() . '/assets/css/output.css',
        array(), // sin dependencias
        filemtime(get_template_directory() . '/assets/css/output.css') // evita caché
    );

    // Si tienes custom.css, asegúrate de cargarlo DESPUÉS de Tailwind
    // wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css', ['tailwind-css'], '1.0');

    // Cargar JS personalizado
    wp_enqueue_script(
        'custom-js',
        get_template_directory_uri() . '/assets/js/custom.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/custom.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'tema_custom_scripts');

// Soporte para características de WordPress
function tema_custom_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'menu-principal' => __('Menú Principal', 'tema-custom'),
    ));
}
add_action('after_setup_theme', 'tema_custom_setup');
