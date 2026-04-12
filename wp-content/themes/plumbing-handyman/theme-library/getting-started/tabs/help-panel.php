<?php
/**
 * Help Panel.
 *
 * @package plumbing_handyman
 */
?>

<div id="help-panel" class="panel-left visible">
    <div id="#help-panel" class="steps">  
        <h4 class="c">
            <?php esc_html_e( 'Quick Setup for Home Page', 'plumbing-handyman' ); ?>
            <a href="<?php echo esc_url( PLUMBING_HANDYMAN_THEME_DOCUMENTATION ); ?>" class="button button-primary" style="margin-left: 5px; margin-right: 10px;" target="_blank"><?php esc_html_e( 'Free Theme Documentation', 'plumbing-handyman' ); ?></a>
        </h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to the Dashboard. navigate to pages, add a new one, and label it "home" or whatever else you like.The page has now been created.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '2) Go back to the Dashboard and then select Settings.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '3) Then Go to readings in the setting.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '4) There are 2 options your latest post or static page.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '5) Select static page and select from the dropdown you wish to use as your home page, save changes.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '6) You can set the home page in this manner.', 'plumbing-handyman' ); ?></p>
        <br>
        <h4><?php esc_html_e( 'Setup Banner Section', 'plumbing-handyman' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to Dashboard > Go to Appereance > then Go to Customizer.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > Go to Banner Section.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '4) In Banner Section > Enable the Toggle button > and fill the following details.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '5) In this way you can set Banner Section.', 'plumbing-handyman' ); ?></p>
        <br>
        <h4><?php esc_html_e( 'Setup Properties Section', 'plumbing-handyman' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to Dashboard > Appearance > then Customizer.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > then go to Properties Section.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '3) In Properties Section > Enable the Toggle button to activate the section.', 'plumbing-handyman' ); ?></p>
        <p><?php esc_html_e( '4) In this way, you can set up the Properties Section.', 'plumbing-handyman' ); ?></p>
        <br>
    </div>
    <div class="custom-setting">
        <h4><?php esc_html_e( 'Quick Customizer Settings', 'plumbing-handyman' ); ?></h4>
        <span><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'plumbing-handyman' ); ?></a></span>
    </div>
    <hr>
   <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img1.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Site Logo', 'plumbing-handyman' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'plumbing-handyman' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img2.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Color Picker', 'plumbing-handyman' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=plumbing_handyman_primary_color' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'plumbing-handyman' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img3.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Theme Options', 'plumbing-handyman' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=plumbing_handyman_theme_options' ) ); ?>"target="_blank" class=""><?php esc_html_e( 'Customize', 'plumbing-handyman' ); ?></a>
            
        </div>
    </div>
    <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img4.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Header Image ', 'plumbing-handyman' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=header_image' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'plumbing-handyman' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img5.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Footer Option ', 'plumbing-handyman' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=plumbing_handyman_footer_copyright_text' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'plumbing-handyman' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img6.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Front Page Option', 'plumbing-handyman' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=plumbing_handyman_front_page_options' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'plumbing-handyman' ); ?></a>
            
        </div>
    </div>
</div>