<?php
/**
 * The template for displaying image attachments
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

get_header();


// Checking if Blog page
$primaryclass = 'col-md-12 col-lg-12 col-sm-12 col-xs-12';
global $howes;
$sidebar = $howes['sidebar_blog']; // Global settings

// Page settings
if( isset($sidebarposition) && trim($sidebarposition) != '' ){
	$sidebar = $sidebarposition;
}

// Primary Content class
$primaryclass = setPrimaryClass($sidebar);


?>

<div class="container">
<div class="row">

	<div id="primary" class="content-area <?php echo $primaryclass; ?>">
		<div id="content" class="site-content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
			
				<header class="entry-header">
				
				
					<?php if ( !is_single() ) : ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php endif; // !is_single() ?>
					

					<div class="entry-meta">
						<?php
							$published_text = __( '<span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>', 'howes' );
							$post_title = get_the_title( $post->post_parent );
							if ( empty( $post_title ) || 0 == $post->post_parent )
								$published_text = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';

							printf( $published_text,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( $post_title ) ),
								$post_title
							);

							$metadata = wp_get_attachment_metadata();
							printf( '<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
								esc_url( wp_get_attachment_url() ),
								esc_attr__( 'Link to full-size image', 'howes' ),
								__( 'Full resolution', 'howes' ),
								$metadata['width'],
								$metadata['height']
							);

							
						?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<nav id="image-navigation" class="navigation image-navigation" role="navigation">
						<span class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'howes' ) ); ?></span>
						<span class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'howes' ) ); ?></span>
					</nav><!-- #image-navigation -->

					<div class="entry-attachment">
						<div class="attachment">
							<?php howes_the_attached_image(); ?>

							<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
							<?php endif; ?>
						</div><!-- .attachment -->
					</div><!-- .entry-attachment -->

					<?php if ( ! empty( $post->post_content ) ) : ?>
					<div class="entry-description">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'howes' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-description -->
					<?php endif; ?>

				</div><!-- .entry-content -->
				
				<?php edit_post_link( __( 'Edit', 'howes' ), '<span class="edit-link">', '</span>' ); ?>
				
			</article><!-- #post -->

			<?php comments_template(); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	



	<?php
	// Sidebar 1 (Left Sidebar)
	if($sidebar=='left' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('left');
	}

	// Sidebar 2 (Right Sidebar)
	if($sidebar=='right' || $sidebar=='both' || $sidebar=='bothleft' || $sidebar=='bothright' ){
		get_sidebar('right');
	}
	?>

	
	
</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>