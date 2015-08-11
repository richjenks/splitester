<?php namespace RichJenks\Splitester\Models;

class SplitTest {

	/**
	 * @var int Post ID of test
	 */
	private $test_id;

	/**
	 * @var array Data for the current variant in 'name' and 'content'
	 */
	private $variant;

	/**
	 * Determine whether a given Post ID is a Split Test
	 *
	 * @param  int  $id Post ID
	 * @return bool Whether post is split test
	 */
	public function is_test( $id ) {
		$test = get_post( $id );
		if ( !empty( $test ) && $test->post_type === 'splitester' && $test->post_status === 'publish' ) return true;
		return false;
	}

	public function get_variant() {
		echo 'lol';
	}

}