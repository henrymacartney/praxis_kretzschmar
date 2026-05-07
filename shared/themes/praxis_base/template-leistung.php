<?php
/**
 * Template Name: Leistung
 *
 * Page template for individual Leistung pages (Tanztherapie, Paartherapie,
 * Weiterbildungen, Psychotraumatherapie). Reads ACF fields from the
 * "Leistung" field group and renders a structured layout: hero, optional
 * lead image, intro, repeated content sections, optional pull-quote, CTA.
 *
 * Each Leistung page applies this template via Page Attributes → Template.
 *
 * @package PraxisBase
 */

get_header();

$tagline    = get_field( 'leistung_tagline' );
$lead_image = get_field( 'leistung_lead_image' );
$intro      = get_field( 'leistung_intro' );
$sections   = get_field( 'leistung_sections' );
$quote      = get_field( 'leistung_quote' );
/*$cta_text   = get_field( 'leistung_cta_text' ) ?: 'Termin vereinbaren';
$cta_link   = get_field( 'leistung_cta_link' ) ?: home_url( '/termine/' );*/
$cta_text   = get_field( 'leistung_cta_text' ) ?: 'Kontakt aufnehmen';
$cta_link   = get_field( 'leistung_cta_link' ) ?: home_url( '/kontakt/' );
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
		
		<?php if ( $sections && is_array( $sections ) && count( $sections ) > 0 ) : ?>
			<?php foreach ( $sections as $index => $section ) : ?>
				<?php
				$alt_bg     = $index % 2 === 0 ? 'bg-cream-50' : 'bg-cream-100 border-y border-cream-200';
				$has_image  = ! empty( $section['image'] ) && is_array( $section['image'] );
				?>
				<section class="py-12 md:py-16 <?php echo esc_attr( $alt_bg ); ?>">
					<div class="mx-auto max-w-5xl px-6 grid grid-cols-1 <?php echo $has_image ? 'md:grid-cols-2' : ''; ?> gap-12 items-start">
						
						<?php if ( $has_image && $index % 2 === 0 ) : ?>
							<div class="order-1 md:order-1">
								<img
									src="<?php echo esc_url( $section['image']['sizes']['large'] ?? $section['image']['url'] ); ?>"
									alt="<?php echo esc_attr( $section['image']['alt'] ?: ( $section['heading'] ?? '' ) ); ?>"
									class="w-full h-auto"
									loading="lazy"
								/>
							</div>
						<?php endif; ?>
						
						<div class="order-2 md:order-2">
							<?php if ( ! empty( $section['heading'] ) ) : ?>
								<h2 class="font-display text-3xl text-navy-800 mb-4">
									<?php echo esc_html( $section['heading'] ); ?>
								</h2>
							<?php endif; ?>
							<?php if ( ! empty( $section['body'] ) ) : ?>
								<div class="font-sans text-base md:text-lg leading-relaxed text-stone-800 prose prose-stone max-w-none">
									<?php echo wp_kses_post( $section['body'] ); ?>
								</div>
							<?php endif; ?>
						</div>
						
						<?php if ( $has_image && $index % 2 !== 0 ) : ?>
							<div class="order-1 md:order-1">
								<img
									src="<?php echo esc_url( $section['image']['sizes']['large'] ?? $section['image']['url'] ); ?>"
									alt="<?php echo esc_attr( $section['image']['alt'] ?: ( $section['heading'] ?? '' ) ); ?>"
									class="w-full h-auto"
									loading="lazy"
								/>
							</div>
						<?php endif; ?>
					
					</div>
				</section>
			<?php endforeach; ?>
		<?php endif; ?>
		
		<?php if ( $quote ) : ?>
			<section class="py-12 md:py-16 bg-cream-50">
				<div class="mx-auto max-w-3xl px-6 text-center">
					<blockquote class="font-display text-2xl md:text-3xl text-navy-700 italic leading-snug">
						<?php echo esc_html( $quote ); ?>
					</blockquote>
				</div>
			</section>
		<?php endif; ?>
		
		<section class="py-10 bg-navy-800 text-cream-50 text-center">
			<div class="mx-auto max-w-3xl px-6">
				<a href="<?php echo esc_url( $cta_link ); ?>"
				   class="inline-block font-sans text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">
					<?php echo esc_html( $cta_text ); ?>
				</a>
			</div>
		</section>
	
	</main>

<?php get_footer();