<?php

function pedigree_stores_control_scripts() {
	wp_enqueue_style( 'pedigree_stores_control_style', PEDIGREE_PLUGIN_URL . '/inc/controls/pedigree-stores/style.css' );
    wp_enqueue_script( 'pedigree_stores_script', PEDIGREE_PLUGIN_URL . '/inc/controls/pedigree-stores/value-manager.js', array("jquery"), true );
}
add_action( 'admin_enqueue_scripts', 'pedigree_stores_control_scripts' );

class Pedigree_Stores_Control extends RB_Metabox_Control{

    public function print_stores_data(){
        $stores_query = new WP_Query(array(
            'posts_per_page'    	=> -1,
            'post_type'         	=> 'pedigree-store',
            'orderby'           	=> 'post_title',
			'order'					=> 'ASC',
        ));
        if ( $stores_query->have_posts() ):
            $value = is_string($this->value) ? json_decode( $this->value, true ) : null;
            ?>
            <div class="table-header">
                <span>Tienda</span>
                <span>Link</span>
            </div>
            <ul class="stores-list">
            <?php
        	while ( $stores_query->have_posts() ) {
        		$stores_query->the_post();
                $store = $stores_query->post;
                $thumbnail = get_the_post_thumbnail_url( $store->ID, 'full' );
				$savedItemIndex = is_array($value) ? array_search($store->ID, array_column($value, 'id')) : null;
				$savedItem = $savedItemIndex !== False ? $value[$savedItemIndex] : null;
                $link = is_array($savedItem) ? $savedItem['link'] : '';
                ?>
                <li class="store-item" data-id="<?php echo esc_attr($store->ID); ?>">
                    <div class="store-info">
                        <img src="<?php echo $thumbnail; ?>">
                    </div>
                    <div class="store-link-input">
                        <input type="text" placeholder="Link/URL" value="<?php echo esc_attr($link); ?>">
                    </div>
                </li>
                <?php
        	}
        	/* Restore original Post Data */
        	wp_reset_postdata();
            ?></ul><?php
        else :
            ?>
                <h3>No existen tiendas</h3>
            <?php
        endif;
    }

    public function render_content(){
        $this->print_control_header();
        ?>
        <div class="pedigree-stores-data">
            <?php $this->print_stores_data(); ?>
            <input rb-control-value class="rb-tax-value rb-sub-input"  name="<?php echo $this->id; ?>" type="hidden" value="<?php echo esc_attr($this->value); ?>"></input>
        </div>
        <?php
    }
}
