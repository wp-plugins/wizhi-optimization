<?php

//hide update notice for non-admin users
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) {
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_wizhiion_update_core', create_function( '$a', "return null;" ) );
}

//chang avatar server to duoshuo
function wizhi_get_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'wizhi_get_avatar', 10, 3 );


//reorder the tinymce buttons, add font size and font background button
function wizhi_mce_buttons_1( $buttons ) {
    $buttons = array(
    	'bold',
    	'italic',
    	'underline',
    	'strikethrough',
    	'bullist',
    	'numlist',
    	'blockquote',
    	'hr',
    	'alignleft',
    	'alignright',
    	'aligncenter',
    	'alignjustify',
    	'subscript',
    	'superscript',
    	'link',
    	'unlink',
    	'wp_more',
    	'wp_adv'
    );
    return $buttons;
}
add_filter( 'mce_buttons', 'wizhi_mce_buttons_1' );


function wizhi_mce_buttons_2( $buttons ) {
    $buttons = array(
    	'formatselect',
    	'fontsizeselect',
    	'forecolor',
		'backcolor',
    	'charmap',
    	'pastetext',
    	'removeformat',
    	'spellchecker',
    	'fullscreen',
    	'undo',
    	'redo',
		'indent',
    	'outdent',
		'cleanup',
		'charmap',
		'wp_help',
		'code',
		'sub',
		'sup',
		'anchor',
    );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'wizhi_mce_buttons_2' );


//set maximiun to 5 of post revision
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);


//set images default link to none
add_action( 'admin_init', 'wizhi_imagelink_setup', 10 );
function wizhi_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}


//Random String Generator
function wizhi_rand_str($length)
{
    $chars = array_merge(range('a','z'), range('0','9'));
    $length = intval($length) > 0 ? intval($length) : 8;
    $max = count($chars) - 1;
    $str = "";

    while($length--) {
        shuffle($chars);
        $rand = mt_rand(0, $max);
        $str .= $chars[$rand];
    }
    return $str;
}



//ganarate new file name
add_filter( 'sanitize_file_name', 'wizhi_upload_file', 5, 1 );
function wizhi_upload_file( $filename ) {
	$parts     = explode( '.', $filename );
	$filename  = array_shift( $parts );
	$extension = array_pop( $parts );
	foreach ( (array) $parts as $part ) {
		$filename .= '.' . $part;
	}

	if ( preg_match( '/[\x{4e00}-\x{9fa5}]+/u', $filename ) ) {
		$filename = date('md') . wizhi_rand_str(8);
	}
	$filename .= '.' . $extension;

	return $filename;
}


//automatic add post title 'Untitled' for empty title
add_filter( 'the_title', 'wizhi_no_title' );
function wizhi_no_title( $title ) {
	if ( $title == '' ) {
		return 'Untitled';
	} else {
		return $title;
	}
}


/**
 * automatic add a featured image
 *
 * @Author: Frank
 * @Link  : https://gist.github.com/2930032
 *
 * @uses  has_post_thumbnail
 * @uses  set_post_thumbnail
 *
 * @since mx 1.0
 */

add_action( 'save_post', 'wizhi_automatic_featured_image' );
function wizhi_automatic_featured_image( $post_id ) {

    if ( wp_is_post_revision( $post_id ) ) {
        return null;
    }

    if ( ! isset( $post_id ) ) {
        return null;
    }

    if ( has_post_thumbnail( $post_id ) ) {
        return null;
    }

    $args = array(
        'numberposts'    => 1,
        'order'          => 'DESC', // DESC for the last image
        'post_mime_type' => 'image',
        'post_parent'    => $post_id,
        'post_status'    => null,
        'post_type'      => 'attachment'
    );

    $attached_image = get_children( $args );
    if ( $attached_image ) {
        foreach ( $attached_image as $attachment_id => $attachment ) {
            set_post_thumbnail( $post_id, $attachment_id );
        }
    }

}


// change taxonomy checkbox list order
if ( ! class_exists( 'wizhi_cat_check_order' ) ){
    
    class wizhi_cat_check_order {   
        
        function wizhi_cat_check_order(){
    
            function changeTaxonomyCheckboxlistOrder( $args, $post_id)
            {
                if ( isset( $args['taxonomy']))
                    $args['checked_ontop'] = false;
                return $args;
            }
    
        add_filter('wp_terms_checklist_args','changeTaxonomyCheckboxlistOrder',10,2);
    }
    
}

$fttaxonomychangeorder = new wizhi_cat_check_order();

}


//Add current users browser information to body css class
function wizhi_browser_body_class( $classes ) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) {
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $browser = substr( "$browser", 25, 8);
        if ($browser == "MSIE 7.0"  ) {
            $classes[] = 'ie7';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 6.0" ) {
            $classes[] = 'ie6';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 8.0" ) {
            $classes[] = 'ie8';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 9.0" ) {
            $classes[] = 'ie9';
            $classes[] = 'ie';
        } else {
            $classes[] = 'ie';
        }
    }
    else $classes[] = 'unknown';

    if( $is_iphone ) $classes[] = 'iphone';

    return $classes;
}
add_filter( 'body_class', 'wizhi_browser_body_class' );

?>