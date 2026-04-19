<?php
/**
 * Contact section — form posts to admin-post.php handler.
 *
 * @package JocelyneBosschot
 */

$submitted = isset( $_GET['jb_contact'] ) ? sanitize_key( wp_unslash( $_GET['jb_contact'] ) ) : '';
?>
<section class="contact-section" id="contact">
	<div class="section-inner">
		<p class="section-label reveal">Contact</p>
		<h2 class="section-title reveal"><em>Contact</em></h2>

		<?php if ( 'sent' === $submitted ) : ?>
			<p class="contact-notice reveal" role="status">
				<span data-lang="fr">Merci, votre message a bien été envoyé.</span>
				<span data-lang="en">Thank you, your message has been sent.</span>
			</p>
		<?php elseif ( 'error' === $submitted ) : ?>
			<p class="contact-notice contact-notice--error reveal" role="alert">
				<span data-lang="fr">Une erreur est survenue. Merci de réessayer.</span>
				<span data-lang="en">An error occurred. Please try again.</span>
			</p>
		<?php endif; ?>

		<div class="contact-grid">
			<div class="contact-info reveal">
				<p><span data-lang="fr">Pour toute demande d'information sur une œuvre, commande personnalisée, exposition ou collaboration.</span><span data-lang="en">For any inquiry about a piece, custom order, exhibition or collaboration.</span></p>
				<div class="contact-detail">
					<div class="contact-detail-label">E-mail</div>
					<div class="contact-detail-value"><a href="mailto:contact@jocelynebosschot.com">contact@jocelynebosschot.com</a></div>
				</div>
				<div class="contact-detail">
					<div class="contact-detail-label"><span data-lang="fr">Localisation</span><span data-lang="en">Location</span></div>
					<div class="contact-detail-value">Saint-Laurent-du-Var, France</div>
				</div>
				<div class="contact-detail">
					<div class="contact-detail-label"><span data-lang="fr">Réponse</span><span data-lang="en">Response</span></div>
					<div class="contact-detail-value"><span data-lang="fr">Sous 48 heures</span><span data-lang="en">Within 48 hours</span></div>
				</div>
			</div>
			<form class="contact-form reveal" style="transition-delay:0.12s" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" aria-label="<?php esc_attr_e( 'Formulaire de contact', 'jocelyne-bosschot' ); ?>">
				<input type="hidden" name="action" value="jb_contact">
				<?php wp_nonce_field( 'jb_contact', 'jb_contact_nonce' ); ?>
				<div class="form-group">
					<label for="jb-name"><span data-lang="fr">Nom</span><span data-lang="en">Name</span> *</label>
					<input type="text" id="jb-name" name="name" required autocomplete="name">
				</div>
				<div class="form-group">
					<label for="jb-email">E-mail *</label>
					<input type="email" id="jb-email" name="email" required autocomplete="email">
				</div>
				<div class="form-group">
					<label for="jb-subject"><span data-lang="fr">Sujet</span><span data-lang="en">Subject</span> *</label>
					<select id="jb-subject" name="subject" required>
						<option value="" disabled selected>— <span data-lang="fr">Choisir</span><span data-lang="en">Choose</span> —</option>
						<option>Information sur une œuvre</option>
						<option>Achat</option>
						<option>Commande personnalisée</option>
						<option>Exposition / collaboration</option>
						<option>Presse</option>
						<option>Autre</option>
					</select>
				</div>
				<div class="form-group">
					<label for="jb-message">Message *</label>
					<textarea id="jb-message" name="message" rows="4" required></textarea>
				</div>
				<button type="submit" class="form-submit"><span data-lang="fr">Envoyer</span><span data-lang="en">Send</span></button>
			</form>
		</div>
	</div>
</section>
