<?php namespace RichJenks\Splitester\Shortcodes;

/**
 * Handles goal pages
 */
class Conversion {

	/**
	 * @var int Post ID of test
	 */
	private $test_id;

	/**
	 * @var string Name of the variant for current journey
	 */
	private $variant;

	/**
	 * Start the magic...
	 */
	public function __construct( $atts ) {

		// Get data for current test
		$test = get_post( $atts['id'] );

		// Check test is valid and journey has started
		if (
			empty( $_SESSION['splitester'][ $atts['id'] ] )
			|| empty( $test )
			|| $test->post_type !== 'splitester'
			|| $test->post_status !== 'publish'
		) {
			return;
		} else {
			$this->variant = $_SESSION['splitester'][ $atts['id'] ];
		}

		// Test test ID
		$this->test_id = $test->ID;

		// Increment conversion count for current variation
		$this->record_conversion( $this->test_id, $this->variant );

		// End the journey
		unset( $_SESSION['splitester'][ $this->test_id ] );

	}

	/**
	 * Adds 1 to the number of conversions for the current variant
	 *
	 * @param int   $test_id Post ID of the test
	 * @param array $variant Variant name and content
	 */
	private function record_conversion( $test_id, $variant ) {

		// Get results for current test
		$count = get_post_meta( $test_id, 'splitester_results', true );

		// Ensure count for current variant is intialised and is int
		if ( empty( $count['conversions'][ $variant ] ) ) $count['conversions'][ $variant ] = 0;

		// Sort, increment and save impressions
		ksort( $count['conversions'] );
		$count['conversions'][ $variant ]++;
		update_post_meta( $this->test_id, 'splitester_results', $count );

		return $count;
	}

}