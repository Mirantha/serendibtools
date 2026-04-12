<?php
/**
 * Title: Donation
 * Slug: fundraiser-nonprofit/donation
 * Categories: all, donation
 * Keywords: donation
 */

$fundraiser_nonprofit_images = array(
    FUNDRAISER_NONPROFIT_URL . 'assets/images/donation-img1.png',
    FUNDRAISER_NONPROFIT_URL . 'assets/images/donation-img2.png',
    FUNDRAISER_NONPROFIT_URL . 'assets/images/donation-img3.png',
);

?>

<!-- wp:group {"className":"donation-section","style":{"spacing":{"padding":{"top":"50px","bottom":"50px"}}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group donation-section" style="padding-top:50px;padding-bottom:50px"><!-- wp:buttons {"className":"banner-btn swiper-btn","style":{"spacing":{"margin":{"top":"40px","bottom":"50px"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons banner-btn swiper-btn" style="margin-top:40px;margin-bottom:50px"><!-- wp:button {"textAlign":"center","backgroundColor":"accent-text","textColor":"primary","className":"is-style-fill swiper-button-prev","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"border":{"radius":{"topLeft":"50%","topRight":"50%","bottomLeft":"50%","bottomRight":"50%"}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"14px","textTransform":"capitalize"}},"borderColor":"accent-text"} -->
<div class="wp-block-button is-style-fill swiper-button-prev"><a class="wp-block-button__link has-primary-color has-accent-text-background-color has-text-color has-background has-link-color has-border-color has-accent-text-border-color has-text-align-center has-custom-font-size wp-element-button" href="#" style="border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-left-radius:50%;border-bottom-right-radius:50%;font-size:14px;font-style:normal;font-weight:600;text-transform:capitalize"><i class="fas fa-arrow-left"></i></a></div>
<!-- /wp:button -->

<!-- wp:button {"textAlign":"center","backgroundColor":"accent-text","textColor":"primary","className":"is-style-fill swiper-button-next","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"border":{"radius":{"topLeft":"50%","topRight":"50%","bottomLeft":"50%","bottomRight":"50%"}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"14px","textTransform":"capitalize"}},"borderColor":"accent-text"} -->
<div class="wp-block-button is-style-fill swiper-button-next"><a class="wp-block-button__link has-primary-color has-accent-text-background-color has-text-color has-background has-link-color has-border-color has-accent-text-border-color has-text-align-center has-custom-font-size wp-element-button" href="#" style="border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-left-radius:50%;border-bottom-right-radius:50%;font-size:14px;font-style:normal;font-weight:600;text-transform:capitalize"><i class="fas fa-arrow-right"></i></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"25%","className":"donation-info"} -->
<div class="wp-block-column is-vertically-aligned-center donation-info" style="flex-basis:25%"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"donation-heading","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"typography":{"fontSize":"22px"}},"textColor":"primary"} -->
<p class="donation-heading has-primary-color has-text-color has-link-color" style="font-size:22px"><?php echo esc_html__( 'Our Impactful', 'fundraiser-nonprofit' ); ?><br><?php echo esc_html__( 'Numbers So Far.', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"donation-btn","style":{"spacing":{"margin":{"top":"40px","bottom":"50px"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons donation-btn" style="margin-top:40px;margin-bottom:50px"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"accent-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-text"}}},"spacing":{"padding":{"left":"20px","right":"20px","top":"13px","bottom":"13px"}},"border":{"radius":{"topLeft":"28px","topRight":"28px","bottomLeft":"28px","bottomRight":"28px"},"width":"1px"},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"14px","textTransform":"capitalize"}},"borderColor":"primary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-accent-text-color has-primary-background-color has-text-color has-background has-link-color has-border-color has-primary-border-color has-text-align-center has-custom-font-size wp-element-button" href="#" style="border-width:1px;border-top-left-radius:28px;border-top-right-radius:28px;border-bottom-left-radius:28px;border-bottom-right-radius:28px;padding-top:13px;padding-right:20px;padding-bottom:13px;padding-left:20px;font-size:14px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'Make a Donation', 'fundraiser-nonprofit' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"75%","className":"swiper mySwiper3"} -->
<div class="wp-block-column is-vertically-aligned-center swiper mySwiper3" style="flex-basis:75%"><!-- wp:group {"className":"swiper-wrapper","layout":{"type":"constrained"}} -->
<div class="wp-block-group swiper-wrapper"><!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-group swiper-slide"><!-- wp:group {"className":"donation-card","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"accent-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group donation-card has-accent-text-background-color has-background" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":313,"width":"90px","height":"63px","scale":"contain","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($fundraiser_nonprofit_images[0]); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"donation-num","style":{"typography":{"fontSize":"35px"},"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}}},"textColor":"secondary"} -->
<p class="donation-num has-secondary-color has-text-color has-link-color" style="font-size:35px"><?php echo esc_html__( '$12Cr+', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"donation-para","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}}},"textColor":"hover","fontSize":"small"} -->
<p class="donation-para has-hover-color has-text-color has-link-color has-small-font-size"><?php echo esc_html__( 'Funds Raised Worldwide', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-group swiper-slide"><!-- wp:group {"className":"donation-card","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"accent-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group donation-card has-accent-text-background-color has-background" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":336,"width":"90px","height":"63px","scale":"contain","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($fundraiser_nonprofit_images[1]); ?>" alt="" class="wp-image-336"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"donation-num","style":{"typography":{"fontSize":"35px"},"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}}},"textColor":"secondary"} -->
<p class="donation-num has-secondary-color has-text-color has-link-color" style="font-size:35px"><?php echo esc_html__( '240+', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"donation-para","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}}},"textColor":"hover","fontSize":"small"} -->
<p class="donation-para has-hover-color has-text-color has-link-color has-small-font-size"><?php echo esc_html__( 'Active Fundraising Campaigns', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-group swiper-slide"><!-- wp:group {"className":"donation-card","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"accent-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group donation-card has-accent-text-background-color has-background" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":338,"width":"90px","height":"63px","scale":"contain","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($fundraiser_nonprofit_images[2]); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"donation-num","style":{"typography":{"fontSize":"35px"},"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}}},"textColor":"secondary"} -->
<p class="donation-num has-secondary-color has-text-color has-link-color" style="font-size:35px"><?php echo esc_html__( '$12Cr+', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"donation-para","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}}},"textColor":"hover","fontSize":"small"} -->
<p class="donation-para has-hover-color has-text-color has-link-color has-small-font-size"><?php echo esc_html__( 'Trusted Partner NGOs', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-group swiper-slide"><!-- wp:group {"className":"donation-card","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"accent-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group donation-card has-accent-text-background-color has-background" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":313,"width":"90px","height":"63px","scale":"contain","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($fundraiser_nonprofit_images[0]); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"donation-num","style":{"typography":{"fontSize":"35px"},"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}}},"textColor":"secondary"} -->
<p class="donation-num has-secondary-color has-text-color has-link-color" style="font-size:35px"><?php echo esc_html__( '$12Cr+', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"donation-para","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}}},"textColor":"hover","fontSize":"small"} -->
<p class="donation-para has-hover-color has-text-color has-link-color has-small-font-size"><?php echo esc_html__( 'Funds Raised Worldwide', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-group swiper-slide"><!-- wp:group {"className":"donation-card","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"backgroundColor":"accent-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group donation-card has-accent-text-background-color has-background" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":336,"width":"90px","height":"63px","scale":"contain","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($fundraiser_nonprofit_images[1]); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"donation-num","style":{"typography":{"fontSize":"35px"},"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}}},"textColor":"secondary"} -->
<p class="donation-num has-secondary-color has-text-color has-link-color" style="font-size:35px"><?php echo esc_html__( '240+', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"donation-para","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}}},"textColor":"hover","fontSize":"small"} -->
<p class="donation-para has-hover-color has-text-color has-link-color has-small-font-size"><?php echo esc_html__( 'Active Fundraising Campaigns', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-pagination","layout":{"type":"constrained"}} -->
<div class="wp-block-group swiper-pagination"></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->