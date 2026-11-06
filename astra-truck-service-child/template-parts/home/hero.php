<?php
/**
 * Hero — bannière pleine largeur
 */

$hero_image_id = get_theme_mod( 'gts_hero_image' );
$hero_image    = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : GTS_CHILD_URI . '/assets/img/hero.jpg';
?>
<section class="gts-hero" style="background-image:url('<?php echo esc_url( $hero_image ); ?>');">
	<div class="gts-hero-overlay">
		<div class="gts-container">
			<p class="gts-hero-kicker"><?php echo esc_html( get_theme_mod( 'gts_hero_kicker', 'DÉPANNAGE - MAINTENANCE - RÉPARATION' ) ); ?></p>
			<h1 class="gts-hero-title"><?php echo esc_html( get_theme_mod( 'gts_hero_title', 'Guerineau Truck Service' ) ); ?></h1>
			<p class="gts-hero-subtitle"><?php echo esc_html( get_theme_mod( 'gts_hero_subtitle', 'Intervention poids lourds sur site' ) ); ?></p>
			<a class="gts-btn" href="<?php echo esc_url( get_theme_mod( 'gts_hero_btn_url', '#prestations' ) ); ?>">
				<?php echo esc_html( get_theme_mod( 'gts_hero_btn_label', 'Découvrir nos prestations' ) ); ?>
			</a>
		</div>
	</div>
</section>
