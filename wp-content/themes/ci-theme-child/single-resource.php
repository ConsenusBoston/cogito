<?php get_header(); ?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="fl-content resource-single-post-detail col-lg-12">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('content', 'resource-single');
                endwhile;
            endif;
            ?>
        </div>

    </div>
</div>
<?php get_footer(); ?>