<?php
/**
 * Michael Rill theme functions and definitions.
 *
 * @package MichaelRill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for WordPress features.
 */
function michaelrill_setup() {
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Post formats — we use 'aside' for link posts.
	add_theme_support( 'post-formats', array( 'aside' ) );

	// Custom logo support matching the current 72×72 logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 72,
		'width'       => 72,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// HTML5 markup for core elements.
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Add RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Register navigation menu.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'michaelrill' ),
	) );
}
add_action( 'after_setup_theme', 'michaelrill_setup' );

/**
 * Set the content width based on the theme's design.
 */
function michaelrill_content_width() {
	$GLOBALS['content_width'] = 645;
}
add_action( 'after_setup_theme', 'michaelrill_content_width', 0 );

/**
 * Enqueue styles and scripts.
 */
function michaelrill_scripts() {
	// Main stylesheet.
	wp_enqueue_style(
		'michaelrill-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Mobile navigation toggle.
	wp_enqueue_script(
		'michaelrill-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'michaelrill_scripts' );

/**
 * Register self-hosted fonts via @font-face.
 */
function michaelrill_fonts() {
	$font_url = get_template_directory_uri() . '/assets/fonts/';
	$css = "
		@font-face {
			font-family: 'Manrope';
			font-style: normal;
			font-weight: 200 800;
			font-display: fallback;
			src: url('{$font_url}Manrope-VariableFont_wght.woff2') format('woff2');
		}
		@font-face {
			font-family: 'Fira Code';
			font-style: normal;
			font-weight: 300 700;
			font-display: fallback;
			src: url('{$font_url}FiraCode-VariableFont_wght.woff2') format('woff2');
		}
	";
	wp_add_inline_style( 'michaelrill-style', $css );
}
add_action( 'wp_enqueue_scripts', 'michaelrill_fonts' );

/**
 * Strip the "Category:", "Tag:", etc. prefix from archive titles.
 */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

/**
 * Output the post date in a consistent format.
 */
function michaelrill_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	echo '<div class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></div>';
}

/**
 * Output category list for a post.
 */
function michaelrill_post_categories() {
	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		echo '<div class="entry-categories">' . $categories_list . '</div>';
	}
}

/**
 * Output tag list for a post.
 */
function michaelrill_post_tags() {
	$tags_list = get_the_tag_list( '', ', ' );
	if ( $tags_list ) {
		echo '<div class="entry-tags">' . $tags_list . '</div>';
	}
}

/**
 * Output estimated reading time for a post.
 */
function michaelrill_reading_time() {
	$content    = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, round( $word_count / 250 ) );
	echo '<div class="reading-time">' . esc_html( $minutes ) . ' min read</div>';
}

/**
 * Output favicon using the custom logo.
 */
function michaelrill_favicon() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$logo_url = wp_get_attachment_image_url( $custom_logo_id, array( 32, 32 ) );
		if ( $logo_url ) {
			echo '<link rel="icon" href="' . esc_url( $logo_url ) . '" sizes="32x32">' . "\n";
			echo '<link rel="apple-touch-icon" href="' . esc_url( $logo_url ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'michaelrill_favicon' );

/**
 * Output Open Graph and Twitter meta tags.
 */
function michaelrill_og_meta() {
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary">' . "\n";

	if ( is_singular() ) {
		echo '<meta property="og:type" content="article">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";

		$excerpt = get_the_excerpt();
		if ( $excerpt ) {
			echo '<meta property="og:description" content="' . esc_attr( wp_trim_words( $excerpt, 30 ) ) . '">' . "\n";
			echo '<meta name="twitter:description" content="' . esc_attr( wp_trim_words( $excerpt, 30 ) ) . '">' . "\n";
		}

		if ( has_post_thumbnail() ) {
			$thumb_url = get_the_post_thumbnail_url( null, 'large' );
			echo '<meta property="og:image" content="' . esc_url( $thumb_url ) . '">' . "\n";
			echo '<meta name="twitter:image" content="' . esc_url( $thumb_url ) . '">' . "\n";
		}
	} else {
		echo '<meta property="og:type" content="website">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( home_url( '/' ) ) . '">' . "\n";

		$description = get_bloginfo( 'description' );
		if ( $description ) {
			echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'michaelrill_og_meta' );

/**
 * Handle contact form submission.
 */
function michaelrill_handle_contact_form() {
	if ( ! isset( $_POST['michaelrill_contact_nonce'] ) || ! wp_verify_nonce( $_POST['michaelrill_contact_nonce'], 'michaelrill_contact' ) ) {
		return;
	}

	// Honeypot: bots fill this hidden field, humans don't.
	if ( ! empty( $_POST['company'] ) ) {
		wp_die( 'Invalid submission.', 'Spam detected', array( 'response' => 403 ) );
	}

	// Time-based check: reject submissions faster than 3 seconds.
	$loaded_at = intval( $_POST['form_loaded_at'] ?? 0 );
	if ( time() - $loaded_at < 3 ) {
		wp_die( 'Invalid submission.', 'Spam detected', array( 'response' => 403 ) );
	}

	$name    = sanitize_text_field( $_POST['contact_name'] ?? '' );
	$email   = sanitize_email( $_POST['contact_email'] ?? '' );
	$message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		set_transient( 'michaelrill_contact_error', 'Please fill in all fields.', 30 );
		return;
	}

	if ( ! is_email( $email ) ) {
		set_transient( 'michaelrill_contact_error', 'Please enter a valid email address.', 30 );
		return;
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( 'Contact form: %s', $name );
	$body    = sprintf( "Name: %s\nEmail: %s\n\n%s", $name, $email, $message );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	if ( wp_mail( $to, $subject, $body, $headers ) ) {
		set_transient( 'michaelrill_contact_success', 'Thank you! Your message has been sent.', 30 );
	} else {
		set_transient( 'michaelrill_contact_error', 'Sorry, something went wrong. Please try again.', 30 );
	}
}
add_action( 'template_redirect', 'michaelrill_handle_contact_form' );

/**
 * Register Timeline Entry custom post type.
 */
function michaelrill_register_timeline_cpt() {
	register_post_type( 'timeline_entry', array(
		'labels' => array(
			'name'               => 'Timeline Entries',
			'singular_name'      => 'Timeline Entry',
			'add_new'            => 'Add New Entry',
			'add_new_item'       => 'Add New Timeline Entry',
			'edit_item'          => 'Edit Timeline Entry',
			'new_item'           => 'New Timeline Entry',
			'view_item'          => 'View Timeline Entry',
			'search_items'       => 'Search Timeline Entries',
			'not_found'          => 'No timeline entries found',
			'not_found_in_trash' => 'No timeline entries found in trash',
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-timeline',
		'supports'     => array( 'title', 'editor' ),
		'has_archive'  => false,
	) );
}
add_action( 'init', 'michaelrill_register_timeline_cpt' );

/**
 * Register Now Item custom post type.
 */
function michaelrill_register_now_cpt() {
	register_post_type( 'now_item', array(
		'labels' => array(
			'name'               => 'Now Items',
			'singular_name'      => 'Now Item',
			'add_new'            => 'Add New Item',
			'add_new_item'       => 'Add New Now Item',
			'edit_item'          => 'Edit Now Item',
			'new_item'           => 'New Now Item',
			'view_item'          => 'View Now Item',
			'search_items'       => 'Search Now Items',
			'not_found'          => 'No now items found',
			'not_found_in_trash' => 'No now items found in trash',
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-clock',
		'supports'     => array( 'title', 'editor' ),
		'has_archive'  => false,
	) );
}
add_action( 'init', 'michaelrill_register_now_cpt' );

/**
 * Add meta boxes for Timeline Entry fields.
 */
function michaelrill_timeline_meta_boxes() {
	add_meta_box(
		'timeline_details',
		'Timeline Details',
		'michaelrill_timeline_meta_box_html',
		'timeline_entry',
		'side'
	);
}
add_action( 'add_meta_boxes', 'michaelrill_timeline_meta_boxes' );

function michaelrill_timeline_meta_box_html( $post ) {
	$date_range = get_post_meta( $post->ID, '_timeline_date_range', true );
	$order      = get_post_meta( $post->ID, '_timeline_order', true );
	wp_nonce_field( 'michaelrill_timeline_meta', 'michaelrill_timeline_nonce' );
	?>
	<p>
		<label for="timeline_date_range"><strong>Date Range</strong></label><br>
		<input type="text" id="timeline_date_range" name="timeline_date_range" value="<?php echo esc_attr( $date_range ); ?>" style="width:100%;" placeholder="e.g. 2017 – present">
	</p>
	<p>
		<label for="timeline_order"><strong>Sort Order</strong></label><br>
		<input type="number" id="timeline_order" name="timeline_order" value="<?php echo esc_attr( $order ); ?>" style="width:100%;" placeholder="1 = first">
		<br><small>Lower numbers appear first.</small>
	</p>
	<?php
}

/**
 * Save Timeline Entry meta.
 */
function michaelrill_save_timeline_meta( $post_id ) {
	if ( ! isset( $_POST['michaelrill_timeline_nonce'] ) || ! wp_verify_nonce( $_POST['michaelrill_timeline_nonce'], 'michaelrill_timeline_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['timeline_date_range'] ) ) {
		update_post_meta( $post_id, '_timeline_date_range', sanitize_text_field( $_POST['timeline_date_range'] ) );
	}
	if ( isset( $_POST['timeline_order'] ) ) {
		update_post_meta( $post_id, '_timeline_order', intval( $_POST['timeline_order'] ) );
	}
}
add_action( 'save_post_timeline_entry', 'michaelrill_save_timeline_meta' );

/**
 * Add meta box for Now Item sort order.
 */
function michaelrill_now_meta_boxes() {
	add_meta_box(
		'now_details',
		'Now Item Details',
		'michaelrill_now_meta_box_html',
		'now_item',
		'side'
	);
}
add_action( 'add_meta_boxes', 'michaelrill_now_meta_boxes' );

function michaelrill_now_meta_box_html( $post ) {
	$order = get_post_meta( $post->ID, '_now_order', true );
	wp_nonce_field( 'michaelrill_now_meta', 'michaelrill_now_nonce' );
	?>
	<p>
		<label for="now_order"><strong>Sort Order</strong></label><br>
		<input type="number" id="now_order" name="now_order" value="<?php echo esc_attr( $order ); ?>" style="width:100%;" placeholder="1 = first">
		<br><small>Lower numbers appear first. The post title becomes the left-column label (e.g. "Working on").</small>
	</p>
	<?php
}

/**
 * Save Now Item meta.
 */
function michaelrill_save_now_meta( $post_id ) {
	if ( ! isset( $_POST['michaelrill_now_nonce'] ) || ! wp_verify_nonce( $_POST['michaelrill_now_nonce'], 'michaelrill_now_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['now_order'] ) ) {
		update_post_meta( $post_id, '_now_order', intval( $_POST['now_order'] ) );
	}
}
add_action( 'save_post_now_item', 'michaelrill_save_now_meta' );
