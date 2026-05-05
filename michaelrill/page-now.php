<?php
/**
 * Template Name: Now
 *
 * Custom page template for the Now page.
 * Intro content comes from the WP editor. Now items
 * are pulled from the Now Item custom post type.
 *
 * @package MichaelRill
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'about-entry' ); ?>>
			<div class="about-layout">
				<div class="about-label-column">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<p class="now-updated">// last updated: <?php echo esc_html( get_the_modified_date( 'F \'y' ) ); ?></p>
				</div>
				<div class="about-content-column">
					<?php if ( get_the_content() ) : ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

	<?php
	$now_items = new WP_Query( array(
		'post_type'      => 'now_item',
		'posts_per_page' => -1,
		'orderby'        => 'meta_value_num',
		'meta_key'       => '_now_order',
		'order'          => 'ASC',
	) );

	if ( $now_items->have_posts() ) : ?>
		<section class="now-section">

			<?php while ( $now_items->have_posts() ) : $now_items->the_post(); ?>
				<div class="timeline-layout timeline-group">
					<div class="timeline-meta-column">
						<span class="timeline-date"><?php the_title(); ?></span>
					</div>
					<div class="timeline-content-column">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; ?>

		</section>
	<?php endif;
	wp_reset_postdata();
	?>

</main>

<?php get_footer(); ?>
