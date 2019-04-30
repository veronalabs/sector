<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sector
 */

namespace Sector\Template;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', __NAMESPACE__ . '\pingback_header' );



// ACF Blocks
function register_blocks() {

	// register a testimonial block.
	acf_register_block(array(
		'name'              => 'testimonial',
		'title'             => __('Testimonial'),
		'description'       => __('A custom testimonial block.'),
		'render_template'   => 'template-parts/components/c-testimonial.php',
		'category'          => 'formatting',
		'icon'              => 'admin-comments',
		'keywords'          => array( 'testimonial', 'quote' ),
	));
}
// Warning: call_user_func_array() expects parameter 1 to be a valid callback, function 'register_acf_blocks' not found or invalid function name in C:\xampp\htdocs\develop\wp-includes\class-wp-hook.php on line 286
// Check if function exists and hook into setup.
if( function_exists('acf_register_block') ) {
	add_action('acf/init', __NAMESPACE__ . '\register_blocks');
}