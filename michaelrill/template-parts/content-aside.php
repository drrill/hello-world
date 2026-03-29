<?php
/**
 * Template part for displaying aside posts in the loop.
 *
 * Two-column layout: left column intentionally empty, content in right column.
 *
 * @package MichaelRill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-entry' ); ?>>

	<div class="entry-meta-column">
		<!-- Intentionally empty for asides -->
	</div>

	<div class="entry-content-column">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>

</article>
