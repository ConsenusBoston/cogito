<?php get_header(); ?>

<div class="container">
	<div class="row">
	<?php get_template_part( 'templates/template-blogHead' );?>
	<div class="fl-content col-lg-12">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'content', 'single' );
			endwhile;
		endif;
		?>
	</div>

	</div>
</div>
<?php get_template_part( 'templates/template-searchModal' );?>
<?php get_footer(); ?>
