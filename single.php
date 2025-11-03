<?php

/**
 * Template para singles
 */

get_header();

// Detectar si es noticia o actividad
if (has_category('noticias')) {
    get_template_part('template-parts/single', 'noticias');
} elseif (has_category('actividades')) {
    get_template_part('template-parts/single', 'actividades');
} else {
    // Single genérico
    get_template_part('template-parts/single', 'default');
}
?>

<?php
$GLOBALS['footer_margin_top_mobile'] = '0px';
$GLOBALS['footer_margin_top_desktop'] = '100px';
get_footer();
?>