<?php
/**
 * Ajax like post
 *
 * */


function rentit_set_order_status() {


	$order             = get_post( (int) $_POST['order_id'] );
	$billing_last_name = get_post_meta( (int) $_POST['order_id'], '_billing_last_name', 1 );

	if ( $order->post_type == 'shop_order' && $billing_last_name == urldecode( $_POST['last_name'] ) ) {
		wp_transition_post_status( 'wc-cancel-request', get_post_status( (int) $_POST['order_id'] ),
			$order );


		$my_post = array(
			'ID'          => (int) $_POST['order_id'],
			'post_status' => 'wc-cancel-request'
		);

// Update the post into the database
		$post = wp_update_post( $my_post );
		if ( ! is_wp_error( $post ) ) {
			wp_die( 1 );
		} else {
			echo $post->get_error_message();
		}

	} else {
		echo esc_html__( 'something wrong try again', 'rentit' );
	}
	wp_die();
	exit;
}

add_action( 'wp_ajax_rentit_set_order_status', 'rentit_set_order_status' );
add_action( 'wp_ajax_nopriv_rentit_set_order_status', 'rentit_set_order_status' );


function rentit_set_order_time_date() {

	if ( ! function_exists( 'wc_update_order_item_meta' ) ) {
		wp_die( 0 );
	}


	$order = wc_get_order( (int) $_POST['order_id'] );

	$line_items = $order->get_items( apply_filters( 'woocommerce_admin_order_item_types', 'line_item' ) );


	//update dates and time
	foreach ( $line_items as $item_id => $item2 ) {
		if ( isset( $_POST['dropoff']{2} ) ) {
			wc_update_order_item_meta( $item_id, 'Dropping Off Location', sanitize_text_field( $_POST['dropoff'] ) );

		}
		if ( isset( $_POST['dropin']{2} ) ) {
			wc_update_order_item_meta( $item_id, 'Picking Up Location', sanitize_text_field( $_POST['dropin'] ) );

		}

		if ( isset( $_POST['start_date']{2} ) ) {
			wc_update_order_item_meta( $item_id, 'Picking Up Date', sanitize_text_field( $_POST['start_date'] ) );
		}
		if ( isset( $_POST['end_date']{2} ) ) {
			wc_update_order_item_meta( $item_id, 'Dropping Off Date', sanitize_text_field( $_POST['end_date'] ) );
		}

		if ( isset( $_POST['start_date']{2} ) && isset( $_POST['end_date']{2} ) ) {
			$dropoff_int = strtotime( $_POST['end_date'] );
			$dropin_int  = strtotime( $_POST['start_date'] );
			//dates

			$days = rentit_DateDiff( 'd', $dropin_int, $dropoff_int );
			wc_update_order_item_meta( $item_id, 'Day(s)', sanitize_text_field( $days ) );
		}


		//	wc_update_order_item_meta( $item_id, 'Day(s)', '90' );
	}
	esc_html_e( 'time and the data is successfully updated', 'renit' );
	wp_die();
	exit();
}

add_action( 'wp_ajax_rentit_set_order_time_date', 'rentit_set_order_time_date' );
add_action( 'wp_ajax_nopriv_rentit_set_order_time_date', 'rentit_set_order_time_date' );


// update extrax

function rentit_set_order_extras() {
	if ( ! function_exists( 'wc_update_order_item_meta' ) ) {
		wp_die( 0 );
	}


	$order      = wc_get_order( (int) $_POST['order_id'] );
	$line_items = $order->get_items( apply_filters( 'woocommerce_admin_order_item_types', 'line_item' ) );


	//var_dump( $line_items );
	$array      = array();
	$price      = 0;
	$product_id = (int) $_POST['product_id'];

	if ( isset( $_POST['checkbox_extras'] ) ) {

		$arr_resources = ( get_post_meta( $product_id, '_rental_resources', true ) );

		//Climb services
		$arr_extras = array();
		foreach ( $arr_resources as $item ) {

			$val     = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . $item["duration_type"];
			$checked = false;
			if ( $item["cost"] == '0' || empty( $item["cost"] ) ) {
				$val = esc_html__( 'Free', 'rentit' );

			}
			if ( $item["duration_type"] == 'total' ) {
				$val = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . esc_html__( 'Total', 'rentit' );

			}
			if ( $item["duration_type"] == 'Included' ) {
				$val = esc_html__( 'Included', 'rentit' );

			}


			$arr_extras[] = array(
				'value'         => $val,
				'name'          => esc_html( $item["item_name"] ),
				'price'         => esc_attr( $item["cost"] ),
				"duration_type" => esc_attr( $item["duration_type"] )

			);
			//var_dump($arr_extras);
			foreach ( $line_items as $item_id => $item2 ) {
				wc_delete_order_item_meta( $item_id, $item["item_name"], ( $val ), 1 );
				//echo  $item["item_name"] . ' ';
			}

		}


		//new car
		//	var_dump($_POST);
		if ( isset( $_POST['addcarid']{1} ) ) {
			$product_id    = (int) $_POST['addcarid'];
			$arr_resources = ( get_post_meta( $product_id, '_rental_resources', true ) );

			$arr_extras = array();
			foreach ( $arr_resources as $item ) {

				$val     = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . $item["duration_type"];
				$checked = false;
				if ( $item["cost"] == '0' || empty( $item["cost"] ) ) {
					$val = esc_html__( 'Free', 'rentit' );

				}
				if ( $item["duration_type"] == 'total' ) {
					$val = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . esc_html__( 'Total', 'rentit' );

				}
				if ( $item["duration_type"] == 'Included' ) {
					$val = esc_html__( 'Included', 'rentit' );

				}

				$arr_extras[] = array(
					'value'         => $val,
					'name'          => esc_html( $item["item_name"] ),
					'price'         => esc_attr( $item["cost"] ),
					"duration_type" => esc_attr( $item["duration_type"] )

				);
				//var_dump($arr_extras);
				foreach ( $line_items as $item_id => $item2 ) {
					wc_delete_order_item_meta( $item_id, $item["item_name"], ( $val ), 1 );
					//echo  $item["item_name"] . ' ';
				}

			}


		}
		//var_dump($arr_extras);
		foreach ( $_POST['checkbox_extras'] as $k => $v ) {

			foreach ( $line_items as $item_id => $item2 ) {

				//var_dump( $arr_extras[ $k ]['name']. ' '. ( $arr_extras[ $k ]['value'] ));
				//	var_dump( wc_add_order_item_meta( $item_id, $arr_extras[ $k ]['name'], sanitize_text_field( $arr_extras[ $k ]['value'] ) ) );
				wc_update_order_item_meta( $item_id, $arr_extras[ $k ]['name'], ( $arr_extras[ $k ]['value'] ) );

			}


		}


	} else {
		//echo '2';

		$arr_resources = ( get_post_meta( $product_id, '_rental_resources', true ) );

		//var_dump($product_id);
		$arr_extras = array();
		foreach ( $arr_resources as $item ) {

			$val     = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . $item["duration_type"];
			$checked = false;
			if ( $item["cost"] == '0' || empty( $item["cost"] ) ) {
				$val = esc_html__( 'Free', 'rentit' );

			}
			if ( $item["duration_type"] == 'total' ) {
				$val = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . esc_html__( 'Total', 'rentit' );

			}
			if ( $item["duration_type"] == 'Included' ) {
				$val = esc_html__( 'Included', 'rentit' );

			}

			$arr_extras[] = array(
				'value'         => $val,
				'name'          => esc_html( $item["item_name"] ),
				'price'         => esc_attr( $item["cost"] ),
				"duration_type" => esc_attr( $item["duration_type"] )

			);
			//var_dump($arr_extras);
			foreach ( $line_items as $item_id => $item2 ) {
				wc_delete_order_item_meta( $item_id, $item["item_name"], ( $val ), 1 );

				echo  $item["item_name"] . ' ';
			}

		}

	}
	echo 1;
	wp_die();
	exit();


}

add_action( 'wp_ajax_rentit_set_order_extras', 'rentit_set_order_extras' );
add_action( 'wp_ajax_nopriv_rentit_set_order_extras', 'rentit_set_order_extras' );


