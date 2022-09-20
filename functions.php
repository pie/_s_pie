<?php
/**
 * bootstrap file to include other files to set up theme functionality. Original includes from _s live in /inc. Our files live in /setup.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

namespace PIE\_S;

/**
 * Include definitions for this theme.
 */
require_once get_template_directory() . '/definitions.php';

/**
 * Load in the local version of ACF
 */
require_once ACF_PATH . 'acf.php';
require_once get_template_directory() . '/setup/theme.php';
require_once get_template_directory() . '/setup/enqueues.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
