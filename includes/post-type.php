<?php
if ( !class_exists( 'Ammonite_Dynamic_Questions_Post_Type' ) ) {
  class Ammonite_Dynamic_Questions_Post_Type {
    public static function create_post_type() {
      $labels = array(
        'name'               => _x( 'Dynamic Slides', 'post type general name' ),
        'singular_name'      => _x( 'Dynamic Slide', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'slide' ),
        'add_new_item'       => __( 'Add New Slide' ),
        'edit_item'          => __( 'Edit Slide' ),
        'new_item'           => __( 'New Slide' ),
        'all_items'          => __( 'All Slides' ),
        'view_item'          => __( 'View Slide' ),
        'search_items'       => __( 'Search Slides' ),
        'not_found'          => __( 'No slides found' ),
        'not_found_in_trash' => __( 'No slides found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Dynamic Slides'
      );
      $args = array(
        'labels'        => $labels,
        'description'   => 'Dynamic, treeing, AJAX-enabled slides',
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-code-standards',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'   => false,
      );
      register_post_type( 'dynamic_slide', $args );
    }
  }
}
