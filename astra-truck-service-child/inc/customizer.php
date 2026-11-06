<?php
/**
 * Panneau Customizer : "Truck Service (Enfant)"
 */

function gts_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'gts_panel', array(
		'title'       => __( 'Truck Service (Enfant)', 'astra-truck-service-child' ),
		'priority'    => 10,
		'description' => __( 'Réglages du design de la page d’accueil.', 'astra-truck-service-child' ),
	) );

	/* ---------- Couleurs ---------- */
	$wp_customize->add_section( 'gts_colors', array(
		'title' => __( 'Couleurs', 'astra-truck-service-child' ),
		'panel' => 'gts_panel',
	) );

	$wp_customize->add_setting( 'gts_accent_color', array(
		'default'           => '#d62828',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gts_accent_color', array(
		'label'   => __( 'Couleur d’accent (rouge)', 'astra-truck-service-child' ),
		'section' => 'gts_colors',
	) ) );

	/* ---------- Header ---------- */
	$wp_customize->add_section( 'gts_header', array(
		'title' => __( 'Header / Contact', 'astra-truck-service-child' ),
		'panel' => 'gts_panel',
	) );

	$wp_customize->add_setting( 'gts_phone', array(
		'default'           => '05 00 00 00 00',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'gts_phone', array(
		'label'   => __( 'Numéro de téléphone', 'astra-truck-service-child' ),
		'section' => 'gts_header',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'gts_phone_label', array(
		'default'           => '24H/24 - 7J/7',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'gts_phone_label', array(
		'label'   => __( 'Mention à côté du téléphone', 'astra-truck-service-child' ),
		'section' => 'gts_header',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'gts_header_slogan', array(
		'default'           => "VOTRE PARTENAIRE PL<br>SUR LA ROUTE<br>ET SUR VOS CHANTIERS",
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'gts_header_slogan', array(
		'label'       => __( 'Slogan (gauche du header, <br> = saut de ligne)', 'astra-truck-service-child' ),
		'section'     => 'gts_header',
		'type'        => 'text',
		'description' => __( 'Utilisez <br> pour forcer les sauts de ligne.', 'astra-truck-service-child' ),
	) );

	$wp_customize->add_setting( 'gts_header_feature1', array(
		'default'           => 'DÉPANNAGE SUR SITE',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'gts_header_feature1', array(
		'label'   => __( 'Atout 1 (icône clé à molette)', 'astra-truck-service-child' ),
		'section' => 'gts_header',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'gts_header_feature2', array(
		'default'           => 'INTERVENTION RAPIDE',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'gts_header_feature2', array(
		'label'   => __( 'Atout 2 (icône horloge)', 'astra-truck-service-child' ),
		'section' => 'gts_header',
		'type'    => 'text',
	) );

	/* ---------- Hero ---------- */
	$wp_customize->add_section( 'gts_hero', array(
		'title' => __( 'Bannière (Hero)', 'astra-truck-service-child' ),
		'panel' => 'gts_panel',
	) );

	$hero_fields = array(
		'gts_hero_kicker'    => array( 'DÉPANNAGE - MAINTENANCE - RÉPARATION', __( 'Ligne rouge (kicker)', 'astra-truck-service-child' ) ),
		'gts_hero_title'     => array( 'Guerineau Truck Service', __( 'Titre principal', 'astra-truck-service-child' ) ),
		'gts_hero_subtitle'  => array( 'Intervention poids lourds sur site', __( 'Sous-titre', 'astra-truck-service-child' ) ),
		'gts_hero_btn_label' => array( 'Découvrir nos prestations', __( 'Bouton — libellé', 'astra-truck-service-child' ) ),
		'gts_hero_btn_url'   => array( '#prestations', __( 'Bouton — lien', 'astra-truck-service-child' ) ),
	);

	foreach ( $hero_fields as $id => $data ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $data[0],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $data[1],
			'section' => 'gts_hero',
			'type'    => 'text',
		) );
	}

	$wp_customize->add_setting( 'gts_hero_image', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'gts_hero_image', array(
		'label'       => __( 'Image de fond', 'astra-truck-service-child' ),
		'section'     => 'gts_hero',
		'mime_type'  => 'image',
	) ) );

	/* ---------- Services ---------- */
	$wp_customize->add_section( 'gts_services', array(
		'title' => __( 'Services (4 icônes)', 'astra-truck-service-child' ),
		'panel' => 'gts_panel',
	) );

	$wp_customize->add_setting( 'gts_services_title', array(
		'default'           => 'Nos services',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'gts_services_title', array(
		'label'   => __( 'Titre de section', 'astra-truck-service-child' ),
		'section' => 'gts_services',
		'type'    => 'text',
	) );

	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( "gts_service_{$i}_icon", array(
			'default'           => 'wrench',
			'sanitize_callback' => 'gts_sanitize_icon',
		) );
		$wp_customize->add_control( "gts_service_{$i}_icon", array(
			'label'   => sprintf( __( 'Service %d — pictogramme', 'astra-truck-service-child' ), $i ),
			'section' => 'gts_services',
			'type'    => 'select',
			'choices' => gts_icon_choices(),
		) );

		$wp_customize->add_setting( "gts_service_{$i}_title", array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "gts_service_{$i}_title", array(
			'label'   => sprintf( __( 'Service %d — titre', 'astra-truck-service-child' ), $i ),
			'section' => 'gts_services',
			'type'    => 'text',
		) );

		$wp_customize->add_setting( "gts_service_{$i}_text", array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( "gts_service_{$i}_text", array(
			'label'   => sprintf( __( 'Service %d — description', 'astra-truck-service-child' ), $i ),
			'section' => 'gts_services',
			'type'    => 'textarea',
		) );
	}

	/* ---------- Colonnes ---------- */
	$wp_customize->add_section( 'gts_columns', array(
		'title' => __( 'Trois colonnes', 'astra-truck-service-child' ),
		'panel' => 'gts_panel',
	) );

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( "gts_col_{$i}_title", array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "gts_col_{$i}_title", array(
			'label'   => sprintf( __( 'Colonne %d — titre', 'astra-truck-service-child' ), $i ),
			'section' => 'gts_columns',
			'type'    => 'text',
		) );

		$wp_customize->add_setting( "gts_col_{$i}_text", array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( "gts_col_{$i}_text", array(
			'label'   => sprintf( __( 'Colonne %d — description', 'astra-truck-service-child' ), $i ),
			'section' => 'gts_columns',
			'type'    => 'textarea',
		) );

		$wp_customize->add_setting( "gts_col_{$i}_image", array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "gts_col_{$i}_image", array(
			'label'      => sprintf( __( 'Colonne %d — image', 'astra-truck-service-child' ), $i ),
			'section'    => 'gts_columns',
			'mime_type' => 'image',
		) ) );

		$wp_customize->add_setting( "gts_col_{$i}_link", array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( "gts_col_{$i}_link", array(
			'label'   => sprintf( __( 'Colonne %d — lien', 'astra-truck-service-child' ), $i ),
			'section' => 'gts_columns',
			'type'    => 'url',
		) );
	}

	/* ---------- Newsletter ---------- */
	$wp_customize->add_section( 'gts_newsletter', array(
		'title' => __( 'Newsletter (footer)', 'astra-truck-service-child' ),
		'panel' => 'gts_panel',
	) );

	$wp_customize->add_setting( 'gts_newsletter_title', array(
		'default'           => 'Plus loin ensemble',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'gts_newsletter_title', array(
		'label'   => __( 'Titre', 'astra-truck-service-child' ),
		'section' => 'gts_newsletter',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'gts_newsletter_text', array(
		'default'           => 'Inscrivez-vous pour recevoir nos promotions et conseils poids lourds.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'gts_newsletter_text', array(
		'label'   => __( 'Texte', 'astra-truck-service-child' ),
		'section' => 'gts_newsletter',
		'type'    => 'textarea',
	) );

	$wp_customize->selective_refresh->add_partial( 'gts_hero_title', array(
		'selector'        => '.gts-hero-title',
		'render_callback' => function() { return get_theme_mod( 'gts_hero_title' ); },
	) );
}
add_action( 'customize_register', 'gts_customize_register' );
