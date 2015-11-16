<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

				<?php get_sidebar('sidebar1'); ?>

					<main id="main" class="m-all t-3of5 d-3of5 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<h1 class="archive-title"><?php post_type_archive_title(); ?></h1>

							<?php $counter = 1; ?>
							<?php query_posts( array (
								'post_type' 		=> 'specialist',
								'posts_per_page' 	=> -1,
								'order'    			=> 'ASC'
							) ); ?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php if ($counter % 3 == 0){ $grid_class = ' last-col'; } else { $grid_class = ''; } ?>

							<article id="specialist-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<section class="entry-content cf">

									<!--<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bones-thumb-600' ); ?></a>-->
									<h3 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink() ?>" class="read-more">Подробная информация</a>

								</section>

							</article>

							<?php
							$counter++;
							endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the custom posty type archive template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

					<?php get_sidebar('sidebar2'); ?>

				</div>

			</div>

<?php get_footer(); ?>
