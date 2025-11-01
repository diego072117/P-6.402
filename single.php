<?php get_header(); ?>

<main>
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article>
                    <h1><?php the_title(); ?></h1>
                    
                    <div class="post-meta">
                        <span>Publicado el: <?php echo get_the_date(); ?></span>
                        <span>Por: <?php the_author(); ?></span>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <div class="post-categories">
                        <?php the_category(', '); ?>
                    </div>
                </article>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>