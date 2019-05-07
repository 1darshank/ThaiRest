<?php
/**
 * The sidebar containing the sidebar 2.
 *
 */

global $wp_registered_sidebars;

$no_widget_title      = __('No Widget Found', 'howes');
$no_widget_desc_text  = __( 'We don\'t find any widget to show. Please add some widgets by going to <strong>Admin > Appearance > Widgets</strong> and add widgets in <strong>"%s"</strong> area.', 'howes' );

?>

<?php
if( is_page() ){
	?>
	
	<?php
	$sidebar2      = 'sidebar-right-page';
	$sidebar2_page = get_post_meta($post->ID,'_thememount_page_options_rightsidebar',true);
	if( trim($sidebar2_page)!='' ){ $sidebar2 = trim($sidebar2_page); }
	
	// Language translation
	$no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars[$sidebar2]['name'] );
	?>
	
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-sm-4 col-xs-12 sidebar" role="complementary">
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
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-sm-4 col-xs-12 sidebar" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-right-search' ) ) : ?>

			<div class="thememount-centertext">
				<h3><?php echo $no_widget_title; ?></h3>
				<br />
				<p><?php echo $no_widget_desc; ?></p>
				
			</div>

		<?php endif; // end sidebar widget area ?>
		
	</aside><!-- #sidebar-right -->
	
	
	
	<?php
} else {
	$no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars['sidebar-right-blog']['name'] );
	?>
	<aside id="sidebar-right" class="widget-area col-md-3 col-lg-3 col-sm-4 col-xs-12 sidebar" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-right-blog' ) ) : ?>

			<div class="thememount-centertext">
				<h3><?php echo $no_widget_title; ?></h3>
				<br />
				<p><?php echo $no_widget_desc; ?></p>
				
			</div>

		<?php endif; // end sidebar widget area ?>
		
	</aside><!-- #sidebar-right -->
		
		
	
	<?php
}
