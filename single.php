<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="entry-title single-title page-name" itemprop="headline"><?php the_title(); ?><img alt="" src="<?php echo get_template_directory_uri(); ?>/library/images/red-paw.png"></h1>
									
									
									
								</header> <!-- end article header -->

								<section class="entry-content clearfix news-updates" itemprop="articleBody">
									
									<?php
									if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
										echo '<p>' . get_the_post_thumbnail( $page->ID, 'large' ) . '</p>';
									}
									?>
									
									<span class="posted-on">
										<time class="entry-date published updated" datetime="<?php the_date( 'Y-m-d' ); ?>">
											<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date( 'F j, Y' ); ?>
										</time>
									</span>
									
									<?php the_content(); ?>
								
								</section> <!-- end article section -->
								</article>
								

								<?php comments_template(); ?>

							</article> <!-- end article -->

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									
							</article>

						<?php endif; ?>

					</div> <!-- end #main -->
					<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
