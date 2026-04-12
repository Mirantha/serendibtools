<?php

/**
* Get started notice
*/

//  Plugin Activation Start
if (!function_exists('fundraiser_nonprofit_is_plugin_installed')) {
    function fundraiser_nonprofit_is_plugin_installed($plugin_slug)
    {
        $plugin_path = WP_PLUGIN_DIR . '/' . $plugin_slug;
        return file_exists($plugin_path);
    }
}
if (!function_exists('fundraiser_nonprofit_is_plugin_activated')) {
    function fundraiser_nonprofit_is_plugin_activated($plugin_slug)
    {
        return is_plugin_active($plugin_slug);
    }
}

// Hook into a custom action when the button is clicked
add_action('wp_ajax_fundraiser_nonprofit_install_and_activate_plugins', 'fundraiser_nonprofit_install_and_activate_plugins');
add_action('wp_ajax_nopriv_fundraiser_nonprofit_install_and_activate_plugins', 'fundraiser_nonprofit_install_and_activate_plugins');
add_action('wp_ajax_fundraiser_nonprofit_rplugin_activation', 'fundraiser_nonprofit_rplugin_activation');
add_action('wp_ajax_nopriv_fundraiser_nonprofit_rplugin_activation', 'fundraiser_nonprofit_rplugin_activation');

// Function to install and activate the plugins



function check_plugin_installed_status($pugin_slug, $plugin_file)
{
    return file_exists(ABSPATH . 'wp-content/plugins/' . $pugin_slug . '/' . $plugin_file) ? true : false;
}

/* Check if plugin is activated */


function check_plugin_active_status($pugin_slug, $plugin_file)
{
    return is_plugin_active($pugin_slug . '/' . $plugin_file) ? true : false;
}

require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/misc.php');
require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
// Helper function to check if all recommended plugins are installed and activated
function fundraiser_nonprofit_all_plugins_active() {
    $recommended_plugins = array(
        array(
            'name' => __( 'CBX Bookmark & Favorite', 'fundraiser-nonprofit' ),
            'slug' => 'cbxwpbookmark',
            'file' => 'cbxwpbookmark.php'
        ),
    );

    foreach ($recommended_plugins as $plugin) {
        $plugin_slug = $plugin['slug'];
        $plugin_file = $plugin['file'];

        // Check if the plugin is active
        if (!is_plugin_active($plugin_slug . '/' . $plugin_file)) {
            return false; // If any plugin is not active, return false
        }
    }

    return true; // All plugins are active
}

class Silent_Skin extends WP_Upgrader_Skin {
    public function header() {}
    public function footer() {}
    public function feedback($string, ...$args) {}
    public function error($errors) {}
    public function before() {}
    public function after() {}
}

// Function to install and activate plugins
function fundraiser_nonprofit_install_and_activate_plugins() {
    if (!current_user_can('manage_options')) {
        return;
    }
    check_ajax_referer('fundraiser_nonprofit_welcome_nonce', 'nonce');

    // Define the recommended plugins
    $recommended_plugins = array(
        array(
            'name' => __( 'Mosaic Gallery Advanced Gallery', 'fundraiser-nonprofit' ),
            'slug' => 'mosaic-gallery-advanced-gallery',
            'file' => 'mosaic-image-gallery.php'
        ),
        array(
            'name' => __( 'CBX Bookmark & Favorite', 'fundraiser-nonprofit' ),
            'slug' => 'cbxwpbookmark',
            'file' => 'cbxwpbookmark.php'
        ),
    );

    set_transient('install_and_activate_progress', array(), MINUTE_IN_SECONDS * 10);

    require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/misc.php');
    require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

    foreach ($recommended_plugins as $plugin) {
        $plugin_slug = $plugin['slug'];
        $plugin_file = $plugin['file'];
        $plugin_name = $plugin['name'];

        // Check if the plugin is active
        if (is_plugin_active($plugin_slug . '/' . $plugin_file)) {
            update_install_and_activate_progress($plugin_name, 'Already Active');
            continue;
        }

        // Check if the plugin is installed but not active
        if (is_fundraiser_nonprofit_plugin_installed($plugin_slug)) {
            $activate = activate_plugin($plugin_slug . '/' . $plugin_file);
            if (is_wp_error($activate)) {
                update_install_and_activate_progress($plugin_name, 'Error');
                continue;
            }
            update_install_and_activate_progress($plugin_name, 'Activated');
            continue;
        }

        // Plugin is not installed or activated, proceed with installation
        update_install_and_activate_progress($plugin_name, 'Installing');

        $api = plugins_api('plugin_information', array('slug' => $plugin_slug, 'fields' => array('sections' => false)));
        if (is_wp_error($api)) {
            update_install_and_activate_progress($plugin_name, 'Error');
            continue;
        }

        $upgrader = new Plugin_Upgrader(new Silent_Skin());
        $install = $upgrader->install($api->download_link);

        if ($install) {
            $activate = activate_plugin($plugin_slug . '/' . $plugin_file);
            if (is_wp_error($activate)) {
                update_install_and_activate_progress($plugin_name, 'Error');
                continue;
            }
            update_install_and_activate_progress($plugin_name, 'Activated');
            continue;
        } else {
            update_install_and_activate_progress($plugin_name, 'Error');
        }
    }
    delete_transient('install_and_activate_progress');
    if (ob_get_length()) ob_clean();

    header('Content-Type: application/json; charset=utf-8');
    $redirect_url = admin_url('themes.php?page=fundraiser-nonprofit-guide-page');
    echo json_encode([
        'success' => true,
        'data' => [
            'redirect_url' => $redirect_url,
        ],
    ]);

    wp_die();
}

// Function to check if a plugin is installed
function is_fundraiser_nonprofit_plugin_installed($plugin_slug) {
    $installed_plugins = get_plugins();
    foreach ($installed_plugins as $path => $details) {
        if (strpos($path, $plugin_slug) === 0) {
            return true;
        }
    }
    return false;
}

// Function to update the installation progress
function update_install_and_activate_progress($plugin_name, $status) {
    $progress = get_transient('install_and_activate_progress');
    $progress[] = array('plugin' => $plugin_name, 'status' => $status);
    set_transient('install_and_activate_progress', $progress, MINUTE_IN_SECONDS * 10);
}

// Dismiss function for AJAX request
add_action('wp_ajax_fundraiser_nonprofit_dismissed_notice_handler', 'fundraiser_nonprofit_ajax_notice_dismiss_function');

function fundraiser_nonprofit_ajax_notice_dismiss_function() {
    if (!wp_verify_nonce($_POST['wpnonce'], 'fundraiser_nonprofit_welcome_nonce')) {
        wp_send_json_error('Invalid nonce');
        exit;
    }
    
    if (isset($_POST['type'])) {
        $fundraiser_nonprofit_type = sanitize_text_field(wp_unslash($_POST['type']));
        update_option('dismissed-' . $fundraiser_nonprofit_type, true);
        wp_send_json_success('Notice dismissed');
    } else {
        wp_send_json_error('Type not set');
    }
}
//  Plugin Activation End

function fundraiser_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started_notice', FALSE ) ) {
        $fundraiser_nonprofit_current_screen = get_current_screen();
			if ($fundraiser_nonprofit_current_screen->id !== 'appearance_page_fundraiser-nonprofit-guide-page') {
         $fundraiser_comments_theme = wp_get_theme(); ?>
            <div class="fundraiser-nonprofit-notice-wrapper updated notice notice-get-started-class is-dismissible notice-info" data-notice="get_started_notice">
			<div class="fundraiser-nonprofit-notice">
				<div class="fundraiser-nonprofit-notice-content">
					<div class="fundraiser-nonprofit-notice-heading">
						<h2><?php esc_html_e('Thanks For Installing ','fundraiser-nonprofit'); ?><?php echo esc_html( $fundraiser_comments_theme ); ?> <?php esc_html_e('Theme','fundraiser-nonprofit'); ?></h2>
					<p><?php 
                    /* translators: %s: theme name */
                    printf(esc_html__("%s is now installed and ready to use. We've provide some links to get you started.", 'fundraiser-nonprofit'), $fundraiser_comments_theme ); ?></p>
					</div>
					<div class="diplay-flex-btn">
						<a class="button button-primary button-primary theme-install" id="install-activate-button" href="#"><?php _e('GET STARTED', 'fundraiser-nonprofit'); ?></a>
						<a class="button button-primary" target="_blank" href="<?php echo esc_url( FUNDRAISER_NONPROFIT_BUY_NOW ); ?>"><?php echo esc_html__('GO TO PREMIUM','fundraiser-nonprofit'); ?></a>
					</div>
				</div>
				<div class="fundraiser-nonprofit-notice-img">
                    <a href="<?php echo esc_url( FUNDRAISER_NONPROFIT_THEME_BUNDLE ); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/notification.png'); ?>" alt="<?php esc_attr_e('logo', 'fundraiser-nonprofit'); ?>"></a>
				</div>
			</div>
		</div>
        <?php }
	}
}

add_action( 'admin_notices', 'fundraiser_deprecated_hook_admin_notice' );

// After switching theme, reset dismissed notice option
add_action('after_switch_theme', 'fundraiser_nonprofit_after_switch_theme');
function fundraiser_nonprofit_after_switch_theme() {
    update_option('dismissed-get_started_notice', FALSE);
}

function fundraiser_admin_enqueue_scripts() {
	wp_enqueue_style( 'fundraiser-nonprofit-admin-style', esc_url( get_template_directory_uri() ).'/assets/css/main.css' );
    wp_localize_script( 'fundraiser-nonprofit-admin-script', 'fundraiser_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'fundraiser_admin_enqueue_scripts' );

add_action( 'admin_menu', 'fundraiser_nonprofit_getting_started' );
function fundraiser_nonprofit_getting_started() {
	add_theme_page( esc_html__('Get Started', 'fundraiser-nonprofit'), esc_html__('Get Started', 'fundraiser-nonprofit'), 'edit_theme_options', 'fundraiser-nonprofit-guide-page', 'fundraiser_nonprofit_test_guide');
}

if ( ! defined( 'FUNDRAISER_NONPROFIT_DOCS_FREE' ) ) {
define('FUNDRAISER_NONPROFIT_DOCS_FREE',__('https://demo.misbahwp.com/docs/fundraiser-nonprofit-free-docs/','fundraiser-nonprofit'));
}
if ( ! defined( 'FUNDRAISER_NONPROFIT_DOCS_PRO' ) ) {
define('FUNDRAISER_NONPROFIT_DOCS_PRO',__('https://demo.misbahwp.com/docs/fundraiser-nonprofit-pro-docs/','fundraiser-nonprofit'));
}
if ( ! defined( 'FUNDRAISER_NONPROFIT_BUY_NOW' ) ) {
define('FUNDRAISER_NONPROFIT_BUY_NOW',__('https://www.misbahwp.com/products/fundraiser-wordpress-theme','fundraiser-nonprofit'));
}
if ( ! defined( 'FUNDRAISER_NONPROFIT_SUPPORT_FREE' ) ) {
define('FUNDRAISER_NONPROFIT_SUPPORT_FREE',__('https://wordpress.org/support/theme/fundraiser-nonprofit','fundraiser-nonprofit'));
}
if ( ! defined( 'FUNDRAISER_NONPROFIT_REVIEW_FREE' ) ) {
define('FUNDRAISER_NONPROFIT_REVIEW_FREE',__('https://wordpress.org/support/theme/fundraiser-nonprofit/reviews/#new-post','fundraiser-nonprofit'));
}
if ( ! defined( 'FUNDRAISER_NONPROFIT_DEMO_PRO' ) ) {
define('FUNDRAISER_NONPROFIT_DEMO_PRO',__('https://demo.misbahwp.com/fundraiser-nonprofit-pro/','fundraiser-nonprofit'));
}
if( ! defined( 'FUNDRAISER_NONPROFIT_THEME_BUNDLE' ) ) {
define('FUNDRAISER_NONPROFIT_THEME_BUNDLE',__('https://www.misbahwp.com/products/wordpress-bundle','fundraiser-nonprofit'));
}

function fundraiser_nonprofit_test_guide() { ?>
	<?php $fundraiser_nonprofit_theme = wp_get_theme(); ?>

	<div class="wrap" id="main-page">
		<div id="lefty">
			<div id="admin_links">
				<a href="<?php echo esc_url( FUNDRAISER_NONPROFIT_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Documentation', 'fundraiser-nonprofit' ) ?></a>
				<a href="<?php echo esc_url( admin_url('customize.php') ); ?>" id="customizer" target="_blank"><?php esc_html_e( 'Customize', 'fundraiser-nonprofit' ); ?> </a>
				<a class="blue-button-1" href="<?php echo esc_url( FUNDRAISER_NONPROFIT_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'fundraiser-nonprofit' ) ?></a>
				<a class="blue-button-2" href="<?php echo esc_url( FUNDRAISER_NONPROFIT_REVIEW_FREE ); ?>" target="_blank" class="btn4"><?php esc_html_e( 'Review', 'fundraiser-nonprofit' ) ?></a>
			</div>
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','fundraiser-nonprofit'); ?><?php echo esc_html( $fundraiser_nonprofit_theme ); ?>  <span><?php esc_html_e('Version: ', 'fundraiser-nonprofit'); ?><?php echo esc_html($fundraiser_nonprofit_theme['Version']);?></span></h3>
				<img class="img_responsive" style="width: 100%;" src="<?php echo esc_url( $fundraiser_nonprofit_theme->get_screenshot() ); ?>" />
				<div id="description-insidee">
					<?php
						$fundraiser_nonprofit_theme = wp_get_theme();
						echo wp_kses_post( apply_filters( 'misbah_theme_description', esc_html( $fundraiser_nonprofit_theme->get( 'Description' ) ) ) );
					?>
				</div>
			</div>
		</div>

		<div id="righty">
			<div class="postboxx donate">
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'fundraiser-nonprofit' ); ?></h3>
				<div class="insidee">
					<p><?php esc_html_e('Discover upgraded pro features with premium version click to upgrade.','fundraiser-nonprofit'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( FUNDRAISER_NONPROFIT_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'fundraiser-nonprofit' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( FUNDRAISER_NONPROFIT_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'fundraiser-nonprofit' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( FUNDRAISER_NONPROFIT_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'fundraiser-nonprofit' ) ?></a>
					</div>
				</div>
				<h3 class="hndle bundle"><?php esc_html_e( 'Get All Themes', 'fundraiser-nonprofit' ); ?></h3>
				<div class="insidee theme-bundle">
					<img width="100%" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bundle-image.png' ); ?>" alt="<?php esc_attr_e('logo', 'fundraiser-nonprofit'); ?>">
					<p class="offer"><?php esc_html_e('Get 110+ Perfect WordPress Theme In A Single Package at just $89.','fundraiser-nonprofit'); ?></p>
					<p class="coupon"><?php esc_html_e('Get Our Theme Pack of 110+ WordPress Themes At 30% Off ','fundraiser-nonprofit'); ?><span class="coupon-code"><?php esc_html_e('"Bundleup15"','fundraiser-nonprofit'); ?></span></p>
				<div id="admin_pro_linkss">
					<a class="blue-button-1" href="<?php echo esc_url( FUNDRAISER_NONPROFIT_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e( 'Buy All Themes - $89', 'fundraiser-nonprofit' ) ?></a>
				</div>
				<div class="d-table">
			    <ul class="d-column">
			      <li class="feature"><?php esc_html_e('Features','fundraiser-nonprofit'); ?></li>
			      <li class="free"><?php esc_html_e('Pro','fundraiser-nonprofit'); ?></li>
			      <li class="plus"><?php esc_html_e('Free','fundraiser-nonprofit'); ?></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('24hrs Priority Support','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Posttype','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Reordering','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Enable / Disable Option','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Multiple Sections','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Color Pallete','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Widgets','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Page Templates','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Typography','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Background Image / Color ','fundraiser-nonprofit'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
	  		</div>
			</div>
		</div>
	</div>
<?php } ?>