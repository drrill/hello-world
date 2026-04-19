<?php
/**
 * Template Name: Archive
 *
 * Dynamic archive page — all posts grouped by year, newest first.
 * Three-column layout: year | title | date (year only on first post per year).
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

$total   = count( $all_posts );
$by_year = array();

foreach ( $all_posts as $p ) {
	$by_year[ get_the_date( 'Y', $p ) ][] = $p;
}
?>

<style>
.archive-dynamic { max-width: 860px; margin: 0 auto; }
.archive-dynamic__header { margin-bottom: 2rem; }
.archive-dynamic__title { font-size: clamp(2.15rem, 3vw, 3rem); font-weight: 400; margin: 0 0 0.25rem; }
.archive-dynamic__subtitle { font-style: italic; color: var(--color-muted, #5F5F5F); margin: 0; font-size: 1rem; }
.archive-dynamic__list { border-top: 1px solid var(--color-post-border, #e5e5e5); }
.archive-dynamic__row { display: flex; align-items: baseline; border-bottom: 1px solid var(--color-post-border, #e5e5e5); padding: 0.45rem 0; }
.archive-dynamic__year { flex-shrink: 0; width: 4.5rem; font-weight: 700; color: var(--color-accent, #e91e63); font-size: 1rem; }
.archive-dynamic__title-link { flex: 1; min-width: 0; color: var(--color-heading, #191919) !important; text-decoration: none !important; box-shadow: none !important; border: none !important; margin-right: 1.5rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 1rem; }
.archive-dynamic__title-link:hover { color: var(--color-accent-hover, #E94795) !important; background: none !important; }
.archive-dynamic__date { flex-shrink: 0; font-size: 0.875rem; color: var(--color-muted, #5F5F5F); white-space: nowrap; }
</style>

<main id="primary" class="site-main">
	<article class="archive-dynamic">

		<header class="archive-dynamic__header">
			<h1 class="archive-dynamic__title">Archive</h1>
			<p class="archive-dynamic__subtitle">All <?php echo esc_html( number_format_i18n( $total ) ); ?> posts, in reverse order.</p>
		</header>

		<div class="archive-dynamic__list">
			<?php foreach ( $by_year as $year => $posts ) : ?>
				<?php foreach ( $posts as $i => $p ) : ?>
					<div class="archive-dynamic__row">
						<span class="archive-dynamic__year"><?php if ( 0 === $i ) echo esc_html( $year ); ?></span>
						<a class="archive-dynamic__title-link" href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a>
						<span class="archive-dynamic__date"><?php echo esc_html( get_the_date( 'M j', $p ) ); ?></span>
					</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>

	</article>
</main>

<?php get_footer(); ?>
