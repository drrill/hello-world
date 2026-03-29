<?php
/**
 * The footer template.
 *
 * @package MichaelRill
 */
?>

	</div><!-- #content .site-content -->

	<footer class="site-footer">
		<div class="footer-inner">
			<p></p>
			<p>
				<?php
				printf(
					/* translators: %s: WordPress link */
					__( 'Designed with %s', 'michaelrill' ),
					'<a href="https://wordpress.org" rel="nofollow">WordPress</a>'
				);
				?>
			</p>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
