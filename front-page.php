<?php get_header(); ?>

<!-- FRONT PAGE TEMPLATE -->

			<!-- Place somewhere in the <body> of your page -->
			<div class="" id="slider">
				<div class="container full-width">
				  <ul class="slides">
					<img src="<?php echo get_template_directory_uri(); ?>/library/images/home-banner.jpg" alt="child with English Cream golden retriever puppy" width="100%" />
					<a href="<?php echo get_site_url(); ?>/reserve-puppy">
						
						<span class="blue-back">
							<h3>New puppies have arrived!!<br>
								<strong>Reserve Your White Golden Retriever Puppy Today!</strong>
							</h3>
						</span>
					
					</a>
				</div> <!-- End .flexslider -->
			</div> <!-- End slider -->

			<div class="container" id="content">

				
						<header class="article-header">

									<h1 class="page-name" itemprop="headline"><?php the_title(); ?>
									<span><?php echo do_shortcode('[types field="website-description" id="37"][/types]'); ?></span>
									<img alt="" src="<?php bloginfo('template_directory'); ?>/library/images/red-paw.png"></h1>

									


						</header> <!-- end article header -->

						<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>


								<div class="entry-content clearfix" itemprop="articleBody">
									<?php the_content('Read More'); ?>
							</div> <!-- end article section -->


							</div> <!-- end article -->

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
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
			
			<aside class="bottom">
				<div class="container">
				<div class="row-fluid">
					<div class="span12">
						<h2>
							Testimonials
						</h2>
						
						<?php echo do_shortcode('[wpv-view name="Featured Testimonials"]'); ?>
						
						<a class="btn" href="testimonials">View All Testimonials</a>
							
					</div>
				</div>
				</div>
			</aside>

<?php get_footer(); ?>
