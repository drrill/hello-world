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
		<p class="error-404-code">404</p>
		<h1>Well, this is awkward.</h1>
		<p>Whatever was here has wandered off. It might have been moved, renamed, or maybe it never existed in the first place. These things happen.</p>
		<p>You could try searching for what you were looking for, or just <a href="<?php echo esc_url( home_url( '/' ) ); ?>">head back home</a> and start fresh.</p>
		<?php get_search_form(); ?>
	</div>
</main>

<?php get_footer(); ?>
