<?php
/**
 * The archive template for categories, tags, dates, etc.
 *
 * @package MichaelRill
 */

get_header();
?>

<main id="primary" class="site-main">

	<header class="archive-header">
		<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="posts-list">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile;
			?>
		</div>

		<?php the_posts_navigation( array(
			'prev_text' => __( 'Older posts', 'michaelrill' ),
			'next_text' => __( 'Newer posts', 'michaelrill' ),
		) ); ?>

	<?php else :
		get_template_part( 'template-parts/content', 'none' );
	endif; ?>

</main>

<?php get_footer(); ?>
