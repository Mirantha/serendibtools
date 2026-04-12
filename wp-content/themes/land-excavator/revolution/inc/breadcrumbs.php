<?php
/**
 * Breadcrumb Trail - A breadcrumb menu script for WordPress.
 *
 * Breadcrumb Trail is a script for showing a breadcrumb trail for any type of page.  It tries to
 * anticipate any type of structure and display the best possible trail that matches your site's
 * permalink structure.  While not perfect, it attempts to fill in the gaps left by many other
 * breadcrumb scripts.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package   BreadcrumbTrail
 * @version   1.1.0
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2008 - 2017, Justin Tadlock
 * @link      https://themehybrid.com/plugins/breadcrumb-trail
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Land_Excavator_Breadcrumb_Trail class,
 * which should be used in theme templates.
 *
 * @since  0.1.0
 * @access public
 * @param  array $land_excavator_args Arguments to pass to Land_Excavator_Breadcrumb_Trail.
 * @return void
 */
function land_excavator_breadcrumbs_trail( $land_excavator_args = array() ) {

    $land_excavator_breadcrumb = apply_filters( 'land_excavator_breadcrumbs_trail_object', null, $land_excavator_args );

    if ( ! is_object( $land_excavator_breadcrumb ) )
        $land_excavator_breadcrumb = new Land_Excavator_Breadcrumb_Trail( $land_excavator_args );

    return $land_excavator_breadcrumb->trail();
}

/**
 * Creates a breadcrumbs menu for the site based on the current page that's being viewed by the user.
 *
 * @since  0.6.0
 * @access public
 */
class Land_Excavator_Breadcrumb_Trail {

    /**
     * Array of items belonging to the current breadcrumb trail.
     *
     * @since  0.1.0
     * @access public
     * @var    array
     */
    public $items = array();

    /**
     * Arguments used to build the breadcrumb trail.
     *
     * @since  0.1.0
     * @access public
     * @var    array
     */
    public $land_excavator_args = array();

    /**
     * Array of text labels.
     *
     * @since  1.0.0
     * @access public
     * @var    array
     */
    public $land_excavator_labels = array();

    /**
     * Array of post types (key) and taxonomies (value) to use for single post views.
     *
     * @since  1.0.0
     * @access public
     * @var    array
     */
    public $land_excavator_post_taxonomy = array();

    public $labels;
    public $post_taxonomy;
	public $args;

    /* ====== Magic Methods ====== */

    /**
     * Magic method to use in case someone tries to output the layout object as a string.
     * We'll just return the trail HTML.
     *
     * @since  1.0.0
     * @access public
     * @return string
     */
    public function __toString() {
        return $this->trail();
    }

    /**
     * Sets up the breadcrumb trail properties.  Calls the `Land_Excavator_Breadcrumb_Trail::add_items()` method
     * to creat the array of breadcrumb items.
     *
     * @since  0.6.0
     * @access public
     * @param  array   $land_excavator_args  {
     *     @type string    $container      Container HTML element. nav|div
     *     @type string    $before         String to output before breadcrumb menu.
     *     @type string    $after          String to output after breadcrumb menu.
     *     @type string    $browse_tag     The HTML tag to use to wrap the "Browse" header text.
     *     @type string    $list_tag       The HTML tag to use for the list wrapper.
     *     @type string    $land_excavator_item_tag       The HTML tag to use for the item wrapper.
     *     @type bool      $show_on_front  Whether to show when `is_front_page()`.
     *     @type bool      $land_excavator_network        Whether to link to the network main site (multisite only).
     *     @type bool      $show_title     Whether to show the title (last item) in the trail.
     *     @type bool      $show_browse    Whether to show the breadcrumb menu header.
     *     @type array     $land_excavator_labels         Text labels. @see Land_Excavator_Breadcrumb_Trail::set_labels()
     *     @type array     $land_excavator_post_taxonomy  Taxonomies to use for post types. @see Land_Excavator_Breadcrumb_Trail::set_post_taxonomy()
     *     @type bool      $echo           Whether to print or return the breadcrumbs.
     * }
     * @return void
     */
    public function __construct( $land_excavator_args = array() ) {

        $land_excavator_defaults = array(
            'container'       => 'nav',
            'before'          => '',
            'after'           => '',
            'browse_tag'      => 'h2',
            'list_tag'        => 'ul',
            'item_tag'        => 'li',
            'show_on_front'   => true,
            'network'         => false,
            'show_title'      => true,
            'show_browse'     => false,
            'labels'          => array(),
            'post_taxonomy'   => array(),
            'echo'            => true
        );

        // Parse the arguments with the deaults.
        $this->args = apply_filters( 'land_excavator_breadcrumbs_trail_args', wp_parse_args( $land_excavator_args, $land_excavator_defaults ) );

        // Set the labels and post taxonomy properties.
        $this->set_labels();
        $this->set_post_taxonomy();

        // Let's find some items to add to the trail!
        $this->add_items();
    }

    /* ====== Public Methods ====== */

    /**
     * Formats the HTML output for the breadcrumb trail.
     *
     * @since  0.6.0
     * @access public
     * @return string
     */
    public function trail() {

        // Set up variables that we'll need.
        $land_excavator_breadcrumb    = '';
        $land_excavator_item_count    = count( $this->items );
        $land_excavator_item_position = 0;

        // Connect the breadcrumb trail if there are items in the trail.
        if ( 0 < $land_excavator_item_count ) {

            // Add 'browse' label if it should be shown.
            if ( true === $this->args['show_browse'] ) {

                $land_excavator_breadcrumb .= sprintf(
                    '<%1$s class="trail-browse">%2$s</%1$s>',
                    tag_escape( $this->args['browse_tag'] ),
                    $this->labels['browse']
                );
            }

            // Open the unordered list.
            $land_excavator_breadcrumb .= sprintf(
                '<%s class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">',
                tag_escape( $this->args['list_tag'] )
            );

            // Add the number of items and item list order schema.
            $land_excavator_breadcrumb .= sprintf( '<meta name="numberOfItems" content="%d" />', absint( $land_excavator_item_count ) );
            $land_excavator_breadcrumb .= '<meta name="itemListOrder" content="Ascending" />';

            // Loop through the items and add them to the list.
            foreach ( $this->items as $land_excavator_item ) {

                // Iterate the item position.
                ++$land_excavator_item_position;

                // Check if the item is linked.
                preg_match( '/(<a.*?>)(.*?)(<\/a>)/i', $land_excavator_item, $land_excavator_matches );

                // Wrap the item text with appropriate itemprop.
                $land_excavator_item = ! empty( $land_excavator_matches ) ? sprintf( '%s<span itemprop="name">%s</span>%s', $land_excavator_matches[1], $land_excavator_matches[2], $land_excavator_matches[3] ) : sprintf( '<span itemprop="name">%s</span>', $land_excavator_item );

                // If viewing a single post.
                if ( is_singular() || is_page() ){

                    global $post;
                    $land_excavator_link_item = get_permalink( $post->ID );

                }
                elseif ( is_archive() && ( !is_day() && !is_month() && !is_year() && !is_tag() ) ) {

                    $land_excavator_category = get_queried_object();
                    $land_excavator_link_item = get_category_link( $land_excavator_category->term_id );

                } elseif ( is_day() ) {

                    $land_excavator_link_item = get_day_link( get_the_time('Y'),get_the_time('m'),get_the_time('d') );

                } elseif ( is_month() ) {

                   $land_excavator_link_item = get_month_link( get_the_time('Y'),get_the_time('m') );

                } elseif ( is_year() ) {

                    $land_excavator_link_item = get_year_link( get_the_time('Y') );

                }elseif ( is_tag() ) {

                    $land_excavator_tag_id = get_queried_object()->term_id;
                    $land_excavator_link_item = get_tag_link( $land_excavator_tag_id );

                } elseif ( is_author() ) {

                    $land_excavator_link_item = get_author_posts_url( get_current_user_id() );

                }
                elseif ( is_search() ) {

                    $land_excavator_link_item = home_url();

                }
                else{

                    $land_excavator_link_item = home_url();

                }

                $land_excavator_item = ! empty( $land_excavator_matches )
                    ? preg_replace( '/(<a.*?)([\'"])>/i', '$1$2 itemprop=$2item$2>', $land_excavator_item )
                    : sprintf( '<a href="'.esc_url( $land_excavator_link_item ).'" itemprop="item">%s</a>', $land_excavator_item );

                // Add list item classes.
                $land_excavator_item_class = 'trail-item';

                if ( 1 === $land_excavator_item_position && 1 < $land_excavator_item_count )
                    $land_excavator_item_class .= ' trail-begin';

                elseif ( $land_excavator_item_count === $land_excavator_item_position )
                    $land_excavator_item_class .= ' trail-end';

                // Create list item attributes.
                $attributes = 'itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="' . $land_excavator_item_class . '"';

                // Build the meta position HTML.
                $meta = sprintf( '<meta itemprop="position" content="%s" />', absint( $land_excavator_item_position ) );

                // Build the list item.
                $land_excavator_breadcrumb .= sprintf( '<%1$s %2$s>%3$s%4$s</%1$s>', tag_escape( $this->args['item_tag'] ),$attributes, $land_excavator_item, $meta );
            }

            // Close the unordered list.
            $land_excavator_breadcrumb .= sprintf( '</%s>', tag_escape( $this->args['list_tag'] ) );

            // Wrap the breadcrumb trail.
            $land_excavator_breadcrumb = sprintf(
                '<%1$s role="navigation" aria-label="%2$s" class="breadcrumb-trail" itemprop="breadcrumb">%3$s%4$s%5$s</%1$s>',
                tag_escape( $this->args['container'] ),
                esc_attr( $this->labels['aria_label'] ),
                $this->args['before'],
                $land_excavator_breadcrumb,
                $this->args['after']
            );
        }

        // Allow developers to filter the breadcrumb trail HTML.
        $land_excavator_breadcrumb = apply_filters( 'land_excavator_breadcrumbs_trail', $land_excavator_breadcrumb, $this->args );

        if ( false === $this->args['echo'] )
            return $land_excavator_breadcrumb;

        echo $land_excavator_breadcrumb;
    }

    /* ====== Protected Methods ====== */

    /**
     * Sets the labels property.  Parses the inputted labels array with the defaults.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function set_labels() {

        $land_excavator_defaults = array(
            'browse'              => esc_html__( 'Browse:',                               'land-excavator' ),
            'aria_label'          => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'land-excavator' ),
            'home'                => esc_html__( 'Home',                                  'land-excavator' ),
            'error_404'           => esc_html__( '404 Not Found',                         'land-excavator' ),
            'archives'            => esc_html__( 'Archives',                              'land-excavator' ),
            // Translators: %s is the search query.
            'search'              => esc_html__( 'Search results for: %s',                'land-excavator' ),
            // Translators: %s is the page number.
            'paged'               => esc_html__( 'Page %s',                               'land-excavator' ),
            // Translators: %s is the page number.
            'paged_comments'      => esc_html__( 'Comment Page %s',                       'land-excavator' ),
            // Translators: Minute archive title. %s is the minute time format.
            'archive_minute'      => esc_html__( 'Minute %s',                             'land-excavator' ),
            // Translators: Weekly archive title. %s is the week date format.
            'archive_week'        => esc_html__( 'Week %s',                               'land-excavator' ),

            // "%s" is replaced with the translated date/time format.
            'archive_minute_hour' => '%s',
            'archive_hour'        => '%s',
            'archive_day'         => '%s',
            'archive_month'       => '%s',
            'archive_year'        => '%s',
        );

        $this->labels = apply_filters( 'land_excavator_breadcrumbs_trail_labels', wp_parse_args( $this->args['labels'], $land_excavator_defaults ) );
    }

    /**
     * Sets the `$land_excavator_post_taxonomy` property.  This is an array of post types (key) and taxonomies (value).
     * The taxonomy's terms are shown on the singular post view if set.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function set_post_taxonomy() {

        $land_excavator_defaults = array();

        // If post permalink is set to `%postname%`, use the `category` taxonomy.
        if ( '%postname%' === trim( get_option( 'permalink_structure' ), '/' ) )
            $land_excavator_defaults['post'] = 'category';

        $this->post_taxonomy = apply_filters( 'land_excavator_breadcrumbs_trail_post_taxonomy', wp_parse_args( $this->args['post_taxonomy'], $land_excavator_defaults ) );
    }

    /**
     * Runs through the various WordPress conditional tags to check the current page being viewed.  Once
     * a condition is met, a specific method is launched to add items to the `$items` array.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_items() {

        // If viewing the front page.
        if ( is_front_page() ) {
            $this->add_front_page_items();
        }

        // If not viewing the front page.
        else {

            // Add the network and site home links.
            $this->add_network_home_link();
            $this->add_site_home_link();

            // If viewing the home/blog page.
            if ( is_home() ) {
                $this->add_blog_items();
            }

            // If viewing a single post.
            elseif ( is_singular() ) {
                $this->add_singular_items();
            }

            // If viewing an archive page.
            elseif ( is_archive() ) {

                if ( is_post_type_archive() )
                    $this->add_post_type_archive_items();

                elseif ( is_category() || is_tag() || is_tax() )
                    $this->add_term_archive_items();

                elseif ( is_author() )
                    $this->add_user_archive_items();

                elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
                    $this->add_minute_hour_archive_items();

                elseif ( get_query_var( 'minute' ) )
                    $this->add_minute_archive_items();

                elseif ( get_query_var( 'hour' ) )
                    $this->add_hour_archive_items();

                elseif ( is_day() )
                    $this->add_day_archive_items();

                elseif ( get_query_var( 'w' ) )
                    $this->add_week_archive_items();

                elseif ( is_month() )
                    $this->add_month_archive_items();

                elseif ( is_year() )
                    $this->add_year_archive_items();

                else
                    $this->add_default_archive_items();
            }

            // If viewing a search results page.
            elseif ( is_search() ) {
                $this->add_search_items();
            }

            // If viewing the 404 page.
            elseif ( is_404() ) {
                $this->add_404_items();
            }
        }

        // Add paged items if they exist.
        $this->add_paged_items();

        // Allow developers to overwrite the items for the breadcrumb trail.
        $this->items = array_unique( apply_filters( 'land_excavator_breadcrumbs_trail_items', $this->items, $this->args ) );
    }

    /**
     * Gets front items based on $wp_rewrite->front.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_rewrite_front_items() {
        global $wp_rewrite;

        if ( $wp_rewrite->front )
            $this->add_path_parents( $wp_rewrite->front );
    }

    /**
     * Adds the page/paged number to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_paged_items() {

        // If viewing a paged singular post.
        if ( is_singular() && 1 < get_query_var( 'page' ) && true === $this->args['show_title'] )
            $this->items[] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'page' ) ) ) );

        // If viewing a singular post with paged comments.
        elseif ( is_singular() && get_option( 'page_comments' ) && 1 < get_query_var( 'cpage' ) )
            $this->items[] = sprintf( $this->labels['paged_comments'], number_format_i18n( absint( get_query_var( 'cpage' ) ) ) );

        // If viewing a paged archive-type page.
        elseif ( is_paged() && true === $this->args['show_title'] )
            $this->items[] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'paged' ) ) ) );
    }

    /**
     * Adds the network (all sites) home page link to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_network_home_link() {

        if ( is_multisite() && ! is_main_site() && true === $this->args['network'] )
            $this->items[] = sprintf( '<a href="%s" rel="home">%s</a>', esc_url( network_home_url() ), $this->labels['home'] );
    }

    /**
     * Adds the current site's home page link to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_site_home_link() {

        $land_excavator_network = is_multisite() && ! is_main_site() && true === $this->args['network'];
        $land_excavator_label   = $land_excavator_network ? get_bloginfo( 'name' ) : $this->labels['home'];
        $rel     = $land_excavator_network ? '' : ' rel="home"';

        $this->items[] = sprintf( '<a href="%s"%s>%s</a>', esc_url( user_trailingslashit( home_url() ) ), $rel, $land_excavator_label );
    }

    /**
     * Adds items for the front page to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_front_page_items() {

        // Only show front items if the 'show_on_front' argument is set to 'true'.
        if ( true === $this->args['show_on_front'] || is_paged() || ( is_singular() && 1 < get_query_var( 'page' ) ) ) {

            // Add network home link.
            $this->add_network_home_link();

            // If on a paged view, add the site home link.
            if ( is_paged() )
                $this->add_site_home_link();

            // If on the main front page, add the network home title.
            elseif ( true === $this->args['show_title'] )
                $this->items[] = is_multisite() && true === $this->args['network'] ? get_bloginfo( 'name' ) : $this->labels['home'];
        }
    }

    /**
     * Adds items for the posts page (i.e., is_home()) to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_blog_items() {

        // Get the post ID and post.
        $land_excavator_post_id = get_queried_object_id();
        $post    = get_post( $land_excavator_post_id );

        // If the post has parents, add them to the trail.
        if ( 0 < $post->post_parent )
            $this->add_post_parents( $post->post_parent );

        // Get the page title.
        $land_excavator_title = get_the_title( $land_excavator_post_id );

        // Add the posts page item.
        if ( is_paged() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $land_excavator_post_id ) ), $land_excavator_title );

        elseif ( $land_excavator_title && true === $this->args['show_title'] )
            $this->items[] = $land_excavator_title;
    }

    /**
     * Adds singular post items to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_singular_items() {

        // Get the queried post.
        $post    = get_queried_object();
        $land_excavator_post_id = get_queried_object_id();

        // If the post has a parent, follow the parent trail.
        if ( 0 < $post->post_parent )
            $this->add_post_parents( $post->post_parent );

        // If the post doesn't have a parent, get its hierarchy based off the post type.
        else
            $this->add_post_hierarchy( $land_excavator_post_id );

        // Display terms for specific post type taxonomy if requested.
        if ( ! empty( $this->post_taxonomy[ $post->post_type ] ) )
            $this->add_post_terms( $land_excavator_post_id, $this->post_taxonomy[ $post->post_type ] );

        // End with the post title.
        if ( $land_excavator_post_title = single_post_title( '', false ) ) {

            if ( ( 1 < get_query_var( 'page' ) || is_paged() ) || ( get_option( 'page_comments' ) && 1 < absint( get_query_var( 'cpage' ) ) ) )
                $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $land_excavator_post_id ) ), $land_excavator_post_title );

            elseif ( true === $this->args['show_title'] )
                $this->items[] = $land_excavator_post_title;
        }
    }

    /**
     * Adds the items to the trail items array for taxonomy term archives.
     *
     * @since  1.0.0
     * @access protected
     * @global object $wp_rewrite
     * @return void
     */
    protected function add_term_archive_items() {
        global $wp_rewrite;

        // Get some taxonomy and term variables.
        $land_excavator_term           = get_queried_object();
        $land_excavator_taxonomy       = get_taxonomy( $land_excavator_term->taxonomy );
        $land_excavator_done_post_type = false;

        // If there are rewrite rules for the taxonomy.
        if ( false !== $land_excavator_taxonomy->rewrite ) {

            // If 'with_front' is true, dd $wp_rewrite->front to the trail.
            if ( isset( $land_excavator_taxonomy->rewrite['with_front'] ) && $land_excavator_taxonomy->rewrite['with_front'] && isset( $wp_rewrite->front ) && $wp_rewrite->front )
                $this->add_rewrite_front_items();

            // Get parent pages by path if they exist.
            $this->add_path_parents( $land_excavator_taxonomy->rewrite['slug'] );

            // Add post type archive if its 'has_archive' matches the taxonomy rewrite 'slug'.
            if ( $land_excavator_taxonomy->rewrite['slug'] ) {

                $land_excavator_slug = trim( $land_excavator_taxonomy->rewrite['slug'], '/' );

                // Deals with the situation if the slug has a '/' between multiple
                // strings. For example, "movies/genres" where "movies" is the post
                // type archive.
                $land_excavator_matches = explode( '/', $land_excavator_slug );

                // If matches are found for the path.
                if ( isset( $land_excavator_matches ) ) {

                    // Reverse the array of matches to search for posts in the proper order.
                    $land_excavator_matches = array_reverse( $land_excavator_matches );

                    // Loop through each of the path matches.
                    foreach ( $land_excavator_matches as $land_excavator_match ) {

                        // If a match is found.
                        $land_excavator_slug = $land_excavator_match;

                        // Get public post types that match the rewrite slug.
                        $land_excavator_post_types = $this->get_post_types_by_slug( $land_excavator_match );

                        if ( ! empty( $land_excavator_post_types ) ) {

                            $land_excavator_post_type_object = $land_excavator_post_types[0];

                            // Add support for a non-standard label of 'archive_title' (special use case).
                            $land_excavator_label = ! empty( $land_excavator_post_type_object->labels->archive_title ) ? $land_excavator_post_type_object->labels->archive_title : $land_excavator_post_type_object->labels->name;

                            // Core filter hook.
                            $land_excavator_label = apply_filters( 'post_type_archive_title', $land_excavator_label, $land_excavator_post_type_object->name );

                            // Add the post type archive link to the trail.
                            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $land_excavator_post_type_object->name ) ), $land_excavator_label );

                            $land_excavator_done_post_type = true;

                            // Break out of the loop.
                            break;
                        }
                    }
                }
            }
        }

        // If there's a single post type for the taxonomy, use it.
        if ( false === $land_excavator_done_post_type && 1 === count( $land_excavator_taxonomy->object_type ) && post_type_exists( $land_excavator_taxonomy->object_type[0] ) ) {

            // If the post type is 'post'.
            if ( 'post' === $land_excavator_taxonomy->object_type[0] ) {
                $land_excavator_post_id = get_option( 'page_for_posts' );

                if ( 'posts' !== get_option( 'show_on_front' ) && 0 < $land_excavator_post_id )
                    $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $land_excavator_post_id ) ), get_the_title( $land_excavator_post_id ) );

            // If the post type is not 'post'.
            } else {
                $land_excavator_post_type_object = get_post_type_object( $land_excavator_taxonomy->object_type[0] );

                $land_excavator_label = ! empty( $land_excavator_post_type_object->labels->archive_title ) ? $land_excavator_post_type_object->labels->archive_title : $land_excavator_post_type_object->labels->name;

                // Core filter hook.
                $land_excavator_label = apply_filters( 'post_type_archive_title', $land_excavator_label, $land_excavator_post_type_object->name );

                $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $land_excavator_post_type_object->name ) ), $land_excavator_label );
            }
        }

        // If the taxonomy is hierarchical, list its parent terms.
        if ( is_taxonomy_hierarchical( $land_excavator_term->taxonomy ) && $land_excavator_term->parent )
            $this->add_term_parents( $land_excavator_term->parent, $land_excavator_term->taxonomy );

        // Add the term name to the trail end.
        if ( is_paged() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $land_excavator_term, $land_excavator_term->taxonomy ) ), single_term_title( '', false ) );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = single_term_title( '', false );
    }

    /**
     * Adds the items to the trail items array for post type archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_post_type_archive_items() {

        // Get the post type object.
        $land_excavator_post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

        if ( false !== $land_excavator_post_type_object->rewrite ) {

            // If 'with_front' is true, add $wp_rewrite->front to the trail.
            if ( isset( $land_excavator_post_type_object->rewrite['with_front'] ) && $land_excavator_post_type_object->rewrite['with_front'] )
                $this->add_rewrite_front_items();

            // If there's a rewrite slug, check for parents.
            if ( ! empty( $land_excavator_post_type_object->rewrite['slug'] ) )
                $this->add_path_parents( $land_excavator_post_type_object->rewrite['slug'] );
        }

        // Add the post type [plural] name to the trail end.
        if ( is_paged() || is_author() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $land_excavator_post_type_object->name ) ), post_type_archive_title( '', false ) );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = post_type_archive_title( '', false );

        // If viewing a post type archive by author.
        if ( is_author() )
            $this->add_user_archive_items();
    }

    /**
     * Adds the items to the trail items array for user (author) archives.
     *
     * @since  1.0.0
     * @access protected
     * @global object $wp_rewrite
     * @return void
     */
    protected function add_user_archive_items() {
        global $wp_rewrite;

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Get the user ID.
        $user_id = get_query_var( 'author' );

        // If $author_base exists, check for parent pages.
        if ( ! empty( $wp_rewrite->author_base ) && ! is_post_type_archive() )
            $this->add_path_parents( $wp_rewrite->author_base );

        // Add the author's display name to the trail end.
        if ( is_paged() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_author_posts_url( $user_id ) ), get_the_author_meta( 'display_name', $user_id ) );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = get_the_author_meta( 'display_name', $user_id );
    }

    /**
     * Adds the items to the trail items array for minute + hour archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_minute_hour_archive_items() {

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Add the minute + hour item.
        if ( true === $this->args['show_title'] )
            $this->items[] = sprintf( $this->labels['archive_minute_hour'], get_the_time( esc_html_x( 'g:i a', 'minute and hour archives time format', 'land-excavator' ) ) );
    }

    /**
     * Adds the items to the trail items array for minute archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_minute_archive_items() {

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Add the minute item.
        if ( true === $this->args['show_title'] )
            $this->items[] = sprintf( $this->labels['archive_minute'], get_the_time( esc_html_x( 'i', 'minute archives time format', 'land-excavator' ) ) );
    }

    /**
     * Adds the items to the trail items array for hour archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_hour_archive_items() {

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Add the hour item.
        if ( true === $this->args['show_title'] )
            $this->items[] = sprintf( $this->labels['archive_hour'], get_the_time( esc_html_x( 'g a', 'hour archives time format', 'land-excavator' ) ) );
    }

    /**
     * Adds the items to the trail items array for day archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_day_archive_items() {

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Get year, month, and day.
        $land_excavator_year  = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'land-excavator' ) ) );
        $land_excavator_month = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'land-excavator' ) ) );
        $land_excavator_day   = sprintf( $this->labels['archive_day'],   get_the_time( esc_html_x( 'j', 'daily archives date format',   'land-excavator' ) ) );

        // Add the year and month items.
        $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $land_excavator_year );
        $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $land_excavator_month );

        // Add the day item.
        if ( is_paged() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_day_link( get_the_time( 'Y' ) ), get_the_time( 'm' ), get_the_time( 'd' ) ), $land_excavator_day );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = $land_excavator_day;
    }

    /**
     * Adds the items to the trail items array for week archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_week_archive_items() {

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Get the year and week.
        $land_excavator_year = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'land-excavator' ) ) );
        $land_excavator_week = sprintf( $this->labels['archive_week'],  get_the_time( esc_html_x( 'W', 'weekly archives date format', 'land-excavator' ) ) );

        // Add the year item.
        $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $land_excavator_year );

        // Add the week item.
        if ( is_paged() )
            $this->items[] = esc_url( get_archives_link( add_query_arg( array( 'm' => get_the_time( 'Y' ), 'w' => get_the_time( 'W' ) ), home_url() ), $land_excavator_week, false ) );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = $land_excavator_week;
    }

    /**
     * Adds the items to the trail items array for month archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_month_archive_items() {

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Get the year and month.
        $land_excavator_year  = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'land-excavator' ) ) );
        $land_excavator_month = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'land-excavator' ) ) );

        // Add the year item.
        $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $land_excavator_year );

        // Add the month item.
        if ( is_paged() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $land_excavator_month );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = $land_excavator_month;
    }

    /**
     * Adds the items to the trail items array for year archives.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_year_archive_items() {

        // Add $wp_rewrite->front to the trail.
        $this->add_rewrite_front_items();

        // Get the year.
        $land_excavator_year  = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'land-excavator' ) ) );

        // Add the year item.
        if ( is_paged() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $land_excavator_year );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = $land_excavator_year;
    }

    /**
     * Adds the items to the trail items array for archives that don't have a more specific method
     * defined in this class.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_default_archive_items() {

        // If this is a date-/time-based archive, add $wp_rewrite->front to the trail.
        if ( is_date() || is_time() )
            $this->add_rewrite_front_items();

        if ( true === $this->args['show_title'] )
            $this->items[] = $this->labels['archives'];
    }

    /**
     * Adds the items to the trail items array for search results.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_search_items() {

        if ( is_paged() )
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_search_link() ), sprintf( $this->labels['search'], get_search_query() ) );

        elseif ( true === $this->args['show_title'] )
            $this->items[] = sprintf( $this->labels['search'], get_search_query() );
    }

    /**
     * Adds the items to the trail items array for 404 pages.
     *
     * @since  1.0.0
     * @access protected
     * @return void
     */
    protected function add_404_items() {

        if ( true === $this->args['show_title'] )
            $this->items[] = $this->labels['error_404'];
    }

    /**
     * Adds a specific post's parents to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @param  int    $land_excavator_post_id
     * @return void
     */
    protected function add_post_parents( $land_excavator_post_id ) {
        $land_excavator_parents = array();

        while ( $land_excavator_post_id ) {

            // Get the post by ID.
            $post = get_post( $land_excavator_post_id );

            // If we hit a page that's set as the front page, bail.
            if ( 'page' == $post->post_type && 'page' == get_option( 'show_on_front' ) && $land_excavator_post_id == get_option( 'page_on_front' ) )
                break;

            // Add the formatted post link to the array of parents.
            $land_excavator_parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $land_excavator_post_id ) ), get_the_title( $land_excavator_post_id ) );

            // If there's no longer a post parent, break out of the loop.
            if ( 0 >= $post->post_parent )
                break;

            // Change the post ID to the parent post to continue looping.
            $land_excavator_post_id = $post->post_parent;
        }

        // Get the post hierarchy based off the final parent post.
        $this->add_post_hierarchy( $land_excavator_post_id );

        // Display terms for specific post type taxonomy if requested.
        if ( ! empty( $this->post_taxonomy[ $post->post_type ] ) )
            $this->add_post_terms( $land_excavator_post_id, $this->post_taxonomy[ $post->post_type ] );

        // Merge the parent items into the items array.
        $this->items = array_merge( $this->items, array_reverse( $land_excavator_parents ) );
    }

    /**
     * Adds a specific post's hierarchy to the items array.  The hierarchy is determined by post type's
     * rewrite arguments and whether it has an archive page.
     *
     * @since  1.0.0
     * @access protected
     * @param  int    $land_excavator_post_id
     * @return void
     */
    protected function add_post_hierarchy( $land_excavator_post_id ) {

        // Get the post type.
        $land_excavator_post_type        = get_post_type( $land_excavator_post_id );
        $land_excavator_post_type_object = get_post_type_object( $land_excavator_post_type );

        // If this is the 'post' post type, get the rewrite front items and map the rewrite tags.
        if ( 'post' === $land_excavator_post_type ) {

            // Add $wp_rewrite->front to the trail.
            $this->add_rewrite_front_items();

            // Map the rewrite tags.
            $this->map_rewrite_tags( $land_excavator_post_id, get_option( 'permalink_structure' ) );
        }

        // If the post type has rewrite rules.
        elseif ( false !== $land_excavator_post_type_object->rewrite ) {

            // If 'with_front' is true, add $wp_rewrite->front to the trail.
            if ( isset( $land_excavator_post_type_object->rewrite['with_front'] ) && $land_excavator_post_type_object->rewrite['with_front'] )
                $this->add_rewrite_front_items();

            // If there's a path, check for parents.
            if ( ! empty( $land_excavator_post_type_object->rewrite['slug'] ) )
                $this->add_path_parents( $land_excavator_post_type_object->rewrite['slug'] );
        }

        // If there's an archive page, add it to the trail.
        if ( $land_excavator_post_type_object->has_archive ) {

            // Add support for a non-standard label of 'archive_title' (special use case).
            $land_excavator_label = ! empty( $land_excavator_post_type_object->labels->archive_title ) ? $land_excavator_post_type_object->labels->archive_title : $land_excavator_post_type_object->labels->name;

            // Core filter hook.
            $land_excavator_label = apply_filters( 'post_type_archive_title', $land_excavator_label, $land_excavator_post_type_object->name );

            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $land_excavator_post_type ) ), $land_excavator_label );
        }

        // Map the rewrite tags if there's a `%` in the slug.
        if ( 'post' !== $land_excavator_post_type && ! empty( $land_excavator_post_type_object->rewrite['slug'] ) && false !== strpos( $land_excavator_post_type_object->rewrite['slug'], '%' ) )
            $this->map_rewrite_tags( $land_excavator_post_id, $land_excavator_post_type_object->rewrite['slug'] );
    }

    /**
     * Gets post types by slug.  This is needed because the get_post_types() function doesn't exactly
     * match the 'has_archive' argument when it's set as a string instead of a boolean.
     *
     * @since  0.6.0
     * @access protected
     * @param  int    $land_excavator_slug  The post type archive slug to search for.
     * @return void
     */
    protected function get_post_types_by_slug( $land_excavator_slug ) {

        $land_excavator_return = array();

        $land_excavator_post_types = get_post_types( array(), 'objects' );

        foreach ( $land_excavator_post_types as $land_excavator_type ) {

            if ( $land_excavator_slug === $land_excavator_type->has_archive || ( true === $land_excavator_type->has_archive && $land_excavator_slug === $land_excavator_type->rewrite['slug'] ) )
                $land_excavator_return[] = $land_excavator_type;
        }

        return $land_excavator_return;
    }

    /**
     * Adds a post's terms from a specific taxonomy to the items array.
     *
     * @since  1.0.0
     * @access protected
     * @param  int     $land_excavator_post_id  The ID of the post to get the terms for.
     * @param  string  $land_excavator_taxonomy The taxonomy to get the terms from.
     * @return void
     */
    protected function add_post_terms( $land_excavator_post_id, $land_excavator_taxonomy ) {

        // Get the post type.
        $land_excavator_post_type = get_post_type( $land_excavator_post_id );

        // Get the post categories.
        $land_excavator_terms = get_the_terms( $land_excavator_post_id, $land_excavator_taxonomy );

        // Check that categories were returned.
        if ( $land_excavator_terms && ! is_wp_error( $land_excavator_terms ) ) {

            // Sort the terms by ID and get the first category.
            if ( function_exists( 'wp_list_sort' ) )
                $land_excavator_terms = wp_list_sort( $land_excavator_terms, 'term_id' );

            else
                usort( $land_excavator_terms, '_usort_terms_by_ID' );

            $land_excavator_term = get_term( $land_excavator_terms[0], $land_excavator_taxonomy );

            // If the category has a parent, add the hierarchy to the trail.
            if ( 0 < $land_excavator_term->parent )
                $this->add_term_parents( $land_excavator_term->parent, $land_excavator_taxonomy );

            // Add the category archive link to the trail.
            $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $land_excavator_term, $land_excavator_taxonomy ) ), $land_excavator_term->name );
        }
    }

    /**
     * Get parent posts by path.  Currently, this method only supports getting parents of the 'page'
     * post type.  The goal of this function is to create a clear path back to home given what would
     * normally be a "ghost" directory.  If any page matches the given path, it'll be added.
     *
     * @since  1.0.0
     * @access protected
     * @param  string $land_excavator_path The path (slug) to search for posts by.
     * @return void
     */
    function add_path_parents( $land_excavator_path ) {

        // Trim '/' off $land_excavator_path in case we just got a simple '/' instead of a real path.
        $land_excavator_path = trim( $land_excavator_path, '/' );

        // If there's no path, return.
        if ( empty( $land_excavator_path ) )
            return;

        // Get parent post by the path.
        $post = get_page_by_path( $land_excavator_path );

        if ( ! empty( $post ) ) {
            $this->add_post_parents( $post->ID );
        }

        elseif ( is_null( $post ) ) {

            // Separate post names into separate paths by '/'.
            $land_excavator_path = trim( $land_excavator_path, '/' );
            preg_match_all( "/\/.*?\z/", $land_excavator_path, $land_excavator_matches );

            // If matches are found for the path.
            if ( isset( $land_excavator_matches ) ) {

                // Reverse the array of matches to search for posts in the proper order.
                $land_excavator_matches = array_reverse( $land_excavator_matches );

                // Loop through each of the path matches.
                foreach ( $land_excavator_matches as $land_excavator_match ) {

                    // If a match is found.
                    if ( isset( $land_excavator_match[0] ) ) {

                        // Get the parent post by the given path.
                        $land_excavator_path = str_replace( $land_excavator_match[0], '', $land_excavator_path );
                        $post = get_page_by_path( trim( $land_excavator_path, '/' ) );

                        // If a parent post is found, set the $land_excavator_post_id and break out of the loop.
                        if ( ! empty( $post ) && 0 < $post->ID ) {
                            $this->add_post_parents( $post->ID );
                            break;
                        }
                    }
                }
            }
        }
    }

    /**
     * Searches for term parents of hierarchical taxonomies.  This function is similar to the WordPress
     * function get_category_parents() but handles any type of taxonomy.
     *
     * @since  1.0.0
     * @param  int    $land_excavator_term_id  ID of the term to get the parents of.
     * @param  string $land_excavator_taxonomy Name of the taxonomy for the given term.
     * @return void
     */
    function add_term_parents( $land_excavator_term_id, $land_excavator_taxonomy ) {

        // Set up some default arrays.
        $land_excavator_parents = array();

        // While there is a parent ID, add the parent term link to the $land_excavator_parents array.
        while ( $land_excavator_term_id ) {

            // Get the parent term.
            $land_excavator_term = get_term( $land_excavator_term_id, $land_excavator_taxonomy );

            // Add the formatted term link to the array of parent terms.
            $land_excavator_parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $land_excavator_term, $land_excavator_taxonomy ) ), $land_excavator_term->name );

            // Set the parent term's parent as the parent ID.
            $land_excavator_term_id = $land_excavator_term->parent;
        }

        // If we have parent terms, reverse the array to put them in the proper order for the trail.
        if ( ! empty( $land_excavator_parents ) )
            $this->items = array_merge( $this->items, array_reverse( $land_excavator_parents ) );
    }

    /**
     * Turns %tag% from permalink structures into usable links for the breadcrumb trail.  This feels kind of
     * hackish for now because we're checking for specific %tag% examples and only doing it for the 'post'
     * post type.  In the future, maybe it'll handle a wider variety of possibilities, especially for custom post
     * types.
     *
     * @since  0.6.0
     * @access protected
     * @param  int    $land_excavator_post_id ID of the post whose parents we want.
     * @param  string $land_excavator_path    Path of a potential parent page.
     * @param  array  $land_excavator_args    Mixed arguments for the menu.
     * @return array
     */
    protected function map_rewrite_tags( $land_excavator_post_id, $land_excavator_path ) {

        $post = get_post( $land_excavator_post_id );

        // Trim '/' from both sides of the $land_excavator_path.
        $land_excavator_path = trim( $land_excavator_path, '/' );

        // Split the $land_excavator_path into an array of strings.
        $land_excavator_matches = explode( '/', $land_excavator_path );

        // If matches are found for the path.
        if ( is_array( $land_excavator_matches ) ) {

            // Loop through each of the matches, adding each to the $trail array.
            foreach ( $land_excavator_matches as $land_excavator_match ) {

                // Trim any '/' from the $land_excavator_match.
                $land_excavator_tag = trim( $land_excavator_match, '/' );

                // If using the %year% tag, add a link to the yearly archive.
                if ( '%year%' == $land_excavator_tag )
                    $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y', $land_excavator_post_id ) ) ), sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'land-excavator' ) ) ) );

                // If using the %monthnum% tag, add a link to the monthly archive.
                elseif ( '%monthnum%' == $land_excavator_tag )
                    $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y', $land_excavator_post_id ), get_the_time( 'm', $land_excavator_post_id ) ) ), sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'land-excavator' ) ) ) );

                // If using the %day% tag, add a link to the daily archive.
                elseif ( '%day%' == $land_excavator_tag )
                    $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_day_link( get_the_time( 'Y', $land_excavator_post_id ), get_the_time( 'm', $land_excavator_post_id ), get_the_time( 'd', $land_excavator_post_id ) ) ), sprintf( $this->labels['archive_day'], get_the_time( esc_html_x( 'j', 'daily archives date format', 'land-excavator' ) ) ) );

                // If using the %author% tag, add a link to the post author archive.
                elseif ( '%author%' == $land_excavator_tag )
                    $this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_author_posts_url( $post->post_author ) ), get_the_author_meta( 'display_name', $post->post_author ) );

                // If using the %category% tag, add a link to the first category archive to match permalinks.
                elseif ( taxonomy_exists( trim( $land_excavator_tag, '%' ) ) ) {

                    // Force override terms in this post type.
                    $this->post_taxonomy[ $post->post_type ] = false;

                    // Add the post categories.
                    $this->add_post_terms( $land_excavator_post_id, trim( $land_excavator_tag, '%' ) );
                }
            }
        }
    }
}