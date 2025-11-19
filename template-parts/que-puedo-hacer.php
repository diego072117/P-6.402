<?php

/**
 * Obtener datos del Customizer para "Qué puedo hacer?"
 */
$que_hacer_titulo_p1 = get_theme_mod('que_hacer_titulo_parte1', 'QUÉ PUEDO');
$que_hacer_titulo_p2 = get_theme_mod('que_hacer_titulo_parte2', 'HACER?');
$que_hacer_subtitulo = get_theme_mod('que_hacer_subtitulo', 'Lucha por la verdad y justicia de todxs');
$que_hacer_descripcion = get_theme_mod('que_hacer_descripcion', 'Contamos con apoyo de:');
$que_hacer_url_boton = get_theme_mod('que_hacer_url_boton', '#que-puedo-hacer');

/**
 * Obtener estadísticas del CSV
 */
$estadisticas = obtener_estadisticas_csv();

// Función auxiliar para formatear números (200000 -> 200k)
function formatear_numero($numero)
{
    if ($numero >= 1000000) {
        return round($numero / 1000000, 1) . 'M';
    } elseif ($numero >= 1000) {
        return round($numero / 1000, 1) . 'k';
    }
    return $numero;
}


?>

<!-- Sección Qué puedo hacer -->
<section class="mt-[60px] lg:mt-[180px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full lg:w-[1151px] flex-col items-center lg:items-start">

        <!-- Bloque superior: título + subtítulo + texto DINÁMICO -->
        <div class="flex flex-col items-center lg:items-start gap-[24px] w-full">

            <!-- Título DINÁMICO -->
            <h2 class="flex flex-col lg:flex-row leading-[48px] font-lava tracking-tight uppercase w-full text-left">
                <span
                    class="text-[36px] lg:text-[48px] text-[#000000] lg:mr-[8px]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; line-height: 100%;">
                    <?php echo esc_html($que_hacer_titulo_p1); ?>
                </span>
                <span
                    class="text-[36px] lg:text-[48px] text-[#A13E18]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; line-height: 100%;">
                    <?php echo esc_html($que_hacer_titulo_p2); ?>
                </span>
            </h2>

            <!-- Subtítulo DINÁMICO -->
            <h3
                class="text-negro font-[Montserrat] text-[18px] lg:text-[20px] font-bold leading-[24px] text-left w-full"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($que_hacer_subtitulo); ?>
            </h3>

            <!-- Texto apoyo DINÁMICO -->
            <p
                class="text-negro font-[Montserrat] text-[14px] lg:text-[16px] font-medium leading-[24px] text-left w-full"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                <?php echo esc_html($que_hacer_descripcion); ?>
            </p>
        </div>

        <!-- Bloque inferior: estadísticas y botón DINÁMICO -->
        <div class="flex flex-col items-center w-full mt-[32px]">

            <!-- Estadísticas DINÁMICAS desde CSV -->
            <div class="flex flex-col lg:flex-row justify-center lg:justify-between items-center w-full max-w-[375px] lg:max-w-[1000px] gap-[40px] lg:gap-0">

                <!-- Personas (desde CSV) -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html(formatear_numero($estadisticas['personas'])); ?>
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Personas
                    </span>
                </div>

                <!-- Ciudades (desde CSV) + Botón en desktop -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($estadisticas['ciudades']); ?>
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Ciudades
                    </span>
                </div>

                <!-- Países (desde CSV) -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        <?php echo esc_html($estadisticas['paises']); ?>
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Países
                    </span>
                </div>
            </div>

            <!-- Botón SOLO en desktop, debajo de Ciudades -->
            <a href="<?php echo esc_url($que_hacer_url_boton); ?>"
                style="margin-left: 80px;" 
                class="hidden lg:flex mt-[32px] w-[221px] h-[48px] justify-center items-center rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Conoce como apoyar
            </a>

            <!-- Botón SOLO en mobile, centrado abajo -->
            <a href="<?php echo esc_url($que_hacer_url_boton); ?>"
                class="lg:hidden mt-[40px] flex w-full max-w-[375px] h-[48px] justify-center items-center rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Conoce cómo apoyar
            </a>
        </div>

    </div>
</section>