<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );

function add_theme_scripts()
{
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/main.css');
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function custom_excerpt_length( $length ) {
  return 18;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_sidebar( array(
		'name'          => sprintf(__('Single Post Sidebar'), $i ),
		'id'            => "single-post-sidebar",
		'description'   => 'Here you can put text widget',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget single-post-sidebar-widget">',
		'after_widget'  => "</div>\n",
	) );
}