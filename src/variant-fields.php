<?php namespace RichJenks\Splitester;

add_action( 'cmb2_init', function () {

	$cmb = new_cmb2_box( array(
		'id'            => 'splitester_variants',
		'title'         => __( 'Variants', 'splitester' ),
		'object_types'  => array( 'splitester' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
	) );

	$group_field_id = $cmb->add_field( array(
		'id'          => 'splitester_variants',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'Variant {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'    => __( 'Add Variant', 'cmb' ),
			'remove_button' => __( 'Remove Variant', 'cmb' ),
		),
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => 'Variant Name',
		'id'   => 'splitester_variant_name',
		'type' => 'text',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => 'Content',
		'id'   => 'splitester_variant_content',
		'type' => 'textarea_small',
	) );

} );
