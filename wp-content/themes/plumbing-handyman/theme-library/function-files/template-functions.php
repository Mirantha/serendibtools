<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package plumbing_handyman
 */

function plumbing_handyman_body_classes( $plumbing_handyman_classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$plumbing_handyman_classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$plumbing_handyman_classes[] = 'no-sidebar';
	}

	$plumbing_handyman_classes[] = plumbing_handyman_sidebar_layout();

	return $plumbing_handyman_classes;
}
add_filter( 'body_class', 'plumbing_handyman_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function plumbing_handyman_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'plumbing_handyman_pingback_header' );


/**
 * Get all posts for customizer Post content type.
 */
function plumbing_handyman_get_post_choices() {
	$plumbing_handyman_choices = array( '' => esc_html__( '--Select--', 'plumbing-handyman' ) );
	$plumbing_handyman_args    = array( 'numberposts' => -1 );
	$plumbing_handyman_posts   = get_posts( $plumbing_handyman_args );

	foreach ( $plumbing_handyman_posts as $plumbing_handyman_post ) {
		$plumbing_handyman_id             = $plumbing_handyman_post->ID;
		$plumbing_handyman_title          = $plumbing_handyman_post->post_title;
		$plumbing_handyman_choices[ $plumbing_handyman_id ] = $plumbing_handyman_title;
	}

	return $plumbing_handyman_choices;
}

/**
 * Get all pages for customizer Page content type.
 */
function plumbing_handyman_get_page_choices() {
	$plumbing_handyman_choices = array( '' => esc_html__( '--Select--', 'plumbing-handyman' ) );
	$plumbing_handyman_pages   = get_pages();

	foreach ( $plumbing_handyman_pages as $plumbing_handyman_page ) {
		$plumbing_handyman_choices[ $plumbing_handyman_page->ID ] = $plumbing_handyman_page->post_title;
	}

	return $plumbing_handyman_choices;
}

/**
 * Get all categories for customizer Category content type.
 */
function plumbing_handyman_get_post_cat_choices() {
	$plumbing_handyman_choices = array( '' => esc_html__( '--Select--', 'plumbing-handyman' ) );
	$plumbing_handyman_cats    = get_categories();

	foreach ( $plumbing_handyman_cats as $plumbing_handyman_cat ) {
		$plumbing_handyman_choices[ $plumbing_handyman_cat->term_id ] = $plumbing_handyman_cat->name;
	}

	return $plumbing_handyman_choices;
}

/**
 * Get all donation forms for customizer form content type.
 */
function plumbing_handyman_get_post_donation_form_choices() {
	$plumbing_handyman_choices = array( '' => esc_html__( '--Select--', 'plumbing-handyman' ) );
	$plumbing_handyman_posts   = get_posts(
		array(
			'post_type'   => 'give_forms',
			'numberposts' => -1,
		)
	);
	foreach ( $plumbing_handyman_posts as $plumbing_handyman_post ) {
		$plumbing_handyman_choices[ $plumbing_handyman_post->ID ] = $plumbing_handyman_post->post_title;
	}
	return $plumbing_handyman_choices;
}

if ( ! function_exists( 'plumbing_handyman_excerpt_length' ) ) :
	/**
	 * Excerpt length.
	 */
	function plumbing_handyman_excerpt_length( $plumbing_handyman_length ) {
		if ( is_admin() ) {
			return $plumbing_handyman_length;
		}

		return get_theme_mod( 'plumbing_handyman_excerpt_length', 20 );
	}
endif;
add_filter( 'excerpt_length', 'plumbing_handyman_excerpt_length', 999 );

if ( ! function_exists( 'plumbing_handyman_excerpt_more' ) ) :
	/**
	 * Excerpt more.
	 */
	function plumbing_handyman_excerpt_more( $plumbing_handyman_more ) {
		if ( is_admin() ) {
			return $plumbing_handyman_more;
		}

		return '&hellip;';
	}
endif;
add_filter( 'excerpt_more', 'plumbing_handyman_excerpt_more' );

if ( ! function_exists( 'plumbing_handyman_sidebar_layout' ) ) {
	/**
	 * Get sidebar layout.
	 */
	function plumbing_handyman_sidebar_layout() {
		$plumbing_handyman_sidebar_position      = get_theme_mod( 'plumbing_handyman_sidebar_position', 'right-sidebar' );
		$plumbing_handyman_sidebar_position_post = get_theme_mod( 'plumbing_handyman_post_sidebar_position', 'right-sidebar' );
		$plumbing_handyman_sidebar_position_page = get_theme_mod( 'plumbing_handyman_page_sidebar_position', 'right-sidebar' );

		if ( is_home() ) {
			$plumbing_handyman_sidebar_position = $plumbing_handyman_sidebar_position_post;
		} elseif ( is_page() ) {
			$plumbing_handyman_sidebar_position = $plumbing_handyman_sidebar_position_page;
		}

		return $plumbing_handyman_sidebar_position;
	}
}

if ( ! function_exists( 'plumbing_handyman_is_sidebar_enabled' ) ) {
	/**
	 * Check if sidebar is enabled.
	 */
	function plumbing_handyman_is_sidebar_enabled() {
		$plumbing_handyman_sidebar_position      = get_theme_mod( 'plumbing_handyman_sidebar_position', 'right-sidebar' );
		$plumbing_handyman_sidebar_position_post = get_theme_mod( 'plumbing_handyman_post_sidebar_position', 'right-sidebar' );
		$plumbing_handyman_sidebar_position_page = get_theme_mod( 'plumbing_handyman_page_sidebar_position', 'right-sidebar' );

		$plumbing_handyman_sidebar_enabled = true;
		if ( is_single() || is_archive() || is_search() ) {
			if ( 'no-sidebar' === $plumbing_handyman_sidebar_position ) {
				$plumbing_handyman_sidebar_enabled = false;
			}
		} elseif ( is_home() ) {
			if ( 'no-sidebar' === $plumbing_handyman_sidebar_position || 'no-sidebar' === $plumbing_handyman_sidebar_position_post ) {
				$plumbing_handyman_sidebar_enabled = false;
			}
		} elseif ( is_page() ) {
			if ( 'no-sidebar' === $plumbing_handyman_sidebar_position || 'no-sidebar' === $plumbing_handyman_sidebar_position_page ) {
				$plumbing_handyman_sidebar_enabled = false;
			}
		}
		return $plumbing_handyman_sidebar_enabled;
	}
}

if ( ! function_exists( 'plumbing_handyman_get_homepage_sections ' ) ) {
	/**
	 * Returns homepage sections.
	 */
	function plumbing_handyman_get_homepage_sections() {
		$plumbing_handyman_sections = array(
			'slider'  => esc_html__( 'Slider Section', 'plumbing-handyman' ),
			'about' => esc_html__( 'About Section', 'plumbing-handyman' ),
		);
		return $plumbing_handyman_sections;
	}
}

/**
 * Renders customizer section link
 */
function plumbing_handyman_section_link( $plumbing_handyman_section_id ) {
	$plumbing_handyman_section_name      = str_replace( 'plumbing_handyman_', ' ', $plumbing_handyman_section_id );
	$plumbing_handyman_section_name      = str_replace( '_', ' ', $plumbing_handyman_section_name );
	$plumbing_handyman_starting_notation = '#';
	?>
	<span class="section-link">
		<span class="section-link-title"><?php echo esc_html( $plumbing_handyman_section_name ); ?></span>
	</span>
	<style type="text/css">
		<?php echo $plumbing_handyman_starting_notation . $plumbing_handyman_section_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>:hover .section-link {
			visibility: visible;
		}
	</style>
	<?php
}

/**
 * Adds customizer section link css
 */
function plumbing_handyman_section_link_css() {
	if ( is_customize_preview() ) {
		?>
		<style type="text/css">
			.section-link {
				visibility: hidden;
				background-color: black;
				position: relative;
				top: 80px;
				z-index: 99;
				left: 40px;
				color: #fff;
				text-align: center;
				font-size: 20px;
				border-radius: 10px;
				padding: 20px 10px;
				text-transform: capitalize;
			}

			.section-link-title {
				padding: 0 10px;
			}

			.slider-section {
				position: relative;
			}

			.slider-section .section-link {
				position: absolute;
				top: 100px;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'plumbing_handyman_section_link_css' );

/**
 * Breadcrumb.
 */
function plumbing_handyman_breadcrumb( $plumbing_handyman_args = array() ) {
	if ( ! get_theme_mod( 'plumbing_handyman_enable_breadcrumb', true ) ) {
		return;
	}

	$plumbing_handyman_args = array(
		'show_on_front' => false,
		'show_title'    => true,
		'show_browse'   => false,
	);
	breadcrumb_trail( $plumbing_handyman_args );
}
add_action( 'plumbing_handyman_breadcrumb', 'plumbing_handyman_breadcrumb', 10 );

/**
 * Add separator for breadcrumb trail.
 */
function plumbing_handyman_breadcrumb_trail_print_styles() {
	$plumbing_handyman_breadcrumb_separator = get_theme_mod( 'plumbing_handyman_breadcrumb_separator', '/' );

	$plumbing_handyman_style = '
		.trail-items li::after {
			content: "' . $plumbing_handyman_breadcrumb_separator . '";
		}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	$plumbing_handyman_style = apply_filters( 'plumbing_handyman_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $plumbing_handyman_style ) ) );

	if ( $plumbing_handyman_style ) {
		echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $plumbing_handyman_style . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'plumbing_handyman_breadcrumb_trail_print_styles' );

/**
 * Pagination for archive.
 */
function plumbing_handyman_render_posts_pagination() {
	$plumbing_handyman_is_pagination_enabled = get_theme_mod( 'plumbing_handyman_enable_pagination', true );
	if ( $plumbing_handyman_is_pagination_enabled ) {
		$plumbing_handyman_pagination_type = get_theme_mod( 'plumbing_handyman_pagination_type', 'default' );
		if ( 'default' === $plumbing_handyman_pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'plumbing_handyman_posts_pagination', 'plumbing_handyman_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function plumbing_handyman_render_post_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span>&#10229;</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-title">%title</span> <span>&#10230;</span>',
		)
	);
}
add_action( 'plumbing_handyman_post_navigation', 'plumbing_handyman_render_post_navigation' );

/**
 * Adds footer copyright text.
 */
function plumbing_handyman_output_footer_copyright_content() {
    $plumbing_handyman_theme_data = wp_get_theme();
    $plumbing_handyman_copyright_text = get_theme_mod('plumbing_handyman_footer_copyright_text');

	if (!empty($plumbing_handyman_copyright_text)) {
        $plumbing_handyman_text = $plumbing_handyman_copyright_text;
    } else {

		$plumbing_handyman_default_text = '<a href="'. esc_url(__('https://asterthemes.com/products/plumbing-handyman','plumbing-handyman')) . '" target="_blank"> ' . esc_html($plumbing_handyman_theme_data->get('Name')) . '</a>' . '&nbsp;' . esc_html__('by', 'plumbing-handyman') . '&nbsp;<a target="_blank" href="' . esc_url($plumbing_handyman_theme_data->get('AuthorURI')) . '">' . esc_html(ucwords($plumbing_handyman_theme_data->get('Author'))) . '</a>';
		/* translators: %s: WordPress.org URL */
        $plumbing_handyman_default_text .= sprintf(esc_html__(' | Powered by %s', 'plumbing-handyman'), '<a href="' . esc_url(__('https://wordpress.org/', 'plumbing-handyman')) . '" target="_blank">WordPress</a>. ');

        $plumbing_handyman_text = $plumbing_handyman_default_text;

    }
    ?>
    <span><?php echo wp_kses_post($plumbing_handyman_text); ?></span>
    <?php
}
add_action('plumbing_handyman_footer_copyright', 'plumbing_handyman_output_footer_copyright_content');

/* Footer Social Icons */ 
function plumbing_handyman_footer_social_links() {

    if ( get_theme_mod('plumbing_handyman_enable_footer_icon_section', true) ) {

            ?>
            <div class="socialicons">
				<div class="asterthemes-wrapper">
					<?php if ( get_theme_mod('plumbing_handyman_footer_facebook_link', 'https://www.facebook.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_footer_facebook_link', 'https://www.facebook.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_facebook_icon', 'fab fa-facebook-f')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Facebook', 'plumbing-handyman'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('plumbing_handyman_footer_twitter_link', 'https://x.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_footer_twitter_link', 'https://x.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_twitter_icon', 'fab fa-twitter')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Twitter', 'plumbing-handyman'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('plumbing_handyman_footer_instagram_link', 'https://www.instagram.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_footer_instagram_link', 'https://www.instagram.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_instagram_icon', 'fab fa-instagram')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Instagram', 'plumbing-handyman'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('plumbing_handyman_footer_linkedin_link', 'https://in.linkedin.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_footer_linkedin_link', 'https://in.linkedin.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_linkedin_icon', 'fab fa-linkedin')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Linkedin', 'plumbing-handyman'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('plumbing_handyman_footer_youtube_link', 'https://www.youtube.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('plumbing_handyman_footer_youtube_link', 'https://www.youtube.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('plumbing_handyman_youtube_icon', 'fab fa-youtube')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Youtube', 'plumbing-handyman'); ?></span>
						</a>
					<?php } ?>
				</div>
            </div>
            <?php
    }
}
add_action('wp_footer', 'plumbing_handyman_footer_social_links');

if ( ! function_exists( 'plumbing_handyman_footer_widget' ) ) :
	function plumbing_handyman_footer_widget() {
		$plumbing_handyman_footer_widget_column = get_theme_mod('plumbing_handyman_footer_widget_column','4');

		$plumbing_handyman_column_class = '';
		if ($plumbing_handyman_footer_widget_column == '1') {
			$plumbing_handyman_column_class = 'one-column';
		} elseif ($plumbing_handyman_footer_widget_column == '2') {
			$plumbing_handyman_column_class = 'two-columns';
		} elseif ($plumbing_handyman_footer_widget_column == '3') {
			$plumbing_handyman_column_class = 'three-columns';
		} else {
			$plumbing_handyman_column_class = 'four-columns';
		}
	
		if($plumbing_handyman_footer_widget_column !== ''): 
		?>
		<div class="dt_footer-widgets <?php echo esc_attr($plumbing_handyman_column_class); ?> wow bounceInUp delay-1000" data-wow-duration="2s">
			<div class="footer-widgets-column">
				<?php
				$footer_widgets_active = false;

				// Loop to check if any footer widget is active
				for ($plumbing_handyman_i = 1; $plumbing_handyman_i <= $plumbing_handyman_footer_widget_column; $plumbing_handyman_i++) {
					if (is_active_sidebar('footer-widget-' . $plumbing_handyman_i)) {
						$footer_widgets_active = true;
						break;
					}
				}

				if ($footer_widgets_active) {
					// Display active footer widgets
					for ($plumbing_handyman_i = 1; $plumbing_handyman_i <= $plumbing_handyman_footer_widget_column; $plumbing_handyman_i++) {
						if (is_active_sidebar('footer-widget-' . $plumbing_handyman_i)) : ?>
							<div class="footer-one-column">
								<?php dynamic_sidebar('footer-widget-' . $plumbing_handyman_i); ?>
							</div>
						<?php endif;
					}
				} else {
				?>
				<div class="footer-one-column default-widgets">
					<aside id="search-2" class="widget widget_search default_footer_search">
						<div class="widget-header">
							<h4 class="widget-title"><?php esc_html_e('Search Here', 'plumbing-handyman'); ?></h4>
						</div>
						<?php get_search_form(); ?>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-posts-2" class="widget widget_recent_entries">
						<h2 class="widget-title"><?php esc_html_e('Recent Posts', 'plumbing-handyman'); ?></h2>
						<ul>
							<?php
							$recent_posts = wp_get_recent_posts(array(
								'numberposts' => 5,
								'post_status' => 'publish',
							));
							foreach ($recent_posts as $post) {
								echo '<li><a href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
							}
							wp_reset_query();
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-comments-2" class="widget widget_recent_comments">
						<h2 class="widget-title"><?php esc_html_e('Recent Comments', 'plumbing-handyman'); ?></h2>
						<ul>
							<?php
							$recent_comments = get_comments(array(
								'number' => 5,
								'status' => 'approve',
							));
							foreach ($recent_comments as $comment) {
								echo '<li><a href="' . esc_url(get_comment_link($comment)) . '">' .
									/* translators: %s: details. */
									sprintf(esc_html__('Comment on %s', 'plumbing-handyman'), get_the_title($comment->comment_post_ID)) .
									'</a></li>';
							}
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'plumbing-handyman'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'plumbing-handyman'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
		endif;
	}
	endif;
add_action( 'plumbing_handyman_footer_widget', 'plumbing_handyman_footer_widget' );


function plumbing_handyman_footer_text_transform_css() {
    $plumbing_handyman_footer_text_transform = get_theme_mod('footer_text_transform', 'none');
    ?>
    <style type="text/css">
        .site-footer h4,footer#colophon h2.wp-block-heading,footer#colophon .widgettitle,footer#colophon .widget-title {
            text-transform: <?php echo esc_html($plumbing_handyman_footer_text_transform); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'plumbing_handyman_footer_text_transform_css');


/**
 * GET START FUNCTION
 */

 function plumbing_handyman_getpage_css($hook) {
	wp_enqueue_script( 'plumbing-handyman-admin-script', get_template_directory_uri() . '/resource/js/plumbing-handyman-admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script( 'plumbing-handyman-admin-script', 'plumbing_handyman_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
    wp_enqueue_style( 'plumbing-handyman-notice-style', get_template_directory_uri() . '/resource/css/notice.css' );
}

add_action( 'admin_enqueue_scripts', 'plumbing_handyman_getpage_css' );

add_action('wp_ajax_plumbing_handyman_dismissable_notice', 'plumbing_handyman_dismissable_notice');
function plumbing_handyman_switch_theme() {
    delete_user_meta(get_current_user_id(), 'plumbing_handyman_dismissable_notice');
}
add_action('after_switch_theme', 'plumbing_handyman_switch_theme');
function plumbing_handyman_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'plumbing_handyman_dismissable_notice', true);
    die();
}

function plumbing_handyman_deprecated_hook_admin_notice() {
    global $pagenow;
    
    // Check if the current page is the one where you don't want the notice to appear
    if ( $pagenow === 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] === 'plumbing-handyman-getting-started' ) {
        return;
    }

    $dismissed = get_user_meta( get_current_user_id(), 'plumbing_handyman_dismissable_notice', true );
    if ( !$dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="at-admin-content" >
                <h2><?php esc_html_e('Welcome to Plumbing Handyman', 'plumbing-handyman'); ?></h2>
                <p><?php _e('Explore the features of our Pro Theme and take your Plumbing Handyman journey to the next level.', 'plumbing-handyman'); ?></p>
                <p ><?php _e('Get Started With Theme By Clicking On Getting Started.', 'plumbing-handyman'); ?><p>
                <div style="display: flex; justify-content: center; align-items:center; flex-wrap: wrap; gap: 5px">
                    <a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=plumbing-handyman-getting-started' )); ?>"><?php esc_html_e( 'Get started', 'plumbing-handyman' ) ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://demo.asterthemes.com/plumbing-handyman/"><?php esc_html_e('View Demo', 'plumbing-handyman') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( PLUMBING_HANDYMAN_PREMIUM_PAGE ); ?>"><?php esc_html_e('Buy Now', 'plumbing-handyman') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( PLUMBING_HANDYMAN_BUNDLE_PAGE ); ?>"><?php esc_html_e('Get Bundle', 'plumbing-handyman') ?></a>
                </div>
            </div>
            <div class="at-admin-image">
                <img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
        </div>
    <?php }
}
add_action( 'admin_notices', 'plumbing_handyman_deprecated_hook_admin_notice' );


//Admin Notice For Getstart
function plumbing_handyman_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}