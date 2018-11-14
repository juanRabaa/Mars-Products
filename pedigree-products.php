<?php
/**
 * Plugin Name: Pedigree products
 * Plugin URI:
 * Description:
 * Author: Genosha
 * Author URI:
 * Version: 1.0.0
 * License:
 * License URI:
 *
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('PEDIGREE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PEDIGREE_PLUGIN_URL', plugin_dir_url(__FILE__));

// =============================================================================
// PRODUCTS MANAGMENT
// =============================================================================

function pedigree_products_fontawesome_scripts() {
	wp_enqueue_style( "font-awesome-css", "https://use.fontawesome.com/releases/v5.1.0/css/all.css", array() );
}
add_action( 'admin_enqueue_scripts', 'pedigree_products_fontawesome_scripts' );

// require_once PEDIGREE_PLUGIN_PATH . 'inc/taxonomies/rb-tax-framework.php';
// //Metabox framework
// require PEDIGREE_PLUGIN_PATH . '/inc/RB_Metabox.php';

// ==========================================================================
// SCRIPTS
// ==========================================================================
function pedigree_products_admin_scripts() {
	wp_enqueue_style( 'pedigree_products_edition', PEDIGREE_PLUGIN_URL . '/css/src/admin.css' );
	wp_enqueue_script( "jquery-ui-sortable", PEDIGREE_PLUGIN_URL . "/js/libs/jquery-ui-1.12.1.custom/jquery-ui.min.js", true );
	wp_enqueue_script( "pedigree_products_admin", PEDIGREE_PLUGIN_URL . "/js/src/pedigree-products-admin.js", array("jquery-ui-sortable"), true );
}
add_action( 'admin_enqueue_scripts', 'pedigree_products_admin_scripts' );


require_once PEDIGREE_PLUGIN_PATH . 'inc/RB_Forms_Fields/RB_Form_Fields_Admin.php';

// =============================================================================
// MODULES
// =============================================================================
require_once PEDIGREE_PLUGIN_PATH . 'modules/product-category-tax/product-category.php';
require_once PEDIGREE_PLUGIN_PATH . 'modules/product-post-type/product-post.php';
require_once PEDIGREE_PLUGIN_PATH . 'modules/stores/stores-post.php';

// =============================================================================
// FUNCTIONS
// =============================================================================
require_once PEDIGREE_PLUGIN_PATH . 'pedigree-functions.php';

if(!function_exists('wp_get_attachment')){
	function wp_get_attachment( $attachment_id ) {
		$attachment = get_post( $attachment_id );
		return array(
			'id'	=> $attachment_id,
			'thumbnail' => wp_get_attachment_thumb_url( $attachment_id ),
			'title' => $attachment->post_title,
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'link' => get_permalink( $attachment->ID ),
			'url' => $attachment->guid,
			'type' => get_post_mime_type( $attachment_id ),
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'video_url'	=> get_post_meta( $attachment->ID, 'rb_media_video_url', true ),
		);
	}
}
