<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
    'posts_per_page' => 2,
    'post_type' => 'event',
    'paged' => $paged
    );
    $additional_posts = new WP_Query($args);
?>

<div class="additional-webinars">
    <div class="row">
        <?php if ($additional_posts->have_posts()): ?>
            <?php while ($additional_posts->have_posts()) : $additional_posts->the_post(); ?>
                <div class="additional-webinars--column col-12 col-md-6 col-lg-4 col-xl-3">
                    
                    <div class="event--post">
                        <?php if (has_post_thumbnail()) {
                            $img = get_the_post_thumbnail_url();
                            // } else {
                            $img = get_stylesheet_directory_uri() . '/assets/images/placeholder-600x320.png';
                        } ?>

                        <div class="event--post-image" style="background-image:url('<?php echo $img; ?>');background-size: cover;">
                            <a href="<?php the_permalink(); ?>">
                            <?php if(get_field('post_button_text')): ?>
                                <?php the_field('post_button_text'); ?>
                            <?php else: ?>
                                <?php echo "Learn More"?>
                            <?php endif; ?>
                            </a>
                            <div class="event--post-speakers">
                                <?php
                                // Check rows exists.
                                if (have_rows('speakers')) :
                                    // Loop through rows.
                                    while (have_rows('speakers')) : the_row();

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
                </div>
            <?php endwhile; ?>
            <?php 
                $total_pages = $loop->max_num_pages;

                if ($total_pages > 1){
            
                    $current_page = max(1, get_query_var('paged'));
            
                    echo paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => '/page/%#%',
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_text'    => __('« prev'),
                        'next_text'    => __('next »'),
                    ));
                }
            ?>
        <?php endif;?>
    </div>
</div>

