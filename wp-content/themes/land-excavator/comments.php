<?php
/**
 * The template for displaying comments
 *
 * @package Land Excavator
 */

// Check if the comment section is enabled in the theme customizer.
$enable_comment_section = absint( get_theme_mod( 'land_excavator_enable_comment_section', 1 ) );

if ( $enable_comment_section == 1 && ! post_password_required() ) : ?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$land_excavator_comment_count = get_comments_number();
			if ( '1' === $land_excavator_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'land-excavator' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $land_excavator_comment_count, 'comments title', 'land-excavator' ) ),
					number_format_i18n( $land_excavator_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'land-excavator' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div>
<?php endif; ?>