<?php
if ( ! get_theme_mod( 'plumbing_handyman_enable_slider_section', false ) ) {
	return;
}

$plumbing_handyman_slider_category = get_theme_mod( 'plumbing_handyman_slider_slider_category', 'slider' );
$plumbing_handyman_trending_slider_heading = get_theme_mod( 'plumbing_handyman_slider_heading');
$plumbing_handyman_args = array(
	'post_type'           => 'post',
	'category_name'       => sanitize_text_field( $plumbing_handyman_slider_category ),
	'posts_per_page'      => 6,
	'ignore_sticky_posts' => true,
);

$plumbing_handyman_query = new WP_Query( $plumbing_handyman_args );

if ( $plumbing_handyman_query->have_posts() ) :
	$plumbing_handyman_button_label = get_theme_mod( 'plumbing_handyman_slider_button_label' );
	$plumbing_handyman_button_link  = get_theme_mod( 'plumbing_handyman_slider_button_link' );
	$plumbing_handyman_button_link  = ! empty( $plumbing_handyman_button_link ) ? esc_url( $plumbing_handyman_button_link ) : '';
	$plumbing_handyman_banner_section_image = get_theme_mod( 'plumbing_handyman_slider_image');
	$plumbing_handyman_default_image_url = get_template_directory_uri() . '/resource/img/default.png';
	$plumbing_handyman_default_image_url_1 = get_template_directory_uri() . '/resource/img/default1.png';
	?>
	<section id="plumbing_handyman_slider_section" class="slider-section slider-style-1">
		<?php if ( is_customize_preview() ) : plumbing_handyman_section_link( 'plumbing_handyman_slider_section' ); endif; ?>
		<?php if ( get_theme_mod( 'plumbing_handyman_one_word_heading' ) ) : ?>
			<h1 class="slide-main-head">
				<span class="single-word">
					<?php echo esc_html( get_theme_mod( 'plumbing_handyman_one_word_heading' ) ); ?>
				</span>
			</h1>
        <?php endif; ?>
		<div class="slider-section-wrapper">		
			<div class="owl-carousel">
				<?php
				while ( $plumbing_handyman_query->have_posts() ) :
					$plumbing_handyman_query->the_post();
					?>
					<div class="slider-single-outer">
						<div class="slider-single">
							<div class="slider-caption">
								<div class="asterthemes-wrapper">
									<div class="slider-catption-wrapper wow zoomIn" data-wow-duration="1.5s">
										<?php if ( ! empty( $plumbing_handyman_trending_slider_heading ) ) { ?>
											<h3><?php echo esc_html( $plumbing_handyman_trending_slider_heading ); ?></h3>
										<?php } ?>
										<h2 class="slider-caption-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
										<div class="mag-post-excerpt"><?php the_excerpt(); ?></div>
										<?php if ( ! empty( $plumbing_handyman_button_label ) && ! empty( $plumbing_handyman_button_link ) ) : ?>
											<div class="banner-slider-btn">
												<a href="<?php echo esc_url( $plumbing_handyman_button_link ); ?>" class="asterthemes-button">
													<?php echo esc_html( $plumbing_handyman_button_label ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="slider-img">
								<div class="slider-post-img">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'full' );
									} else {
										echo '<img src="' . esc_url( get_template_directory_uri() . '/resource/img/default.png' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
									}
									?>
									<div class="slider-img-second wow zoomIn" data-wow-duration="1.5s">
										<img src="<?php echo esc_url( ! empty( $plumbing_handyman_banner_section_image ) ? $plumbing_handyman_banner_section_image : $plumbing_handyman_default_image_url_1 ); ?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>