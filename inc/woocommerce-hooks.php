<?php
/**
 * WooCommerce hooks
 * @since Rent It 1.0
 */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// Remove default rating.
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

// Remove shop page title.
add_filter('woocommerce_show_page_title', 'rentit_hide_shop_title');
function rentit_hide_shop_title(){
  return false;
}

// Remove price
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);


// Remove result count.
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Remove ordering option.
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Product thumbnail in loop.
add_action('rentit_shop_loop_media', 'rentit_template_loop_product_thumbnail', 10);

// Product rating.
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 9 );

// Product price.
add_action('rentit_single_product_price', 'woocommerce_template_single_price', 5);

// Remove add to cart button
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

// Remove add to cart button on single product
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Add product meta in list item

// Remove sale label
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

// Place salce label
add_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10);

