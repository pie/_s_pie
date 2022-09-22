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

/**
 * Use this function if working with Buddyboss/BuddyPress - an example function is included
 *
 * @return void
 */
add_action( 'bp_rest_api_init', function(){
	bp_rest_register_field(
		'activity',      // Id of the BuddyPress component the REST field is about
		'user', // Used into the REST response/request
		array(
			'get_callback'    => 'populate_user_from_activity_callback',    // The function to use to get the value of the REST Field
			'schema'          => array(                                // The example_field REST schema.
				'description' => 'Example of Activity Meta Field',
				'type'        => 'string',
				'context'     => array( 'view', 'edit' ),
			),
		)
	);
} );

/**
* The function to use to get the value of the REST Field.
*
* param  array  $array     The list of properties of the BuddyPress component's object.
* param  string $attribute The REST Field key used into the REST response.
* return string            The value of the REST Field to include into the REST response.
*/
function populate_user_from_comment_callback( $array ) {
   $user = get_userdata( $array[ 'author' ] );
   $user->avatar = $array['author_avatar_urls'][96];
   $user->ability_level = get_user_meta( $array['author'], '_ability_level', true );
   $user->profile = bp_core_get_user_domain( $array['author'] );
   unset($user->user_pass, $user->user_email);
   return $user->data;
}

/**
* The function to use to get the value of the REST Field.
*
* param  array  $array     The list of properties of the BuddyPress component's object.
* param  string $attribute The REST Field key used into the REST response.
* return string            The value of the REST Field to include into the REST response.
*/
function populate_user_from_activity_callback( $array ) {
   $user = get_userdata( $array[ 'user_id' ] );
   $user->avatar = $array['user_avatar']['full'];
   $user->ability_level = get_user_meta( $array['user_id'], '_ability_level', true );
   $user->profile = bp_core_get_user_domain( $array['user_id'] );
   unset($user->user_pass, $user->user_email);
   return $user->data;
}