<?php get_header(); ?>

<!-- Hero Banner Principal -->
<section class="min-h-[550px] md:h-[400px] lg:h-[550px] flex-shrink-0 bg-center bg-cover bg-no-repeat py-12 lg:py-0"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/image1.png');">

    <div class="container mx-auto px-[30px] sm:px-[60px] md:px-[90px] lg:px-[60px] xl:px-[120px] h-full">
        <div class="flex flex-col lg:flex-row items-center justify-center lg:justify-start h-full gap-6 lg:gap-[20px] xl:gap-[24px]">

            <!-- Columna Izquierda - Texto -->
            <div class="flex flex-col justify-center items-center lg:items-start w-full lg:w-[450px] xl:w-[532px] max-w-[315px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-none flex-shrink-0 gap-6 lg:gap-[28px] xl:gap-[33.44px]">
                <!-- Descripción -->
                <p class="self-stretch:text-left text-black font-sans text-[16px] md:text-[17px] lg:text-[16px] xl:text-[18px] not-italic font-medium leading-[24px]"
                    style="font-feature-settings: 'liga' off, 'clig' off;">
                    Buscamos justicia para las 6.402 personas asesinadas y presentadas como falsas muertes en combate por el Ejército de Colombia.
                </p>

                <!-- Título principal -->
                <h1 class="self-stretch lg:text-left font-sans text-[28px] md:text-[34px] lg:text-[32px] xl:text-[40px] not-italic font-bold leading-[36px] md:leading-[44px] lg:leading-[44px] xl:leading-[52px]">
                    <span class="text-[#A13E18]">¡Si nos unimos,</span>
                    <span class="text-black"> todxs conoceremos la verdad!</span>
                </h1>
            </div>

            <!-- Columna Derecha - Contador -->
            <div class="flex flex-col w-full lg:w-[500px] xl:w-[605.237px] max-w-[315px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-none gap-4 lg:gap-0">
                <!-- Card con contador -->
                <div class="flex w-full h-[144.19px] md:h-[200px] lg:h-[240px] xl:h-[266.877px] p-[16px] md:p-[24px] lg:p-[24px] xl:p-[29.614px] flex-col justify-center items-center gap-[16px] md:gap-[20px] lg:gap-[24px] xl:gap-[29.614px] flex-shrink-0
                            rounded-[18.509px] border-[1.851px] border-[#D1D9E2]
                            backdrop-blur-[2px] shadow-sm"
                    style="background: rgba(150, 150, 150, 0.3); background-blend-mode: multiply;">

                    <!-- Ya somos -->
                    <div class="flex flex-row gap-[8px] md:gap-[12px] lg:gap-[12px] xl:gap-[15px] self-stretch">
                        <span class="text-black font-sans text-[19.45px] md:text-[28px] lg:text-[30px] xl:text-[36px] not-italic font-medium"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Ya somos
                        </span>
                        <span class="text-black font-sans text-[34.57px] md:text-[50px] lg:text-[54px] xl:text-[64px] not-italic font-bold"
                            style="line-height: 12.967px;">
                            4.409
                        </span>
                    </div>

                    <!-- Barra de progreso -->
                    <div class="relative flex items-center self-stretch h-[8px] md:h-[12px] lg:h-[12px] xl:h-[14.807px] rounded-[9.254px] bg-[#D1D9E2]">
                        <!-- Línea de progreso -->
                        <div class="absolute left-0 h-[8px] md:h-[12px] lg:h-[12px] xl:h-[14.807px] bg-[#A13E18]"
                            style="width: 68.8%; border-radius: 9.254px 0 0 9.254px;"></div>

                        <!-- Punto de control -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ControlPoint.svg"
                            alt="Control Point"
                            class="absolute w-[20px] md:w-[30px] lg:w-[32px] xl:w-[37.02px] h-[20px] md:h-[30px] lg:h-[32px] xl:h-[37.02px] z-10"
                            style="left: 68.8%; transform: translateX(-50%);" />
                    </div>

                    <!-- Ayúdanos a llegar a 6.402 Antes de noviembre - TODO EN UNA LÍNEA -->
                    <div class="flex flex-row items-center justify-center gap-[8px] md:gap-[20px] lg:gap-[24px] xl:gap-[30px] self-stretch text-center">
                        <span class="text-black font-sans text-[9.725px] md:text-[14px] lg:text-[15px] xl:text-[18px] not-italic font-medium whitespace-nowrap"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Ayúdanos a llegar a
                        </span>
                        <span class="text-black font-sans text-[21px] md:text-[30px] lg:text-[34px] xl:text-[40px] not-italic font-bold"
                            style="line-height: 12.967px;">
                            6.402
                        </span>
                        <span class="text-black font-sans text-[9.725px] md:text-[14px] lg:text-[15px] xl:text-[18px] not-italic font-medium whitespace-nowrap"
                            style="line-height: 12.967px; font-feature-settings: 'liga' off, 'clig' off;">
                            Antes de noviembre
                        </span>
                    </div>

                    <!-- Botón "Apoyar" - SOLO DESKTOP (dentro del card, alineado a la izquierda) -->
                    <div class="hidden lg:flex self-stretch">
                        <button class="bg-[#9B3B0A] text-white font-bold px-8 py-3 rounded-md hover:bg-[#7d2f08] transition mt-2">
                            Apoyar
                        </button>
                    </div>
                </div>

                <!-- Botón "Apoya con tu firma" - SOLO MOBILE (fuera del card) -->
                <button class="lg:hidden w-full bg-[#A13E18] text-white font-bold text-[16px] px-8 py-4 rounded-[6px] hover:bg-[#7d2f08] transition">
                    Apoya con tu firma
                </button>
            </div>

        </div>
    </div>
</section>

<!-- Sección Conoce Más -->
<section class="flex flex-col lg:flex-row mt-[60px] lg:mt-[180px] items-center justify-center lg:gap-[50px] overflow-visible px-[30px] lg:px-0">

    <!-- Título Mobile -->
    <div class="lg:hidden w-full max-w-[287px] sm:max-w-[287px] md:max-w-[500px] mb-8">
        <h2 class="leading-[40px] font-display font-bold tracking-tight uppercase text-left">
            <span class="block text-[48px] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                CONOCE MÁS
            </span>
            <span class="block text-[48px] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                SOBRE NOSOTROS
            </span>
        </h2>
    </div>

    <!-- Columna Izquierda - Imagen -->
    <div class="w-full sm:w-full sm:max-w-none md:max-w-[500px] lg:max-w-[620px] h-[306px] sm:h-[450px] md:h-[550px] lg:h-[650px] flex-shrink-0 lg:-mr-[150px] flex items-center justify-center mb-[-23px] lg:mb-0 self-stretch overflow-hidden">
        <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-image2-nw.png"
            alt="Justicia para las 6402"
            class="w-full h-full object-contain scale-120 sm:scale-100 lg:scale-120"
            style="box-shadow: 0 -8px 20px 0 rgba(144, 144, 144, 0.02);">
    </div>

    <!-- Columna Derecha - Contenido -->
    <div
        class="relative z-20 flex w-full sm:max-w-[400px] md:max-w-[500px] lg:max-w-none lg:w-[633px] lg:h-[574px] p-[32px] sm:p-[40px] md:p-[56px] lg:p-[72px] flex-col items-start gap-[24px] flex-shrink-0"
        style="
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-image3.png');
    background-position: right bottom;
    background-size: 200% 100%;
    background-repeat: no-repeat;
  ">
        <!-- Título principal (solo visible en desktop) -->
        <h2 class="hidden lg:block leading-[55.2px] font-display font-bold tracking-tight uppercase">
            <span class="block text-[48px] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">
                CONOCE MÁS
            </span>
            <span class="block text-[48px] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">
                SOBRE NOSOTROS
            </span>
        </h2>

        <!-- Descripción -->
        <p
            class="self-stretch text-black font-[Montserrat] text-[16px] sm:text-[18px] not-italic font-medium leading-[24px]"
            style="font-feature-settings: 'liga' off, 'clig' off;">
            Cansadas de esperar a la justicia colombiana, víctimas y organizaciones de derechos humanos acudieron a la justicia universal en Argentina. En noviembre de 2023, se interpuso una querella (denuncia) para esclarecer la responsabilidad de Uribe Vélez en las ejecuciones extrajudiciales (mal llamados “falsos positivos”) durante su mandato. Sin embargo, no ha habido avances significativos ni apertura formal de la investigación.
        </p>

        <!-- Botón (solo visible en desktop) -->
        <button
            class="hidden lg:flex justify-center items-center gap-[10px] w-[170px] px-[32px] py-[16px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold text-[16px] leading-[20px] hover:bg-[#7d2f08] transition mt-[12px]">
            Conoce más
        </button>
    </div>

    <!-- Botón externo (solo visible en mobile y tablet) -->
    <div class="flex lg:hidden justify-center mt-[24px] w-full">
        <button
            class="flex justify-center items-center gap-[10px] w-full max-w-[400px] sm:max-w-[450px] h-[56px] rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold text-[16px] leading-[20px] hover:bg-[#7d2f08] transition px-[32px]">
            Conoce más
        </button>
    </div>




</section>

<!-- Sección Slider - Qué está pasando -->
<section class="mt-[60px] lg:mt-[180px] bg-white">
    <!-- Contenedor general -->
    <div class="relative flex justify-center items-center w-full max-w-[1151px] mx-auto">

        <!-- Flecha Izquierda -->
        <button
            id="arrow-left"
            class="hidden lg:flex absolute left-[-80px] top-1/2 -translate-y-1/2 z-10 w-[68px] h-[68px] items-center justify-center transition drop-shadow-md"
            aria-label="Anterior">
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-left.svg"
                alt="Flecha izquierda"
                class="w-[68px] h-[68px]" />
        </button>

        <!-- Wrapper del slider -->
        <div id="slider-wrapper" class="overflow-hidden w-full px-0 md:px-6">
            <!-- Contenedor de slides -->
            <div id="slider-container" class="flex justify-start gap-0 md:gap-6 transition-transform duration-500 ease-in-out">

                <!-- Card 1 -->
                <div
                    id="slide-1"
                    class="slide flex min-w-full md:min-w-[375px] w-full md:w-[375px] flex-col justify-start items-center gap-6 flex-shrink-0 bg-[#F8F8F8] rounded-[6px] shadow-sm p-[60px_30px]">
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/img-slider1.png"
                        alt="Qué está pasando 1"
                        class="h-[254px] self-stretch object-contain" />
                    <h3 class="self-stretch text-left leading-[48px] font-display font-bold tracking-tight uppercase">
                        <span class="block text-[48px] text-[#000000]">QUÉ ESTÁ</span>
                        <span class="block text-[48px] text-[#EAA40C]">PASANDO?</span>
                    </h3>
                    <p class="self-stretch text-[#000000] text-[16px] font-[500] leading-[24px] font-[Montserrat] text-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate
                        libero et velit interdum, ac aliquet odio mattis...
                    </p>
                    <button
                        class="flex w-full md:w-[315px] justify-center items-center gap-[10px] px-[32px] py-[12px] rounded-[5px] bg-[#EAA40C] text-black font-bold transition hover:bg-[#d28f00]">
                        Leer más
                    </button>
                </div>

                <!-- Card 2 -->
                <div
                    id="slide-2"
                    class="slide flex min-w-full md:min-w-[375px] w-full md:w-[375px] flex-col justify-start items-center gap-6 flex-shrink-0 bg-[#F8F8F8] rounded-[6px] shadow-sm p-[60px_30px]">
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/img-slider2.png"
                        alt="Qué está pasando 2"
                        class="h-[254px] self-stretch object-contain" />
                    <h3 class="self-stretch text-left leading-[48px] font-display font-bold tracking-tight uppercase">
                        <span class="block text-[48px] text-[#000000]">QUÉ ESTÁ</span>
                        <span class="block text-[48px] text-[#EAA40C]">PASANDO?</span>
                    </h3>
                    <p class="self-stretch text-[#000000] text-[16px] font-[500] leading-[24px] font-[Montserrat] text-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate
                        libero et velit interdum, ac aliquet odio mattis...
                    </p>
                    <button
                        class="flex w-full md:w-[315px] justify-center items-center gap-[10px] px-[32px] py-[12px] rounded-[5px] bg-[#EAA40C] text-black font-bold transition hover:bg-[#d28f00]">
                        Leer más
                    </button>
                </div>

                <!-- Card 3 -->
                <div
                    id="slide-3"
                    class="slide flex min-w-full md:min-w-[375px] w-full md:w-[375px] flex-col justify-start items-center gap-6 flex-shrink-0 bg-[#F8F8F8] rounded-[6px] shadow-sm p-[60px_30px]">
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/img-slider3.png"
                        alt="Qué está pasando 3"
                        class="h-[254px] self-stretch object-contain" />
                    <h3 class="self-stretch text-left leading-[48px] font-display font-bold tracking-tight uppercase">
                        <span class="block text-[48px] text-[#000000]">QUÉ ESTÁ</span>
                        <span class="block text-[48px] text-[#EAA40C]">PASANDO?</span>
                    </h3>
                    <p class="self-stretch text-[#000000] text-[16px] font-[500] leading-[24px] font-[Montserrat] text-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate
                        libero et velit interdum, ac aliquet odio mattis...
                    </p>
                    <button
                        class="flex w-full md:w-[315px] justify-center items-center gap-[10px] px-[32px] py-[12px] rounded-[5px] bg-[#EAA40C] text-black font-bold transition hover:bg-[#d28f00]">
                        Leer más
                    </button>
                </div>

            </div>
        </div>

        <!-- Flecha Derecha -->
        <button
            id="arrow-right"
            class="hidden lg:flex absolute right-[-80px] top-1/2 -translate-y-1/2 z-10 w-[68px] h-[68px] items-center justify-center transition drop-shadow-md"
            aria-label="Siguiente">
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-right.svg"
                alt="Flecha derecha"
                class="w-[68px] h-[68px]" />
        </button>

    </div>

    <!-- Indicadores (solo mobile) -->
    <div id="slider-dots" class="flex justify-center items-center gap-2 mt-6 md:hidden"></div>
</section>

<!-- Sección Qué puedo hacer -->
<section class="mt-[60px] lg:mt-[180px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full lg:w-[1151px] flex-col items-center lg:items-start">

        <!-- Bloque superior: título + subtítulo + texto -->
        <div class="flex flex-col items-center lg:items-start gap-[24px] w-full">
            <!-- Título -->
            <h2 class="flex flex-col lg:flex-row leading-[48px] font-display font-bold tracking-tight uppercase w-full text-left">
                <span
                    class="text-[36px] lg:text-[48px] text-[#000000] lg:mr-[8px]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; font-weight: 700; line-height: 100%;">
                    QUÉ PUEDO
                </span>
                <span
                    class="text-[36px] lg:text-[48px] text-[#A13E18]"
                    style="font-feature-settings: 'liga' off, 'clig' off; font-style: normal; font-weight: 700; line-height: 100%;">
                    HACER?
                </span>
            </h2>

            <!-- Subtítulo -->
            <h3
                class="text-negro font-[Montserrat] text-[18px] lg:text-[20px] font-bold leading-[24px] text-left w-full"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                Lucha por la verdad y justicia de todxs
            </h3>

            <!-- Texto apoyo -->
            <p
                class="text-negro font-[Montserrat] text-[14px] lg:text-[16px] font-medium leading-[24px] text-left w-full"
                style="font-feature-settings: 'liga' off, 'clig' off;">
                Contamos con apoyo de:
            </p>
        </div>

        <!-- Bloque inferior: estadísticas y botón -->
        <div class="flex flex-col items-center w-full mt-[32px]">
            <!-- Estadísticas -->
            <div class="flex flex-col lg:flex-row justify-center lg:justify-between items-center w-full max-w-[375px] lg:max-w-[1000px] gap-[40px] lg:gap-0">
                <!-- 200k Personas -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        200k
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Personas
                    </span>
                </div>

                <!-- 35 Ciudades (con botón debajo en desktop) -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        35
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Ciudades
                    </span>

                    <!-- Botón SOLO en desktop, debajo de Ciudades -->
                    <button
                        class="hidden lg:flex mt-[32px] w-[221px] h-[48px] justify-center items-center rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                        Conoce cómo apoyar
                    </button>
                </div>

                <!-- 28 Países -->
                <div class="flex flex-col items-center gap-[10px]">
                    <span
                        class="text-[#A13E18] font-[Montserrat] text-[64px] lg:text-[96px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        28
                    </span>
                    <span
                        class="text-negro font-[Montserrat] text-[32px] lg:text-[42px] font-bold leading-[100%]"
                        style="font-feature-settings: 'liga' off, 'clig' off;">
                        Países
                    </span>
                </div>
            </div>

            <!-- Botón SOLO en mobile, centrado abajo -->
            <button
                class="lg:hidden mt-[40px] flex w-full max-w-[375px] h-[48px] justify-center items-center rounded-[6px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Conoce cómo apoyar
            </button>
        </div>

    </div>
</section>

<!-- Sección Historias de las víctimas -->
<section class="mt-[60px] lg:mt-[180px] bg-white flex justify-center px-[30px] lg:px-0">
    <div class="flex w-full lg:w-[1153px] flex-col items-start gap-8">

        <!-- Título -->
        <h2 class="leading-[40px] lg:leading-[48px] font-display font-bold tracking-tight uppercase text-left w-full">
            <span class="block lg:inline text-[36px] lg:text-[48px] text-negro" style="font-feature-settings: 'liga' off, 'clig' off;">HISTORIAS DE </span>
            <span class="block lg:inline text-[36px] lg:text-[48px] text-[#A13E18]" style="font-feature-settings: 'liga' off, 'clig' off;">LAS VÍCTIMAS</span>
        </h2>

        <!-- Wrapper del carrusel (mobile) / Grid (desktop) -->
        <div class="w-full">
            <!-- Mobile: Carrusel -->
            <div id="historias-slider-wrapper" class="overflow-hidden w-full lg:hidden">
                <div id="historias-slider-container" class="flex gap-0 transition-transform duration-500 ease-in-out">

                    <!-- Card 1 -->
                    <div class="historias-slide flex min-w-full w-full flex-col justify-between items-start bg-[#F5F5F5] rounded-lg p-[32px] h-[455px]">
                        <div class="flex flex-col items-start gap-[24px] self-stretch">
                            <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                            <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                                Lorem ipsum consectetur
                            </h3>
                            <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,
                            </p>
                        </div>
                        <button class="flex w-full h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                            Ver historia
                        </button>
                    </div>

                    <!-- Card 2 -->
                    <div class="historias-slide flex min-w-full w-full flex-col justify-between items-start bg-[#F5F5F5] rounded-lg p-[32px] h-[455px]">
                        <div class="flex flex-col items-start gap-[24px] self-stretch">
                            <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                            <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                                Lorem ipsum consectetur
                            </h3>
                            <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,
                            </p>
                        </div>
                        <button class="flex w-full h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                            Ver historia
                        </button>
                    </div>

                    <!-- Card 3 -->
                    <div class="historias-slide flex min-w-full w-full flex-col justify-between items-start bg-[#F5F5F5] rounded-lg p-[32px] h-[455px]">
                        <div class="flex flex-col items-start gap-[24px] self-stretch">
                            <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                            <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                                Lorem ipsum consectetur
                            </h3>
                            <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,
                            </p>
                        </div>
                        <button class="flex w-full h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                            Ver historia
                        </button>
                    </div>

                </div>
            </div>

            <!-- Desktop: Grid de 3 cards -->
            <div class="hidden lg:flex gap-6 w-full">
                <!-- Card 1 Desktop -->
                <div class="flex w-[352px] h-[455px] p-[32px] flex-col justify-between items-start bg-[#F5F5F5] rounded-lg">
                    <div class="flex flex-col items-start gap-[24px] self-stretch">
                        <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                        <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                            Lorem ipsum consectetur
                        </h3>
                        <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,
                        </p>
                    </div>
                    <button class="flex w-[288px] h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                        Leer historia
                    </button>
                </div>

                <!-- Card 2 Desktop -->
                <div class="flex w-[352px] h-[455px] p-[32px] flex-col justify-between items-start bg-[#F5F5F5] rounded-lg">
                    <div class="flex flex-col items-start gap-[24px] self-stretch">
                        <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                        <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                            Lorem ipsum consectetur
                        </h3>
                        <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,
                        </p>
                    </div>
                    <button class="flex w-[288px] h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                        Leer historia
                    </button>
                </div>

                <!-- Card 3 Desktop -->
                <div class="flex w-[352px] h-[455px] p-[32px] flex-col justify-between items-start bg-[#F5F5F5] rounded-lg">
                    <div class="flex flex-col items-start gap-[24px] self-stretch">
                        <div class="w-[54px] h-[54px] rounded-full bg-gray-400"></div>
                        <h3 class="text-negro font-[Montserrat] text-[24px] font-bold leading-[28px]">
                            Lorem ipsum consectetur
                        </h3>
                        <p class="text-negro font-[Montserrat] text-[18px] font-medium leading-[24px]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum,
                        </p>
                    </div>
                    <button class="flex w-[288px] h-[56px] px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#EAA40C] text-negro font-[Montserrat] font-bold hover:bg-[#d28f00] transition">
                        Leer historia
                    </button>
                </div>
            </div>
        </div>

        <!-- Indicadores (solo mobile) -->
        <div id="historias-slider-dots" class="flex justify-center items-center gap-2 w-full lg:hidden"></div>

        <!-- Botón ver más historias -->
        <div class="flex justify-center w-full">
            <button class="flex w-full lg:w-auto px-8 py-3 justify-center items-center gap-[10px] rounded-[5px] bg-[#A13E18] text-white font-[Montserrat] font-bold hover:bg-[#7d2f08] transition">
                Leer más historias
            </button>
        </div>

    </div>
</section>

<?php get_footer(); ?>