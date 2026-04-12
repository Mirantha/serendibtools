<?php 
	$land_excavator_custom_css ='';

    /*----------------Related Product show/hide -------------------*/

    $land_excavator_enable_related_product = get_theme_mod('land_excavator_enable_related_product',1);

    if($land_excavator_enable_related_product == 0){
        $land_excavator_custom_css .='.related.products{';
            $land_excavator_custom_css .='display: none;';
        $land_excavator_custom_css .='}';
    }

    /*----------------blog post content alignment -------------------*/

    $land_excavator_blog_Post_content_layout = get_theme_mod( 'land_excavator_blog_Post_content_layout','Left');
    if($land_excavator_blog_Post_content_layout == 'Left'){
        $land_excavator_custom_css .='.ct-post-wrapper .card-item {';
            $land_excavator_custom_css .='text-align:start;';
        $land_excavator_custom_css .='}';
    }else if($land_excavator_blog_Post_content_layout == 'Center'){
        $land_excavator_custom_css .='.ct-post-wrapper .card-item {';
            $land_excavator_custom_css .='text-align:center;';
        $land_excavator_custom_css .='}';
    }else if($land_excavator_blog_Post_content_layout == 'Right'){
        $land_excavator_custom_css .='.ct-post-wrapper .card-item {';
            $land_excavator_custom_css .='text-align:end;';
        $land_excavator_custom_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $land_excavator_footer_bg_image = get_theme_mod('land_excavator_footer_bg_image');
    if($land_excavator_footer_bg_image != false){
        $land_excavator_custom_css .='.footer-top{';
            $land_excavator_custom_css .='background: url('.esc_attr($land_excavator_footer_bg_image).');';
        $land_excavator_custom_css .='}';
    }

    /*--------------------------- Go to top positions -------------------*/

    $land_excavator_go_to_top_position = get_theme_mod( 'land_excavator_go_to_top_position','Right');
    if($land_excavator_go_to_top_position == 'Right'){
        $land_excavator_custom_css .='.footer-go-to-top{';
            $land_excavator_custom_css .='right: 20px;';
        $land_excavator_custom_css .='}';
    }else if($land_excavator_go_to_top_position == 'Left'){
        $land_excavator_custom_css .='.footer-go-to-top{';
            $land_excavator_custom_css .='left: 20px;';
        $land_excavator_custom_css .='}';
    }else if($land_excavator_go_to_top_position == 'Center'){
        $land_excavator_custom_css .='.footer-go-to-top{';
            $land_excavator_custom_css .='right: 50%;left: 50%;';
        $land_excavator_custom_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $land_excavator_product_sale = get_theme_mod( 'land_excavator_woocommerce_product_sale','Right');
    if($land_excavator_product_sale == 'Right'){
        $land_excavator_custom_css .='.woocommerce ul.products li.product .onsale{';
            $land_excavator_custom_css .='left: auto; ';
        $land_excavator_custom_css .='}';
    }else if($land_excavator_product_sale == 'Left'){
        $land_excavator_custom_css .='.woocommerce ul.products li.product .onsale{';
            $land_excavator_custom_css .='right: auto;left:0;';
        $land_excavator_custom_css .='}';
    }else if($land_excavator_product_sale == 'Center'){
        $land_excavator_custom_css .='.woocommerce ul.products li.product .onsale{';
            $land_excavator_custom_css .='right: 50%; left: 50%; ';
        $land_excavator_custom_css .='}';
    }


    /*-------------------- Primary Color -------------------*/

	$land_excavator_primary_color = get_theme_mod('land_excavator_primary_color', '#EDB509'); // Add a fallback if the color isn't set

	if ($land_excavator_primary_color) {
		$land_excavator_custom_css .= ':root {';
		$land_excavator_custom_css .= '--primary-color: ' . esc_attr($land_excavator_primary_color) . ';';
		$land_excavator_custom_css .= '}';
	}	


	/*--------------------------- slider-------------------*/

    $land_excavator_enable_slider = get_theme_mod('land_excavator_enable_slider', 0);
    if($land_excavator_enable_slider != 1){
        $land_excavator_custom_css .='.page-template-revolution-home .header-menu-box{';
            $land_excavator_custom_css .='position:static;';
        $land_excavator_custom_css .='}';
         $land_excavator_custom_css .='.page-template-revolution-home .site-branding .site-title a, .page-template-revolution-home .main-navigation ul#primary-menu>li>a, .page-template-revolution-home .main-navigation div#primary-menu>ul>li>a, .page-template-revolution-home .site-description{';
            $land_excavator_custom_css .='color:#000;';
        $land_excavator_custom_css .='}';
        $land_excavator_custom_css .='.page-template-revolution-home .header-button a:hover{';
            $land_excavator_custom_css .='outline-color:#000;background-color:#000; color:#fff;';
        $land_excavator_custom_css .='}';
        $land_excavator_custom_css .='.page-template-revolution-home .header-menu-box{';
            $land_excavator_custom_css .='border-bottom:1px solid #ccc;';
        $land_excavator_custom_css .='}';
    }

    /*----------------Enable/Disable Breadcrumbs -------------------*/

    $land_excavator_enable_breadcrumbs = get_theme_mod('land_excavator_enable_breadcrumbs',1);

    if($land_excavator_enable_breadcrumbs == 0){
        $land_excavator_custom_css .='.land-excavator-breadcrumbs, nav.woocommerce-breadcrumb{';
            $land_excavator_custom_css .='display: none;';
        $land_excavator_custom_css .='}';
    }