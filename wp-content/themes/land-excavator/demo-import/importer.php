<?php
/**
 * @package Demo Import
 * @since 1.0.0
 */

class ThemeWhizzie {

	protected $version = '1.1.0';

	/** @var string Current theme name, used as namespace in actions. */
	protected $theme_name = '';
	protected $theme_title = '';

	/** @var string Demo Import page slug and title. */
	protected $page_slug = '';
	protected $page_title = '';

	/** @var array Demo Import steps set by user. */
	protected $config_steps = array();
	public $parent_slug;
	/**
	 * Constructor
	 *
	 * @param $land_excavator_config	Our config parameters
	*/
	public function __construct( $land_excavator_config ) {
		$this->set_vars( $land_excavator_config );
		$this->init();
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $land_excavator_config	Our config parameters
	*/
	public function set_vars( $land_excavator_config ) {
		if( isset( $land_excavator_config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $land_excavator_config['page_slug'] );
		}
		if( isset( $land_excavator_config['page_title'] ) ) {
			$this->page_title = esc_attr( $land_excavator_config['page_title'] );
		}
		if( isset( $land_excavator_config['steps'] ) ) {
			$this->config_steps = $land_excavator_config['steps'];
		}

		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-demoimport' );
		$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	*/
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'demo-import-style', get_template_directory_uri() . '/demo-import/assets/css/demo-import-style.css');
		wp_register_script( 'demo-import-script', get_template_directory_uri() . '/demo-import/assets/js/demo-import-script.js', array( 'jquery' ), time() );
		wp_localize_script(
			'demo-import-script',
			'land_excavator_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'land-excavator' )
			)
		);
		wp_enqueue_script( 'demo-import-script' );
	}

	/**  Make a modal screen for the wizard **/
	public function menu_page() {
		add_menu_page( esc_html( $this->page_title ), esc_html( $this->page_title ), 'manage_options', $this->page_slug, array( $this, 'land_excavator_guide' ) ,'',40);
	}

	/** Make an interface for the wizard **/
	public function wizard_page() {
		/* If we arrive here, we have the filesystem */ ?>
		<div class="wrap">
			<?php echo '<div class="whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="whizzie-nav wizard-icon-nav">';?>
				<?php
					$stepI=1;
					foreach( $steps as $step ) {
						$stepAct=($stepI ==1)? 1 : 0;
						if( isset( $step['icon_text'] ) && $step['icon_text'] ) {
							echo '<li class="commom-cls nav-step-' . esc_attr( $step['id'] ) . '" wizard-steps="step-'.esc_attr( $step['id'] ).'" data-enable="'.$stepAct.'">
							<p>'.esc_attr( $step['icon_text'] ).'</p>
							</li>';
						}
					$stepI++;}
			 	echo '</ul>';
				echo '<ul class="whizzie-menu wizard-menu-page">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '" >';
						$content = call_user_func( array( $this, $step['view'] ) );
						printf('<div class="wizard-button-wrapper">');
							if( isset( $step['button_text_one'] )) {
								printf(
									'<div class="button-wrap button-wrap-one">
										<a href="#" class="button button-primary do-it" data-callback="install_widgets" data-step="widgets"><p class="demo-type-text">%s</p></a>
									</div>',
									esc_html( $step['button_text_one'] )
								);
							}
						printf('</div>');
					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="step-loading"><span class="spinner">
					<img src="<?php echo esc_url(get_template_directory_uri().'/demo-import/assets/images/Spinner-Animaion.gif'); ?>">
				</span></div>
			<?php echo '</div>';?>
		</div>
	<?php }

	/**
	 * Set options for the steps
	 * @return Array
	*/
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Customizer', 'land-excavator' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text_one'	=> __( 'Import Demo', 'land-excavator' ),
				'can_skip'		=> true,
				'icon_text'      => 'Import Demo'
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'land-excavator' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> '',
				'icon_text'      => 'Done'
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

	/**    Print the content for the intro step     **/
		public function get_step_importer() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Thank you for choosing this Land Excavator Theme. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.','land-excavator'); ?>
			</p>
		</div>
	<?php }

	/**   Print the content for the widgets step   **/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('This theme allows you to import demo content and add widgets. Install them using the button below. You can also update or deactivate them using the Customizer.','land-excavator'); ?>
			</p>
		</div>
	<?php }

	/** Print the content for the final step **/
	public function get_step_done() { ?>

		<div class="setup-finish">
			<p>
				<?php echo esc_html('Your demo content has been imported successfully. Click the finish button for more information.'); ?>
			</p>
			<div class="finish-buttons">
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=land-excavator-getstart-page' ) ); ?>" class="wz-btn-customizer" target="_blank"><?php esc_html_e('About Land Excavator','land-excavator') ?></a>
				<a href="<?php echo esc_url(admin_url('/customize.php')); ?>" class="wz-btn-customizer" target="_blank"><?php esc_html_e('Customize Your Demo','land-excavator') ?></a>
				<a href="" class="wz-btn-builder" target="_blank"><?php esc_html_e('Customize Your Demo','land-excavator'); ?></a>
				<a href="<?php echo esc_url(home_url()); ?>" class="wz-btn-visit-site" target="_blank"><?php esc_html_e('Visit Your Site','land-excavator'); ?></a>
			</div>
			<div class="finish-buttons">
				<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary"><?php esc_html_e('Finish','land-excavator'); ?></a>
			</div>
		</div>

	<?php }


	public function land_excavator_create_customizer_nav_menu() {
		// ------- Create Primary Menu --------
		$land_excavator_themename = 'Land Excavator'; // Ensure the theme name is set
		$land_excavator_menuname = $land_excavator_themename . ' Primary Menu';
		$land_excavator_menulocation = 'menu-1';
		$land_excavator_menu_exists = wp_get_nav_menu_object($land_excavator_menuname);

		if (!$land_excavator_menu_exists) {
			$land_excavator_menu_id = wp_create_nav_menu($land_excavator_menuname);

			// Home
			wp_update_nav_menu_item($land_excavator_menu_id, 0, array(
				'menu-item-title' => __('Home', 'land-excavator'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$land_excavator_page_about = get_page_by_path('about');
			if($land_excavator_page_about){
				wp_update_nav_menu_item($land_excavator_menu_id, 0, array(
					'menu-item-title' => __('About', 'land-excavator'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($land_excavator_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$land_excavator_page_services = get_page_by_path('services');
			if($land_excavator_page_services){
				wp_update_nav_menu_item($land_excavator_menu_id, 0, array(
					'menu-item-title' => __('Services', 'land-excavator'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($land_excavator_page_services),
					'menu-item-status' => 'publish'
				));
			}

			// Blog
			$land_excavator_page_blog = get_page_by_path('blog');
			if($land_excavator_page_blog){
				wp_update_nav_menu_item($land_excavator_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'land-excavator'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($land_excavator_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// Contact Us
			$land_excavator_page_contact = get_page_by_path('contact');
			if($land_excavator_page_contact){
				wp_update_nav_menu_item($land_excavator_menu_id, 0, array(
					'menu-item-title' => __('Contact Us', 'land-excavator'),
					'menu-item-classes' => 'contact',
					'menu-item-url' => get_permalink($land_excavator_page_contact),
					'menu-item-status' => 'publish'
				));
			}

			// Assign menu to location if not set
			if (!has_nav_menu($land_excavator_menulocation)) {
				$land_excavator_locations = get_theme_mod('nav_menu_locations');
				$land_excavator_locations[$land_excavator_menulocation] = $land_excavator_menu_id; // Use $land_excavator_menu_id here
				set_theme_mod('nav_menu_locations', $land_excavator_locations);
			}
		}
	}

	public function land_excavator_customizer_social_nav_menu() {

		// ------- Create Social Menu --------
		$land_excavator_menuname = $land_excavator_themename . 'Social Menu';
		$land_excavator_menulocation = 'social-menu';
		$land_excavator_menu_exists = wp_get_nav_menu_object( $land_excavator_menuname );

		if( !$land_excavator_menu_exists){
			$land_excavator_menu_id = wp_create_nav_menu($land_excavator_menuname);

			wp_update_nav_menu_item( $land_excavator_menu_id, 0, array(
				'menu-item-title'  => __( 'Facebook', 'land-excavator' ),
				'menu-item-url'    => 'https://www.facebook.com',
				'menu-item-status' => 'publish',
			) );

			wp_update_nav_menu_item( $land_excavator_menu_id, 0, array(
				'menu-item-title'  => __( 'Pinterest', 'land-excavator' ),
				'menu-item-url'    => 'https://www.pinterest.com',
				'menu-item-status' => 'publish',
			) );
	
			wp_update_nav_menu_item( $land_excavator_menu_id, 0, array(
				'menu-item-title'  => __( 'Twitter', 'land-excavator' ),
				'menu-item-url'    => 'https://www.twitter.com',
				'menu-item-status' => 'publish',
			) );
	
			wp_update_nav_menu_item( $land_excavator_menu_id, 0, array(
				'menu-item-title'  => __( 'Youtube', 'land-excavator' ),
				'menu-item-url'    => 'https://www.youtube.com',
				'menu-item-status' => 'publish',
			) );

			wp_update_nav_menu_item( $land_excavator_menu_id, 0, array(
				'menu-item-title'  => __( 'Instagram', 'land-excavator' ),
				'menu-item-url'    => 'https://www.instagram.com',
				'menu-item-status' => 'publish',
			) );

			if( !has_nav_menu( $land_excavator_menulocation ) ){
					$locations = get_theme_mod('nav_menu_locations');
					$locations[$land_excavator_menulocation] = $land_excavator_menu_id;
					set_theme_mod( 'nav_menu_locations', $locations );
			}
		}
	}

	/**
	* Imports the Demo Content
	* @since 1.1.0
	*/
	public function setup_widgets() {

		//................................................. MENU PAGES .................................................//
		
		$land_excavator_home_id='';
		$land_excavator_home_content = '';

		$land_excavator_home_title = 'Home';
		$land_excavator_home = array(
				'post_type' => 'page',
				'post_title' => $land_excavator_home_title,
				'post_content'  => $land_excavator_home_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'home'
		);
		$land_excavator_home_id = wp_insert_post($land_excavator_home);

		//Set the home page template
		add_post_meta( $land_excavator_home_id, '_wp_page_template', 'revolution-home.php' );

		//Set the static front page
		$land_excavator_home = get_page_by_title( 'Home' );
		update_option( 'page_on_front', $land_excavator_home->ID );
		update_option( 'show_on_front', 'page' );


		// Create a posts page and assign the template
		$land_excavator_blog_title = 'Blog';
		$land_excavator_blog_check = get_page_by_path('blog');
		if (!$land_excavator_blog_check) {
			$land_excavator_blog = array(
				'post_type'    => 'page',
				'post_title'   => $land_excavator_blog_title,
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'blog' // Unique slug for the blog page
			);
			$land_excavator_blog_id = wp_insert_post($land_excavator_blog);

			// Set the posts page
			if (!is_wp_error($land_excavator_blog_id)) {
				update_option('page_for_posts', $land_excavator_blog_id);
			}
		}

		// Create a Contact Us page and assign the template
		$land_excavator_contact_title = 'Contact Us';
		$land_excavator_contact_check = get_page_by_path('contact');
		if (!$land_excavator_contact_check) {
			$land_excavator_contact = array(
				'post_type'    => 'page',
				'post_title'   => $land_excavator_contact_title,
				'post_content'   => '"More About The Free Excavator WordPress Theme"
										The Free Excavator WordPress Theme is loaded with features specifically designed to benefit the excavation business, making it an invaluable resource for companies in this sector. One of its standout features is the built-in service showcase section, which allows businesses to highlight various services such as excavator grading, site preparation, and earthmoving effectively. This feature is crucial for potential clients, as it helps them understand the full scope of work offered. By presenting detailed information about services, companies can differentiate themselves from competitors, making it easier for clients to choose their services. Additionally, the Free Excavator WordPress Theme includes customizable service pages, enabling businesses to elaborate on each service’s unique benefits and processes. This not only informs clients but also enhances their confidence in choosing your services.

										Another notable aspect of the Free Excavator WordPress Theme is its integration of productivity tools aimed at enhancing operational efficiency. By incorporating telematics and monitoring systems, businesses can manage their excavator fleet effectively, allowing for real-time tracking of equipment performance. This level of monitoring is essential, as it ensures that businesses can make informed decisions regarding maintenance and service schedules. By keeping tabs on the equipment’s health, companies can maximize the lifespan of their machines while also improving overall productivity. Furthermore, automated diagnostics can alert operators to any potential issues before they escalate, effectively reducing downtime and service costs, which can be crucial for maintaining a profitable operation. User engagement is another priority for this theme, with features such as testimonials and a blog section that play a vital role in building trust and credibility.

										Customer testimonials serve as powerful social proof, showcasing the success of past projects and the satisfaction of clients. This helps in establishing a strong reputation in the market. Meanwhile, the blog section allows businesses to share insights on excavation techniques, industry trends, and tips for clients. By regularly updating this section, companies can position themselves as industry experts, which not only builds authority but also improves SEO performance, helping attract organic traffic to the website. Additionally, the built-in social media integration allows for seamless promotion of services and blog posts, further expanding reach and connecting with a broader audience. By adopting this theme, excavation businesses can not only improve their operational efficiency but also connect more deeply with potential clients, driving growth and success in a competitive marketplace.',
					'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'contact' // Unique slug for the Contact Us page
			);
			wp_insert_post($land_excavator_contact);
		}

		// Create a About page and assign the template
		$land_excavator_about_title = 'About';
		$land_excavator_about_check = get_page_by_path('about');
		if (!$land_excavator_about_check) {
			$land_excavator_about = array(
				'post_type'    => 'page',
				'post_title'   => $land_excavator_about_title,
				'post_content'   => '"More About The Free Excavator WordPress Theme"
										The Free Excavator WordPress Theme is loaded with features specifically designed to benefit the excavation business, making it an invaluable resource for companies in this sector. One of its standout features is the built-in service showcase section, which allows businesses to highlight various services such as excavator grading, site preparation, and earthmoving effectively. This feature is crucial for potential clients, as it helps them understand the full scope of work offered. By presenting detailed information about services, companies can differentiate themselves from competitors, making it easier for clients to choose their services. Additionally, the Free Excavator WordPress Theme includes customizable service pages, enabling businesses to elaborate on each service’s unique benefits and processes. This not only informs clients but also enhances their confidence in choosing your services.

										Another notable aspect of the Free Excavator WordPress Theme is its integration of productivity tools aimed at enhancing operational efficiency. By incorporating telematics and monitoring systems, businesses can manage their excavator fleet effectively, allowing for real-time tracking of equipment performance. This level of monitoring is essential, as it ensures that businesses can make informed decisions regarding maintenance and service schedules. By keeping tabs on the equipment’s health, companies can maximize the lifespan of their machines while also improving overall productivity. Furthermore, automated diagnostics can alert operators to any potential issues before they escalate, effectively reducing downtime and service costs, which can be crucial for maintaining a profitable operation. User engagement is another priority for this theme, with features such as testimonials and a blog section that play a vital role in building trust and credibility.

										Customer testimonials serve as powerful social proof, showcasing the success of past projects and the satisfaction of clients. This helps in establishing a strong reputation in the market. Meanwhile, the blog section allows businesses to share insights on excavation techniques, industry trends, and tips for clients. By regularly updating this section, companies can position themselves as industry experts, which not only builds authority but also improves SEO performance, helping attract organic traffic to the website. Additionally, the built-in social media integration allows for seamless promotion of services and blog posts, further expanding reach and connecting with a broader audience. By adopting this theme, excavation businesses can not only improve their operational efficiency but also connect more deeply with potential clients, driving growth and success in a competitive marketplace.',
					'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'about' // Unique slug for the About page
			);
			wp_insert_post($land_excavator_about);
		}

		// Create a Services page and assign the template
		$land_excavator_services_title = 'Services';
		$land_excavator_services_check = get_page_by_path('services');
		if (!$land_excavator_services_check) {
			$land_excavator_services = array(
				'post_type'    => 'page',
				'post_title'   => $land_excavator_services_title,
				'post_content'   => '"More About The Free Excavator WordPress Theme"
										The Free Excavator WordPress Theme is loaded with features specifically designed to benefit the excavation business, making it an invaluable resource for companies in this sector. One of its standout features is the built-in service showcase section, which allows businesses to highlight various services such as excavator grading, site preparation, and earthmoving effectively. This feature is crucial for potential clients, as it helps them understand the full scope of work offered. By presenting detailed information about services, companies can differentiate themselves from competitors, making it easier for clients to choose their services. Additionally, the Free Excavator WordPress Theme includes customizable service pages, enabling businesses to elaborate on each service’s unique benefits and processes. This not only informs clients but also enhances their confidence in choosing your services.

										Another notable aspect of the Free Excavator WordPress Theme is its integration of productivity tools aimed at enhancing operational efficiency. By incorporating telematics and monitoring systems, businesses can manage their excavator fleet effectively, allowing for real-time tracking of equipment performance. This level of monitoring is essential, as it ensures that businesses can make informed decisions regarding maintenance and service schedules. By keeping tabs on the equipment’s health, companies can maximize the lifespan of their machines while also improving overall productivity. Furthermore, automated diagnostics can alert operators to any potential issues before they escalate, effectively reducing downtime and service costs, which can be crucial for maintaining a profitable operation. User engagement is another priority for this theme, with features such as testimonials and a blog section that play a vital role in building trust and credibility.

										Customer testimonials serve as powerful social proof, showcasing the success of past projects and the satisfaction of clients. This helps in establishing a strong reputation in the market. Meanwhile, the blog section allows businesses to share insights on excavation techniques, industry trends, and tips for clients. By regularly updating this section, companies can position themselves as industry experts, which not only builds authority but also improves SEO performance, helping attract organic traffic to the website. Additionally, the built-in social media integration allows for seamless promotion of services and blog posts, further expanding reach and connecting with a broader audience. By adopting this theme, excavation businesses can not only improve their operational efficiency but also connect more deeply with potential clients, driving growth and success in a competitive marketplace.',
					'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'services' // Unique slug for the Services page
			);
			wp_insert_post($land_excavator_services);
		}


		// ------------------------------------------ Header -------------------------------------- //

			set_theme_mod('land_excavator_header_info_phone','Toll Free: +1234-567-7890');
			set_theme_mod('land_excavator_header_info_email','excavator123456@example.com');

			set_theme_mod('land_excavator_facebook_link_option','#');
			set_theme_mod('land_excavator_twitter_link_option','#');
			set_theme_mod('land_excavator_instagram_link_option','#');
			set_theme_mod('land_excavator_linkedin_link_option','#');
			set_theme_mod('land_excavator_pinterest_link_option','#');
			set_theme_mod('land_excavator_youtube_link_option','#');

			set_theme_mod('land_excavator_header_button_text','Get A Quote');
			set_theme_mod('land_excavator_header_button_link','#');
			set_theme_mod('land_excavator_enable_slider',1);
			set_theme_mod('land_excavator_projetcs_sec_show',1);
			set_theme_mod('land_excavator_header_search',true);
			

		// ------------------------------------------ Slider Section -------------------------------------- //

			for($i=1;$i<=3;$i++){
				set_theme_mod( 'land_excavator_slider_image'.$i,get_template_directory_uri().'/revolution/assets/images/slider'.$i.'.png' );
				set_theme_mod( 'land_excavator_slider_top_text'.$i, 'Welcome To Our Company' );
				set_theme_mod( 'land_excavator_slider_heading'.$i, 'Excavate, Innovate, Elevate, And Succeed.' );
				set_theme_mod( 'land_excavator_slider_text'.$i, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.' );
				set_theme_mod( 'land_excavator_slider_button1_text'.$i, 'Read More' );
				set_theme_mod( 'land_excavator_slider_button1_link'.$i, '#' );
				set_theme_mod( 'land_excavator_slider_button2_text'.$i, 'Request A Quote' );
				set_theme_mod( 'land_excavator_slider_button2_link'.$i, '#' );
			}

		// ------------------------------------------ Chef Section -------------------------------------- //

			set_theme_mod('land_excavator_projetcs_main_text','Our Works');
			set_theme_mod('land_excavator_projetcs_main_heading','OUR BEST PROJECT');

			$tab_title=array('All','Buldozar','Excavators','Heavy JCB','Road Rollers','Pressure Machine');
			for($i=1;$i<=6;$i++) {
				set_theme_mod( 'land_excavator_projetcs_text'.$i, $tab_title[$i-1] );
			}

			wp_delete_post(1);
			$blog_title = array(
				'Excavators',
				'Bulldozer',
				'Pressure Machine',
				'Heavy Loaders',
				'Backhoe Services',
				'Site Preparation Tools',
			);
			for($i=1;$i<=6;$i++){
				$title =$blog_title[$i-1];
				$content = 'Lorem Ipsum is simply dummy text';
	
				// Create post object
				$my_post = array(
					'post_title'    => wp_strip_all_tags( $title ),
					'post_content'  => $content,
					'post_status'   => 'publish',
					'post_type'     => 'post',
				);
	
				// Insert the post into the database
				$post_id = wp_insert_post( $my_post );
	
				$image_url = get_template_directory_uri().'/revolution/assets/images/blogs'.$i.'.png';
	
				$image_name= 'blogs'.$i.'.png';
				$upload_dir       = wp_upload_dir();
				// Set upload folder
				$image_data       = file_get_contents($image_url);
				// Get image data
				$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
				// Generate unique name
				$filename= basename( $unique_file_name );
				// Create image file name
				// Check folder permission and define file location
				if( wp_mkdir_p( $upload_dir['path'] ) ) {
					 $file = $upload_dir['path'] . '/' . $filename;
				} else {
					 $file = $upload_dir['basedir'] . '/' . $filename;
				}
				// Create the image  file on the server
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}

				WP_Filesystem();
				global $wp_filesystem;

				if ( ! $wp_filesystem->put_contents( $file, $image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}
				// Check image file type
				$wp_filetype = wp_check_filetype( $filename, null );
				// Set attachment data
				$attachment = array(
				 'post_mime_type' => $wp_filetype['type'],
				 'post_title'     => sanitize_file_name( $filename ),
				 'post_content'   => '',
				 'post_type'     => 'post',
				 'post_status'    => 'inherit'
				);
				// Create the attachment
				$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				// Define attachment metadata
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				// Assign metadata to attachment
				 wp_update_attachment_metadata( $attach_id, $attach_data );
				// And finally assign featured image to post
				set_post_thumbnail( $post_id, $attach_id );
			}

			
  	 	$this->land_excavator_create_customizer_nav_menu();
  	 	$this->land_excavator_customizer_social_nav_menu();
	}

	public function land_excavator_guide() {
		$display_string = '';
		$return = add_query_arg( array()) ;
		$theme = wp_get_theme( 'land-excavator' );
		?>
		<div class="wrapper-info get-stared-page-wrap">
			<div class="wrapper-info-content">
				<div class="buynow__">
					<h2><?php esc_html_e( LAND_EXCAVATOR_WELCOME_MESSAGE ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
					<p><?php esc_html_e('The quick setup wizard will assist you in configuring your new website. This wizard will import the demo content.', 'land-excavator'); ?></p>
				</div>
				<div class="buynow_">
					<a target="_blank" class="buynow_themepage" href="<?php echo esc_url('https://www.revolutionwp.com/products/land-excavator-wordpress-theme'); ?>"><?php echo esc_html__('Go Premium Now', 'land-excavator'); ?></a>
				</div>
			</div>
			<div class="tab-sec theme-option-tab">
				<div id="demo_offer" class="tabcontent open">
					<?php $this->wizard_page(); ?>
				</div>
			</div>
		</div>
	<?php }
}