<?php
/**
 * Site footer.
 *
 * @package PraxisBase
 */
?>

<footer class="site-footer mt-auto bg-navy-800 text-cream-100">
	<div class="mx-auto max-w-6xl px-6 py-12 font-sans text-sm">
		
		<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
			
			<p class="text-cream-200">
				&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
			</p>
			
			<nav aria-label="<?php esc_attr_e( 'Footer-Menü', 'praxis-base' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'flex gap-6 text-cream-200',
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

<?php wp_footer(); ?>
</body>
</html>