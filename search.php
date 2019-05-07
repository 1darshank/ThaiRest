<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */


get_header();

global $howes;
$sidebar      = esc_attr($howes['sidebar_search']); // Global settings 
$primaryclass = setPrimaryClass($sidebar);  // Primary Content class

$postCount = 0;



function tm_page_search_filter( $query ) {
	if ( $query->is_search && isset($_GET['post_type']) && $_GET['post_type']=='page' ) {
		$query->set( 'post_type', 'page' );
	}
	return $query;
}
add_filter('pre_get_posts','tm_page_search_filter', 20);



// Fetching all results
$args = array();
if( get_query_var('post_type')=='any' && !isset($_GET['post_type']) ){
	$args['posts_per_page'] = -1 ;
} else if( get_query_var('post_type')=='portfolilo'
		|| get_query_var('post_type')=='team_member'
		|| get_query_var('post_type')=='product'
		|| get_query_var('post_type')=='tribe_events'
	){
	$args['posts_per_page'] = 9 ;
} else if( isset($_GET['post_type']) && $_GET['post_type']=='page' ){
	$args['posts_per_page'] = 20 ;
} else {
	// show 10 results for rest CPT
	$args['posts_per_page'] = 10 ;
}



// Fetching for CPT only result if set in URL query
if( get_query_var('post_type')!=false && get_query_var('post_type')!='any' ){ $args['post_type'] = get_query_var('post_type'); }


// Final query
if ($wp_query->is_search) {
	query_posts( array_merge( $args, $wp_query->query) );
}



// Max result per custom post type
$tm_max_result_per_cpt = 10;

?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area <?php echo $primaryclass; ?>">
			<div id="content" class="site-content" role="main">
			
			
			<?php
			// Page and Post List
			if ( have_posts() ) :
				$pageListCount      = 0;
				$postListCount      = 0;
				$portfolioListCount = 0;
				$teamListCount      = 0;
				$wproductsListCount = 0;
				$eventsListCount    = 0;
				$pageList      = '';
				$postList      = '';
				$portfolioList = '';
				$teamList      = '';
				$wproductsList = '';
				$eventsList    = '';
				$postType      = '';
				$pageListClass = 'col-md-6';
				$postListClass = 'col-md-6';
				$otherCPT      = array();
				
				$pageListLeft  = '';
				$pageListRight = '';
				$pageListLeftCount  = 0;
				$pageListRightCount = 0;
				
				$cpt_title_portfolio = ( isset($howes['pf_type_title']) && trim($howes['pf_type_title'])!='' ) ? trim($howes['pf_type_title']) : __('Portfolio', 'howes') ;
				$cpt_title_team      = ( isset($howes['team_type_title']) && trim($howes['team_type_title'])!='' ) ? trim($howes['team_type_title']) : __('Team Members', 'howes') ;
				
				
				/* The loop */
				while ( have_posts() ) : the_post();
				
					if( get_post_type() == 'page' ){
						// Page
						$showPage = ( get_query_var('post_type')=='page' ) ? 20 : 10 ;
						if( get_query_var('post_type')=='page' ){
							$pageListClass = 'col-md-12';
						}
						if( $pageListCount<$showPage ){
							if( get_query_var('post_type')=='page' ){
								// PAGE only result page
								
								$desc = ( has_excerpt() ) ? '<div class="tm-result-page-content">'.get_the_excerpt().'</div>' : '' ;
								
								if( $pageListLeftCount<10 ){
									$pageListLeft .= '
									<li>
										<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										'.$desc.'
									</li>';
									$pageListLeftCount++;
								} else {
									$pageListRight .= '
									<li>
										<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										'.$desc.'
									</li>';
									$pageListRightCount++;
								}
								 
								
							} else {
								$pageList .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
							}
							
						}
						$pageListCount++;
						
					} else if( get_post_type() == 'post' ){
						// Post
						$showPost = ( get_query_var('post_type')=='post' ) ? 9 : 5 ;
						if( $postListCount<$showPost ){
							
							if( get_query_var('post_type')=='post' ){
								// Box view
								$postList .= thememount_blogbox( 'three' );
								$postListClass = 'col-md-12';
							} else {
								// Post list view
								if ( has_post_thumbnail( get_the_ID() ) ) {
									$featuredImage = get_the_post_thumbnail(get_the_ID(), 'thumbnail' );
								} else {
									$featuredImage = '<img src="'.get_template_directory_uri().'/images/noimage-150x150.png" />';
								}
								$postList .= '
								<li>
									<a href="'.get_permalink().'">'.$featuredImage.'</a>
									<a href="'.get_permalink().'">'.get_the_title().'</a>
									<span class="post-date">'.get_the_date('M j, Y').'</span>
								</li>';
							}
						}
						$postListCount++;
						
					} else if( get_post_type() == 'portfolio' ){
						// Portfolio
						$showPortfolio = ( get_query_var('post_type')=='portfolio' ) ? 9 : 3 ;
						if( $portfolioListCount<$showPortfolio ){
							/*ob_start();
							get_template_part( 'content', 'portfolio' );
							$portfolioList .= ob_get_contents();
							ob_end_clean();*/
							$portfolioList .= thememount_portfoliobox('three');
						}
						$portfolioListCount++;
						
					} else if( get_post_type() == 'team_member' ){
						// Team Members
						$showTeam = ( get_query_var('post_type')=='team_member' ) ? 9 : 3 ;
						if( $teamListCount<$showTeam ){
							ob_start();
							get_template_part( 'content', 'teammember' );
							$teamList .= ob_get_contents();
							ob_end_clean();
						}
						$teamListCount++;
						
					} else if( get_post_type() == 'product' ){
						// WooCommerce Products
						$showProduct = ( get_query_var('post_type')=='product' ) ? 9 : 3 ;
						if( $wproductsListCount<$showProduct ){
							ob_start();
							wc_get_template_part( 'content', 'product' );
							$wproductsList .= ob_get_contents();
							ob_end_clean();
						}
						$wproductsListCount++;
						
					} else if( get_post_type() == 'tribe_events' ){
						// Events
						$showEvents = ( get_query_var('post_type')=='tribe_events' ) ? 9 : 3 ;
						if( $eventsListCount<$showEvents ){
							$eventsList .= thememount_eventsbox( 'three', 'default' );
						}
						$eventsListCount++;
						
					} else {
						// Other Custom Post Types
						if( get_post_type()!='slide' ){
							$otherCPT[get_post_type()][] = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
						}
						
						
					}
					
					
				endwhile;
			
				
				
				// Wrapping all CPT contents
				$pageList = ($pageList!='') ? '<ul class="list-style list-style7">'.$pageList.'</ul>' : '' ;
				
				$pageListLeft = ($pageListLeft!='') ? '<ul class="tm-search-list tm-search-pagelist tm-list tm-list-style-icon">'.$pageListLeft.'</ul>' : '' ;
				
				$pageListRight = ($pageListRight!='') ? '<ul class="tm-search-list tm-search-pagelist tm-list tm-list-style-icon">'.$pageListRight.'</ul>' : '' ;
				
				if( get_query_var('post_type')=='post' ){
					$postList = ($postList!='') ? '<div class="tm-search-list tm-search-postlist multi-columns-row multi-columns-row">'.$postList.'</div>' : '' ;
				} else {
					$postList = ($postList!='') ? '<ul class="tm-search-list tm-search-postlist thememount_widget_recent_entries">'.$postList.'</ul>' : '' ;
				}
				
				
				$portfolioList = ($portfolioList!='') ? '<div class="row tm-search-list tm-search-portoliolist multi-columns-row">'.$portfolioList.'</div>' : '' ;
				$teamList = ($teamList!='') ? '<div class="row tm-search-list tm-search-teamlist">'.$teamList.'</div>' : '' ;
				$eventsList = ($eventsList!='') ? '<div class="row tm-search-list tm-search-eventlist">'.$eventsList.'</div>' : '' ;
				$wproductsList = ($wproductsList!='') ? '<div class="woocommerce"><ul class="row tm-search-list tm-search-wproductslist products">'.$wproductsList.'</ul></div>' : '' ;
				
				
				
				// View More link setup
				$viewmore_page = ($pageListCount>10) ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'&post_type=page" class="label label-default">'.__('View more','howes').'</a></small>' : '' ;
				
				$viewmore_post = ($postListCount>4) ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'&post_type=post" class="label label-default">'.__('View more','howes').'</a></small>' : '' ;
				
				$viewmore_portfolio = ($portfolioListCount>3 && get_query_var('post_type')!='portfolio') ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'&post_type=portfolio" class="label label-default">'.__('View more','howes').'</a></small>' : '' ;
				
				$viewmore_team = ($teamListCount>3) ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'&post_type=team_member" class="label label-default">'.__('View more','howes').'</a></small>' : '' ;
				
				$viewmore_wproducts = ($wproductsListCount>3) ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'&post_type=product" class="label label-default">'.__('View more','howes').'</a></small>' : '' ;
				
				$viewmore_events = ($eventsListCount>3) ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'&post_type=tribe_events" class="label label-default">'.__('View more','howes').'</a></small>' : '' ;
				
				
				
				// Back to results page link
				$viewmore_page = ( get_query_var('post_type')=='page') ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'" class="label label-default"><i class="tmicon-fa-chevron-left"></i> &nbsp; '.__('Back to results','howes').'</a></small>' : $viewmore_page;
				
				$viewmore_portfolio = ( get_query_var('post_type')=='portfolio') ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'" class="label label-default"><i class="tmicon-fa-chevron-left"></i> &nbsp; '.__('Back to results','howes').'</a></small>' : $viewmore_portfolio;
				
				$viewmore_team = ( get_query_var('post_type')=='team_member') ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'" class="label label-default"><i class="tmicon-fa-chevron-left"></i> &nbsp; '.__('Back to results','howes').'</a></small>' : $viewmore_team;
				
				$viewmore_post = ( get_query_var('post_type')=='post') ? ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'" class="label label-default"><i class="tmicon-fa-chevron-left"></i> &nbsp; '.__('Back to results','howes').'</a></small>' : $viewmore_post;
				
				?>
				
				<!-- Search form -->
				<div class="tm-sresult-form-wrapper">
					<div class="tm-sresult-form-top">
						<h2>
							<i class="tmicon-fa-search"></i>
							<?php _e('You searched for', 'howes'); ?>
						</h2>
						<?php get_search_form(); ?>
						<div class="tm-sresults-settings-wrapper">
							<a class="tm-sresults-settings-btn" href="#">
								<i class="tmicon-fa-gear"></i>  
								<span><?php _e('Settings', 'howes'); ?></span>
							</a>
						</div>
						<div class="clr clear"></div>
					</div>
					<div class="tm-sresult-form-bottom-w">
						<div class="tm-sresult-form-bottom row" style="display:none;">
						
							<?php
								// CPT list for selection
								$cptList = array(
									'any'            => __('All selections', 'howes'),
									'page'           => __('Pages', 'howes'),
									'post'           => __('Blog posts', 'howes'),
									'product'        => __('Products', 'howes'),
									'tribe_events'   => __('Events', 'howes'),
									'portfolio'   => $cpt_title_portfolio,
									'team_member' => $cpt_title_team,
								);
								
								
								
								?>
						<div class="tm-search-main-box clearfix">
                            <div class="tm-search-text"><strong><?php _e('Search in:','howes'); ?></strong></div>
							<div class="tm-search-select-box">
								
								<select class="tm-sresult-cpt-select">
									<?php foreach( $cptList as $cptkey=>$cptval ){
										$selected = ( isset($_GET['post_type']) && $_GET['post_type']==$cptkey ) ? ' selected="selected" ' : '' ;
										echo '<option value="'.$cptkey.'" class="'.$cptkey.'" '.$selected.'>'.$cptval.'</option>';
									} ?>
							  </select>
                              <div class="tm-sresult-form-sbtbtn-wrapper">
								<input class="tm-sresult-form-sbtbtn" type="submit" value="<?php _e('Search now','howes'); ?>" />
							  </div>
						  </div>
							
                          </div>
						</div><!-- .tm-sresult-form-bottom -->
					</div><!-- .tm-sresult-form-bottom-w -->
				</div>
				
				
				<script>
					jQuery('.tm-sresult-form-wrapper .tm-sresults-settings-btn').click(function(){
						jQuery('.tm-sresult-form-wrapper .tm-sresult-form-bottom').slideToggle('400',function(){
							if( jQuery('.tm-sresult-form-wrapper .tm-sresult-form-bottom').is(":hidden") ){
								jQuery('.tm-sresult-form-wrapper .tm-sresults-settings-btn').removeClass('tm-sresult-btn-active');
							} else {
								jQuery('.tm-sresult-form-wrapper .tm-sresults-settings-btn').addClass('tm-sresult-btn-active');
							}
						});
						return false;
					});
					
					// Check if post_type input is available or not
					if( jQuery(".tm-sresult-form-wrapper form.search-form input[name='post_type']").length==0 ){
						jQuery('<input>').attr({
							type : 'hidden',
							name : 'post_type'
						}).appendTo('.tm-sresult-form-wrapper form.search-form');
					}
					
					// On change of the CPT dropdown
					jQuery(".tm-sresult-form-wrapper .tm-sresult-cpt-select").change(function(){
						jQuery(".tm-sresult-form-wrapper form.search-form input[name='post_type']").val( jQuery(this).val() );
					});
					
					// Submit the form
					jQuery(".tm-sresult-form-wrapper .tm-sresult-form-sbtbtn").click(function(){
						jQuery(".tm-sresult-form-wrapper form.search-form").submit();
					});
					
					
				</script>
				
				
				<!-- Page and posts -->
				<div class="row tm-search-results-wrapper tm-search-results-w-pagepost">
					<?php if( trim($pageList)!='' ): ?>
					<div class="<?php echo $pageListClass; ?>">
						<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.__('Page','howes').'</strong>' ); ?><?php echo $viewmore_page; ?></h2>
						<?php echo $pageList; ?>
					</div>
					<?php endif; ?>
					
					<?php if( trim($pageListLeft)!='' ): ?>
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.__('Page','howes').'</strong>' ); ?><?php echo $viewmore_page; ?></h2>
					</div>
					<div class="col-md-6">
						<?php echo $pageListLeft; ?>
					</div>
					<div class="col-md-6">
						<?php echo $pageListRight; ?>
					</div>
					<?php endif; ?>
					
					<?php if( trim($postList)!='' ): ?>
					<div class="<?php echo $postListClass; ?>">
						<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.__('Post','howes').'</strong>' ); ?><?php echo $viewmore_post; ?></h2>
						<?php echo $postList; ?>
					</div>
					
					<?php endif; ?>
					
				</div>
				
				
				<br><br>
				
				<?php if( trim($portfolioList)!='' ): ?>
				<!-- Portfolio -->
				<div class="row tm-search-results-wrapper tm-search-results-w-portfolilo">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.$cpt_title_portfolio.'</strong>' ); ?><?php echo $viewmore_portfolio; ?></h2>
						<?php echo $portfolioList; ?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				<?php if( trim($teamList)!='' ): ?>
				<!-- Team -->
				<div class="row tm-search-results-wrapper tm-search-results-w-team">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.$cpt_title_team.'</strong>' ); ?><?php echo $viewmore_team; ?></h2>
						<?php echo $teamList; ?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				<?php if( trim($wproductsList)!='' ): ?>
				<!-- WooCommerce Products -->
				<div class="row tm-search-results-wrapper tm-search-results-w-products">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.__('Products','howes').'</strong>' ); ?><?php echo $viewmore_wproducts; ?></h2>
						<?php echo $wproductsList; ?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				<?php if( trim($eventsList)!='' ): ?>
				<!-- TribeEvents -->
				<div class="row tm-search-results-wrapper tm-search-results-w-events">
					<div class="col-md-12">
						<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.__('Events','howes').'</strong>' ); ?><?php echo $viewmore_events; ?></h2>
						<?php echo $eventsList; ?>
					</div>
				</div>
				<br><br>
				<?php endif; ?>
				
				
				
				<?php
				// Other CPT
				foreach( $otherCPT as $cpt=>$content ){
					$cptdata = get_post_type_object( $cpt );
					$cptname = $cptdata->labels->name;
					$x = 0;
					
					$viewMoreLink = '';
					
					if( count($content)>10 ){
						$viewMoreLink = ' &nbsp; <small><a href="'.get_home_url().'?s='.get_search_query().'&post_type='.$cpt.'" class="label label-default">'. __('View more','howes').'</a></small>';
					}
					
					?>
					<div class="row tm-search-results-wrapper tm-search-results-w-<?php echo $cpt; ?>">
						<div class="col-md-12">
							<h2 class="tm-search-results-title"><?php printf(__('Search results for %s', 'howes'), '<strong>'.__($cptname,'howes').'</strong>' ); ?> <?php echo $viewMoreLink; ?></h2>
							<?php
							if( count($content)>0 ){
								echo '<ul class="tm-search-list tm-search-'.$cpt.'list">';
								foreach( $content as $row ){
									if( $x<$tm_max_result_per_cpt ){
										echo '<li>'.$row.'</li>';
									}
									$x++;
								}
								echo '</ul>';
							}
							?>
						</div>
					</div>
					<br><br>
					
					<?php
				}
				?>
				
				
				
				<?php howes_paging_nav(); ?>
				
				
				
				
					<br><br>
					
					
			<?php else: ?>
			
				<div class="tm-no-sresult-wrapper">
					<?php echo $howes['searchnoresult']; ?>
					<div class="tm-search-result-form"><?php get_search_form(); ?></div>
					<br><br>
				</div>
				
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
		
	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>