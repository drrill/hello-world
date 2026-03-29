<?php
/**
 * Template part for displaying page content.
 *
 * @package MichaelRill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry' ); ?>>

	<h1 class="entry-title"><?php the_title(); ?></h1>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
