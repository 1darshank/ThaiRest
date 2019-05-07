<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="thememount-post-left">
		<?php thememount_entry_date(); ?>
	</div><!-- .thememount-post-left -->
	
	<div class="thememount-post-right">

		<?php echo thememount_featured_gallery_slider( 'post' ); ?>

		<div class="postcontent">
		  <header class="entry-header">
		    
		    <?php if ( is_single() ) : ?>
		    <!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
		    <?php else : ?>
		    <h2 class="entry-title">
		      <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		    </h2>
		    <?php endif; // is_single() ?>
		    
			<?php if ( !is_single() ) : ?>
			<div class="entry-meta">
				<?php thememount_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
			
		    </header><!-- .entry-header -->
		  
		  <div class="entry-content">
		    <?php if ( is_single() || ! get_post_gallery() ) : ?>
		    <?php the_content( '' ); ?>
		    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'howes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		    <?php else : ?>
		    <?php the_content( '' ); ?>
		    <?php endif; // is_single() ?>
		    </div><!-- .entry-content -->
		  
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
