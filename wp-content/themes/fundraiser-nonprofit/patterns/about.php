<?php
/**
 * Title: About
 * Slug: fundraiser-nonprofit/about
 * Categories: all, about
 * Keywords: about
 */

$fundraiser_nonprofit_images = array(
    FUNDRAISER_NONPROFIT_URL . 'assets/images/about.png',
);
?>

<!-- wp:group {"className":"about-section","style":{"spacing":{"margin":{"top":"30px","bottom":"100px"}}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group about-section" style="margin-top:30px;margin-bottom:100px"><!-- wp:columns {"className":"about-columns"} -->
<div class="wp-block-columns about-columns"><!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:image {"id":363,"width":"520px","height":"450px","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"about-img","style":{"border":{"radius":{"topLeft":"15px","topRight":"15px","bottomLeft":"15px","bottomRight":"15px"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border about-img"><img src="<?php echo esc_url($fundraiser_nonprofit_images[0]); ?>" alt="" class="wp-image-363" style="border-top-left-radius:15px;border-top-right-radius:15px;border-bottom-left-radius:15px;border-bottom-right-radius:15px;object-fit:cover;width:520px;height:450px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"className":"about-heading","style":{"typography":{"fontSize":"26px"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} -->
<h2 class="wp-block-heading about-heading has-primary-color has-text-color has-link-color" style="font-size:26px"><?php echo esc_html__( 'Know More About Fundora', 'fundraiser-nonprofit' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:html -->
<svg width="135" height="8" viewBox="0 0 135 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="135" height="3" fill="var(--wp--preset--color--secondary)"/>
<rect y="5" width="91.7578" height="3" fill="var(--wp--preset--color--secondary)"/>
</svg>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"about-subheader","style":{"typography":{"fontSize":"16px"},"elements":{"link":{"color":{"text":"var:preset|color|hover"}}}},"textColor":"hover"} -->
<p class="about-subheader has-hover-color has-text-color has-link-color" style="font-size:16px"><?php echo esc_html__( 'About Our Platform – Powering Transparent Fundraising', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"head-para","style":{"typography":{"fontSize":"14px"},"elements":{"link":{"color":{"text":"var:preset|color|hover"}}}},"textColor":"hover"} -->
<p class="head-para has-hover-color has-text-color has-link-color" style="font-size:14px"><?php echo esc_html__( 'Fundora is a transparent fundraising platform connecting donors with verified causes. We ensure every donation is tracked and used responsibly. Fundora is a transparent fundraising platform connecting donors with verified causes.', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"about-highlight","style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}},"typography":{"fontSize":"15px"}},"textColor":"secondary"} -->
<p class="about-highlight has-secondary-color has-text-color has-link-color" style="font-size:15px"><?php echo esc_html__( 'How We Make Contributions', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"tick-grid","layout":{"type":"constrained"}} -->
<div class="wp-block-group tick-grid"><!-- wp:group {"className":"tick-flex","layout":{"type":"constrained"}} -->
<div class="wp-block-group tick-flex"><!-- wp:html -->
<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 5L7.22222 10L15 1" stroke="var(--wp--preset--color--secondary)" stroke-width="2" stroke-linecap="round"/>
</svg>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"tick-info","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}},"typography":{"fontSize":"15px"}},"textColor":"hover"} -->
<p class="tick-info has-hover-color has-text-color has-link-color" style="font-size:15px"><?php echo esc_html__( '100% Transparency', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"tick-flex","layout":{"type":"constrained"}} -->
<div class="wp-block-group tick-flex"><!-- wp:html -->
<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 5L7.22222 10L15 1" stroke="var(--wp--preset--color--secondary)" stroke-width="2" stroke-linecap="round"/>
</svg>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"tick-info","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}},"typography":{"fontSize":"15px"}},"textColor":"hover"} -->
<p class="tick-info has-hover-color has-text-color has-link-color" style="font-size:15px"><?php echo esc_html__( 'Secure Payments', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"tick-flex","layout":{"type":"constrained"}} -->
<div class="wp-block-group tick-flex"><!-- wp:html -->
<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 5L7.22222 10L15 1" stroke="var(--wp--preset--color--secondary)" stroke-width="2" stroke-linecap="round"/>
</svg>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"tick-info","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}},"typography":{"fontSize":"15px"}},"textColor":"hover"} -->
<p class="tick-info has-hover-color has-text-color has-link-color" style="font-size:15px"><?php echo esc_html__( 'Verified Campaigns', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"tick-flex","layout":{"type":"constrained"}} -->
<div class="wp-block-group tick-flex"><!-- wp:html -->
<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 5L7.22222 10L15 1" stroke="var(--wp--preset--color--secondary)" stroke-width="2" stroke-linecap="round"/>
</svg>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"tick-info","style":{"elements":{"link":{"color":{"text":"var:preset|color|hover"}}},"typography":{"fontSize":"15px"}},"textColor":"hover"} -->
<p class="tick-info has-hover-color has-text-color has-link-color" style="font-size:15px"><?php echo esc_html__( 'Real-Time Impact Tracking', 'fundraiser-nonprofit' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"about-btn","style":{"spacing":{"margin":{"top":"40px","bottom":"50px"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons about-btn" style="margin-top:40px;margin-bottom:50px"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"accent-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-text"}}},"spacing":{"padding":{"left":"20px","right":"20px","top":"13px","bottom":"13px"}},"border":{"radius":{"topLeft":"28px","topRight":"28px","bottomLeft":"28px","bottomRight":"28px"},"width":"1px"},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"14px","textTransform":"capitalize"}},"borderColor":"primary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-accent-text-color has-primary-background-color has-text-color has-background has-link-color has-border-color has-primary-border-color has-text-align-center has-custom-font-size wp-element-button" href="#" style="border-width:1px;border-top-left-radius:28px;border-top-right-radius:28px;border-bottom-left-radius:28px;border-bottom-right-radius:28px;padding-top:13px;padding-right:20px;padding-bottom:13px;padding-left:20px;font-size:14px;font-style:normal;font-weight:600;text-transform:capitalize"><?php echo esc_html__( 'Learn More', 'fundraiser-nonprofit' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->