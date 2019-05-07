<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
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
	</div><!-- .thememount-post-left -->
	
  <div class="thememount-post-right">
	
	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
	<div class="thememount-blog-media entry-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php endif; ?>
	  
      <div class="postcontent">
  <header class="entry-header">
    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
    <?php endif; ?>
    
    <?php /*if ( !is_single() ) :*/ ?>
    <h2 class="entry-title">
		<?php
		$the_title = trim(get_the_title());
		if( $the_title=='' ){ $the_title = __('[No Title]', 'howes'); } ?>
		<?php if ( is_single() ) : ?>
			<?php //echo $the_title;  // Hide title ?>
		<?php else : // !is_single() ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo esc_attr($the_title); ?></a>
		<?php endif; // !is_single() ?>
	</h2>
	
	<?php if ( !is_single() ) : ?>
    <div class="entry-meta">
		<?php thememount_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>
	
    <?php /*endif;*/ // !is_single() ?>
    
  </header><!-- .entry-header -->
           
           
          <?php if ( is_search() ) : // Only display Excerpts for Search ?>
          <div class="entry-summary">
             <?php the_excerpt(); ?>
          </div><!-- .entry-summary -->
          <?php else : ?>
          <div class="entry-content">
             <?php the_content( __( $blog_readmore_text, 'howes' ).'  <i class="tmicon-fa-angle-right"></i>' ); ?>
             <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'howes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
          </div><!-- .entry-content -->
           
           
          <?php endif; ?>		
          <?php if ( is_single() ) : ?>
          <footer class="entry-meta">
             <div class="footer-entry-meta">
               <?php thememount_entry_meta(); ?>
               <?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
              </div><!-- .entry-meta -->
             <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
             <?php get_template_part( 'author-bio' ); ?>
             <?php endif; ?>
          </footer><!-- .entry-meta -->
          <?php endif; ?>
    </div>
	

		
	</div><!-- .thememount-post-right -->
	
	<div class="clearfix"></div>
	
</article><!-- #post -->
