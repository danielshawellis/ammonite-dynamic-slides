<?php
if ( !class_exists( 'Ammonite_Dynamic_Slides_Rest_Route' ) ) {
  class Ammonite_Dynamic_Slides_Rest_Route {
    public static function init_rest_route() {
      register_rest_route( 'ammonite-dynamic-slides/v1', '/slides/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => array( 'Ammonite_Dynamic_Slides_Rest_Route', 'return_slides' ),
      ) );
    }

    public static function return_slides( $id ) {
      WPBMap::addAllMappedShortcodes(); // Trigger VC shortcode processing

      $slide_id = $id['id']; // Get slide ID passed from URL

      $slide = get_post( $slide_id ); // Get post from slide

      $slide_content = do_shortcode( $slide->post_content ); // Get content from post and handle shortcodes

      return new WP_REST_Response( $slide_content, 200 ); // Return the content to the requester
    }
  }
}
