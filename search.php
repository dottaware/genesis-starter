<?php
/**
 * Summit Theme Search Page
 *
 * @author  Stefano Dotta
 * @license GPL-2.0+
 * @link    none
 */

// Force full width content layout.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');

// Remove the featured image before the post title (genesis default priority).
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// Add the featured image before the entry wrapper.
add_action( 'genesis_entry_header', 'summit_archive_entry_image', 1 );
function summit_archive_entry_image() {

    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
    	return;
	}

    $image_args = array(
        'size' => 'featured-large',
        'attr' => array(
            'class' => 'featured-image',
            'itemprop' => 'image',
            'aria-hidden' => 'true',
        ),
    );

    genesis_markup( array(
        'open'    => '<div %s>',
        'close'   => '</div>',
        'content' => genesis_get_image( $image_args ),
        'context' => 'entry-featured-image',
    ) );

}

// Remove the standard genesis action fired when there are no posts to show.
remove_action( 'genesis_loop_else', 'genesis_do_noposts' );

// Add our own action to be fired when there are no posts to show.
add_action( 'genesis_loop_else', 'dottaware_genesis_do_noposts' );


function dottaware_genesis_do_noposts() {

  	genesis_markup( array(
		'open'    => '<article class="entry">',
		'context' => 'entry-noposts',
	) );


  // echo '<div class="entry-wrapper">';


    genesis_markup( array(
        'open'    => '<div class="entry-wrapper"><div %s>',
        'close'   => '</div></div>',
        'content' => apply_filters( 'genesis_noposts_text', __( 'Sorry, no results matched your search, try again.', 'summit' ) ),
        'context' => 'entry-content',
    ) );


  // echo '</div>';

	genesis_markup( array(
		'close'   => '</article>',
		'context' => 'entry-noposts',
	) );

}


// Run the Genesis loop
genesis();
