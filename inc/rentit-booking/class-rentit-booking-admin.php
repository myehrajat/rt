<?php

/**
 * Booking admin product.
 * @package Rent It
 * @since Rent It 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//var_dump($_POST);

if ( !class_exists( 'rentit_Booking_Admin' ) ) :

	class rentit_Booking_Admin {


		function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'styles_and_scripts' ) );
			add_filter( 'product_type_selector', array( $this, 'rentit_rental_product_type' ) );
			add_filter( 'product_type_options', array( $this, 'rentit_rental_product_options' ), 8 );
			add_filter( 'woocommerce_product_write_panel_tabs', array( $this, 'rentit_rental_product_tabs' ) );
			add_action( 'woocommerce_product_data_panels', array( $this, 'rentit_rental_panels' ) );
			add_action( 'woocommerce_process_product_meta', array( $this, 'save_rental_data' ), 20 );
			add_action( 'woocommerce_product_options_general_product_data', array( $this, 'rental_prices' ) );
		}

		// Admin script
		public function styles_and_scripts( $hook ) {


			if ( get_post_type( get_the_ID() ) == 'product' ) {

				// wp_enqueue_style('renita_bootstrap.min',get_template_directory_uri() . '/inc/rentit-booking/assets/css/bootstrap.css');
				wp_enqueue_style( 'renita_mb', get_template_directory_uri() . '/inc/rentit-booking/assets/css/myb.css' );


				wp_enqueue_style( 'renita_bootstrap-datetimepicker', get_template_directory_uri() . "/js/datetimepicker/css/bootstrap-datetimepicker.min.css" );

				wp_enqueue_style( 'rental-product-data-css', rentit_INC . '/rentit-booking/assets/css/rental-product-data.css', null, '1.0' );

				wp_register_script( 'rentit-jquery-timepicker', rentit_INC . '/rentit-booking/assets/js/jquery.timepicker.min.js', array( 'jquery' ), false, true );
				wp_enqueue_script( 'rentit-jquery-timepicker' );


				wp_enqueue_script( 'renita_moment-with-locales', get_template_directory_uri() . "/js/datetimepicker/js/moment-with-locales.min.js", array( 'jquery' ), '1', true );
				wp_enqueue_script( 'renita_bootstrap-datetimepicker', get_template_directory_uri() . "/js/datetimepicker/js/bootstrap-datetimepicker.min.js", array( 'renita_moment-with-locales' ), '1', true );


				wp_register_script( 'rental-product-data', rentit_INC . '/rentit-booking/assets/js/product-data.js', array(
					'jquery',
					'rentit-jquery-timepicker'
				), false, true );


				wp_enqueue_script( 'rental-product-data' );


			}

		}

		// Add rental product type.
		public function rentit_rental_product_type( $product_type ) {

			unset( $product_type );
			$product_type['rentit_rental'] = esc_html__( 'Car rental product', 'rentit' );

			return $product_type;
		}

		// Add product options
		public function rentit_rental_product_options( $options ) {
			$options['virtual']['wrapper_class'] .= ' show_if_rentit_rental';

			return $options;
		}

		// Product panel
		public function rentit_rental_product_tabs() {
			include( 'includes/rentit-rental-tab.php' );
		}

		// Product panel content
		public function rentit_rental_panels() {
			global $post;

			$post_id = $post->ID;

			include( 'includes/rentit-rental-panels.php' );

		}

		// Save rental data
		public function save_rental_data( $post_id ) {

			global $wpdb;

			/**********************************************/
			/*
			 * Car year
			 */

			if ( isset( $_POST['_rental_car_year'] ) ) {
				update_post_meta( $post_id, '_rental_car_year', wc_clean( $_POST['_rental_car_year'] ) );
			}
			if ( isset( $_POST['_rental_car_engine'] ) ) {
				update_post_meta( $post_id, '_rental_car_engine', wc_clean( $_POST['_rental_car_engine'] ) );
			}
			if ( isset( $_POST['_rental_car_transmission'] ) ) {
				update_post_meta( $post_id, '_rental_car_transmission', wc_clean( $_POST['_rental_car_transmission'] ) );
			}
			if ( isset( $_POST['_rental_car_mileage'] ) ) {
				update_post_meta( $post_id, '_rental_car_mileage', wc_clean( $_POST['_rental_car_mileage'] ) );
			}
			if ( isset( $_POST['_rental_car_stars'] ) ) {
				update_post_meta( $post_id, '_rental_car_stars', wc_clean( $_POST['_rental_car_stars'] ) );
			}

			if ( isset( $_POST['_rentit_subtitle'] ) ) {
				//	update_post_meta( $post_id, '_rentit_subtitle', wc_clean( $_POST['_rentit_subtitle'] ) );
			}
			if ( isset( $_POST['_rentit_subtitle'] ) ) {
				update_post_meta( $post_id, '_rentit_subtitle', wc_clean( $_POST['_rentit_subtitle'] ) );
			}


			if ( isset( $_POST['_rentit_disable_rent'] ) ) {
				update_post_meta( $post_id, '_rentit_disable_rent', wc_clean( $_POST['_rentit_disable_rent'] ) );
			} else {
				delete_post_meta( $post_id, '_rentit_disable_rent' );
			}
			/***************************************/

			if ( isset( $_POST['product-type'] ) && $_POST['product-type'] == 'rentit_rental' ) {
				update_post_meta( $post_id, '_rentit_is_rental_product', 'yes' );
			}

			if ( isset( $_POST['_rental_duration_type'] ) ) {
				update_post_meta( $post_id, '_rental_duration_type', wc_clean( $_POST['_rental_duration_type'] ) );
			}

			if ( isset( $_POST['_rental_duration'] ) ) {
				update_post_meta( $post_id, '_rental_duration', wc_clean( $_POST['_rental_duration'] ) );
			}

			if ( isset( $_POST['_rental_time_frame'] ) ) {
				update_post_meta( $post_id, '_rental_time_frame', wc_clean( $_POST['_rental_time_frame'] ) );
			}

			if ( isset( $_POST['_min_duration'] ) ) {
				update_post_meta( $post_id, '_min_duration', wc_clean( $_POST['_min_duration'] ) );
			}

			if ( isset( $_POST['_max_duration'] ) ) {
				update_post_meta( $post_id, '_max_duration', wc_clean( $_POST['_max_duration'] ) );
			}

			if ( isset( $_POST['_block_duration'] ) ) {
				update_post_meta( $post_id, '_block_duration', wc_clean( $_POST['_block_duration'] ) );
			}

			if ( isset( $_POST['_max_rental_per_block'] ) ) {
				update_post_meta( $post_id, '_max_rental_per_block', wc_clean( $_POST['_max_rental_per_block'] ) );
			}

			if ( isset( $_POST['_min_drop_in'] ) ) {
				update_post_meta( $post_id, '_min_drop_in', wc_clean( $_POST['_min_drop_in'] ) );
			}

			if ( isset( $_POST['_min_drop_in_type'] ) ) {
				update_post_meta( $post_id, '_min_drop_in_type', wc_clean( $_POST['_min_drop_in_type'] ) );
			}


			if ( isset( $_POST['_max_drop_in'] ) ) {
				update_post_meta( $post_id, '_max_drop_in', wc_clean( $_POST['_max_drop_in'] ) );
			}

			if ( isset( $_POST['_max_drop_in_type'] ) ) {
				update_post_meta( $post_id, '_max_drop_in_type', wc_clean( $_POST['_max_drop_in_type'] ) );
			}


			$days = array(
				'_monday',
				'_tuesday',
				'_wednesday',
				'_thursday',
				'_friday',
				'_saturday',
				'_sunday'
			);

			foreach ( $days as $day ) {

				if ( isset( $_POST[$day . '_hour_from'] ) ) {
					update_post_meta( $post_id, $day . '_hour_from', $_POST[$day . '_hour_from'] );
				}

				if ( isset( $_POST[$day . '_hour_to'] ) ) {
					update_post_meta( $post_id, $day . '_hour_to', $_POST[$day . '_hour_to'] );
				}

				if ( isset( $_POST[$day . '_not_available'] ) ) {
					update_post_meta( $post_id, $day . '_not_available', $_POST[$day . '_not_available'] );
				} else {
					update_post_meta( $post_id, $day . '_not_available', '' );
				}

			}


			// Car locations

			$locations = array();
			if ( isset( $_POST['_car_drop_in_location'] ) ) {

				$dropins = array();
				$dropoffs = array();
				$car_drop_in_locations = isset( $_POST['_car_drop_in_location'] ) ? $_POST['_car_drop_in_location'] : array();
				$car_drop_off_locations = isset( $_POST['_car_drop_off_location'] ) ? $_POST['_car_drop_off_location'] : array();

				foreach ( $car_drop_in_locations as $key => $val ) {

					$dropins[$key] = wc_clean( $val );

				}

				update_post_meta( $post_id, '_car_dropins', $car_drop_in_locations );


				foreach ( $car_drop_off_locations as $key => $val ) {

					$dropoffs[$key] = wc_clean( $val );

					$locations[$key] = array(
						'drop_in' => wc_clean( $car_drop_in_locations[$key] ),
						'drop_off' => wc_clean( $car_drop_off_locations[$key] )
					);

				}

				update_post_meta( $post_id, '_car_dropoffs', $car_drop_off_locations );

			}
			update_post_meta( $post_id, '_car_locations', $locations );


			// Rental costs

			if ( isset( $_POST['_base_cost'] ) ) {
				update_post_meta( $post_id, '_base_cost', wc_clean( $_POST['_base_cost'] ) );
			}
			if ( isset( $_POST['_sale_cost'] ) ) {
				update_post_meta( $post_id, '_sale_cost', wc_clean( $_POST['_sale_cost'] ) );
			}
			if ( isset( $_POST['_base_cost_winter'] ) ) {
				update_post_meta( $post_id, '_base_cost_winter', wc_clean( $_POST['_base_cost_winter'] ) );
			}
			if ( isset( $_POST['_rentit_weekend_price'] ) ) {
				update_post_meta( $post_id, '_rentit_weekend_price', wc_clean( $_POST['_rentit_weekend_price'] ) );
			}
			if ( isset( $_POST['_rentit_deposit_percent'] ) ) {
				update_post_meta( $post_id, '_rentit_deposit_percent', wc_clean( $_POST['_rentit_deposit_percent'] ) );
			}
			if ( isset( $_POST['_base_cost_spring'] ) ) {
				update_post_meta( $post_id, '_base_cost_spring', wc_clean( $_POST['_base_cost_spring'] ) );
			}
			if ( isset( $_POST['_rentit_min_quantity'] ) ) {
				update_post_meta( $post_id, '_rentit_min_quantity', wc_clean( $_POST['_rentit_min_quantity'] ) );
			}
			if ( isset( $_POST['_base_cost_summer'] ) ) {
				update_post_meta( $post_id, '_base_cost_summer', wc_clean( $_POST['_base_cost_summer'] ) );
			}
			if ( isset( $_POST['_base_cost_autumn'] ) ) {
				update_post_meta( $post_id, '_base_cost_autumn', wc_clean( $_POST['_base_cost_autumn'] ) );
			}

			if ( isset( $_POST['_base_cost'] ) ) {
				update_post_meta( $post_id, '_base_cost', wc_clean( $_POST['_base_cost'] ) );
			}

			if ( isset( $_POST['_block_cost'] ) ) {
				update_post_meta( $post_id, '_block_cost', wc_clean( $_POST['_block_cost'] ) );
			}

			if ( isset( $_POST['_display_rental_cost'] ) ) {
				update_post_meta( $post_id, '_display_rental_cost', wc_clean( $_POST['_display_rental_cost'] ) );
			}

			// Display cost
			if ( isset( $_POST['_rental_duration_type'] ) && $_POST['_rental_duration_type'] == 'flexible_rental' ) {
				update_post_meta( $post_id, '_base_cost', wc_clean( $_POST['_base_cost'] ) );
			}

			if ( isset( $_POST['_rental_duration_type'] ) && $_POST['_rental_duration_type'] == 'fixed_rental' ) {
				update_post_meta( $post_id, '_base_cost', wc_clean( $_POST['_block_cost'] ) );
			}


			/***
			 * min max rent dae
			 */

			if ( isset( $_POST['_rental_min_date_hours'] ) ) {
				update_post_meta( $post_id, '_rental_min_date_hours', wc_clean( $_POST['_rental_min_date_hours'] ) );
			}

			if ( isset( $_POST['_rental_max_date_hours'] ) ) {
				update_post_meta( $post_id, '_rental_max_date_hours', wc_clean( $_POST['_rental_max_date_hours'] ) );
			}

			if ( isset( $_POST['_rental_max_date_day'] ) ) {
				update_post_meta( $post_id, '_rental_max_date_day', wc_clean( $_POST['_rental_max_date_day'] ) );
			}

			if ( isset( $_POST['_rental_min_date_day'] ) ) {
				update_post_meta( $post_id, '_rental_min_date_day', wc_clean( $_POST['_rental_min_date_day'] ) );
			}


			// Resources

			$resources = array();
			if ( isset( $_POST['_rental_resource_item_name'] ) ) {

				$resource_name = isset( $_POST['_rental_resource_item_name'] ) ? $_POST['_rental_resource_item_name'] : array();
				$resource_qty = isset( $_POST['_rental_resource_quantity'] ) ? $_POST['_rental_resource_quantity'] : array();
				$resource_cost = isset( $_POST['_rental_resource_cost'] ) ? $_POST['_rental_resource_cost'] : array();
				$resource_duration = isset( $_POST['_rental_resource_duration_val'] ) ? $_POST['_rental_resource_duration_val'] : array();
				$resource_duration_type = isset( $_POST['_rental_resource_duration_type'] ) ? $_POST['_rental_resource_duration_type'] : array();
				$resource_is_flat_cost = isset( $_POST['_rental_resource_flat_cost'] ) ? $_POST['_rental_resource_flat_cost'] : array();

				foreach ( $resource_name as $key => $value ) {

					$val_lc = strtolower( $value );
					$slug = str_replace( " ", "-", $val_lc );

					$resources[$post_id . '_' . $slug] = array(
						'resource_id' => $post_id . '_' . $slug,
						'item_name' => wc_clean( $value ),
						'quantity' => wc_clean( $resource_qty[$key] ),
						'cost' => wc_clean( $resource_cost[$key] ),
						'duration_val' => wc_clean( $resource_duration[$key] ),
						'duration_type' => wc_clean( $resource_duration_type[$key] ),
						'is_flat_cost' => wc_clean( $resource_is_flat_cost[$key] )
					);

				}
			}

			update_post_meta( $post_id, '_rental_resources', $resources );

			/**
			 * discounts             *
			 */

			$discounts = array();

			if ( isset( $_POST['_rental_discount_cost'] ) ) {


				$discount_cost = isset( $_POST['_rental_discount_cost'] ) ? $_POST['_rental_discount_cost'] : array();
				$discount_duration = isset( $_POST['_rental_discount_duration_val'] ) ? $_POST['_rental_discount_duration_val'] : array();
				$discount_duration_type = isset( $_POST['_rental_discount_duration_type'] ) ? $_POST['_rental_discount_duration_type'] : array();

				$j = 0;
				foreach ( $discount_cost as $key => $value ) {

					$val_lc = strtolower( $value );
					$slug = str_replace( " ", "-", $val_lc );

					$discounts[$j . '_' . $slug] = array(
						'discount_id' => $post_id . '_' . $slug,
						'cost' => wc_clean( $discount_cost[$key] ),
						'duration_val' => wc_clean( $discount_duration[$key] ),
						'duration_type' => wc_clean( $discount_duration_type[$key] ),

					);
					$j ++;
				}
			}

			update_post_meta( $post_id, '_rental_discounts', $discounts );



			/// charge locations
			///
			///
			///

			$charge_locations = array();

			if ( isset( $_POST['_rental_charge_locations'] ) ) {

				$charge_locations = $_POST['_rental_charge_locations'];
				/*var_dump($charge_locations);
				die();*/
				/*$rental_dropin_charge_locations = isset( $_POST['_rental_dropin_charge_locations'] ) ? $_POST['_rental_dropin_charge_locations'] : array();
				$rental_dropoff_charge_locations  = isset( $_POST['_rental_dropoff_charge_locations'] ) ? $_POST['_rental_dropoff_charge_locations'] : array();
				$rental_charge_days = isset( $_POST['_rental_charge_days'] ) ? $_POST['_rental_charge_days'] : array();

				var_dump($rental_charge_days);
				var_dump($rental_dropin_charge_locations);
				var_dump($rental_dropoff_charge_locations);

				$j = 0;
				foreach ( $rental_dropin_charge_locations as $key => $value ) {

					$val_lc = strtolower( $value );
					$slug = str_replace( " ", "-", $val_lc );

					$charge_locations[$j . '_' . $slug] = array(
						'id' => $post_id . '_' . $slug,
						'days' => $rental_charge_days[$key] ,
						'rental_dropin_charge_locations' => ( $rental_dropin_charge_locations[$key] ),
						'rental_dropoff_charge_locations' => ( $rental_dropoff_charge_locations[$key] ),

					);
					$j ++;
				}

				var_dump($charge_locations);

				die();*/
			}

			update_post_meta( $post_id, '_rental_charge_locations', $charge_locations );


			//







			if ( isset( $_POST['_bulk_resources'] ) ) {
				update_post_meta( $post_id, '_rental_bulk_resources', $_POST['_bulk_resources'] );
			} else {
				update_post_meta( $post_id, '_rental_bulk_resources', array() );
			}
			/**
			 * unavailable           *
			 */

			$discounts = array();
			if ( isset( $_POST['_rental_unavailable_date'] ) ) {

				$discount_unavailable_date = isset( $_POST['_rental_unavailable_date'] ) ? $_POST['_rental_unavailable_date'] : array();
				$discount_unavailable_date_end = isset( $_POST['_rental_unavailable_date_end'] ) ? $_POST['_rental_unavailable_date_end'] : array();

				foreach ( $discount_unavailable_date as $key => $value ) {

					$val_lc = strtolower( $value );
					$slug = str_replace( " ", "-", $val_lc );

					$discounts[$post_id . '_' . $slug] = array(
						'discount_id' => $post_id . '_' . $slug,
						'discount_unavailable_date' => wc_clean( $discount_unavailable_date[$key] ),
						'discount_unavailable_date_end' => wc_clean( $discount_unavailable_date_end[$key] ),

					);

				}

				update_post_meta( $post_id, '_rental_unavailable_date', $discounts );
			} else {
				delete_post_meta( $post_id, '_rental_unavailable_date' );
			}

			/*
			 * season price
			 */

			$seasons = array();



			if ( isset( $_POST['_rental_season_price'] ) ) {

				$season_start_date = isset( $_POST['_rental_season_start_date'] ) ? $_POST['_rental_season_start_date'] : array();
				$season_end_date = isset( $_POST['_rental_season_end_date'] ) ? $_POST['_rental_season_end_date'] : array();
				$season_price = isset( $_POST['_rental_season_price'] ) ? $_POST['_rental_season_price'] : array();
				$rental_season_discount = isset( $_POST['_rental_season_discount'] ) ? $_POST['_rental_season_discount'] : array();

				foreach ( $season_start_date as $key => $value ) {

					$val_lc = strtolower( $value );
					$slug = str_replace( " ", "-", $val_lc );

					$seasons[$post_id . '_' . $slug] = array(
						'price' => wc_clean( $season_price[$key] ),
						'start_date' => wc_clean( $season_start_date[$key] ),
						'end_date' => wc_clean( $season_end_date[$key] ),
						'rental_season_discount' => $rental_season_discount[$key]

					);

				}



				update_post_meta( $post_id, '_rental_season_date', $seasons );
			} else {
				delete_post_meta( $post_id, '_rental_season_date' );
			}


			// Drop-in/drop-off location
			if ( isset( $_POST['_dropin_locations2'] ) && !isset( $_POST['_dropin_all_locations'] ) ) {

				update_post_meta( $post_id, '_rental_dropin_locations2', $_POST['_dropin_locations2'] );
			} else {
				update_post_meta( $post_id, '_rental_dropin_locations2', array() );
			}


			if ( isset( $_POST['_dropoff_locations2'] ) && !isset( $_POST['_dropoff_all_locations'] ) ) {
				update_post_meta( $post_id, '_rental_dropoff_locations2', $_POST['_dropoff_locations2'] );
			} else {
				update_post_meta( $post_id, '_rental_dropoff_locations2', array() );
			}

			// All locations
			$args = array(
				'post_type' => 'rental_location',
				'posts_per_page' => - 1
			);

			$locations = get_posts( $args );

			$all_loc = array();
			if ( count( $locations ) > 0 ):
				foreach ( $locations as $location ) {
					$id = $location->ID;
					$all_loc[] = get_the_title( $id );
				}
			endif;

			array_unique($all_loc);
			if ( isset( $_POST['_dropin_all_locations'] ) && $_POST['_dropin_all_locations'] == 'yes' ) {
				update_post_meta( $post_id, '_dropin_all_locations', 'yes' );
			} else {
				update_post_meta( $post_id, '_dropin_all_locations', '' );
			}

			if ( isset( $_POST['_dropoff_all_locations'] ) && $_POST['_dropoff_all_locations'] == 'yes' ) {
				update_post_meta( $post_id, '_dropoff_all_locations', 'yes' );
			} else {
				update_post_meta( $post_id, '_dropoff_all_locations', '' );
			}

			if ( isset( $_POST['_dropin_all_locations'] ) && $_POST['_dropin_all_locations'] == 'yes' ) {
				update_post_meta( $post_id, '_rental_dropin_locations2', array_unique($all_loc) );
			}

			if ( isset( $_POST['_dropoff_all_locations'] ) && $_POST['_dropoff_all_locations'] == 'yes' ) {
				update_post_meta( $post_id, '_rental_dropoff_locations2', array_unique($all_loc) );
			}


			// uni
			// unique locations

			$arr_dropin_locations2 =	get_post_meta( $post_id, '_rental_dropin_locations2', 1 );
			if(is_array($arr_dropin_locations2)){
				$arr_dropin_locations2 = array_unique($arr_dropin_locations2);
				update_post_meta( $post_id, '_rental_dropin_locations2', $arr_dropin_locations2);

			}

			$arr_dropoff_locations2 =	get_post_meta( $post_id, '_rental_dropoff_locations2', 1 );
			if(is_array($arr_dropoff_locations2 )){
				$arr_dropoff_locations2  = array_unique($arr_dropoff_locations2 );
				update_post_meta( $post_id, '_rental_dropoff_locations2', $arr_dropoff_locations2 );

			}


		}


		public function rental_prices() {


			include( 'includes/rentit-general-panel.php' );


		}


	}

endif;


new rentit_Booking_Admin();
