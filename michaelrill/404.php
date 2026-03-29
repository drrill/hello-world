<?php
/**
 * The 404 (not found) template.
 *
 * @package MichaelRill
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="error-404">
		<h1><?php esc_html_e( 'Page not found', 'michaelrill' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for does not exist.', 'michaelrill' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</main>

<?php get_footer(); ?>
