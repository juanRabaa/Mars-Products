<?php

$screen = get_current_screen();

//If editing a store
if( $screen->id == 'pedigree-local' ){
    // =============================================================================
    // METABOXES
    // =============================================================================
    new RB_Metabox('pedigree_local_data', array(
        'title'			=> __('Datos', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree-local',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
            'razon_social'      => array(
                'label'         => 'Razon Social',
    			'input_type'    => 'text',
            ),
            'address'       => array(
                'label'         => 'Dirección',
                'input_type'    => 'text',
            ),
            'localidad'       => array(
                'label'         => 'Localidad',
                'input_type'    => 'text',
            ),
            'provincia'       => array(
                'label'         => 'Provincia',
                'input_type'    => 'text',
            ),
            'phone'       => array(
                'label'         => 'Teléfono',
                'input_type'    => 'text',
            ),
            'timetable'       => array(
                'label'         => 'Horario de atención',
                'input_type'    => 'text',
            ),
            'email'     => array(
                'label'         => 'Email',
                'input_type'    => 'text',
            ),
        ),
    ));

    new RB_Metabox('pedigree_local_geolocation', array(
        'title'			=> __('Geolocalización', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree-local',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
    ), array(
        'controls'		=> array(
    		'lat'          => array(
                'label'         => 'Latitud',
    			'input_type'    => 'text',
            ),
            'long'          => array(
                'label'         => 'Longitud',
                'input_type'    => 'text',
            ),
        ),
    ));

    new RB_Metabox('pedigree_local_productos', array(
        'title'			=> __('Productos', 'pedigree-genosha'),
        'admin_page'	=> 'pedigree-local',
        'context'		=> 'normal',
        'priority'		=> 'high',
        'classes'		=> array('pedigree-metabox'),
        'description'   => 'Que productos vende',
    ), array(
        'controls'		=> array(
            'eukanuba'          => array(
                'label'         => 'Eukanuba',
                'input_type'    => 'checkbox',
            ),
            'iams'          => array(
                'label'         => 'IAMS',
                'input_type'    => 'checkbox',
            ),
            'pedigree'          => array(
                'label'         => 'Pedigree',
                'input_type'    => 'checkbox',
            ),
            'whiskas'          => array(
                'label'         => 'Whiskas',
                'input_type'    => 'checkbox',
            ),
        ),
    ));
}
