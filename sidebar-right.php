<?php
/**
 * The sidebar containing the sidebar 2.
 *
 */

global $wp_registered_sidebars;
global $howes;

$no_widget_title      = __('No Widget Found', 'howes');
$no_widget_desc_text  = __( 'We don\'t find any widget to show. Please add some widgets by going to <strong>Admin > Appearance > Widgets</strong> and add widgets in <strong>"%s"</strong> area.', 'howes' );
$no_widget_desc_text_no_widget = __( 'We don\'t find any widget to show. Please add some widgets by going to <strong>Admin > Appearance > Widgets</strong> section.', 'howes' );

?>

<?php
if( is_page() ){
	?>
	
	<?php
	$sidebar2      = 'sidebar-right-page';
	$sidebar2_page = get_post_meta($post->ID,'_thememount_page_options_rightsidebar',true);
	if( trim($sidebar2_page)!='' ){ $sidebar2 = trim($sidebar2_page); }
	
	// Language translation
	if( isset($wp_registered_sidebars[$sidebar2]['name']) ){
		$no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars[$sidebar2]['name'] );
	} else {
		$no_widget_desc  = $no_widget_desc_text_no_widget;
	}
	?>
	
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php if ( ! dynamic_sidebar( $sidebar2 ) ) : ?>

			<div class="thememount-centertext">
				<h3><?php echo $no_widget_title; ?></h3>
				<br />
				<p><?php echo $no_widget_desc; ?></p>
				
			</div>

		<?php endif; // end sidebar widget area ?>
		
	</aside><!-- #sidebar-right -->
	
	<?php
} elseif( is_home() || is_single() ){
	
	$pageid   = get_option('page_for_posts');
	$postType = 'page';
	if( is_single() ){
		global $post;
		$pageid   = $post->ID;
		$postType = 'post';
	}
	
	?>
	
	<?php
	global $wp_registered_sidebars;
	$sidebar2      = 'sidebar-right-blog';
	$sidebar2_blog = get_post_meta( $pageid ,'_thememount_'.$postType.'_options_rightsidebar',true);
	if( trim($sidebar2_blog)!='' ){ $sidebar2 = trim($sidebar2_blog); }
	
	// Language translation
	$no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars[$sidebar2]['name'] );
	
	?>

	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php //dynamic_sidebar( $sidebar2 ); ?>
		<?php if ( ! dynamic_sidebar( $sidebar2 ) ) : ?>

			<div class="thememount-centertext">
				<h3><?php echo $no_widget_title; ?></h3>
				<br />
				<p><?php echo $no_widget_desc; ?></p>
				
			</div>

		<?php endif; // end sidebar widget area ?>
		
	</aside><!-- #sidebar-right -->
		
	<?php
} elseif( is_search() ) {
	$no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars['sidebar-right-search']['name'] );
	?>
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-right-search' ) ) : ?>

			<div class="thememount-centertext">
				<h3><?php echo $no_widget_title; ?></h3>
				<br />
				<p><?php echo $no_widget_desc; ?></p>
				
			</div>

		<?php endif; // end sidebar widget area ?>
		
	</aside><!-- #sidebar-right -->
	
	
	
	<?php
} elseif( function_exists('is_bbpress') && is_bbpress() ) {
	$bbpressSidebar = isset($howes['sidebar_bbpress']) ? $howes['sidebar_bbpress'] : 'right' ;
	?>
	
	<?php if( $bbpressSidebar=='right' ): ?>
	
		<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar bbpress-sidebar" role="complementary">
			<?php if ( ! dynamic_sidebar( 'sidebar-bbpress' ) ) : ?>

				<div class="thememount-centertext">
					<h3><?php echo $no_widget_title; ?></h3>
					<br />
					<p><?php echo $no_widget_desc; ?></p>
					
				</div>

			<?php endif; // end sidebar widget area ?>
			
		</aside><!-- #sidebar-right -->
		
	<?php endif; ?>
		
	<?php
} else {
	//$no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars['sidebar-right-blog']['name'] );
	
	global $howes;
	$sidebar2 = $howes['sidebar_blog']; // Global settings
	
	$sidebar2      = 'sidebar-right-blog';
	$sidebar2_post = get_post_meta($post->ID,'_thememount_post_options_rightsidebar',true);
	if( trim($sidebar2_post)!='' ){ $sidebar2 = trim($sidebar2_post); }
	
	// Language translation
	if( isset($wp_registered_sidebars[$sidebar2]['name']) ){
		$no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars[$sidebar2]['name'] );
	} else {
		$no_widget_desc  = $no_widget_desc_text_no_widget;
	}
	
	
	?>
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-xs-12 sidebar" role="complementary">
		<?php if ( ! dynamic_sidebar( $sidebar2 ) ) : ?>

			<div class="thememount-centertext">
				<h3><?php echo $no_widget_title; ?></h3>
				<br />
				<p><?php echo $no_widget_desc; ?></p>
				
			</div>

		<?php endif; // end sidebar widget area ?>
		
	</aside><!-- #sidebar-right -->
		
		
	
	<?php
}
