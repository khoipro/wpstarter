<?php
/**
 * WPStarter back compat functionality
 *
 * Prevents WPStarter from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 */

/**
 * Prevent switching to WPStarter on old versions of WordPress.
 */
function wpstarter_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'wpstarter_upgrade_notice' );
}
add_action( 'after_switch_theme', 'wpstarter_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 */
function wpstarter_upgrade_notice() {
	$message = sprintf( __( 'WPStarter requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wpstarter' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 */
function wpstarter_customize() {
	wp_die(
		sprintf(
			__( 'This theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wpstarter' ),
			$GLOBALS['wp_version']
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'wpstarter_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 */
function wpstarter_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'This theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wpstarter' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'wpstarter_preview' );
