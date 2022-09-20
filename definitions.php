<?php

namespace PIE\_S;

if( ! function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$plugin_data = get_plugin_data( __FILE__ );

if ( ! defined( __NAMESPACE__ . '\VERSION' ) ) {
	// Generate the theme version from that defined in style.css.
	define( __NAMESPACE__ . '\VERSION', $plugin_data['Version'] );
}

define( __NAMESPACE__ . '\THEME_URI', get_stylesheet_directory_uri() . '/' );
define( __NAMESPACE__ . '\ASSETS_URI', THEME_URI . 'assets/' );
define( __NAMESPACE__ . '\THEME_PATH', get_stylesheet_directory() . '/' );
define( __NAMESPACE__ . '\INCLUDE_PATH', THEME_PATH . 'includes/' );
define( __NAMESPACE__ . '\ASSETS_PATH', THEME_PATH . 'assets/' );

// Define path and URL to the ACF plugin.
define( __NAMESPACE__ . '\ACF_PATH', get_stylesheet_directory() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/' );
define( __NAMESPACE__ . '\ACF_URL', get_stylesheet_directory_uri() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/' );