<article <?php post_class('fl-post'); ?> id="fl-post-<?php the_ID(); ?>" <?php FLTheme::print_schema(' itemscope itemtype="https://schema.org/BlogPosting"'); ?>>



    <div class="fl-post__duration-share">


        <div class="fl-post__duration">

            <?php
            $postDuration = get_field('event_duration');

            if ($postDuration) { ?>

                <i class="fal fa-clock"></i> <?php echo $postDuration; ?> min

            <?php } ?>
        </div><!-- eo // .fl-post__duration -->


        <!-- AddToAny BEGIN -->
        <script async src="https://static.addtoany.com/menu/page.js"></script>
        <!-- AddToAny END -->

        <div class="a2a_kit a2a_kit_size_32 a2a_default_style fl-post__social-media">
            <a class="a2a_button_facebook">
                <svg id="Capa_1" enable-background="new 0 0 512 512" height="30px" viewBox="0 0 512 512" width="30px" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#31606e" d="m512 256c0-141.4-114.6-256-256-256s-256 114.6-256 256 114.6 256 256 256c1.5 0 3 0 4.5-.1v-199.2h-55v-64.1h55v-47.2c0-54.7 33.4-84.5 82.2-84.5 23.4 0 43.5 1.7 49.3 2.5v57.2h-33.6c-26.5 0-31.7 12.6-31.7 31.1v40.8h63.5l-8.3 64.1h-55.2v189.5c107-30.7 185.3-129.2 185.3-246.1z" /></svg>
            </a>
            <a class="a2a_button_linkedin">
                <svg height="30px" viewBox="0 0 512 512" width="30px" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#31606e" d="m475.074219 0h-438.148438c-20.394531 0-36.925781 16.53125-36.925781 36.925781v438.148438c0 20.394531 16.53125 36.925781 36.925781 36.925781h438.148438c20.394531 0 36.925781-16.53125 36.925781-36.925781v-438.148438c0-20.394531-16.53125-36.925781-36.925781-36.925781zm-293.464844 387h-62.347656v-187.574219h62.347656zm-31.171875-213.1875h-.40625c-20.921875 0-34.453125-14.402344-34.453125-32.402344 0-18.40625 13.945313-32.410156 35.273437-32.410156 21.328126 0 34.453126 14.003906 34.859376 32.410156 0 18-13.53125 32.402344-35.273438 32.402344zm255.984375 213.1875h-62.339844v-100.347656c0-25.21875-9.027343-42.417969-31.585937-42.417969-17.222656 0-27.480469 11.601563-31.988282 22.800781-1.648437 4.007813-2.050781 9.609375-2.050781 15.214844v104.75h-62.34375s.816407-169.976562 0-187.574219h62.34375v26.558594c8.285157-12.78125 23.109375-30.960937 56.1875-30.960937 41.019531 0 71.777344 26.808593 71.777344 84.421874zm0 0" /></svg>
            </a>
            <a class="a2a_button_twitter">
                <svg height="30px" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#31606e" d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z" /></svg>
            </a>

        </div>
    </div>

    <div class="fl-post__description">


        <div class="fl-post__description-body">
            <?php the_content(); ?>
        </div>


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

        <div class="fl-post__categories">

            <?php

            $get_categories = wp_get_post_terms($post->ID, 'event_category');
            foreach ($get_categories as $category) { ?>

                <span><?php echo $category->name; ?></span>
            <?php } ?>
        </div>

    </div>

</article>

<!-- .fl-post -->