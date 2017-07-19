<?php

// Enqueue Scripts and Styles.
// add_action( 'wp_enqueue_scripts', 'sk_load_scripts_styles' );
function sk_load_scripts_styles() {
	wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/style-front.css' );
}

add_filter( 'genesis_attr_site-inner', 'be_site_inner_attr' );
/**
 * Add the attributes from 'entry', since this replaces the main entry.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/full-width-landing-pages-in-genesis/
 *
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function be_site_inner_attr( $attributes ) {
	// Add a class of 'full' for styling this .site-inner differently.
	$attributes['class'] .= ' full';

	// Add an id of 'genesis-content' for accessible skip links.
	$attributes['id'] = 'genesis-content';

	// Add the attributes from .entry, since this replaces the main entry.
	$attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

	return $attributes;
}

// Display header.
get_header();

// Display front-page-1 widget area.
genesis_widget_area( 'front-page-1', array(
	'before' => '<div class="front-page-1 widget-area"><div class="wrap">',
	'after'  => '</div></div>',
) );
// Display front-page-2 widget area.
genesis_widget_area( 'front-page-2', array(
	'before' => '<div class="front-page-2 widget-area"><div class="wrap">',
	'after'  => '</div></div>',
) );
// Display front-page-3 widget area.
genesis_widget_area( 'front-page-3', array(
	'before' => '<div class="front-page-3 widget-area"><div class="wrap">',
	'after'  => '</div></div>',
) );
// Display front-page-4 widget area.
genesis_widget_area( 'front-page-4', array(
	'before' => '<div class="front-page-4 widget-area"><div class="wrap">',
	'after'  => '</div></div>',
) );
// Display front-page-5 widget area.
genesis_widget_area( 'front-page-5', array(
	'before' => '<div class="front-page-5 widget-area"><div class="wrap">',
	'after'  => '</div></div>',
) );
// Display front-page-6 widget area.
genesis_widget_area( 'front-page-6', array(
	'before' => '<div class="front-page-6 widget-area"><div class="wrap">',
	'after'  => '</div></div>',
) );
// Display Footer.
get_footer();