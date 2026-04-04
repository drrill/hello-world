<?php
/**
 * Template Name: About with Timeline
 *
 * Custom page template for the About page.
 * Uses the same two-column layout as the homepage/single posts:
 * left column has a label/heading, right column has the main content.
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

		<!-- Microsoft -->
		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<span class="timeline-date">2017 – present</span>
				<h3 class="timeline-entry-title">Microsoft</h3>
			</div>
			<div class="timeline-content-column">
				<p>I joined Microsoft to work on incubation efforts within Microsoft Teams, exploring new product directions and driving cross-functional strategy during an early chapter of what became one of Microsoft&rsquo;s most strategically important products.</p>
				<p>From there I moved into strategy and planning for Microsoft Office, leading product direction for initiatives including Insights and Icebreakers &mdash; establishing go-to-market direction, working with Objectives and Key Results across the organization, and helping set the long-term course for one of Microsoft&rsquo;s most used product families.</p>
				<p>Today I manage the TPM work within the Office AI team, driving strategic initiatives to enhance AI capabilities across Office applications. My role involves orchestrating cross-functional teams, aligning product roadmaps with business goals, and making sure the engineering and strategy sides of the organization are moving in the same direction.</p>
			</div>
		</div>

		<!-- Telstra -->
		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<span class="timeline-date">2012 – 2017</span>
				<h3 class="timeline-entry-title">Telstra</h3>
			</div>
			<div class="timeline-content-column">
				<p>I started at Telstra working for the CFO, developing strategic capabilities at the corporate level &mdash; complex strategic issues, talent management, and connecting financial strategy to business direction. It was my first real taste of how a large enterprise thinks about its own future.</p>
				<p>That led to running strategy and program management for Telstra&rsquo;s Software Group, where I was responsible for the strategic direction and development of a portfolio of products. It was the step that moved me from advising on strategy to owning the execution of it.</p>
			</div>
		</div>

		<!-- Bain & Company -->
		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<span class="timeline-date">~2008 – 2012</span>
				<h3 class="timeline-entry-title">Bain &amp; Company</h3>
			</div>
			<div class="timeline-content-column">
				<p>I spent several years at Bain as a management consultant, leading case teams across telecom, private equity, and financial services engagements in Germany, the UK, the US, and Australia. Consulting gave me a structured way of thinking about strategy and organizations, and working across industries and geographies early in my career was a formative experience I draw on constantly.</p>
			</div>
		</div>

		<!-- University of Regensburg -->
		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<span class="timeline-date">~2005 – 2008</span>
				<h3 class="timeline-entry-title">University of Regensburg</h3>
			</div>
			<div class="timeline-content-column">
				<p>I completed my doctorate in Business Information Technology. My thesis examined the design of online customer interaction &mdash; how banks and financial institutions could rethink their digital touchpoints for the internet age. It was an early look at what would become a defining shift in how businesses relate to their customers.</p>
			</div>
		</div>

		<!-- Web Developer -->
		<div class="timeline-layout timeline-group">
			<div class="timeline-meta-column">
				<span class="timeline-date">Early 2000s</span>
				<h3 class="timeline-entry-title">Web Developer &middot; London</h3>
			</div>
			<div class="timeline-content-column">
				<p>Before strategy and consulting, I built things. I worked as a web developer in London, responsible for design, implementation, and maintaining the global IT infrastructure of the organizations I worked with. Getting my hands dirty in code early on gave me a technical foundation that still makes me a more useful person in conversations about software and product.</p>
			</div>
		</div>

	</section>

</main>

<?php get_footer(); ?>
