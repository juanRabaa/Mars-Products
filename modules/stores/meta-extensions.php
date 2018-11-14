<?php

$screen = get_current_screen();

//If editing a store
if( $screen->id == 'pedigree-store' ){
    // =============================================================================
    // METABOXES
    // =============================================================================
    new RB_Metabox('pedigree_store_link', array(
        'title'			=> __('Link', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree-store',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
    		'ingredients'	=> array(
                'label'         => 'Link a la página de la tienda',
    			'input_type'    => 'text',
            ),
        ),
    ));
}
