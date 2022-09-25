<?php 
namespace PIE\_S\Setup\Api;

/**
 * Cached endpoints which depend upon WP Rest Cache plugin being installed https://wordpress.org/plugins/wp-rest-cache/
 * Functoin contains an example for caching the users endpoint, which can be removed or amended as required
 *
 * @param Array $allowed_endpoints
 * @return Array
 */
function wprc_add_acf_posts_endpoint( $allowed_endpoints ) {

   if ( isset( $allowed_endpoints[ 'wp/v2' ] ) && ( $key = array_search( 'users', $allowed_endpoints[ 'wp/v2' ] ) ) !== false ) {
	   unset( $allowed_endpoints[ 'wp/v2' ][ $key ] );
   }

   return $allowed_endpoints;
}

add_filter( 'wp_rest_cache/allowed_endpoints', 'wprc_add_acf_posts_endpoint', 10, 1);

/**
 * Use this function to add api https://developer.wordpress.org/reference/functions/register_rest_route/ - an example function is included
 */
add_action( 'rest_api_init', function () {
	register_rest_field( 'comment', 'user', array(
		'get_callback' => 'populate_user_from_comment_callback',
		'schema' => array(
			'description' => __( 'Elaborate User for NextGen AMA.' ),
			'type'        => 'object'
		),
	) );
 } );
 