<?php
/**
 * This file adds the archive header to the Summit themes.
 *
 * @package    SummitThemes
 * @author     Stefano Dotta
 * @since
 * @version    1.0.3
 */

/**
 * Changelog
 *
 * 2019-02-08 - 1.0.3
 * added condition "is_search()" to rewrite of "genesis_do_search_title"
 *
 * 2019-02-07 - 1.0.2
 * added rewrite of "genesis_do_search_title"
 *
 */

// Open markup for site banner after header.
add_action('genesis_after_header', 'dottaware_site_banner_markup_open', 5 );
function dottaware_site_banner_markup_open() {
    printf( '<div %s>', genesis_attr( 'site-banner' ) );
}

// Close markup for site banner.
add_action('genesis_after_header', 'dottaware_site_banner_markup_close', 15 );
function dottaware_site_banner_markup_close() {
    echo '</div>';
}

// add_filter( 'genesis_attr_site-banner', 'genesis_starter_page_header_attr' );
function genesis_starter_page_header_attr( $atts ) {

    // $atts['itemref'] = 'site-banner';
    $atts['role'] = 'banner';

    return $atts;

}


add_action( 'genesis_before', 'dottaware_archive_header_setup' );
/**
 * Set up the archive banner.
 *
 * Removes and repositions the title on all possible types of pages. Wrapped
 * up into one function so it can easily be unhooked from genesis_before.
 *
 */

function dottaware_archive_header_setup() {

    remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
    remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
    remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
    remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
    remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
    remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
    remove_action( 'genesis_before_loop', 'genesis_do_search_title' );

    // Reposition.
    add_action( 'genesis_after_header', 'genesis_do_posts_page_heading' );
    add_action( 'genesis_after_header', 'genesis_do_date_archive_title' );
    // add_action( 'genesis_after_header', 'genesis_do_blog_template_heading' );
    add_action( 'genesis_after_header', 'dottaware_do_taxonomy_title_description' );
    // add_action( 'genesis_after_header', 'genesis_do_taxonomy_title_description' );
    add_action( 'genesis_after_header', 'genesis_do_author_title_description' );
    add_action( 'genesis_after_header', 'genesis_do_cpt_archive_title_description' );
    add_action( 'genesis_after_header', 'dottaware_do_search_title' );

    // add_action( 'genesis_starter_page_header', 'genesis_do_posts_page_heading' );
    // add_action( 'genesis_starter_page_header', 'genesis_do_date_archive_title' );
    // add_action( 'genesis_starter_page_header', 'genesis_do_taxonomy_title_description' );
    // add_action( 'genesis_starter_page_header', 'dottaware_do_taxonomy_title_description' );
    // add_action( 'genesis_starter_page_header', 'genesis_do_author_title_description' );
    // add_action( 'genesis_starter_page_header', 'genesis_do_cpt_archive_title_description' );

    // Remove search results and shop page titles.
    // add_filter( 'genesis_search_title_output', '__return_false' );

}

// Remove genesis actions as we are adding ours.
remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5);
remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15);
remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_intro_text', 12);

// Open archive header div class.
add_action( 'genesis_archive_title_descriptions', 'dottaware_do_archive_headings_open', 5, 2 );
function dottaware_do_archive_headings_open( $heading = '', $intro_text = '' ) {

    if ( $heading || $intro_text ) {

        genesis_markup( array(
            'open'    => '<div %s><div class="wrap">',
            'context' => 'archive-header',
        ) );
    }

}

// close archive header div class.
add_action( 'genesis_archive_title_descriptions', 'dottaware_do_archive_headings_close', 15, 2 );
function dottaware_do_archive_headings_close( $heading = '', $intro_text = '' ) {

    if ( $heading || $intro_text ) {

        genesis_markup( array(
            'close'   => '</div></div>',
            'context' => 'archive-header',
        ) );

    }

}

// Get Genesis intro_text in a specific div class.
add_action( 'genesis_archive_title_descriptions', 'dottaware_do_archive_headings_intro_text', 12, 3 );
function dottaware_do_archive_headings_intro_text( $heading = '', $intro_text = '', $context = '' ) {

    if ( $context && $intro_text ) {
        printf( '<div %s>%s</div>', genesis_attr( 'archive-description' ), $intro_text );
    }

}

// Get link to external web site from term meta.
add_action( 'genesis_archive_title_descriptions', 'dottaware_do_archive_headings_term_link', 13 );
function dottaware_do_archive_headings_term_link() {

    global $wp_query;

    // this should only apply to category, tags or taxonomies archives.
    if ( ! is_category() && ! is_tag() && ! is_tax() ) {
        return;
    }

    // get term.
    $term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

    // no term, no glory...
    if ( ! $term || empty( $term ) ) {
        return;
    }

    if ( $term_website = get_term_meta( $term->term_id, 'term_website', true ) ) {
        $term_website = sprintf( '<a href="%s" target="_blank" itemprop="url">%s</a>', esc_url( $term_website ), 'Site web de référence');
        printf( '<div %s>%s</div>', genesis_attr( 'archive-link' ), $term_website );
    }

}

// Add custom heading and / or description to category / tag / taxonomy archive pages.
function dottaware_do_taxonomy_title_description() {

    global $wp_query;

    if ( ! is_category() && ! is_tag() && ! is_tax() ) {
        return;
    }

    $term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

    if ( ! $term || empty( $term )) {
        return;
    }

    $heading = get_term_meta( $term->term_id, 'headline', true );
    if ( empty( $heading ) && genesis_a11y( 'headings' ) ) {
        $heading = $term->name;
    }

    $heading = apply_filters( 'genesis_term_headline_output', $heading );

    $intro_text = get_term_meta( $term->term_id, 'intro_text', true );
    if ( empty( $intro_text ) ) {
        $intro_text = $term->description;
    }

    $intro_text = apply_filters( 'genesis_term_intro_text_output', $intro_text );

    // This action is documented in lib/structure/archive.php.
    do_action( 'genesis_archive_title_descriptions', $heading, $intro_text, 'taxonomy-archive-description' );

}

// Add custom heading to search result archive pages.
function dottaware_do_search_title() {

    // Bail out early if this is not a search.
    if ( ! is_search() ) {
        return;
    }

    $heading = sprintf( '<h1 class="archive-title">%s %s</h1>', apply_filters( 'genesis_search_title_text', __( 'Texte recherché : ', 'genesis' ) ), get_search_query() );

    $heading = apply_filters( 'genesis_search_title_output', $heading );

    // This action is documented in lib/structure/archive.php.
    do_action( 'genesis_archive_title_descriptions', $heading, '', 'search-archive-description' );

}
