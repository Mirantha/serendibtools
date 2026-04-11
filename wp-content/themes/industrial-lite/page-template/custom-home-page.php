<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'industrial_lite_before_slider' ); ?>

  <?php if( get_theme_mod( 'industrial_lite_slider_arrows', true) == 1 || get_theme_mod( 'industrial_lite_resp_slider_hide_show', true) == 1) { ?>
  <section id="slider"> 
    <?php if(get_theme_mod('industrial_lite_slider_type', 'Default slider') == 'Default slider' ){ ?>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr(get_theme_mod( 'industrial_lite_slider_speed',4000)) ?>">
        <?php $industrial_lite_pages = array();
          for ( $count = 1; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'industrial_lite_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $industrial_lite_pages[] = $mod;
            }
          }
          if( !empty($industrial_lite_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $industrial_lite_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php if(has_post_thumbnail()){
                the_post_thumbnail();
              } else{?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/block-patterns/images/banner.png" alt="" />
              <?php } ?>
              <div class="carousel-caption">
                <div class="inner_carousel">
                  <h1 class="wow bounceInRight" data-wow-duration="3s"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                  <p class="wow bounceInLeft" data-wow-duration="3s"><?php $industrial_lite_excerpt = get_the_excerpt(); echo esc_html( industrial_lite_string_limit_words( $industrial_lite_excerpt, esc_attr(get_theme_mod('industrial_lite_slider_excerpt_number','30')))); ?></p>
                  

                  <?php 
                    $industrial_lite_button_text = get_theme_mod('industrial_lite_slider_button_text', 'Read More');
                    $industrial_lite_button_link = get_theme_mod('industrial_lite_slider_button_link', ''); 
                    if (empty($industrial_lite_button_link)) {
                      $industrial_lite_button_link = get_permalink();
                    }
                    if ($industrial_lite_button_text || !empty($industrial_lite_button_link)) { ?>
                      <div class="more-btn wow bounceInRight" data-wow-duration="2s">
                        <a class="p-3" href="<?php echo esc_url($industrial_lite_button_link); ?>" class="button redmor">
                        <?php echo esc_html($industrial_lite_button_text); ?>
                          <span class="screen-reader-text"><?php echo esc_html($industrial_lite_button_text); ?></span>
                        </a>
                      </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
            <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
          <span class="carousel-control-prev-icon w-auto h-auto" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','industrial-lite' );?></span>
        </a>
        <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
          <span class="carousel-control-next-icon w-auto h-auto" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','industrial-lite' );?></span>
        </a>
      </div>
    <?php } else if(get_theme_mod('industrial_lite_slider_type', 'Advance slider') == 'Advance slider'){?>
      <?php echo do_shortcode(get_theme_mod('industrial_lite_advance_slider_shortcode')); ?>
    <?php } ?>
  </section>

  <?php } ?>

  <?php do_action( 'industrial_lite_after_slider' ); ?>

  <section id="serv-section" class="wow zoomInUp delay-1000" data-wow-duration="2s">
    <div class="container">
      

      <?php if( get_theme_mod( 'industrial_lite_section_small_title') != '') { ?>
        <h4 class="col-lg-3 col-sm-3 col-md-3"><?php echo esc_html(get_theme_mod('industrial_lite_section_small_title',''));?></h4>
      <?php } ?>

      <?php if( get_theme_mod( 'industrial_lite_section_title') != '') { ?>
        <h2><i class="<?php echo esc_attr(get_theme_mod('industrial_lite_services_title_icon','fas fa-industry')); ?>"></i><?php echo esc_html(get_theme_mod('industrial_lite_section_title',''));?></h2>
      <?php } ?>
      
      <div class="row">
        <?php
          $industrial_lite_catData =  get_theme_mod('industrial_lite_our_services','');
          if($industrial_lite_catData){
          $page_query = new WP_Query(array( 'category_name' => esc_html($industrial_lite_catData,'industrial-lite'))); ?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
          <div class="col-lg-4 col-sm-6">
            <div class="box">
              <h3><?php the_title(); ?></h3>
              <p><?php $industrial_lite_excerpt = get_the_excerpt(); echo esc_html( industrial_lite_string_limit_words( $industrial_lite_excerpt, esc_attr(get_theme_mod('industrial_lite_services_excerpt_number','30')))); ?></p>
              <div class="box-content">              
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a>
              </div>
            </div>
          </div>
          <?php endwhile;
          wp_reset_postdata();
        } ?>
      </div>
    </div>
  </section>

  <?php do_action( 'industrial_lite_after_services_section' ); ?>

  <div class="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>