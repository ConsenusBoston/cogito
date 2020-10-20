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