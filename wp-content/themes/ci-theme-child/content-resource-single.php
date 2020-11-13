<article <?php post_class('fl-post'); ?> id="fl-post-<?php the_ID(); ?>" <?php FLTheme::print_schema(' itemscope itemtype="https://schema.org/BlogPosting"'); ?>>


    <div class="fl-post__description">

        <div class="fl-post__categories">

            <?php

            $get_categories = wp_get_post_terms($post->ID, 'resource_topics');
            foreach ($get_categories as $category) { ?>

                <span><?php echo $category->name; ?></span>
            <?php } ?>
        </div>

       
                <div class="fl-post__title">
                    <h1><?php the_title(); ?></h1>
           

        </div>

        <div class="fl-post__description-body">
            <?php the_content(); ?>
        </div>



    </div>

</article>

<!-- .fl-post -->