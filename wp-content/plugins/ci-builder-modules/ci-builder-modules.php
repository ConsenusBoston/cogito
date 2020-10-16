<?php
/**
 * Plugin Name: CI Buider Custom Modules
 * Plugin URI: http://consensusinteractive.com
 * Description: Custom modules for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Consensus Interactive
 * Author URI: http://consensusinteractive.com
 */
define( 'MY_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'MY_MODULES_URL', plugins_url( '/', __FILE__ ) );

function ci_builder_load_module() {
  if ( class_exists( 'FLBuilder' ) ) {
      // Include your custom modules here.
  }
}
add_action( 'init', 'ci_builder_load_module' );