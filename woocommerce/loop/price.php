<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$product = rentit_get_global_product();
?>

<div class="caption-row">

	<?php if ( $price_html = $product->get_price_html() ) : ?>
		<span class="price"><?php echo esc_html($price_html); ?></span>
	<?php endif; ?>

</div><!-- /.caption-row -->
