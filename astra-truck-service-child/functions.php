<?php
/**
 * Astra Truck Service Child — functions
 */

define( 'GTS_CHILD_VERSION', '1.0.0' );
define( 'GTS_CHILD_DIR', get_stylesheet_directory() );
define( 'GTS_CHILD_URI', get_stylesheet_directory_uri() );

require_once GTS_CHILD_DIR . '/inc/customizer.php';

/**
 * Pictogrammes disponibles pour les services (SVG, stroke currentColor)
 */
function gts_icons() {
	return array(
		'truck'   => '<path d="M3 6h11v8H3zM14 9h4l3 3v2h-7z"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>',
		'wrench'  => '<path d="M21 6.5a5 5 0 0 1-6.6 4.7L7 18.6A2.4 2.4 0 1 1 3.6 15l7.4-7.4A5 5 0 0 1 17.6 1l-3 3 1.4 3 3-1.4z"/>',
		'cog'     => '<path d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm9 4-2 .5v3l2 .5-1 2-2-1-2 2 1 2-2 1-1-2h-3l-1 2-2-1 1-2-2-2-2 1-1-2 2-.5v-3L2 12l2-.5v-3L2 8l1-2 2 1 2-2-1-2 2-1 1 2h3l1-2 2 1-1 2 2 2 2-1 1 2z"/>',
		'gauge'   => '<path d="M12 4a10 10 0 0 0-10 10h3a7 7 0 1 1 14 0h3A10 10 0 0 0 12 4z"/><path d="M12 10l4 5h-8z"/>',
		'plug'    => '<path d="M7 2v6M17 2v6M5 8h14v3a7 7 0 0 1-14 0zM12 18v4"/>',
		'clock'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
		'bolt'     => '<path d="M13 2 4 14h6l-1 8 9-12h-6z"/>',
		'droplet'  => '<path d="M12 3s6 6.5 6 11a6 6 0 0 1-12 0c0-4.5 6-11 6-11z"/>',
	);
}

/**
 * Libellés des pictogrammes pour le Customizer
 */
function gts_icon_choices() {
	return array(
		'truck'   => __( 'Camion', 'astra-truck-service-child' ),
		'wrench'  => __( 'Clé à molette', 'astra-truck-service-child' ),
		'cog'     => __( 'Engrenage', 'astra-truck-service-child' ),
		'gauge'   => __( 'Compteur', 'astra-truck-service-child' ),
		'plug'    => __( 'Électricité', 'astra-truck-service-child' ),
		'clock'   => __( 'Horloge', 'astra-truck-service-child' ),
		'bolt'    => __( 'Éclair', 'astra-truck-service-child' ),
		'droplet' => __( 'Goutte (huile)', 'astra-truck-service-child' ),
	);
}

/**
 * Valider un pictogramme choisi
 */
function gts_sanitize_icon( $value ) {
	$icons = gts_icons();
	return isset( $icons[ $value ] ) ? $value : 'wrench';
}

/**
 * Styles parent + enfant
 */
function gts_child_enqueue_styles() {
	wp_enqueue_style(
		'astra-parent',
		get_template_directory_uri() . '/style.css',
		array(),
		GTS_CHILD_VERSION
	);

	wp_enqueue_style(
		'gts-child-main',
		GTS_CHILD_URI . '/assets/css/main.css',
		array( 'astra-parent' ),
		GTS_CHILD_VERSION
	);

	// Variables issues du Customizer (couleur d'accent, etc.)
	$accent = get_theme_mod( 'gts_accent_color', '#d62828' );
	$css = sprintf(
		':root{--gts-accent:%s;--gts-accent-hover:%s;}',
		sanitize_hex_color( $accent ),
		gts_darken( $accent, 15 )
	);
	wp_add_inline_style( 'gts-child-main', $css );
}
add_action( 'wp_enqueue_scripts', 'gts_child_enqueue_styles', 20 );

/**
 * Assombrir une couleur hexadécimale (helper)
 */
function gts_darken( $hex, $percent ) {
	$hex = ltrim( sanitize_hex_color( $hex ) ?: '#d62828', '#' );
	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	$r = max( 0, hexdec( substr( $hex, 0, 2 ) ) - round( 255 * $percent / 100 ) );
	$g = max( 0, hexdec( substr( $hex, 2, 2 ) ) - round( 255 * $percent / 100 ) );
	$b = max( 0, hexdec( substr( $hex, 4, 2 ) ) - round( 255 * $percent / 100 ) );
	return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

/**
 * Sections de la page d'accueil (hookées après le contenu Astra)
 * Rendu uniquement sur la page d'accueil statique/front page.
 */
function gts_render_home_sections() {
	if ( ! is_front_page() ) {
		return;
	}
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/services' );
	get_template_part( 'template-parts/home/columns' );
	get_template_part( 'template-parts/home/newsletter' );
}
add_action( 'astra_content_before', 'gts_render_home_sections' );

/**
 * Header complet sur mesure (remplace le header Astra, masqué en CSS) :
 * barre blanche logo + slogan + 2 atouts + bloc téléphone rouge,
 * puis bande grise avec le menu de navigation.
 */
function gts_custom_header() {
	$slogan    = get_theme_mod( 'gts_header_slogan', "VOTRE PARTENAIRE PL<br>SUR LA ROUTE<br>ET SUR VOS CHANTIERS" );
	$feat1     = get_theme_mod( 'gts_header_feature1', 'DÉPANNAGE SUR SITE' );
	$feat2     = get_theme_mod( 'gts_header_feature2', 'INTERVENTION RAPIDE' );
	$phone     = get_theme_mod( 'gts_phone', '06 12 34 56 78' );
	$phone_tag = get_theme_mod( 'gts_phone_label', '24H/24 - 7J/7' );

	if ( has_custom_logo() ) {
		$brand = sprintf( '<div class="gts-brand-logo">%s</div>', get_custom_logo() );
	} else {
		$brand = sprintf(
			'<div class="gts-brand-logo gts-brand-text">%s</div>',
			get_bloginfo( 'name' )
		);
	}
	?>
	<header class="gts-header">
		<div class="gts-header-top">
			<div class="gts-container gts-header-inner">
				<?php echo $brand; ?>
				<?php if ( $slogan ) : ?>
					<p class="gts-slogan"><?php echo wp_kses( $slogan, array( 'br' => array() ) ); ?></p>
				<?php endif; ?>
				<div class="gts-features">
					<?php if ( $feat1 ) : ?>
						<div class="gts-feature">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M21 6.5a5 5 0 0 1-6.6 4.7L7 18.6A2.4 2.4 0 1 1 3.6 15l7.4-7.4A5 5 0 0 1 17.6 1l-3 3 1.4 3 3-1.4z"/></svg>
							<span><?php echo esc_html( $feat1 ); ?></span>
						</div>
					<?php endif; ?>
					<?php if ( $feat2 ) : ?>
						<div class="gts-feature">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
							<span><?php echo esc_html( $feat2 ); ?></span>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( $phone ) : ?>
					<a class="gts-phone-box" href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>">
						<svg class="gts-phone-picto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg>
						<span class="gts-phone-text">
							<strong class="gts-phone-number"><?php echo esc_html( $phone ); ?></strong>
							<?php if ( $phone_tag ) : ?><span class="gts-phone-tag"><?php echo esc_html( $phone_tag ); ?></span><?php endif; ?>
						</span>
					</a>
					<?php endif; ?>
			</div>
		</div>
		<div class="gts-header-nav">
			<div class="gts-container gts-nav-inner">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => 'nav',
					'container_class'=> 'gts-nav',
					'menu_class'     => 'gts-menu',
					'fallback_cb'    => 'wp_page_menu',
				) );
				?>
				<div class="gts-nav-search">
					<form role="search" method="get" class="gts-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search" name="s" placeholder="<?php esc_attr_e( 'Rechercher&hellip;', 'astra-truck-service-child' ); ?>">
						<button type="submit" class="gts-search-btn" aria-label="<?php esc_attr_e( 'Rechercher', 'astra-truck-service-child' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.8-3.8"/></svg>
						</button>
					</form>
				</div>
			</div>
		</div>
	</header>
	<?php
}
add_action( 'astra_header_before', 'gts_custom_header' );
