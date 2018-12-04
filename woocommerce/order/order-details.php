<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see        http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version  3.3.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $order = wc_get_order( $order_id ) ) {
	return;
}


$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
if ( $show_downloads ) {
	wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
}
?>
<h3 class="block-title alt"><i class="fa fa-angle-down"></i>
	<?php esc_html_e( 'Order Details', "rentit" ); ?></h3>

<table class="shop_table order_details">
	<thead>
	<tr>
		<th class="product-name"><?php esc_html_e( 'Product', "rentit" ); ?></th>
		<th class="product-total"><?php esc_html_e( 'Total', "rentit" ); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php

	foreach ( $order->get_items() as $item_id => $item ) {
		$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

		wc_get_template( 'order/order-details-item.php', array(
			'order'			     => $order,
			'item_id'		     => $item_id,
			'item'			     => $item,
			'show_purchase_note' => $show_purchase_note,
			'purchase_note'	     => $product ? $product->get_purchase_note() : '',
			'product'	         => $product,
		) );
	}
	?>
	<?php do_action( 'woocommerce_order_items_table', $order ); ?>
	</tbody>
	<tfoot>
	<?php
	foreach ( $order->get_order_item_totals() as $key => $total ) {
		?>
		<tr>
			<th scope="row"><?php echo esc_html( $total['label'] ); ?></th>
			<td><?php echo wp_kses_post( $total['value'] ); ?></td>
		</tr>
		<?php
	}
	?>
	</tfoot>
</table>
<?php if ( isset( $_GET['edit'] ) && $_GET['edit'] == 1 ): ?>

	<h3 class="block-title alt"><i class="fa fa-angle-down"></i>
		<?php esc_html_e( 'Edit order', 'rentit' ); ?></h3>

	<br><br>
	<div class="row">

		<div class="row row-inputs">
			<div class="container-fluid">
				<div class="col-sm-4">
					<div class="form-group has-icon has-label">
						<label for="formSearchUpDate3"><?php  esc_html_e('Picking Up Date','rentit'); ?> </label>
						<input name="dropin_date" type="text" class="form-control" id="formSearchUpDate3" placeholder="dd/mm/yyyy" value="08/16/2016 16:22">
						<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<div class="col-sm-4">

					<div class="form-group has-icon has-label">
						<label for="formSearchOffDate3"><?php  esc_html_e('Dropping Off Date','rentit'); ?></label>
						<input name="dropoff_date" type="text" class="form-control" id="formSearchOffDate3" placeholder="dd/mm/yyyy" value="08/18/2016 16:22">
						<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<div class="col-sm-4">

					<div class="form-group has-icon has-label">
						<label for="formSearchQuantity"><?php  esc_html_e('Quantity','rentit'); ?></label>
						<input name="quantity" type="number" class="form-control" id="formSearchQuantity" placeholder="dd/mm/yyyy" step="1" min="" value="1">

					</div>
				</div>


			</div>
		</div>





	</div>
	<div class="overflowed reservation-now">


		<button id="reservation_car_btn" type="submit"  class="btn btn-theme pull-right"><?php  esc_html_e('update','rentit'); ?> </button>

	</div>
	<br><br>
<?php endif; ?>
<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<?php wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) ); ?>
