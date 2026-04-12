<?php
/**
 * The main template file
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package plumbing_handyman
 */

get_header();

$plumbing_handyman_column = get_theme_mod( 'plumbing_handyman_archive_column_layout', 'column-1' );
?>
<main id="primary" class="site-main">

	<?php

	if ( have_posts() ) :
		?>

		<div class="plumbing-handyman-archive-layout grid-layout <?php echo esc_attr( $plumbing_handyman_column ); ?>">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
			?>
		</div>
		<?php
		do_action( 'plumbing_handyman_posts_pagination' );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main><!-- #main -->

<?php
if ( plumbing_handyman_is_sidebar_enabled() ) {
	get_sidebar();
}

get_footer();