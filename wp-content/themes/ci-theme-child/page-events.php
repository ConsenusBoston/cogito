<?php

/**
 * Template Name: Event Page
 *
 * @package WordPress
 */
get_header();

$query_args = array(
    'post_type' => 'event',
    'posts_per_page' => 1,
    'meta_key' => 'is_post_featured',
    'meta_value' => '1'
);
$query_args_one = array(
    'post_type' => 'event',
    'posts_per_page' => 6,
    // 'meta_key' => 'is_post_featured',
    // 'meta_value' => '1'
);
// $stickies = get_option( 'sticky_posts' );
// $query_args_sticky = array(
// 	'post_type' => 'post',
// 	// 'post__in' => $stickies,
// 	'posts_per_page' => 4
// );
// $posts_query_sticky = new WP_Query( $query_args_sticky );
$featuredPost_query = new WP_Query($query_args);
$posts_query = new WP_Query($query_args_one);
// $posts_counter = 0;
?>

<div class="fl-builder-content">
    <div class="<?php FLLayout::container_class(); ?> ">
        <div class="<?php FLLayout::row_class(); ?>">

            <div class="event--container">
                <?php while ($featuredPost_query->have_posts()) : $featuredPost_query->the_post(); ?>

                    <?php

                    $featured = get_field('is_post_featured');

                    if ($featured) { ?>

                        <div class="event--post is-featured-post">
                            <?php if (has_post_thumbnail()) {
                                $img = get_the_post_thumbnail_url();
                            } else {
                                $img = get_stylesheet_directory_uri() . '/assets/images/placeholder-600x320.png';
                            } ?>

                            <div class="event--post-image" style="background-image:url('<?php echo $img; ?>');background-size: cover;">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (get_field('post_button_text')) : ?>
                                        <?php the_field('post_button_text'); ?>
                                    <?php else : ?>
                                        <?php echo "Learn More" ?>
                                    <?php endif; ?>
                                </a>
                                <div class="event--post-speakers">
                                    <?php
                                    // Check rows exists.
                                    if (have_rows('speakers')) :
                                        // Loop through rows.
                                        while (have_rows('speakers')) : the_row();

                                            // We need to check if the post is using a registered user for the speakers.
                                            // If is_registered is selected it will use user/author object
                                            // otherwise it will use the ACF speaker fields

                                            // Load Author/Image sub fields
                                            $user = get_sub_field('author');
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

                                                <div class="speaker is-registered-user">
                                                    <?php echo $user['user_avatar']; ?>
                                                </div>

                                            <?php } else { ?>
                                                <div class="speaker is-custom-speaker">
                                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                                </div>
                                            <?php }  ?>

                                    <?php
                                        // End loop.
                                        endwhile;

                                    // No value.
                                    else :
                                    // Do something...
                                    endif; ?>
                                </div><!-- eo // .event--post-speakers -->
                            </div>

                            <div class="event--post-details">
                                
                                <div class="event--post-title">
                                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                </div>
                                <div class="event--post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="event--post-date">
                                    <?php

                                    $startDate = get_field('start_event_date');
                                    $endDate = get_field('end_event_date');


                                    if ($startDate &&  $endDate) { ?>
                                        <span class="has-start-end">
                                            <?php echo date("F j", strtotime($startDate));  ?>-<?php echo date("j, Y", strtotime($endDate));  ?>
                                        </span>

                                    <?php } else if ($startDate) { ?>
                                        <span class="has-start">
                                            <?php echo date("F j, Y", strtotime($startDate));  ?>
                                        </span>
                                    <?php } else { ?>

                                    <?php } ?>

                                </div>
                            </div>
                            <!-- eo // .event--post-details -->
                        </div><!-- eo // .event--post -->




                    <?php  }  ?>




                <?php endwhile; ?>

                <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>

                    <div class="event--post">
                        <?php if (has_post_thumbnail()) {
                            $img = get_the_post_thumbnail_url();
                        // } else {
                            $img = get_stylesheet_directory_uri() . '/assets/images/placeholder-600x320.png';
                        } ?>

                        <div class="event--post-image" style="background-image:url('<?php echo $img; ?>');background-size: cover;">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (get_field('post_button_text')) : ?>
                                    <?php the_field('post_button_text'); ?>
                                <?php else : ?>
                                    <?php echo "Learn More" ?>
                                <?php endif; ?>
                            </a>
                            <div class="event--post-speakers">
                                <?php
                                // Check rows exists.
                                if (have_rows('speakers')) :
                                    // Loop through rows.
                                    while (have_rows('speakers')) : the_row();

                                        // We need to check if the post is using a registered user for the speakers.
                                        // If is_registered is selected it will use user/author object
                                        // otherwise it will use the ACF speaker fields

                                        // Load Author/Image sub fields
                                        $user = get_sub_field('author');
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

                                            <div class="speaker is-registered-user">
                                                <?php echo $user['user_avatar']; ?>
                                            </div>

                                        <?php } else { ?>
                                            <div class="speaker is-custom-speaker">
                                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                            </div>
                                        <?php }  ?>

                                <?php
                                    // End loop.
                                    endwhile;

                                // No value.
                                else :
                                // Do something...
                                endif; ?>
                            </div><!-- eo // .event--post-speakers -->
                        </div>

                        <div class="event--post-details">
                            <div class="event--post-category">
                                <?php $entry_terms = '';
                                $terms = wp_get_post_terms(get_the_ID(), array('event_category'));

                                if (!empty($terms)) {
                                    $cat_count = 1;
                                    foreach ($terms as $term) {
                                        $entry_terms .= $term->name . ', ';
                                        if ($cat_count >= 1) {
                                            break;
                                        }
                                        $cat_count++;
                                    }
                                    $entry_terms = rtrim($entry_terms, ', ');
                                } ?>
                                <span><?php echo $entry_terms; ?></span>

                            </div>
                            <div class="event--post-title">
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            </div>
                            <div class="event--post-date">
                                <?php

                                $startDate = get_field('start_event_date');
                                $endDate = get_field('end_event_date');


                                if ($startDate &&  $endDate) { ?>
                                    <span class="has-start-end">
                                        <?php echo date("F j", strtotime($startDate));  ?>-<?php echo date("j, Y", strtotime($endDate));  ?>
                                    </span>

                                <?php } else if ($startDate) { ?>
                                    <span class="has-start">
                                        <?php echo date("F j, Y", strtotime($startDate));  ?>
                                    </span>
                                <?php } else { ?>

                                <?php } ?>

                            </div>
                        </div>
                        <!-- eo // .event--post-details -->
                    </div><!-- eo // .event--post -->


                <?php endwhile; ?>
            </div><!-- eo // .event--container -->



        </div>

    </div>
</div>
<!-- blog-content--sm-scroll -->
<div class="<?php FLLayout::container_class(); ?>">
    <main class="fl-content event-content">
        
        <h2>Additional webinars</h2>
        <?php echo do_shortcode('[facetwp template="event_additional"]'); ?>
        <?php echo do_shortcode('[facetwp facet="event_additional_webinars_pager"]'); ?>

    </main>

</div>
<?php get_footer(); ?>