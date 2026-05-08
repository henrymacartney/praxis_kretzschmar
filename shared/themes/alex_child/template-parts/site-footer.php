<?php
/**
 * Visible site footer — Alex Kretzschmar (four-column override).
 *
 * Overrides praxis_base/template-parts/site-footer.php. WordPress's
 * get_template_part() looks in the child first, so this file replaces
 * the parent's two-column footer when alex_child is active.
 *
 * Structure mirrors the KFZ-Kunz reference:
 *   col 1: Über uns blurb
 *   col 2: Schnelllinks (primary nav, repeated for SEO + footer use)
 *   col 3: Unsere Leistungen (links to Leistung pages)
 *   col 4: Kontaktinfo (address, phone, email, social)
 * Then a thin bottom strip: copyright + legal links (Impressum, Datenschutz).
 *
 * All four columns are driven by an ACF "Footer" options page (or
 * front-page fields, TBD when the field group is built in wp-admin).
 * Falls back to wp_nav_menu( 'footer' ) for the legal strip when ACF
 * fields are absent, so this template is safe even before the field
 * group exists.
 *
 * @package AlexChild
 */

// Pull ACF fields from the options page (if registered) or fall back to empty.
// Field naming uses the footer_ prefix and matches the planned ACF group.
$f_about       = function_exists( 'get_field' ) ? get_field( 'footer_about',       'option' ) : '';
$f_schnell     = function_exists( 'get_field' ) ? get_field( 'footer_schnelllinks','option' ) : array();
$f_leistungen  = function_exists( 'get_field' ) ? get_field( 'footer_leistungen',  'option' ) : array();
$f_kontakt_addr  = function_exists( 'get_field' ) ? get_field( 'footer_kontakt_address', 'option' ) : '';
$f_kontakt_phone = function_exists( 'get_field' ) ? get_field( 'footer_kontakt_phone',   'option' ) : '';
$f_kontakt_email = function_exists( 'get_field' ) ? get_field( 'footer_kontakt_email',   'option' ) : '';
$f_socials       = function_exists( 'get_field' ) ? get_field( 'footer_socials',         'option' ) : array();
?>
<footer class="site-footer mt-auto bg-navy-800 text-cream-100">
	<div class="mx-auto max-w-6xl px-6 py-14 font-sans text-sm">

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

			<!-- Column 1 — Über uns blurb -->
			<div>
				<h3 class="font-display text-base font-medium text-cream-50 mb-3"><?php esc_html_e( 'Über uns', 'alex-child' ); ?></h3>
				<div class="w-8 h-0.5 bg-accent-600 mb-4" aria-hidden="true"></div>
				<?php if ( $f_about ) : ?>
					<p class="text-cream-200 leading-relaxed"><?php echo esc_html( $f_about ); ?></p>
				<?php else : ?>
					<p class="text-cream-200/70 leading-relaxed italic"><?php esc_html_e( '(Footer-Text wird im wp-admin gepflegt.)', 'alex-child' ); ?></p>
				<?php endif; ?>
			</div>

			<!-- Column 2 — Schnelllinks -->
			<div>
				<h3 class="font-display text-base font-medium text-cream-50 mb-3"><?php esc_html_e( 'Schnelllinks', 'alex-child' ); ?></h3>
				<div class="w-8 h-0.5 bg-accent-600 mb-4" aria-hidden="true"></div>
				<?php if ( is_array( $f_schnell ) && count( $f_schnell ) > 0 ) : ?>
					<ul class="space-y-2">
						<?php foreach ( $f_schnell as $row ) : ?>
							<?php
							$label = $row['label'] ?? '';
							$url   = $row['url']   ?? '';
							if ( ! $label ) {
								continue;
							}
							?>
							<li>
								<a href="<?php echo esc_url( $url ); ?>" class="text-cream-200 hover:text-cream-50 transition-colors">
									<?php echo esc_html( $label ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<?php
					// Fallback: render the primary nav menu (depth 1) if present.
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'space-y-2',
							'depth'          => 1,
							'fallback_cb'    => '__return_empty_string',
							'link_before'    => '<span class="text-cream-200 hover:text-cream-50 transition-colors">',
							'link_after'     => '</span>',
						) );
					}
					?>
				<?php endif; ?>
			</div>

			<!-- Column 3 — Unsere Leistungen -->
			<div>
				<h3 class="font-display text-base font-medium text-cream-50 mb-3"><?php esc_html_e( 'Unsere Leistungen', 'alex-child' ); ?></h3>
				<div class="w-8 h-0.5 bg-accent-600 mb-4" aria-hidden="true"></div>
				<?php if ( is_array( $f_leistungen ) && count( $f_leistungen ) > 0 ) : ?>
					<ul class="space-y-2">
						<?php foreach ( $f_leistungen as $row ) : ?>
							<?php
							$label = $row['label'] ?? '';
							$url   = $row['url']   ?? '';
							if ( ! $label ) {
								continue;
							}
							?>
							<li>
								<a href="<?php echo esc_url( $url ); ?>" class="text-cream-200 hover:text-cream-50 transition-colors">
									<?php echo esc_html( $label ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<p class="text-cream-200/70 italic"><?php esc_html_e( '(Leistungen-Liste wird im wp-admin gepflegt.)', 'alex-child' ); ?></p>
				<?php endif; ?>
			</div>

			<!-- Column 4 — Kontaktinfo -->
			<div>
				<h3 class="font-display text-base font-medium text-cream-50 mb-3"><?php esc_html_e( 'Kontaktinfo', 'alex-child' ); ?></h3>
				<div class="w-8 h-0.5 bg-accent-600 mb-4" aria-hidden="true"></div>
				<ul class="space-y-2 text-cream-200">
					<?php if ( $f_kontakt_addr ) : ?>
						<li><?php echo nl2br( esc_html( $f_kontakt_addr ) ); ?></li>
					<?php endif; ?>
					<?php if ( $f_kontakt_phone ) : ?>
						<li>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $f_kontakt_phone ) ); ?>" class="hover:text-cream-50 transition-colors">
								<?php echo esc_html( $f_kontakt_phone ); ?>
							</a>
						</li>
					<?php endif; ?>
					<?php if ( $f_kontakt_email ) : ?>
						<li>
							<a href="mailto:<?php echo esc_attr( $f_kontakt_email ); ?>" class="hover:text-cream-50 transition-colors">
								<?php echo esc_html( $f_kontakt_email ); ?>
							</a>
						</li>
					<?php endif; ?>
				</ul>

				<?php if ( is_array( $f_socials ) && count( $f_socials ) > 0 ) : ?>
					<div class="flex gap-3 mt-4">
						<?php foreach ( $f_socials as $row ) : ?>
							<?php
							$label = $row['label'] ?? '';
							$url   = $row['url']   ?? '';
							if ( ! $url ) {
								continue;
							}
							?>
							<a
								href="<?php echo esc_url( $url ); ?>"
								class="w-9 h-9 flex items-center justify-center bg-navy-600 hover:bg-accent-600 text-cream-50 transition-colors"
								aria-label="<?php echo esc_attr( $label ); ?>"
								rel="noopener"
							>
								<span class="text-xs"><?php echo esc_html( strtoupper( substr( $label, 0, 2 ) ) ); ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

		</div>

		<!-- Bottom strip: copyright + legal links -->
		<div class="mt-12 pt-6 border-t border-navy-600 flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-cream-200">
			<p>
				&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Alle Rechte vorbehalten.', 'alex-child' ); ?>
			</p>
			<nav aria-label="<?php esc_attr_e( 'Footer-Menü', 'alex-child' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'flex gap-6',
					'fallback_cb'    => '__return_empty_string',
					'link_before'    => '<span class="hover:text-cream-50 transition-colors">',
					'link_after'     => '</span>',
					'depth'          => 1,
				) );
				?>
			</nav>
		</div>

	</div>
</footer>
