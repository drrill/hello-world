<?php
/**
 * Template Name: About with Timeline
 *
 * Custom page template for the About page.
 * Intro content comes from the WP editor. Timeline entries
 * are pulled from the Timeline Entry custom post type.
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
				</div>
				<div class="about-content-column">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

	<?php
	$timeline_entries = new WP_Query( array(
		'post_type'      => 'timeline_entry',
		'posts_per_page' => -1,
		'orderby'        => 'meta_value_num',
		'meta_key'       => '_timeline_order',
		'order'          => 'ASC',
	) );

	if ( $timeline_entries->have_posts() ) : ?>
		<section class="timeline-section">

			<!-- Timeline header row -->
			<div class="timeline-layout">
				<div class="timeline-heading-column">
					<span class="timeline-label">// timeline</span>
				</div>
				<div class="timeline-heading-content">
					<h2 class="timeline-title">How I got here</h2>
				</div>
			</div>

			<?php while ( $timeline_entries->have_posts() ) : $timeline_entries->the_post();
				$date_range = get_post_meta( get_the_ID(), '_timeline_date_range', true );
			?>
				<div class="timeline-layout timeline-group">
					<div class="timeline-meta-column">
						<?php if ( $date_range ) : ?>
							<span class="timeline-date"><?php echo esc_html( $date_range ); ?></span>
						<?php endif; ?>
						<h3 class="timeline-entry-title"><?php the_title(); ?></h3>
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
