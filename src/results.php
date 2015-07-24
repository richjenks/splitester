<?php namespace RichJenks\Splitester;

add_action( 'cmb2_init', function () {

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
		'after' => __NAMESPACE__ . '\splitester_results',
	) );

} );

function splitester_results() { ?>

<table>
	<tr>
		<th></th>
		<th>Convertions</th>
		<th>Convertions</th>
		<th>Abandonment</th>
	</tr>
	<tr>
		<th scope="row">Variant 1</th>
		<td>100</td>
		<td>100</td>
	</tr>
	<tr>
		<th scope="row">Variant 2</th>
		<td>100</td>
		<td>100</td>
	</tr>
</table>

<?php }