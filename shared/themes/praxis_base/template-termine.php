<?php
/**
 * Template Name: Termine
 *
 * Page template for the Termine page. Reads ACF fields from the
 * "Termine" field group and renders: hero, optional lead image,
 * optional intro, list of upcoming events, and a collapsible
 * disclosure of past events.
 *
 * Past-vs-upcoming split is based on the `datum` subfield of each
 * Repeater row. Dates in `Y-m-d` ISO format (per ACF return format).
 *
 * @package PraxisBase
 */

get_header();

$tagline    = get_field( 'termine_tagline' );
$lead_image = get_field( 'termine_lead_image' );
$intro      = get_field( 'termine_intro' );
$entries    = get_field( 'termine_eintraege' );

/* ------------------------------------------------------------------
 * Split entries into upcoming and past arrays.
 * ------------------------------------------------------------------ */
$today_iso = current_time( 'Y-m-d' );
$upcoming  = array();
$past      = array();

if ( is_array( $entries ) ) {
    foreach ( $entries as $entry ) {
        $datum = isset( $entry['datum'] ) ? $entry['datum'] : '';
        // Entries with no date go into upcoming so they don't disappear.
        if ( empty( $datum ) || $datum >= $today_iso ) {
            $upcoming[] = $entry;
        } else {
            $past[] = $entry;
        }
    }
}

/* Sort upcoming ascending (next event first), past descending (most recent first). */
usort( $upcoming, function( $a, $b ) {
    $da = isset( $a['datum'] ) ? $a['datum'] : '';
    $db = isset( $b['datum'] ) ? $b['datum'] : '';
    return strcmp( $da, $db );
} );
usort( $past, function( $a, $b ) {
    $da = isset( $a['datum'] ) ? $a['datum'] : '';
    $db = isset( $b['datum'] ) ? $b['datum'] : '';
    return strcmp( $db, $da );
} );

/* ------------------------------------------------------------------
 * German weekday/month formatting helpers.
 * ------------------------------------------------------------------ */
$weekdays_de = array(
    'Sunday'    => 'Sonntag',
    'Monday'    => 'Montag',
    'Tuesday'   => 'Dienstag',
    'Wednesday' => 'Mittwoch',
    'Thursday'  => 'Donnerstag',
    'Friday'    => 'Freitag',
    'Saturday'  => 'Samstag',
);
$months_de = array(
    'January'   => 'Januar',
    'February'  => 'Februar',
    'March'     => 'März',
    'April'     => 'April',
    'May'       => 'Mai',
    'June'      => 'Juni',
    'July'      => 'Juli',
    'August'    => 'August',
    'September' => 'September',
    'October'   => 'Oktober',
    'November'  => 'November',
    'December'  => 'Dezember',
);
$gruppentyp_labels = array(
    'offene_gruppe'       => 'Offene Gruppe',
    'geschlossene_gruppe' => 'Geschlossene Gruppe',
    'tagesseminar'        => 'Tagesseminar',
    'einzeltermin'        => 'Einzeltermin',
);

/**
 * Render a single event card.
 *
 * @param array $entry Repeater row.
 * @param array $weekdays_de Weekday translations.
 * @param array $months_de Month translations.
 * @param array $gruppentyp_labels Group-type label map.
 */
function praxis_render_termin_entry( $entry, $weekdays_de, $months_de, $gruppentyp_labels ) {
    $datum_iso   = isset( $entry['datum'] ) ? $entry['datum'] : '';
    $titel       = isset( $entry['titel'] ) ? $entry['titel'] : '';
    $uhrzeit     = isset( $entry['uhrzeit'] ) ? $entry['uhrzeit'] : '';
    $ort         = isset( $entry['ort'] ) ? $entry['ort'] : '';
    $beschreibung = isset( $entry['beschreibung'] ) ? $entry['beschreibung'] : '';
    $gruppentyp  = isset( $entry['gruppentyp'] ) ? $entry['gruppentyp'] : '';

    /* Format date as "Samstag, 16. Mai 2026". */
    $datum_display = '';
    if ( $datum_iso ) {
        $timestamp = strtotime( $datum_iso );
        if ( $timestamp ) {
            $weekday_en   = date( 'l', $timestamp );
            $month_en     = date( 'F', $timestamp );
            $day_of_month = date( 'j', $timestamp );
            $year         = date( 'Y', $timestamp );
            $weekday_de   = isset( $weekdays_de[ $weekday_en ] ) ? $weekdays_de[ $weekday_en ] : $weekday_en;
            $month_de     = isset( $months_de[ $month_en ] ) ? $months_de[ $month_en ] : $month_en;
            $datum_display = sprintf( '%s, %d. %s %d', $weekday_de, $day_of_month, $month_de, $year );
        }
    }

    $gruppentyp_label = isset( $gruppentyp_labels[ $gruppentyp ] ) ? $gruppentyp_labels[ $gruppentyp ] : '';
    ?>
    <article class="border-l-2 border-cream-200 pl-6 py-4">
        <?php if ( $gruppentyp_label ) : ?>
            <span class="inline-block text-xs uppercase tracking-wider text-navy-600 bg-cream-100 px-2 py-1 mb-2 rounded-sm">
				<?php echo esc_html( $gruppentyp_label ); ?>
			</span>
        <?php endif; ?>

        <?php if ( $datum_display ) : ?>
            <p class="font-display text-xl text-navy-800 mb-1">
                <?php echo esc_html( $datum_display ); ?>
            </p>
        <?php endif; ?>

        <?php if ( $titel ) : ?>
            <h3 class="font-sans text-lg font-medium text-stone-800 mb-2">
                <?php echo esc_html( $titel ); ?>
            </h3>
        <?php endif; ?>

        <?php if ( $uhrzeit ) : ?>
            <p class="font-sans text-sm text-stone-600 mb-1">
                <?php echo esc_html( $uhrzeit ); ?>
            </p>
        <?php endif; ?>

        <?php if ( $ort ) : ?>
            <p class="font-sans text-sm text-stone-600 mb-3">
                <?php echo esc_html( $ort ); ?>
            </p>
        <?php endif; ?>

        <?php if ( $beschreibung ) : ?>
            <div class="font-sans text-base text-stone-800 prose prose-stone max-w-none mt-3">
                <?php echo wp_kses_post( $beschreibung ); ?>
            </div>
        <?php endif; ?>
    </article>
    <?php
}
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
                        class="w-full h-auto"
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

        <section class="py-12 md:py-16 bg-cream-50">
            <div class="mx-auto max-w-3xl px-6">

                <?php if ( ! empty( $upcoming ) ) : ?>
                    <h2 class="font-display text-2xl md:text-3xl text-navy-800 mb-8">
                        Anstehende Termine
                    </h2>
                    <div class="space-y-8">
                        <?php foreach ( $upcoming as $entry ) : ?>
                            <?php praxis_render_termin_entry( $entry, $weekdays_de, $months_de, $gruppentyp_labels ); ?>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p class="font-sans text-base text-stone-600 italic">
                        Aktuell sind keine Termine veröffentlicht. Für individuelle Termine nehmen Sie bitte direkt Kontakt auf.
                    </p>
                <?php endif; ?>

                <?php if ( ! empty( $past ) ) : ?>
                    <details class="mt-16 border-t border-cream-200 pt-8" data-past-events>
                        <summary class="font-sans text-sm uppercase tracking-wider text-navy-600 cursor-pointer hover:text-navy-900 transition-colors list-none" data-past-summary>
                            Vergangene Termine anzeigen
                        </summary>
                        <div class="space-y-8 mt-8 opacity-75">
                            <?php foreach ( $past as $entry ) : ?>
                                <?php praxis_render_termin_entry( $entry, $weekdays_de, $months_de, $gruppentyp_labels ); ?>
                            <?php endforeach; ?>
                        </div>
                    </details>
                <?php endif; ?>

            </div>
        </section>

        <section class="py-10 bg-navy-800 text-cream-50 text-center">
            <div class="mx-auto max-w-3xl px-6">
                <a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"
                   class="inline-block font-sans text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">
                    Kontakt aufnehmen
                </a>
            </div>
        </section>

    </main>

<?php get_footer();