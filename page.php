<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

get_header();

global $howes;
$sidebar = $howes['sidebar_page']; // Global settings

if( function_exists('is_bbpress') && is_bbpress() ){
$sidebar = $howes['sidebar_bbpress']; // Global settings
}

$sidebarposition = get_post_meta( get_the_ID(), '_thememount_page_options_sidebarposition', true);
if( is_array($sidebarposition) ){ $sidebarposition = $sidebarposition[0]; } // Converting to String if Array

// Page settings
if( trim($sidebarposition) != '' ){
	$sidebar = $sidebarposition;
}

// Primary Content class
//var_dump($sidebar);

if( !isset($primaryclass) ){
	$primaryclass = '';
}
if( $sidebar!='no' ){
	$primaryclass = setPrimaryClass($sidebar);
}


?>

<?php if( $sidebar!='no' && $sidebar!='' ): ?>
	<div class="container"><div class="row">
<?php endif; ?>
	
	<?php
	// Sidebar 1 (Left Sidebar)
	/*if( function_exists('is_bbpress') && is_bbpress() ){ // Checking if BBPRESS page. We will show BBPRESS sidebar on right side only
		$bbpressSidebar = isset($howes['sidebar_bbpress']) ? $howes['sidebar_bbpress'] : 'right' ;
		if( $bbpressSidebar=='left' ){
			get_sidebar('bbpress');
		}
	} else {*/
		/*if($sidebar=='left' || $sidebar=='both' || $sidebar=='bothleft' ){
			get_sidebar('left');
		}
		if($sidebar=='bothleft'){
			get_sidebar('right');
		}*/
	//}
	?>

	<div id="primary" class="content-area <?php echo $primaryclass; ?>">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
					<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'howes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php
	// Sidebar 2 (Right Sidebar)
	/*if( function_exists('is_bbpress') && is_bbpress() ){ // Checking if BBPRESS page. We will show BBPRESS sidebar on right side only
		$bbpressSidebar = isset($howes['sidebar_bbpress']) ? $howes['sidebar_bbpress'] : 'right' ;
		if( $bbpressSidebar=='right' ){
			get_sidebar('bbpress');
		}
	} else {*/
		/*if($sidebar=='bothright' ){
			get_sidebar('left');
		}
		if($sidebar=='right' || $sidebar=='both' || $sidebar=='bothright' ){
			get_sidebar('right');
		}*/
	//}
	?>
	
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
	
<?php if( $sidebar!='no' && $sidebar!='' ): ?>
	</div><!-- .row -->  </div><!-- .container -->
<?php endif; ?>
	



<?php get_footer(); ?>