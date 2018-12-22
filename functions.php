<?php

if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

require get_template_directory() . '/inc/theme-init.php';
require get_template_directory() . '/inc/customizer.php';
