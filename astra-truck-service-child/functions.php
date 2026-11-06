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
 * Bandeau téléphone "24H/24 – 7J/7" au-dessus du header
 */
function gts_top_bar() {
	$phone = get_theme_mod( 'gts_phone', '05 00 00 00 00' );
	$label = get_theme_mod( 'gts_phone_label', '24H/24 - 7J/7' );
	if ( ! $phone ) {
		return;
	}
	printf(
		'<div class="gts-topbar"><div class="gts-container"><span class="gts-topbar-tag">%s</span><a class="gts-topbar-phone" href="tel:%s">%s</a></div></div>',
		esc_html( $label ),
		esc_attr( preg_replace( '/\s+/', '', $phone ) ),
		esc_html( $phone )
	);
}
add_action( 'astra_header_before', 'gts_top_bar' );
