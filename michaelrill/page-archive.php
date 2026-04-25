<?php
/**
 * Template Name: Archive
 *
 * Dynamic archive page — all posts grouped by year, newest first.
 * Three-column layout: year | title | date (year only on first post per year).
 * Filterable by category using pills.
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

// Build post data with categories
$posts_with_categories = array();
$all_categories = array();
$category_descriptions = array();
$category_counts = array();

foreach ( $all_posts as $p ) {
	$categories = get_the_category( $p->ID );
	$cat_slugs = array();

	foreach ( $categories as $cat ) {
		$cat_slugs[] = esc_attr( $cat->slug );
		$all_categories[ $cat->slug ] = $cat->name;
		if ( ! isset( $category_descriptions[ $cat->slug ] ) ) {
			$category_descriptions[ $cat->slug ] = category_description( $cat->term_id );
		}
		$category_counts[ $cat->slug ] = ( $category_counts[ $cat->slug ] ?? 0 ) + 1;
	}

	$posts_with_categories[ $p->ID ] = array(
		'post' => $p,
		'category_slugs' => $cat_slugs,
	);
}

// Group by year
$total   = count( $all_posts );
$by_year = array();

foreach ( $all_posts as $p ) {
	$by_year[ get_the_date( 'Y', $p ) ][] = $p;
}

// Sort categories by name for consistent display
asort( $all_categories );

// Build JSON data for JS
$category_meta = array();
$category_meta['all'] = array(
	'subtitle' => sprintf( 'All %s posts, in reverse order.', number_format_i18n( $total ) ),
);
foreach ( $all_categories as $slug => $name ) {
	$desc = wp_strip_all_tags( trim( $category_descriptions[ $slug ] ?? '' ) );
	$count = $category_counts[ $slug ] ?? 0;
	$fallback = sprintf( '%s %s in this category.', number_format_i18n( $count ), _n( 'post', 'posts', $count, 'michaelrill' ) );
	$category_meta[ $slug ] = array(
		'subtitle' => $desc ? $desc : $fallback,
	);
}
?>

<style>
.archive-dynamic { max-width: 860px; margin: 0 auto; }
.archive-dynamic__header { margin-bottom: 2rem; }
.archive-dynamic__title { font-size: clamp(2.15rem, 3vw, 3rem); font-weight: 400; margin: 0 0 0.25rem; }
.archive-dynamic__subtitle { font-style: italic; color: var(--color-muted, #5F5F5F); margin: 0; font-size: 1rem; transition: opacity 0.2s ease; }
.archive-dynamic__filters { margin-top: 1.5rem; display: flex; flex-wrap: wrap; gap: 0.5rem; }
.archive-dynamic__filter-pill {
  font-family: inherit;
  font-size: var(--font-size-small, 0.875rem);
  border: 1px solid var(--color-border-subtle, #3B3B3B33);
  border-radius: 9999px;
  padding: 6px 16px;
  background: transparent;
  color: var(--color-text, #3B3B3B);
  cursor: pointer;
  transition: all 0.2s ease;
  appearance: none;
  -webkit-appearance: none;
  flex-shrink: 0;
}
.archive-dynamic__filter-pill:hover { border-color: var(--color-accent, #e91e63); color: var(--color-accent, #e91e63); }
.archive-dynamic__filter-pill.active { background: var(--color-accent, #e91e63); color: #fff; border-color: var(--color-accent, #e91e63); }
.archive-dynamic__list { border-top: 1px solid var(--color-post-border, #e5e5e5); margin-top: 1.5rem; }
.archive-dynamic__row { display: flex; align-items: baseline; border-bottom: 1px solid var(--color-post-border, #e5e5e5); padding: 0.45rem 0; }
.archive-dynamic__row.hidden { display: none; }
.archive-dynamic__year { flex-shrink: 0; width: 4.5rem; font-weight: 700; color: var(--color-accent, #e91e63); font-size: 1rem; }
.archive-dynamic__title-link,
.archive-dynamic__title-link:visited { flex: 1; min-width: 0; color: var(--color-heading, #191919) !important; text-decoration: none !important; box-shadow: none !important; border: none !important; margin-right: 1.5rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 1rem; }
.archive-dynamic__title-link:hover { color: var(--color-accent-hover, #E94795) !important; background: none !important; }
.archive-dynamic__date { flex-shrink: 0; font-size: 0.875rem; color: var(--color-muted, #5F5F5F); white-space: nowrap; }

@media (max-width: 782px) {
  .archive-dynamic__filter-pill { font-size: 0.75rem; padding: 5px 12px; }
}
</style>

<main id="primary" class="site-main">
	<article class="archive-dynamic">

		<header class="archive-dynamic__header">
			<h1 class="archive-dynamic__title">Archive</h1>
			<p class="archive-dynamic__subtitle">All <?php echo esc_html( number_format_i18n( $total ) ); ?> posts, in reverse order.</p>

			<?php if ( ! empty( $all_categories ) ) : ?>
				<div class="archive-dynamic__filters" role="group" aria-label="Filter posts by category">
					<button class="archive-dynamic__filter-pill active" data-category="all">
						All
					</button>
					<?php foreach ( $all_categories as $slug => $name ) : ?>
						<button class="archive-dynamic__filter-pill" data-category="<?php echo esc_attr( $slug ); ?>">
							<?php echo esc_html( $name ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</header>

		<div class="archive-dynamic__list">
			<?php foreach ( $by_year as $year => $posts ) : ?>
				<?php foreach ( $posts as $i => $p ) : ?>
					<?php
					$post_data = $posts_with_categories[ $p->ID ];
					$category_data = ! empty( $post_data['category_slugs'] ) ? implode( ' ', $post_data['category_slugs'] ) : '';
					?>
					<div class="archive-dynamic__row" data-categories="<?php echo esc_attr( $category_data ); ?>" data-year="<?php echo esc_attr( $year ); ?>">
						<span class="archive-dynamic__year"></span>
						<a class="archive-dynamic__title-link" href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a>
						<span class="archive-dynamic__date"><?php echo esc_html( get_the_date( 'M j', $p ) ); ?></span>
					</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>

	</article>
</main>

<script>
document.addEventListener( 'DOMContentLoaded', function() {
	var categoryMeta = <?php echo wp_json_encode( $category_meta ); ?>;
	var filterButtons = document.querySelectorAll( '.archive-dynamic__filter-pill' );
	var rows = document.querySelectorAll( '.archive-dynamic__row' );
	var subtitle = document.querySelector( '.archive-dynamic__subtitle' );

	function updateYearLabels() {
		var seen = {};
		rows.forEach( function( row ) {
			var yearEl = row.querySelector( '.archive-dynamic__year' );
			var year = row.getAttribute( 'data-year' );
			if ( row.classList.contains( 'hidden' ) ) {
				yearEl.textContent = '';
				return;
			}
			if ( ! seen[ year ] ) {
				yearEl.textContent = year;
				seen[ year ] = true;
			} else {
				yearEl.textContent = '';
			}
		} );
	}

	updateYearLabels();

	filterButtons.forEach( function( button ) {
		button.addEventListener( 'click', function() {
			var selectedCategory = this.getAttribute( 'data-category' );

			filterButtons.forEach( function( btn ) { btn.classList.remove( 'active' ); } );
			this.classList.add( 'active' );

			rows.forEach( function( row ) {
				if ( selectedCategory === 'all' ) {
					row.classList.remove( 'hidden' );
				} else {
					var rowCategories = row.getAttribute( 'data-categories' ).split( ' ' );
					if ( rowCategories.indexOf( selectedCategory ) !== -1 ) {
						row.classList.remove( 'hidden' );
					} else {
						row.classList.add( 'hidden' );
					}
				}
			} );

			updateYearLabels();

			if ( categoryMeta[ selectedCategory ] ) {
				subtitle.textContent = categoryMeta[ selectedCategory ].subtitle;
			}
		} );
	} );
} );
</script>

<?php get_footer(); ?>
