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

<button
	type="button"
	class="back-to-top"
	aria-label="<?php esc_attr_e( 'Zum Seitenanfang', 'praxis-base' ); ?>"
	data-back-to-top
>
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
		<line x1="12" y1="19" x2="12" y2="5"></line>
		<polyline points="5 12 12 5 19 12"></polyline>
	</svg>
</button>

<?php wp_footer(); ?>
</body>
</html>