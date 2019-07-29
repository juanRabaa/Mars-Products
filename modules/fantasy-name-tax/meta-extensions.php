<?php

new RB_Taxonomy_Form_Field("_pedigree_fantasy_name_logo", array(
    'title'                 => 'Logo',
    'description'           => '',
    'terms'                 => array('pedigree-fantasy-name'),
    'add_form'              => true,
), array(
    'controls' => array(
        'images'	=> array(
            'type'			=> 'RB_Media_Control',
        ),
    ),
));

new RB_Taxonomy_Form_Field("_pd_fantasy_name_web", array(
    'title'                 => 'Página web',
    'description'           => '',
    'terms'                 => array('pedigree-fantasy-name'),
    'add_form'              => true,
), array(
    'controls' => array(
        'altcolor'	=> array(
            'input_type'    => 'text',
        ),
    ),
));
