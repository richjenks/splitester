<?php namespace RichJenks\Splitester\Metaboxes;

/**
 * Displays custom fields for test results
 */
class Results {

	public function __construct() {

		$cmb = new_cmb2_box( array(
			'id'            => 'splitester_results_box',
			'title'         => __( 'Results', 'splitester' ),
			'object_types'  => array( 'splitester' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
		) );
		$cmb->add_field( array(
			'type' => 'title',
			'id'   => 'splitester_results',
			'after' => $this->splitester_results(),
		) );

	}

	private function splitester_results() {

		$results = $count = get_post_meta( $_GET['post'], 'splitester_results', true );
		return 'lol';
		// return file_get_contents(__DIR__ . '/../Views/Results.php');

	}
}