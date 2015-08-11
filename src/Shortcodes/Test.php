<?php namespace RichJenks\Splitester\Shortcodes;

/**
 * Displays a variant for a test and tracks impression
 */
class Test {

	/**
	 * @var bool Set to true to prevent shortcode from executing
	 */
	private $error = false;

	/**
	 * @var int Post ID of test
	 */
	private $test_id;

	/**
	 * @var array Data for the current variant in 'name' and 'content'
	 */
	private $variant;

	/**
	 * Start the magic...
	 */
	public function __construct( $atts ) {

		// Get data for current test
		$test = get_post( $atts['id'] );

		// Check test is valid
		if ( empty( $test ) || $test->post_type !== 'splitester' || $test->post_status !== 'publish' ) {
			$this->error = true;
			return;
		}

		// Get test and a variant
		$this->test_id = $test->ID;
		$this->variant = $this->get_variant( $this->test_id );

		// Increment impression count for current variation
		$this->record_impression( $this->test_id, $this->variant );

		// Record the start of a journey
		$this->start_journey( $this->test_id, $this->variant );

	}

	/**
	 * Used by hook to ourput content
	 *
	 * @return string Shortcode output
	 */
	public function shortcode() { if ( !$this->error ) return do_shortcode( $this->variant['content'] ); }

	/**
	 * Gets data for a random variant of the current test
	 *
	 * @param  int   $test_id Post ID of the test
	 * @return array Variant name and content as keys 'name' and 'content'
	 */
	private function get_variant( $test_id ) {
		$variants = get_post_meta( $test_id, 'splitester_variants', true );
		$count    = count( $variants );
		$id       = mt_rand( 0, $count - 1 );
		$variant  = [
			'name'    => $variants[ $id ]['splitester_variant_name'],
			'content' => $variants[ $id ]['splitester_variant_content'],
		];
		return $variant;
	}

	/**
	 * Adds 1 to the number of impressions for the current variant
	 *
	 * @param int   $test_id Post ID of the test
	 * @param array $variant Variant name and content
	 */
	private function record_impression( $test_id, $variant ) {

		// Get results for current test
		$count = get_post_meta( $test_id, 'splitester_results', true );

		// Ensure count for current variant is intialised
		if ( empty( $count['impressions'][ $variant['name'] ] ) ) $count['impressions'][ $variant['name'] ] = 0;

		// Sort, increment and save impressions
		ksort( $count['impressions'] );
		$count['impressions'][ $variant['name'] ]++;
		update_post_meta( $this->test_id, 'splitester_results', $count );

		var_dump( $count );
		return $count;

	}

	/**
	 * Records a session variable marking an in-progress journey
	 *
	 * @param int   $test_id Post ID of the test
	 * @param array $variant Variant name and content
	 */
	private function start_journey( $test_id, $variant ) {
		unset( $_SESSION['splitester'][ $test_id ] );
		$_SESSION['splitester'][ $test_id ] = $variant['name'];
	}

}