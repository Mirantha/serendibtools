<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package plumbing_handyman
 */

$plumbing_handyman_menu_text_color = get_theme_mod('plumbing_handyman_menu_text_color', ''); 
$plumbing_handyman_sub_menu_text_color = get_theme_mod('plumbing_handyman_sub_menu_text_color', ''); 
$plumbing_handyman_header_button_url = get_theme_mod( 'plumbing_handyman_topheader_button_url' );
$plumbing_handyman_header_button_text = get_theme_mod( 'plumbing_handyman_topheader_button_text' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(get_theme_mod('plumbing_handyman_website_layout', false) ? 'site-boxed--layout' : ''); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site asterthemes-site-wrapper">
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'plumbing-handyman' ); ?></a>
    <?php if (get_theme_mod('plumbing_handyman_enable_preloader', false)) : ?>
        <div id="loader" class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_preloader_style', 'style1')); ?>">
            <div class="loader-container">
                <div id="preloader">
                    <?php 
                    $plumbing_handyman_preloader_style = get_theme_mod('plumbing_handyman_preloader_style', 'style1');
                    if ($plumbing_handyman_preloader_style === 'style1') : ?>
                        <!-- STYLE 1 -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/resource/loader.gif'); ?>" alt="<?php esc_attr_e('Loading...', 'plumbing-handyman'); ?>">
                    <?php elseif ($plumbing_handyman_preloader_style === 'style2') : ?>
                        <!-- STYLE 2 -->
                        <div class="dot"></div>
                    <?php elseif ($plumbing_handyman_preloader_style === 'style3') : ?>
                        <!-- STYLE 3 -->
                        <div class="bars">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <header id="masthead" class="site-header">
            <div class="header-main-wrapper">
                <?php if ( get_theme_mod( 'plumbing_handyman_enable_topbar', true ) === true ) {
                    $plumbing_handyman_phone_number = get_theme_mod('plumbing_handyman_phone_number');
                    $plumbing_handyman_email_topbar_address = get_theme_mod( 'plumbing_handyman_email_topbar_address');
                    $plumbing_handyman_location = get_theme_mod( 'plumbing_handyman_header_location' );
                ?>
                <?php if ( get_theme_mod( 'plumbing_handyman_enable_topbar', false ) ) {
                ?>
                <div class="top-header-part">
                    <div class="asterthemes-wrapper">
                        <div class="top-header-part-wrapper">
                            <div class="topbar-text">
                                <div class="topbar-phone">
                                    <?php if ( ! empty( $plumbing_handyman_phone_number ) ) { ?>
                                        <div class="top-header-right-part">
                                            <a href="tel:<?php echo esc_attr(  substr( $plumbing_handyman_phone_number, 0, 21 )  ); ?>"><i class="<?php echo esc_attr( get_theme_mod( 'plumbing_handyman_header_phone_icon', 'fas fa-phone-volume' ) ); ?>"></i><span><?php echo esc_html(  substr( $plumbing_handyman_phone_number, 0, 21 )  ); ?></span></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if ( ! empty( $plumbing_handyman_email_topbar_address ) ) : ?>
                                    <a href="<?php echo esc_url( 'mailto:' . $plumbing_handyman_email_topbar_address ); ?>">
                                        <i class="<?php echo esc_attr( get_theme_mod( 'plumbing_handyman_email_icon', 'fas fa-envelope' ) ); ?>"></i>
                                        <?php echo esc_html( $plumbing_handyman_email_topbar_address ); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ( ! empty( $plumbing_handyman_location ) ) { ?>
                                    <a href="https://www.google.com/maps/search/<?php echo urlencode( $plumbing_handyman_location ); ?>" target="_blank" rel="noopener">
                                        <i class="<?php echo esc_attr( get_theme_mod( 'plumbing_handyman_location_header_icon', 'fas fa-map-marker-alt' ) ); ?>"></i>
                                        <?php echo esc_html( $plumbing_handyman_location ); ?>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="header-social-icons">
                                <?php if ( get_theme_mod( 'plumbing_handyman_enable_header_icon_section', false ) === true ) { ?>
                                    <div class="bottom-top-header-left-part">
                                        <div class="social-icons">
                                            <?php if ( get_theme_mod('plumbing_handyman_header_facebook_link')) { ?>
                                                <a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_header_facebook_link')); ?>">
                                                    <i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_header_facebook_icon', 'fab fa-facebook-f')); ?>"></i>
                                                    <span class="screen-reader-text"><?php esc_html_e('Facebook', 'plumbing-handyman'); ?></span>
                                                </a>
                                            <?php } ?>
                                            <?php if ( get_theme_mod('plumbing_handyman_header_twitter_link')) { ?>
                                                <a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_header_twitter_link')); ?>">
                                                    <i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_header_twitter_icon', 'fab fa-x-twitter')); ?>"></i>
                                                    <span class="screen-reader-text"><?php esc_html_e('Twitter', 'plumbing-handyman'); ?></span>
                                                </a>
                                            <?php } ?>
                                            <?php if ( get_theme_mod('plumbing_handyman_header_instagram_link')) { ?>
                                                <a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_header_instagram_link')); ?>">
                                                    <i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_header_instagram_icon', 'fab fa-instagram')); ?>"></i>
                                                    <span class="screen-reader-text"><?php esc_html_e('Instagram', 'plumbing-handyman'); ?></span>
                                                </a>
                                            <?php } ?>
                                            <?php if ( get_theme_mod('plumbing_handyman_header_pinterest_link')) { ?>
                                                <a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_header_pinterest_link')); ?>">
                                                    <i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_header_pinterest_icon', 'fab fa-pinterest-p')); ?>"></i>
                                                    <span class="screen-reader-text"><?php esc_html_e('Pinterest', 'plumbing-handyman'); ?></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
                <div class="bottom-header-outer-wrapper">
                    <div class="bottom-header-part <?php echo esc_attr( get_theme_mod( 'plumbing_handyman_enable_sticky_header', false ) ? 'sticky-header' : '' ); ?>">
                        <div class="asterthemes-wrapper">
                            <div class="bottom-header-part-wrapper hello">
                                <div class="bottom-header-left-part">
                                    <div class="site-branding">
                                        <?php
                                        // Check if the 'Enable Site Logo' setting is true.
                                        if ( get_theme_mod( 'plumbing_handyman_enable_site_logo', true ) ) {
                                            if ( has_custom_logo() ) { ?>
                                                <div class="site-logo">
                                                    <?php the_custom_logo(); ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="site-logo">
                                                    <!-- Fallback logo if no custom logo is set -->
                                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/resource/img/Logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
                                                    </a>
                                                </div>
                                            <?php }
                                        } ?>
                                        <div class="site-identity">
                                            <?php
                                            $plumbing_handyman_site_title_size = get_theme_mod('plumbing_handyman_site_title_size', 25);

                                            if (get_theme_mod('plumbing_handyman_enable_site_title_setting', false)) {
                                                if (is_front_page() && is_home()) : ?>
                                                    <h1 class="site-title" style="font-size: <?php echo esc_attr($plumbing_handyman_site_title_size); ?>px;">
                                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                                    </h1>
                                                <?php else : ?>
                                                    <p class="site-title" style="font-size: <?php echo esc_attr($plumbing_handyman_site_title_size); ?>px;">
                                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                                    </p>
                                                <?php endif;
                                            }

                                            if (get_theme_mod('plumbing_handyman_enable_tagline_setting', false)) :
                                                $plumbing_handyman_description = get_bloginfo('description', 'display');
                                                if ($plumbing_handyman_description || is_customize_preview()) : ?>
                                                    <p class="site-description"><?php echo esc_html($plumbing_handyman_description); ?></p>
                                                <?php endif;
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="navigation-menus">
                                    <div class="asterthemes-wrapper">
                                        <div class="navigation-part">
                                            <nav id="site-navigation" class="main-navigation">
                                                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                                <div class="main-navigation-links">
                                                    <?php
                                                        wp_nav_menu(
                                                            array(
                                                                'theme_location' => 'primary',
                                                            )
                                                        );
                                                    ?>
                                                </div>
                                                <style>
                                                    /* Main Menu Links */
                                                    .main-navigation ul li a, .menu a, .main-navigation a {
                                                        color: <?php echo esc_attr($plumbing_handyman_menu_text_color); ?>;
                                                    }

                                                    /* Submenu Links */
                                                    .main-navigation ul.children a, 
                                                    .home .main-navigation ul.children a, 
                                                    .main-navigation ul.menu li .sub-menu a, 
                                                    .home .main-navigation ul ul a {
                                                        color: <?php echo esc_attr($plumbing_handyman_sub_menu_text_color); ?>;
                                                    }
                                                </style>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-header-right-part nav-box">
                                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                                        <!-- Cart Total -->
                                        <span class="cart-subtotal">
                                            <?php echo WC()->cart->get_cart_total(); ?>
                                        </span>
                                        <span class="cart-count">
                                            <a class="cart-customlocation" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'View Shopping Cart', 'plumbing-handyman' ); ?>">
                                                <i class="fas fa-shopping-bag mr-2" aria-hidden="true"></i>
                                                <span class="cart-item-box"><?php echo esc_html(wp_kses_data(WC()->cart->get_cart_contents_count())); ?></span>
                                            </a>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $plumbing_handyman_header_button_text ) ) { ?>
                                        <div class="header-btn">
                                            <a href="<?php echo esc_url( $plumbing_handyman_header_button_url ); ?>" class="asterthemes-button"><?php echo esc_html( $plumbing_handyman_header_button_text ); ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
        </header>
<?php
if ( ! is_front_page() || is_home() ) {
	if ( is_front_page() ) {
		require get_template_directory() . '/sections/sections.php';
		plumbing_handyman_homepage_sections();

	}
	?>
    <?php
        if (!is_front_page() || is_home()) {
            get_template_part('page-header');
        }
    ?>
	<div id="content" class="site-content">
		<div class="asterthemes-wrapper">
			<div class="asterthemes-page">
			<?php } ?>