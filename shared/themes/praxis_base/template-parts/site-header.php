<?php
/**
 * Visible site header (logo + primary navigation).
 *
 * Loaded by header.php via get_template_part(). The document chrome
 * (<html>, <head>, <body>) lives in header.php; this file is concerned
 * only with the visible header UI that sits at the top of every page.
 *
 * @package PraxisBase
 */
?>
<header class="site-header bg-cream-50 border-b border-cream-200 relative">
	<div class="mx-auto max-w-6xl px-6 py-6 flex items-center justify-between">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-display text-xl font-medium tracking-tight text-navy-800">
			<?php bloginfo( 'name' ); ?>
		</a>
		
		<nav aria-label="<?php esc_attr_e( 'Hauptmenü', 'praxis-base' ); ?>" class="hidden md:block">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'primary',
				'container'       => false,
				'menu_class'      => 'flex items-center gap-8 font-sans text-sm',
				'fallback_cb'     => '__return_empty_string',
				'link_before'     => '<span class="text-navy-600 hover:text-navy-900 transition-colors border-b border-transparent hover:border-navy-400 pb-1">',
				'link_after'      => '</span>',
			) );
			?>
		</nav>
		
		<button
			type="button"
			class="md:hidden flex items-center justify-center w-10 h-10 -mr-2 text-navy-700 hover:text-navy-900 transition-colors"
			aria-label="<?php esc_attr_e( 'Menü öffnen', 'praxis-base' ); ?>"
			aria-expanded="false"
			aria-controls="mobile-menu-panel"
			data-mobile-nav-toggle
		>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="3" y1="6" x2="21" y2="6"></line>
				<line x1="3" y1="12" x2="21" y2="12"></line>
				<line x1="3" y1="18" x2="21" y2="18"></line>
			</svg>
		</button>
	</div>
	
	<div
		id="mobile-menu-panel"
		class="md:hidden hidden absolute top-full inset-x-0 bg-cream-50 border-b border-cream-200 shadow-md z-40"
		data-mobile-nav-panel
	>
		<nav aria-label="<?php esc_attr_e( 'Mobiles Hauptmenü', 'praxis-base' ); ?>" class="px-6 py-4 text-center">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'primary',
				'container'       => false,
				'menu_class'      => 'flex flex-col gap-4 font-sans text-base',
				'fallback_cb'     => '__return_empty_string',
				'link_before'     => '<span class="block text-navy-700 hover:text-navy-900 py-2 transition-colors">',
				'link_after'      => '</span>',
			) );
			?>
		</nav>
	</div>
</header>