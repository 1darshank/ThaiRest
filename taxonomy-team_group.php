<?php
/**
 * The template for displaying Team Group
 *
 * Used to display team_member with a unique design.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */
global $howes;
global $wp_query;
$tax   = $wp_query->get_queried_object();
//var_dump($tax);
/*
object(stdClass)#325 (10) {
  ["term_id"]=>
  int(19)
  ["name"]=>
  string(6) "Dental"
  ["slug"]=>
  string(6) "dental"
  ["term_group"]=>
  int(0)
  ["term_taxonomy_id"]=>
  int(19)
  ["taxonomy"]=>
  string(10) "team_group"
  ["description"]=>
  string(1344) "This is dental cat description. This is dental cat description. This is dental cat description."
  ["parent"]=>
  int(0)
  ["count"]=>
  int(2)
  ["filter"]=>
  string(3) "raw"
}
*/

/*
 * Featured Image for taxonomy
 */
$featured_img = get_option( "taxonomy_term_$tax->term_id" );
if( isset( $featured_img['thememount_img_url'] ) ){
	$featured_img = $featured_img['thememount_img_url'];
}


get_header(); ?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area <?php echo $primaryclass; ?>">
			<div id="content" class="site-content" role="main">
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<!-- Left Sidebar -->
					<div class="thememount-team-group-left col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="thememount-team-group-left-wrapper">
							<?php echo do_shortcode('[heading tag="h2" text="' . __($howes['team_group_title'], 'howes') . '"]'); ?>
							<?php
							/* List of other groups */
							echo '<div class="tm-taxonomy-term-list"><ul>';
							echo wp_list_categories( array('taxonomy'=>$tax->taxonomy, 'hide_empty'=>0,'title_li'=>'','use_desc_for_title'=>0) );
							echo '</ul></div>';
							?>
						</div>
					</div>
					
					<!-- Right Content Area -->
					<div class="thememount-team-group-right col-lg-9 col-md-9 col-sm-12 col-xs-12">
						
						<?php
						/*
						 * Category featured image
						 */
						if( trim($featured_img)!='' ){
							echo '<div class="thememount-team-term-img"><img src="'.$featured_img.'" alt="'.$tax->name.'" /></div>';
						}
						?>
						
						
						<?php
						/*
						 * Category Title
						 */
						echo do_shortcode('[heading tag="h2" text="'.$tax->name.'"]');
						?>
						
						
						<?php
						/*
						 * Category description
						 */
						echo '<div class="thememount-team-group-desc">';
						echo do_shortcode(nl2br($tax->description));
						echo '</div>';
						?>
						
						
						<?php /* The loop */ ?>
						<?php if ( have_posts() ) : ?>
							<?php echo do_shortcode('[heading tag="h2" text="'.__( $howes['team_type_title'] , 'howes').'"]'); ?>
						<?php endif; ?>
						
						<div class="row multi-columns-row">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'teammember' ); ?>
								<?php comments_template(); ?>
							<?php endwhile; ?>
						</div><!-- .row -->
						
						<?php howes_paging_nav(); ?>
					</div>
				
				</article>

			</div><!-- #content -->
		</div><!-- #primary -->
	
	</div><!-- .row -->
</div><!-- .container -->
<?php
/* Restore original Post Data */
wp_reset_postdata();
?>
<?php get_footer(); ?>