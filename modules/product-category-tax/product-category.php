<?php

function pedigree_register_products_category_tax() {
    register_taxonomy(
        'pedigree-product-category',
        'pedigree_product',
        array(
            'hierarchical'      => true,
            'label'             => __( 'Categorías' ),
            'rewrite'           => array( 'slug' => 'product-category' ),
        )
    );
}
add_action( 'init', 'pedigree_register_products_category_tax' );

add_action( 'current_screen', function(){
    require plugin_dir_path(__FILE__) . 'meta-extensions.php';
});
