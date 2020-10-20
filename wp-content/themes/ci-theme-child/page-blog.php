<?php
/**
* Template Name: Blog Page
*
* @package WordPress
*/
get_header(); ?>

<div class="fl-archive">
	<div class="<?php FLLayout::container_class(); ?>">
		<div class="<?php FLLayout::row_class(); ?>">

			<div class="col-lg-12 blog-head">
				<h1 class="blog-head__name">Branded blog name</h1>
				<div class="blog-head__search-btn">
					<button type="button">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="32px" height="32px"><path d="M0 0h24v24H0z" fill="none"/><path fill="#34606E" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
						</svg>
					</button>
				</div>
			</div>

			<div class="fl-sticky col-lg-12">
				<div class="blog-content__card blog-content__card--full-width">
					
					<div class="blog-content__card__description">
						<ul class="post-categories list-unstyled">
							<li>Artificial Intelligence</li>
							<li>Call Center Intelligence</li>
						</ul>
						<a href="#" class="single-post-link" >Supervising From Afar: Managing Frontline Employees Remotely</a>
						<p>From autonomous cars to virtual coaches and combatting the impact of COVID-19, artificial intelligence (AI) is rewriting the way we live, work,...</p>
						
						<div class="blog-content__card__description__additional">
							<div class="post-author">
								<div class="post-author__img">

								</div>
								<div class="post-author__name">
									Steve Kraus
								</div>
							</div>
						
							<small class="post-comments-count">
								<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
									<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
								</svg>
								<span>2</span>
							</small>
						</div>
					</div>

					<div class="blog-content__card__thumbnail">
						<!-- <img src="" alt=""> -->
					</div>
				</div>
			</div>

			<?php if ( have_posts() ) : ?>


			<?php else : ?>

				<?php get_template_part( 'content', 'no-results' ); ?>

			<?php endif; ?>
		</div>

	</div>
</div>

<div class="<?php FLLayout::container_class(); ?>">
	<main class="fl-content blog-content">
		<div class="<?php FLLayout::row_class(); ?>" <?php FLTheme::print_schema( ' itemscope="itemscope" itemtype="https://schema.org/Blog"' ); ?>>
			
			<div class="col-md-6 col-xl-4">
				<div class="blog-content__card">
					<div class="blog-content__card__thumbnail">

					</div>
					<div class="blog-content__card__description">
						<ul class="post-categories list-unstyled">
							<li>Artificial Intelligence</li>
							<li>Call Center Intelligence</li>
						</ul>
						<a href="#" class="single-post-link" >Headline 1 Headline 1 Headline 1 Headline 1 Headline 1 Headline 1 Headline 1</a>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce luctus velit sit amet leo interdum, sed vestibulum nun…</p>
						<small class="post-comments-count">
							<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
								<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
							</svg>
							<span>12</span>
						</small>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-xl-4">
				<div class="blog-content__card">
					<div class="blog-content__card__thumbnail">

					</div>
					<div class="blog-content__card__description">
						<ul class="post-categories list-unstyled">
							<li>Artificial Intelligence</li>
							<li>Call Center Intelligence</li>
						</ul>
						<a href="#" class="single-post-link" >Headline 1 Headline 1 Headline 1 Headline 1 Headline 1 Headline 1 Headline 1</a>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce luctus velit sit amet leo interdum, sed vestibulum nun…</p>
						
						<small class="post-comments-count">
							<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
								<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
							</svg>
							<span>2</span>
						</small>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-xl-4">
				<div class="blog-content__card">
					<div class="blog-content__card__thumbnail">

					</div>
					<div class="blog-content__card__description">
						<ul class="post-categories list-unstyled">
							<li>Artificial Intelligence</li>
							<li>Call Center Intelligence</li>
						</ul>
						<a href="#" class="single-post-link" >Headline 1 Headline 1 Headline 1 Headline 1 Headline 1 Headline 1 Headline 1</a>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce luctus velit sit amet leo interdum, sed vestibulum nun…</p>
						
						<small class="post-comments-count">
							<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
								<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
							</svg>
							<span>2</span>
						</small>
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="blog-content__card blog-content__card--full-width">
					<div class="blog-content__card__thumbnail">

					</div>
					<div class="blog-content__card__description">
						<ul class="post-categories list-unstyled">
							<li>Artificial Intelligence</li>
							<li>Call Center Intelligence</li>
						</ul>
						<a href="#" class="single-post-link" >AI Is Not Coming For Your Job, But It Will Change It</a>
						<p>From autonomous cars to virtual coaches and combatting the impact of COVID-19, artificial intelligence (AI) is rewriting the way we live, work,...</p>
						
						<small class="post-comments-count">
							<svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 24 24" width="17">
								<path d="M0 0h24v24H0V0z" fill="none"/><path fill="#31606E" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
							</svg>
							<span>2</span>
						</small>
					</div>
				</div>
			</div>

		</div>
	</main>
</div>

<?php get_footer(); ?>