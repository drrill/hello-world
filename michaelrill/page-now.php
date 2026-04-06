<?php
/**
 * Template Name: Now
 *
 * Custom page template for the Now page.
 * Two-column layout with labels on the left and content on the right,
 * matching the timeline style from the About page.
 *
 * Edit the sections below to update what you're up to.
 * Last updated date appears at the top.
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
					<p class="now-updated">Last updated: April 2026</p>
					<?php if ( get_the_content() ) : ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

	<section class="now-section">

		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<h3 class="timeline-entry-title">Working on</h3>
			</div>
			<div class="timeline-content-column">
				<p>Leading Technical Program Management within the Office AI team at Microsoft. Currently focused on building an Office-wide Eval System and managing our fleet of GPUs for Copilot feature rollouts.</p>
			</div>
		</div>

		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<h3 class="timeline-entry-title">Reading</h3>
			</div>
			<div class="timeline-content-column">
				<p>Too many RSS feeds in Feedly. I pay for it and I intend to get my money&rsquo;s worth.</p>
			</div>
		</div>

		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<h3 class="timeline-entry-title">Thinking about</h3>
			</div>
			<div class="timeline-content-column">
				<p>Whether short-form writing counts as writing or just as thinking out loud. How to write more regularly. The value of flossing.</p>
			</div>
		</div>

		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<h3 class="timeline-entry-title">Tinkering with</h3>
			</div>
			<div class="timeline-content-column">
				<p>This website. Built as a classic WordPress theme with help from Claude. Self-hosted fonts, dark mode, and an Easter egg you probably won&rsquo;t find.</p>
			</div>
		</div>

		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<h3 class="timeline-entry-title">Based in</h3>
			</div>
			<div class="timeline-content-column">
				<p>Seattle area.</p>
			</div>
		</div>

	</section>

</main>

<?php get_footer(); ?>
