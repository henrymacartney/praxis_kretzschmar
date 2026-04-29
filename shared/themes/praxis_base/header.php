<?php
/**
 * Site header.
 *
 * @package PraxisBase
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
	
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'min-h-screen flex flex-col bg-cream-50 text-stone-800 antialiased font-sans' ); ?>>
    <?php wp_body_open(); ?>
	
	<header class="site-header bg-cream-50 border-b border-cream-200">
		<div class="mx-auto max-w-6xl px-6 py-6 flex items-center justify-between">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-display text-xl font-medium tracking-tight text-navy-800">
				<?php bloginfo( 'name' ); ?>
			</a>
			<nav aria-label="<?php esc_attr_e( 'Hauptmenü', 'praxis-base' ); ?>" class="font-sans text-sm text-navy-600">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex gap-6',
					'fallback_cb'    => '__return_empty_string',
				) );
				?>
			</nav>
		</div>
	</header>