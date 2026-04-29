<?php
/**
 * Site footer.
 *
 * @package PraxisBase
 */
?>

<footer class="site-footer mt-auto bg-navy-800 text-cream-100">
	<div class="mx-auto max-w-6xl px-6 py-10 font-sans text-sm">
		<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>