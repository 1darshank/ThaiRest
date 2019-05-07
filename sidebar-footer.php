<?php
/**
 * The sidebar containing the footer widget area
 *
 * If no active widgets in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

 
 global $howes;


//$footer_col = ( isset($howes['footer_column_layout']) && trim($howes['footer_column_layout'])!='' ) ? trim($howes['footer_column_layout']) : '3_3_3_3' ;

$footer_col = '3_3_3_3';
if( isset($howes['footer_column_layout']) && trim($howes['footer_column_layout'])!='' ){
	$footer_col = trim($howes['footer_column_layout']);
}

if($footer_col == '3_3_3_3'){
	?>
	
	<div id="secondary" class="sidebar-container" role="complementary">
		
		<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
		<div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div><!-- .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
		<div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		</div><!-- .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
		<div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		</div><!-- .widget-area -->
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
		<div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
		</div><!-- .widget-area -->
		<?php endif; ?>
		
		
	</div><!-- #secondary -->
	
	
	<?php
} else {

	$footer_col = explode('_', $footer_col);
	if( is_array($footer_col) && count($footer_col)>0 ){
		?>
		<div id="secondary" class="sidebar-container" role="complementary">
		<?php
		$x = 1;
		foreach($footer_col as $col){
			// Widget position
			$sidebar = 'fourth';
			switch($x){
				case 1 :
					$sidebar = 'first';
					break;
				case 2 :
					$sidebar = 'second';
					break;
				case 3 :
					$sidebar = 'third';
					break;
				case 4 :
					$sidebar = 'fourth';
					break;
				
			}
			
			// ROW width class
			$row_class = 'col-xs-12 col-sm-'.$col.' col-md-'.$col.' col-lg-'.$col;
			
			
			if ( is_active_sidebar( $sidebar.'-footer-widget-area' ) ) : ?>
			
			<div class="widget-area <?php echo $row_class; ?>">
				<?php dynamic_sidebar( $sidebar.'-footer-widget-area' ); ?>
			</div><!-- .widget-area -->
			
			<?php endif;
			
			$x++;
		} // Foreach
		?>
		
		</div><!-- #secondary -->
		
		<?php
		
	} // If

} // if


