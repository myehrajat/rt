<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version    4.6.4
 */


if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$product = rentit_get_global_product();
$woocommerce_loop = rentit_get_global_woocommerce_loop();

?>

<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
      class="cart" method="post"
      enctype='multipart/form-data'>


    <div
            id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php

		if ( !$product->is_in_stock() ) {
			?>
            <div class="woocommerce-error">
                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert" type="button"><?php  esc_html_e('×','rentit'); ?></button>
                    <strong> <?php  esc_html_e('Product is Out of Stock','rentit'); ?></strong></div>
            </div>
			<?php
		}
		/**
		 * woocommerce_before_single_product hook
		 *
		 * @hooked wc_print_notices - 10
		 *
		 */

		do_action( 'woocommerce_before_single_product' );

		if ( post_password_required() ) {
			echo wp_kses_post( get_the_password_form() );

			return;
		}
		?>

        <h3 class="block-title alt"><i class="fa fa-angle-down"></i>
			<?php echo esc_html__( 'Car Information', 'rentit' );

			?>
        </h3>


        <div class="car-big-card alt">

            <div class="row">

				<?php


				if ( has_post_thumbnail() ) {
					//get gallery
					get_template_part( 'partials/car', 'gallery' );

				} ?>
                <div class="col-md-4">
                    <div class="car-details">
                        <div class="list">
                            <ul>
                                <li class="title">
                                    <h2> <!--span>Diesel</span-->
										<?php

										$arr = explode( ' ', get_the_title() );
										$arr[count( $arr ) - 1] = '<span>' . $arr[count( $arr ) - 1] . '</span>';
										echo implode( $arr, ' ' );

										?>

                                    </h2>
									<?php
									$subtitle = get_post_meta( get_the_ID(), '_rentit_subtitle', true );

									if ( !empty( $subtitle ) ) {
										echo esc_html( $subtitle );
									}

									?>


                                </li>

								<?php

								$has_row = false;
								$alt = 1;
								$attributes = $product->get_attributes();


								?>


								<?php foreach ( $attributes as $attribute ) :


									if ( $attribute['name']{0} == "*" ) {
										continue;
									}
									if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && !taxonomy_exists( $attribute['name'] ) ) ) {
										continue;
									} else {
										$has_row = true;
									}
									?>

									<?php
									if ( $attribute['is_taxonomy'] ) {

										$values = wc_get_product_terms( $product->get_id(), $attribute['name'], array( 'fields' => 'names' ) );
										?>
                                        <li>
											<?php
											echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
											?>
                                        </li>
										<?php
									} else {
										?>
                                        <li><?php
											// Convert pipes to commas and display values
											$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
											echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
											?>
                                        </li>
										<?php
									}
									?>

								<?php endforeach; ?>
                            </ul>

                        </div>
                        <div class="price">

							<?php

							rentit_single_formatted_price();
							echo esc_html( rentit_get_current_type( get_the_ID() ) ); ?>
                            <i
                                    class="fa fa-info-circle"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="images">


        </div>


        <hr class="page-divider half transparent"/>


		<?php


		/****************************/

		/****************************/
		the_content(); ?>

        <h3 class="block-title alt"><i class="fa fa-angle-down"></i><?php esc_html_e( 'Extras & Frees', 'rentit' ) ?>
        </h3>

        <div class="">
			<?php $arr_resources = ( get_post_meta( $post->ID, '_rental_resources', true ) );


			if ( !empty( $arr_resources ) ):
				foreach ( $arr_resources as $item ) {
					$type = '';

					// for translation
					if ( $item["duration_type"] == 'days' ) {
						$type = esc_html__( 'Days', 'rentit' );
					}
					if ( $item["duration_type"] == 'hours' ) {
						$type = esc_html__( 'Hours', 'rentit' );
					}
					if ( $item["duration_type"] == 'total' ) {
						$type = esc_html__( 'Total', 'rentit' );
					}
					if ( $item["duration_type"] == 'Included' ) {
						$type = esc_html__( 'Included', 'rentit' );
					}


					$val = rentit_get_formatted_price_extras($item["cost"]) . " " . ' / ' . $type;
					$checked = false;
					$disable = false;


					if ( $item["cost"] == '0' || empty( $item["cost"] ) ) {
						$val = esc_html__( 'Free', 'rentit' );
						$checked = true;

					}
					if ( $item["duration_type"] == 'total' ) {

						$val = rentit_get_formatted_price_extras($item["cost"]) . " " . ' / ' . $type;
						$checked = false;
					}

					if ( $item["duration_type"] == 'Included' ) {
						$val = $type;
						$checked = true;
						$disable = true;

					}
					if ( $item["duration_type"] == 'fixed_change' ) {
						$val = rentit_get_formatted_price_extras($item["cost"]) . " " . ' / ' . $type;;

						$checked = true;
						$disable = true;

					}


					$arr_extras[] = array(
						'value' => $val,
						'name' => esc_html( $item["item_name"] ),
						'price' => esc_attr( $item["cost"] ),
						'checked' => $checked,
						'disable' => $disable

					);

				}
			endif;

			?>
        </div>
        <div role="form" class="form-extras">

            <div class="row">


                <div class="col-md-6">
                    <div class="left">

						<?php
						if ( !empty( $arr_resources ) ):
							$how = ceil( count( $arr_extras ) / 2 );


							$i = 0;
							while ( $i < $how ) {

								?>
                                <div class="checkbox checkbox-danger">
                                    <input name="checkbox_extras[<?php echo esc_attr( $i ); ?>]"
                                           data-price="<?php echo @esc_attr( $arr_extras[$i]['price'] ); ?>"
                                           id="checkboxl<?php echo esc_attr( $i ); ?>"
                                           type="checkbox"
										<?php if ( $arr_extras[$i]['checked'] == true ) {
											echo 'checked="" value="on"' ;
										} ?>

										<?php if ( $arr_extras[$i]['disable'] == true ) { ?>
                                            disabled="disabled"
										<?php } ?>
                                    >

									<?php if ( $arr_extras[$i]['disable'] == true ) { ?>

                                        <input type="hidden" name="checkbox_extras[<?php echo esc_attr( $i ); ?>]" value="on" />
									<?php } ?>
                                    <label
                                            for="checkboxl<?php echo esc_attr( $i ); ?>"><?php echo @esc_attr( $arr_extras[$i]['name'] ); ?>
                                        <span
                                                class="pull-right">
                                            <?php echo @esc_attr( $arr_extras[$i]['value'] ); ?> </span></label>
                                </div>
								<?php
								$i ++;
							}
						endif;

						?>

                    </div>
                </div>


                <div class="col-md-6">
                    <div class="right">
						<?php
						if ( !empty( $arr_resources ) ):
							while ( $i < count( $arr_extras ) ) {

								?>
                                <div class="checkbox checkbox-danger">
                                    <input name="checkbox_extras[<?php echo esc_attr( $i ); ?>]"
                                           data-price="<?php echo @esc_attr( $arr_extras[$i]['price'] ); ?>"
                                           id="checkboxl<?php echo esc_attr( $i ); ?>"
                                           type="checkbox"
										<?php if ( $arr_extras[$i]['checked'] == true ) {
											echo 'checked="" value="on"' ;
										} ?>
										<?php if ( $arr_extras[$i]['disable'] == true ) { ?>
                                            disabled="disabled"
										<?php } ?>

                                    >


                                    <label
                                            for="checkboxl<?php echo esc_attr( $i ); ?>"><?php echo @esc_attr( $arr_extras[$i]['name'] ); ?>
                                        <span
                                                class="pull-right">    <?php  echo @esc_attr( $arr_extras[$i]['value'] ); ?> </span></label>


									<?php if ( $arr_extras[$i]['disable'] == true ) { ?>

                                        <input type="hidden" name="checkbox_extras[<?php echo esc_attr( $i ); ?>]" value="on" />
									<?php } ?>
                                </div>
								<?php
								$i ++;

							}
						endif;
						?>


                    </div>
                </div>

            </div>

        </div>

		<?php $eable_car_seless = get_post_meta( get_the_ID(), '_rentit_disable_rent', 1 );

		if ( !$eable_car_seless ):
			?>
            <div class="row">
                <div class="row row-inputs">
                    <div class="container-fluid">
                        <div class="col-sm-12">
                            <div class="form-group has-icon has-label">
                                <label
                                        for="formSearchUpLocation3"><?php esc_html_e( 'Picking Up Location', 'rentit' ) ?> </label>
                                <input type="text" class="form-control formSearchUpLocation2" id="formSearchUpLocation3"
                                       name="dropin_location"
                                       placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>"
                                       value="<?php
								       if ( function_exists( 'rentit_get_date_s' ) ) {
									       rentit_get_date_s( 'dropin_location' );
								       }
								       ?>"
                                >
								<?php

								// get Picking Up Location
								$pick_up_location = get_post_meta( get_the_ID(), '_rental_dropin_locations2', true );

								$locaton_arr = array();
								$locaton_str = '';
								if ( $pick_up_location ) {
									foreach ( $pick_up_location as $location ) {
										$locaton_arr[] = "'" . $location . "'";
									}
									$locaton_str = implode( ',', $locaton_arr );
								}


								?>
                                <script>
                                    jQuery(document).ready(function ($) {
                                        $('.formSearchUpLocation2').typeahead({
                                            minLength: 0,
                                            source: [<?php echo wp_kses_post( $locaton_str ); ?>]
                                        });
                                    });
                                </script>
								<?php unset( $locaton_arr, $locaton_str, $pick_up_location ); ?>
                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group has-icon has-label">
                                <label
                                        for="formSearchOffLocation3"><?php esc_html_e( 'Dropping Off Location', 'rentit' ) ?></label>

                                <input name="dropoff_location" type="text" class="form-control formSearchUpLocation20"
                                       id="formSearchOffLocation3"
                                       placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>"
                                       value="<?php

								       if ( function_exists( 'rentit_get_date_s' ) ) {
									       rentit_get_date_s( 'dropoff_location' );
								       }
								       ?>">
								<?php

								// get PDropping Off Location
								$pick_up_location = get_post_meta( get_the_ID(), '_rental_dropoff_locations2', true );
								$locaton_arr = array();
								$locaton_str = '';
								if ( $pick_up_location ) {
									foreach ( $pick_up_location as $location ) {
										$locaton_arr[] = "'" . $location . "'";
									}
									$locaton_str = implode( ',', $locaton_arr );

								}
								?>
                                <script>
                                    jQuery(document).ready(function ($) {
                                        $('.formSearchUpLocation20').typeahead({
                                            minLength: 0,
                                            source: [<?php echo wp_kses_post( $locaton_str ); ?>]
                                        });
                                        $('.formSearchUpLocation2').click(function (e) {
                                            if ($(this).val().length > 2) {
                                                $(this).typeahead('setQuery', '');
                                                /*$(this).val('');
												$(this).click();
												$(this).trigger('click');
												setTimeout(function () {
													var a = $.Event('keypress');
													a.which = 9; // Character 'A'
													$(this).trigger(a);
												},50);*/


                                            }

                                        });
                                        //jQuery('.formSearchUpLocation20').trigger('click');
                                    });
                                </script>
								<?php unset( $locaton_arr, $locaton_str, $pick_up_location ); ?>

                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

				<?php
				// var_dump(get_post_meta( get_the_ID()));

				if ( get_post_meta( get_the_ID(), '_manage_stock', true ) == 'yes' ) { ?>
                    <div class="row row-inputs">
                        <div class="container-fluid">
                            <div class="col-sm-4">
                                <div class="form-group has-icon has-label">
                                    <label
                                            for="formSearchUpDate3"><?php esc_html_e( 'Picking Up Date', 'rentit' ) ?></label>
                                    <input name="dropin_date" type="text" class="form-control"
                                           id="formSearchUpDate3"
                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>"
                                           value="<?php
									       if ( function_exists( 'rentit_get_date_s' ) ) {
										       rentit_get_date_s( 'dropin_date' );
									       }
									       ?>"
                                    >
                                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group has-icon has-label">
                                    <label
                                            for="formSearchOffDate3"><?php esc_html_e( 'Dropping Off Date', 'rentit' ) ?></label>
                                    <input name="dropoff_date" type="text" class="form-control"
                                           id="formSearchOffDate3"
                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>"
                                           value="<?php
									       if ( function_exists( 'rentit_get_date_s' ) ) {
										       rentit_get_date_s( 'dropoff_date' );
									       }
									       ?>"
                                    >
                                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <div class="form-group has-icon has-label">
                                    <label for="formSearchQuantity"><?php esc_html_e( 'Quantity', 'rentit' ) ?></label>
                                    <input name="quantity" type="number" class="form-control"
                                           id="formSearchQuantity"
                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>"
                                           step="1" min=""
                                           value="1"
                                    >

                                </div>
                            </div>


                        </div>
                    </div>


				<?php } else {
					?>
                    <div class="row row-inputs">
                        <div class="container-fluid">
                            <div class="col-sm-6">
                                <div class="form-group has-icon has-label">
                                    <label
                                            for="formSearchUpDate3"><?php esc_html_e( 'Picking Up Date', 'rentit' ) ?></label>
                                    <input name="dropin_date" type="text" class="form-control"
                                           id="formSearchUpDate3"
                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>"
                                           value="<?php
									       if ( function_exists( 'rentit_get_date_s' ) ) {
										       rentit_get_date_s( 'dropin_date' );
									       }
									       ?>"
                                    >
                                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group has-icon has-label">
                                    <label
                                            for="formSearchOffDate3"><?php esc_html_e( 'Dropping Off Date', 'rentit' ) ?></label>
                                    <input name="dropoff_date" type="text" class="form-control"
                                           id="formSearchOffDate3"
                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>"
                                           value="<?php
									       if ( function_exists( 'rentit_get_date_s' ) ) {
										       rentit_get_date_s( 'dropoff_date' );
									       }
									       ?>"
                                    >
                                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                        </div>
                    </div>
					<?php
				} ?>


            </div>
		<?php endif; ?>


        <h3 class="block-title alt"><i class="fa fa-angle-down"></i><?php esc_html_e( '', 'rentit' ) ?>
			<?php esc_html_e( ' Customer Information', 'rentit' ); ?>
        </h3>

        <div class="form-delivery">
            <div class="row">
                <div class="col-md-12">
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio1" value="option1" name="radioInline"
                               checked="">
                        <label for="inlineRadio1"> <?php esc_html_e( 'Mr', 'rentit' ); ?></label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" value="option1" name="radioInline">
                        <label for="inlineRadio2"><?php esc_html_e( 'Ms', 'rentit' ); ?></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control alt" type="text" name="billing_first_name"
                               placeholder="<?php esc_html_e( 'First Name *', 'rentit' ); ?>"
                               value="<?php
						       if ( function_exists( 'rentit_get_date_s' ) ) {
							       rentit_get_date_s( 'billing_first_name' );
						       }

						       ?>"
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control alt" type="text" name="billing_last_name"
                               placeholder="<?php esc_html_e( 'Last Name *', 'rentit' ); ?>"
                               value="<?php
						       if ( function_exists( 'rentit_get_date_s' ) ) {
							       rentit_get_date_s( 'billing_last_name' );
						       }

						       ?>"
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <input name="billing_email" class="form-control alt" type="text"
                               placeholder="<?php esc_html_e( 'Your Email Address *', 'rentit' ); ?>"
                               value="<?php
						       if ( function_exists( 'rentit_get_date_s' ) ) {
							       rentit_get_date_s( 'billing_email' );
						       }
						       ?>"

                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control alt" name="billing_phone" type="text"
                               placeholder="<?php esc_html_e( 'Phone Number: *', 'rentit' ); ?>" value="<?php
						if ( function_exists( 'rentit_get_date_s' ) ) {
							rentit_get_date_s( 'billing_phone' );
						}
						?>"></div>
                </div>

            </div>
        </div>


        <!--
        <h3 class="block-title alt"><i class="fa fa-angle-down"></i><?php esc_html_e( 'Payments options', 'rentit' ) ?>
        </h3>
        <?php
		?>
        <div class="panel-group payments-options" id="accordion" role="tablist"
             aria-multiselectable="true">


            <?php
		if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
			// Chosen Method
			if ( sizeof( $available_gateways ) ) {
				current( $available_gateways )->set_current();
			}

			$j = 10;
			foreach ( $available_gateways as $gateway ) {
				?>


                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a
                                    <?php
				if ( !$gateway->chosen == true ):
					?>
                                        class="collapsed"
                                    <?php endif; ?>
                                    data-toggle="collapse"
                                    data-parent="#accordion"
                                    href="#collapse<?php echo esc_attr( $j ); ?>"
                                    aria-expanded="true"
                                    aria-controls="collapseOne"
                                    onclick="jQuery('.collapse<?php echo esc_attr( $j ); ?>').prop('checked', true);"

                                >
                                                    <span
                                                        class="dot"></span> <?php echo esc_html( $gateway->get_title() ); ?>
                                </a>

                                                <span class="overflowed pull-right">

                                                    <?php if ( $gateway->id == 'bacs' ): ?>
                                                        <img
                                                            src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/preview/payments/mastercard-2.jpg"
                                                            alt=""/>
                                                        <img
                                                            src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/preview/payments/visa-2.jpg"
                                                            alt=""/>
                                                        <img
                                                            src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/preview/payments/american-express-2.jpg"
                                                            alt=""/>
                                                        <img
                                                            src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/preview/payments/discovery-2.jpg"
                                                            alt=""/>
                                                        <img
                                                            src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/preview/payments/eheck-2.jpg"
                                                            alt=""/>  <?php endif; ?>

                                                    <?php if ( $gateway->id == 'paypal' ) { ?>
                                                        <img
                                                            src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/preview/payments/paypal-2.jpg"
                                                            alt=""/>
                                                    <?php } ?>
                                                </span>

                            </h4>
                        </div>
                        <div id="collapse<?php echo esc_attr( $j ); ?>"
                             class="panel-collapse collapse"
                             role="tabpanel"
                             aria-labelledby="heading2">
                            <input style="display: none"
                                   id="payment_method_<?php echo esc_attr( $gateway->id ); ?>"
                                   type="radio"
                                   class="input-radio collapse<?php echo esc_attr( $j ); ?>"
                                   name="payment_method"
                                   value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?>
                                   data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>"/>

                            <div class="panel-body">
                                <?php $gateway->payment_fields(); ?>
                                <?php

				if ( $gateway->has_fields() || $gateway->get_description() ) {
					echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
					$gateway->payment_fields();
					echo '</div>';
				} ?>
                            </div>
                        </div>
                    </div>
                    <?php
				$j ++;
			}
		} else {

			echo '<p>' . esc_html__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', "rentit" ) . '</p>';

		}
		?>







        </div>
        -->

        <h3 class="block-title alt"><i
                    class="fa fa-angle-down"></i><?php esc_html_e( 'Additional Information', 'rentit' ) ?></h3>

        <div class="form-delivery">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea
                                class="form-control alt"
                                placeholder="<?php echo esc_html__( 'Additional Information', 'rentit' ); ?>"
                                name="order_comments"
                                id="id" cols="30" rows="10"><?php
	                        if ( function_exists( 'rentit_get_date_s' ) ) {
		                        rentit_get_date_s( 'order_comments' );
	                        }
	                        ?></textarea>
                    </div>
                </div>
            </div>
        </div>

		<?php
		/**
		 * Loop Add to Cart
		 */


		$product = rentit_get_global_product();


		?>

		<?php if ( !$product->is_in_stock() ) : ?>


		<?php else : ?>

			<?php

			/*switch ( $product->product_type ) {
				case "variable" :
					$link  = get_permalink( $product->get_id());
					$label = apply_filters( 'variable_add_to_cart_text', esc_html__( 'Select options', "rentit" ) );
					break;
				case "grouped" :
					$link  = get_permalink( $product->get_id() );
					$label = apply_filters( 'grouped_add_to_cart_text', esc_html__( 'View options', "rentit" ) );
					break;
				case "external" :
					$link  = get_permalink( $product->get_id() );
					$label = apply_filters( 'external_add_to_cart_text', esc_html__( 'Read More', "rentit" ) );
					break;
				default :
					$link  = esc_url( $product->add_to_cart_url() );
					$label = apply_filters( 'add_to_cart_text', esc_html__( 'Add to cart', "rentit" ) );
					break;
			}*/


			$link = esc_url( $product->add_to_cart_url() );
			$label = apply_filters( 'add_to_cart_text', esc_html__( 'Add to cart', "rentit" ) );


			if ( $product->is_type( 'simple' ) ) {


				?>


                <input type="hidden" name="inline-add-to-cart-enabled" value="">
                <input type="hidden" name="inline-add-to-cart-enabled" value="yes">
                <input type="hidden" name="add-to-cart"
                       value="<?php echo esc_attr( $post->ID ); ?>">

                <input type="hidden" name="custom_data_4" value="<?php echo esc_attr( '1' ); ?>">
                <input type="hidden" name="custom_data_5" value="<?php echo esc_attr( '2' ); ?>">

				<?php

			} else {

				printf( '<a href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a>', $link, $product->get_id(), '', $label );

			}
			?>

		<?php endif; ?>


        <div class="overflowed reservation-now">
            <div class="checkbox pull-left">
                <input id="checkboxa1" type="checkbox">
                <label
                        for="checkboxa1"><?php esc_html_e( 'I accept all information and Payments etc', 'rentit' ) ?></label>
            </div>

            <button id="reservation_car_btn" type="submit" disabled="disabled"

                    class="btn btn-theme pull-right">
				<?php

				if ( $eable_car_seless ) {
					esc_html_e( 'buy now', 'rentit' );
				} else {
					esc_html_e( 'Reservation Now', 'rentit' );
				}
				?>
            </button>

        </div>
    </div>
    <!-- #product-<?php the_ID(); ?> -->
</form>

<?php do_action( 'woocommerce_after_single_product' ); ?>





