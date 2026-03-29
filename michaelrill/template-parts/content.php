<?php
/**
 * Template part for displaying standard posts in the loop.
 *
 * Two-column layout: title + date in left column, content in right column.
 *
 * @package MichaelRill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-entry' ); ?>>

	<div class="entry-meta-column">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<?php michaelrill_posted_on(); ?>
	</div>

	<div class="entry-content-column">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>

</article>
