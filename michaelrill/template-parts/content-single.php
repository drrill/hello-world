<?php
/**
 * Template part for displaying a single post.
 *
 * Two-column layout matching the feed: title + date + meta in left, content in right.
 * For asides: left column is empty.
 *
 * @package MichaelRill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-entry' ); ?>>

	<div class="single-meta-column">
		<?php if ( 'aside' !== get_post_format() ) : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php michaelrill_posted_on(); ?>
			<?php michaelrill_post_categories(); ?>
			<?php michaelrill_post_tags(); ?>
		<?php endif; ?>
	</div>

	<div class="single-content-column">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<?php if ( 'aside' === get_post_format() ) : ?>
			<div class="aside-meta">
				<?php michaelrill_posted_on(); ?>
			</div>
		<?php endif; ?>
	</div>

</article>
