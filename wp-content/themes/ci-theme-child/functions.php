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
  wp_enqueue_script('app', get_stylesheet_directory_uri() . '/scripts/app.js');
  if (is_page(3200) || is_page(363)) {
	wp_enqueue_style('select2-style', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css');
	wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js', [], "", true);
	wp_enqueue_script('lever', get_stylesheet_directory_uri() . '/scripts/lever-job-embed.js', [], "", true);
	wp_enqueue_script('listjs', get_stylesheet_directory_uri() . '/scripts/list.js', ["lever"], "", true);
	wp_enqueue_script('lever-custom', get_stylesheet_directory_uri() . '/scripts/lever-job-custom.js', ["lever", "listjs"], "", true);
  }
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function custom_excerpt_length( $length ) {
  return 18;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_sidebar( array(
		'name'          => sprintf(__('Single Post Sidebar') ),
		'id'            => "single-post-sidebar",
		'description'   => 'Here you can put text widget',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget single-post-sidebar-widget">',
		'after_widget'  => "</div>\n",
	) );
}

function custom_classes($classes)
{

	if (is_page('resources')) {
		global $page;
		$name = 'resource-page';
		$classes[] = $name;
	}
	return $classes;
}

add_filter('body_class', 'custom_classes');


// Reorders News Post Facet
add_filter('facetwp_facet_orderby', function ($orderby, $facet) {
	if ('news_categories' == $facet['name']) {
		$orderby = 'FIELD(f.facet_display_value, "in-the-news", "press-releases", "awards" )';
	}
	return $orderby;
},10, 2 );

// Preselects Facet on News Page
add_filter('facetwp_preload_url_vars', function ($url_vars) {
	if ('in-the-news' == FWP()->helper->get_uri()) {
		if (empty($url_vars['news_categories'])) {
			$url_vars['news_categories'] = ['in-the-news'];
			$url_vars['news_post_date'] = ['2020'];
		}
	}
	return $url_vars;
});
 

/**
 * This updates the filter to format the date to be yearly to match design
 */
add_filter( 'facetwp_index_row', function( $params, $class ) {
	if ('news_post_date' == $params['facet_name'] ) { 
		$raw_value = $params['facet_value'];
		$params['facet_value'] = date( 'Y', strtotime( $raw_value ) );
		$params['facet_display_value'] = $params['facet_value'];
	}
	return $params;
}, 10, 2 );


/**
 * Populate hidden input with ACF values
 */
function nf_hidden_field_values( $value, $field_type, $field_settings ) {
    global $post;
	$value = '';
	
    if ( $field_settings['key'] == 'thank_you_page_1606947352648' ) {
        $value =  get_field('thank_you_page', $post->ID);
	}
	
    return $value;
}
add_filter( 'ninja_forms_render_default_value', 'nf_hidden_field_values', 10, 3 );
