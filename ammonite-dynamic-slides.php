<?php
/**
 * Plugin Name:       Ammonite Dynamic Slides
 * Description:       Dynamic, treeing, AJAX-enabled slides built with a custom post type.
 * Version:           1.0.0
 * Author:            Daniel Ellis
 * Author URI:        https://danielellisdevelopment.com/
 */

 /*
   Basic Security
 */
 if ( ! defined( 'ABSPATH' ) ) {
   die;
 }

 /*
  Plugin Base Class
*/
if ( !class_exists( 'Ammonite_Dynamic_Slides' ) ) {
  class Ammonite_Dynamic_Slides {
    public static function init() {
      // Create custom post type
      include 'includes/post-type.php';
      add_action( 'init', array( 'Ammonite_Dynamic_Slides_Post_Type', 'create_post_type' ) );

      // Register styles and scripts
      add_action( 'wp_enqueue_scripts', function() {
        wp_register_script( 'ammonite-dynamic-slides-script', plugins_url( 'assets/js/ammonite-dynamic-slides.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
        wp_register_style( 'ammonite-dynamic-slides-styles', plugins_url( 'assets/css/ammonite-dynamic-slides.css', __FILE__ ), array(), '1.0.0', 'all' );
      } );

      // Localize data to script

      // Register shortcode
      add_shortcode( 'ammonite_dynamic_slides', function() {
        // Localize data to script
        wp_localize_script( 'ammonite-dynamic-slides-script', 'ammoniteDynamicSlidesLocalizedData', array(
          'ajaxUrl' => site_url( '/wp-json/ammonite-dynamic-slides/v1/slides/' )
        ) );

        // Enqueue scripts and styles
        wp_enqueue_script( 'ammonite-dynamic-slides-script' );
        wp_enqueue_style( 'ammonite-dynamic-slides-styles' );

        // Return template
        ob_start();
        include 'templates/dynamic-slides-container.php';
        return ob_get_clean();
      } );

      // Create custom API endpoint
      include 'includes/rest-api-route.php';
      add_action( 'rest_api_init', array( 'Ammonite_Dynamic_Slides_Rest_Route', 'init_rest_route' ) );

      // Connect to Infusionsoft API
      // include 'includes/infusionsoft-api.php';
    }
  }

  // Call methods on load here
  Ammonite_Dynamic_Slides::init();
}
