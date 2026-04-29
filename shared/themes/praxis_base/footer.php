<?php
/**
 * Site footer.
 *
 * @package PraxisBase
 */
?>

<footer class="site-footer mt-auto border-t border-stone-200 bg-stone-50">
    <div class="mx-auto max-w-6xl px-6 py-10 text-sm text-stone-600">
        <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>