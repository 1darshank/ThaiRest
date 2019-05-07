<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

get_header(); 

// Checking if Blog page
$primaryclass = 'col-md-12 col-lg-12 col-sm-12 col-xs-12';
global $howes;
$sidebar = $howes['sidebar_blog']; // Global settings

// Page settings
if( isset($sidebarposition) && trim($sidebarposition) != '' ){
	$sidebar = $sidebarposition;
}

// Primary Content class
$primaryclass = setPrimaryClass($sidebar);

?>
<div class="container">
  <div class="row">		
  
    <div id="primary" class="content-area <?php echo $primaryclass; ?>">
      <div id="content" class="site-content" role="main">
        
        <?php if ( have_posts() ) : ?>
        
        <?php
				/*
				 * Queue the first post, that way we know what author
				 * we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>
        
        
        <?php
				/*
				 * Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>
        
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
        <?php get_template_part( 'author-bio' ); ?>
        <?php endif; ?>
        
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
        
        <?php howes_paging_nav(); ?>
        
        <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
        
        </div><!-- #content -->
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
    
  </div>
</div>
<!-- .row -->
<?php get_footer(); ?>