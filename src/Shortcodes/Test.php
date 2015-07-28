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
	private $test;

	/**
	 * @var int Data for the current variant in 'key' and 'content'
	 */
	private $variant;

	/**
	 * @var string HTML content for shortcode to return
	 */
	private $content;

	/**
	 * @var array List of strings for sessions keys, etc.
	 */
	private $strings;

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
		$this->test    = $test->ID;
		$variant       = $this->get_variant();
		$this->variant = $variant['key'];
		$this->content = $variant['content'];

		// Construct strings
		$this->strings['test'] = 'splitester_impressions_' . $this->test;
		$this->strings['variant'] = $this->strings['test'] . '_' . $this->variant;

		// Increment impression count for current variation
		$this->record_impression();

	}

	/**
	 * Used by hook to ourput content
	 *
	 * @return string Shortcode output
	 */
	public function shortcode() { if ( !$this->error ) return $this->content; }

	/**
	 * Gets data for a random variant of the current test
	 *
	 * @return array Variant ID and content as keys 'key' and 'content'
	 */
	private function get_variant() {
		$variants = get_post_meta( $this->test, 'splitester_variants' )[0];
		$count = count( $variants );
		$random = mt_rand( 0, $count - 1 );
		$result = [
			'key' => $random,
			'content' => $variants[ $random ]['splitester_variant_content'],
		];
		return $result;
	}

	/**
	 * Adds 1 to the number of impressions for the current variant
	 */
	private function record_impression() {
		$impressions = get_post_meta( $this->test, $this->strings['variant'], true );
		if ( !is_numeric( $impressions ) ) $impressions = 0;
		$impressions++;
		update_post_meta( $this->test, $this->strings['variant'], $impressions );
	}

}