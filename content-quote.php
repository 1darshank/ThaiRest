<?php
/**
 * The template for displaying posts in the Quote post format
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
		
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="thememount-blog-media entry-thumbnail">
			<?php the_post_thumbnail(); ?>
	    </div>
	  <!-- .entry-header -->
		<?php endif; ?>

		<div class="postcontent">
          <div class="entry-header">
            <div class="entry-content">
              <blockquote>
                <?php the_content( '' ); ?>
                <?php
					$thememount_quote_source_name = trim( get_post_meta( get_the_ID(), '_format_quote_source_name', true ) );
					$thememount_quote_source_url  = trim( get_post_meta( get_the_ID(), '_format_quote_source_url', true ) );
					
					if( $thememount_quote_source_url!='' && $thememount_quote_source_name!='' ){
						?>
                <div class="thememount_quote_source"><h3><a href="<?php echo esc_sql($thememount_quote_source_url); ?>"><?php echo esc_attr($thememount_quote_source_name); ?></a></h3></div>
                <?php
					} else if( $thememount_quote_source_name!='' ){
						?>
                <div class="thememount_quote_source"><h3><?php echo esc_attr($thememount_quote_source_name); ?></h3></div>
                <?php
					} else if( $thememount_quote_source_url!='' ){
						?>
                <div class="thememount_quote_source"><h3><a href="<?php echo esc_sql($thememount_quote_source_url); ?>"><?php echo esc_html($thememount_quote_source_url); ?></a></h3></div>
                <?php
					}
				?>
                <span></span>
                </blockquote>
              
              <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'howes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
              </div>
          </div>
      </div>
		<!-- .entry-content -->

		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		
	</div><!-- .thememount-post-right -->
	
	<div class="clearfix"></div>
	
</article><!-- #post -->
