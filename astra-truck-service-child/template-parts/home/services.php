<?php
/**
 * Services — 4 blocs icônes
 */

$icons = gts_icons();

$defaults = array(
	1 => array( 'truck',  'Dépannage sur site',     'Intervention 24h/24 et 7j/7 partout sur le département.' ),
	2 => array( 'wrench', 'Maintenance préventive', 'Plans d’entretien adaptés à votre flotte.' ),
	3 => array( 'cog',    'Réparation mécanique',   'Remise en état rapide de vos véhicules utilitaires.' ),
	4 => array( 'gauge',  'Diagnostic électronique','Valises de diagnostic multi-marques.' ),
);
?>
<section id="prestations" class="gts-services">
	<div class="gts-container">
		<?php $services_title = get_theme_mod( 'gts_services_title', '' ); ?>
		<?php if ( $services_title ) : ?>
			<h2 class="gts-section-title"><?php echo esc_html( $services_title ); ?></h2>
		<?php endif; ?>
		<div class="gts-services-grid">
			<?php for ( $i = 1; $i <= 4; $i++ ) :
				$icon  = get_theme_mod( "gts_service_{$i}_icon", $defaults[ $i ][0] );
				$title = get_theme_mod( "gts_service_{$i}_title", $defaults[ $i ][1] );
				$text  = get_theme_mod( "gts_service_{$i}_text", $defaults[ $i ][2] );
				if ( ! $title ) { continue; }
				?>
				<div class="gts-service">
					<svg class="gts-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true">
						<?php echo isset( $icons[ $icon ] ) ? $icons[ $icon ] : $icons['wrench']; ?>
					</svg>
					<h3><?php echo esc_html( $title ); ?></h3>
					<p><?php echo esc_html( $text ); ?></p>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>
