<?php
/**
 * Newsletter — bandeau avant le footer
 */
?>
<section class="gts-newsletter">
	<div class="gts-container gts-newsletter-inner">
		<div class="gts-newsletter-text">
			<h2><?php echo esc_html( get_theme_mod( 'gts_newsletter_title', 'Plus loin ensemble' ) ); ?></h2>
			<p><?php echo esc_html( get_theme_mod( 'gts_newsletter_text', 'Inscrivez-vous pour recevoir nos promotions et conseils poids lourds.' ) ); ?></p>
		</div>
		<form class="gts-newsletter-form" method="post" action="#">
			<input type="email" name="gts_email" required placeholder="<?php esc_attr_e( 'Votre e-mail', 'astra-truck-service-child' ); ?>" />
			<button type="submit" class="gts-btn"><?php esc_html_e( 'S’inscrire', 'astra-truck-service-child' ); ?></button>
		</form>
	</div>
</section>
