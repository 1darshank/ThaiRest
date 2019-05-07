<?php
/**
 * The sidebar for BBPress
 *
 */

global $wp_registered_sidebars;
global $howes;

$no_widget_title      = __('No Widget Found', 'howes');
$no_widget_desc_text  = __( 'We don\'t find any widget to show. Please add some widgets by going to <strong>Admin > Appearance > Widgets</strong> and add widgets in <strong>"%s"</strong> area.', 'howes' );

$bbpressSidebar = isset($howes['sidebar_bbpress']) ? $howes['sidebar_bbpress'] : 'right' ;

?>

<?php $no_widget_desc  = sprintf( $no_widget_desc_text, $wp_registered_sidebars['sidebar-bbpress']['name'] ); ?>

<aside id="sidebar-<?php echo $bbpressSidebar; ?>" class="widget-area col-md-3 col-lg-3 col-sm-4 col-xs-12 sidebar" role="complementary">
	<?php if ( ! dynamic_sidebar( 'sidebar-bbpress' ) ) : ?>

		<div class="thememount-centertext">
			<h3><?php echo $no_widget_title; ?></h3>
			<br />
			<p><?php echo $no_widget_desc; ?></p>
			
		</div>

	<?php endif; // end sidebar widget area ?>
	
</aside><!-- #sidebar-right -->
