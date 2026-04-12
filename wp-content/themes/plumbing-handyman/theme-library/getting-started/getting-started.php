<?php
/**
 * Getting Started Page.
 *
 * @package plumbing_handyman
 */


if( ! function_exists( 'plumbing_handyman_getting_started_menu' ) ) :
/**
 * Adding Getting Started Page in admin menu
 */
function plumbing_handyman_getting_started_menu(){	
	add_theme_page(
		__( 'Getting Started', 'plumbing-handyman' ),
		__( 'Getting Started', 'plumbing-handyman' ),
		'manage_options',
		'plumbing-handyman-getting-started',
		'plumbing_handyman_getting_started_page'
	);
}
endif;
add_action( 'admin_menu', 'plumbing_handyman_getting_started_menu' );

if( ! function_exists( 'plumbing_handyman_getting_started_admin_scripts' ) ) :
/**
 * Load Getting Started styles in the admin
 */
function plumbing_handyman_getting_started_admin_scripts( $hook ){
	// Load styles only on our page
	if( 'appearance_page_plumbing-handyman-getting-started' != $hook ) return;

    wp_enqueue_style( 'plumbing-handyman-getting-started', get_template_directory_uri() . '/resource/css/getting-started.css', false, PLUMBING_HANDYMAN_THEME_VERSION );

    wp_enqueue_script( 'plumbing-handyman-getting-started', get_template_directory_uri() . '/resource/js/getting-started.js', array( 'jquery' ), PLUMBING_HANDYMAN_THEME_VERSION, true );
}
endif;
add_action( 'admin_enqueue_scripts', 'plumbing_handyman_getting_started_admin_scripts' );

if( ! function_exists( 'plumbing_handyman_getting_started_page' ) ) :
/**
 * Callback function for admin page.
*/
function plumbing_handyman_getting_started_page(){ 
	$plumbing_handyman_theme = wp_get_theme();?>
	<div class="wrap getting-started container">
		<div class="getting-info">
			<div class="theme-intro">
				<div class="intro-wrap">
					<div class="intro cointaner">
						<div class="intro-content">
							<h3><?php echo esc_html( 'Welcome to', 'plumbing-handyman' );?> <span class="theme-name"><?php echo esc_html( PLUMBING_HANDYMAN_THEME_NAME ); ?></span></h3>
							<p class="about-text">
								<?php
								// Remove last sentence of description.
								$plumbing_handyman_description = explode( '. ', $plumbing_handyman_theme->get( 'Description' ) );

								$plumbing_handyman_description = implode( '. ', $plumbing_handyman_description );

								echo esc_html( $plumbing_handyman_description . '' );
							?></p>
							<div class="btns-getstart">
								<a href="<?php echo esc_url( PLUMBING_HANDYMAN_PREMIUM_PAGE ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Get Premium', 'plumbing-handyman' ); ?></a>
								<a href="<?php echo esc_url( PLUMBING_HANDYMAN_PRO_DEMO ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Live Demo', 'plumbing-handyman' ); ?></a>
								<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Customize Theme', 'plumbing-handyman' ); ?></a>
							</div>
							<div class="btns-wizard">
                                <?php if ( ! get_option('is-demo-imported') ) : ?>
                                    <a class="wizard" href="<?php echo esc_url( admin_url( 'themes.php?page=plumbinghandyman-wizard' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Import Theme Demo', 'plumbing-handyman' ); ?></a>
                                <?php else : ?>
                                    <a target="_blank" href="<?php echo esc_url( home_url() ); ?>" class="button button-primary view-site">
                                        <?php esc_html_e( 'Visit Your Website', 'plumbing-handyman' ); ?>
                                    </a>
                                <?php endif; ?>
  							</div>
						</div>
						<div class="intro-img">
							<img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/bundle.png'; ?>" />										
							<br>
							<h4 class="bundle-text"><?php esc_html_e( 'WP Theme Bundle', 'plumbing-handyman' ); ?></h4>
							<p class="about-text"><?php esc_html_e('Get access to a collection of premium WordPress themes in one bundle. Enjoy effortless website building, full customization, and dedicated customer support for a smooth, professional web experience.', 'plumbing-handyman'); ?></p>
							<a class="button button-primary" href="<?php echo esc_url( PLUMBING_HANDYMAN_BUNDLE_PAGE ); ?>" title="<?php esc_attr_e( 'Go Pro', 'plumbing-handyman' ); ?>" target="_blank">
								<?php esc_html_e( 'Exclusive Theme Bundle - $79', 'plumbing-handyman' ); ?>
							</a>
						</div>
					</div>
				</div>
				<div class="cointaner panels">
					<ul class="inline-list">
						<li class="current">
							<a id="help" href="javascript:void(0);">
								<?php esc_html_e( 'Getting Started', 'plumbing-handyman' ); ?>
							</a>
						</li>
						<li>
							<a id="free-pro-panel" href="javascript:void(0);">
								<?php esc_html_e( 'Free Vs Pro', 'plumbing-handyman' ); ?>
							</a>
						</li>
					</ul>
					<div id="panel" class="panel">
						<?php require get_template_directory() . '/theme-library/getting-started/tabs/help-panel.php'; ?>
						<?php require get_template_directory() . '/theme-library/getting-started/tabs/free-vs-pro-panel.php'; ?>
						<?php require get_template_directory() . '/theme-library/getting-started/tabs/link-panel.php'; ?>
					</div>
				</div>
			</div>
			<div class="icons-info">
				<div class="icon-img">									
					<a href="<?php echo esc_url( PLUMBING_HANDYMAN_REVIEW ); ?>" title="<?php esc_attr_e( 'Review Theme', 'plumbing-handyman' ); ?>" target="_blank">
						<img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/icon1.png'; ?>" />	
						<?php esc_html_e( 'Review Theme', 'plumbing-handyman' ); ?>
					</a>
				</div>
				<div class="icon-img">									
					<a href="<?php echo esc_url( PLUMBING_HANDYMAN_SUPPORT ); ?>" title="<?php esc_attr_e( 'Contact Support', 'plumbing-handyman' ); ?>" target="_blank">
						<img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/icon2.png'; ?>" />	
						<?php esc_html_e( 'Contact Support', 'plumbing-handyman' ); ?>
					</a>
				</div>
				<div class="icon-img">									
					<a href="<?php echo esc_url( PLUMBING_HANDYMAN_THEME_DOCUMENTATION ); ?>" title="<?php esc_attr_e( 'Free Theme Documentation', 'plumbing-handyman' ); ?>" target="_blank">
						<img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/icon3.png'; ?>" />	
						<?php esc_html_e( 'Free Theme Documentation', 'plumbing-handyman' ); ?>
					</a>
				</div>
			</div>	
		</div>	
	</div>
	<?php
}
endif;