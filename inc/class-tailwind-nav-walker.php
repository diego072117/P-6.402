<?php

/**
 * Walker_Nav_Menu personalizado para Tailwind CSS y compatibilidad con HU-001.
 *
 * Esta clase aplica las clases de Tailwind correctas para menús desplegables
 * en desktop (hover) y menús tipo acordeón en mobile (click).
 */
class Tailwind_Nav_Walker extends Walker_Nav_Menu
{

    /**
     * @var string 'desktop' o 'mobile'. Determina el tipo de marcado a generar.
     */
    private $menu_type;

    /**
     * Almacena el tipo de menú (desktop/mobile) al instanciar.
     */
    function __construct($args = [])
    {
        $this->menu_type = $args['menu_type'] ?? 'desktop';
    }

    /**
     * Inicia un sub-menú (<ul>).
     */
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        if ($this->menu_type === 'desktop') {
            // Dropdown para Desktop
            $classes = 'absolute z-50 top-full left-0 w-64 bg-blanco-gris shadow-md rounded-md p-4 space-y-2 transition-all duration-300 ease-out opacity-0 invisible group-hover:opacity-100 group-hover:visible';
        } else {
            // Acordeón para Mobile
            // ⭐ IMPORTANTE: py-0 inicial (sin padding cuando está cerrado)
            // ⭐ opacity-0 inicial (invisible cuando está cerrado)
            $classes = 'w-full bg-white border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0 mt-2 px-4 py-0 rounded-md space-y-2';
        }
        $output .= "<ul class=\"$classes sub-menu\">";
    }

    /**
     * Finaliza un sub-menú (</ul>).
     */
    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= "</ul>";
    }

    /**
     * Inicia un elemento de menú (<li>).
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        // IMPORTANTE: Incluir todas las clases originales de WordPress
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // Comprueba si este ítem tiene hijos (WordPress añade esta clase automáticamente)
        $has_children = in_array('menu-item-has-children', $classes);

        // Añadir nuestras clases personalizadas de Tailwind
        $classes[] = 'relative';

        if ($this->menu_type === 'desktop' && $has_children) {
            $classes[] = 'group';
            $classes[] = 'group-hover:z-50';
        }

        // Clase para resaltar el item actual
        if ($item->current || $item->current_item_ancestor) {
            $classes[] = 'current-menu-item';
        }

        // En mobile, centramos el <li>
        if ($this->menu_type === 'mobile') {
            $classes[] = 'flex';
            $classes[] = 'flex-col';
            $classes[] = 'items-center';
        }

        // Unir todas las clases y limpiar
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        // Renderizar el <li> con TODAS las clases
        $output .= '<li' . $class_names . '>';

        // Atributos del enlace (<a>)
        $atts = [
            'title'  => ! empty($item->attr_title) ? $item->attr_title : '',
            'target' => ! empty($item->target)     ? $item->target     : '',
            'rel'    => ! empty($item->xfn)        ? $item->xfn        : '',
            'href'   => ! empty($item->url)        ? $item->url        : '',
        ];

        // Clases del enlace (<a>)
        $a_classes = 'font-bold leading-6 transition-colors hover:text-[#A13E18]';

        if ($this->menu_type === 'desktop') {
            $a_classes .= ' text-lg';
        } else {
            // En mobile
            if ($depth === 0) {
                // Item principal
                $a_classes .= ' text-xl';
            } else {
                // Sub-item (más pequeño)
                $a_classes .= ' text-base font-normal'; // Cambio: más pequeño y menos bold
            }
        }

        if ($item->current || $item->current_item_ancestor) {
            $a_classes .= ' text-[#A13E18]';
        } else {
            $a_classes .= ' text-negro';
        }

        // En MÓVIL, si tiene hijos, creamos un div flex CENTRADO
        if ($this->menu_type === 'mobile' && $has_children) {
            $output .= '<div class="flex items-center justify-center gap-2">';
        }

        // Renderizar el enlace <a>
        $output .= $args->before;
        $output .= '<a class="' . esc_attr($a_classes) . '" ' . $this->build_atts($atts) . '>';
        $output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $output .= '</a>';
        $output .= $args->after;

        // Añadir el botón de despliegue si tiene hijos
        if ($has_children) {
            if ($this->menu_type === 'desktop') {
                // Ícono de flecha para desktop
                $output .= '<svg class="absolute -right-5 top-1/2 -translate-y-1/2 w-4 h-4 text-negro transition-transform group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
            } else {
                // Botón para Mobile
                $output .= '<button class="mobile-submenu-toggle p-2 flex-shrink-0" aria-haspopup="true" aria-expanded="false" aria-label="Desplegar submenú">';
                $output .= '<svg class="w-6 h-6 text-negro transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
                $output .= '</button>';
            }
        }

        if ($this->menu_type === 'mobile' && $has_children) {
            $output .= '</div>';
        }
    }

    /**
     * Finaliza un elemento de menú (</li>).
     */
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>";
    }

    /**
     * Helper para construir atributos HTML de forma segura.
     */
    protected function build_atts($atts = [])
    {
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        return $attributes;
    }
}
