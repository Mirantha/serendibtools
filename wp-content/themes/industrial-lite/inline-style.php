<?php
	/*------------------------------ Global First Color -----------*/

	$industrial_lite_first_color = get_theme_mod('industrial_lite_first_color');

	$industrial_lite_custom_css = '';

	if($industrial_lite_first_color != false){
		$industrial_lite_custom_css .='.top-bar-btn a, .more-btn a, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, input[type="submit"], #footer .tagcloud a:hover, #sidebar .custom-social-icons i, #footer .custom-social-icons i, #footer-2, .home-page-header, #sidebar h3, .pagination .current, .pagination a:hover, #sidebar .tagcloud a:hover, #comments input[type="submit"], .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, nav.woocommerce-MyAccount-navigation ul li, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, #footer a.custom_read_more, #sidebar a.custom_read_more, .nav-previous a:hover, .nav-next a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .wp-block-button__link, #preloader, #footer .wp-block-search .wp-block-search__button, #sidebar .wp-block-search .wp-block-search__button, #sidebar .wp-block-search .wp-block-search__label,.bradcrumbs a:hover, .bradcrumbs span, .post-categories li a:hover, nav.navigation.posts-navigation .nav-previous a, nav.navigation.posts-navigation .nav-next a, #sidebar .wp-block-heading, .wp-block-tag-cloud a:hover,.woocommerce-cart .wc-block-grid .wc-block-grid__product-onsale, a.wc-block-components-checkout-return-to-cart-button{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_first_color).';';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_first_color != false){
		$industrial_lite_custom_css .='.wc-block-components-order-summary-item__quantity,.wp-block-woocommerce-cart .wc-block-cart__submit-button, .wc-block-components-checkout-place-order-button, .wc-block-components-totals-coupon__button{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_first_color).'!important;';
		$industrial_lite_custom_css .='}';
	}

	if($industrial_lite_first_color != false){
		$industrial_lite_custom_css .='a, .top-bar i, #serv-section h2 i, #footer li a:hover, #footer .custom-social-icons i:hover, #footer caption, #sidebar caption, .scrollup i, .post-main-box:hover h2, #sidebar ul li a:hover, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .entry-content a, .post-main-box:hover h2 a, .main-navigation a:hover, .main-navigation ul.sub-menu a:hover, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, #footer a.custom_read_more:hover, #footer input[type="submit"]:hover, .post-main-box:hover .post-info a, .single-post .post-info:hover a, .top-bar span a:hover, .logo .site-title a:hover, #slider .inner_carousel h1 a:hover{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_first_color).';';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_first_color != false){
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='border-color: '.esc_attr($industrial_lite_first_color).';';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_first_color != false){
		$industrial_lite_custom_css .='.main-navigation ul ul{';
			$industrial_lite_custom_css .='border-top-color: '.esc_attr($industrial_lite_first_color).';';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_first_color != false){
		$industrial_lite_custom_css .='#footer h3:after, .main-navigation ul ul, .header-fixed, #footer .wp-block-search .wp-block-search__label:after{';
			$industrial_lite_custom_css .='border-bottom-color: '.esc_attr($industrial_lite_first_color).';';
		$industrial_lite_custom_css .='}';
	}

	/*------------------------------ Global Second Color -----------*/

	$industrial_lite_second_color = get_theme_mod('industrial_lite_second_color');

	if($industrial_lite_second_color != false){
		$industrial_lite_custom_css .='.main-header-box, #slider .carousel-control-prev-icon, #slider .carousel-control-next-icon, .more-btn a:hover, #footer, .pagination span, .pagination a, #sidebar .custom-social-icons i:hover, .woocommerce span.onsale, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, #comments a.comment-reply-link, #sidebar a.custom_read_more:hover, #sidebar input[type="submit"]:hover, .header-fixed, .nav-previous a, .nav-next a, .woocommerce nav.woocommerce-pagination ul li a, .wp-block-button .wp-block-button__link:hover, nav.navigation.posts-navigation .nav-previous a:hover, nav.navigation.posts-navigation .nav-next a:hover, a.wc-block-components-checkout-return-to-cart-button:hover{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_second_color).';';
		$industrial_lite_custom_css .='}';
	}

	if($industrial_lite_second_color != false){
		$industrial_lite_custom_css .='.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.wp-block-woocommerce-cart .wc-block-cart__submit-button:hover, .wc-block-components-checkout-place-order-button:hover{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_second_color).'!important;';
		$industrial_lite_custom_css .='}';
	}

	if($industrial_lite_second_color != false){
		$industrial_lite_custom_css .='.top-bar-btn a, #slider .inner_carousel h1 a, .more-btn a, #slider .inner_carousel p, h1, h2, h3, h4, h5, h6, #footer input[type="submit"], #sidebar .custom-social-icons i, #footer .custom-social-icons i, .copyright p, .copyright a, #footer .tagcloud a:hover, .post-main-box h2, .pagination a:hover, .pagination .current, #sidebar input[type="submit"], #sidebar h3, #sidebar .tagcloud a:hover, #comments input[type="submit"], .post-navigation a, input[type="submit"], h2.woocommerce-loop-product__title, .woocommerce div.product .product_title, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce .quantity .qty, .woocommerce-message::before, .woocommerce-info::before, nav.woocommerce-MyAccount-navigation ul li a, .main-header-box .custom-social-icons i:hover, .post-main-box h2 a, #sidebar .woocommerce-product-search button, #footer .woocommerce-product-search button, #footer a.custom_read_more, #sidebar a.custom_read_more, #sidebar .wp-block-search .wp-block-search__label, #footer .wp-block-search .wp-block-search__button, #sidebar .wp-block-search .wp-block-search__button, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, nav.navigation.posts-navigation .nav-previous a, nav.navigation.posts-navigation .nav-next a, #sidebar .wp-block-heading, .wp-block-tag-cloud a:hover{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_second_color).';';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_second_color != false){
		$industrial_lite_custom_css .='.wp-block-button__link, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_second_color).'!important;';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_second_color != false){
		$industrial_lite_custom_css .='.woocommerce .quantity .qty, .loader-line{';
			$industrial_lite_custom_css .='border-color: '.esc_attr($industrial_lite_second_color).';';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_second_color != false){
		$industrial_lite_custom_css .='.woocommerce-message, .woocommerce-info{';
			$industrial_lite_custom_css .='border-top-color: '.esc_attr($industrial_lite_second_color).';';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_second_color != false){
		$industrial_lite_custom_css .='nav.woocommerce-MyAccount-navigation ul li{
		box-shadow: 2px 2px 0 0 '.esc_attr($industrial_lite_second_color).';
		}';
	}

	/*---------------Width Layout ----------------*/

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_width_option','Full Width');
    if($industrial_lite_theme_lay == 'Boxed'){
		$industrial_lite_custom_css .='body{';
			$industrial_lite_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.page-template-custom-home-page .home-page-header{';
			$industrial_lite_custom_css .='width: 97%;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.scrollup i{';
		  $industrial_lite_custom_css .='right: 100px;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.scrollup.left i{';
		  $industrial_lite_custom_css .='left: 100px;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_theme_lay == 'Wide Width'){
		$industrial_lite_custom_css .='body{';
			$industrial_lite_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.scrollup i{';
		  $industrial_lite_custom_css .='right: 30px;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.scrollup.left i{';
		  $industrial_lite_custom_css .='left: 30px;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_theme_lay == 'Full Width'){
		$industrial_lite_custom_css .='body{';
			$industrial_lite_custom_css .='max-width: 100%;';
		$industrial_lite_custom_css .='}';
	}

	/*-------------- Slider Opacity -------------------*/

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_slider_opacity_color','');
	if($industrial_lite_theme_lay == '0'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.1'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.1';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.2'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.2';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.3'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.3';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.4'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.4';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.5'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.5';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.6'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.6';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.7'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.7';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.8'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.8';
		$industrial_lite_custom_css .='}';
		}else if($industrial_lite_theme_lay == '0.9'){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:0.9';
		$industrial_lite_custom_css .='}';
		}

	/*---------------------- Slider Image Overlay ------------------------*/

	$industrial_lite_slider_image_overlay = get_theme_mod('industrial_lite_slider_image_overlay', true);
	if($industrial_lite_slider_image_overlay == false){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='opacity:1;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_slider_image_overlay_color = get_theme_mod('industrial_lite_slider_image_overlay_color', true);
	if($industrial_lite_slider_image_overlay_color != false){
		$industrial_lite_custom_css .='#slider{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_slider_image_overlay_color).';';
		$industrial_lite_custom_css .='}';
	}

	/*-----------------------Slider Content Layout -------------------*/

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_slider_content_option','Left');
    if($industrial_lite_theme_lay == 'Left'){
		$industrial_lite_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$industrial_lite_custom_css .='text-align:left; left:15%; right:45%;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_theme_lay == 'Center'){
		$industrial_lite_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$industrial_lite_custom_css .='text-align:center; left:20%; right:20%;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#slider .inner_carousel h1{';
			$industrial_lite_custom_css .='padding: 0;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_theme_lay == 'Right'){
		$industrial_lite_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$industrial_lite_custom_css .='text-align:right; left:45%; right:15%;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#slider .inner_carousel h1, #slider .inner_carousel p{';
			$industrial_lite_custom_css .='padding: 0;';
		$industrial_lite_custom_css .='}';
	}

	/*------------- Slider Content Padding Settings ------------------*/

	$industrial_lite_slider_content_padding_top_bottom = get_theme_mod('industrial_lite_slider_content_padding_top_bottom');
	$industrial_lite_slider_content_padding_left_right = get_theme_mod('industrial_lite_slider_content_padding_left_right');
	if($industrial_lite_slider_content_padding_top_bottom != false || $industrial_lite_slider_content_padding_left_right != false){
		$industrial_lite_custom_css .='#slider .carousel-caption{';
			$industrial_lite_custom_css .='top: '.esc_attr($industrial_lite_slider_content_padding_top_bottom).'; bottom: '.esc_attr($industrial_lite_slider_content_padding_top_bottom).';left: '.esc_attr($industrial_lite_slider_content_padding_left_right).';right: '.esc_attr($industrial_lite_slider_content_padding_left_right).';';
		$industrial_lite_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$industrial_lite_slider_height = get_theme_mod('industrial_lite_slider_height');
	if($industrial_lite_slider_height != false){
		$industrial_lite_custom_css .='#slider img{';
			$industrial_lite_custom_css .='height: '.esc_attr($industrial_lite_slider_height).';';
		$industrial_lite_custom_css .='}';
	}
	
	/*---------------------------Blog Layout -------------------*/

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_blog_layout_option','Default');
    if($industrial_lite_theme_lay == 'Default'){
		$industrial_lite_custom_css .='.post-main-box{';
			$industrial_lite_custom_css .='';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_theme_lay == 'Center'){
		$industrial_lite_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .post-main-box .more-btn{';
			$industrial_lite_custom_css .='text-align:center;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.post-info{';
			$industrial_lite_custom_css .='margin-top:10px;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.post-info hr{';
			$industrial_lite_custom_css .='margin:10px auto;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_theme_lay == 'Left'){
		$industrial_lite_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .post-main-box .more-btn, #our-services p{';
			$industrial_lite_custom_css .='text-align:Left;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.post-info hr{';
			$industrial_lite_custom_css .='margin-bottom:10px;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='.post-main-box h2{';
			$industrial_lite_custom_css .='margin-top:10px;';
		$industrial_lite_custom_css .='}';
	}

	/*--------------------- Blog Page Posts -------------------*/

	$industrial_lite_blog_page_posts_settings = get_theme_mod( 'industrial_lite_blog_page_posts_settings','Into Blocks');
    if($industrial_lite_blog_page_posts_settings == 'Without Blocks'){
		$industrial_lite_custom_css .='.post-main-box{';
			$industrial_lite_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_related_image_box_shadow = get_theme_mod('industrial_lite_related_image_box_shadow',0);
	if($industrial_lite_related_image_box_shadow != false){
		$industrial_lite_custom_css .='.related-post .box-image img{';
			$industrial_lite_custom_css .='box-shadow: '.esc_attr($industrial_lite_related_image_box_shadow).'px '.esc_attr($industrial_lite_related_image_box_shadow).'px '.esc_attr($industrial_lite_related_image_box_shadow).'px #cccccc;';
		$industrial_lite_custom_css .='}';
	}


	/*--------------------- Grid Posts -------------------*/

	$industrial_lite_display_grid_posts_settings = get_theme_mod( 'industrial_lite_display_grid_posts_settings','Into Blocks');
    if($industrial_lite_display_grid_posts_settings == 'Without Blocks'){
		$industrial_lite_custom_css .='.grid-post-main-box{';
			$industrial_lite_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$industrial_lite_custom_css .='}';
	}
	
	$industrial_lite_grid_featured_image_border_radius = get_theme_mod('industrial_lite_grid_featured_image_border_radius', 0);
	if($industrial_lite_grid_featured_image_border_radius != false){
		$industrial_lite_custom_css .='.grid-post-main-box .box-image img, .grid-post-main-box .feature-box img{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_grid_featured_image_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_grid_featured_image_box_shadow = get_theme_mod('industrial_lite_grid_featured_image_box_shadow',0);
	if($industrial_lite_grid_featured_image_box_shadow != false){
		$industrial_lite_custom_css .='.grid-post-main-box .box-image img, .grid-post-main-box .feature-box img, #content-vw img{';
			$industrial_lite_custom_css .='box-shadow: '.esc_attr($industrial_lite_grid_featured_image_box_shadow).'px '.esc_attr($industrial_lite_grid_featured_image_box_shadow).'px '.esc_attr($industrial_lite_grid_featured_image_box_shadow).'px #cccccc;';
		$industrial_lite_custom_css .='}';
	}

	// featured image dimention
	$industrial_lite_blog_post_featured_image_dimension = get_theme_mod('industrial_lite_blog_post_featured_image_dimension', 'default');
	$industrial_lite_blog_post_featured_image_custom_width = get_theme_mod('industrial_lite_blog_post_featured_image_custom_width',250);
	$industrial_lite_blog_post_featured_image_custom_height = get_theme_mod('industrial_lite_blog_post_featured_image_custom_height',250);
	if($industrial_lite_blog_post_featured_image_dimension == 'custom'){
		$industrial_lite_custom_css .='.post-main-box img{';
			$industrial_lite_custom_css .='width: '.esc_attr($industrial_lite_blog_post_featured_image_custom_width).'; height: '.esc_attr($industrial_lite_blog_post_featured_image_custom_height).';';
		$industrial_lite_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$industrial_lite_resp_topbar = get_theme_mod( 'industrial_lite_resp_topbar_hide_show',true);
	if($industrial_lite_resp_topbar == true && get_theme_mod( 'industrial_lite_topbar_hide_show', true) == false){
    	$industrial_lite_custom_css .='.top-bar{';
			$industrial_lite_custom_css .='display:none;';
		$industrial_lite_custom_css .='} ';
	}
    if($industrial_lite_resp_topbar == true){
    	$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='.top-bar{';
			$industrial_lite_custom_css .='display:block;';
		$industrial_lite_custom_css .='} }';
	}else if($industrial_lite_resp_topbar == false){
		$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='.top-bar{';
			$industrial_lite_custom_css .='display:none;';
		$industrial_lite_custom_css .='} }';
	}

	$industrial_lite_resp_stickyheader = get_theme_mod( 'industrial_lite_stickyheader_hide_show',false);
	if($industrial_lite_resp_stickyheader == true && get_theme_mod( 'industrial_lite_sticky_header',false) != true){
    	$industrial_lite_custom_css .='.header-fixed{';
			$industrial_lite_custom_css .='position:static;';
		$industrial_lite_custom_css .='} ';
	}
    if($industrial_lite_resp_stickyheader == true){
    	$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='.header-fixed{';
			$industrial_lite_custom_css .='position:fixed;';
		$industrial_lite_custom_css .='} }';
	}else if($industrial_lite_resp_stickyheader == false){
		$industrial_lite_custom_css .='@media screen and (max-width:575px){';
		$industrial_lite_custom_css .='.header-fixed{';
			$industrial_lite_custom_css .='position:static;';
		$industrial_lite_custom_css .='} }';
	}

	$industrial_lite_resp_slider = get_theme_mod( 'industrial_lite_resp_slider_hide_show',true);
	if($industrial_lite_resp_slider == true && get_theme_mod( 'industrial_lite_slider_arrows', true) == false){
    	$industrial_lite_custom_css .='#slider{';
			$industrial_lite_custom_css .='display:none;';
		$industrial_lite_custom_css .='} ';
	}
    if($industrial_lite_resp_slider == true){
    	$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='#slider{';
			$industrial_lite_custom_css .='display:block;';
		$industrial_lite_custom_css .='} }';
	}else if($industrial_lite_resp_slider == false){
		$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='#slider{';
			$industrial_lite_custom_css .='display:none;';
		$industrial_lite_custom_css .='} }';
	}

	$industrial_lite_sidebar = get_theme_mod( 'industrial_lite_sidebar_hide_show',true);
    if($industrial_lite_sidebar == true){
    	$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='#sidebar{';
			$industrial_lite_custom_css .='display:block;';
		$industrial_lite_custom_css .='} }';
	}else if($industrial_lite_sidebar == false){
		$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='#sidebar{';
			$industrial_lite_custom_css .='display:none;';
		$industrial_lite_custom_css .='} }';
	}

	$industrial_lite_resp_scroll_top = get_theme_mod( 'industrial_lite_resp_scroll_top_hide_show',true);
	if($industrial_lite_resp_scroll_top == true && get_theme_mod( 'industrial_lite_hide_show_scroll',true) != true){
    	$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='visibility:hidden !important;';
		$industrial_lite_custom_css .='} ';
	}
    if($industrial_lite_resp_scroll_top == true){
    	$industrial_lite_custom_css .='@media screen and (max-width:575px) {';
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='visibility:visible !important;';
		$industrial_lite_custom_css .='} }';
	}else if($industrial_lite_resp_scroll_top == false){
		$industrial_lite_custom_css .='@media screen and (max-width:575px){';
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='visibility:hidden !important;';
		$industrial_lite_custom_css .='} }';
	}

	$industrial_lite_resp_menu_toggle_btn_bg_color = get_theme_mod('industrial_lite_resp_menu_toggle_btn_bg_color');
	if($industrial_lite_resp_menu_toggle_btn_bg_color != false){
		$industrial_lite_custom_css .='.toggle-nav i{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_resp_menu_toggle_btn_bg_color).';';
		$industrial_lite_custom_css .='}';
	}

	/*------------- Top Bar Settings ------------------*/

	$industrial_lite_topbar_padding_top_bottom = get_theme_mod('industrial_lite_topbar_padding_top_bottom');
	if($industrial_lite_topbar_padding_top_bottom != false){
		$industrial_lite_custom_css .='.top-bar{';
			$industrial_lite_custom_css .='padding-top: '.esc_attr($industrial_lite_topbar_padding_top_bottom).'; padding-bottom: '.esc_attr($industrial_lite_topbar_padding_top_bottom).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_header_menus_color = get_theme_mod('industrial_lite_header_menus_color');
	if($industrial_lite_header_menus_color != false){
		$industrial_lite_custom_css .='.main-navigation a{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_header_menus_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_header_menus_hover_color = get_theme_mod('industrial_lite_header_menus_hover_color');
	if($industrial_lite_header_menus_hover_color != false){
		$industrial_lite_custom_css .='.main-navigation a:hover{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_header_menus_hover_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_header_submenus_color = get_theme_mod('industrial_lite_header_submenus_color');
	if($industrial_lite_header_submenus_color != false){
		$industrial_lite_custom_css .='.main-navigation ul ul a{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_header_submenus_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_header_submenus_hover_color = get_theme_mod('industrial_lite_header_submenus_hover_color');
	if($industrial_lite_header_submenus_hover_color != false){
		$industrial_lite_custom_css .='.main-navigation ul.sub-menu a:hover{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_header_submenus_hover_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_menus_item = get_theme_mod( 'industrial_lite_menus_item_style','None');
    if($industrial_lite_menus_item == 'None'){
		$industrial_lite_custom_css .='.main-navigation a{';
			$industrial_lite_custom_css .='';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_menus_item == 'Zoom In'){
		$industrial_lite_custom_css .='.main-navigation a:hover{';
			$industrial_lite_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #fff;';
		$industrial_lite_custom_css .='}';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$industrial_lite_navigation_menu_font_size = get_theme_mod('industrial_lite_navigation_menu_font_size');
	if($industrial_lite_navigation_menu_font_size != false){
		$industrial_lite_custom_css .='.main-navigation a{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_navigation_menu_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_navigation_menu_font_weight = get_theme_mod('industrial_lite_navigation_menu_font_weight','700');
	if($industrial_lite_navigation_menu_font_weight != false){
		$industrial_lite_custom_css .='.main-navigation a{';
			$industrial_lite_custom_css .='font-weight: '.esc_attr($industrial_lite_navigation_menu_font_weight).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_menu_text_transform','Capitalize');
	if($industrial_lite_theme_lay == 'Capitalize'){
		$industrial_lite_custom_css .='.main-navigation a{';
			$industrial_lite_custom_css .='text-transform:Capitalize;';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_theme_lay == 'Lowercase'){
		$industrial_lite_custom_css .='.main-navigation a{';
			$industrial_lite_custom_css .='text-transform:Lowercase;';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_theme_lay == 'Uppercase'){
		$industrial_lite_custom_css .='.main-navigation a{';
			$industrial_lite_custom_css .='text-transform:Uppercase;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_sticky_header_padding = get_theme_mod('industrial_lite_sticky_header_padding');
	if($industrial_lite_sticky_header_padding != false){
		$industrial_lite_custom_css .='.header-fixed{';
			$industrial_lite_custom_css .='padding: '.esc_attr($industrial_lite_sticky_header_padding).';';
		$industrial_lite_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/
	
	$industrial_lite_search_font_size = get_theme_mod('industrial_lite_search_font_size');
	if($industrial_lite_search_font_size != false){
		$industrial_lite_custom_css .='.search-box i{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_search_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$industrial_lite_button_padding_top_bottom = get_theme_mod('industrial_lite_button_padding_top_bottom');
	$industrial_lite_button_padding_left_right = get_theme_mod('industrial_lite_button_padding_left_right');
	if($industrial_lite_button_padding_top_bottom != false || $industrial_lite_button_padding_left_right != false){
		$industrial_lite_custom_css .='.post-main-box .more-btn a{';
			$industrial_lite_custom_css .='padding-top: '.esc_attr($industrial_lite_button_padding_top_bottom).'; padding-bottom: '.esc_attr($industrial_lite_button_padding_top_bottom).';padding-left: '.esc_attr($industrial_lite_button_padding_left_right).';padding-right: '.esc_attr($industrial_lite_button_padding_left_right).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_button_border_radius = get_theme_mod('industrial_lite_button_border_radius');
	if($industrial_lite_button_border_radius != false){
		$industrial_lite_custom_css .='.post-main-box .more-btn a{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_button_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_button_font_size = get_theme_mod('industrial_lite_button_font_size',14);
	$industrial_lite_custom_css .='.post-main-box .more-btn a{';
		$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_button_font_size).';';
	$industrial_lite_custom_css .='}';

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_button_text_transform','Uppercase');
	if($industrial_lite_theme_lay == 'Capitalize'){
		$industrial_lite_custom_css .='.post-main-box .more-btn a{';
			$industrial_lite_custom_css .='text-transform:Capitalize;';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_theme_lay == 'Lowercase'){
		$industrial_lite_custom_css .='.post-main-box .more-btn a{';
			$industrial_lite_custom_css .='text-transform:Lowercase;';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_theme_lay == 'Uppercase'){ 
		$industrial_lite_custom_css .='.post-main-box .more-btn a{';
			$industrial_lite_custom_css .='text-transform:Uppercase;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_button_letter_spacing = get_theme_mod('industrial_lite_button_letter_spacing');
	$industrial_lite_custom_css .='.post-main-box .more-btn a{';
		$industrial_lite_custom_css .='letter-spacing: '.esc_attr($industrial_lite_button_letter_spacing).';';
	$industrial_lite_custom_css .='}';

	/*------------- Single Blog Page------------------*/

	$industrial_lite_featured_image_border_radius = get_theme_mod('industrial_lite_featured_image_border_radius', 0);
	if($industrial_lite_featured_image_border_radius != false){
		$industrial_lite_custom_css .='.box-image img, .feature-box img{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_featured_image_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_featured_image_box_shadow = get_theme_mod('industrial_lite_featured_image_box_shadow',0);
	if($industrial_lite_featured_image_box_shadow != false){
		$industrial_lite_custom_css .='.box-image img, #content-vw img{';
			$industrial_lite_custom_css .='box-shadow: '.esc_attr($industrial_lite_featured_image_box_shadow).'px '.esc_attr($industrial_lite_featured_image_box_shadow).'px '.esc_attr($industrial_lite_featured_image_box_shadow).'px #cccccc;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_singlepost_image_box_shadow = get_theme_mod('industrial_lite_singlepost_image_box_shadow',0);
	if($industrial_lite_singlepost_image_box_shadow != false){
		$industrial_lite_custom_css .='.feature-box img{';
			$industrial_lite_custom_css .='box-shadow: '.esc_attr($industrial_lite_singlepost_image_box_shadow).'px '.esc_attr($industrial_lite_singlepost_image_box_shadow).'px '.esc_attr($industrial_lite_singlepost_image_box_shadow).'px #cccccc;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_single_blog_post_navigation_show_hide = get_theme_mod('industrial_lite_single_blog_post_navigation_show_hide',true);
	if($industrial_lite_single_blog_post_navigation_show_hide != true){
		$industrial_lite_custom_css .='.post-navigation{';
			$industrial_lite_custom_css .='display: none;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_single_blog_comment_title = get_theme_mod('industrial_lite_single_blog_comment_title', 'Leave a Reply');
	if($industrial_lite_single_blog_comment_title == ''){
		$industrial_lite_custom_css .='#comments h2#reply-title {';
			$industrial_lite_custom_css .='display: none;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_single_blog_comment_button_text = get_theme_mod('industrial_lite_single_blog_comment_button_text', 'Post Comment');
	if($industrial_lite_single_blog_comment_button_text == ''){
		$industrial_lite_custom_css .='#comments p.form-submit {';
			$industrial_lite_custom_css .='display: none;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_comment_width = get_theme_mod('industrial_lite_single_blog_comment_width');
	if($industrial_lite_comment_width != false){
		$industrial_lite_custom_css .='#comments textarea{';
			$industrial_lite_custom_css .='width: '.esc_attr($industrial_lite_comment_width).';';
		$industrial_lite_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$industrial_lite_copyright_background_color = get_theme_mod('industrial_lite_copyright_background_color');
	if($industrial_lite_copyright_background_color != false){
		$industrial_lite_custom_css .='#footer-2{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_copyright_background_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_footer_background_color = get_theme_mod('industrial_lite_footer_background_color');
	if($industrial_lite_footer_background_color != false){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_footer_background_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_footer_widgets_heading = get_theme_mod( 'industrial_lite_footer_widgets_heading','Left');
    if($industrial_lite_footer_widgets_heading == 'Left'){
		$industrial_lite_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
		$industrial_lite_custom_css .='text-align: left;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_footer_widgets_heading == 'Center'){
		$industrial_lite_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$industrial_lite_custom_css .='text-align: center; position: relative;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer h3:after, #footer .wp-block-search .wp-block-search__label:after{';
			$industrial_lite_custom_css .='margin: 0 auto;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_footer_widgets_heading == 'Right'){
		$industrial_lite_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$industrial_lite_custom_css .='text-align: right; position: relative;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer h3:after, #footer .wp-block-search .wp-block-search__label:after{';
			$industrial_lite_custom_css .='margin-left: auto;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_footer_widgets_content = get_theme_mod( 'industrial_lite_footer_widgets_content','Left');
    if($industrial_lite_footer_widgets_content == 'Left'){
		$industrial_lite_custom_css .='#footer .widget{';
		$industrial_lite_custom_css .='text-align: left;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_footer_widgets_content == 'Center'){
		$industrial_lite_custom_css .='#footer .widget{';
			$industrial_lite_custom_css .='text-align: center;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_footer_widgets_content == 'Right'){
		$industrial_lite_custom_css .='#footer .widget{';
			$industrial_lite_custom_css .='text-align: right;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_copyright_font_size = get_theme_mod('industrial_lite_copyright_font_size');
	if($industrial_lite_copyright_font_size != false){
		$industrial_lite_custom_css .='.copyright p{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_copyright_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_copyright_alingment = get_theme_mod('industrial_lite_copyright_alingment');
	if($industrial_lite_copyright_alingment != false){
		$industrial_lite_custom_css .='.copyright p,#footer-2 p{';
			$industrial_lite_custom_css .='text-align: '.esc_attr($industrial_lite_copyright_alingment).';';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='
		@media screen and (max-width:720px) {
			.copyright p,#footer-2 p{';
			$industrial_lite_custom_css .='text-align: center;} }';
	}

	$industrial_lite_resp_stickycopyright = get_theme_mod( 'industrial_lite_stickycopyright_hide_show',false);
	if($industrial_lite_resp_stickycopyright == true && get_theme_mod( 'industrial_lite_copyright_sticky',false) != true){
    	$industrial_lite_custom_css .='.copyright-sticky{';
			$industrial_lite_custom_css .='position:static;';
		$industrial_lite_custom_css .='} ';
	}

	$industrial_lite_footer_social_icons_font_size = get_theme_mod('industrial_lite_footer_social_icons_font_size','16');
	$industrial_lite_custom_css .='.copyright .widget i{';
		$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_footer_social_icons_font_size).'px;';
	$industrial_lite_custom_css .='}';

	$industrial_lite_align_footer_social_icon = get_theme_mod('industrial_lite_align_footer_social_icon');
	if($industrial_lite_align_footer_social_icon != false){
		$industrial_lite_custom_css .='.copyright .widget{';
			$industrial_lite_custom_css .='text-align: '.esc_attr($industrial_lite_align_footer_social_icon).';';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='
		@media screen and (max-width:720px) {
			.copyright .widget{';
			$industrial_lite_custom_css .='text-align: center;} }';
	}

	$industrial_lite_copyright_padding_top_bottom = get_theme_mod('industrial_lite_copyright_padding_top_bottom');
	if($industrial_lite_copyright_padding_top_bottom != false){
		$industrial_lite_custom_css .='#footer-2{';
			$industrial_lite_custom_css .='padding-top: '.esc_attr($industrial_lite_copyright_padding_top_bottom).'; padding-bottom: '.esc_attr($industrial_lite_copyright_padding_top_bottom).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_footer_padding = get_theme_mod('industrial_lite_footer_padding');
	if($industrial_lite_footer_padding != false){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='padding: '.esc_attr($industrial_lite_footer_padding).' 0;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_footer_background_image = get_theme_mod('industrial_lite_footer_background_image');
	if($industrial_lite_footer_background_image != false){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background: url('.esc_attr($industrial_lite_footer_background_image).');background-size:cover;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_img_footer','scroll');
	if($industrial_lite_theme_lay == 'fixed'){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background-attachment: fixed !important;';
		$industrial_lite_custom_css .='}';
	}elseif ($industrial_lite_theme_lay == 'scroll'){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background-attachment: scroll !important;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_footer_img_position = get_theme_mod('industrial_lite_footer_img_position','center center');
	if($industrial_lite_footer_img_position != false){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background-position: '.esc_attr($industrial_lite_footer_img_position).'!important;';
		$industrial_lite_custom_css .='}';
	} 

	/*----------------Sroll to top Settings ------------------*/

	$industrial_lite_scroll_to_top_font_size = get_theme_mod('industrial_lite_scroll_to_top_font_size');
	if($industrial_lite_scroll_to_top_font_size != false){
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_scroll_to_top_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_scroll_to_top_padding = get_theme_mod('industrial_lite_scroll_to_top_padding');
	$industrial_lite_scroll_to_top_padding = get_theme_mod('industrial_lite_scroll_to_top_padding');
	if($industrial_lite_scroll_to_top_padding != false){
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='padding-top: '.esc_attr($industrial_lite_scroll_to_top_padding).';padding-bottom: '.esc_attr($industrial_lite_scroll_to_top_padding).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_scroll_to_top_width = get_theme_mod('industrial_lite_scroll_to_top_width');
	if($industrial_lite_scroll_to_top_width != false){
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='width: '.esc_attr($industrial_lite_scroll_to_top_width).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_scroll_to_top_height = get_theme_mod('industrial_lite_scroll_to_top_height');
	if($industrial_lite_scroll_to_top_height != false){
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='height: '.esc_attr($industrial_lite_scroll_to_top_height).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_scroll_to_top_border_radius = get_theme_mod('industrial_lite_scroll_to_top_border_radius');
	if($industrial_lite_scroll_to_top_border_radius != false){
		$industrial_lite_custom_css .='.scrollup i{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_scroll_to_top_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$industrial_lite_social_icon_font_size = get_theme_mod('industrial_lite_social_icon_font_size');
	if($industrial_lite_social_icon_font_size != false){
		$industrial_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_social_icon_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_social_icon_padding = get_theme_mod('industrial_lite_social_icon_padding');
	if($industrial_lite_social_icon_padding != false){
		$industrial_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$industrial_lite_custom_css .='padding: '.esc_attr($industrial_lite_social_icon_padding).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_social_icon_width = get_theme_mod('industrial_lite_social_icon_width');
	if($industrial_lite_social_icon_width != false){
		$industrial_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$industrial_lite_custom_css .='width: '.esc_attr($industrial_lite_social_icon_width).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_social_icon_height = get_theme_mod('industrial_lite_social_icon_height');
	if($industrial_lite_social_icon_height != false){
		$industrial_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$industrial_lite_custom_css .='height: '.esc_attr($industrial_lite_social_icon_height).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_social_icon_border_radius = get_theme_mod('industrial_lite_social_icon_border_radius');
	if($industrial_lite_social_icon_border_radius != false){
		$industrial_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_social_icon_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$industrial_lite_related_product_show_hide = get_theme_mod('industrial_lite_related_product_show_hide',true);
	if($industrial_lite_related_product_show_hide != true){
		$industrial_lite_custom_css .='.related.products{';
			$industrial_lite_custom_css .='display: none;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_products_padding_top_bottom = get_theme_mod('industrial_lite_products_padding_top_bottom');
	if($industrial_lite_products_padding_top_bottom != false){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$industrial_lite_custom_css .='padding-top: '.esc_attr($industrial_lite_products_padding_top_bottom).'!important; padding-bottom: '.esc_attr($industrial_lite_products_padding_top_bottom).'!important;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_products_padding_left_right = get_theme_mod('industrial_lite_products_padding_left_right');
	if($industrial_lite_products_padding_left_right != false){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$industrial_lite_custom_css .='padding-left: '.esc_attr($industrial_lite_products_padding_left_right).'!important; padding-right: '.esc_attr($industrial_lite_products_padding_left_right).'!important;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_products_box_shadow = get_theme_mod('industrial_lite_products_box_shadow');
	if($industrial_lite_products_box_shadow != false){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$industrial_lite_custom_css .='box-shadow: '.esc_attr($industrial_lite_products_box_shadow).'px '.esc_attr($industrial_lite_products_box_shadow).'px '.esc_attr($industrial_lite_products_box_shadow).'px #ddd;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_products_border_radius = get_theme_mod('industrial_lite_products_border_radius', 0);
	if($industrial_lite_products_border_radius != false){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_products_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_products_btn_padding_top_bottom = get_theme_mod('industrial_lite_products_btn_padding_top_bottom');
	if($industrial_lite_products_btn_padding_top_bottom != false){
		$industrial_lite_custom_css .='.woocommerce a.button{';
			$industrial_lite_custom_css .='padding-top: '.esc_attr($industrial_lite_products_btn_padding_top_bottom).' !important; padding-bottom: '.esc_attr($industrial_lite_products_btn_padding_top_bottom).' !important;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_products_btn_padding_left_right = get_theme_mod('industrial_lite_products_btn_padding_left_right');
	if($industrial_lite_products_btn_padding_left_right != false){
		$industrial_lite_custom_css .='.woocommerce a.button{';
			$industrial_lite_custom_css .='padding-left: '.esc_attr($industrial_lite_products_btn_padding_left_right).' !important; padding-right: '.esc_attr($industrial_lite_products_btn_padding_left_right).' !important;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_products_button_border_radius = get_theme_mod('industrial_lite_products_button_border_radius', 5);
	if($industrial_lite_products_button_border_radius != false){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product .button, a.checkout-button.button.alt.wc-forward,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_products_button_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_woocommerce_sale_position = get_theme_mod( 'industrial_lite_woocommerce_sale_position','right');
    if($industrial_lite_woocommerce_sale_position == 'left'){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product .onsale{';
			$industrial_lite_custom_css .='left: -10px; right: auto;';
		$industrial_lite_custom_css .='}';
	}else if($industrial_lite_woocommerce_sale_position == 'right'){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product .onsale{';
			$industrial_lite_custom_css .='left: auto; right: 0;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_woocommerce_sale_font_size = get_theme_mod('industrial_lite_woocommerce_sale_font_size');
	if($industrial_lite_woocommerce_sale_font_size != false){
		$industrial_lite_custom_css .='.woocommerce span.onsale{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_woocommerce_sale_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_woocommerce_sale_padding_top_bottom = get_theme_mod('industrial_lite_woocommerce_sale_padding_top_bottom');
	if($industrial_lite_woocommerce_sale_padding_top_bottom != false){
		$industrial_lite_custom_css .='.woocommerce span.onsale{';
			$industrial_lite_custom_css .='padding-top: '.esc_attr($industrial_lite_woocommerce_sale_padding_top_bottom).'; padding-bottom: '.esc_attr($industrial_lite_woocommerce_sale_padding_top_bottom).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_woocommerce_sale_padding_left_right = get_theme_mod('industrial_lite_woocommerce_sale_padding_left_right');
	if($industrial_lite_woocommerce_sale_padding_left_right != false){
		$industrial_lite_custom_css .='.woocommerce span.onsale{';
			$industrial_lite_custom_css .='padding-left: '.esc_attr($industrial_lite_woocommerce_sale_padding_left_right).'; padding-right: '.esc_attr($industrial_lite_woocommerce_sale_padding_left_right).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_woocommerce_sale_border_radius = get_theme_mod('industrial_lite_woocommerce_sale_border_radius', 0);
	if($industrial_lite_woocommerce_sale_border_radius != false){
		$industrial_lite_custom_css .='.woocommerce span.onsale{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_woocommerce_sale_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	/*------------------ Logo  -------------------*/

	// Site title Font Size
	$industrial_lite_site_title_font_size = get_theme_mod('industrial_lite_site_title_font_size');
	if($industrial_lite_site_title_font_size != false){
		$industrial_lite_custom_css .='.logo h1, .logo p.site-title{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_site_title_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	// Site tagline Font Size
	$industrial_lite_site_tagline_font_size = get_theme_mod('industrial_lite_site_tagline_font_size');
	if($industrial_lite_site_tagline_font_size != false){
		$industrial_lite_custom_css .='.logo p.site-description{';
			$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_site_tagline_font_size).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_logo_padding = get_theme_mod('industrial_lite_logo_padding');
	if($industrial_lite_logo_padding != false){
		$industrial_lite_custom_css .='.logo{';
			$industrial_lite_custom_css .='padding: '.esc_attr($industrial_lite_logo_padding).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_logo_margin = get_theme_mod('industrial_lite_logo_margin');
	if($industrial_lite_logo_margin != false){
		$industrial_lite_custom_css .='.logo{';
			$industrial_lite_custom_css .='margin: '.esc_attr($industrial_lite_logo_margin).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_site_title_color = get_theme_mod('industrial_lite_site_title_color');
	if($industrial_lite_site_title_color != false){
		$industrial_lite_custom_css .='p.site-title a{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_site_title_color).'!important;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_site_tagline_color = get_theme_mod('industrial_lite_site_tagline_color');
	if($industrial_lite_site_tagline_color != false){
		$industrial_lite_custom_css .='.logo p.site-description{';
			$industrial_lite_custom_css .='color: '.esc_attr($industrial_lite_site_tagline_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_logo_width = get_theme_mod('industrial_lite_logo_width');
	if($industrial_lite_logo_width != false){
		$industrial_lite_custom_css .='.logo img{';
			$industrial_lite_custom_css .='width: '.esc_attr($industrial_lite_logo_width).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_logo_height = get_theme_mod('industrial_lite_logo_height');
	if($industrial_lite_logo_height != false){
		$industrial_lite_custom_css .='.logo img{';
			$industrial_lite_custom_css .='height: '.esc_attr($industrial_lite_logo_height).';';
		$industrial_lite_custom_css .='}';
	}

	// Woocommerce img

	$industrial_lite_shop_featured_image_border_radius = get_theme_mod('industrial_lite_shop_featured_image_border_radius', 0);
	if($industrial_lite_shop_featured_image_border_radius != false){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product a img{';
			$industrial_lite_custom_css .='border-radius: '.esc_attr($industrial_lite_shop_featured_image_border_radius).'px;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_shop_featured_image_box_shadow = get_theme_mod('industrial_lite_shop_featured_image_box_shadow');
	if($industrial_lite_shop_featured_image_box_shadow != false){
		$industrial_lite_custom_css .='.woocommerce ul.products li.product a img{';
				$industrial_lite_custom_css .='box-shadow: '.esc_attr($industrial_lite_shop_featured_image_box_shadow).'px '.esc_attr($industrial_lite_shop_featured_image_box_shadow).'px '.esc_attr($industrial_lite_shop_featured_image_box_shadow).'px #ddd;';
		$industrial_lite_custom_css .='}';
	}

	/*------------------ Preloader Background Color  -------------------*/

	$industrial_lite_preloader_bg_color = get_theme_mod('industrial_lite_preloader_bg_color');
	if($industrial_lite_preloader_bg_color != false){
		$industrial_lite_custom_css .='#preloader{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_preloader_bg_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_preloader_border_color = get_theme_mod('industrial_lite_preloader_border_color');
	if($industrial_lite_preloader_border_color != false){
		$industrial_lite_custom_css .='.loader-line{';
			$industrial_lite_custom_css .='border-color: '.esc_attr($industrial_lite_preloader_border_color).'!important;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_preloader_bg_img = get_theme_mod('industrial_lite_preloader_bg_img');
	if($industrial_lite_preloader_bg_img != false){
		$industrial_lite_custom_css .='#preloader{';
			$industrial_lite_custom_css .='background: url('.esc_attr($industrial_lite_preloader_bg_img).');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$industrial_lite_custom_css .='}';
	}

	// Header Background Color
	$industrial_lite_header_background_color = get_theme_mod('industrial_lite_header_background_color');
	if($industrial_lite_header_background_color != false){
		$industrial_lite_custom_css .='.home-page-header{';
			$industrial_lite_custom_css .='background-color: '.esc_attr($industrial_lite_header_background_color).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_header_img_position = get_theme_mod('industrial_lite_header_img_position','center top');
	if($industrial_lite_header_img_position != false){
		$industrial_lite_custom_css .='.home-page-header{';
			$industrial_lite_custom_css .='background-position: '.esc_attr($industrial_lite_header_img_position).'!important;';
		$industrial_lite_custom_css .='}';
	}

	/*---------------------------Footer Style -------------------*/

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_footer_template','industrial_lite-footer-one');
    if($industrial_lite_theme_lay == 'industrial_lite-footer-one'){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='';
		$industrial_lite_custom_css .='}';

	}else if($industrial_lite_theme_lay == 'industrial_lite-footer-two'){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background: linear-gradient(to right, #f9f8ff, #dedafa);';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer p, #footer li a, #footer, #footer h3, #footer a.rsswidget, #footer #wp-calendar a, .copyright a, #footer .custom_details, #footer ins span, #footer .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, #footer ul li a, #footer table, #footer th, #footer td, #footer caption, #sidebar caption,#footer nav.wp-calendar-nav a,#footer .search-form .search-field{';
			$industrial_lite_custom_css .='color:#000;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer ul li::before{';
			$industrial_lite_custom_css .='background:#000;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer table, #footer th, #footer td,#footer .search-form .search-field,#footer .tagcloud a{';
			$industrial_lite_custom_css .='border: 1px solid #000;';
		$industrial_lite_custom_css .='}';

	}else if($industrial_lite_theme_lay == 'industrial_lite-footer-three'){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background: #232524;';
		$industrial_lite_custom_css .='}';
	}
	else if($industrial_lite_theme_lay == 'industrial_lite-footer-four'){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background: #f7f7f7;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer p, #footer li a, #footer, #footer h3, #footer a.rsswidget, #footer #wp-calendar a, .copyright a, #footer .custom_details, #footer ins span, #footer .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, #footer ul li a, #footer table, #footer th, #footer td, #footer caption, #sidebar caption,#footer nav.wp-calendar-nav a,#footer .search-form .search-field{';
			$industrial_lite_custom_css .='color:#000;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer ul li::before{';
			$industrial_lite_custom_css .='background:#000;';
		$industrial_lite_custom_css .='}';
		$industrial_lite_custom_css .='#footer table, #footer th, #footer td,#footer .search-form .search-field,#footer .tagcloud a{';
			$industrial_lite_custom_css .='border: 1px solid #000;';
		$industrial_lite_custom_css .='}';
	}
	else if($industrial_lite_theme_lay == 'industrial_lite-footer-five'){
		$industrial_lite_custom_css .='#footer{';
			$industrial_lite_custom_css .='background: linear-gradient(to right, #01093a, #2d0b00);';
		$industrial_lite_custom_css .='}';
	}

	/*---------------- Footer Settings ------------------*/

	$industrial_lite_button_footer_heading_letter_spacing = get_theme_mod('industrial_lite_button_footer_heading_letter_spacing',1);
	$industrial_lite_custom_css .='#footer h3, a.rsswidget.rss-widget-title{';
		$industrial_lite_custom_css .='letter-spacing: '.esc_attr($industrial_lite_button_footer_heading_letter_spacing).'px;';
	$industrial_lite_custom_css .='}';

	$industrial_lite_button_footer_font_size = get_theme_mod('industrial_lite_button_footer_font_size','30');
	$industrial_lite_custom_css .='#footer h3, a.rsswidget.rss-widget-title{';
		$industrial_lite_custom_css .='font-size: '.esc_attr($industrial_lite_button_footer_font_size).'px;';
	$industrial_lite_custom_css .='}';

	$industrial_lite_theme_lay = get_theme_mod( 'industrial_lite_button_footer_text_transform','Capitalize');
	if($industrial_lite_theme_lay == 'Capitalize'){
		$industrial_lite_custom_css .='#footer h3{';
			$industrial_lite_custom_css .='text-transform:Capitalize;';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_theme_lay == 'Lowercase'){
		$industrial_lite_custom_css .='#footer h3, a.rsswidget.rss-widget-title{';
			$industrial_lite_custom_css .='text-transform:Lowercase;';
		$industrial_lite_custom_css .='}';
	}
	if($industrial_lite_theme_lay == 'Uppercase'){
		$industrial_lite_custom_css .='#footer h3, a.rsswidget.rss-widget-title{';
			$industrial_lite_custom_css .='text-transform:Uppercase;';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_footer_heading_weight = get_theme_mod('industrial_lite_footer_heading_weight','600');
	if($industrial_lite_footer_heading_weight != false){
		$industrial_lite_custom_css .='#footer h3, a.rsswidget.rss-widget-title{';
			$industrial_lite_custom_css .='font-weight: '.esc_attr($industrial_lite_footer_heading_weight).';';
		$industrial_lite_custom_css .='}';
	}

	$industrial_lite_responsive_preloader_hide = get_theme_mod('industrial_lite_responsive_preloader_hide',false);
	if($industrial_lite_responsive_preloader_hide == true && get_theme_mod('industrial_lite_loader_enable',false) == false){
		$industrial_lite_custom_css .='@media screen and (min-width:575px){
			#preloader{';
			$industrial_lite_custom_css .='display:none !important;';
		$industrial_lite_custom_css .='} }';
	}

	if($industrial_lite_responsive_preloader_hide == false){
		$industrial_lite_custom_css .='@media screen and (max-width:575px){
			#preloader{';
			$industrial_lite_custom_css .='display:none !important;';
		$industrial_lite_custom_css .='} }';
	}

	$industrial_lite_bradcrumbs_alignment = get_theme_mod( 'industrial_lite_bradcrumbs_alignment','Left');
    if($industrial_lite_bradcrumbs_alignment == 'Left'){
    	$industrial_lite_custom_css .='@media screen and (min-width:768px) {';
		$industrial_lite_custom_css .='.bradcrumbs{';
			$industrial_lite_custom_css .='text-align:start;';
		$industrial_lite_custom_css .='}}';
	}else if($industrial_lite_bradcrumbs_alignment == 'Center'){
		$industrial_lite_custom_css .='@media screen and (min-width:768px) {';
		$industrial_lite_custom_css .='.bradcrumbs{';
			$industrial_lite_custom_css .='text-align:center;';
		$industrial_lite_custom_css .='}}';
	}else if($industrial_lite_bradcrumbs_alignment == 'Right'){
		$industrial_lite_custom_css .='@media screen and (min-width:768px) {';
		$industrial_lite_custom_css .='.bradcrumbs{';
			$industrial_lite_custom_css .='text-align:end;';
		$industrial_lite_custom_css .='}}';
	}

	// sticky sidebar
		$industrial_lite_resp_stickysidebar = get_theme_mod( 'industrial_lite_stickysidebar_hide_show',false);
	if($industrial_lite_resp_stickysidebar == true && get_theme_mod( 'industrial_lite_sticky_sidebar',false) != true){
		$industrial_lite_custom_css .= '@media (min-width: 768px) {';
    	$industrial_lite_custom_css .='#sidebar{';
			$industrial_lite_custom_css .='position:static;';
		$industrial_lite_custom_css .='} ';
		$industrial_lite_custom_css .= '}';
	}
    // First Letter Capital
	$industrial_lite_show_first_caps = get_theme_mod('industrial_lite_show_first_caps', false);
	if ($industrial_lite_show_first_caps ) {
	    $industrial_lite_custom_css .= '.post-main-box .new-text p:nth-of-type(1)::first-letter {';
	    $industrial_lite_custom_css .=' font-size: 55px;font-weight: 600;margin-right: 5px;';
	    $industrial_lite_custom_css .='}';
	} else {
		$industrial_lite_custom_css .= '.post-main-box .new-text p:nth-of-type(1)::first-letter {';
	    $industrial_lite_custom_css .= 'display: none;';
	    $industrial_lite_custom_css .='}';
	}
	// Hover on featured image //
	$industrial_lite_show_featured = get_theme_mod( 'industrial_lite_featured_image_hide_show', 1 );
	$industrial_lite_hover_effect  = get_theme_mod( 'industrial_lite_featured_image_hover', 'none' );

	if ( $industrial_lite_show_featured && $industrial_lite_hover_effect !== 'none' ) {

		$industrial_lite_custom_css .= '
		.industrial-lite-featured-image img{
			transition: all 0.4s ease;
		}';

		if ( $industrial_lite_hover_effect === 'zoom-in' ) {
			$industrial_lite_custom_css .= '
			.industrial-lite-featured-image:hover img{
				transform: scale(1.2);
			}';
		}

		if ( $industrial_lite_hover_effect === 'zoom-out' ) {
			$industrial_lite_custom_css .= '
			.industrial-lite-featured-image img{
				transform: scale(1.2);
			}
			.industrial-lite-featured-image:hover img{
				transform: scale(1);
			}';
		}

		if ( $industrial_lite_hover_effect === 'grayscale' ) {
			$industrial_lite_custom_css .= '
			.industrial-lite-featured-image img{
				filter: grayscale(100%);
			}
			.industrial-lite-featured-image:hover img{
				filter: grayscale(0);
			}';
		}

		if ( $industrial_lite_hover_effect === 'sepia' ) {
			$industrial_lite_custom_css .= '
			.industrial-lite-featured-image:hover img{
				filter: sepia(100%);
			}';
		}

		if ( $industrial_lite_hover_effect === 'blur' ) {
			$industrial_lite_custom_css .= '
			.industrial-lite-featured-image:hover img{
				filter: blur(3px);
			}';
		}

		if ( $industrial_lite_hover_effect === 'bright' ) {
			$industrial_lite_custom_css .= '
			.industrial-lite-featured-image:hover img{
				filter: brightness(1.3);
			}';
		}

		if ( $industrial_lite_hover_effect === 'translate' ) {
			$industrial_lite_custom_css .= '
			.industrial-lite-featured-image:hover img{
				transform: translateY(-10px);
			}';
		}
	}
