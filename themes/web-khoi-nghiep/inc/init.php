<?php

// register taxonomy
add_action( 'init', 'build_pc_register_taxonomy' );
function build_pc_register_taxonomy() {
	$args = [
		'label'  => esc_html__( 'Build PC', 'mscshop.test' ),
		'labels' => [
			'menu_name'                  => esc_html__( 'Build PC', 'mscshop.test' ),
			'all_items'                  => esc_html__( 'All Build PC', 'mscshop.test' ),
			'edit_item'                  => esc_html__( 'Edit build-pc', 'mscshop.test' ),
			'view_item'                  => esc_html__( 'View build-pc', 'mscshop.test' ),
			'update_item'                => esc_html__( 'Update build-pc', 'mscshop.test' ),
			'add_new_item'               => esc_html__( 'Add new build-pc', 'mscshop.test' ),
			'new_item'                   => esc_html__( 'New build-pc', 'mscshop.test' ),
			'parent_item'                => esc_html__( 'Parent build-pc', 'mscshop.test' ),
			'parent_item_colon'          => esc_html__( 'Parent build-pc', 'mscshop.test' ),
			'search_items'               => esc_html__( 'Search Build PC', 'mscshop.test' ),
			'popular_items'              => esc_html__( 'Popular Build PC', 'mscshop.test' ),
			'separate_items_with_commas' => esc_html__( 'Separate Build PC with commas', 'mscshop.test' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Build PC', 'mscshop.test' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used Build PC', 'mscshop.test' ),
			'not_found'                  => esc_html__( 'No Build PC found', 'mscshop.test' ),
			'name'                       => esc_html__( 'Build PC', 'mscshop.test' ),
			'singular_name'              => esc_html__( 'build-pc', 'mscshop.test' ),
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => true,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => true,
		'rewrite_no_front'     => true,
		'rewrite_hierarchical' => true,
		'rewrite' => true
	];
	register_taxonomy( 'build-pc', [ 'product' ], $args );
}
