<?php namespace RichJenks\Splitester;

// Tests post type
add_action( 'init', function () {
	new \RichJenks\Splitester\PostTypes\Tests;
} );

// Metaboxes
add_action( 'cmb2_init', function () {
	new \RichJenks\Splitester\Metaboxes\Variants;
	new \RichJenks\Splitester\Metaboxes\Results;
} );

// Test shortcode
add_shortcode( 'split-test', function ( $atts ) {
	$test = new \RichJenks\Splitester\Shortcodes\Test( $atts );
	return $test->shortcode();
} );

// Conversion shortcode
add_shortcode( 'split-convert', function ( $atts ) {
	new \RichJenks\Splitester\Shortcodes\Conversion( $atts );
} );
