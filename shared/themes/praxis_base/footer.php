<?php
/**
 * Closing document chrome — emits wp_footer() and closes <body> and <html>.
 *
 * The visible site footer (copyright + navigation) lives in
 * template-parts/site-footer.php and is loaded below.
 *
 * @package PraxisBase
 */
?>

<?php get_template_part( 'template-parts/site-footer' ); ?>

<?php wp_footer(); ?>
</body>
</html>