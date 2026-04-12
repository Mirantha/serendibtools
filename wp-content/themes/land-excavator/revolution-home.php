<?php
/**
 * Template Name: Home Page
 */

get_header();
?>

<main id="primary">

    <?php 
    $land_excavator_main_slider_wrap = absint(get_theme_mod('land_excavator_enable_slider', 0));
    if($land_excavator_main_slider_wrap == 1): 
    ?>
        <section id="main-slider-wrap">
            <div class="owl-carousel">
                <?php for ($land_excavator_main_i=1; $land_excavator_main_i <= 3; $land_excavator_main_i++): ?>
                    <?php if ($land_excavator_slider_image = get_theme_mod('land_excavator_slider_image'.$land_excavator_main_i)): ?>
                        <div class="main-slider-inner-box">
                            <img src="<?php echo esc_url($land_excavator_slider_image); ?>" alt="<?php echo esc_attr( get_theme_mod('land_excavator_slider_heading'.$land_excavator_main_i) ); ?>">
                            <div class="main-slider-content-box">
                                <?php if ($land_excavator_top_text = get_theme_mod('land_excavator_slider_top_text'.$land_excavator_main_i)): ?>
                                    <p class="slider-top"><?php echo esc_html($land_excavator_top_text); ?></p>
                                <?php endif; ?>
                                <?php if ($land_excavator_heading = get_theme_mod('land_excavator_slider_heading' . $land_excavator_main_i)): ?>
                                    <h1><?php echo esc_html($land_excavator_heading); ?></h1>
                                <?php endif; ?>

                                <?php if ($land_excavator_text = get_theme_mod('land_excavator_slider_text'.$land_excavator_main_i)): ?>
                                    <p class="slider-content"><?php echo esc_html($land_excavator_text); ?></p>
                                <?php endif; ?>
                                <div class="main-slider-button">
                                    <?php if ( get_theme_mod('land_excavator_slider_button1_link'.$land_excavator_main_i) ||  get_theme_mod('land_excavator_slider_button1_text'.$land_excavator_main_i )) : ?><a class="slide-btn-1" href="<?php echo esc_url( get_theme_mod('land_excavator_slider_button1_link'.$land_excavator_main_i) ); ?>"><?php echo esc_html( get_theme_mod('land_excavator_slider_button1_text'.$land_excavator_main_i) ); ?></a><?php endif; ?>
                                    <?php if ( get_theme_mod('land_excavator_slider_button2_link'.$land_excavator_main_i) ||  get_theme_mod('land_excavator_slider_button2_text'.$land_excavator_main_i )) : ?><a class="slide-btn-2" href="<?php echo esc_url( get_theme_mod('land_excavator_slider_button2_link'.$land_excavator_main_i) ); ?>"><?php echo esc_html( get_theme_mod('land_excavator_slider_button2_text'.$land_excavator_main_i) ); ?></a><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </section>
    <?php endif; ?>

   <?php 
    $land_excavator_main_expert_wrap = absint(get_theme_mod('land_excavator_projetcs_sec_show', 0));
    if ($land_excavator_main_expert_wrap == 1): 
    ?>
        <section id="projetcs-sec">
            <div class="container">
                <div class="title-head">
                    <?php if( get_theme_mod('land_excavator_projetcs_main_text') != '' ){ ?>
                        <p class="project-top-text"><?php echo esc_html(get_theme_mod('land_excavator_projetcs_main_text',''));?></p>
                    <?php }?>
                    <?php if( get_theme_mod('land_excavator_projetcs_main_heading') != '' ){ ?>
                        <h2><?php echo esc_html(get_theme_mod('land_excavator_projetcs_main_heading',''));?></h2>
                    <?php }?>
                </div>
                
                <?php 
                $land_excavator_featured_post = absint(get_theme_mod('land_excavator_projetcs_number', 6)); 
                $land_excavator_has_tabs = true; // Flag to check if there's any tab text
                ?>

                <div class="tab">
                    <?php
                    for ( $land_excavator_j = 1; $land_excavator_j <= $land_excavator_featured_post; $land_excavator_j++ ){ 
                        $land_excavator_main_tab_text = get_theme_mod('land_excavator_projetcs_text'.$land_excavator_j);
                        if ( !empty($land_excavator_main_tab_text) ) {
                            $land_excavator_has_tabs = true; // At least one tab has text
                            ?>
                            <button class="tablinks <?php echo ($land_excavator_j === 1) ? 'active' : ''; ?>" 
                                    onclick="land_excavator_projetcs_tab(event, '<?php echo esc_attr(str_replace(' ', '-', $land_excavator_main_tab_text)); ?>')">
                                <?php echo esc_html($land_excavator_main_tab_text); ?>
                            </button>
                        <?php } 
                    } ?>
                </div>

                <?php if ($land_excavator_has_tabs): // Only show tab content if there's at least one tab ?>
                    <?php for ( $land_excavator_j = 1; $land_excavator_j <= $land_excavator_featured_post; $land_excavator_j++ ){ 
                        $land_excavator_main_tab_text = get_theme_mod('land_excavator_projetcs_text'.$land_excavator_j);
                        if ( !empty($land_excavator_main_tab_text) ) { ?>
                            <div id="<?php echo esc_attr(str_replace(' ', '-', $land_excavator_main_tab_text)); ?>" 
                                 class="tabcontent mt-3 <?php echo ($land_excavator_j === 1) ? 'active' : ''; ?>">
                                <div class="posts-wrapper">
                                    <?php
                                    $land_excavator_catData = get_theme_mod('land_excavator_projetcs_category'.$land_excavator_j,'uncategorized');
                                    $land_excavator_catData = !empty($land_excavator_catData) ? $land_excavator_catData : '';
                                    if ($land_excavator_catData) {
                                        $page_query = new WP_Query(array(
                                            'category_name' => esc_html($land_excavator_catData),
                                            'posts_per_page' => 6
                                        ));

                                        while ($page_query->have_posts()) : $page_query->the_post(); ?>
                                            <div class="post-box">
                                                <div class="post-thumbnail">
                                                    <?php if (has_post_thumbnail()) {
                                                        the_post_thumbnail();
                                                    } else { ?>
                                                        <div class="post-color"></div>
                                                    <?php } ?>
                                                </div>

                                                <div class="post-content">
                                                    <div class="main-content">
                                                        <h3 class="post-title">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <p class="post-para"><?php echo wp_trim_words(get_the_content(), 5); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_postdata();
                                    } ?>
                                </div>
                            </div>
                        <?php } 
                    } ?> 
                <?php endif; ?>   
            </div>
        </section>
    <?php endif; ?>

</main>

<?php
get_footer();
?>