<?php

// =============================================================================
// PRODUCTS CATEGORIES FUNCTIONS
// =============================================================================
function pedigree_products_random_category_image($term_id, $size = 'full'){
    $attachments_ids = get_category_images_ids($term_id);
    $amount = count($attachments_ids);
    $result = "";

    if($attachments_ids){
        $random_key = array_rand($attachments_ids);
        $attachment_id = $attachments_ids[$random_key];

        $result = wp_get_attachment_image_src( $attachment_id, $size )[0];
    }

    return $result;
}

function pedigree_products_cat_has_image($term_id){
    $attachments_ids_csv = get_term_meta($term_id, '_pedigree_prod_cat_images', true);
    return $attachments_ids_csv != '';
}

function pedigree_products_cat_images($term_id){
    $attachments_ids_csv = get_term_meta($term_id, '_pedigree_prod_cat_images', true);
    $attachments_ids = array();
    if($attachments_ids_csv != ''){
        $first_char = substr($attachments_ids_csv, 0, 1);
        $isjson = $first_char == '{' || $first_char == '[';

        if($isjson)//Si es un json
            $attachments_ids = array_map(function( $att_data ){
                return $att_data['id'];
            }, json_decode($attachments_ids_csv, true));
        else //Si es un CSV
            $attachments_ids = str_getcsv($attachments_ids_csv);
    }
    return $attachments_ids;
}

function pedigree_products_cat_col_size($term_id){
    $cant_col = intval(get_term_meta($term_id, '_pd_prod_cat_columns', true));
    $col_size = 4;
    switch($cant_col){
        case 2: $col_size = 6; break;
        case 3: $col_size = 4; break;
        case 4: $col_size = 3; break;
    }
    return $col_size;
}

// =============================================================================
// STORES (e-shop)
// =============================================================================
function pedigree_get_stores_links( $orderby = 'title' ){
    $stores_query = new WP_Query(array(
        'posts_per_page'    => -1,
        'post_type'         => 'pedigree-store',
        'orderby'           =>  $orderby,
        'order'             => 'ASC',
    ));
    $stores = $stores_query->posts;
    $links = array();
    if( is_array( $stores ) ){
        foreach( $stores as $store ){
            $link = get_post_meta( $store->ID, 'pedigree_store_link', true );
            if( $link ){
                array_push( $links, array(
                    'id'    => $store->ID,
                    'link'  => get_post_meta( $store->ID, 'pedigree_store_link', true ),
                ));
            }
        }
    }
    return $links;
}

// =============================================================================
// LOCALES
// =============================================================================
function pedigree_get_nombre_fantasia( $orderby = 'name' ){
    $nombres_tax = get_terms(array(
        'taxonomy'          => 'pedigree-fantasy-name',
        'hide_empty'        => false,
        'orderby'           =>  $orderby,
        'order'             => 'ASC',
    ));
    return $nombres_tax;
}

function pd_sanitaze_csv_value( $value ){
	$value = $value != 'null' ? $value : null;
	return esc_attr($value);
}

function pd_get_clean_branch_row_data( $csv_row ){
	$data = str_getcsv($csv_row);
	$clean_array = array(
        'razon_social'	=>	pd_sanitaze_csv_value($data[0]),
		'sucursal'		=>	pd_sanitaze_csv_value($data[1]),
		'address'		=>	pd_sanitaze_csv_value($data[2]),
		'localidad'		=>	pd_sanitaze_csv_value($data[4]),
		'provincia'		=>	pd_sanitaze_csv_value($data[5]),
		'name'			=>	pd_sanitaze_csv_value($data[6]),//fantasy name
		'lat'			=>	floatval( pd_sanitaze_csv_value( str_replace(',', '.', $data[7]) ) ),
		'lng'			=>	floatval( pd_sanitaze_csv_value( str_replace(',', '.', $data[8]) ) ),
		'url'			=>	pd_sanitaze_csv_value($data[9]),
		'phone'			=>	pd_sanitaze_csv_value($data[10]),
		'timetable'		=>	pd_sanitaze_csv_value($data[11]),
		'email'			=>	pd_sanitaze_csv_value($data[12]),
	);

	return $clean_array;
}

function pd_insert_new_local($local_data, $fantasy_id, $status = 'publish'){
    if( is_array($local_data) && is_int($fantasy_id) ){
        return wp_insert_post(array(
            'post_title'    => $local_data['sucursal'],
            'post_type'     => 'pedigree-local',
            'post_status'   => $status,
            'tax_input'     => array( 'pedigree-fantasy-name' => $fantasy_id ),
            'meta_input'    => array(
                'pedigree_local_data'  => array(
                    'razon_social'  => $local_data['razon_social'],
                    'sucursal'      => $local_data['sucursal'],
                    'address'       => $local_data['address'],
                    'localidad'     => $local_data['localidad'],
                    'provincia'     => $local_data['provincia'],
                    'phone'         => $local_data['phone'],
                    'timetable'     => $local_data['timetable'],
                    'email'         => $local_data['email'],
                ),
                'pedigree_local_geolocation'  => array(
                    'lat'   => $local_data['lat'] ? $local_data['lat'] : '',
                    'long'  => $local_data['lng'] ? $local_data['lng'] : '',
                ),
                'pedigree_local_productos'  => array(
                    'eukanuba'  => $local_data['productos'] ? $local_data['productos']['eukanuba'] : '',
                    'iams'      => $local_data['productos'] ? $local_data['productos']['iams'] : '',
                    'pedigree'  => $local_data['productos'] ? $local_data['productos']['pedigree'] : '',
                    'whiskas'   => $local_data['productos'] ? $local_data['productos']['whiskas'] : '',
                ),
            ),
        ));
    }
    return null;
}

//Returns array('term_id'=>12,'term_taxonomy_id'=>34)
function pd_insert_new_fantasy($name, $args = array()){
    //SETTINGS
    $default = array(
        'url'   => '',
        'logo'  => '',
    );
    $settings = wp_parse_args( $args, $default);
    extract($settings);
    //INSERT TERM
    $fantasia_term = wp_insert_term( $name, 'pedigree-fantasy-name');
    //EXIT IF ERROR
    if( is_wp_error($fantasia_term) )
        return $fantasia_term;
    //META
    update_term_meta($fantasia_term['term_id'], '_pedigree_fantasy_name_logo', $logo);
    update_term_meta($fantasia_term['term_id'], '_pd_fantasy_name_web', $url);

    return $fantasia_term['term_id'];
}

function pd_create_locales_from_csv( $csv_path ){
    if( is_string($csv_path) && file_exists($csv_path)){
		$csv_file = file($csv_path);

		if( is_array($csv_file) ){
			//Remove the first line, that contains the columns titles
			array_shift($csv_file);

            foreach($csv_file as $csv_row){
                //csv row to array
                $local_data = pd_get_clean_branch_row_data($csv_row);
                $local_exists = get_page_by_title($local_data['sucursal'], OBJECT, 'pedigree-local') ? true : false;

                if( !$local_exists ){
                    //Term nombre de fantasia
                    $fantasia_term = get_term_by('name', $local_data['name'], 'pedigree-fantasy-name', ARRAY_A);
                    $term_id = -1;
                    $fantasia_exists = $fantasia_term ? true : false;

                    if( !$fantasia_exists ){
                        //new fantasia
                        $fantasia_term = pd_insert_new_fantasy($local_data['name'], array(
                            'logo'  => '',
                            'url'   => $local_data['url'],
                        ));
                    }
                    if( is_array( $fantasia_term ) && is_int($fantasia_term['term_id']) )
                        $term_id = $fantasia_term['term_id'];

                    //Si hay nombre de fantasia
                    if($term_id != -1){
                        //new post
                        pd_insert_new_local($local_data, $term_id);
                    }
                }
            }
		}
	}
}

function pd_delete_all_locales_data(){
	$locales_posts = get_posts(array(
		'numberposts'	=> -1,
		'post_type'		=> 'pedigree-local',
        'post_status'   => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
	));

	if(is_array($locales_posts)){
		foreach($locales_posts as $local_post){
			wp_delete_post( $local_post->ID, true );
		}
	}

	$fantasia_terms = get_terms( array(
	    'taxonomy' => 'pedigree-fantasy-name',
	    'hide_empty' => false,
	));

    if(is_array($fantasia_terms)){
        foreach($fantasia_terms as $fantasia_term){
            wp_delete_term( $fantasia_term->term_id, 'pedigree-fantasy-name' );
        }
    }
}
