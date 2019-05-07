<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

get_header();



// Checking if Blog page
$primaryclass = 'col-md-12 col-lg-12 col-xs-12';
if( is_home() ){
	global $howes;
	
	$template    = get_page_template_slug( get_option('page_for_posts') );
	$pageSidebar = get_post_meta( get_option('page_for_posts'), '_thememount_page_options_sidebarposition', true );
	if( is_array($pageSidebar) ){ $pageSidebar = $pageSidebar[0]; } // Converting to String if Array
	$blogSidebar = $howes['sidebar_blog']; // Global settings
	
	/*
	if( $pageSidebar=='' ){
		if( $template=='template-full-width.php' ){
			$sidebar = ''; // Setting full width
		} else {
			$sidebar = $blogSidebar;
		}
	}
	*/
	
	
	if( $template!='template-full-width.php' ){
		if( $pageSidebar!='' ){
			$sidebar = $pageSidebar;
		} else {
			$sidebar = $blogSidebar;
		}
	} else {
		$sidebar = '';
	}
	
	

	// Page settings
	if( isset($sidebarposition) && trim($sidebarposition) != '' ){
		$sidebar = $sidebarposition;
	}

	// Primary Content class
	$primaryclass = setPrimaryClass($sidebar);
	
	// Adding isotpe classes if blog-2-col view set as default view from theme options
	if( isset($howes['blog_view']) && trim($howes['blog_view'])!='') {
	
	$blogview = $howes['blog_view'];
	$isotopeclass = " row multi-columns-row thememount-blog-col-page thememount-blog-col-".$blogview;
	
		if( isset($howes['blog_view']) && trim($howes['blog_view'])!='' && trim($howes['blog_view']) == 'classic'){
			$isotopeclass = '';
		}
		
	}
}

?>
<div class="container">
<div class="row">		
		


	<div id="primary" class="content-area <?php echo $primaryclass;?>">
		<div id="content" class="site-content <?php echo $isotopeclass; ?>" role="main">
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				if( isset($howes['blog_view']) && trim($howes['blog_view'])!='' && trim($howes['blog_view'])!='classic' ) {
					echo thememount_blogbox($howes['blog_view']);
				} else {
					get_template_part( 'content', get_post_format() );
				}
				
				?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
		<div class="clr clear"></div>
		<?php howes_paging_nav(); ?>
	</div><!-- #primary -->
	
	<?php
	// Sidebar 1 (Left Sidebar)
	if($sidebar=='left' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('left');
	}

	// Sidebar 2 (Right Sidebar)
	if($sidebar=='right' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('right');
	}
	?>
</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>