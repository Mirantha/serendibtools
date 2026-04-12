<?php
if ( ! get_theme_mod( 'plumbing_handyman_enable_about_section', false ) ) {
	return;
}

/**
 * Render About Section.
 */ 

 $plumbing_handyman_about_section_heading = get_theme_mod( 'plumbing_handyman_about_section_heading');
 $plumbing_handyman_about_section_content = get_theme_mod( 'plumbing_handyman_about_section_content');
 $plumbing_handyman_about_short_content = get_theme_mod( 'plumbing_handyman_about_short_content');
 $plumbing_handyman_about_list_text_1 = get_theme_mod( 'plumbing_handyman_about_list_text_1');
 $plumbing_handyman_about_list_text_2 = get_theme_mod( 'plumbing_handyman_about_list_text_2');
 $plumbing_handyman_about_list_text_3 = get_theme_mod( 'plumbing_handyman_about_list_text_3');
 $plumbing_handyman_about_list_content_1 = get_theme_mod( 'plumbing_handyman_about_list_content_1');
 $plumbing_handyman_about_list_content_2 = get_theme_mod( 'plumbing_handyman_about_list_content_2');
 $plumbing_handyman_about_list_content_3 = get_theme_mod( 'plumbing_handyman_about_list_content_3');
 $plumbing_handyman_button_label = get_theme_mod( 'plumbing_handyman_about_button_label_');
 $plumbing_handyman_button_link  = get_theme_mod( 'plumbing_handyman_about_button_link_');
 $plumbing_handyman_about_section_image = get_theme_mod( 'plumbing_handyman_about_section_image');
 $plumbing_handyman_about_section_image_2 = get_theme_mod( 'plumbing_handyman_team_image_1');
 ?>
 
 <section id="plumbing_handyman_about_section primary" class="about-section">
	 <?php
	 if ( is_customize_preview() ) :
		 plumbing_handyman_section_link( 'plumbing_handyman_about_section' );
	 endif;
	 ?>
	 <div class="about-section-wrapper">
		 <div class="asterthemes-wrapper">
			 <div class="about-single-outer">
				 <div class="about-single">
					<div class="about-img wow fadeInDown delay-1000">
						<?php $plumbing_handyman_default_image_url = get_template_directory_uri() . '/resource/img/about.png';
						if ( ! empty( $plumbing_handyman_about_section_image ) ) { ?>
							<img src="<?php echo esc_url( $plumbing_handyman_about_section_image ); ?>"/>
						<?php } else { ?>
							<img src="<?php echo esc_url( $plumbing_handyman_default_image_url ); ?>"/>
						<?php } ?>
						<div class="about-info">
							<i class="fa-solid fa-quote-left"></i>
							<p class="review-content"><?php echo esc_html(get_theme_mod('plumbing_handyman_image_content')); ?></p>
							<div class="about-customer-info">
								<div class="team-img">
									<?php $plumbing_handyman_default_image_url_2 = get_template_directory_uri() . '/resource/img/default.png';
									if ( ! empty( $plumbing_handyman_about_section_image_2 ) ) { ?>
										<img src="<?php echo esc_url( $plumbing_handyman_about_section_image_2 ); ?>"/>
									<?php } else { ?>
										<img src="<?php echo esc_url( $plumbing_handyman_default_image_url_2 ); ?>"/>
									<?php } ?>
								</div>
								<div class="review-content">
									<p class="review-text"><?php echo esc_html(get_theme_mod('plumbing_handyman_image_text')); ?></p>
									<p class="review-subtext"><?php echo esc_html(get_theme_mod('plumbing_handyman_image_sub_text')); ?></p>
								</div>
							</div>
						</div>
					</div>
					 <div class="about-caption wow fadeInUp delay-1000">
						 <div class="about-catption-wrapper">
						 	<p class="about-short-content">
								 <?php echo esc_html( $plumbing_handyman_about_short_content ); ?>
							 </p>
							 <h1 class="about-caption-title">
								 <?php echo esc_html( $plumbing_handyman_about_section_heading ); ?>
							 </h1>
							 <p class="about-caption-content">
								 <?php echo esc_html( $plumbing_handyman_about_section_content ); ?>
							 </p>
							 <div>
								<?php if ( ! empty( $plumbing_handyman_about_list_text_1 ) || ! empty( $plumbing_handyman_about_list_content_1 ) ) : ?>
									<div class="about-list-content">
										<i class="fas fa-hand-holding-dollar"></i>

										<div class="list-content">
											<div class="list-text">
												<?php echo esc_html( $plumbing_handyman_about_list_text_1 ); ?>
											</div>

											<div class="list-desc">
												<?php echo esc_html( $plumbing_handyman_about_list_content_1 ); ?>
											</div>
										</div>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $plumbing_handyman_about_list_text_2 ) || ! empty( $plumbing_handyman_about_list_content_2 ) ) : ?>
									<div class="about-list-content">
										<i class="fa-solid fa-screwdriver-wrench"></i>

										<div class="list-content">
											<div class="list-text">
												<?php echo esc_html( $plumbing_handyman_about_list_text_2 ); ?>
											</div>

											<div class="list-desc">
												<?php echo esc_html( $plumbing_handyman_about_list_content_2 ); ?>
											</div>
										</div>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $plumbing_handyman_about_list_text_3 ) || ! empty( $plumbing_handyman_about_list_content_3 ) ) : ?>
									<div class="about-list-content">
										<i class="fa-solid fa-ranking-star"></i>

										<div class="list-content">
											<div class="list-text">
												<?php echo esc_html( $plumbing_handyman_about_list_text_3 ); ?>
											</div>

											<div class="list-desc">
												<?php echo esc_html( $plumbing_handyman_about_list_content_3 ); ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $plumbing_handyman_button_label ) ) { ?>
								<span class="about-btn">
									<a href="<?php echo esc_url( $plumbing_handyman_button_link ); ?>" class="asterthemes-button"><?php echo esc_html( $plumbing_handyman_button_label ); ?></a>
								</span>
							<?php } ?>
							 </div>
						 </div>
					 </div>
				 </div>
			 </div>		
		 </div>
	 </div>
 </section>