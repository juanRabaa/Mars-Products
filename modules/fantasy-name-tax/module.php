<?php

function pedigree_register_fantasy_name_tax() {
    register_taxonomy(
        'pedigree-fantasy-name',
        'pedigree-local',
        array(
            'hierarchical'      => true,
            'label'             => __( 'Nombres de Fantasía' ),
            'rewrite'           => array( 'slug' => 'nombre-fantasia' ),
        )
    );
}
add_action( 'init', 'pedigree_register_fantasy_name_tax' );

add_action( 'current_screen', function(){
    require plugin_dir_path(__FILE__) . 'meta-extensions.php';
});
