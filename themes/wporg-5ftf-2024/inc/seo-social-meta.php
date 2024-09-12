<?php
/**
 * Set up the SEO & social sharing meta tags.
 */

namespace WordPressdotorg\Theme\FiveForTheFuture_2024\SEO_Social_Meta;

use const WordPressDotOrg\FiveForTheFuture\Pledge\CPT_ID as PLEDGE_POST_TYPE;

add_filter( 'document_title_separator', __NAMESPACE__ . '\document_title_separator' );
add_action( 'jetpack_open_graph_tags', __NAMESPACE__ . '\add_social_meta_tags', 20 );

add_filter( 'jetpack_enable_open_graph', '__return_true', 100 ); // Enable Jetpack Open Graph tags.

/**
 * Set the separator for the document title.
 *
 * @return string Document title separator.
 */
function document_title_separator() {
	return ( is_feed() ) ? '&#8212;' : '&#124;';
}

/**
 * Add meta tags for richer social media integrations.
 */
function add_social_meta_tags( $tags ) {
	$default_image = 'https://wordpress.org/five-for-the-future/files/2024/09/five-future-opengraph.png';
	$site_title = function_exists( '\WordPressdotorg\site_brand' ) ? \WordPressdotorg\site_brand() : 'WordPress.org';
	$blog_title = __( 'Five for the Future', 'wporg-5ftf' );
	$description = __( 'Commit to the future of WordPress and the open web.', 'wporg-5ftf' );

	$tags['og:site_name']    = $site_title;
	$tags['og:title']        = $blog_title;
	$tags['og:description']  = $description;
	$tags['og:image']        = esc_url( $default_image );
	$tags['og:image:alt']    = $blog_title;
	$tags['og:locale']       = get_locale();
	$tags['twitter:card']    = 'summary_large_image';

	if ( is_front_page() ) {
		return $tags;
	}

	$sep = document_title_separator();

	if ( is_singular() ) {
		$post_title = get_the_title();

		if ( is_singular( PLEDGE_POST_TYPE ) ) {
			$post_excerpt = sprintf( __( 'Find out how %s is shaping the future of WordPress.', 'wporg-5ftf' ), $post_title );
		} else {
			$post_excerpt = wp_trim_words( get_the_excerpt(), 50 );
		}

		$tags['og:title']            = join( ' ', [ $post_title, $sep, $blog_title ] );
		$tags['twitter:text:title']  = join( ' ', [ $post_title, $sep, $blog_title ] );
		$tags['og:description']      = $post_excerpt;
		$tags['twitter:description'] = $post_excerpt;
		$tags['twitter:card']        = 'summary';

		$img_url = get_the_post_thumbnail_url();
		if ( $img_url ) {
			$tags['og:image']          = $img_url;
			$tags['og:image:alt']      = $post_title;
			$tags['twitter:image']     = $img_url;
			$tags['twitter:image:alt'] = $post_title;
		}
	} else if ( is_archive() ) {
		$tags['og:title']            = join( ' ', [ __( 'Pledges', 'wporg-5ftf' ), $sep, $blog_title ] );
		$tags['twitter:text:title']  = join( ' ', [ __( 'Pledges', 'wporg-5ftf' ), $sep, $blog_title ] );
	}

	return $tags;
}
