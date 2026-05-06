<?php
/**
 * Template Name: Kontakt
 *
 * Page template for the Kontakt page. Reads ACF fields from the
 * "Kontakt" field group and renders: hero, optional lead image,
 * optional intro, two-column Adresse/Anfahrt block, and an
 * optional contact form rendered via Contact Form 7 shortcode.
 *
 * The form shortcode is held in an ACF field rather than hardcoded
 * here so the form ID can be changed (or the form removed) without
 * editing the template.
 *
 * @package PraxisBase
 */

get_header();

$tagline        = get_field( 'kontakt_tagline' );
$lead_image     = get_field( 'kontakt_lead_image' );
$intro          = get_field( 'kontakt_intro' );
$adresse        = get_field( 'kontakt_adresse' );
$anfahrt        = get_field( 'kontakt_anfahrt' );
$form_shortcode = get_field( 'kontakt_form_shortcode' );

$has_two_column = ! empty( $adresse ) && ! empty( $anfahrt );
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

        <?php if ( $lead_image && is_array( $lead_image ) ) : ?>
            <section class="bg-cream-50">
                <div class="mx-auto max-w-5xl px-6 pb-12 md:pb-16">
                    <img
                        src="<?php echo esc_url( $lead_image['sizes']['large'] ?? $lead_image['url'] ); ?>"
                        alt="<?php echo esc_attr( $lead_image['alt'] ?: get_the_title() ); ?>"
                        class="w-full max-h-[28rem] object-cover"
                        loading="lazy"
                    />
                </div>
            </section>
        <?php endif; ?>

        <?php if ( $intro ) : ?>
            <section class="py-12 md:py-16 bg-cream-100 border-y border-cream-200">
                <div class="mx-auto max-w-3xl px-6">
                    <div class="font-sans text-base md:text-lg leading-relaxed text-stone-800 prose prose-stone max-w-none">
                        <?php echo wp_kses_post( $intro ); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ( $adresse || $anfahrt ) : ?>
            <section class="py-12 md:py-16 bg-cream-50">
                <div class="mx-auto max-w-5xl px-6">
                    <div class="grid grid-cols-1 <?php echo $has_two_column ? 'md:grid-cols-2' : ''; ?> gap-12">

                        <?php if ( $adresse ) : ?>
                            <div>
                                <h2 class="font-display text-2xl md:text-3xl text-navy-800 mb-4">
                                    Adresse
                                </h2>
                                <div class="font-sans text-base leading-relaxed text-stone-800 prose prose-stone max-w-none">
                                    <?php echo wp_kses_post( $adresse ); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( $anfahrt ) : ?>
                            <div>
                                <h2 class="font-display text-2xl md:text-3xl text-navy-800 mb-4">
                                    Anfahrt
                                </h2>
                                <div class="font-sans text-base leading-relaxed text-stone-800 prose prose-stone max-w-none">
                                    <?php echo wp_kses_post( $anfahrt ); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ( $form_shortcode ) : ?>
            <section class="py-12 md:py-16 bg-cream-100 border-y border-cream-200">
                <div class="mx-auto max-w-2xl px-6">
                    <h2 class="font-display text-2xl md:text-3xl text-navy-800 mb-6 text-center">
                        Nachricht senden
                    </h2>
                    <div class="kontakt-form font-sans">
                        <?php echo do_shortcode( $form_shortcode ); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    </main>

<?php get_footer();