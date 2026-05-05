<?php
/**
 * Custom search form with rounded input.
 *
 * @package MichaelRill
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search-field"><?php esc_html_e( 'Search', 'michaelrill' ); ?></label>
	<input type="search"
		id="search-field"
		class="search-field"
		placeholder="<?php esc_attr_e( 'Search', 'michaelrill' ); ?>"
		value="<?php echo get_search_query(); ?>"
		name="s"
		required />
	<button type="submit" class="search-submit">
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'michaelrill' ); ?></span>
	</button>
</form>
