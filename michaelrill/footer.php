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
			<p>
				<?php
				printf(
					/* translators: %s: WordPress link */
					__( 'Designed with ❤️ and %s', 'michaelrill' ),
					'<a href="https://wordpress.org" rel="nofollow">WordPress</a>'
				);
				?>
			</p>
			<p class="footer-rss">
				<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" title="RSS Feed">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="6.18" cy="17.82" r="2.18"/><path d="M4 4.44v2.83c7.03 0 12.73 5.7 12.73 12.73h2.83c0-8.59-6.97-15.56-15.56-15.56zm0 5.66v2.83c3.9 0 7.07 3.17 7.07 7.07h2.83c0-5.47-4.43-9.9-9.9-9.9z"/></svg>
					RSS
				</a>
			</p>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
