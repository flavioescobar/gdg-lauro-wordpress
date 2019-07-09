<?php
defined( 'ABSPATH' ) or die;

global $my_customizer;

// Caso não haja nada no customizer, vamos ignorá-lo.
if ( ! is_array( $my_customizer ) ) {
	return;
}

function my_customize_add_settings( $wp_customize ) {
	global $my_customizer;

	foreach ( $my_customizer as $section ) {
		foreach ( $section['settings'] as $setting ) {
			$setting_array = array(
				'default' => $setting['default']
			);

			if ( array_key_exists( 'type', $setting ) && $setting['type'] === 'option' ) {
				$setting_array['type'] = 'option';
			}

			$wp_customize->add_setting( $setting['setting'], $setting_array );
		}
	}
}

function my_customize_add_sections( $wp_customize ) {
	global $my_customizer;

	foreach ( $my_customizer as $section ) {
		$wp_customize->add_section( $section['section'], array(
			'title'    => __( $section['title'] ),
			'priority' => 1,
		) );
	}
}

function my_customize_add_controls( $wp_customize ) {
	global $my_customizer;

	foreach ( $my_customizer as $section ) {
		$section_name = $section['section'];

		foreach ( $section['settings'] as $setting ) {
			// Customizer is image.
			if ( array_key_exists( 'type', $setting ) && $setting['type'] === 'image' ) {
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting['setting'], array(
					'label'    => __( $setting['label'] ),
					'section'  => $section_name,
					'settings' => $setting['setting'],
				) ) );

				continue;
			}

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting['setting'], array(
				'label'    => __( $setting['label'] ),
				'section'  => $section_name,
				'settings' => $setting['setting'],
				'type'     => array_key_exists( 'type', $setting ) ? $setting['type'] : 'text',
			) ) );
		}
	}
}

function my_customize_add_partials( $wp_customize ) {
	global $my_customizer;

	foreach ( $my_customizer as $section ) {
		foreach ( $section['settings'] as $setting ) {
			if ( array_key_exists( 'selector', $setting ) ) {
				$wp_customize->selective_refresh->add_partial( $setting['setting'], array(
					'selector' => $setting['selector']
				) );
			}
		}
	}
}

function my_customize_register( $wp_customize ) {
	// Settings
	my_customize_add_settings( $wp_customize );

	// Sections
	my_customize_add_sections( $wp_customize );

	// Controls
	my_customize_add_controls( $wp_customize );

	// Partials (botões de atalho para editar as configurações)
	my_customize_add_partials( $wp_customize );
}
add_action( 'customize_register', 'my_customize_register' );
