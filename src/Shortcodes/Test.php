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
	 * @var int Data for the current variant in 'id' and 'content'
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
		// $this->record_impression();

	}

	/**
	 * Used by hook to ourput content
	 *
	 * @return string Shortcode output
	 */
	public function shortcode() { if ( !$this->error ) return $this->variant['content']; }

	/**
	 * Gets data for a random variant of the current test
	 *
	 * @return array Variant ID and content as keys 'key' and 'content'
	 */
	private function get_variant( $test_id ) {
		$variants = get_post_meta( $test_id, 'splitester_variants' )[0];
		var_dump($variants);
		$count    = count( $variants );
		$id       = mt_rand( 0, $count - 1 );
		$result   = [
			'id'      => $id,
			'content' => $variants[ $id ]['splitester_variant_content'],
		];
		return $result;
	}

	/**
	 * Adds 1 to the number of impressions for the current variant
	 */
	private function record_impression() {
		$impressions = get_post_meta( $this->test_id, $this->strings['variant'], true );
		if ( !is_numeric( $impressions ) ) $impressions = 0;
		$impressions++;
		update_post_meta( $this->test_id, $this->strings['variant'], $impressions );
	}

}