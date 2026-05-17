<?php
/**
 * Front page — Alex Kretzschmar.
 *
 * Five-band landing page, content driven entirely by ACF fields:
 *   1. Hero        — full-bleed faded B/W background, headline, sub, two CTAs
 *   2. Leistungen  — 6-card grid, inline-SVG icons, links to /leistungen/{slug}/
 *   3. Über mich   — text + portrait with corner-accent treatment
 *   4. Kontakt CTA — full-width accent-coloured panel, two CTAs
 *   (Footer is rendered by template-parts/site-footer.php via get_footer().)
 *
 * Every band guards on ACF field presence so the template degrades gracefully
 * if ACF is inactive or fields are empty — useful during scaffolding.
 *
 * @package AlexChild
 */

get_header();

// ── Read ACF once at the top to keep the body clean. ─────────────────
// Hero
$hero_bg            = function_exists( 'get_field' ) ? get_field( 'hero_background_image' ) : null;
$hero_headline      = function_exists( 'get_field' ) ? get_field( 'hero_headline' )         : '';
$hero_subheadline   = function_exists( 'get_field' ) ? get_field( 'hero_subheadline' )      : '';
$hero_line3         = function_exists( 'get_field' ) ? get_field( 'hero_line3' )            : '';
$hero_line4         = function_exists( 'get_field' ) ? get_field( 'hero_line4' )            : '';
$hero_cta_primary_label   = function_exists( 'get_field' ) ? get_field( 'hero_cta_primary_label' )   : '';
$hero_cta_primary_url     = function_exists( 'get_field' ) ? get_field( 'hero_cta_primary_url' )     : '';
$hero_cta_secondary_label = function_exists( 'get_field' ) ? get_field( 'hero_cta_secondary_label' ) : '';
$hero_cta_secondary_url   = function_exists( 'get_field' ) ? get_field( 'hero_cta_secondary_url' )   : '';

// Leistungen grid
$leistungen_heading = function_exists( 'get_field' ) ? get_field( 'leistungen_heading' ) : '';
$leistungen_intro   = function_exists( 'get_field' ) ? get_field( 'leistungen_intro' )   : '';
$leistungen_cards   = function_exists( 'get_field' ) ? get_field( 'leistungen_cards' )   : array();

// Über mich band
$ueber_heading  = function_exists( 'get_field' ) ? get_field( 'ueber_heading' )  : '';
$ueber_lead     = function_exists( 'get_field' ) ? get_field( 'ueber_lead' )     : '';
$ueber_body     = function_exists( 'get_field' ) ? get_field( 'ueber_body' )     : '';
$ueber_cta_label = function_exists( 'get_field' ) ? get_field( 'ueber_cta_label' ) : '';
$ueber_cta_url   = function_exists( 'get_field' ) ? get_field( 'ueber_cta_url' )   : '';
$ueber_portrait  = function_exists( 'get_field' ) ? get_field( 'ueber_portrait' )  : null;

// Kontakt CTA band
$kontakt_heading       = function_exists( 'get_field' ) ? get_field( 'kontakt_heading' )       : '';
$kontakt_sub           = function_exists( 'get_field' ) ? get_field( 'kontakt_sub' )           : '';
$kontakt_cta_primary_label   = function_exists( 'get_field' ) ? get_field( 'kontakt_cta_primary_label' )   : '';
$kontakt_cta_primary_url     = function_exists( 'get_field' ) ? get_field( 'kontakt_cta_primary_url' )     : '';
$kontakt_cta_secondary_label = function_exists( 'get_field' ) ? get_field( 'kontakt_cta_secondary_label' ) : '';
$kontakt_cta_secondary_url   = function_exists( 'get_field' ) ? get_field( 'kontakt_cta_secondary_url' )   : '';

/**
 * Resolve an inline-SVG icon by name from /assets/icons/.
 * Returns the SVG markup or an empty string if the file is missing.
 * Sanitised by being read from a known path under the theme.
 */
$render_icon = function ( $name ) {
    if ( ! $name ) {
        return '';
    }
    // Whitelist: only allow kebab-case alphanumerics; defends path traversal.
    if ( ! preg_match( '/^[a-z0-9\-]+$/', $name ) ) {
        return '';
    }
    $path = ALEX_CHILD_DIR . '/assets/icons/' . $name . '.svg';
    if ( ! file_exists( $path ) ) {
        return '';
    }
    return file_get_contents( $path );
};
?>

    <main id="main" class="site-main flex-1">

        <!-- ─── 1. Hero band ────────────────────────────────────────── -->
        <section class="hero relative overflow-hidden bg-cream-50 text-cream-50">
            <?php if ( $hero_bg && is_array( $hero_bg ) ) : ?>
                <div
                    class="absolute inset-0 bg-center bg-cover"
                    style="
                        background-image: url('<?php echo esc_url( $hero_bg['sizes']['2048x2048'] ?? $hero_bg['sizes']['large'] ?? $hero_bg['url'] ); ?>');
                        filter: grayscale(100%) brightness(0.55);
                        "
                    aria-hidden="true"
                ></div>
                <!-- Gradient veil for text legibility -->
                <div class="absolute inset-0 bg-gradient-to-b from-cream-50/70 via-cream-50/55 to-cream-50/75" aria-hidden="true"></div>
            <?php endif; ?>

            <!--			<div class="relative mx-auto max-w-4xl px-6 py-32 md:py-44 text-center">-->
            <div class="relative mx-auto max-w-4xl px-6 py-52 md:py-72 text-center">
                <?php if ( $hero_headline ) : ?>
                    <h1 class="font-display text-4xl md:text-6xl font-medium tracking-tight text-navy-800 mb-4 leading-tight">
                        <?php echo esc_html( $hero_headline ); ?>
                    </h1>
                <?php endif; ?>

                <?php if ( $hero_subheadline ) : ?>
                    <p class="font-sans text-xl md:text-2xl font-semibold text-navy-800 leading-snug max-w-3xl mx-auto mb-2">
                        <?php echo esc_html( $hero_subheadline ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $hero_line3 ) : ?>
                    <p class="font-sans text-lg md:text-xl font-semibold text-navy-800 leading-snug max-w-3xl mx-auto mb-2">
                        <?php echo esc_html( $hero_line3 ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $hero_line4 ) : ?>
                    <p class="font-sans text-sm md:text-base text-navy-800 leading-relaxed max-w-2xl mx-auto mb-10">
                        <?php echo esc_html( $hero_line4 ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $hero_cta_primary_label || $hero_cta_secondary_label ) : ?>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <?php if ( $hero_cta_primary_label ) : ?>
                            <a
                                href="<?php echo esc_url( $hero_cta_primary_url ?: home_url( '/kontakt/' ) ); ?>"
                                class="inline-block px-7 py-3 font-sans text-sm tracking-wide uppercase bg-accent-600 text-cream-50 hover:bg-accent-800 transition-colors"
                            >
                                <?php echo esc_html( $hero_cta_primary_label ); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ( $hero_cta_secondary_label ) : ?>
                            <a
                                href="<?php echo esc_url( $hero_cta_secondary_url ?: home_url( '/ueber-mich/' ) ); ?>"
                                class="inline-block px-7 py-3 font-sans text-sm tracking-wide uppercase border border-navy-800 text-navy-800 hover:bg-navy-800 hover:text-cream-50 transition-colors"
                            >
                                <?php echo esc_html( $hero_cta_secondary_label ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- ─── 2. Leistungen grid ──────────────────────────────────── -->
        <?php if ( $leistungen_heading || $leistungen_intro || ( is_array( $leistungen_cards ) && count( $leistungen_cards ) > 0 ) ) : ?>
            <section class="leistungen py-20 md:py-28 bg-cream-50">
                <div class="mx-auto max-w-6xl px-6">

                    <div class="text-center mb-12 md:mb-16">
                        <?php if ( $leistungen_heading ) : ?>
                            <h2 class="font-display text-3xl md:text-4xl font-medium tracking-tight text-navy-800 mb-4">
                                <?php echo esc_html( $leistungen_heading ); ?>
                            </h2>
                            <div class="w-12 h-0.5 bg-accent-600 mx-auto mb-6" aria-hidden="true"></div>
                        <?php endif; ?>

                        <?php if ( $leistungen_intro ) : ?>
                            <p class="font-sans text-lg text-stone-600 max-w-2xl mx-auto leading-relaxed">
                                <?php echo esc_html( $leistungen_intro ); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php if ( is_array( $leistungen_cards ) && count( $leistungen_cards ) > 0 ) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                            <?php foreach ( $leistungen_cards as $card ) : ?>
                                <?php
                                $icon_name   = $card['icon']    ?? '';
                                $card_title  = $card['title']   ?? '';
                                $card_summary = $card['summary'] ?? '';
                                $card_link   = $card['link']    ?? '';
                                // link can be a page-object array (ACF return: object) or URL string
                                if ( is_array( $card_link ) && isset( $card_link['ID'] ) ) {
                                    $card_link_url = get_permalink( $card_link['ID'] );
                                } elseif ( is_numeric( $card_link ) ) {
                                    $card_link_url = get_permalink( $card_link );
                                } else {
                                    $card_link_url = (string) $card_link;
                                }
                                ?>
                                <article class="card bg-white border-t-4 border-accent-600 p-7 shadow-sm hover:shadow-md transition-shadow flex flex-col">
                                    <?php if ( $icon_name ) : ?>
                                        <div class="icon-square w-12 h-12 bg-warm-50 text-accent-600 flex items-center justify-center mb-5" aria-hidden="true">
                                            <?php echo $render_icon( $icon_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — files under our control ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( $card_title ) : ?>
                                        <h3 class="font-display text-xl font-medium text-navy-800 mb-3">
                                            <?php echo esc_html( $card_title ); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if ( $card_summary ) : ?>
                                        <p class="font-sans text-sm text-stone-600 leading-relaxed mb-5 flex-1">
                                            <?php echo esc_html( $card_summary ); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if ( $card_link_url ) : ?>
                                        <a
                                            href="<?php echo esc_url( $card_link_url ); ?>"
                                            class="inline-block font-sans text-xs tracking-wider uppercase text-accent-600 hover:text-accent-800 transition-colors mt-auto"
                                        >
                                            <?php esc_html_e( 'Mehr erfahren', 'alex-child' ); ?> &rarr;
                                        </a>
                                    <?php endif; ?>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </section>
        <?php endif; ?>

        <!-- ─── 3. Über mich band ──────────────────────────────────── -->
        <?php if ( $ueber_heading || $ueber_lead || $ueber_body || $ueber_portrait ) : ?>
            <section class="ueber py-20 md:py-28 bg-cream-100 border-y border-cream-200">
                <div class="mx-auto max-w-6xl px-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">

                        <div class="ueber-text">
                            <?php if ( $ueber_heading ) : ?>
                                <h2 class="font-display text-3xl md:text-4xl font-medium tracking-tight text-navy-800 mb-4">
                                    <?php echo esc_html( $ueber_heading ); ?>
                                </h2>
                                <div class="w-12 h-0.5 bg-accent-600 mb-6" aria-hidden="true"></div>
                            <?php endif; ?>

                            <?php if ( $ueber_lead ) : ?>
                                <p class="font-sans text-lg text-stone-700 leading-relaxed mb-6">
                                    <?php echo esc_html( $ueber_lead ); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ( $ueber_body ) : ?>
                                <div class="font-sans text-base text-stone-600 leading-relaxed prose prose-stone max-w-none mb-8">
                                    <?php echo wp_kses_post( wpautop( $ueber_body ) ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $ueber_cta_label ) : ?>
                                <a
                                    href="<?php echo esc_url( $ueber_cta_url ?: home_url( '/ueber-mich/' ) ); ?>"
                                    class="inline-block px-6 py-3 font-sans text-sm tracking-wide uppercase bg-accent-600 text-cream-50 hover:bg-accent-800 transition-colors"
                                >
                                    <?php echo esc_html( $ueber_cta_label ); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if ( $ueber_portrait && is_array( $ueber_portrait ) ) : ?>
                            <div class="ueber-portrait relative">
                                <!-- Corner accent: top-left red square -->
                                <div class="absolute -top-3 -left-3 w-16 h-16 bg-accent-600 z-0 hidden md:block" aria-hidden="true"></div>
                                <!-- Corner accent: bottom-right navy square -->
                                <div class="absolute -bottom-3 -right-3 w-16 h-16 bg-navy-800 z-0 hidden md:block" aria-hidden="true"></div>
                                <img
                                    src="<?php echo esc_url( $ueber_portrait['sizes']['large'] ?? $ueber_portrait['url'] ); ?>"
                                    alt="<?php echo esc_attr( $ueber_portrait['alt'] ?: 'Dr. Alexander Kretzschmar' ); ?>"
                                    class="relative z-10 w-full h-auto object-cover"
                                    loading="lazy"
                                />
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- ─── 4. Kontakt CTA band ────────────────────────────────── -->
        <?php if ( $kontakt_heading || $kontakt_sub || $kontakt_cta_primary_label || $kontakt_cta_secondary_label ) : ?>
            <section class="kontakt-cta py-16 md:py-20 bg-accent-600 text-cream-50">
                <div class="mx-auto max-w-3xl px-6 text-center">

                    <?php if ( $kontakt_heading ) : ?>
                        <h2 class="font-display text-3xl md:text-4xl font-medium tracking-tight text-cream-50 mb-4">
                            <?php echo esc_html( $kontakt_heading ); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ( $kontakt_sub ) : ?>
                        <p class="font-sans text-base md:text-lg text-cream-100 leading-relaxed mb-8 max-w-xl mx-auto">
                            <?php echo esc_html( $kontakt_sub ); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ( $kontakt_cta_primary_label || $kontakt_cta_secondary_label ) : ?>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <?php if ( $kontakt_cta_primary_label ) : ?>
                                <a
                                    href="<?php echo esc_url( $kontakt_cta_primary_url ?: home_url( '/kontakt/' ) ); ?>"
                                    class="inline-block px-7 py-3 font-sans text-sm tracking-wide uppercase bg-cream-50 text-accent-600 hover:bg-cream-100 transition-colors"
                                >
                                    <?php echo esc_html( $kontakt_cta_primary_label ); ?>
                                </a>
                            <?php endif; ?>

                            <?php if ( $kontakt_cta_secondary_label ) : ?>
                                <a
                                    href="<?php echo esc_url( $kontakt_cta_secondary_url ?: home_url( '/kontakt/' ) ); ?>"
                                    class="inline-block px-7 py-3 font-sans text-sm tracking-wide uppercase border border-cream-50 text-cream-50 hover:bg-cream-50 hover:text-accent-600 transition-colors"
                                >
                                    <?php echo esc_html( $kontakt_cta_secondary_label ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </section>
        <?php endif; ?>

    </main>

<?php
get_footer();