<?php

$screen = get_current_screen();

//If editing a product
if( $screen->id == 'pedigree_product' ){
    // =============================================================================
    // METABOXES
    // =============================================================================
    new RB_Metabox('pedigree_product_ingredients', array(
        'title'			=> __('Ingredientes', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree_product',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
    		'ingredients'	=> array(
    			'type'			=> 'RB_tinymce_control',
            ),
        ),
    ));

    new RB_Metabox('pedigree_product_guide', array(
        'title'			=> __('Guía de alimentación (Cachorro)', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree_product',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
    		'guide'	=> array(
    			'type'			=> 'RB_tinymce_control',
            ),
        ),
    ));

    new RB_Metabox('pedigree_product_guide_adult', array(
        'title'			=> __('Guía de alimentación (Adulto)', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree_product',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
    		'guide'	=> array(
    			'type'			=> 'RB_tinymce_control',
            ),
        ),
    ));

    new RB_Metabox('pedigree_product_guide_senior', array(
        'title'			=> __('Guía de alimentación (Adulto +7)', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree_product',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
    		'guide'	=> array(
    			'type'			=> 'RB_tinymce_control',
            ),
        ),
    ));

    new RB_Metabox('pedigree_product_characteristics', array(
        'title'			=> __('Características', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree_product',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
    		'list'	=> array(
    			'type'			=> 'RB_doublelist_control',
            ),
        ),
    ));

    // new RB_Metabox('pedigree_product_stores', array(
    //     'title'			=> __('Tiendas', 'pedigree-genosha'),
    //     'admin_page'	=> 'pedigree_product',
    //     'context'		=> 'normal',
    //     'priority'		=> 'high',
    //     'classes'		=> array('pedigree-metabox'),
    // ), array(
    //     'controls'		=> array(
    //         'post'	=> array(
    //             'label'			=> 'Post',
    //             'type'			=> 'RB_Posts_Dropdown',
    //             'args'          => array(
    //                 'post_type'     => 'pedigree-store',
    //                 'option_none'   => 'Ninguna',
    //             ),
    //         ),
    //         'url'	=> array(
    //             'label'			=> 'URL',
    //             'input_type'	=> 'text',
    //         ),
    //     ),
    //     'repeater'      => true,
    //     'item_title'    => 'Tienda ($n)',
    //     //'title_link'    => 'post',
    //     'accordion'     => true,
    //     'empty_message' => 'No se han seleccionado tiendas',
    // ));

    new RB_Metabox('pedigree_product_stores', array(
        'title'			=> __('Tiendas', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree_product',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
            'post'	=> array(
                'type'			=> 'Pedigree_Stores_Control',
            ),
        ),
    ));


    // new RB_Metabox('pedigree-product-images', 'pedigree_product_images', array(
    // 	'title'			=> __('Imagenes', 'pedigree-genosha'),
    // 	'admin_page'	=> 'pedigree_product',
    // 	'context'		=> 'normal',
    // 	'priority'		=> 'high',
    // 	//'label'			=> 'Características del producto',
    // 	'classes'		=> array('pedigree-metabox'),
    // 	'type'			=> 'RB_Gallery_Control',
    // ));
}
