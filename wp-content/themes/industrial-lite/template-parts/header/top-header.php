<?php
/**
 * The template part for header
 *
 * @package Industrial Lite 
 * @subpackage industrial-lite
 * @since industrial-lite 1.0
 */
?>

<div class="container">
	<div class="main-header-box">
		<div class="row">
			<div class="col-lg-3 col-md-3 logo-bdr align-self-center">
		        <div class="logo">
		          	<?php if ( has_custom_logo() ) : ?>
		              <div class="site-logo"><?php the_custom_logo(); ?></div>
		            <?php endif; ?>
		            <?php $blog_info = get_bloginfo( 'name' ); ?>
		              <?php if ( ! empty( $blog_info ) ) : ?>
		                <?php if ( is_front_page() && is_home() ) : ?>
		                  <?php if( get_theme_mod('industrial_lite_logo_title_hide_show',true) == 1){ ?>
		                  	<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		                  <?php } ?>
		                <?php else : ?>
		                  <?php if( get_theme_mod('industrial_lite_logo_title_hide_show',true) == 1){ ?>
		                  	<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		                  <?php } ?>
		                <?php endif; ?>
		              <?php endif; ?>
		              <?php
		                $description = get_bloginfo( 'description', 'display' );
		                if ( $description || is_customize_preview() ) :
		              ?>
		              	<?php if( get_theme_mod('industrial_lite_tagline_hide_show',false) == 1){ ?>
			              <p class="site-description">
			                <?php echo esc_html($description); ?>
			              </p>
			            <?php } ?>
		            <?php endif; ?>
		        </div>
	      	</div>
	      	<div class="col-lg-9 col-md-9 align-self-center">
	      		<?php if( get_theme_mod( 'industrial_lite_topbar_hide_show', true) == 1 || get_theme_mod( 'industrial_lite_resp_topbar_hide_show', true) == 1) { ?>
		      		<div class="top-bar row me-0">
		      			<div class="col-lg-9 col-md-9">
		      				<?php if( get_theme_mod( 'industrial_lite_location') != '') { ?>
			      				<span><i class="<?php echo esc_attr(get_theme_mod('industrial_lite_location_icon','fas fa-map-marker-alt')); ?>"></i><?php echo esc_html(get_theme_mod('industrial_lite_location',''));?></span>
			      			<?php }?>
			      			<?php if( get_theme_mod( 'industrial_lite_phone_number') != '') { ?>
			      				<span><i class="<?php echo esc_attr(get_theme_mod('industrial_lite_phone_icon','fas fa-phone')); ?>"></i><a href="tel:<?php echo esc_attr( get_theme_mod('industrial_lite_phone_number','') ); ?>"><?php echo esc_html(get_theme_mod('industrial_lite_phone_number',''));?></a></span>
			      			<?php }?>
			      			<?php if( get_theme_mod( 'industrial_lite_email_address') != '') { ?>
			      				<span><i class="<?php echo esc_attr(get_theme_mod('industrial_lite_email_address_icon','fas fa-envelope')); ?>"></i><a href="mailto:<?php echo esc_attr(get_theme_mod('industrial_lite_email_address',''));?>"><?php echo esc_html(get_theme_mod('industrial_lite_email_address',''));?></a></span>
			      			<?php }?>
			      		</div>
			      		<div class="col-lg-3 col-md-3">
			      			<?php if( get_theme_mod( 'industrial_lite_top_btn_url') != '' || get_theme_mod( 'industrial_lite_top_btn_text') != '') { ?>
				      			<div class="top-bar-btn">
				      				<a href="<?php echo esc_url(get_theme_mod('industrial_lite_top_btn_url','')) ?>"><?php echo esc_html(get_theme_mod('industrial_lite_top_btn_text','')) ?><span class="screen-reader-text"><?php esc_html_e( 'GET A QUOTE','industrial-lite' );?></span></a>
				      			</div>
				      		<?php }?>
			      		</div>
		      		</div>
		      	<?php } ?>
		      	<div class="header-menu <?php if( get_theme_mod( 'industrial_lite_sticky_header', false) == 1 || get_theme_mod( 'industrial_lite_stickyheader_hide_show', false) == 1) { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
		      		<div class="row">
		      			<div class="align-self-center <?php if(get_theme_mod('industrial_lite_header_search',true)) { ?>col-lg-8 col-md-7 col-3 pe-lg-0" <?php } else { ?>col-lg-9 col-md-9" <?php } ?> >
				        	<?php get_template_part( 'template-parts/header/navigation' ); ?>
				      	</div>
				      	<?php if( get_theme_mod( 'industrial_lite_header_search',true) == 1) { ?>
				        <div class="col-lg-1 col-md-2 col-3 align-self-center">
				          	<div class="search-box">
				                <span><a href="#"><i class="<?php echo esc_attr(get_theme_mod('industrial_lite_search_icon','fas fa-search')); ?>"></i></a></span>
				            </div>
				        </div>
				      	<?php }?>
				      	<div class="col-lg-3 col-md-3 col-6 ps-lg-0 align-self-center">
				      		<?php if (is_active_sidebar('social-links')) : ?>
				      			<?php dynamic_sidebar('social-links'); ?>
				      		<?php else : ?>
					          <!-- Default Social Icons Widgets -->
					          <div class="widget">
					              <ul class="custom-social-icons" >
					                  <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li>
					                  <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
					                  <li><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a></li>   
					                  <li><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a></li>
					              </ul>
					          </div>
					        <?php endif; ?>		
				      	</div>
		      		</div>
		      	</div>
	      	</div>
		</div>
		<div class="serach_outer">
	        <div class="closepop"><a href="#maincontent"><i class="<?php echo esc_attr(get_theme_mod('industrial_lite_search_close_icon','fa fa-window-close')); ?>"></i></a></div>
	        <div class="serach_inner">
	          <?php get_search_form(); ?>
	        </div>
	    </div>
	</div>
</div>