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

// get today's date
$today = date('Y-m-d');

// Get Events from Todays Date forward
$query_args_one = array(
    'post_type'         => 'event',
    'posts_per_page'    => 6,
    'order'             => 'ASC',
    'value'             => $today,
    'orderby'           => 'meta_value',
    'meta_query' => array(
        // 'relation' => 'AND',
        array(
            'key'     => 'end_event_date',
            'value'   =>  date('Y-m-d'),
            'compare' => '>=',
            'type'    => 'DATE',
        ),
        array(
            'key'   => 'is_post_featured',
            'value' => '0'
        )
    ),
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
                            <?php

                            if (has_post_thumbnail()) {
                                $img = get_the_post_thumbnail_url();
                            } else {
                                $img = get_stylesheet_directory_uri() . '/assets/images/placeholder-600x320.png';
                            }

                            $external_link = get_field('external_link');
                            if ($external_link) :
                                $link_url = $external_link['url'];
                                $link_title = $external_link['title'];
                                $link_target = $external_link['target'] ? $external_link['target'] : '_self';
                            ?>
                                <a href="<?php echo $link_url; ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>">
                                    <?php endif; ?>
                                    <div class="event--post-image" style="background-image:url('<?php echo $img; ?>');background-size: cover;">
                                        <span>
                                            <?php if (get_field('post_button_text')) : ?>
                                                <?php the_field('post_button_text'); ?>
                                            <?php else : ?>
                                                <?php echo "Learn More" ?>
                                            <?php endif; ?>
                                        </span>
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
                                    </a>

                                    <div class="event--post-details">

                                        <div class="event--post-title">
                                            <h1>
                                                <?php

                                                $external_link = get_field('external_link');
                                                if ($external_link) :
                                                    $link_url = $external_link['url'];
                                                    $link_title = $external_link['title'];
                                                    $link_target = $external_link['target'] ? $external_link['target'] : '_self';
                                                ?>
                                                    <a href="<?php echo $link_url; ?>" target="<?php echo esc_attr($link_target); ?>">
                                                    <?php else : ?>
                                                        <a href="<?php the_permalink(); ?>">
                                                        <?php endif; ?>
                                                        <?php the_title(); ?></a>
                                            </h1>
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
                                                    <?php echo date("F j", strtotime($startDate));  ?>&nbsp;-&nbsp;<?php echo date("F j, Y", strtotime($endDate));  ?>
                                                </span>

                                            <?php } else if ($startDate) { ?>
                                                <span class="has-start">
                                                    <?php echo date("F j, Y", strtotime($startDate));  ?>
                                                </span>
                                            <?php } else { ?>

                                                <span class="has-start-end">
                                                    <?php echo date("F j, Y", strtotime($endDate));  ?>
                                                </span>

                                            <?php } ?>

                                        </div>
                                    </div>
                                    <!-- eo // .event--post-details -->
                        </div><!-- eo // .event--post -->




                    <?php  }  ?>




                <?php endwhile; ?>

                <div class="event--header">
                    <h2>Upcoming Events</h2>
                </div>

                <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>

                    <div class="event--post">
                        <?php

                        if (has_post_thumbnail()) {
                            $img = get_the_post_thumbnail_url();
                        } else {
                            $img = get_stylesheet_directory_uri() . '/assets/images/placeholder-600x320.png';
                        }

                        $external_link = get_field('external_link');
                        if ($external_link) :
                            $link_url = $external_link['url'];
                            $link_title = $external_link['title'];
                            $link_target = $external_link['target'] ? $external_link['target'] : '_self';
                        ?>
                            <a href="<?php echo $link_url; ?>" target="<?php echo esc_attr($link_target); ?>">
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>">
                                <?php endif; ?>
                                <div class="event--post-image" style="background-image:url('<?php echo $img; ?>');background-size: cover;">
                                    <span>
                                        <?php if (get_field('post_button_text')) : ?>
                                            <?php the_field('post_button_text'); ?>
                                        <?php else : ?>
                                            <?php echo "Learn More" ?>
                                        <?php endif; ?>
                                    </span>
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
                                </a>

                                <div class="event--post-details">
                                    <div class="event--post-category">
                                        <?php
                                        $categories = get_the_terms($post->ID, 'event_category');
                                        $term = $categories[0];
                                        ?>
                                        <a href="/event-category/<?php echo $term->slug ?>"><?php echo $term->name ?></a>
                                    </div>
                                    <div class=" event--post-title">
                                        <h1>

                                            <?php

                                            if (has_post_thumbnail()) {
                                                $img = get_the_post_thumbnail_url();
                                            } else {
                                                $img = get_stylesheet_directory_uri() . '/assets/images/placeholder-600x320.png';
                                            }

                                            $external_link = get_field('external_link');
                                            if ($external_link) :
                                                $link_url = $external_link['url'];
                                                $link_title = $external_link['title'];
                                                $link_target = $external_link['target'] ? $external_link['target'] : '_self';
                                            ?>
                                                <a href="<?php echo $link_url; ?>" target="<?php echo esc_attr($link_target); ?>">
                                                <?php else : ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                    <?php endif; ?>

                                                    <?php the_title(); ?></a>
                                        </h1>
                                    </div>
                                    <div class="event--post-date">
                                        <?php

                                        $startDate = get_field('start_event_date');
                                        $endDate = get_field('end_event_date');


                                        if ($startDate &&  $endDate) { ?>
                                            <span class="has-start-end">
                                                <?php echo date("F j", strtotime($startDate));  ?>&nbsp;-&nbsp;<?php echo date("F j, Y", strtotime($endDate));  ?>
                                            </span>

                                        <?php } else if ($startDate) { ?>
                                            <span class="has-start">
                                                <?php echo date("F j, Y", strtotime($startDate));  ?>
                                            </span>
                                        <?php } else { ?>

                                            <span class="has-start-end">
                                                <?php echo date("F j, Y", strtotime($endDate));  ?>
                                            </span>

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

        <?php if (get_field('additional_webinar_text', 3160)) : ?>
            <h2><?php the_field('additional_webinar_text', 3160); ?></h2>
        <?php else : ?>
            <h2>Additional webinars</h2>
        <?php endif; ?>


        <div class="events--top-pager"></div>
        <?php echo do_shortcode('[facetwp template="event_additional"]'); ?>
        <?php echo do_shortcode('[facetwp facet="event_additional_webinars_pager"]'); ?>


        <script>
            (function($) {
                $(document).on('facetwp-loaded', function() {

                    var first = $('.facetwp-pager .facetwp-page.first').html(),
                        active = $('.facetwp-pager .facetwp-page.active').html(),
                        last = $('.facetwp-pager .facetwp-page.last').html(),
                        html = active + ' of ' + last;

                    if (active) {
                        $('.events--top-pager').html(html);
                    }

                });
            })(jQuery);
        </script>
    </main>

</div>
<?php get_footer(); ?>