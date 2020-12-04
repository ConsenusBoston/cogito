<?php

/**
 * Template Name: Blog Page
 *
 * @package WordPress
 */
get_header();

$query_args = array(
	'post_type' => 'post',
	'posts_per_page' => 7,
);
$stickies = get_option('sticky_posts');
$query_args_sticky = array(
	'post_type' => 'post',
	'post__in' => $stickies,
	'posts_per_page' => 1
);
$posts_query_sticky = new WP_Query($query_args_sticky);
$posts_query = new WP_Query($query_args);
$posts_counter = 0;
?>

<div class="fl-archive">
	<div class="<?php FLLayout::container_class(); ?>">
		<div class="<?php FLLayout::row_class(); ?>">

			<?php get_template_part('templates/template-blogHead'); ?>

			<?php if ($posts_query_sticky->have_posts()) { ?>

				<?php while ($posts_query_sticky->have_posts()) {
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
								<?php if (!empty($post_categories)) : ?>
									<ul class="post-categories list-unstyled">
										<?php foreach (array_slice($post_categories, 0, 2) as $category) : ?>
											<li><a href="<?php echo get_category_link($category->term_id) ?>"><?php echo $category->name ?></a></li>
										<?php endforeach; ?>
									</ul>
								<?php endif ?>
								<a href="<?php echo get_the_permalink(); ?>" class="single-post-link">
									<?php the_title(); ?>
								</a>

								<?php if (get_the_content()) : ?>
									<?php the_excerpt(); ?>
								<?php endif; ?>

								<div class="blog-content__card__description__additional">
									<div class="post-author">
										<div class="post-author__img">
											<?php if ($author_avatar) : ?>
												<img src="<?php echo $author_avatar ?>" alt="<?php echo $author_first . " " . $author_last ?>">
											<?php endif; ?>
										</div>
										<div class="post-author__name">
											<?php echo $author_first . " " . $author_last ?>
										</div>
									</div>

									<small class="post-comments-count">
										<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
											<path d="M0 0h24v24H0V0z" fill="none" />
											<path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z" />
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
				<?php wp_reset_query(); ?>
			<?php } else { ?>

			<?php }; ?>

		</div>

	</div>
</div>
<!-- blog-content--sm-scroll -->
<div style="background-color:#FDD9C8;">
	<div class="<?php FLLayout::container_class(); ?>">
		<main class="fl-content blog-content">
			<!-- <div class=" <?php FLLayout::row_class(); ?>" <?php FLTheme::print_schema(' itemscope="itemscope" itemtype="https://schema.org/Blog"'); ?>>
				
			</div> -->

			<?php echo do_shortcode('[facetwp template="blog"]'); ?>
			<?php echo do_shortcode('[facetwp facet="event_additional_webinars_pager"]'); ?>

		</main>

	</div>
</div>
<?php get_footer(); ?>