<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $howes;
$sidebar_woocommerce = $howes['sidebar_woocommerce'];
$main_container_class = 'col-md-12 col-lg-12 col-xs-12';
if( $sidebar_woocommerce!='no' ){
	$main_container_class = 'col-md-9 col-lg-9 col-xs-12';
}


get_header( 'shop' ); ?>
<div class="container">
  <div class="row">
    <div id="primary" class="content-area <?php echo $main_container_class ;?>">
    
    <?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
    
    </div><!-- .col-md-9 col-lg-9 col-sm-8 col-xs-12 -->
    
    <?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>
    
  </div><!-- .row -->
</div><!-- .container -->

<?php get_footer( 'shop' ); ?>
