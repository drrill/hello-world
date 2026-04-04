<?php
/**
 * Template Name: Contact
 *
 * Contact page with a simple form that sends email via wp_mail.
 *
 * @package MichaelRill
 */

get_header();

$success = get_transient( 'michaelrill_contact_success' );
$error   = get_transient( 'michaelrill_contact_error' );
if ( $success ) {
	delete_transient( 'michaelrill_contact_success' );
}
if ( $error ) {
	delete_transient( 'michaelrill_contact_error' );
}
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry' ); ?>>

			<div class="page-meta-column">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</div>

			<div class="page-content-column">
				<?php if ( get_the_content() ) : ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

				<?php if ( $success ) : ?>
					<div class="contact-message contact-success">
						<p><?php echo esc_html( $success ); ?></p>
					</div>
				<?php endif; ?>

				<?php if ( $error ) : ?>
					<div class="contact-message contact-error">
						<p><?php echo esc_html( $error ); ?></p>
					</div>
				<?php endif; ?>

				<?php if ( ! $success ) : ?>
					<form method="post" class="contact-form">
						<?php wp_nonce_field( 'michaelrill_contact', 'michaelrill_contact_nonce' ); ?>

						<div class="form-field">
							<label for="contact_name">Name</label>
							<input type="text" id="contact_name" name="contact_name" required
								value="<?php echo esc_attr( $_POST['contact_name'] ?? '' ); ?>">
						</div>

						<div class="form-field">
							<label for="contact_email">Email</label>
							<input type="email" id="contact_email" name="contact_email" required
								value="<?php echo esc_attr( $_POST['contact_email'] ?? '' ); ?>">
						</div>

						<div class="form-field">
							<label for="contact_message">Message</label>
							<textarea id="contact_message" name="contact_message" rows="6" required><?php
								echo esc_textarea( $_POST['contact_message'] ?? '' );
							?></textarea>
						</div>

						<button type="submit" class="contact-submit">Send message</button>
					</form>
				<?php endif; ?>
			</div>

		</article>
	<?php endwhile; ?>

</main>

<?php get_footer(); ?>
