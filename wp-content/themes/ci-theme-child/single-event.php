<?php get_header(); ?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="fl-content event-single-post-detail col-lg-7">
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