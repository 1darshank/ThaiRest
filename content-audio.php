<?php
/**
 * The template for displaying posts in the Audio post format
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
    
    <?php
	echo '<div class="thememount-blog-media thememount-post-audio-embed-code">';
	$embedData  = trim( get_post_meta( get_the_ID(), '_format_audio_embed', true ) );
	// Check if URL
	if(substr($embedData, 0, 4) == "http" && substr($embedData, -4) != ".mp3" ) {
		$htmlcode = wp_oembed_get( $embedData );
		echo $htmlcode; // This is URL
	} else if(substr($embedData, 0, 4) == "http" && substr($embedData, -4) == ".mp3" ) {
		$htmlcode = do_shortcode( '[audio src="'.$embedData.'"]' );
		echo $htmlcode; // This is URL
		
	} else {
		echo do_shortcode($embedData);
	}
	echo '</div>';
	?>
    
    
     <div class="postcontent">
      <header class="entry-header">
        
        
        <?php if ( is_single() ) : ?>
        
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
            <div class="audio-content">
              <?php the_content( '' ); ?>
              <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'howes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
              </div><!-- .audio-content -->
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
          <?php endif; // is_single() ?>
        </div>
		
	</div><!-- .thememount-post-right -->
	
	<div class="clearfix"></div>
	
</article><!-- #post -->
