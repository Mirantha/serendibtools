<?php
/**
 * Wizard
 *
 * @package Whizzie
 * @author Aster Themes
 * @since 1.0.0
 */

class Whizzie {

	protected $version = '1.1.0';
	protected $theme_name = '';
	protected $theme_title = '';
	protected $page_slug = '';
	protected $page_title = '';
	protected $config_steps = array();
	public $plugin_path;
	public $parent_slug;
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

	/*** Constructor ***
	* @param $config	Our config parameters
	*/
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}

	/**
	* Set some settings
	* @since 1.0.0
	* @param $config	Our config parameters
	*/

	public function set_vars( $config ) {
		// require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $config['page_slug'] );
		}
		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->plugin_path );
		$this->plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'theme-wizard-style', get_template_directory_uri() . '/theme-wizard/assets/css/theme-wizard-style.css');
		wp_register_script( 'theme-wizard-script', get_template_directory_uri() . '/theme-wizard/assets/js/theme-wizard-script.js', array( 'jquery' ), );

		wp_localize_script(
			'theme-wizard-script',
			'plumbing_handyman_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'verify_text'	=> esc_html( 'verifying', 'plumbing-handyman' )
			)
		);
		wp_enqueue_script( 'theme-wizard-script' );
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2*/
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}

	/***        Make a modal screen for the wizard        ***/
	
	public function menu_page() {
		add_theme_page( esc_html( $this->page_title ), esc_html( $this->page_title ), 'manage_options', $this->page_slug, array( $this, 'plumbing_handyman_setup_wizard' ) );
	}

	/***        Make an interface for the wizard        ***/

	public function wizard_page() {
		tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="main-wrap">
			<?php
			echo '<div class="card whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="whizzie-menu">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">';
						printf( '<h2>%s</h2>', esc_html( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf( '<p><a href="#" class="more-info">%s</a></p>', __( 'More Info', 'plumbing-handyman' ) );
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}
						// The next button
						if( isset( $step['button_text'] ) && $step['button_text'] ) {
                            ?>
                            <?php if ( ! get_option('is-demo-imported') ) : ?>
                            <?php
                            printf(
                                '<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
                                esc_attr( $step['callback'] ),
                                esc_attr( $step['id'] ),
                                esc_html( $step['button_text'] )
                            );
                            ?>
                            <?php else : ?>
                                <a target="_blank" href="<?php echo esc_url( home_url() ); ?>" class="button button-primary" style="margin: auto; font-size: 20px; font-weight: 600">
                                    <?php esc_html_e( 'Visit Site', 'plumbing-handyman' ); ?>
                                </a>
                            <?php endif; ?>
                            <?php
                        }
					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="step-loading"><span class="spinner"></span></div>
			</div><!-- .whizzie-wrap -->

		</div><!-- .wrap -->
	<?php }



	public function activation_page() {
		?>
		<div class="main-wrap">
			<h3><?php esc_html_e('Theme Setup Wizard','plumbing-handyman'); ?></h3>
		</div>
		<?php
	}

	public function plumbing_handyman_setup_wizard(){

			$display_string = '';

			$body = [
				'home_url'					 => home_url(),
				'theme_text_domain'	 => wp_get_theme()->get( 'TextDomain' )
			];

			$body = wp_json_encode( $body );
			$options = [
				'body'        => $body,
				'sslverify' 	=> false,
				'headers'     => [
					'Content-Type' => 'application/json',
				]
			];

			//custom function about theme customizer
			$return = add_query_arg( array()) ;
			$theme = wp_get_theme( 'plumbing-handyman' );

			?>
				<div class="wrapper-info get-stared-page-wrap">
					<div class="tab-sec theme-option-tab">
						<div id="demo_offer" class="tabcontent">
							<?php $this->wizard_page(); ?>
						</div>
					</div>
				</div>
			<?php
	}
	

	/**
	* Set options for the steps
	* Incorporate any options set by the theme dev
	* Return the array for the steps
	* @return Array
	*/
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'plumbing-handyman' ) . $this->theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step', // Callback for JS
				'button_text'	=> __( 'Start Now', 'plumbing-handyman' ),
				'can_skip'		=> false // Show a skip button?
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'plumbing-handyman' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'plumbing-handyman' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'plumbing-handyman' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo', 'plumbing-handyman' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'plumbing-handyman' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/*** Display the content for the intro step ***/
	public function get_step_intro() { ?>
		<div class="summary">
			<p style="text-align: center;"><?php esc_html_e( 'Thank you for choosing our theme! We are excited to help you get started with your new website.', 'plumbing-handyman' ); ?></p>
			<p style="text-align: center;"><?php esc_html_e( 'This section will guide you through setting up and customizing the theme. You can follow the steps to import demo content or adjust settings at any time to make the website look and work the way you want.', 'plumbing-handyman' ); ?></p>
		</div>
	<?php }
	
	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','plumbing-handyman') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = 'Activation';
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}

	/*** Display the content for the widgets step ***/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p><?php esc_html_e('To get started, use the button below to import demo content and add widgets to your site. After installation, you can manage settings and customize your site using the Customizer. Enjoy your new theme!', 'plumbing-handyman'); ?></p>
		</div>
	<?php }

	/***        Print the content for the final step        ***/

	public function get_step_done() { ?>
		<div id="aster-demo-setup-guid">
			<div class="aster-setup-menu">
				<h3><?php esc_html_e('Setup Navigation Menu','plumbing-handyman'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Menu','plumbing-handyman'); ?></p>
				<h4><?php esc_html_e('A) Create Pages','plumbing-handyman'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Pages >> Add New','plumbing-handyman'); ?></li>
					<li><?php esc_html_e('Enter Page Details And Save Changes','plumbing-handyman'); ?></li>
				</ol>
				<h4><?php esc_html_e('B) Add Pages To Menu','plumbing-handyman'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Menu','plumbing-handyman'); ?></li>
					<li><?php esc_html_e('Click On The Create Menu Option','plumbing-handyman'); ?></li>
					<li><?php esc_html_e('Select The Pages And Click On The Add to Menu Button','plumbing-handyman'); ?></li>
					<li><?php esc_html_e('Select Primary Menu From The Menu Setting','plumbing-handyman'); ?></li>
					<li><?php esc_html_e('Click On The Save Menu Button','plumbing-handyman'); ?></li>
				</ol>
			</div>
			<div class="aster-setup-widget">
				<h3><?php esc_html_e('Setup Footer Widgets','plumbing-handyman'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Footer Widgets','plumbing-handyman'); ?></p>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Widgets','plumbing-handyman'); ?></li>
					<li><?php esc_html_e('Drag And Add The Widgets In The Footer Columns','plumbing-handyman'); ?></li>
				</ol>
			</div>
			<div style="display:flex; justify-content: center; margin-top: 20px; gap:20px">
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url(home_url()); ?>" class="button button-primary">Visit Site</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary">Customize Your Demo</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('themes.php?page=plumbing-handyman-getting-started') ); ?>" class="button button-primary">Dashboard</a>
				</div>
			</div>
		</div>
	<?php }

	/***       Get the plugins registered with TGMPA       ***/
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}


	public function setup_plugins() {
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','plumbing-handyman' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','plumbing-handyman' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','plumbing-handyman' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','plumbing-handyman' ) ) );
		}
		exit;
	}

	/***------------------------------------------------- Imports the Demo Content* @since 1.1.0 ----------------------------------------------****/


	//                      ------------- MENUS -----------------                    //

	public function plumbing_handyman_customizer_primary_menu(){

		// ------- Create Primary Menu --------
		$plumbing_handyman_menuname = $plumbing_handyman_themename . 'Main Menu';
		$plumbing_handyman_bpmenulocation = 'primary';
		$plumbing_handyman_menu_exists = wp_get_nav_menu_object( $plumbing_handyman_menuname );

		if( !$plumbing_handyman_menu_exists){
			$plumbing_handyman_menu_id = wp_create_nav_menu($plumbing_handyman_menuname);
			$plumbing_handyman_parent_item = 
			wp_update_nav_menu_item($plumbing_handyman_menu_id, 0, array(
				'menu-item-title' =>  __('Home','plumbing-handyman'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url( '/' ),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($plumbing_handyman_menu_id, 0, array(
				'menu-item-title' =>  __('About Us','plumbing-handyman'),
				'menu-item-classes' => 'about-us',
				'menu-item-url' => get_permalink(get_page_by_title('About Us')),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($plumbing_handyman_menu_id, 0, array(
				'menu-item-title'   => __('Pages', 'plumbing-handyman'),
				'menu-item-classes' => 'pages',
				'menu-item-url'     => get_permalink(get_page_by_title('Pages')),
				'menu-item-status'  => 'publish'
			));

			wp_update_nav_menu_item($plumbing_handyman_menu_id, 0, array(
				'menu-item-title'   => __('Blog', 'plumbing-handyman'),
				'menu-item-classes' => 'blog',
				'menu-item-url'     => get_permalink(get_page_by_title('Blog')),
				'menu-item-status'  => 'publish'));	

			wp_update_nav_menu_item( $plumbing_handyman_menu_id, 0, array(
				'menu-item-title'   => __( 'Shop','plumbing-handyman' ),
				'menu-item-classes' => 'shop',
				'menu-item-url'     => get_permalink( get_page_by_title( 'Shop' ) ),
				'menu-item-status' => 'publish',
			));


			wp_update_nav_menu_item($plumbing_handyman_menu_id, 0, array(
				'menu-item-title' =>  __('Contact Us','plumbing-handyman'),
				'menu-item-classes' => 'contact-us',
				'menu-item-url' => get_permalink(get_page_by_title('Contact Us')),
				'menu-item-status' => 'publish'
			));
			
			if( !has_nav_menu( $plumbing_handyman_bpmenulocation ) ){
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$plumbing_handyman_bpmenulocation] = $plumbing_handyman_menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}
		}
	}

	public function setup_widgets() {

		// Create a front page and assigned the template
		$plumbing_handyman_home_title = 'Home';
		$plumbing_handyman_home_check = get_page_by_title($plumbing_handyman_home_title);
		$plumbing_handyman_home = array(
			'post_type' => 'page',
			'post_title' => $plumbing_handyman_home_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'home'
		);
		$plumbing_handyman_home_id = wp_insert_post($plumbing_handyman_home);

		//Set the static front page
		$plumbing_handyman_home = get_page_by_title( 'Home' );
		update_option( 'page_on_front', $plumbing_handyman_home->ID );
		update_option( 'show_on_front', 'page' );

		// Create a Women and assigned the template
		$plumbing_handyman_gallery_title = 'Pages';
		$plumbing_handyman_gallery_check = get_page_by_title($plumbing_handyman_gallery_title);
		$plumbing_handyman_gallery = array(
			'post_type' => 'page',
			'post_title' => $plumbing_handyman_gallery_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'pages'
		);
		$plumbing_handyman_gallery_id = wp_insert_post($plumbing_handyman_gallery);

		// Create a posts page and assigned the template
		$plumbing_handyman_blog_title = 'About Us';
		$plumbing_handyman_blog = get_page_by_title($plumbing_handyman_blog_title);

		if (!$plumbing_handyman_blog) {
			$plumbing_handyman_blog = array(
				'post_type' => 'page',
				'post_title' => $plumbing_handyman_blog_title,
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'about-us'
			);
			$plumbing_handyman_blog_id = wp_insert_post($plumbing_handyman_blog);

			if (is_wp_error($plumbing_handyman_blog_id)) {
				// Handle error
			}
		} else {
			$plumbing_handyman_blog_id = $plumbing_handyman_blog->ID;
		}

		// Create a Contact and assigned the template
		$plumbing_handyman_contact_title = 'Pages';
		$plumbing_handyman_contact_check = get_page_by_title($plumbing_handyman_contact_title);
		$plumbing_handyman_contact = array(
			'post_type' => 'page',
			'post_title' => $plumbing_handyman_contact_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'pages'
		);
		$plumbing_handyman_contact_id = wp_insert_post($plumbing_handyman_contact);

		// Create a posts page and assigned the template
		$plumbing_handyman_blog_title = 'Blog';
		$plumbing_handyman_blog = get_page_by_title($plumbing_handyman_blog_title);

		if (!$plumbing_handyman_blog) {
			$plumbing_handyman_blog = array(
				'post_type' => 'page',
				'post_title' => $plumbing_handyman_blog_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'blog'
			);
			$plumbing_handyman_blog_id = wp_insert_post($plumbing_handyman_blog);

			if (is_wp_error($plumbing_handyman_blog_id)) {
				// Handle error
			}
		} else {
			$plumbing_handyman_blog_id = $plumbing_handyman_blog->ID;
		}
		// Set the posts page
		update_option('page_for_posts', $plumbing_handyman_blog_id);

		$plumbing_handyman_contact_title = 'Shop';

		$plumbing_handyman_contact_check = get_page_by_title( $plumbing_handyman_contact_title );

		if ( ! $plumbing_handyman_contact_check ) {

			$plumbing_handyman_contact = array(
				'post_type'    => 'page',
				'post_title'   => $plumbing_handyman_contact_title,
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'shop', // slug
			);

			$plumbing_handyman_shop_page_id = wp_insert_post( $plumbing_handyman_contact );

		} else {
			$plumbing_handyman_shop_page_id = $plumbing_handyman_contact_check->ID;
		}

		if ( function_exists( 'wc_get_page_id' ) ) {
			update_option( 'woocommerce_shop_page_id', $plumbing_handyman_shop_page_id );
		}

		// Create a Contact and assigned the template
		$plumbing_handyman_contact_title = 'Contact Us';
		$plumbing_handyman_contact_check = get_page_by_title($plumbing_handyman_contact_title);
		$plumbing_handyman_contact = array(
			'post_type' => 'page',
			'post_title' => $plumbing_handyman_contact_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'contact-us'
		);
		$plumbing_handyman_contact_id = wp_insert_post($plumbing_handyman_contact);


		/*----------------------------------------- Header Section --------------------------------------------------*/

		set_theme_mod( 'plumbing_handyman_enable_topbar', true);
		set_theme_mod( 'plumbing_handyman_phone_number', '120 300 1234 5555');
		set_theme_mod( 'plumbing_handyman_email_topbar_address', 'plumbin@example.com');
		set_theme_mod( 'plumbing_handyman_header_location', '2464 Royal Ln. Mesa, New Jersey 45463');
		set_theme_mod( 'plumbing_handyman_enable_header_icon_section', true);
		set_theme_mod( 'plumbing_handyman_header_facebook_link', 'https://www.facebook.com');
		set_theme_mod( 'plumbing_handyman_header_twitter_link', 'https://www.twitter.com');
		set_theme_mod( 'plumbing_handyman_header_instagram_link', 'https://www.instagram.com');
		set_theme_mod( 'plumbing_handyman_header_pinterest_link', 'https://www.pinterest.com');
		set_theme_mod( 'plumbing_handyman_topheader_button_text', 'Book Now');
		set_theme_mod( 'plumbing_handyman_topheader_button_url', '#');

		// ------------------------- Banner Section -------------------------

		set_theme_mod( 'plumbing_handyman_enable_slider_section', true);
		set_theme_mod( 'plumbing_handyman_slider_heading', 'Quality services');
		set_theme_mod( 'plumbing_handyman_one_word_heading', 'Plumbing');
		set_theme_mod( 'plumbing_handyman_slider_button_label', 'Book Now');
		set_theme_mod( 'plumbing_handyman_slider_button_link', '#');

		$plumbing_handyman_category_slider = get_term_by( 'name', 'Slider', 'category' );
		if ( ! $plumbing_handyman_category_slider ) {
			$plumbing_handyman_category_slider = wp_create_category( 'Slider' );
		} else {
			$plumbing_handyman_category_slider = $plumbing_handyman_category_slider->term_id;
		}

		// Set the theme mod with the Slider category ID
		set_theme_mod( 'plumbing_handyman_slider_slider_category', 'Slider' );

		// Post titles and slider image filenames
		$slider_post_titles = array(
			'We provide top notch plumbing & repair services',
			'Expert Plumbing Solutions for Homes & Businesses',
			'Fast, Affordable & Trusted Repair Services',
		);

		$slider_images = array(
			'slider1.png',
			'slider2.png',
			'slider3.png'
		);

		// Path to theme images
		$slider_img_base_path = get_template_directory() . '/resource/img/';

		foreach ( $slider_post_titles as $i => $title ) {
			$post_exists = get_page_by_title( $title, OBJECT, 'post' );
			if ( $post_exists ) {
				continue;
			}

			$post_id = wp_insert_post( array(
				'post_title'    => $title,
				'post_content'  => 'Our team of experts is equipped to assist you with a variety of pipe repair needs. Please share your email address to connect with us. ',
				'post_status'   => 'publish',
				'post_category' => array( $plumbing_handyman_category_slider ),
			) );

			$filename = $slider_images[$i];
			$file     = $slider_img_base_path . $filename;

			if ( file_exists( $file ) ) {
				require_once ABSPATH . 'wp-admin/includes/image.php';
				require_once ABSPATH . 'wp-admin/includes/file.php';
				require_once ABSPATH . 'wp-admin/includes/media.php';

				$upload = wp_upload_bits( $filename, null, file_get_contents( $file ) );
				if ( ! $upload['error'] ) {
					$wp_filetype = wp_check_filetype( $upload['file'], null );
					$attachment  = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $filename ),
						'post_status'    => 'inherit'
					);
					$attach_id  = wp_insert_attachment( $attachment, $upload['file'], $post_id );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
					wp_update_attachment_metadata( $attach_id, $attach_data );
					set_post_thumbnail( $post_id, $attach_id );
				}
			}
		}

		// ------------------------- About Section -------------------------

		set_theme_mod( 'plumbing_handyman_enable_about_section', true ); 
		set_theme_mod( 'plumbing_handyman_about_short_content', 'About Plumber' );
		set_theme_mod( 'plumbing_handyman_about_section_heading', 'Making Your Home a More Desirable Place' );
		set_theme_mod( 'plumbing_handyman_about_section_content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type book.Lorem Ipsum is simply dummy text of the printing and typesetting industry.' );
		set_theme_mod( 'plumbing_handyman_about_list_text_1', 'The Most Flexible And Cost-Effective' );
		set_theme_mod( 'plumbing_handyman_about_list_content_1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' );
		set_theme_mod( 'plumbing_handyman_about_list_text_2', 'Professional Well Trained Handyman' );
		set_theme_mod( 'plumbing_handyman_about_list_content_2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' );
		set_theme_mod( 'plumbing_handyman_about_list_text_3', 'Quality Solutions & Best Satisfaction' );
		set_theme_mod( 'plumbing_handyman_about_list_content_3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' );
		set_theme_mod( 'plumbing_handyman_about_button_label_', 'Book Now' );
		set_theme_mod( 'plumbing_handyman_about_button_link_', '#' );
		set_theme_mod( 'plumbing_handyman_image_content', 'Lorem Ipsum is simply dummy text of the printing and type setting industry.' );
		set_theme_mod( 'plumbing_handyman_image_text', 'John Verma' );
		set_theme_mod( 'plumbing_handyman_image_sub_text', 'Customer' );
		set_theme_mod( 'plumbing_handyman_team_image_1', esc_url( get_template_directory_uri().'/resource/img/author.png'));

		// ---------------------------------------- Related post_tag --------------------------------------------------- //	
		
		set_theme_mod('plumbing_handyman_post_related_post_label','Related Posts');
		set_theme_mod('plumbing_handyman_related_posts_count','3');

		$this->plumbing_handyman_customizer_primary_menu();
		update_option('is-demo-imported', true);
	}
}