<?php
/*
 Template Name: Blog Page Template
*/

get_header(); ?>

			<!-- Place somewhere in the <body> of your page -->
			
			<div class="container" id="content">

				
						<header class="article-header">

									<h1 class="page-name"><?php the_title(); ?><img alt="" src="<?php bloginfo('template_directory'); ?>/library/images/red-paw.png"></h1>
									


								</header> <!-- end article header -->

						<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<div id="post-<?php the_ID(); ?>" class="clearfix">


								<div class="entry-content clearfix">
									<?php the_content(); ?>
								</div> <!-- end article section -->


							</div> <!-- end article -->
		
							<?php endwhile; else : ?>

									<article id="post-not-found" class="clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <!-- end #main -->
						<?php get_sidebar(); ?>


			</div> <!-- end #content -->

<?php get_footer(); ?>
