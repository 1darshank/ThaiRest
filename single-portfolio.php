<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

get_header();

$clientName = esc_attr( get_post_meta( get_the_ID(),'_thememount_portfolio_data_clientname',true) );
$clientLink = esc_url(  get_post_meta( get_the_ID(),'_thememount_portfolio_data_clientlink',true) );
$skills     = esc_attr( get_post_meta( get_the_ID(),'_thememount_portfolio_data_skills',true) );
$terms      = wp_get_post_terms( get_the_ID(), 'portfolio_category' );

$portfolioLinkText = esc_attr( get_post_meta( get_the_ID(),'_thememount_portfolio_data_portfoliolinktext',true) );
$portfolioLinkUrl  = esc_url(  get_post_meta( get_the_ID(),'_thememount_portfolio_data_portfoliolinkurl',true) );

global $howes;


// Single Portfolio View
$portfolioView        = $howes['portfolio_viewstyle']; // Global view
$portfolioView_single = get_post_meta( get_the_ID(), '_thememount_portfolio_view_viewstyle', true); // Single portfolio view
if( is_array($portfolioView_single) ){ $portfolioView_single = $portfolioView_single[0]; }
if( trim($portfolioView_single)!='' && trim($portfolioView_single)!='global' ){
	$portfolioView = $portfolioView_single;
}


$wrapper_img    = 'col-md-7';
$wrapper_text   = 'col-md-5';
$wrapper_desc   = '';
$wrapper_detail = '';
$wrapper_text_w_start = '';
$wrapper_text_w_end   = '';

if($portfolioView=='top'){
	$wrapper_img    = 'col-md-12';
	$wrapper_text   = 'col-md-12';
	$wrapper_desc   = 'col-md-9';
	$wrapper_detail = 'col-md-3';
	$wrapper_text_w_start = '<div class="row">';
	$wrapper_text_w_end   = '</div>';
}

/********* Generating array for Project Details box **********/
/*$detailsbox = '';
$detailsArray = array();
if($clientName != ''){ // Client Name and link
	if($clientLink != ''){
		$detailsArray[] = '<strong>'._('Client').'</strong>: <a href="'.$clientLink.'" target="_blank">'.$clientName.'</a>';
	} else {
		$detailsArray[] = '<strong>'._('Client').'</strong>: '.$clientName;
	}
}

if($skills != ''){ // Skills
	$detailsArray[] = '<strong>'._('Skills').'</strong>: '.$skills;
}

if(is_array($terms)){ // Category
	$termlist = array();
	foreach($terms as $term){
		$termlist[] = $term->name;
	}
	$detailsArray[] = '<strong>'._('Category').'</strong>: '.implode(', ',$termlist);
}*/
/*************************************************************/


/************** Generating Product Details Box ***************/
/*if( (is_array($detailsArray) && count($detailsArray)>0) || trim($portfolioLinkUrl)!='' ){
	$detailsbox = '<div class="portfolio-details"><h2>'.__('Project Details','howes').':</h2>';
	// Project Details
	if(is_array($detailsArray) && count($detailsArray)>0){
		$detailsbox .= '<ul class="list2">';
		foreach($detailsArray as $detail){
			$detailsbox .= '<li>'.$detail.'</li>';
		}
		$detailsbox .= '</ul>';
	}
	// Project Link
	if( trim($portfolioLinkUrl)!='' ){
		$detailsbox .= '<div class="portfolio-big-link-wrapper"><a class="portfolio-big-link" href="'.$portfolioLinkUrl.'" target="_blank">'.$portfolioLinkText.'</a></div>';
	}
	
	$detailsbox .= '</div>';
	
	
}*/
/*************************************************************/

?>
	<div class="container">
		<div id="primary" class="site-content col">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php $categories = get_the_category( get_the_ID() ); /* Getting category list for showing related portfolio items */ ?>
				
				<div class="row">
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="thememount-portfolio-content <?php echo $wrapper_img; ?>">
							<div class="entry-content">
								<?php thememount_get_portfolio_featured_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'howes' ), 'after' => '</div>' ) ); ?>
							</div><!-- .entry-content -->
							<footer class="entry-meta">
								<?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
							</footer><!-- .entry-meta -->
						</div><!-- .thememount-portfolio-content -->
						<div id="thememount-portfolio-sidebar" class="thememount-portfolio-aside <?php echo $wrapper_text; ?>">
						
						<?php echo $wrapper_text_w_start; ?>
						
							<div class="portfolio-description <?php echo $wrapper_desc; ?>">
								<?php echo do_shortcode('[heading tag="h2" text="' . __($howes['portfolio_description'], 'howes') . '"]'); ?>
								<div id="sidebar-inner">
									<?php the_content(); ?>
								</div>
							</div><!-- .portfolio-description -->
							<div class="portfolio-meta-details <?php echo $wrapper_detail; ?>">
								<?php thememount_portfolio_detailsbox(); ?>
							</div><!-- #portfolio-description -->
							
						<?php echo $wrapper_text_w_end; ?>
							
						</div><!-- .portfolio-meta-details -->
					</article><!-- #post -->
					
                </div><!-- .row -->
				
				<?php endwhile; // end of the loop. ?>
              
              
				<?php
				if( $howes['portfolio_show_related'] == '1' ){

					$catid      = wp_get_post_terms( get_the_ID() , 'portfolio_category', array("fields" => "ids"));
					$thisPostID = array(get_the_ID());
					
					$args = array(
						'post__not_in' => $thisPostID,
						'post_type'    => 'portfolio',
						'showposts'    => 4,
						'tax_query'    => array(
							array(
								'taxonomy' => 'portfolio_category',
								'field'    => 'id',
								'terms'    => $catid,
							)
						),
						'orderby' => 'rand',
					);
					
					$relatedPortfolio = new WP_Query( $args );
					
					
					if ( $relatedPortfolio->have_posts() ) {
						echo '<div class="thememount-portfolio-related">';
						echo do_shortcode('[heading tag="h2" text="' . __($howes['portfolio_related_title'], 'howes') . '"]');
						echo '<div clas="container"><div class="row">';
						while ( $relatedPortfolio->have_posts() ) { $relatedPortfolio->the_post(); ?>
							<?php echo thememount_portfoliobox( 'four' ); ?>
						<?php }; // end of the loop.
						echo '</div></div></div>';
					};
					
					// Restore original Post Data
					wp_reset_postdata();
					
				} // IF : $howes['portfolios_show_related'] == '1'
				?>
              
				</div><!-- #content -->
			</div>
		</div>
        <!-- #primary -->	

<?php get_footer(); ?>
