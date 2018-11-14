<?php

// Creation of the products post type
function pedigree_register_stores_post_type() {
	register_post_type( 'pedigree-store',
		array(
			'labels' 			=> array(
				'name' 				 => __( 'Tiendas' ),
				'singular_name' 	 => __( 'Tienda' ),
				'add_new'            => __( 'Agregar' ),
				'add_new_item'       => __( 'Agregar nueva tienda' ),
				'edit_item'          => __( 'Editar tienda' ),
				'new_item'           => __( 'Nueva tienda' ),
				'view_item'          => __( 'Ver' ),
				'search_items'       => __( 'Buscar tienda' ),
				'not_found'          => __( 'No se encontraron tiendas' ),
				'not_found_in_trash' => __( 'No se encontraron tiendas' ),
			),
			'public' 				=> true,
			'has_archive' 			=> false,
			'rewrite' 				=> array('slug' => 'tiendas'),
			'menu_position'			=> 5,
			'menu_icon'				=> PEDIGREE_PLUGIN_URL . 'assets/img/stores-icon.png',
			'supports'				=> array('title', 'editor', 'excerpt', 'thumbnail'),
			'taxonomies'          	=> array(),
			//'register_meta_box_cb' 	=> 'pedigree_products_add_metaboxes',
		)
	);
	//flush_rewrite_rules( );
}
add_action( 'init', 'pedigree_register_stores_post_type' );

add_action( 'current_screen', function(){
    require plugin_dir_path(__FILE__) . 'meta-extensions.php';
});
