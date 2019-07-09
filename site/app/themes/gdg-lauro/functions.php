<?php
defined( 'ABSPATH' ) or die;
define( 'THEME_PATH', get_template_directory_uri() . '/' );
define( 'IMAGES_PATH', THEME_PATH . 'img/' );

function gdg_get_page_title() {
	$siteName = get_bloginfo( 'name' );
	
	// Nomes amigáveis para custom post archives.
	$post_archive_map = [
		'palestrantes' => 'Palestrantes',
		'area-de-atuacao' => 'Áreas de Atuação',
	];

	if ( is_home() ) {
		return $siteName;
	}

	if ( is_category() ) {
		return single_cat_title( '', false ) . ' - ' . $siteName;
	}

	if ( is_tax() ) {
		return get_term( get_queried_object_id() )->name . ' - ' . $siteName;
	}

	foreach ( $post_archive_map as $post_type => $page_title ) {
		if ( is_post_type_archive( $post_type ) ) {
			return $page_title . ' - ' . $siteName;
		}
	}

	return get_the_title() . ' - ' . $siteName;
}

// Edite este array para gerenciar custom post types.
$my_cpts = array(
	// Palestrantes.
	array(
		'custom-post-name' => 'palestrante',
		'label-singular'   => 'Palestrante',
		'label-plural'     => 'Palestrantes',
		'gender'           => 'masc',
		'slug'             => 'palestrantes',
		'dashboard-icon'   => 'dashicons-welcome-learn-more',
	),
	// Patrocinadores.
	array(
		'custom-post-name' => 'patrocinador',
		'label-singular'   => 'Patrocinador',
		'label-plural'     => 'Patrocinadores',
		'gender'           => 'masc',
		'slug'             => 'patrocinadores',
		'dashboard-icon'   => 'dashicons-businessman',
	),
	// Depoimentos.
	array(
		'custom-post-name' => 'depoimento',
		'label-singular'   => 'Depoimento',
		'label-plural'     => 'Depoimentos',
		'gender'           => 'masc',
		'slug'             => 'depoimentos',
		'dashboard-icon'   => 'dashicons-testimonial',
	),
	// ... e por aí vai
);

// Ativar suporte a thumbnails.
add_theme_support( 'post-thumbnails' );

// Incluir o arquivo que gerencia a criação dos CPTs.
require __DIR__ . '/inc/custom-post-types.php';

// Edit this array to add theme customizer entries.
$my_customizer = array(
	array(
		'section'  => 'topo_site',
		'title'    => 'Topo do Site',
		'settings' => array(
			array(
				'setting'  => 'logo',
				'default'  => IMAGES_PATH . 'logo.svg',
				'type'     => 'image',
				'label'    => 'Logo',
				'selector' => '#event-logo',
			),
			array(
				'setting'  => 'titulo_evento',
				'default'  => 'The mobile app conference for everyone else.',
				'label'    => 'Título do Evento',
				'selector' => '#titulo-evento',
			),
			array(
				'setting'  => 'data_evento',
				'default'  => '14 - 19 March 2019',
				'label'    => 'Data do Evento',
				'selector' => '#data-evento',
			),
			array(
				'setting'  => 'local_evento',
				'default'  => 'Stockholm, Sweden',
				'label'    => 'Local do Evento',
				'selector' => '#local-evento',
			),
		)
	),
);

// Incluindo o arquivo que gerencia o Customizer.
require __DIR__ . '/inc/customizer.php';
