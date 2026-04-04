<?php
/**
 * Template part for displaying page content.
 *
 * @package MichaelRill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry' ); ?>>

	<div class="page-meta-column">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</div>

	<div class="page-content-column">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>

</article>
