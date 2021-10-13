<?php

// Defines
define('FL_CHILD_THEME_DIR', get_stylesheet_directory());
define('FL_CHILD_THEME_URL', get_stylesheet_directory_uri());

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action('wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000);

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

function custom_excerpt_length($length)
{
	return 18;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

add_action('widgets_init', 'register_my_widgets');
function register_my_widgets()
{
	register_sidebar(array(
		'name'          => sprintf(__('Single Post Sidebar')),
		'id'            => "single-post-sidebar",
		'description'   => 'Here you can put text widget',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget single-post-sidebar-widget">',
		'after_widget'  => "</div>\n",
	));
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


// https://facetwp.com/documentation/developers/output/facetwp_sort_options/
add_filter('facetwp_sort_options', function ($options, $params) {
  //if ($params['template_name'] == 'featured_and_popular_documents') {
    $options = [
      'default' => [
        'label' => 'Newest',
        'query_args' => [
          'orderby' => 'date',
          'order' => 'DESC'
        ]
      ],
      'date_desc' => [
        'label' => 'Oldest',
        'query_args' => [
          'orderby' => 'date',
          'order' => 'ASC'
        ]
      ],
      'title_asc' => [
        'label' => 'Title (A-Z)',
        'query_args' => [
          'orderby' => 'title',
          'order' => 'ASC',
        ]
      ],
      'title_desc' => [
        'label' => 'Title (Z-A)',
        'query_args' => [
          'orderby' => 'title',
          'order' => 'DESC',
        ]
      ]
    ];
  //}

  return ($options);
}, 10, 2);

// Reorders News Post Facet
add_filter('facetwp_facet_orderby', function ($orderby, $facet) {
	if ('news_categories' == $facet['name']) {
		$orderby = 'FIELD(f.facet_display_value, "in-the-news", "press-releases", "awards" )';
	}
	return $orderby;
}, 10, 2);

// Preselects Facet on News Page
add_filter('facetwp_preload_url_vars', function ($url_vars) {
	if ('news' == FWP()->helper->get_uri()) {
		if (empty($url_vars['news_categories'])) {
			$url_vars['news_categories'] = ['in-the-news'];
			// 			$url_vars['news_post_date'] = ['2021'];
		}
	}
	return $url_vars;
});



// Inverts the Post Date Years
add_filter('facetwp_facet_orderby', function ($orderby, $facet) {
	if ('news_post_date' == $facet['name']) { // Change "year" to your facet's name
		$orderby = 'f.facet_value+0 DESC';
	}
	return $orderby;
}, 10, 2);



/** ignore query added by GDPR Cookie Consent **/
add_filter('facetwp_is_main_query', function ($is_main_query, $query) {
	if ('cookielawinfo' == $query->get('post_type')) {
		$is_main_query = false;
	}
	return $is_main_query;
}, 10, 2);
/**
 * This updates the filter to format the date to be yearly to match design
 */
add_filter('facetwp_index_row', function ($params, $class) {
	if ('news_post_date' == $params['facet_name']) {
		$raw_value = $params['facet_value'];
		$params['facet_value'] = date('Y', strtotime($raw_value));
		$params['facet_display_value'] = $params['facet_value'];
	}
	return $params;
}, 10, 2);


/**
 * Populate hidden input with ACF values
 */
function nf_hidden_field_values($value, $field_type, $field_settings)
{
	global $post;
	// $value = '';

	if ($field_settings['key'] == 'thank_you_page_1606947352648') {
		$value =  get_field('thank_you_page', $post->ID);
	}

	return $value;
}
add_filter('ninja_forms_render_default_value', 'nf_hidden_field_values', 10, 3);


/** Create Shortcode for Speakers On the Resource post type */
function featured_speakers_shortcode($atts)
{

	$atts = shortcode_atts(array(
		'number' => 1
	), $atts);

	ob_start();

?>
	<div class="fl-post__speakers">
		<?php
		// Check rows exists.
		if (have_rows('speakers')) : ?>
			<h3>Featured speakers</h3>

			<?php
			// Loop through rows.
			while (have_rows('speakers')) : the_row();

				// We need to check if the post is using a registered user for the speakers.
				// If is_registered is selected it will use user/author object
				// otherwise it will use the ACF speaker fields

				// Load Author/Image sub fields
				$speaker = get_sub_field('author');
				$speaker_title = get_field('employee_title', 'user_' .  $speaker['ID']);
				$image = get_sub_field('speaker_image');

				// Image variables.
				$url = $image['url'];
				$title = $image['title'];
				$alt = $image['alt'];
				// Thumbnail size attributes.
				$size = 'thumbnail';
				$thumb = $image['sizes'][$size];
				$width = $image['sizes'][$size . '-width'];
				$height = $image['sizes'][$size . '-height'];


				if (get_sub_field('is_registered')) { ?>

					<div class="fl-post__speaker is-registered-user">
						<div class="fl-post__speaker-image">
							<?php echo $speaker['user_avatar']; ?>
						</div>
						<div class="fl-post__speaker-bio">
							<span class="fl-post__speaker-name"><?php echo $speaker['display_name']; ?></span>
							<span class="fl-post__speaker-description"> <?php echo $speaker['employee_title']; ?></span>
							<span class="fl-post__speaker-description"> <?php echo $speaker_title; ?></span>
						</div>
					</div>

				<?php } else { ?>
					<div class="fl-post__speaker is-custom-speaker">
						<div class="fl-post__speaker-image">
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
						</div>
						<div class="fl-post__speaker-bio">
							<span class="fl-post__speaker-name"><?php the_sub_field('speaker_name'); ?></span>
							<span class="fl-post__speaker-description"><?php the_sub_field('speaker_title'); ?></span>
						</div>
					</div>
				<?php }  ?>

		<?php
			// End loop.
			endwhile;

		// No value.
		else :
		// Do something...
		endif; ?>
	</div><!-- eo // .fl-post__speakers -->

<?php

	return ob_get_clean();
}
add_shortcode('featured-speakers', 'featured_speakers_shortcode');

// Admin Stylesheets

function admin_role_class($classes)
{
	global $current_user;
	foreach ($current_user->roles as $role)
		$classes .= ' role-' . $role;
	return trim($classes);
}
add_filter('admin_body_class', 'admin_role_class');

function admin_role_styles()
{
	$user = wp_get_current_user();
	if (in_array('cogito', (array) $user->roles)) {
		echo '<style>

		.role-cogito .toplevel_page_cptui_main_menu,
		.role-cogito .toplevel_page_ajax-load-more,
		.role-cogito .toplevel_page_capsman,
		.role-cogito .toplevel_page_loginpress-settings,
		.role-cogito #toplevel_page_edit-post_type-acf-field-group,
		.role-cogito .menu-icon-appearance,
		.role-cogito .menu-icon-plugins {
			display: none !important;
		}
		
		
		</style>';
	} else {
		// What Everyone Else Gets
	}
}
add_action('admin_head', 'admin_role_styles');


add_filter('fl_builder_loop_query_args', function ($args) {

// 	if (is_page(43)) {
	if(isset($_POST['post_id']) && $_POST['post_id'] == 43) {
		if (isset($args['s'])) {
			$args['post_type'] = array('resource');
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'resource_tag',
					'field'    => 'term_id',
					'terms'    => array(80),
					'operator' => 'NOT IN',
				)
			);
		}
	}


	return $args;
});
