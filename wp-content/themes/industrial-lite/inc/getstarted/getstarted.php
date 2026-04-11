<?php
/* Add to Dashboard main menu */
function industrial_lite_dashboard_menu() {
    add_menu_page(
        esc_html__( 'Industrial Lite', 'industrial-lite' ), // Page title
        esc_html__( 'Industrial Lite', 'industrial-lite' ), // Menu title
        'manage_options',                            // Capability
        'industrial_lite_guide',                        // Menu slug
        'industrial_lite_mostrar_guide',                // Callback
        get_template_directory_uri() . '/inc/getstarted/images/menu-icon.svg', // Image icon
        59                                           // Position
    );
}
add_action( 'admin_menu', 'industrial_lite_dashboard_menu' );

// Add a Custom CSS file to WP Admin Area
function industrial_lite_admin_theme_style() {
   wp_enqueue_style('industrial-lite-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstarted/getstarted.css');
   wp_enqueue_script('industrial-lite-tabs', esc_url(get_template_directory_uri()) . '/inc/getstarted/js/tab.js');

   // Admin notice code START
	wp_register_script('industrial-lite-notice', esc_url(get_template_directory_uri()) . '/inc/getstarted/js/notice.js', array('jquery'), time(), true);
	wp_enqueue_script('industrial-lite-notice');
	// Admin notice code END
}
add_action('admin_enqueue_scripts', 'industrial_lite_admin_theme_style');

//guidline for about theme
function industrial_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$industrial_lite_theme = wp_get_theme( 'industrial-lite' );
?>

<div class="wrapper-info">
	<div class="tab-sec">
    	
    	<div class="tab">
    		<button class="tablinks" onclick="industrial_lite_open_tab(event, 'theme_offer')"><?php esc_html_e( 'Demo Import', 'industrial-lite' ); ?></button>
			<button class="tablinks" onclick="industrial_lite_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'industrial-lite' ); ?></button>
			<button class="tablinks" onclick="industrial_lite_open_tab(event, 'theme_pro')"><?php esc_html_e( 'Get Premium', 'industrial-lite' ); ?></button>
  			<button class="tablinks" onclick="industrial_lite_open_tab(event, 'free_pro')"><?php esc_html_e( 'Free VS Premium', 'industrial-lite' ); ?></button>
  			<button class="tablinks" onclick="industrial_lite_open_tab(event, 'get_bundle')"><?php esc_html_e( 'WP Theme Bundle', 'industrial-lite' ); ?></button>
		</div>

		<?php 
			$industrial_lite_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$industrial_lite_plugin_custom_css ='display: block';
			}
		?>

		<div id="theme_offer" class="tabcontent open">
			<div class="demo-content">
				<div class="demo-text">
					<?php 
					/* Get Started. */ 
					require get_parent_theme_file_path( '/inc/getstarted/demo-content.php' );
				 	?>
				</div>
			 	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/responsive.png" alt="" class="resp-img" />
			</div> 	
		</div>

		<div id="lite_theme" class="tabcontent">
			<div class="lite-theme-tab" style="<?php echo esc_attr($industrial_lite_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Industrial Lite', 'industrial-lite' ); ?></h3>
				<hr class="h3hr">
				<p><?php esc_html_e('Industrial Lite is an industry driven theme and is a fit theme for any kind of industry. It is a good theme for factories, real estate agency, builder, house broker, plumber, electrician, concrete, lathe machine, electric motor works, industrial iron works, trouble shooting and repairing machinery, factory machines, medical equipment, accountants, build market, construction equipment, laboratory equipment, milling, machining, grinding, material plant, surface polishing, carpenter, contractor, welding, Agriculture industry,Manufacturing, Construction, Engineering, Factory, Industry, property inclusion, solar power plants, wind energy, Pharmaceutical Industry, Aerospace Industry, plumbing, Computer Industry, Telecommunication industry, industries and manufacturing areas. In case of interest any type of business related to the industry this theme is of immense suitability and it has some of the mesmerizing features like minimal ad elegance plus it is totally responsive with Bootstrap framework as well as multipurpose nature. It is also accompanied with the personalization as well as the customization options making it an apt choice for any kind of expansion in the heavy engineering business. Industrial lite is a WP theme with the neat and clean looks and apart from that, it is categorised as a core professional theme that is good for not only big factories but small factories as well. It has many features like it is fully customizable, it has four columns layout, Full Width Template, Custom Logo, post formats and many more. It is good for Electronic Business, Power, Rail Business, Petroleum, workshop, garage, painter, Railway Construction, Metallurgical Corporation, infrastructure companies, Industrial cleaning, mechanic, repair, renovation, industrial roofing, flooring services Gas, modern industry, oil industry, metallurgy, cement, furtniture, heavy equipments, refurbishment, installation, spare parts, craftsman, furnishings, handyman, maintenance solutions, manufacture, factory, laboratory, home remodeling, building, plastering, partitioning, celings, architecture, interior work, Plants construction. Industrial lite contains all the necessary info sections where you can share the key points about your company or business and give your potential customers an idea of why you’re the best in the market.','industrial-lite'); ?></p>
				<div class="lite-info">
					<div class="col-left-inner">
				  		<h4><?php esc_html_e( 'Theme Documentation', 'industrial-lite' ); ?></h4>
						<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'industrial-lite' ); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( INDUSTRIAL_LITE_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'industrial-lite' ); ?></a>
						</div>
						<hr>
						<h4><?php esc_html_e('Theme Customizer', 'industrial-lite'); ?></h4>
						<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'industrial-lite'); ?></p>
						<div class="info-link">
							<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'industrial-lite'); ?></a>
						</div>
						<hr>
						<h4><?php esc_html_e('Having Trouble, Need Support?', 'industrial-lite'); ?></h4>
						<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'industrial-lite'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( INDUSTRIAL_LITE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'industrial-lite'); ?></a>
						</div>
						<hr>
						<h4><?php esc_html_e('Reviews & Testimonials', 'industrial-lite'); ?></h4>
						<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'industrial-lite'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( INDUSTRIAL_LITE_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'industrial-lite'); ?></a>
						</div>

						<div class="link-customizer">
							<h4><?php esc_html_e( 'Link to customizer', 'industrial-lite' ); ?></h4>
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','industrial-lite'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-category"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Header','industrial-lite'); ?></a>
									</div>
								</div>

								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=industrial_lite_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Settings','industrial-lite'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-category"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=industrial_lite_services_section') ); ?>" target="_blank"><?php esc_html_e('Services Settings','industrial-lite'); ?></a>
									</div>
								</div>
							
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-category"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=industrial_lite_right_sidebar_section') ); ?>" target="_blank"><?php esc_html_e('Right Sidebar Section','industrial-lite'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','industrial-lite'); ?></a>
									</div>
								</div>
								
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=industrial_lite_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','industrial-lite'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=industrial_lite_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','industrial-lite'); ?></a>
									</div>
								</div>

								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','industrial-lite'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=industrial_lite_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','industrial-lite'); ?></a>
									</div>
								</div>
							</div>
						</div>
				  	</div>
					<div class="col-right-inner">
						<h4 class="page-template"><?php esc_html_e('How to set up Home Page Template','industrial-lite'); ?></h4>
						<p><?php esc_html_e('Follow these instructions to setup Home page.','industrial-lite'); ?></p>
	                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','industrial-lite'); ?></span><?php esc_html_e(' Go to ','industrial-lite'); ?>
						  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','industrial-lite'); ?></b></p>
	                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','industrial-lite'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/home-page-template.png" alt="" />
	                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','industrial-lite'); ?></span><?php esc_html_e(' Go to ','industrial-lite'); ?>
						  	<b><?php esc_html_e(' Settings >> Reading ','industrial-lite'); ?></b></p>
					  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','industrial-lite'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/set-front-page.png" alt="" />
	                  	<p><?php esc_html_e(' Once you are done with setup, then follow the','industrial-lite'); ?> <a class="doc-links" href="<?php echo esc_url( INDUSTRIAL_LITE_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation','industrial-lite'); ?></a></p>
				  	</div>

				</div>
			  	
			</div>
		</div>

		<div id="theme_pro" class="tabcontent">		  	
			<div class="pro-info">
				<div class="col-left-pro">
					<h3><?php esc_html_e( 'Premium Theme Information', 'industrial-lite' ); ?></h3>
					<hr class="h3hr">
			    	<p><?php esc_html_e('Industrial WordPress theme is a theme of premium order and is categorized as the manufacturing WordPress theme good for the factories as well as industries. It is armed with some special features like minimal, elegant, sophisticated, clean, retina ready, user-friendly apart from having CTA[ call to action] button as well as Bootstrap framework making it good for any kind of business related to manufacturing and industry. Industrial WordPress theme is professional with personalization options apart from being SEO friendly with the optimized codes. It has fast page load time as well as secure and clean code making it a perfect choice for Small Factory, Company, Electronic Business, Power, Rail Business, Petroleum, Gas, Plants construction, and manufacturing. Industrial comes with 3 different homepages with a unique design, containing all the necessary info sections where you can share the key points about your company or business and give your potential customers an idea of why you are the best in the market.','industrial-lite'); ?></p>
			    	<div class="pro-links">
				    	<a href="<?php echo esc_url( INDUSTRIAL_LITE_LIVE_DEMO ); ?>" target="_blank" class="demo-btn"><?php esc_html_e('Live Demo', 'industrial-lite'); ?></a>
						<a href="<?php echo esc_url( INDUSTRIAL_LITE_BUY_NOW ); ?>" target="_blank" class="prem-btn"><?php esc_html_e('Buy Premium', 'industrial-lite'); ?></a>
						<a href="<?php echo esc_url( INDUSTRIAL_LITE_PRO_DOC ); ?>" target="_blank" class="doc-btn"><?php esc_html_e('Documentation', 'industrial-lite'); ?></a>
					</div>
			    </div>
			    <div class="col-right-pro scroll-image-wrapper">
			    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/pro-theme.jpg" alt="" class="pro-img" />		    	
			    </div>
			</div>		    
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'industrial-lite' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th> <?php esc_html_e('Features', 'industrial-lite'); ?></th>
								<th><?php esc_html_e('Free Themes', 'industrial-lite'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'industrial-lite'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Banner Settings', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'industrial-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'industrial-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('10', 'industrial-lite'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'industrial-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'industrial-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'industrial-lite'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'industrial-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'industrial-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('13', 'industrial-lite'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template / Support Templates', 'industrial-lite'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'industrial-lite'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'industrial-lite'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'industrial-lite'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'industrial-lite'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Left/Right Sidebar)', 'industrial-lite'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Video Gallery', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Industrial Lite ', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Detail Services', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('About Business Page', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Team Member Page', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Project Description Page', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support Page', 'industrial-lite'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( INDUSTRIAL_LITE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'industrial-lite'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="get_bundle" class="tabcontent">	
			<div class="bundle-info">
				<div class="col-left-pro">
			   		<h3><?php esc_html_e( 'WP Theme Bundle', 'industrial-lite' ); ?></h3>
			   		<hr class="h3hr">
			    	<p><?php esc_html_e('Enhance your website effortlessly with our WP Theme Bundle. Get access to 400+ premium WordPress themes and 5+ powerful plugins, all designed to meet diverse business needs. Enjoy seamless integration with any plugins, ultimate customization flexibility, and regular updates to keep your site current and secure. Plus, benefit from our dedicated customer support, ensuring a smooth and professional web experience.','industrial-lite'); ?></p>
			    	<div class="feature">
			    		<h4><?php esc_html_e( 'Features:', 'industrial-lite' ); ?></h4>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/tick.png" alt="" /><?php esc_html_e('400+ Premium Themes & 5+ Plugins.', 'industrial-lite'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/tick.png" alt="" /><?php esc_html_e('Seamless Integration.', 'industrial-lite'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/tick.png" alt="" /><?php esc_html_e('Customization Flexibility.', 'industrial-lite'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/tick.png" alt="" /><?php esc_html_e('Regular Updates.', 'industrial-lite'); ?></p>
			    		<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/tick.png" alt="" /><?php esc_html_e('Dedicated Support.', 'industrial-lite'); ?></p>
			    	</div>
			    	<p><?php esc_html_e('Upgrade now and give your website the professional edge it deserves, all at an unbeatable price of $99!', 'industrial-lite'); ?></p>
			    	<div class="pro-links">
						<a href="<?php echo esc_url( INDUSTRIAL_LITE_THEME_BUNDLE_BUY_NOW ); ?>" target="_blank" class="bundle-buy"><?php esc_html_e('Get Bundle', 'industrial-lite'); ?></a>
						<a href="<?php echo esc_url( INDUSTRIAL_LITE_THEME_BUNDLE_DOC ); ?>" target="_blank" class="bundle-doc"><?php esc_html_e('Documentation', 'industrial-lite'); ?></a>
					</div>
			   	</div>
			   	<div class="col-right-pro scroll-image-wrapper">
			    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/bundle.jpg" alt="" />
			   	</div>
			</div>	  	
		   			    
		</div>
	</div>
	<div class="coupen-code-section">
		<div class="sshot-section">
			<div class="sshot-inner">
				<h2><?php esc_html_e( 'Welcome To Industrial Lite', 'industrial-lite' ); ?></h2>
				<div class="on-pro">
					<span class="version"><?php esc_html_e( 'Version', 'industrial-lite' ); ?>: <?php echo esc_html($industrial_lite_theme['Version']);?></span>
					<span class="coupon-code"><?php esc_html_e('Get 20% Of On Pro Theme-Use Code: ','industrial-lite'); ?><span class="code-highlight"><?php esc_html_e('VWPRO20','industrial-lite'); ?></span>
				</div>
		    	<p><?php esc_html_e('All Our Wordpress Themes Are Modern, Minimalist, 100% Responsive, Seo-Friendly,Feature-Rich, And Multipurpose That Best Suit Designers, Bloggers And Other Professionals Who Are Working In The Creative Fields.','industrial-lite'); ?></p>
		    	<div class="btn-section">
			    	<div class="proo-links">
				    	<a href="<?php echo esc_url( INDUSTRIAL_LITE_LIVE_DEMO ); ?>" target="_blank" class="demo-btn"><?php esc_html_e('Live Demo', 'industrial-lite'); ?></a>
						<a href="<?php echo esc_url( INDUSTRIAL_LITE_BUY_NOW ); ?>" target="_blank" class="prem-btn"><?php esc_html_e('Buy Premium', 'industrial-lite'); ?></a>
						<a href="<?php echo esc_url( INDUSTRIAL_LITE_PRO_DOC ); ?>" target="_blank" class="doc-btn"><?php esc_html_e('Documentation', 'industrial-lite'); ?></a>
						
					</div>
			    	
			    </div>
			</div>
	    	<div class="bundle-banner">
	    		<div class="bundle-img">
	    			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/bundle-notice.png" alt="" />
	    		</div>
	    		<div class="bundle-text">
		  			<h2><?php esc_html_e('WP THEME BUNDLE','industrial-lite'); ?></h2>
					<h4><?php esc_html_e('Get Access to 400+ Premium WordPress Themes At Just $99','industrial-lite'); ?></h4>
					<div class="bundle-button">
			  			<a href="<?php echo esc_url( 'https://www.vwthemes.com/discount/FREEBREF?redirect=/products/wp-theme-bundle'); ?>" target="_blank"><?php esc_html_e('Get 10% OFF On Bundle', 'industrial-lite'); ?></a>
			  		</div>
		  		</div>
		  		
	    	</div>
	    </div>
	    <div class="coupen-section">
	    	<div class="logo-section">
			  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
		  	</div>
		  	<div class="logo-right">	
		  		<div class="logo-text">
		  			<h2><?php esc_html_e('GET PRO','industrial-lite'); ?></h2>
					<h4><?php esc_html_e('20% Off','industrial-lite'); ?></h4>
		  		</div>						
			</div>
	    </div>
	</div>
      
</div>
<?php } ?>