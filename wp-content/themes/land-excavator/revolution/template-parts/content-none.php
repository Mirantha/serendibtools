<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Land Excavator
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<?php land_excavator_breadcrumbs(); ?>
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'land-excavator' ); ?></h1>
	</header>

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'land-excavator' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'land-excavator' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'land-excavator' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div>
</section>