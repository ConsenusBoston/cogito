<?php get_header(); ?>

<div class="container">
	<div class="row">

	<div class="col-lg-12 blog-head">
		<h1 class="blog-head__name">Branded blog name</h1>
		<div class="blog-head__search-btn">
			<button type="button">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="32px" height="32px"><path d="M0 0h24v24H0z" fill="none"/><path fill="#34606E" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
				</svg>
			</button>
		</div>
	</div>


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

<?php get_footer(); ?>
