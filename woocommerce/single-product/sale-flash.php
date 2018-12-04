<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$product = rentit_get_global_product();
$woocommerce_loop = rentit_get_global_woocommerce_loop();

?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo wp_kses_post(apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', "rentit" ) . '</span>', $post, $product )); ?>

<?php endif; ?>
