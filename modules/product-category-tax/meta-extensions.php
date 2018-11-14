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
