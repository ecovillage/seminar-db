<?php
/*
 * Plugin Name: Seminar DB
 * Plugin URI: https://github.com/ecovillage/seminar_db
 * Version: 0.0.1
 * Author: Felix Wolfsteller
 * Description: Adds Widget to show seminars from a database (view only).
 * License: GPL3+
 * */

// Block direct requests
if ( !defined('ABSPATH') )
  die('-1');

add_action('widgets_init', function() {
  register_widget( 'Seminar_DB_Widget' );
});

class Seminar_DB_Widget extends WP_Widget {
  // Constructor
  public function __construct() {
    parent::__construct( 'Seminar_DB_Widget', // Base ID
      __('Seminar DB Widget', 'text_domain'), // Name
      array( 'description' => __( 'SeminarDBWidget!', 'text_domain'), ) // args
    );
  }
  // Backend
  public function form($instance) {}
  public function update($new_instance, $old_instance) {}
    // Frontend
  public function widget($args, $instance) {
    echo 'Seminar DB Widget!';
  }
} // class Seminar_DB_Widget
?>
