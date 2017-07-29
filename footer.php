	<footer class="full-width bg-tex" id="footer">
	
		<div class="container full-width">
			<div class="row-fluid">
				<div class="span12">
					<nav>
								<?php bones_footer_links(); ?>
					</nav>		
					
					<div id="footer-logo">
						<a class="logo" href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/treasure-goldens-logo.png" alt="<?php bloginfo( 'name' ); ?>" width="180"></a>
						<p>&copy; <?php echo date('Y'); ?></p>
					</div>
				</div> <!-- End span12 -->
			</div> <!-- End row-fluid -->
		</div> <!-- End container full-width -->
	</footer>

</div>

<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>


</body>
</html>