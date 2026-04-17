<?php
/**
 * Enregistrement et CSS dynamique des styles de blocs dcx-box-*.
 * Les slugs de couleurs sont lus depuis theme.json via wp_get_global_settings()
 * — aucune liste hardcodée, synchronisation automatique.
 *
 * @package dcx-benchmark-luxe-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'dcx_benchmark_luxe_theme_register_box_styles' ) ) :
	/**
	 * Enregistre les block styles dcx-box-* pour les blocs core et custom.
	 */
	function dcx_benchmark_luxe_theme_register_box_styles() {
		$box_styles = array(
			array( 'name' => 'dcx-box',                 'label' => 'DCX Shadow' ),
			array( 'name' => 'dcx-box-accent-1',        'label' => 'DCX Accent 1' ),
			array( 'name' => 'dcx-box-accent-2',        'label' => 'DCX Accent 2' ),
			array( 'name' => 'dcx-box-accent-3',        'label' => 'DCX Accent 3' ),
			array( 'name' => 'dcx-box-accent-4',        'label' => 'DCX Accent 4' ),
			array( 'name' => 'dcx-box-accent-5',        'label' => 'DCX Accent 5' ),
			array( 'name' => 'dcx-box-custom-secondary-1', 'label' => 'DCX Secondary 1' ),
			array( 'name' => 'dcx-box-custom-secondary-2', 'label' => 'DCX Secondary 2' ),
			array( 'name' => 'dcx-box-custom-secondary-3', 'label' => 'DCX Secondary 3' ),
			array( 'name' => 'dcx-box-custom-secondary-4', 'label' => 'DCX Secondary 4' ),
			array( 'name' => 'dcx-box-custom-secondary-5', 'label' => 'DCX Secondary 5' ),
			array( 'name' => 'dcx-box-custom-digit-1',  'label' => 'DCX Digit 1' ),
			array( 'name' => 'dcx-box-custom-digit-2',  'label' => 'DCX Digit 2' ),
			array( 'name' => 'dcx-box-contrast',        'label' => 'DCX Contrast' ),
		);

		$block_types = array(
			'core/group',
			'core/columns',
			'core/column',
			'core/stack',
			'core/grid',
			'dcx-benchmark-luxe/stat-card',
			'dcx-benchmark-luxe/charts',
			'dcx-benchmark-luxe/cta',
		);

		foreach ( $block_types as $block_type ) {
			foreach ( $box_styles as $style ) {
				register_block_style( $block_type, $style );
			}
		}
	}
endif;
add_action( 'init', 'dcx_benchmark_luxe_theme_register_box_styles' );

if ( ! function_exists( 'dcx_benchmark_luxe_theme_enqueue_box_styles_css' ) ) :
	/**
	 * Génère le CSS des styles dcx-box-* dynamiquement depuis les couleurs de theme.json.
	 * Fonctionne en front-end et dans l'éditeur (hook enqueue_block_assets).
	 */
	function dcx_benchmark_luxe_theme_enqueue_box_styles_css() {
		$palette = wp_get_global_settings( array( 'color', 'palette', 'theme' ) );

		if ( empty( $palette ) || ! is_array( $palette ) ) {
			return;
		}

		$css = '[class*="is-style-dcx-box"] {
			box-shadow: 0 1px 3px rgba(231, 227, 227, 0.05);
			transition: transform 0.2s ease, box-shadow 0.2s ease;
		}
		[class*="is-style-dcx-box"]:hover {
			box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.06);
			transform: translateY(-2px);
		}';

		foreach ( $palette as $color ) {
			if ( empty( $color['slug'] ) ) {
				continue;
			}
			$slug  = sanitize_key( $color['slug'] );
			$css  .= ".is-style-dcx-box-{$slug} {
				border-left: 4px solid var(--wp--preset--color--{$slug}) !important;
			}";
		}

		wp_register_style( 'dcx-benchmark-luxe-box-styles', false );
		wp_enqueue_style( 'dcx-benchmark-luxe-box-styles' );
		wp_add_inline_style( 'dcx-benchmark-luxe-box-styles', $css );
	}
endif;
add_action( 'enqueue_block_assets', 'dcx_benchmark_luxe_theme_enqueue_box_styles_css' );
