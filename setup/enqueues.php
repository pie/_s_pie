<?php 
namespace PIE\_S\Setup\Enqueues;
/**
 * Enqueue scripts and styles.
 */
function scripts() {
	wp_style_add_data( '_s-style', 'rtl', 'replace' );

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), \PIE\_S\VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function styles() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri(), array(), \PIE\_S\VERSION );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts' );