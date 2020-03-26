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
if ( !class_exists( 'Ammonite_Dynamic_Questions' ) ) {
  class Ammonite_Dynamic_Questions {
    public static function init() {
      // Create custom post type
      include 'includes/post-type.php';
      add_action( 'init', array( 'Ammonite_Dynamic_Questions_Post_Type', 'create_post_type' ) );

      // Register styles and scripts
      add_action( 'wp_enqueue_scripts', function() {
        wp_register_script( 'ammonite-dynamic-slides-script', plugins_url( 'assets/js/ammonite-dynamic-slides.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
        wp_register_style( 'ammonite-dynamic-slides-styles', plugins_url( 'assets/css/ammonite-dynamic-slides.css', __FILE__ ), array(), '1.0.0', 'all' );
      } );

      // Set up AJAX API

      // Register shortcode
      add_shortcode( 'ammonite_dynamic_slides', function() {
        // Enqueue scripts and styles
        wp_enqueue_script( 'ammonite-dynamic-slides-script' );
        wp_enqueue_style( 'ammonite-dynamic-slides-styles' );

        // Return template
        ob_start();
        include 'templates/dynamic-slides-container.php';
        return ob_get_clean();
      } );
    }
  }

  // Call methods on load here
  Ammonite_Dynamic_Questions::init();
}
