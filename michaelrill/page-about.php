<?php
/**
 * Template Name: About with Timeline
 *
 * Custom page template for the About page.
 * Shows the page content (editable in WP admin) followed by
 * a hardcoded career timeline.
 *
 * @package MichaelRill
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry' ); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>

	<section class="timeline-section">
		<div class="timeline-layout">

			<div class="timeline-heading-column">
				<span class="timeline-label">// timeline</span>
				<h2 class="timeline-title">How I got here</h2>
			</div>

			<div class="timeline-entries">

				<div class="timeline-entry">
					<span class="timeline-date">2023 – present</span>
					<h3 class="timeline-entry-title">Technical Program Management, Office AI &middot; Microsoft</h3>
					<p>I manage the TPM work within Microsoft&rsquo;s Office AI team, driving strategic initiatives to enhance AI capabilities across Office applications. My role involves orchestrating cross-functional teams, aligning product roadmaps with business goals, and making sure the engineering and strategy sides of the organization are moving in the same direction.</p>
				</div>

				<div class="timeline-entry">
					<span class="timeline-date">2020 – 2023</span>
					<h3 class="timeline-entry-title">Senior Director, Strategy and Planning, Microsoft Office</h3>
					<p>I led product strategy and planning for Microsoft Office, including the Insights and Icebreakers initiatives. The role was part product, part strategy — establishing go-to-market direction, working with Objectives and Key Results across the organization, and helping set the long-term direction for one of Microsoft&rsquo;s most used product families.</p>
				</div>

				<div class="timeline-entry">
					<span class="timeline-date">2017 – 2020</span>
					<h3 class="timeline-entry-title">Director, Incubation &middot; Microsoft Teams</h3>
					<p>I worked on incubation efforts within Microsoft Teams, exploring new product directions and driving cross-functional strategy. It was an early chapter of what became one of Microsoft&rsquo;s most strategically important products, and the experience of building within a fast-moving platform taught me a lot about how large organizations create new things.</p>
				</div>

				<div class="timeline-entry">
					<span class="timeline-date">2015 – 2017</span>
					<h3 class="timeline-entry-title">Head of Strategy and Program Management, Software Group &middot; Telstra</h3>
					<p>I led strategy and program management for Telstra&rsquo;s Software Group, responsible for the strategic direction and development of a portfolio of products. I came into this role having already spent time at Telstra in corporate strategy, and this was the step that moved me from advising on strategy to owning the execution of it.</p>
				</div>

				<div class="timeline-entry">
					<span class="timeline-date">2012 – 2015</span>
					<h3 class="timeline-entry-title">General Manager, Corporate Strategy &middot; Telstra</h3>
					<p>Working for Telstra&rsquo;s CFO, I developed strategic capabilities at the corporate level — working in close consultation with business owners on complex strategic issues and talent management questions. It was my first real taste of how a large enterprise thinks about its own future, and it gave me a framework for connecting financial strategy to business direction that I still use today.</p>
				</div>

				<div class="timeline-entry">
					<span class="timeline-date">~2008 – 2012</span>
					<h3 class="timeline-entry-title">Case Team Leader &middot; Bain &amp; Company</h3>
					<p>I spent several years at Bain as a management consultant, leading case teams across telecom, private equity, and financial services engagements in Germany, the UK, the US, and Australia. Consulting gave me a structured way of thinking about strategy and organizations, and working across industries and geographies early in my career was a formative experience I draw on constantly.</p>
				</div>

				<div class="timeline-entry">
					<span class="timeline-date">~2005 – 2008</span>
					<h3 class="timeline-entry-title">Researcher &amp; PhD Student &middot; University of Regensburg</h3>
					<p>I completed my doctorate at the University of Regensburg in Business Information Technology. My thesis examined the design of online customer interaction — how banks and financial institutions could rethink their digital touchpoints for the internet age. It was an early look at what would become a defining shift in how businesses relate to their customers.</p>
				</div>

				<div class="timeline-entry">
					<span class="timeline-date">Early 2000s</span>
					<h3 class="timeline-entry-title">Web Developer &middot; London</h3>
					<p>Before strategy and consulting, I built things. I worked as a web developer in London, responsible for design, implementation, and maintaining the global IT infrastructure of the organizations I worked with. Getting my hands dirty in code early on gave me a technical foundation that still makes me a more useful person in conversations about software and product.</p>
				</div>

			</div><!-- .timeline-entries -->

		</div><!-- .timeline-layout -->
	</section>

</main>

<?php get_footer(); ?>
