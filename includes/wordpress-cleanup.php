<?php
/**
 * WordPress Cleanup
 *
 * Purpose is to remove clutter from the head of the HTML page.
 * last update: 2019-01-28
 * - remove emojis
 *
 * @package		SummitThemes
 * @author		Stefano Dotta
 * @since
 * @version		1.0.1
**/

// remove really simple discovery link.
remove_action( 'wp_head', 'rsd_link' );

// remove WordPress Generator.
remove_action( 'wp_head', 'wp_generator' );

// Remove rss feed links.
remove_action( 'wp_head', 'feed_links', 2 );

// Removes all extra rss feed links.
remove_action( 'wp_head', 'feed_links_extra', 3 );

// remove wlwmanifest.xml for Windows Live Writer.
remove_action( 'wp_head', 'wlwmanifest_link' );

// remove the next and previous post links.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// remove the shortlink url from header.
remove_action( 'wp_head', 'shortlink_wp_head');
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Display the XHTML generator that is generated on the wp_head hook, WP version.
remove_action( 'wp_head', 'wp_generator' );

// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );

// Don't filter oEmbed results.
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

// Remove pingback url.
function dottaware_remove_x_pingback( $headers ) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter( 'wp_headers', 'dottaware_remove_x_pingback' );

// Remove pingbacks.
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'pre_update_option_enable_xmlrpc', '__return_false' );
add_filter( 'pre_option_enable_xmlrpc', '__return_zero' );
add_filter( 'pings_open', '__return_false', 10, 2 );


/**
 * Disable the emoji's
 *
 * @link https://kinsta.com/knowledgebase/disable-emojis-wordpress/
 */
function dottaware_disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'dottaware_disable_emojis' );
