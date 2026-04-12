<?php
/**
 * Template part for displaying Gallery Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package plumbing_handyman
 */
?>
<?php $plumbing_handyman_readmore = get_theme_mod( 'plumbing_handyman_readmore_button_text','Read More');?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mag-post-single">
        <?php
		    // Check if there is a gallery embedded in the post content
		    $plumbing_handyman_post_id = get_the_ID(); // Add this line to get the post ID
		    $plumbing_handyman__gallery_shortcode = get_post_gallery();

		    if (!empty($plumbing_handyman__gallery_shortcode)) {
		        // Display the gallery
		        echo '<div class="embedded-gallery">' . do_shortcode($plumbing_handyman__gallery_shortcode) . '</div>';
		    }
		?>
		<div class="mag-post-detail">
			<div class="mag-post-category">
				<?php plumbing_handyman_categories_list(); ?>
			</div>
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title mag-post-title">', '</h1>' );
			else :
				if ( get_theme_mod( 'plumbing_handyman_post_hide_post_heading', true ) ) { 
					the_title( '<h2 class="entry-title mag-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			    }
			endif;
			?>
			<div class="mag-post-meta">
				<?php
				plumbing_handyman_posted_on();
				plumbing_handyman_posted_by();
				plumbing_handyman_posted_comments();
				plumbing_handyman_posted_time();
				?>
			</div>
			<?php if ( get_theme_mod( 'plumbing_handyman_post_hide_post_content', true ) ) { ?>
				<div class="mag-post-excerpt">
					<?php the_excerpt(); ?>
				</div>
		    <?php } ?>
			<?php if ( get_theme_mod( 'plumbing_handyman_post_readmore_button', true ) === true ) : ?>
				<div class="mag-post-read-more">
					<a href="<?php the_permalink(); ?>" class="read-more-button">
						<?php if ( ! empty( $plumbing_handyman_readmore ) ) { ?> <?php echo esc_html( $plumbing_handyman_readmore ); ?> <?php } ?>
						<i class="<?php echo esc_attr( get_theme_mod( 'plumbing_handyman_readmore_btn_icon', 'fas fa-chevron-right' ) ); ?>"></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->