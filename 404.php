<?php
/**
 * Template: 404 - Página no encontrada
 */
get_header();
?>

<style>
  /* Ajuste dinámico de altura total menos el header */
  main#not-found {
    min-height: calc(100vh - 160.69px);
    overflow: hidden;
  }
</style>

<main id="not-found"
      class="flex flex-col items-center justify-center text-center bg-cover bg-center bg-no-repeat px-6"
      style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image1.png');">

    <section class="flex flex-col items-center justify-center w-full max-w-[900px]">
        <h1 class="font-display text-[#A13E18] text-[64px] md:text-[96px] font-extrabold uppercase leading-[90%] mb-[40px]">
            PÁGINA<br>NO ENCONTRADA<br>
            <span class="text-[72px] md:text-[96px] block mt-[10px]">404</span>
        </h1>

        <a href="<?php echo esc_url(home_url('/home/')); ?>"
           class="font-[Montserrat] text-[18px] font-medium text-black underline hover:text-[#A13E18] transition-colors duration-300">
           Volver a inicio
        </a>
    </section>
</main>
