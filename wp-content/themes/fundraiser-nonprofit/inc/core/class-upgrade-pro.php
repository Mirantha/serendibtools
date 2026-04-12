<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Fundraiser_Nonprofit_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/core/upgrade-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Fundraiser_Nonprofit_Customize_Section_Pro' );

		// Add the PRO Upgrade section.
		$manager->add_section(
		    new Fundraiser_Nonprofit_Customize_Section_Pro(
		        $manager,
		        'fundraiser_nonprofit_upgrade_pro',
		        array(
		            'title'         => esc_html__( 'Fundraiser Nonprofit PRO', 'fundraiser-nonprofit' ),
		            'pro_text'      => esc_html__( 'Fundraiser PRO', 'fundraiser-nonprofit' ),
		            'pro_url'       => esc_url( FUNDRAISER_NONPROFIT_BUY_NOW ),
		            'demo_text'     => esc_html__( 'Demo', 'fundraiser-nonprofit' ),
		            'demo_url'      => esc_url( FUNDRAISER_NONPROFIT_DEMO_PRO ),
		            'support_text'  => esc_html__( 'Support', 'fundraiser-nonprofit' ),
		            'support_url'   => esc_url( FUNDRAISER_NONPROFIT_SUPPORT_FREE ),
		            'bundle_text'   => esc_html__( 'Get All Themes', 'fundraiser-nonprofit' ),
		            'bundle_url'    => esc_url( FUNDRAISER_NONPROFIT_THEME_BUNDLE ),
		            'lite_doc_text' => esc_html__( 'Lite Doc', 'fundraiser-nonprofit' ),
		            'lite_doc_url'  => esc_url( FUNDRAISER_NONPROFIT_DOCS_FREE ),
		            'review_text'   => esc_html__( 'Review', 'fundraiser-nonprofit' ),
		            'review_url'    => esc_url( FUNDRAISER_NONPROFIT_REVIEW_FREE ),
		            'priority'      => 1,
		        )
		    )
		);

	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script(
			'fundraiser-nonprofit-customize-controls',
			trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js',
			array( 'customize-controls' )
		);

		wp_enqueue_style(
			'fundraiser-nonprofit-customize-controls',
			trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css'
		);
	}
}

// Doing this customizer thang!
Fundraiser_Nonprofit_Customize::get_instance();
