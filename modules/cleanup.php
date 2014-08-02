<?php

//remove useless dashboard widget
add_action( 'wp_before_admin_bar_render', 'wizhi_remove_dashboard_widgets' );
function wizhi_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_duoshuo'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
}


//clean up <head> content
add_action( 'init', 'wizhi_head_cleanup', 10 );
function wizhi_head_cleanup() {
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}


//remove useless topbar menu
add_action( 'wp_before_admin_bar_render', 'wizhi_remove_admin_bar' );
function wizhi_remove_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'about' );
	$wp_admin_bar->remove_menu( 'wporg' );
	$wp_admin_bar->remove_menu( 'documentation' );
	$wp_admin_bar->remove_menu( 'support-forums' );
	$wp_admin_bar->remove_menu( 'feedback' );
	$wp_admin_bar->remove_menu( 'view-site' );
}


//remove dashboard google font
add_action( 'init', 'wizhi_remove_open_sans_from_wp_core' );
function wizhi_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style( 'open-sans', '' );
}



//clean up menu classes
add_filter( 'nav_menu_css_class', 'wizhi_css_attributes_filter', 100, 1 );
function wizhi_css_attributes_filter( $var ) {
	return is_array( $var ) ? array_intersect( $var, array( 'current-menu-item', 'menu-item', 'menu-item-has-children' ) ) : '';
}


//for safe reason, remove the frontend wp generator version
add_filter( 'the_generator', 'wizhi_remove_version' );
function wizhi_remove_version() {
	return '';
}

//remove the blank arround wp_title output
function wizhi_remove_wp_title_blank($title) {
	return trim($title);
}

add_filter('wp_title', 'wizhi_remove_wp_title_blank');

?>