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

add_action( 'genesis_loop', 'genesis_404' );
/**
 * This function outputs a 404 "Not Found" error message.
 *
 * @since 1.6
 */
function genesis_404() {

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
			'content' => apply_filters( 'genesis_404_entry_title', __( 'Not found, error 404', 'genesis' ) ),
			'context' => 'entry-title',
		)
	);

	echo '<div class="entry-content">';

	if ( genesis_html5() ) :
		/* translators: %s: URL for current website. */
		echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'genesis' ), trailingslashit( home_url() ) ) . '</p>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		get_search_form();

	else :
		?>

		<p><?php /* translators: %s: URL for current website. */ printf( wp_kses_post( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ) ), esc_url( trailingslashit( home_url() ) ) ); ?></p>

		<?php
	endif;

	if ( genesis_a11y( '404-page' ) ) {
		echo '<h2>' . esc_html__( 'Sitemap', 'genesis' ) . '</h2>';
		genesis_sitemap( 'h3' );
	} else {
		genesis_sitemap( 'h4' );
	}

	echo '</div>';

	genesis_markup(
		array(
			'close'   => '</article>',
			'context' => 'entry-404',
		)
	);

}

genesis();
