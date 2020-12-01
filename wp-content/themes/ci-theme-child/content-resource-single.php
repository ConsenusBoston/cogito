<article <?php post_class('fl-post'); ?> id="fl-post-<?php the_ID(); ?>" <?php FLTheme::print_schema(' itemscope itemtype="https://schema.org/BlogPosting"'); ?>>


    <div class="fl-post__description">

        <div class="fl-post__description-body">
            <?php the_content(); ?>
        </div>

    </div>

</article>

<!-- .fl-post -->