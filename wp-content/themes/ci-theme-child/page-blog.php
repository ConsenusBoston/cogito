<?php
/**
* Template Name: Blog Page
*
* @package WordPress
*/
get_header();

$query_args = array(
	'post_type' => 'post',
	'posts_per_page' => -1,
);
$stickies = get_option( 'sticky_posts' );
$query_args_sticky = array(
	'post_type' => 'post',
	'post__in' => $stickies,
	'posts_per_page' => 1
);
$posts_query_sticky = new WP_Query( $query_args_sticky );
$posts_query = new WP_Query( $query_args );
$posts_counter = 0;
?>

<div class="fl-archive">
	<div class="<?php FLLayout::container_class(); ?>">
		<div class="<?php FLLayout::row_class(); ?>">

			<div class="col-lg-12 blog-head">
				<h1 class="blog-head__name"><?php echo get_the_title( 132 );?></h1>
				<div class="blog-head__search-btn">
					<button type="button">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="32px" height="32px"><path d="M0 0h24v24H0z" fill="none"/><path fill="#34606E" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
						</svg>
					</button>
				</div>
			</div>

			<?php if ( $posts_query_sticky->have_posts() ) { ?>
			
				<?php while ( $posts_query_sticky->have_posts() ) { 
					$posts_query_sticky->the_post();
					$post_categories = wp_get_post_categories($post->ID, array('fields' => 'all'));
					$author_first = get_the_author_meta('first_name');
					$author_last = get_the_author_meta('last_name');
					$author_description = get_the_author_meta('description');
					$author_email = get_the_author_meta('user_email');
					$author_avatar = get_avatar_url($author_email);
					?>

					<div class="fl-sticky col-lg-12">
						<div class="blog-content__card blog-content__card--full-width">
							
							<div class="blog-content__card__description">
								<?php if (!empty($post_categories)): ?>
									<ul class="post-categories list-unstyled">
										<?php foreach($post_categories as $category): ?>
											<li><?php echo $category->name?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif ?>
								<a href="<?php echo get_the_permalink(); ?>" class="single-post-link" >
									<?php the_title(); ?>
								</a>

								<?php if (get_the_content()): ?>
									<?php the_excerpt(); ?>
								<?php endif; ?>
								
								<div class="blog-content__card__description__additional">
									<div class="post-author">
										<div class="post-author__img">
										<?php if ($author_avatar): ?>
											<img src="<?php echo $author_avatar?>" alt="<?php echo $author_first ." ". $author_last ?>">
										<?php endif; ?>
										</div>
										<div class="post-author__name">
											<?php echo $author_first ." ". $author_last ?>
										</div>
									</div>
								
									<small class="post-comments-count">
										<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
											<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
										</svg>
										<span><?php echo get_comments_number(); ?></span>
									</small>
								</div>
							</div>

							<div class="blog-content__card__thumbnail">
								<?php if (has_post_thumbnail()) : ?>
									<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
								<?php endif; ?>
							</div>
						</div>
					</div>

				<?php }; ?>
				<?php wp_reset_query();?>
			<?php } else { ?>

			<?php }; ?>

		</div>

	</div>
</div>

<div class="<?php FLLayout::container_class(); ?>">
	<main class="fl-content blog-content">
		<div class="<?php FLLayout::row_class(); ?>" <?php FLTheme::print_schema( ' itemscope="itemscope" itemtype="https://schema.org/Blog"' ); ?>>
			
			<?php if ( $posts_query->have_posts() ) { ?>
			
				<?php while ( $posts_query->have_posts() ) { 
					$posts_query->the_post();
					if (!is_sticky($post->ID)) $posts_counter += 1;
					$post_categories = wp_get_post_categories($post->ID, array('fields' => 'all'));
					?>

					<?php if (!is_sticky($post->ID)): ?>
						<!-- Three Columns Posts -->
						<?php if ($posts_counter < 7): ?>
							<div class="col-md-6 col-xl-4">
								<div class="blog-content__card">
									<div class="blog-content__card__thumbnail">
										<?php if (has_post_thumbnail()) : ?>
											<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
										<?php endif; ?>
									</div>
									<div class="blog-content__card__description">
										<?php if (!empty($post_categories)): ?>
											<ul class="post-categories list-unstyled">
												<?php foreach($post_categories as $category): ?>
													<li><?php echo $category->name?></li>
												<?php endforeach; ?>
											</ul>
										<?php endif ?>
										<a href="<?php echo get_the_permalink(); ?>" class="single-post-link" >
											<?php the_title(); ?>
										</a>
										<?php if (get_the_content()): ?>
											<?php the_excerpt(); ?>
										<?php endif; ?>
										<small class="post-comments-count">
											<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
												<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
											</svg>
											<span><?php echo get_comments_number(); ?></span>
										</small>
									</div>
								</div>
							</div>
						<?php elseif ($posts_counter === 7): ?>

							<!-- Full Width Post -->
							<div class="col-lg-12">
								<div class="blog-content__card blog-content__card--full-width">
									<div class="blog-content__card__thumbnail">
										<?php if (has_post_thumbnail()) : ?>
											<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
										<?php endif; ?>
									</div>
									<div class="blog-content__card__description">
										<?php if (!empty($post_categories)): ?>
											<ul class="post-categories list-unstyled">
												<?php foreach($post_categories as $category): ?>
													<li><?php echo $category->name?></li>
												<?php endforeach; ?>
											</ul>
										<?php endif ?>

										<a href="<?php echo get_the_permalink(); ?>" class="single-post-link" >
											<?php the_title(); ?>
										</a>

										<?php if (get_the_content()): ?>
											<?php the_excerpt(); ?>
										<?php endif; ?>
										
										<small class="post-comments-count">
											<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
												<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
											</svg>
											<span><?php echo get_comments_number(); ?></span>
										</small>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					<?php $posts_counter === 7 && ($posts_counter = 0); ?>

				<?php wp_reset_query();?>
				<?php }; ?>
			<?php } else { ?>
				<?php get_template_part( 'content', 'no-results' ); ?>
			<?php }; ?>
		</div>
	</main>
</div>
<?php echo do_shortcode('[fl_builder_insert_layout id="77"]'); ?>
<?php get_footer(); ?>