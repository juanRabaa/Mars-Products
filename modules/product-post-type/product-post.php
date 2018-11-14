<?php

// Creation of the products post type
function pedigree_register_products_post_type() {
	register_post_type( 'pedigree_product',
		array(
			'labels' 			=> array(
				'name' 				 => __( 'Productos' ),
				'singular_name' 	 => __( 'Producto' ),
				'add_new'            => __( 'Agregar' ),
				'add_new_item'       => __( 'Agregar nuevo producto' ),
				'edit_item'          => __( 'Editar producto' ),
				'new_item'           => __( 'Nuevo producto' ),
				'view_item'          => __( 'Ver' ),
				'search_items'       => __( 'Buscar producto' ),
				'not_found'          => __( 'No se encontraron productos' ),
				'not_found_in_trash' => __( 'No se encontraron productos' ),
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'rewrite' 				=> array('slug' => 'productos'),
			'menu_position'			=> 5,
			'menu_icon'				=> PEDIGREE_PLUGIN_URL . 'assets/img/menu-icon.png',
			'supports'				=> array('title', 'editor', 'excerpt', 'thumbnail'),
			'taxonomies'          	=> array( 'pedigree-product-category' ),
			//'register_meta_box_cb' 	=> 'pedigree_products_add_metaboxes',
		)
	);
	//flush_rewrite_rules( );

}
add_action( 'init', 'pedigree_register_products_post_type' );

add_action( 'current_screen', function(){
	require_once PEDIGREE_PLUGIN_PATH . '/inc/controls/pedigree-stores/pedigree-stores-control.php';
    require plugin_dir_path(__FILE__) . 'meta-extensions.php';
});
