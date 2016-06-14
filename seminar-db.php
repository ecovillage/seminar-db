<?php
/*
 * Plugin Name: Seminar DB
 * Plugin URI: https://github.com/ecovillage/seminar_db
 * Version: 0.0.2
 * Author: Felix Wolfsteller
 * Description: Adds Widget to show seminars from a database (view only).
 * License: AGPL3+
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
    echo '<div class="widget">';
    echo '  <h3>Seminare aus DB</h3>';
    echo '</div>';
  }
} // class Seminar_DB_Widget

/* Custom Post Type: SeminarDBEvent */
function create_seminar_db_event_post_type() {
  register_post_type( 'seminar_db_event',
    array( 'labels' => array( 'name' => __( 'Events' ), 'singular_name' => __( 'Event' )),
           'description' => 'Events held at location',
           'public' => true,
           'show_in_nav_menus'   => true,
           'exclude_from_search' => false,
           'publicly_queryable'  => true,
           'has_archive'         => true,
           'taxonomies'          => array('category', 'post_tag'), # Probably we want custom taxonomies, too
           'supports' => array( 'title', 'editor', 'custom-fields' ),
           'rewrite' => array( 'slug' => 'events' ),
  ));
  // Workaround
  flush_rewrite_rules();
} // create_seminar_db_event_post_type

// register Custom Post Type SeminarDBEvents
add_action( 'init', 'create_seminar_db_event_post_type' );

/* Filter the single_template with our custom function*/
function load_seminar_db_event_template($template) {
  global $post;

  // Is this a "seminar_db_event" post?
  if ($post->post_type == "seminar_db_event"){
    $plugin_path = plugin_dir_path( __FILE__ ) . '/templates';

    // The name of custom post type single template:
    $template_name = 'single-seminar_db_event.php';

    // Take template from theme if exists.
    if($template === get_stylesheet_directory() . '/' . $template_name
        || !file_exists($plugin_path . $template_name)) {

        return $template;
    }

    // If not, return my plugin custom post type template.
    return $plugin_path . $template_name;
  }

  // This is not an event, do nothing with $template.
  return $template;
}
add_filter('single_template', 'load_seminar_db_event_template');


/* readmes */
/* dashicons: https://developer.wordpress.org/resource/dashicons/#editor-break clipboard analytics id id-alt */
/* add to main posts: https://codex.wordpress.org/Post_Types#Custom_Post_Type_Templates pre_get_posts */
?>
