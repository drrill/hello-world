<?php
/**
 * Template Name: Archive
 *
 * Dynamic archive page — all posts grouped by year, newest first.
 * Three-column layout: year | title | date.
 *
 * @package MichaelRill
 */

get_header();

$all_posts = get_posts( array(
	'post_type'      => 'post',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_status'    => 'publish',
) );

$total       = count( $all_posts );
$by_year     = array();

foreach ( $all_posts as $p ) {
	$year = get_the_date( 'Y', $p );
	$by_year[ $year ][] = $p;
}
?>

<main id="primary" class="site-main">
	<article class="archive-dynamic">

		<header class="archive-dynamic__header">
			<h1 class="archive-dynamic__title">Archive</h1>
			<p class="archive-dynamic__subtitle">
				All <?php echo esc_html( number_format_i18n( $total ) ); ?> posts, in reverse order.
			</p>
		</header>

		<div class="archive-dynamic__list">
			<?php foreach ( $by_year as $year => $posts ) : ?>
				<?php foreach ( $posts as $index => $p ) : ?>
					<div class="archive-dynamic__row">
						<span class="archive-dynamic__year">
							<?php if ( 0 === $index ) echo esc_html( $year ); ?>
						</span>
						<span class="archive-dynamic__post-title">
							<a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo get_the_title( $p ); ?></a>
						</span>
						<span class="archive-dynamic__date">
							<?php echo get_the_date( 'M j', $p ); ?>
						</span>
					</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>

	</article>
</main>

<?php get_footer(); ?>
