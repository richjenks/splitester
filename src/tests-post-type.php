<?php namespace RichJenks\Splitester;

add_action( 'init', function () {

	$labels = array(
		'name'                => _x( 'Split Tests', 'Post Type General Name', 'splitester' ),
		'singular_name'       => _x( 'Split Test', 'Post Type Singular Name', 'splitester' ),
		'menu_name'           => __( 'Split Test', 'splitester' ),
		'name_admin_bar'      => __( 'Split Test', 'splitester' ),
		'parent_item_colon'   => __( 'Parent Test:', 'splitester' ),
		'all_items'           => __( 'All Tests', 'splitester' ),
		'add_new_item'        => __( 'Add New Test', 'splitester' ),
		'add_new'             => __( 'Add New', 'splitester' ),
		'new_item'            => __( 'New Test', 'splitester' ),
		'edit_item'           => __( 'Edit Test', 'splitester' ),
		'update_item'         => __( 'Update Test', 'splitester' ),
		'view_item'           => __( 'View Test', 'splitester' ),
		'search_items'        => __( 'Search Test', 'splitester' ),
		'not_found'           => __( 'Not found', 'splitester' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'splitester' ),
	);

	$args = array(
		'label'               => __( 'splitester', 'splitester' ),
		'description'         => __( 'Split Tests', 'splitester' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 50,
		'menu_icon'           => 'dashicons-star-half',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => false,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'page',
	);

	register_post_type( 'splitester', $args );

} );