<?php
/**
 * Astra Truck Service Child — functions
 */

define( 'GTS_CHILD_VERSION', '1.0.0' );
define( 'GTS_CHILD_DIR', get_stylesheet_directory() );
define( 'GTS_CHILD_URI', get_stylesheet_directory_uri() );

require_once GTS_CHILD_DIR . '/inc/customizer.php';

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
	$slogan    = get_theme_mod( 'gts_header_slogan', 'VOTRE PARTENAIRE PL SUR LA ROUTE ET SUR VOS CHANTIERS' );
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
					<p class="gts-slogan"><?php echo esc_html( $slogan ); ?></p>
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
						<strong class="gts-phone-number"><?php echo esc_html( $phone ); ?></strong>
						<?php if ( $phone_tag ) : ?><span class="gts-phone-tag"><?php echo esc_html( $phone_tag ); ?></span><?php endif; ?>
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
					<input type="checkbox" id="gts-search-toggle" class="gts-search-toggle">
					<form role="search" method="get" class="gts-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search" name="s" placeholder="<?php esc_attr_e( 'Rechercher&hellip;', 'astra-truck-service-child' ); ?>">
					</form>
					<label for="gts-search-toggle" class="gts-search-btn" aria-label="<?php esc_attr_e( 'Rechercher', 'astra-truck-service-child' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.8-3.8"/></svg>
					</label>
				</div>
			</div>
		</div>
	</header>
	<?php
}
add_action( 'astra_header_before', 'gts_custom_header' );
