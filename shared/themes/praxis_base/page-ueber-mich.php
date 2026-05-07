<?php
/**
 * Template for the "Über mich" page.
 *
 * Triggered automatically by WordPress when the page slug is "ueber-mich".
 * Reads ACF fields and renders the structured layout.
 *
 * @package PraxisBase
 */

get_header();

$tagline        = get_field( 'ueber_mich_tagline' );
$portrait       = get_field( 'ueber_mich_portrait' );
$bio            = get_field( 'ueber_mich_bio' );
$qualifications = get_field( 'ueber_mich_qualifikationen' );
$werdegang      = get_field( 'ueber_mich_werdegang' );
?>

    <main id="main" class="site-main flex-1">

        <section class="py-16 md:py-24 bg-cream-50">
            <div class="mx-auto max-w-3xl px-6 text-center">
                <h1 class="font-display text-4xl md:text-5xl font-medium tracking-tight text-navy-800 mb-4 leading-tight">
                    <?php the_title(); ?>
                </h1>
                <?php if ( $tagline ) : ?>
                    <p class="font-sans text-base md:text-lg text-navy-600">
                        <?php echo esc_html( $tagline ); ?>
                    </p>
                <?php endif; ?>
            </div>
        </section>

        <section class="py-12 md:py-16 bg-cream-100 border-y border-cream-200">
            <div class="mx-auto max-w-5xl px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

                <?php if ( $portrait && is_array( $portrait ) ) : ?>
                    <div>
                        <img
                            src="<?php echo esc_url( $portrait['sizes']['large'] ?? $portrait['url'] ); ?>"
                            alt="<?php echo esc_attr( $portrait['alt'] ?: get_the_title() ); ?>"
                            class="w-full h-auto"
                            loading="lazy"
                        />
                    </div>
                <?php endif; ?>

                <?php if ( $bio ) : ?>
                    <div class="font-sans text-base md:text-lg leading-relaxed text-stone-800 prose prose-stone max-w-none">
                        <?php echo wp_kses_post( $bio ); ?>
                    </div>
                <?php endif; ?>

            </div>
        </section>

        <?php if ( $qualifications && is_array( $qualifications ) && count( $qualifications ) > 0 ) : ?>
            <section class="py-12 md:py-16 bg-cream-50">
                <div class="mx-auto max-w-3xl px-6">
                    <h2 class="font-display text-3xl font-medium text-navy-800 mb-8 text-center">
                        Qualifikationen
                    </h2>
                    <ul class="font-sans space-y-4">
                        <?php foreach ( $qualifications as $row ) : ?>
                            <li class="border-b border-cream-200 pb-4 last:border-0">
                                <div class="text-navy-800 font-medium">
                                    <?php echo esc_html( $row['bezeichnung'] ?? '' ); ?>
                                </div>
                                <?php if ( ! empty( $row['detail'] ) ) : ?>
                                    <div class="text-stone-600 text-sm mt-1">
                                        <?php echo esc_html( $row['detail'] ); ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        <?php endif; ?>

        <?php if ( $werdegang ) : ?>
            <section class="py-12 md:py-16 bg-cream-100 border-t border-cream-200">
                <div class="mx-auto max-w-3xl px-6">
                    <h2 class="font-display text-3xl font-medium text-navy-800 mb-6">
                        Werdegang
                    </h2>
                    <div class="font-sans text-base md:text-lg leading-relaxed text-stone-800 prose prose-stone max-w-none">
                        <?php echo wp_kses_post( $werdegang ); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="py-10 bg-navy-800 text-cream-50 text-center">
            <div class="mx-auto max-w-3xl px-6">
				<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"
	               class="inline-block font-sans text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">
					Kontakt aufnehmen
				</a>
               <!-- <a href="<?php /*echo esc_url( home_url( '/termine/' ) ); */?>"
                   class="inline-block font-sans text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">
                    Termin vereinbaren
                </a>-->
            </div>
        </section>

    </main>

<?php get_footer();