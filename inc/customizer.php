<?php

/**
 * Class wpstarter_Customizer
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since wpstarter 1.1.0
 */
class wpstarter_Customizer {
	public static function register ( $wp_customize ) {
		/**
		 * Global Modules
		 */
		$wp_customize->add_panel('global-modules', array(
			'title' => __('Global Modules', 'wpstarter'),
			'priority' => 30
		));
		/**
		 * Module: Footer
		 */
		$wp_customize->add_section('footer', array(
			'title' => __('Footer', 'wpstarter'),
			'panel' => 'global-modules',
			'priority' => 100
		));
		/**
		 * Footer: Copyright Text
		 */
		$wp_customize->add_setting( 'footer_copyright_text_setting',
			array(
				'default' => __('Copyright &copy; %s by %s', date('Y'), get_bloginfo('name')),
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
		);
		$wp_customize->add_control( 'footer_copyright_text',
			array(
				'label' => __( 'Footer Copyright Text' ),
				'section' => 'footer',
				'settings' => 'footer_copyright_text_setting',
				'priority' => 10,
				'type' => 'textarea'
			)
		);
	}
	public static function header_output() {}
	public static function live_preview() {
		wp_enqueue_script(
			'wpstarter-customizer',
			get_template_directory_uri() . '/assets/js/customizer.js',
			array(  'jquery', 'customize-preview' ),
			'',
			true
		);
	}
	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod($mod_name);
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'wpstarter_Customizer' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'wpstarter_Customizer' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'wpstarter_Customizer' , 'live_preview' ) );

function wpstarter_customize_preview_js() {
	wp_enqueue_script( 'wpstarter-customize-preview', get_theme_file_uri( '/assets/js/customizer.js' ), array( 'customize-preview' ), '20181108', true );
}
add_action( 'customize_preview_init', 'wpstarter_customize_preview_js' );
