<?php
/**
 * Template Name: Leistungen Übersicht
 *
 * Overview page that auto-lists child pages (e.g. the four therapy pages)
 * as cards. Pulls title, tagline, and lead image from each child's ACF
 * fields. Self-updating — adding a new child page adds it to the grid.
 *
 * @package PraxisBase
 */

get_header();

$intro = get_the_content();
$page_id = get_the_ID();

$children = get_pages( array(
    'parent'      => $page_id,
    'sort_column' => 'menu_order,post_title',
    'sort_order'  => 'ASC',
    'post_status' => 'publish',
) );
?>

    <main id="main" class="site-main flex-1">

        <section class="py-16 md:py-24 bg-cream-50">
            <div class="mx-auto max-w-3xl px-6 text-center">
                <h1 class="font-display text-4xl md:text-5xl font-medium tracking-tight text-navy-800 mb-4 leading-tight">
                    <?php the_title(); ?>
                </h1>
                <?php if ( $intro ) : ?>
                    <div class="font-sans text-base md:text-lg text-stone-800 leading-relaxed mt-6 prose prose-stone max-w-none mx-auto">
                        <?php echo apply_filters( 'the_content', $intro ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <?php if ( ! empty( $children ) ) : ?>
            <section class="py-12 md:py-16 bg-cream-100 border-y border-cream-200">
                <div class="mx-auto max-w-6xl px-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach ( $children as $child ) :
                        $child_id      = $child->ID;
                        $child_title   = get_the_title( $child_id );
                        $child_link    = get_permalink( $child_id );
                        $child_tagline = get_field( 'leistung_tagline', $child_id );
                        $child_image   = get_field( 'leistung_lead_image', $child_id );
                        ?>
                        <a href="<?php echo esc_url( $child_link ); ?>"
                           class="group block bg-cream-50 border border-cream-200 hover:border-navy-300 transition-colors overflow-hidden">
                            <?php if ( $child_image && is_array( $child_image ) ) : ?>
                                <div class="aspect-[4/3] overflow-hidden bg-cream-100">
                                    <img
                                        src="<?php echo esc_url( $child_image['sizes']['medium_large'] ?? $child_image['url'] ); ?>"
                                        alt="<?php echo esc_attr( $child_image['alt'] ?: $child_title ); ?>"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    />
                                </div>
                            <?php endif; ?>
                            <div class="p-6 md:p-8">
                                <h2 class="font-display text-2xl md:text-3xl text-navy-800 group-hover:text-navy-900 mb-3">
                                    <?php echo esc_html( $child_title ); ?>
                                </h2>
                                <?php if ( $child_tagline ) : ?>
                                    <p class="font-sans text-base text-stone-700 leading-relaxed">
                                        <?php echo esc_html( $child_tagline ); ?>
                                    </p>
                                <?php endif; ?>
                                <div class="mt-4 inline-flex items-center font-sans text-sm tracking-wide uppercase text-navy-600 group-hover:text-navy-900 border-b border-transparent group-hover:border-navy-400 pb-1">
                                    Mehr erfahren →
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <section class="py-10 bg-navy-800 text-cream-50 text-center">
            <div class="mx-auto max-w-3xl px-6">
                <a href="<?php echo esc_url( home_url( '/termine/' ) ); ?>"
                   class="inline-block font-sans text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">
                    Termin vereinbaren
                </a>
            </div>
        </section>

    </main>

<?php get_footer();