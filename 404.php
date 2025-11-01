<?php get_header(); ?>

<main>
    <div class="container">
        <article>
            <h1>Error 404 - Página no encontrada</h1>
            <p>Lo sentimos, la página que buscas no existe.</p>
            
            <div class="search-404">
                <p>Intenta buscar lo que necesitas:</p>
                <?php get_search_form(); ?>
            </div>
            
            <div class="back-home">
                <a href="<?php echo home_url(); ?>">Volver al inicio</a>
            </div>
        </article>
    </div>
</main>

<?php get_footer(); ?>