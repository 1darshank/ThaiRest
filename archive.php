<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Howes
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
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
	<div class="row multi-columns-row">		
		
	<div id="primary" class="content-area <?php echo $primaryclass; ?>">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			<!-- <header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'howes' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'howes' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'howes' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'howes' ), get_the_date( _x( 'Y', 'yearly archives date format', 'howes' ) ) );
					else :
						_e( 'Archives', 'howes' );
					endif;
				?></h1>
			</header> -->

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