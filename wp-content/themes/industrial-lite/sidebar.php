<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Industrial Lite
 */
?>
<div class="footer wow zoomInUp delay-1000<?php if( get_theme_mod( 'industrial_lite_sticky_sidebar', false) == 1) { ?> sidebar-sticky" data-wow-duration="2s"<?php } else { ?>close-sticky <?php } ?>>
<div id="sidebar" class="wow zoomInUp delay-1000" data-wow-duration="2s"<?php if( is_page_template('blog-post-left-sidebar.php')){?> style="float:left;"<?php } ?>>    
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        <aside id="search" class="widget" role="complementary" aria-label="firstsidebar">
            <h3 class="widget-title"><?php esc_html_e( 'Search', 'industrial-lite' ); ?></h3>
            <?php get_search_form(); ?>
        </aside>
        <aside id="archives" class="widget" role="complementary" aria-label="firstsidebar">
            <h3 class="widget-title"><?php esc_html_e( 'Archives', 'industrial-lite' ); ?></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
        <aside id="meta" class="widget" role="complementary" aria-label="secondsidebar">
            <h3 class="widget-title"><?php esc_html_e( 'Meta', 'industrial-lite' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
        <aside id="categories" class="widget" role="complementary" aria-label="forthsidebar"> 
            <h3 class="widget-title"><?php esc_html_e( 'Categories', 'industrial-lite' ); ?></h3>          
            <ul>
                <?php wp_list_categories('title_li=');  ?>
            </ul>
        </aside>
         <aside id="categories-dropdown" class="widget" role="complementary" aria-label="forthsidebar">
            <h3 class="widget-title"><?php esc_html_e( 'Dropdown Categories', 'industrial-lite' ); ?></h3>
            <ul>
                <?php wp_dropdown_categories('title_li=');  ?>
            </ul>
        </aside>
        <aside id="tag-cloud-sec" class="widget" role="complementary" aria-label="sixthsidebar">
            <h3 class="widget-title"><?php esc_html_e( 'Tag Cloud', 'industrial-lite' ); ?></h3>
            <ul>
                <?php wp_tag_cloud('title_li=');  ?>
            </ul>
        </aside>
    <?php endif; ?>
</div>
</div>