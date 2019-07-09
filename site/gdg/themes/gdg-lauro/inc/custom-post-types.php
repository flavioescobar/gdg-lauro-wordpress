<?php
defined( 'ABSPATH' ) or die;

function create_cpt_args(
	$labels,
	$supports,
	$public,
	$taxonomies = array(),
	$rewrite = '',
	$description = '',
	$showInNav = false,
	$hasArchive = false,
	$capabilityType = "post",
	$mapMetaCap = null,
	$menuIcon = null
) {
	if ( $taxonomies == null ) {
		$taxonomies = array();
	}

	return array(
		'labels'              => $labels,
		'supports'            => $supports,
		'public'              => $public,
		'publicly_queryable'  => $public,
		'hierarchical'        => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => false,
		'exclude_from_search' => false,
		'query_var'           => false,
		'can_export'          => true,
		'menu_position'       => 100,
		'capability_type'     => $capabilityType,
		'taxonomies'          => $taxonomies,
		'rewrite'             => $rewrite,
		'description'         => $description,
		'show_in_nav_menus'   => $showInNav,
		'has_archive'         => $hasArchive,
		'map_meta_cap'        => $mapMetaCap,
		'menu_icon'           => $menuIcon
	);
}

function create_cpt_labels( $singular, $plural, $cptName, $gender = 'masc' ) {
	$novo       = 'Novo';
	$todos      = 'Todos os';
	$nenhum     = 'Nenhum';
	$encontrado = 'encontrado';

	if ( $gender === 'fem' ) {
		$novo       = 'Nova';
		$todos      = 'Todas as';
		$nenhum     = 'Nenhuma';
		$encontrado = 'encontrada';
	}

	return array(
		'name'               => _x( $plural, 'post type general name' ),
		'singular_name'      => _x( $singular, 'post type singular name' ),
		'add_new'            => _x( 'Adicionar ' . $novo, $cptName ),
		'add_new_item'       => __( 'Adicionar ' . $novo . ' ' . $singular ),
		'edit_item'          => __( 'Editar ' . $singular ),
		'new_item'           => __( $novo . ' ' . $singular ),
		'all_items'          => __( $todos . ' ' . $plural ),
		'view_item'          => __( 'Ver ' . $singular ),
		'search_items'       => __( 'Buscar ' . $plural ),
		'not_found'          => __( $nenhum . ' ' . $singular . ' ' . $encontrado ),
		'not_found_in_trash' => __( $nenhum . ' ' . $singular . ' ' . $encontrado . ' na lixeira' ),
		'parent_item_colon'  => __( $singular . ' Pai:' ),
		'menu_name'          => __( $plural )
	);
}

function register_my_cpts()
{
	global $my_cpts;

	// Se não tivermos CPTs, não é necessário fazer nada.
	if ( ! is_array( $my_cpts ) ) {
		return;
	}

	foreach ( $my_cpts as $cpt ) {
		$gender = array_key_exists( 'gender', $cpt ) ? $cpt['gender'] : 'masc';
		$dashboard_icon = array_key_exists( 'dashboard-icon', $cpt ) ? $cpt['dashboard-icon'] : null;

		$labels = create_cpt_labels(
			$cpt['label-singular'],
			$cpt['label-plural'],
			$cpt['custom-post-name'],
			$gender
		);
		$taxonomies = array();
		$supports = array( 'title', 'editor', 'revisions', 'thumbnail' );

		if ( array_key_exists( 'has-category', $cpt ) && true === $cpt['has-category'] ) {
			$taxonomy_name = $cpt['custom-post-name'] . '-category';
			register_taxonomy(
				$taxonomy_name,
				$cpt['custom-post-name'],
				array(
					'label' => __( 'Categorias' ),
					'rewrite' => array( 'slug' => $cpt['category-slug'] ),
				)
			);

			$taxonomies[] = $taxonomy_name;
		}

		$args = create_cpt_args(
			$labels,
			$supports,
			true,
			$taxonomies,
			array( 'slug' => $cpt['slug'], 'with_front' => false ), // ver https://codex.wordpress.org/Function_Reference/register_post_type#Arguments
			'',
			true,
			true,
			'post',
			null,
			$dashboard_icon
		);

		register_post_type( $cpt['custom-post-name'], $args );
	}

}
add_action( 'init', 'register_my_cpts' );
