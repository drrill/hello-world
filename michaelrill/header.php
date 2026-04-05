<?php
/**
 * The header template.
 *
 * @package MichaelRill
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<script>
	(function(){var t=localStorage.getItem('michaelrill-theme');if(!t){var h=new Date().getHours();t=(window.matchMedia&&window.matchMedia('(prefers-color-scheme:dark)').matches)?'dark':(h>=7&&h<20?'light':'dark')}document.documentElement.setAttribute('data-theme',t)})();
	</script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'michaelrill' ); ?></a>

	<header class="site-header">
		<div class="header-inner">

			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php endif; ?>

				<div class="branding-text">
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</p>
					<?php
					$michaelrill_description = get_bloginfo( 'description', 'display' );
					if ( $michaelrill_description ) :
					?>
						<p class="site-description"><?php echo $michaelrill_description; ?></p>
					<?php endif; ?>
				</div>
			</div>

			<div class="header-right">
				<?php get_search_form(); ?>

				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'michaelrill' ); ?>">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'michaelrill' ); ?>">
						<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M4 7.5h16v1.5H4z"></path>
							<path d="M4 15h16v1.5H4z"></path>
						</svg>
					</button>
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'fallback_cb'    => false,
						) );
					} else {
						// Fallback navigation when no menu is assigned in WP admin.
						?>
						<ul id="primary-menu" class="menu">
							<li><a href="<?php echo esc_url( home_url( '/type/aside/' ) ); ?>">Asides</a></li>
							<li><a href="<?php echo esc_url( home_url( '/archive/' ) ); ?>">Archive</a></li>
							<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
							<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
						</ul>
						<?php
					}
					?>
				</nav>
				<button class="theme-toggle" aria-label="Toggle dark mode" title="Toggle dark mode">
					<span class="icon-moon"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M21.752 15.002A9.718 9.718 0 0 1 18 15.75 9.75 9.75 0 0 1 8.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25 9.75 9.75 0 0 0 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/></svg></span>
					<span class="icon-sun"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg></span>
				</button>
			</div>

		</div>
	</header>

	<div id="content" class="site-content">
