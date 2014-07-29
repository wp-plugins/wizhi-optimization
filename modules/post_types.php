<?php
/**
 * 快速添加文章和分类法
 *
 * @since mx 1.0
 */


function wizhi_create_types( $slug, $name, $support, $is_publish ) {

	//labels for custom post types
	$labels_type = array(
		'name'               => $name,
		'singular_name'      => $name,
		'add_new'            => '添加' . $name,
		'add_new_item'       => '添加新' . $name,
		'edit_item'          => '编辑' . $name,
		'new_item'           => '新' . $name,
		'all_items'          => '所有' . $name,
		'view_item'          => '查看' . $name,
		'search_items'       => '搜索' . $name,
		'not_found'          => '没有找到' . $name,
		'not_found_in_trash' => '没有在回收站中找到' . $name,
		'menu_name'          => $name,
	);

	//args for custom post types
	$args_type = array(
		'labels'             => $labels_type,
		'public'             => $is_publish,
		'publicly_queryable' => $is_publish,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $slug ),
		'capability_type'    => 'post',
		'has_archive'        => $is_publish,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => $support,
	);

	register_post_type( $slug, $args_type );
}


function wizhi_create_taxs( $tax_slug, $hook_type, $tax_name ) {
	//labels for custom taxomony
	$labels_tax = array(
		'name'              => $tax_name,
		'singular_name'     => $tax_name,
		'search_items'      => '搜索' . $tax_name,
		'all_items'         => '所有' . $tax_name,
		'parent_item'       => '父级' . $tax_name,
		'parent_item_colon' => '父级' . $tax_name,
		'edit_item'         => '编辑' . $tax_name,
		'update_item'       => '更新' . $tax_name,
		'add_new_item'      => '添加新' . $tax_name,
		'new_item_name'     => '新' . $tax_name . '名称',
		'menu_name'         => $tax_name,
	);

	//args for custom taxomony
	$args_tax = array(
		'hierarchical'      => true,
		'labels'            => $labels_tax,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => $tax_slug ),
	);

	register_taxonomy( $tax_slug, array( $hook_type ), $args_tax );
}

?>