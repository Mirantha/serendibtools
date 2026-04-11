<div class="theme-offer">
	<?php 
        // Check if the demo import has been completed
        $industrial_lite_demo_import_completed = get_option('industrial_lite_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($industrial_lite_demo_import_completed) {
        echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'industrial-lite') . '</p>';
        echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'industrial-lite') . '</a></span>';
        echo '<span><a href="'. esc_url(admin_url('customize.php') ) .'" class="button button-primary demo-btn" target=_blank>'. esc_html__( 'Customize Your Site', 'industrial-lite' ) .'</a></span>';
        echo '<span><a href="'. esc_url( 'https://preview.vwthemesdemo.com/docs/free-vw-industrial-lite/' ) .'" class="button button-primary doc-btn" target=_blank>'. esc_html__( 'Free Theme Documentation', 'industrial-lite' ) .'</a></span>';
        }

		//POST and update the customizer and other related data
        if (isset($_POST['submit'])) {

        // Check if ibtana visual editor is installed and activated
        if (!is_plugin_active('ibtana-visual-editor/plugin.php')) {
          // Install the plugin if it doesn't exist
          $industrial_lite_plugin_slug = 'ibtana-visual-editor';
          $industrial_lite_plugin_file = 'ibtana-visual-editor/plugin.php';

          // Check if plugin is installed
          $industrial_lite_installed_plugins = get_plugins();
          if (!isset($industrial_lite_installed_plugins[$industrial_lite_plugin_file])) {
              include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
              include_once(ABSPATH . 'wp-admin/includes/file.php');
              include_once(ABSPATH . 'wp-admin/includes/misc.php');
              include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

              // Install the plugin
              $industrial_lite_upgrader = new Plugin_Upgrader();
              $industrial_lite_upgrader->install('https://downloads.wordpress.org/plugin/ibtana-visual-editor.latest-stable.zip');
          }
          // Activate the plugin
          activate_plugin($industrial_lite_plugin_file);
        }    

            // ------- Create Nav Menu --------
            $industrial_lite_menuname = 'Main Menus';
            $industrial_lite_bpmenulocation = 'primary';
            $industrial_lite_menu_exists = wp_get_nav_menu_object($industrial_lite_menuname);

            if (!$industrial_lite_menu_exists) {
                $industrial_lite_menu_id = wp_create_nav_menu($industrial_lite_menuname);

                // Create Home Page
                $industrial_lite_home_title = 'Home';
                $industrial_lite_home = array(
                    'post_type' => 'page',
                    'post_title' => $industrial_lite_home_title,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'home'
                );
                $industrial_lite_home_id = wp_insert_post($industrial_lite_home);
                // Assign Home Page Template
                add_post_meta($industrial_lite_home_id, '_wp_page_template', 'page-template/custom-home-page.php');
                // Update options to set Home Page as the front page
                update_option('page_on_front', $industrial_lite_home_id);
                update_option('show_on_front', 'page');
                // Add Home Page to Menu
                wp_update_nav_menu_item($industrial_lite_menu_id, 0, array(
                    'menu-item-title' => __('Home', 'industrial-lite'),
                    'menu-item-classes' => 'home',
                    'menu-item-url' => home_url('/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $industrial_lite_home_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create About Us Page with Dummy Content
                $industrial_lite_about_title = 'About Us';
                $industrial_lite_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $industrial_lite_about = array(
                    'post_type' => 'page',
                    'post_title' => $industrial_lite_about_title,
                    'post_content' => $industrial_lite_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $industrial_lite_about_id = wp_insert_post($industrial_lite_about);
                // Add About Us Page to Menu
                wp_update_nav_menu_item($industrial_lite_menu_id, 0, array(
                    'menu-item-title' => __('About Us', 'industrial-lite'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $industrial_lite_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Services Page with Dummy Content
                $industrial_lite_about_title = 'Services';
                $industrial_lite_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $industrial_lite_about = array(
                    'post_type' => 'page',
                    'post_title' => $industrial_lite_about_title,
                    'post_content' => $industrial_lite_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $industrial_lite_about_id = wp_insert_post($industrial_lite_about);
                // Add Services Page to Menu
                wp_update_nav_menu_item($industrial_lite_menu_id, 0, array(
                    'menu-item-title' => __('Services', 'industrial-lite'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $industrial_lite_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Projects Page with Dummy Content
                $industrial_lite_about_title = 'Projects';
                $industrial_lite_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $industrial_lite_about = array(
                    'post_type' => 'page',
                    'post_title' => $industrial_lite_about_title,
                    'post_content' => $industrial_lite_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $industrial_lite_about_id = wp_insert_post($industrial_lite_about);
                // Add Projects Page to Menu
                wp_update_nav_menu_item($industrial_lite_menu_id, 0, array(
                    'menu-item-title' => __('Projects', 'industrial-lite'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $industrial_lite_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create News Page with Dummy Content
                $industrial_lite_pages_title = 'News';
                $industrial_lite_pages_content = '
                <p>Explore all the pages we have on our website. Find information about our services, company, and more.</p>

                 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                  All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $industrial_lite_pages = array(
                    'post_type' => 'page',
                    'post_title' => $industrial_lite_pages_title,
                    'post_content' => $industrial_lite_pages_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'pages'
                );
                $industrial_lite_pages_id = wp_insert_post($industrial_lite_pages);
                // Add News Page to Menu
                wp_update_nav_menu_item($industrial_lite_menu_id, 0, array(
                    'menu-item-title' => __('News', 'industrial-lite'),
                    'menu-item-classes' => 'pages',
                    'menu-item-url' => home_url('/pages/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $industrial_lite_pages_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Contact Page with Dummy Content
                $industrial_lite_about_title = 'Contact';
                $industrial_lite_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $industrial_lite_about = array(
                    'post_type' => 'page',
                    'post_title' => $industrial_lite_about_title,
                    'post_content' => $industrial_lite_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $industrial_lite_about_id = wp_insert_post($industrial_lite_about);
                // Add Contact Page to Menu
                wp_update_nav_menu_item($industrial_lite_menu_id, 0, array(
                    'menu-item-title' => __('Contact', 'industrial-lite'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $industrial_lite_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Set the menu location if it's not already set
                if (!has_nav_menu($industrial_lite_bpmenulocation)) {
                    $locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
                    if (empty($locations)) {
                        $locations = array();
                    }
                    $locations[$industrial_lite_bpmenulocation] = $industrial_lite_menu_id;
                    set_theme_mod('nav_menu_locations', $locations);
                }
                
        }
          
            // Set the demo import completion flag
    		update_option('industrial_lite_demo_import_completed', true);
    		// Display success message and "View Site" button
    		echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'industrial-lite') . '</p>';
    		echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'industrial-lite') . '</a></span>';
            echo '<span><a href="'. esc_url(admin_url('customize.php') ) .'" class="button button-primary demo-btn" target=_blank>'. esc_html__( 'Customize Your Site', 'industrial-lite' ) .'</a></span>';
            echo '<span><a href="'. esc_url( 'https://preview.vwthemesdemo.com/docs/free-vw-industrial-lite/' ) .'" class="button button-primary doc-btn" target=_blank>'. esc_html__( 'Free Theme Documentation', 'industrial-lite' ) .'</a></span>';
            //end 


            // Top Bar //
            set_theme_mod( 'industrial_lite_location_icon', 'fas fa-map-marker-alt' );  
            set_theme_mod( 'industrial_lite_location', '123 lorem ipsum is a dummy text, USA' );  
            set_theme_mod( 'industrial_lite_phone_icon', 'fas fa-phone' );
            set_theme_mod( 'industrial_lite_phone_number', '+00 1234 567 890' );  
            set_theme_mod( 'industrial_lite_email_address_icon', 'fas fa-envelope' );  
            set_theme_mod( 'industrial_lite_email_address', 'example@gmail.com' );  
            set_theme_mod( 'industrial_lite_top_btn_url', '#' );  
            set_theme_mod( 'industrial_lite_top_btn_text', 'GET A QUOTE' );  
            

            // slider section start // 
            set_theme_mod( 'industrial_lite_slider_button_text', 'Read More' );
            set_theme_mod( 'industrial_lite_slider_button_link', '#' );
            
            for($industrial_lite_i=1;$industrial_lite_i<=4;$industrial_lite_i++){
               $industrial_lite_slider_title = 'We are World-Classs Designers and Industrial Engineers.';
               $industrial_lite_slider_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam';
                  // Create post object
               $my_post = array(
               'post_title'    => wp_strip_all_tags( $industrial_lite_slider_title ),
               'post_content'  => $industrial_lite_slider_content,
               'post_status'   => 'publish',
               'post_type'     => 'page',
               );

               // Insert the post into the database
               $industrial_lite_post_id = wp_insert_post( $my_post );

               if ($industrial_lite_post_id) {
                 // Set the theme mod for the slider page
                 set_theme_mod('industrial_lite_slider_page' . $industrial_lite_i, $industrial_lite_post_id);

                  $industrial_lite_image_url = get_template_directory_uri().'/assets/images/slider'.$industrial_lite_i.'.png';

                $industrial_lite_image_id = media_sideload_image($industrial_lite_image_url, $industrial_lite_post_id, null, 'id');

                    if (!is_wp_error($industrial_lite_image_id)) {
                        // Set the downloaded image as the post's featured image
                        set_post_thumbnail($industrial_lite_post_id, $industrial_lite_image_id);
                    }
                }
            }    
            

            // Our Services Section //
            set_theme_mod( 'industrial_lite_services_title_icon', 'fas fa-industry' );
            set_theme_mod( 'industrial_lite_section_title', 'SERVICES WE PROVIDE' );
            set_theme_mod( 'industrial_lite_section_small_title', 'OUR SERVICES' );

            set_theme_mod('industrial_lite_our_services', 'category1');

            // Define post category names and post titles
            $industrial_lite_category_names = array('category1', 'category2');
            $industrial_lite_title_array = array(
                array("SERVICE TITLE 1", "SERVICE TITLE 2", "SERVICE TITLE 3"),
                array("SERVICE TITLE 2", "SERVICE TITLE 3", "SERVICE TITLE 1"),
                
            );

            foreach ($industrial_lite_category_names as $industrial_lite_index => $industrial_lite_category_name) {
                // Create or retrieve the post category term ID
                $industrial_lite_term = term_exists($industrial_lite_category_name, 'category');
                if ($industrial_lite_term === 0 || $industrial_lite_term === null) {
                    // If the term does not exist, create it
                    $industrial_lite_term = wp_insert_term($industrial_lite_category_name, 'category');
                }
                if (is_wp_error($industrial_lite_term)) {
                    error_log('Error creating category: ' . $industrial_lite_term->get_error_message());
                    continue; // Skip to the next iteration if category creation fails
                }

                for ($industrial_lite_i = 0; $industrial_lite_i < 3; $industrial_lite_i++) {
                    // Create post content
                    $industrial_lite_title = $industrial_lite_title_array[$industrial_lite_index][$industrial_lite_i];
                    $industrial_lite_content = 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';

                    // Create post post object
                    $industrial_lite_my_post = array(
                        'post_title'    => wp_strip_all_tags($industrial_lite_title),
                        'post_content'  => $industrial_lite_content,
                        'post_status'   => 'publish',
                        'post_type'     => 'post', // Post type set to 'post'
                    );

                    // Insert the post into the database
                    $industrial_lite_post_id = wp_insert_post($industrial_lite_my_post);

                    if (is_wp_error($industrial_lite_post_id)) {
                        error_log('Error creating post: ' . $industrial_lite_post_id->get_error_message());
                        continue; // Skip to the next post if creation fails
                    }

                    // Assign the category to the post
                    wp_set_post_categories($industrial_lite_post_id, array((int)$industrial_lite_term['term_id']));

                    // Handle the featured image using media_sideload_image
                    $industrial_lite_image_url = get_template_directory_uri() . '/assets/images/services' . ($industrial_lite_i + 1) . '.png';
                    $industrial_lite_image_id = media_sideload_image($industrial_lite_image_url, $industrial_lite_post_id, null, 'id');

                    if (is_wp_error($industrial_lite_image_id)) {
                        error_log('Error downloading image: ' . $industrial_lite_image_id->get_error_message());
                        continue; // Skip to the next post if image download fails
                    }
                    // Assign featured image to post
                    set_post_thumbnail($industrial_lite_post_id, $industrial_lite_image_id);
                }
            }   
            //Copyright Text
            set_theme_mod( 'industrial_lite_footer_text', 'By VWThemes' );  
     
        }
    ?>
  
	
    <form action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php?page=industrial_lite_guide" method="POST" onsubmit="return validate(this);">
        <?php if (!get_option('industrial_lite_demo_import_completed')) : ?>
            <form method="post">
                <p class="run-import-text"><?php esc_html_e('Click On The Below Run Importer Button To Import Demo Content Of Industrial Lite', 'industrial-lite'); ?></p>
                <p><?php esc_html_e('Please back up your website if it’s already live with data. This importer will overwrite your existing settings with the new customizer values for Industrial Lite', 'industrial-lite'); ?></p>
                <input class="run-import" type="submit" name="submit" value="<?php esc_attr_e('Run Importer', 'industrial-lite'); ?>" class="button button-primary button-large">
            </form>     
        <?php endif; ?>
        <div id="spinner" style="display:none;">         
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/spinner.png" alt="" />
        </div>
    </form>
    <script type="text/javascript">
        function validate(form) {
            if (confirm("Do you really want to import the theme demo content?")) {
                // Show the spinner
                document.getElementById('spinner').style.display = 'block';
                // Allow the form to be submitted
                return true;
            } 
            else {
                return false;
            }
        }
    </script>
</div>

