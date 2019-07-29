<?php

new RB_Taxonomy_Form_Field("_pedigree_prod_cat_images", array(
    'title'                 => 'Imágenes',
    'description'           => '',
    'terms'                 => array('pedigree-product-category'),
    'add_form'              => true,
), array(
    'controls' => array(
        'images'	=> array(
            'type'			=> 'RB_Images_Gallery_Control',
        ),
    ),
));

new RB_Taxonomy_Form_Field("_pd_alt_color", array(
    'title'                 => 'Color alternativo',
    'description'           => '',
    'terms'                 => array('pedigree-product-category'),
    'add_form'              => true,
), array(
    'controls' => array(
        'altcolor'	=> array(
            'input_type'	=> 'checkbox',
            'label'         => 'Usar colores alternativos',
        ),
    ),
));

new RB_Taxonomy_Form_Field("_pd_prod_cat_columns", array(
    'title'                 => 'Columnas',
    'description'           => '',
    'terms'                 => array('pedigree-product-category'),
    'add_form'              => true,
), array(
    'controls' => array(
        'altcolor'	=> array(
            'input_type'	=> 'select',
            'label'         => 'Cantidad de columnas',
            'choices'		=> array(
                '2'	=> 2,
                '3'	=> 3,
                '4'	=> 4,
            ),
            'option_none'   => array('default', 'Default'),
        ),
    ),
));
