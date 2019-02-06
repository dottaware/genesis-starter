<?php

/**
 * Register theme support features for Summit Themes.
 *
 * @package		SummitThemes
 * @author		Stefano Dotta
 * @since
 * @version		1.0.1
 */


/* WordPress
----------------------------------------------------------------- */

// Add theme support for HTML5 markup structure.
add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );

// Add theme support for custom logo.
add_theme_support('custom-logo', array( 'width' => 50, 'height' => 50) );

// Add theme support for Featured Images.
// add_theme_support( 'post-thumbnails' );

// Add theme support for document Title tag.
// add_theme_support( 'title-tag' );

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

/* Remove theme support */

// Remove theme support for RSS feed.
remove_theme_support( 'automatic-feed-links' );

/* Genesis
----------------------------------------------------------------- */

// Add accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for additional color style options.
add_theme_support( 'genesis-style-selector', array(
	'summit-green'   => __( 'Summit Green', 'summit' ),
	'summit-orange'  => __( 'Summit Orange', 'summit' ),
	'summit-blue'    => __( 'Summit Blue', 'summit' ),
	'summit-yellow'  => __( 'Summit Yellow', 'summit' ),
) );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus' , array(
    'primary' => __( 'Header Menu', 'summit' ),
    'secondary' => __( 'Footer Menu', 'summit' ),
) );

// Add support for 3-column footer widget.
add_theme_support( 'genesis-footer-widgets', 3 );

/* Remove theme support */

// Remove theme support for Genesis SEO settings menu.
remove_theme_support( 'genesis-customizer-seo-settings' );

// Remove theme support for Genesis SEO settings in the Customizer.
remove_theme_support( 'genesis-customizer-seo-settings' );

// Remove theme support for Genesis layouts for posts and pages.
remove_theme_support( 'genesis-inpost-layouts' );
