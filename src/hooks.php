<?php namespace RichJenks\Splitester;

// Tests post type
add_action( 'init', function () {
	$test = new \RichJenks\Splitester\PostTypes\Tests;
} );

// Metaboxes
add_action( 'cmb2_init', function () {
	$variations = new \RichJenks\Splitester\Metaboxes\Variants;
	$results    = new \RichJenks\Splitester\Metaboxes\Results;
} );

// Test shortcode
add_shortcode( 'split-test', function ( $atts ) {
	$test = new \RichJenks\Splitester\Shortcodes\Test( $atts );
	return $test->shortcode();
} );