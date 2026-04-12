<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! plumbing_handyman_has_page_header() ) {
    return;
}

$plumbing_handyman_classes = array( 'page-header' );
$plumbing_handyman_style = plumbing_handyman_page_header_style();

if ( $plumbing_handyman_style ) {
    $plumbing_handyman_classes[] = $plumbing_handyman_style . '-page-header';
}

$plumbing_handyman_visibility = get_theme_mod( 'plumbing_handyman_page_header_visibility', 'all-devices' );

if ( 'hide-all-devices' === $plumbing_handyman_visibility ) {
    // Don't show the header at all
    return;
}

if ( 'hide-tablet' === $plumbing_handyman_visibility ) {
    $plumbing_handyman_classes[] = 'hide-on-tablet';
} elseif ( 'hide-mobile' === $plumbing_handyman_visibility ) {
    $plumbing_handyman_classes[] = 'hide-on-mobile';
} elseif ( 'hide-tablet-mobile' === $plumbing_handyman_visibility ) {
    $plumbing_handyman_classes[] = 'hide-on-tablet-mobile';
}

$plumbing_handyman_PAGE_TITLE_background_color = get_theme_mod('plumbing_handyman_page_title_background_color_setting', '');

// Get the toggle switch value
$plumbing_handyman_background_image_enabled = get_theme_mod('plumbing_handyman_page_header_style', true);

// Add background image to the header if enabled
$plumbing_handyman_background_image = get_theme_mod( 'plumbing_handyman_page_header_background_image', '' );
$plumbing_handyman_background_height = get_theme_mod( 'plumbing_handyman_page_header_image_height', '200' );
$plumbing_handyman_inline_style = '';

if ( $plumbing_handyman_background_image_enabled && ! empty( $plumbing_handyman_background_image ) ) {
    $plumbing_handyman_inline_style .= 'background-image: url(' . esc_url( $plumbing_handyman_background_image ) . '); ';
    $plumbing_handyman_inline_style .= 'height: ' . esc_attr( $plumbing_handyman_background_height ) . 'px; ';
    $plumbing_handyman_inline_style .= 'background-size: cover; ';
    $plumbing_handyman_inline_style .= 'background-position: center center; ';

    // Add the unique class if the background image is set
    $plumbing_handyman_classes[] = 'has-background-image';
}

$plumbing_handyman_classes = implode( ' ', $plumbing_handyman_classes );
$plumbing_handyman_heading = get_theme_mod( 'plumbing_handyman_page_header_heading_tag', 'h1' );
$plumbing_handyman_heading = apply_filters( 'plumbing_handyman_page_header_heading', $plumbing_handyman_heading );

?>

<?php do_action( 'plumbing_handyman_before_page_header' ); ?>

<header class="<?php echo esc_attr( $plumbing_handyman_classes ); ?>" style="<?php echo esc_attr( $plumbing_handyman_inline_style ); ?> background-color: <?php echo esc_attr($plumbing_handyman_PAGE_TITLE_background_color); ?>;">

    <?php do_action( 'plumbing_handyman_before_page_header_inner' ); ?>

    <div class="asterthemes-wrapper page-header-inner">

        <?php if ( plumbing_handyman_has_page_header() ) : ?>

            <<?php echo esc_attr( $plumbing_handyman_heading ); ?> class="page-header-title">
                <?php echo wp_kses_post( plumbing_handyman_get_page_title() ); ?>
            </<?php echo esc_attr( $plumbing_handyman_heading ); ?>>

        <?php endif; ?>

        <?php if ( function_exists( 'plumbing_handyman_breadcrumb' ) ) : ?>
            <?php plumbing_handyman_breadcrumb(); ?>
        <?php endif; ?>

    </div><!-- .page-header-inner -->

    <?php do_action( 'plumbing_handyman_after_page_header_inner' ); ?>

</header><!-- .page-header -->

<?php do_action( 'plumbing_handyman_after_page_header' ); ?>