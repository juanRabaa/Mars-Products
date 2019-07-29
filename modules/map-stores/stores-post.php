<?php
// Creation of the products post type
function pedigree_register_local_post_type() {
	register_post_type( 'pedigree-local',
		array(
			'labels' 			=> array(
				'name' 				 => __( 'Locales' ),
				'singular_name' 	 => __( 'Local' ),
				'add_new'            => __( 'Agregar' ),
				'add_new_item'       => __( 'Agregar nuevo local' ),
				'edit_item'          => __( 'Editar local' ),
				'new_item'           => __( 'Nuevo local' ),
				'view_item'          => __( 'Ver' ),
				'search_items'       => __( 'Buscar local' ),
				'not_found'          => __( 'No se encontraron locales' ),
				'not_found_in_trash' => __( 'No se encontraron locales' ),
			),
			'public' 				=> true,
			'has_archive' 			=> false,
			'rewrite' 				=> array('slug' => 'local'),
			'menu_position'			=> 5,
			'menu_icon'				=> PEDIGREE_PLUGIN_URL . 'assets/img/stores-icon.png',
		'supports'				=> array('title', /*'editor', 'excerpt', 'thumbnail'*/),
			'taxonomies'          	=> array(),
			//'register_meta_box_cb' 	=> 'pedigree_products_add_metaboxes',
		)
	);
	//flush_rewrite_rules( );
}
add_action( 'init', 'pedigree_register_local_post_type' );

add_action( 'current_screen', function(){
    require plugin_dir_path(__FILE__) . 'meta-extensions.php';
});
