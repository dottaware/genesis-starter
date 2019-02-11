<?php
/**
 * Summit Theme 404 page.
 *
 *
 *
 * @package  Summit Theme
 * @author   Stefano Dotta
 * @license  GPL-2.0+
 * @link     none
 */

// Remove default loop.
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Add our own loop.
add_action( 'genesis_loop', 'dottaware_404_loop' );
/**
 * This function outputs a 404 "Not Found" error message.
 */
function dottaware_404_loop() {

    genesis_markup(
        array(
            'open'    => '<article class="entry">',
            'context' => 'entry-404',
        )
    );

    genesis_markup(
        array(
            'open'    => '<h1 %s>',
            'close'   => '</h1>',
            'content' => apply_filters( 'genesis_404_entry_title', __( 'Not found, error 404', 'dottaware' ) ),
            'context' => 'entry-title',
        )
    );

    echo '<div class="entry-content">';

    /* translators: %s: URL for current website. */
    echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'dottaware' ), trailingslashit( home_url() ) ) . '</p>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    get_search_form();

    echo '</div>';

    genesis_markup(
        array(
            'close'   => '</article>',
            'context' => 'entry-404',
        )
    );

}

genesis();