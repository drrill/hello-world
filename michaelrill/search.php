<?php
/**
 * The search results template.
 *
 * @package MichaelRill
 */

get_header();
?>

<main id="primary" class="site-main">

	<header class="search-header">
		<h1 class="search-title">
			<?php
			printf(
				/* translators: %s: search query */
				__( 'Search results for: %s', 'michaelrill' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
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
