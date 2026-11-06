<?php
/**
 * Services — 4 blocs icônes
 */

$icons = array(
	'truck'  => '<path d="M3 6h11v8H3zM14 9h4l3 3v2h-7z"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>',
	'wrench' => '<path d="M21 6.5a5 5 0 0 1-6.6 4.7L7 18.6A2.4 2.4 0 1 1 3.6 15l7.4-7.4A5 5 0 0 1 17.6 1l-3 3 1.4 3 3-1.4z"/>',
	'gauge'  => '<path d="M12 4a10 10 0 0 0-10 10h3a7 7 0 1 1 14 0h3A10 10 0 0 0 12 4z"/><path d="M12 10l4 5h-8z"/>',
	'plug'   => '<path d="M7 2v6M17 2v6M5 8h14v3a7 7 0 0 1-14 0zM12 18v4"/>',
	'cog'    => '<path d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm9 4-2 .5v3l2 .5-1 2-2-1-2 2 1 2-2 1-1-2h-3l-1 2-2-1 1-2-2-2-2 1-1-2 2-.5v-3L2 12l2-.5v-3L2 8l1-2 2 1 2-2-1-2 2-1 1 2h3l1-2 2 1-1 2 2 2 2-1 1 2z"/>',
);

$defaults = array(
	1 => array( 'truck',  'Dépannage sur site',     'Intervention 24h/24 et 7j/7 partout sur le département.' ),
	2 => array( 'wrench', 'Maintenance préventive', 'Plans d’entretien adaptés à votre flotte.' ),
	3 => array( 'cog',    'Réparation mécanique',   'Remise en état rapide de vos véhicules utilitaires.' ),
	4 => array( 'gauge',  'Diagnostic électronique','Valises de diagnostic multi-marques.' ),
);
?>
<section id="prestations" class="gts-services">
	<div class="gts-container">
		<h2 class="gts-section-title"><?php echo esc_html( get_theme_mod( 'gts_services_title', 'Nos services' ) ); ?></h2>
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
