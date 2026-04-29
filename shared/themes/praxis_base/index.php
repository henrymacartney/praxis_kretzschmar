<?php
/**
 * Fallback template.
 *
 * WordPress uses index.php as the catch-all when no more specific template
 * matches the current request. We rarely hit it, but it must exist.
 *
 * @package PraxisBase
 */

get_header();
?>
    <main id="main" class="site-main py-12">
        <div class="mx-auto max-w-3xl px-4">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'mb-12' ); ?>>
                        <h1 class="text-3xl font-medium mb-4"><?php the_title(); ?></h1>
                        <div class="prose"><?php the_content(); ?></div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Keine Inhalte gefunden.</p>
            <?php endif; ?>
        </div>
    </main>
<?php
get_footer();