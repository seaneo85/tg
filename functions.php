<?php
/*
Author: Sean O'Connor

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

//Masonry load scripts
if (! function_exists('slug_scripts_masonry') ) :
if ( ! is_admin() ) :
function slug_scripts_masonry() {
    wp_enqueue_script('masonry');
}
add_action( 'wp_enqueue_scripts', 'slug_scripts_masonry' );
endif; //! is_admin()
endif; //! slug_scripts_masonry exists


if ( ! function_exists( 'slug_masonry_init' )) :
function slug_masonry_init() { ?>
  <script type="text/javascript">
      
      jQuery(window).load(function() {
        
        if( $('#ms-container').length ) {
            var container = document.querySelector('#ms-container');
            var msnry = new Masonry( container, {
              itemSelector: '.ms-item',
              columnWidth: '.ms-item',
            });
        }

      });


  </script>
<?php }
//add to wp_footer
add_action( 'wp_footer', 'slug_masonry_init' );
endif; // ! slug_masonry_init exists



add_filter('types_information_table', '__return_false');

function example_dashboard_widget_function() {
	// Display whatever it is you want to show
	echo "<p>The following is basic instructions for running the website. Enjoy! :)<br>You can view the document directly to print at: <a href=\"https://docs.google.com/document/d/1uPPv0_0ewcWFbZgcTwNh7OFZr9dT1XAcOHaM8jnD7Uo/edit\">LINK</a></p><iframe src=\"https://docs.google.com/document/d/1uPPv0_0ewcWFbZgcTwNh7OFZr9dT1XAcOHaM8jnD7Uo/pub?embedded=true\" width=\"100%\" height=\"700px\"></iframe>";
}

// Create the function use in the action hook
function example_add_dashboard_widgets() {
	wp_add_dashboard_widget('example_dashboard_widget', 'Treasure Goldens Website Documentation', 'example_dashboard_widget_function');
}
// Hoook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );



// disable default dashboard widgets
function disable_default_dashboard_widgets() {

	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

//remove the windows from the edit page/post screen

function remove_page_excerpt_field() {
	remove_meta_box( 'postexcerpt' , 'page' , 'normal' );
	remove_meta_box( 'postexcerpt' , 'post' , 'normal' );
	remove_meta_box( 'trackbacksdiv' , 'page' , 'normal' );
	remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' );
	remove_meta_box( 'postcustom' , 'page' , 'normal' );
	remove_meta_box( 'postcustom' , 'post' , 'normal' );
	remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
	remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
	remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
	remove_meta_box( 'commentsdiv' , 'post' , 'normal' );
	remove_meta_box( 'slugdiv' , 'page' , 'normal' );
	remove_meta_box( 'slugdiv' , 'post' , 'normal' );
	remove_meta_box( 'authordiv' , 'page' , 'normal' );
	remove_meta_box( 'authordiv' , 'post' , 'normal' );
	remove_meta_box( 'revisionsdiv' , 'page' , 'normal' );
	remove_meta_box( 'revisionsdiv' , 'post' , 'normal' );
	remove_meta_box( 'categorydiv' , 'page' , 'normal' );
	remove_meta_box( 'categorydiv' , 'post' , 'normal' );
	remove_meta_box( 'tagsdiv-post_tag' , 'page' , 'normal' );
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' );
	remove_meta_box( 'postimagediv' , 'page' , 'normal' );
	remove_meta_box( 'postimagediv','post','normal' );
}

if (!current_user_can('manage_options')) {
      add_action( 'admin_menu' , 'remove_page_excerpt_field' );
}


if ( !current_user_can('manage_options') ) {
add_action('init', 'remove_content_template');
function remove_content_template() {
 global $WPV_templates;
 remove_action('admin_head', array($WPV_templates,'post_edit_template_options'));
}
}

add_shortcode('wpv-post-excerpt', 'my_excerpt');
function my_excerpt($atts) {
 global $post;
 extract(shortcode_atts( array('length' => 0), $atts ));
 if ($length > 0) {
   $excerpt_length = $length;
 } else {
   $excerpt_length = apply_filters('excerpt_length', 252);
 }
 if ( empty($post->post_excerpt) ) {
   $excerpt = $post->post_content;
   $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
 } else {
   $excerpt = $post->post_excerpt;
   $excerpt_length = strlen($excerpt); // don't cut manually inserted excerpts
   $excerpt_more = '';
 }
 if (strlen($excerpt) > $excerpt_length) {
   $excerpt = substr($excerpt, 0, $excerpt_length) . $excerpt_more;
 }
 return $excerpt;
}

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
//require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 800, 450, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<!-- end custom gravatar call -->
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!


?>
