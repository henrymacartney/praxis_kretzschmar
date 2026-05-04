<?php
/**
 * Document chrome — opens <html>, <head>, <body> and emits wp_head().
 *
 * The visible site header (logo + navigation) lives in
 * template-parts/site-header.php and is loaded below.
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

<?php get_template_part( 'template-parts/site-header' ); ?>