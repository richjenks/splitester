<?php namespace RichJenks\Splitester;

// Test shortcode
add_shortcode( 'split-test', function ( $atts ) {
	$test = new \RichJenks\Splitester\Shortcodes\Test( $atts );
	return $test->shortcode();
} );