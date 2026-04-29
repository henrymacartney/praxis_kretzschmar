<?php
/**
 * Default template for any standalone page.
 *
 * @package PraxisBase
 */

get_header();
?>

    <main id="main" class="site-main flex-1 py-16">
        <div class="mx-auto max-w-3xl px-6">
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <h1 class="text-3xl md:text-4xl font-medium tracking-tight mb-8"><?php the_title(); ?></h1>
                    <div class="prose prose-stone max-w-none">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </main>

<?php
get_footer();