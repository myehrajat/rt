<?php

/**
 * Booking system init.
 * @package Rent It
 * @since Rent It 1.0
 */

require_once get_template_directory() . '/inc/rentit-booking/class-rentit-booking-admin.php';
require_once get_template_directory() . '/inc/rentit-booking/includes/template-functions.php';

// Display Fields
add_action( 'woocommerce_product_options_inventory_product_data', 'rentit_add_custom_general_fields' );

function rentit_add_custom_general_fields(){
    woocommerce_wp_text_input(
        array(
            'id' => '_rentit_min_quantity',
            'label' => esc_html__('Min Stock quantity', "rentit") ,           
            'type'              => 'number',
            'desc_tip' => 'true',      
            'description' => esc_html__('Min Stock quantity product', 'rentit')
        )
    );


}





