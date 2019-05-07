<?php
/**
 * The template for displaying Portfolio Category
 *
 * Used to display tm_portfolio_category with a unique design.
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


$pfcat_column = ( isset($howes['pfcat_column']) && trim($howes['pfcat_column'])!='' ) ? trim($howes['pfcat_column']) : 'two' ;


get_header(); ?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<!-- Left Sidebar -->
					<div class="tm-taxonomy-left col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="tm-taxonomy-left-wrapper">
							<?php
							/* List of other groups */
							echo '<div class="tm-taxonomy-term-list"><ul>';
							echo wp_list_categories( array('taxonomy'=>$tax->taxonomy, 'hide_empty'=>0,'title_li'=>'','use_desc_for_title'=>0) );
							echo '</ul></div>';
							?>
						</div>
					</div>
					
					<!-- Right Content Area -->
					<div class="tm-taxonomy-right col-lg-9 col-md-9 col-sm-12 col-xs-12">
						
						<?php
						/*
						 * Category description
						 */
						echo '<div class="tm-term-desc">';
							echo do_shortcode('[heading text="'.$tax->name.'"]');
							echo do_shortcode(nl2br($tax->description));
						echo '</div>';
						?>
						
						
						<?php /* The loop */ ?>
						
						<div class="row multi-columns-row">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php echo thememount_portfoliobox($pfcat_column) ?>
								<?php //get_template_part( 'content', 'portfolio' ); ?>
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

<?php get_footer(); ?>