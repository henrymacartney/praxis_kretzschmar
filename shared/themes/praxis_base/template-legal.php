<?php
/**
 * Template Name: Legal Page
 *
 * Shared page template for legally-required pages: Impressum,
 * Datenschutzerklärung, and similar. These pages are prose-only —
 * no images, no structured fields, no CTAs. Just the page title
 * and a single column of body content rendered from the editor.
 *
 * Uses standard WordPress the_content() so the page can be edited
 * with the classic editor or block editor without theme changes.
 *
 * @package PraxisBase
 */

get_header();
?>

    <main id="main" class="site-main flex-1">

        <section class="py-16 md:py-20 bg-cream-50">
            <div class="mx-auto max-w-3xl px-6 text-center">
                <h1 class="font-display text-3xl md:text-4xl font-medium tracking-tight text-navy-800 leading-tight">
                    <?php the_title(); ?>
                </h1>
            </div>
        </section>

        <section class="py-12 md:py-16 bg-cream-50">
            <div class="mx-auto max-w-3xl px-6">
                <div class="font-sans text-base leading-relaxed text-stone-800 prose prose-stone max-w-none">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </section>

    </main>

<?php get_footer();