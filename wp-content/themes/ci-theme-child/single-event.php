<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="fl-content fl-content-event-blog-post col-lg-12">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('content', 'event');
                endwhile;
            endif;
            ?>
        </div>

    </div>
</div>
<?php get_footer(); ?>