<?php
/**
 * Trois colonnes : Prestations / Matériel / Actualités
 */

$cols = array(
	1 => array( 'Nos prestations',        'Services, partenariats et catalogue pour votre flotte.' ),
	2 => array( 'Matériel / Équipement',  'Camion-atelier, valises de diagnostic, outillage et certifications.' ),
	3 => array( 'Actualités',             'Promotions, newsletter et conseils poids lourds.' ),
);
?>
<section class="gts-columns">
	<div class="gts-container">
		<div class="gts-columns-grid">
			<?php for ( $i = 1; $i <= 3; $i++ ) :
				$title = get_theme_mod( "gts_col_{$i}_title", $cols[ $i ][0] );
				$text  = get_theme_mod( "gts_col_{$i}_text", $cols[ $i ][1] );
				$img   = get_theme_mod( "gts_col_{$i}_image" );
				$link  = get_theme_mod( "gts_col_{$i}_link" );
				if ( ! $title ) { continue; }
				?>
				<article class="gts-col">
					<div class="gts-col-media">
						<?php if ( $img ) : ?>
							<?php echo wp_get_attachment_image( $img, 'large' ); ?>
						<?php endif; ?>
					</div>
					<div class="gts-col-body">
						<h3><?php echo esc_html( $title ); ?></h3>
						<p><?php echo esc_html( $text ); ?></p>
						<?php if ( $link ) : ?>
							<a class="gts-link" href="<?php echo esc_url( $link ); ?>">En savoir plus →</a>
						<?php endif; ?>
					</div>
				</article>
			<?php endfor; ?>
		</div>
	</div>
</section>
