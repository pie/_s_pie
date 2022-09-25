<?php 

namespace PIE\_S\Setup\Spa;

add_action( 'init', __NAMESPACE__ . '\init' );

/**
* Initialise the spa theme only under certain conditions. These can be turned off or on depending upon requirements
*/
function init() {
  if ( nextgen_rollout() ) {
    add_filter( 'template_include', __NAMESPACE__ . '\maybe_overload_nextgen_template', 99 );
  }
}

/**
* this function determines if we should be loading the next-gen theme
* for the currently displayed page/URL. The next-gen theme applies its own
* 'maybe overload template' functionality. This just determines whether that
* should kick in or not. Currently it only bails for non-logged-in users or when
* in the Wp-Admin area
*
* @return boolean
*/
function nextgen_rollout(){
  if ( is_admin() ) {
    return false;
  }

  if ( ! is_user_logged_in() ) {
    return false;
  }

  return true;
}

/**
 * This function determines if a user should be served with nextgen templates
 * for the current URL. This is based on if the template has been added to the
 * $template_overrides array (for templates which have been approved and are
 * being served to all users)
 *
 * @param  string $template               The template name that would be loaded under normal operations
 * @return string           The template file that we want to load
 * @hooked template_include@99
 */
function maybe_overload_nextgen_template( $template ){

  // These template files have been tested and approved and will be served to all users
  $template_overrides      = ['404.php'];

  $template_file           = end(explode( '/', $template ));

  // If the current template is in the template_overrides array, then we serve up the
  // nextgen index file
  if ( in_array( $template_file, $template_overrides ) ) {
    return get_stylesheet_directory() . '/dist/index.php';
  }

  return $template;
}

/**
 * returns either a PHP or JSON version of the data required by the SPA
 *
 * @param string $format
 * @return void
 */
function get_app_data( $format = 'php' ) {

    $appdata = get_transient( __NAMESPACE__ . '\appdata' );
    if ( ! $appdata ) {

        // perform functoins to populate app data - this will be echoed into the body of your app index.php
        $appdata = []; 
        set_transient( __NAMESPACE__ . '\appdata', $appdata, 600 );
    }


  $appdata = [
    'nonce' => wp_create_nonce('wp_rest')
  ];
  switch ( $format ) {
    case 'json':
      return json_encode( $appdata );
    default:
      return $appdata;
  }
}
