<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<?php get_sidebar('sidebar1'); ?>

						<main id="main" class="m-all t-3of5 d-3of5 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="article-header">

									<h1 class="single-title specialist-title"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content cf">
									<?php 
									if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
										the_post_thumbnail( 'medium', array( 'class' => 'alignleft' ));
									} 
									?>
									<?php the_content(); ?>
								</section> <!-- end article section -->

								<footer class="article-footer">
									

								</footer>

							</article>

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

						<?php get_sidebar('sidebar2'); ?>

				</div>

			</div>

<?php get_footer(); ?>
