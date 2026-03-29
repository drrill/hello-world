<?php
/**
 * Template part for displaying a "no results" message.
 *
 * @package MichaelRill
 */
?>

<div class="no-results">
	<h1><?php esc_html_e( 'Nothing found', 'michaelrill' ); ?></h1>

	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'No results matched your search. Try different keywords.', 'michaelrill' ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'No content has been published yet.', 'michaelrill' ); ?></p>
	<?php endif; ?>

	<?php get_search_form(); ?>
</div>
