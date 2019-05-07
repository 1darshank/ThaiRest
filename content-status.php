<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

global $howes;
$blog_readmore_text = 'Read More';
if( isset($howes['blog_readmore_text']) && trim($howes['blog_readmore_text'])!='' ){
	$blog_readmore_text = trim($howes['blog_readmore_text']);
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="thememount-post-left">
    <?php thememount_entry_date(); ?>
  </div>
  <!-- .thememount-post-left -->
  
  <div class="thememount-post-right">
    <div class="postcontent">
      <div class="entry-content">
        <?php the_content( __( $blog_readmore_text, 'howes' ).'  <i class="tmicon-fa-angle-right"></i>' ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'howes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
      </div><!-- .entry-content -->
    </div><!-- .postcontent -->
	  
      <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
        <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
        <?php get_template_part( 'author-bio' ); ?>
        <?php endif; ?>
      </footer><!-- .entry-meta -->
  </div>
  <!-- .thememount-post-right -->
  
  <div class="clearfix"></div>
</article>
<!-- #post --> 
