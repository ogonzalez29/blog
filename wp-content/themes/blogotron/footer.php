<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #content-wrapper and #page-wrapper div elements.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
?>
	</div><!-- #content-wrapper -->
	<div id="footer-wrapper">
		<footer id="main-footer" role="contentinfo">
			<div id="copyright">&copy; <?php printf( '%1$s %2$s', the_date( 'Y', '', '', false ), '') ?><a href="<?php echo esc_url( 'http://servitalleres.com' ); ?>" target="_blank">Servitalleres</a></div>
			<div id="info"><?php _e( 'Carrera 22 No. 76-57 | Telefax: 2117943 | Teléfonos: 2119290 - 2119291', 'blogotron' ); ?></div>
		</footer><!-- #main-footer -->
	</div><!-- #footer-wrapper -->
</div><!-- #page-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
