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
    $attachments_ids = $attachments_ids_csv ? str_getcsv($attachments_ids_csv) : array();
    return $attachments_ids;
}

// =============================================================================
// STORES
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
