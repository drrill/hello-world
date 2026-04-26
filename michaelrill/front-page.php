<?php
/**
 * Front page template — bento/mosaic landing page.
 *
 * @package MichaelRill
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="bento-grid" aria-label="<?php esc_attr_e( 'Featured content', 'michaelrill' ); ?>">

		<div class="bento-tile bento-tile--hero">
			<span class="bento-tile__word">Curious.</span>
		</div>

		<blockquote class="bento-tile bento-tile--quote">
			<p>Every level of seniority I&rsquo;ve reached has come with its own new version of &lsquo;wait, I&rsquo;m not sure what I&rsquo;m doing here.&rsquo;</p>
		</blockquote>

		<div class="bento-tile bento-tile--about">
			<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="bento-about__link">
				<span class="bento-tile__label">About</span>
				<span class="bento-tile__arrow" aria-hidden="true">&rarr;</span>
			</a>
			<a href="<?php echo esc_url( home_url( '/archive/' ) ); ?>" class="bento-about__link">
				<span class="bento-tile__label">Archive</span>
				<span class="bento-tile__arrow" aria-hidden="true">&rarr;</span>
			</a>
		</div>

		<a href="<?php echo esc_url( home_url( '/2023/02/09/the-okr-operators-manual/' ) ); ?>" class="bento-tile bento-tile--article bento-tile--okr">
			<span class="bento-tile__read">Read</span>
			<span class="bento-tile__title">The OKR Operator&rsquo;s Manual</span>
		</a>

		<a href="<?php echo esc_url( home_url( '/2022/10/04/using-brevity-to-write-better/' ) ); ?>" class="bento-tile bento-tile--article bento-tile--brevity">
			<span class="bento-tile__read">Read</span>
			<span class="bento-tile__title">Using brevity to write better</span>
		</a>

		<a href="<?php echo esc_url( home_url( '/2016/06/01/writing-well-often/' ) ); ?>" class="bento-tile bento-tile--article bento-tile--writing">
			<span class="bento-tile__read">Read</span>
			<span class="bento-tile__title">Writing well, often</span>
		</a>

		<a href="<?php echo esc_url( home_url( '/2020/05/17/less-is-more-difficult-writing-summaries/' ) ); ?>" class="bento-tile bento-tile--article bento-tile--less">
			<span class="bento-tile__read">Read</span>
			<span class="bento-tile__title">Less is more&hellip; difficult</span>
		</a>

		<a href="<?php echo esc_url( home_url( '/2019/12/27/dear-library-thank-you/' ) ); ?>" class="bento-tile bento-tile--article bento-tile--library">
			<span class="bento-tile__read">Read</span>
			<span class="bento-tile__title">Dear Library, Thank You!</span>
		</a>

		<a href="<?php echo esc_url( home_url( '/2022/01/17/staying-clear-of-golden-apples/' ) ); ?>" class="bento-tile bento-tile--article bento-tile--golden">
			<span class="bento-tile__read">Read</span>
			<span class="bento-tile__title">Staying Clear of Golden Apples</span>
		</a>

		<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="bento-tile bento-tile--blog">
			<span class="bento-tile__label">All Posts</span>
			<span class="bento-tile__subtitle">The complete blog</span>
			<span class="bento-tile__arrow" aria-hidden="true">&rarr;</span>
		</a>

		<div class="bento-tile bento-tile--ident">
			<span>michaelrill.xyz &middot; est. 2015 &middot; pacific northwest</span>
		</div>

	</section>
</main>

<?php get_footer(); ?>
