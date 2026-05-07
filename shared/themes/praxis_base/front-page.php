<?php
/**
 * Front page (homepage).
 *
 * Content is managed via ACF — see "Homepage" field group in WP Admin.
 *
 * @package PraxisBase
 */

get_header();

// Read ACF fields once at the top so the template body stays clean.
$hero_headline = get_field( 'hero_headline' );
$hero_subtitle = get_field( 'hero_subtitle' );
$cta_label     = get_field( 'cta_label' );
$welcome_text  = get_field( 'welcome_text' );
$galerie       = get_field( 'home_galerie' );
?>
	
	<main id="main" class="site-main flex-1">
		
		<section class="hero py-28 md:py-36 bg-cream-50">
			<div class="mx-auto max-w-3xl px-6 text-center">
				<?php if ($hero_headline) : ?>
					<h1 class="font-display text-5xl md:text-6xl font-medium tracking-tight text-navy-800 mb-6 leading-tight">
						<?php echo esc_html($hero_headline); ?>
					</h1>
				<?php endif; ?>
				
				<?php if ($hero_subtitle) : ?>
					<p class="font-sans text-lg md:text-xl text-navy-600 leading-relaxed">
						<?php echo esc_html($hero_subtitle); ?>
					</p>
				<?php endif; ?>
			</div>
		</section>
		
		<?php if ( $galerie && is_array( $galerie ) && count( $galerie ) > 0 ) : ?>
			<section class="galerie py-12 md:py-16 bg-cream-50">
				<div class="mx-auto max-w-5xl px-6">
					<div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
						<?php foreach ( $galerie as $row ) : ?>
							<?php
							$bild    = $row['bild']    ?? null;
							$caption = $row['caption'] ?? '';
							if ( ! $bild || ! is_array( $bild ) ) {
								continue;
							}
							?>
							<figure class="m-0">
								<img
									src="<?php echo esc_url( $bild['sizes']['medium_large'] ?? $bild['sizes']['large'] ?? $bild['url'] ); ?>"
									alt="<?php echo esc_attr( $bild['alt'] ?: $caption ); ?>"
									class="w-full h-64 object-cover"
									loading="lazy"
								/>
								<?php if ( $caption ) : ?>
									<figcaption class="font-sans text-sm text-stone-600 mt-2 text-center">
										<?php echo esc_html( $caption ); ?>
									</figcaption>
								<?php endif; ?>
							</figure>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
		
		<?php if ($cta_label) : ?>
			<section class="cta py-10 bg-navy-800">
				<div class="mx-auto max-w-3xl px-6 text-center">
					<!--					<a href="#kontakt" class="inline-block font-sans text-cream-50 text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">-->
					<a href="<?php echo esc_url(home_url('/kontakt/')); ?>"
					   class="inline-block font-sans text-cream-50 text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">
						<?php echo esc_html($cta_label); ?>
					</a>
				</div>
			</section>
		<?php endif; ?>
		
		<?php if ($welcome_text) : ?>
			<section class="intro py-20 bg-cream-100 border-y border-cream-200">
				<div class="mx-auto max-w-2xl px-6">
					<div class="font-sans text-lg leading-relaxed text-stone-800 prose prose-stone max-w-none">
						<?php echo wp_kses_post(wpautop($welcome_text)); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
	
	</main>

<?php
get_footer();