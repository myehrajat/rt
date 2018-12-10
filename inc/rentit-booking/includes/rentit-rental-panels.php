<?php

$post_id = get_the_ID();

?>

<div id="rental_availability" class="panel woocommerce_options_panel">

    <div class="options_group hide_if_grouped">
		<?php

		woocommerce_wp_text_input( array(
			'id' => '_max_rental_per_block',
			'label' => esc_html__( 'Max rental per block', 'rentit' ),
			'desc_tip' => 'true',
			'description' => esc_html__( 'Amount of maximum rental for each block.', 'rentit' )
		) );

		?>


        <p class="form-field dimensions_field">
            <label for="minimal_rental_block"><?php echo esc_html__( 'Minimum drop in', 'rentit' ); ?></label>
            <span class="wrap">

        <input id="minimal_rental_block" size="6" type="text" placeholder="<?php echo esc_html__( 'Min', 'rentit' ); ?>"
               name="_min_drop_in" value="<?php echo esc_attr( get_post_meta( $post_id, '_min_drop_in', true ) ); ?>"/>

        <select name="_min_drop_in_type" id="min_rental_block_type" class="select short">
	        <?php
	        $val = get_post_meta( $post_id, '_min_drop_in_type', true );
	        ?>
            <option
                    value="hours" <?php echo ( $val == 'hours' ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Hours', 'rentit' ); ?></option>
	        <option
                    value="days" <?php echo ( $val == 'days' ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Days', 'rentit' ); ?></option>
        </select>

      </span>
            <span class="description"><?php echo esc_html__( 'into the future', 'rentit' ); ?></span>
        </p>


        <p class="form-field dimensions_field">
            <label for="maximal_rental_block"><?php echo esc_html__( 'Maximum drop in', 'rentit' ); ?></label>
            <span class="wrap">

        <input id="maximal_rental_block" size="6" type="text" placeholder="<?php echo esc_html__( 'Max', 'rentit' ); ?>"
               name="_max_drop_in" value="<?php echo esc_attr( get_post_meta( $post_id, '_max_drop_in', true ) ); ?>"/>

        <select name="_max_drop_in_type" id="max_rental_block_type" class="select short">
	        <?php
	        $val = get_post_meta( $post_id, '_max_drop_in_type', true );
	        ?>
            <option
                    value="hours" <?php echo ( $val == 'hours' ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Hours', 'rentit' ); ?></option>
	        <option
                    value="days" <?php echo ( $val == 'days' ) ? 'selected="selected"' : ''; ?>><?php echo esc_html__( 'Days', 'rentit' ); ?></option>
        </select>

      </span>
            <span class="description"><?php echo esc_html__( 'into the future', 'rentit' ); ?></span>
        </p>


        <div class="rentit-form-tabular">
            <p>
                <strong><?php echo esc_html__( 'Schedule', 'rentit' ); ?></strong>
            </p>
            <div>
                <table class="widefat">
                    <thead>
                    <tr>
                        <th><?php echo esc_html__( 'Day', 'rentit' ); ?></th>
                        <th><?php echo esc_html__( 'Disabled hour (from)', 'rentit' ); ?> <span class="tips"
                                                                                                data-tip="<?php echo esc_html__( 'Leave blank if all hours are available.', 'rentit' ); ?>">[?]</span>
                        </th>
                        <th><?php echo esc_html__( 'Disabled hour (to)', 'rentit' ); ?> <span class="tips"
                                                                                              data-tip="<?php echo esc_html__( 'Leave blank if all hours are available.', 'rentit' ); ?>">[?]</span>
                        </th>
                        <th><?php echo esc_html__( 'Availability', 'rentit' ); ?> <span class="tips"
                                                                                        data-tip="<?php echo esc_html__( 'Selected day will not available.', 'rentit' ); ?>">[?]</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

					<?php

					$days = array(
						'_monday' => esc_html__( 'Monday', 'rentit' ),
						'_tuesday' => esc_html__( 'Tuesday', 'rentit' ),
						'_wednesday' => esc_html__( 'Wednesday', 'rentit' ),
						'_thursday' => esc_html__( 'Thursday', 'rentit' ),
						'_friday' => esc_html__( 'Friday', 'rentit' ),
						'_saturday' => esc_html__( 'Saturday', 'rentit' ),
						'_sunday' => esc_html__( 'Sunday', 'rentit' ),
					);

					foreach ( $days as $key => $value ) {

						$not_available = get_post_meta( $post_id, $key . '_not_available', true );


						?>
                        <tr>
                            <td><?php echo esc_html( $value ); ?></td>
                            <td><input class="has-timepicker start" type="text"
                                       name="<?php echo esc_attr( $key ); ?>_hour_from"
                                       value="<?php echo esc_attr( get_post_meta( $post_id, $key . '_hour_from', true ) ) ?>">
                            </td>
                            <td><input class="has-timepicker end" type="text"
                                       name="<?php echo esc_attr( $key ); ?>_hour_to"
                                       value="<?php echo esc_attr( get_post_meta( $post_id, $key . '_hour_to', true ) ) ?>">
                            </td>
                            <td><input type="checkbox" name="<?php echo esc_attr( $key ); ?>_not_available"
                                       value="yes" <?php echo ( $not_available == 'yes' ) ? 'checked="checked"' : ''; ?>> <?php echo esc_html__( 'Not available', 'rentit' ); ?>
                            </td>
                        </tr>
						<?php
					}

					?>
                    </tbody>
                </table>
            </div>
        </div><!-- /.form-schedule -->


    </div><!-- /.options_group -->

</div><!-- /#rental_availability -->


<div id="rental_location" class="panel woocommerce_options_panel">

    <div class="options_group hide_if_grouped">

        <div class="rentit-form-tabular">

            <div class="car_locations">

                <table class="widefat">
                    <thead>
                    <tr>
                        <th><?php esc_html_e( 'Drop-in location', 'rentit' ); ?></th>
                        <th colspan="2"><?php esc_html_e( 'Drop-off location', 'rentit' ); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>

                        <td width="50%">
                            <p>

								<?php
								$locations_saved = get_post_meta( $post_id, '_rental_dropin_locations2', true );

								?>

                                <select multiple="multiple" class="multiselect wc-enhanced-select"
                                        name="_dropin_locations2[]" style="width: 90%;"
                                        data-placeholder="<?php echo esc_html__( 'Select drop-in location', 'rentit' ); ?>">

									<?php
									$args = array(
										'post_type' => 'rental_location',
										'posts_per_page' => - 1
									);

									$locations = get_posts( $args );

									if ( count( $locations ) > 0 ):
										foreach ( $locations as $location ) {
											$id = $location->ID;
											if ( is_array( $locations_saved ) ) {

												echo '<option value="' . esc_html( get_the_title( $id ) ) . '" ' . selected( in_array( get_the_title( $id ), $locations_saved ), true ) . '>' .
												     esc_html( get_the_title( $id ) ) . '</option>';
											} else {
												echo '<option value="' . esc_html( get_the_title( $id ) ) . '" ' . '>' .
												     esc_html( get_the_title( $id ) ) . '</option>';
											}

										}

									else:
										echo '<option value="">' . esc_html__( 'No locations found.', 'rentit' ) . '</option>';
									endif;

									?>

                                </select>
                            </p>

                            <p class="form-field _dropin_all_locations_field ">
                                <label
                                        for="_dropin_all_locations"><?php echo esc_html__( 'Select all', 'rentit' ); ?></label><input
                                        class="checkbox" style="" name="_dropin_all_locations" id="_dropin_all_locations"
                                        value="yes"
                                        type="checkbox" <?php checked( get_post_meta( $post_id, '_dropin_all_locations', true ), 'yes', true ); ?>>
                            </p>

                        </td>

                        <td width="50%">

							<?php
							$locations_saved = get_post_meta( $post_id, '_rental_dropoff_locations2', true );


							?>

                            <p>
                                <select multiple="multiple" class="multiselect wc-enhanced-select"
                                        name="_dropoff_locations2[]" style="width: 90%;"
                                        data-placeholder="<?php echo esc_html__( 'Select drop-in location', 'rentit' ); ?>">

									<?php
									$args = array(
										'post_type' => 'rental_location',
										'posts_per_page' => - 1
									);

									$locations = get_posts( $args );

									if ( count( $locations ) > 0 ):
										foreach ( $locations as $location ) {
											$id = $location->ID;
											if ( is_array( $locations_saved ) ) {

												echo '<option value="' . esc_html( get_the_title( $id ) ) . '" ' . selected( in_array( get_the_title( $id ), $locations_saved ), true ) . '>' .
												     esc_html( get_the_title( $id ) ) . '</option>';
											} else {
												echo '<option value="' . esc_html( get_the_title( $id ) ) . '" ' . '>' .
												     esc_html( get_the_title( $id ) ) . '</option>';
											}
										}

									else:
										echo '<option value="">' . esc_html__( 'No locations found.', 'rentit' ) . '</option>';
									endif;

									?>

                                </select>
                            </p>

                            <p class="form-field _dropoff_all_locations_field ">
                                <label
                                        for="_dropoff_all_locations"><?php echo esc_html__( 'Select all', 'rentit' ); ?></label><input
                                        class="checkbox" style="" name="_dropoff_all_locations" id="_dropoff_all_locations"
                                        value="yes"
                                        type="checkbox" <?php checked( get_post_meta( $post_id, '_dropoff_all_locations', true ), 'yes', true ); ?>>
                            </p>

                        </td>

                    </tr>

					<?php
					$car_locations = get_post_meta( $post_id, '_car_locations', true );

					if ( $car_locations ) {
						foreach ( $car_locations as $key => $location ) {
							// include( 'html-car-locations.php' );
						}
					}
					?>
                    </tbody>

                </table>

            </div>

        </div><!-- /.rentit-form-tabular -->


        <!--------------------------------- MAP ---------------------------->
        <div class="map_container">
            <div id="canvas2">
                <input id="pac-input" class="controls" type="text"
                       placeholder="<?php esc_html_e( "Enter a location", "rentit" ) ?>">

                <div id="type-selector" class="controls control-group">
                    <label id='edited_Coordinatesaddplaces'>
						<?php esc_html_e( 'Coordinates:', 'rentit' ); ?>
                    </label>
                    <input id="cordinats2" type="text" required name="rentit_lat_long" value="<?php echo
					esc_html( @get_post_meta( (int) $post->ID, 'rentit_lat_long', true ) ); ?>"/>

                    <label id='edited_Addressaddplaces'> <?php esc_html_e( 'Formatted Address',
							'rentit' ); ?></label>
                    <input id="formatted_address" data-geo="formatted_address"
                           name="rentit_formatted_address" type="text" value="<?php echo
					esc_html( @get_post_meta( (int) $post->ID, 'rentit_formatted_address', true ) ); ?>">


                    <input type="hidden" id="location_lon" name="location_lon" value="<?php echo
					esc_html( @get_post_meta( (int) $post->ID, '_location_lon', true ) ); ?>">
                    <input type="hidden" id="location_lat" name="location_lat" value="<?php echo
					esc_html( @get_post_meta( (int) $post->ID, '_location_lat', true ) ); ?>">

                </div>
                <div id="map-canvas"></div>
            </div>
        </div>
		<?php
		$options2 = explode( ',', get_theme_mod( 'Coordinates_map', '35.126413,33.429858999999965' ) );
		$lat = isset( $options2[0] ) ? $options2[0] : "";
		$longu = isset( $options2[1] ) ? $options2[1] : "";

		?>
        <script>
            jQuery(document).ready(function ($) {

                jQuery(document).on("click", '#publish', function (e) {
                    //alert()
                    if (jQuery('#cordinats2').val() == "") {
                        jQuery('#product-type').val('rentit_rental').trigger('click');
                        jQuery('#product-type').trigger('change');
                        jQuery('a[href="#rental_location"]').click();
                        alert('<?php echo esc_html__( 'Please fill coordinates', 'rentit' ); ?>')

                        setTimeout(function () {
                            jQuery("#pac-input").focus();
                        }, 500);


                    }
                });
            });
        </script>
        <script>
            var map;
            function initialize_map_new() {


                if (window.location.protocol != 'http:' && navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;


                            var latlng = jQuery("#cordinats2").val();
                            if (latlng.length > 10) {
                                re = /\s*,\s*/;
                                arr = latlng.split(re);
                                var myLatLng = {lat: parseFloat(arr[0]), lng: parseFloat(arr[1])};
                                latitude = parseFloat(arr[0]);
                                longitude = parseFloat(arr[1]);
                            }


                            var mapOptions = {center: new google.maps.LatLng(latitude, longitude), zoom: 13};
                            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                            if (latlng.length > 10) {

                                var marker2 = new google.maps.Marker({
                                    position: myLatLng,
                                    map: map,
                                    title: 'Hello World!'
                                });
                            }
                            var input = (document.getElementById("pac-input"));
                            var types = document.getElementById("type-selector");
                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                            var autocomplete = new google.maps.places.Autocomplete(input);
                            autocomplete.bindTo("bounds", map);
                            var infowindow = new google.maps.InfoWindow();
                            var marker = new google.maps.Marker({
                                map: map,
                                draggable: true,
                                anchorPoint: new google.maps.Point(0, -29)
                            });

                            google.maps.event.addListener(autocomplete, "place_changed",
                                function () {
                                    infowindow.close();
                                    marker.setVisible(false);
                                    var place = autocomplete.getPlace();
                                    console.log(place);
                                    if (!place.geometry) {
                                        return;
                                    }


                                    if (place.geometry.viewport) {
                                        map.fitBounds(place.geometry.viewport);
                                    } else {
                                        map.setCenter(place.geometry.location);
                                        map.setZoom(17);
                                    }

                                    marker.setIcon(({
                                        url: place.icon,
                                        size: new google.maps.Size(71, 71),
                                        origin: new google.maps.Point(0, 0),
                                        anchor: new google.maps.Point(17, 34),
                                        scaledSize: new google.maps.Size(35, 35)
                                    }));
                                    marker.setPosition(place.geometry.location);
                                    marker.setVisible(true);

                                    jQuery("#location_lon").val(place.geometry.location.lng());
                                    jQuery("#location_lat").val(place.geometry.location.lat());

                                    var crtt = place.geometry.location.lat() + "," + place.geometry.location.lng();
                                    var foradre = place.formatted_address;
                                    jQuery("#cordinats2").val(crtt);
                                    jQuery("#cordinats2").trigger("change");
                                    jQuery("#formatted_address").val(foradre);

                                    var address = "";
                                    if (place.address_components) {
                                        address = [(place.address_components[0] && place.address_components[0].short_name || ""), (place.address_components[1] && place.address_components[1].short_name || ""), (place.address_components[2] && place.address_components[2].short_name || "")].join(" ");
                                    }
                                    infowindow.setContent("<div><strong>" + place.name + "</strong><br>" + address);
                                    infowindow.open(map, marker);
                                }
                            );
                            /*************************/

                            google.maps.event.addListener(marker, "drag", function () {
                                jQuery.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + marker.getPosition().lat() + "," + marker.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {
                                    var adress1 = data.results[0].formatted_address;
                                    infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                                    jQuery("#formatted_address").val(adress1);
                                    jQuery("#location_lon").val(marker.getPosition().lng());
                                    jQuery("#location_lat").val(marker.getPosition().lat());

                                    jQuery("#cordinats2").val(marker.getPosition().lat() + "," + marker.getPosition().lng());

                                });
                                infowindow.open(map, marker);
                            });
                            function setupClickListener(id, types) {
                                var radioButton = document.getElementById(id);
                                google.maps.event.addDomListener(radioButton, "click", function () {
                                    autocomplete.setTypes(types);
                                });
                            }

                            setupClickListener("changetype-all", []);
                            setupClickListener("changetype-address", ["address"]);
                            setupClickListener("changetype-establishment", ["establishment"]);
                            setupClickListener("changetype-geocode", ["geocode"]);

                            /****************************/


                        }
                    )
                    ;

                }
                else {


                    var latitude = <?php echo $lat; ?>;
                    var longitude = <?php echo $longu; ?>;


                    var latlng = jQuery("#cordinats2").val();
                    if (latlng != undefined && latlng.length > 10) {
                        re = /\s*,\s*/;
                        arr = latlng.split(re);
                        var myLatLng = {lat: parseFloat(arr[0]), lng: parseFloat(arr[1])};
                        latitude = parseFloat(arr[0]);
                        longitude = parseFloat(arr[1]);
                    }


                    var mapOptions = {center: new google.maps.LatLng(latitude, longitude), zoom: 13};
                    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                    if (latlng != undefined && latlng.length > 10) {

                        var marker2 = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            draggable: true,
                            title: ''
                        });

                        google.maps.event.addListener(marker2, "drag", function () {
                            jQuery.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + marker2.getPosition().lat() + "," + marker2.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {
                                var adress1 = data.results[0].formatted_address;
                                infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                                jQuery("#formatted_address").val(adress1);
                                jQuery("#location_lon").val(marker2.getPosition().lng());
                                jQuery("#location_lat").val(marker2.getPosition().lat());

                                jQuery("#cordinats2").val(marker2.getPosition().lat() + "," + marker2.getPosition().lng());

                            });
                            infowindow.open(map, marker);
                        });
                    }
                    var input = (document.getElementById("pac-input"));
                    var types = document.getElementById("type-selector");
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo("bounds", map);
                    var infowindow = new google.maps.InfoWindow();
                    var marker = new google.maps.Marker({
                        map: map,
                        draggable: true,
                        anchorPoint: new google.maps.Point(0, -29)
                    });


                    google.maps.event.addListener(autocomplete, "place_changed",
                        function () {

                            infowindow.close();
                            marker.setVisible(false);
                            var place = autocomplete.getPlace();
                            console.log(place);
                            if (!place.geometry) {
                                return;
                            }


                            if (place.geometry.viewport) {
                                map.fitBounds(place.geometry.viewport);
                            } else {
                                map.setCenter(place.geometry.location);
                                map.setZoom(17);
                            }

                            marker.setIcon(({
                                url: place.icon,
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(35, 35)
                            }));
                            marker.setPosition(place.geometry.location);
                            marker.setVisible(true);

                            jQuery("#location_lon").val(place.geometry.location.lng());
                            jQuery("#location_lat").val(place.geometry.location.lat());

                            var crtt = place.geometry.location.lat() + "," + place.geometry.location.lng();
                            var foradre = place.formatted_address;
                            jQuery("#cordinats2").val(crtt);
                            jQuery("#cordinats2").trigger("change");
                            jQuery("#formatted_address").val(foradre);

                            var address = "";
                            if (place.address_components) {
                                address = [(place.address_components[0] && place.address_components[0].short_name || ""), (place.address_components[1] && place.address_components[1].short_name || ""), (place.address_components[2] && place.address_components[2].short_name || "")].join(" ");
                            }
                            infowindow.setContent("<div><strong>" + place.name + "</strong><br>" + address);
                            infowindow.open(map, marker);
                        }
                    );
                    /*************************/

                    google.maps.event.addListener(marker, "drag", function () {
                        jQuery.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + marker.getPosition().lat() + "," + marker.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {
                            var adress1 = data.results[0].formatted_address;
                            infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                            jQuery("#formatted_address").val(adress1);
                            jQuery("#location_lon").val(marker.getPosition().lng());
                            jQuery("#location_lat").val(marker.getPosition().lat());

                            jQuery("#cordinats2").val(marker.getPosition().lat() + "," + marker.getPosition().lng());

                        });
                        infowindow.open(map, marker);
                    });


                    function setupClickListener(id, types) {
                        var radioButton = document.getElementById(id);
                        google.maps.event.addDomListener(radioButton, "click", function () {
                            autocomplete.setTypes(types);
                        });
                    }

                    //setupClickListener("changetype-all", []);
                    /* setupClickListener("changetype-address", ["address"]);
					 setupClickListener("changetype-establishment", ["establishment"]);
					 setupClickListener("changetype-geocode", ["geocode"]);*/

                    /****************************/


                }


            }

            function initialize_map() {
                var triger = false;

                jQuery("a[href='#rental_location']").click(function () {
                    if (triger == false) {
                        initialize_map_new();
                        triger = true;
                    }

                });

            }
        </script>
        <!------------------------------------------------------------------>


    </div><!-- /.options_group -->

</div><!-- /#rental_location -->


<div id="rental_cost_and_resources" class="panel woocommerce_options_panel">

    <div class="">
		<?php
			
		/*MYEDIT>*/
		if(function_exists('RentIt_Get_Sys_Cars_show_options')){
			RentIt_Get_Sys_Cars_show_options();
		}
		/*<MYEDIT*/
		// Base cost
		woocommerce_wp_text_input(
			array(
				'id' => '_base_cost',
				'label' => esc_html__( 'Base Cost for 1 / day', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',
				'data_type' => 'price',
				'desc_tip' => 'true',
				'wrapper_class' => 'requre',
				'description' => esc_html__( 'Will be applied regardless of the customer\'s choices on the booking form.', 'rentit' )
			)
		);
		woocommerce_wp_text_input(
			array(
				'id' => '_sale_cost',
				'label' => esc_html__( 'Sale Price for 1 / day', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',
				'data_type' => 'price',
				'desc_tip' => 'true',
				'description' => esc_html__( 'Sale Price choices on the booking form.', 'rentit' )
			)
		);
		/*
			woocommerce_wp_select(
				array(
					'id' => '_cost_type',
					'label' => esc_html__('Select type Cost default day', "rentit") . ' (' . get_woocommerce_currency_symbol() . ')',
					'data_type' => 'select',
					'desc_tip' => 'true',
					'options' => array(
						'day' => esc_html__('day','rentit'),
						'hour' =>  esc_html__('hour','rentit'),

					),

					'description' => esc_html__('Will be applied regardless of the customer\'s choices on the booking form.', 'rentit')
				)
			);*/
		woocommerce_wp_text_input(
			array(
				'id' => '_rentit_subtitle',
				'label' => esc_html__( 'Subtitle', "rentit" ),
				'data_type' => 'text',
				'desc_tip' => 'true',
				'description' => esc_html__( 'subtitle', 'rentit' )
			)
		);
		$disable = get_post_meta( $post_id, '_rentit_disable_rent', 1 );

		?>
        <p class="form-field _manage_stock_field show_if_simple show_if_variable" style="display: none;"><label
                    for="_rentit_disable_rent"><?php esc_html_e( 'Disable rent', 'rentit' ); ?> </label>
            <input type="checkbox" class="checkbox" <?php echo checked( 'yes', $disable ); ?> style=""
                   name="_rentit_disable_rent" id="_rentit_disable_rent" value="yes">
            <span class="description"><?php esc_html_e( 'Disable rent system for sale car?', 'rentit' ); ?></span></p>


		<?php

		woocommerce_wp_text_input(
			array(
				'id' => '_rentit_deposit_percent',
				'label' => esc_html__( 'Deposit percent %', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',

				'desc_tip' => 'true',
				'wrapper_class' => '',
				'description' => esc_html__( 'Will be applied regardless of the customer\'s choices on the booking form.', 'rentit' )
			)
		);


		woocommerce_wp_text_input(
			array(
				'id' => '_rentit_weekend_price',
				'label' => esc_html__( 'Weekend price per day', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',
				'desc_tip' => 'true',
				'wrapper_class' => '_rentit_weekend_price',
				'description' => esc_html__( 'put number  (for example 35)', 'rentit' )
			)
		);
		?>
        <br>
        <br>

		<?php



		woocommerce_wp_text_input(
			array(
				'id' => '_base_cost_winter',
				'label' => esc_html__( 'Winter Cost ', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',

				'desc_tip' => 'true',
				'wrapper_class' => 'rentit_custom_price_g',
				'description' => esc_html__( 'put number from 1 to 100  (for example 35)', 'rentit' )
			)
		);

		woocommerce_wp_text_input(
			array(
				'id' => '_base_cost_spring',
				'label' => esc_html__( 'Spring Cost ', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',
				'data_type' => 'price',
				'desc_tip' => 'true',
				'wrapper_class' => 'rentit_custom_price_g',
				'description' => esc_html__( 'Will be applied regardless of the customer\'s choices on the booking form.', 'rentit' )
			)
		);


		woocommerce_wp_text_input(
			array(
				'id' => '_base_cost_summer',
				'label' => esc_html__( 'Summer Cost', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',
				'data_type' => 'price',
				'desc_tip' => 'text',
				'wrapper_class' => 'rentit_custom_price_g',
				'description' => esc_html__( 'Will be applied regardless of the customer\'s choices on the booking form.', 'rentit' )
			)
		);

		woocommerce_wp_text_input(
			array(
				'id' => '_base_cost_autumn',
				'label' => esc_html__( 'Autumn Cost', "rentit" ) . ' (' . get_woocommerce_currency_symbol() . ')',
				'data_type' => 'price',
				'desc_tip' => 'true',
				'wrapper_class' => 'rentit_custom_price_g',
				'description' => esc_html__( 'Will be applied regardless of the customer\'s choices on the booking form.', 'rentit' )
			)
		);


		?>

    </div>
    <div class="rentit-form-tabular">

        <hr>
        <div class="rental-unavailable-date custom_season_price">

            <p>
                <strong><h3><?php esc_html_e( 'Season price', 'rentit' ); ?></h3></strong><br>
                <span>
					<?php esc_html_e( 'please insert base day price for custom season date', 'rentit' ); ?>
				</span>
            </p>
            <table class="widefat">
                <thead>

                <tr>
                    <th><?php echo esc_html__( 'Base price', 'rentit' ) . ' ' . get_woocommerce_currency_symbol(); ?></th>
                    <th><?php echo esc_html__( 'Start season date', 'rentit' ) ?></th>
                    <th><?php esc_html_e( 'End season date', 'rentit' ); ?></th>
                    <th><?php esc_html_e( 'Discounts', 'rentit' ); ?></th>
                </tr>
                </thead>
                <tbody class="tbody_season">
				<?php

				$season_date = get_post_meta( $post_id, '_rental_season_date', true );
				$j = 0;



				if ( $season_date ) {
					foreach ( $season_date as $key => $unavailable ) {
						include( 'html-season-date.php' );
						$j++;
					}

				}
				?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <a href="#" class="button insert_season_date" data-row="<?php
						$file = array(
							'file' => '',
							'name' => ''
						);
						ob_start();
						include( 'html-season-date-blank.php' );
						echo esc_attr( ob_get_clean() );
						?>"><?php esc_html_e( 'Add season date
', 'rentit' ); ?></a>
                    </th>
                </tr>
                </tfoot>
            </table>

        </div>

        <div class="rental-charge-location">

            <hr>
            <h3><?php esc_html_e( 'Charge locations', 'rentit' ); ?></h3><br>


			<?php
			$charge_locations = get_post_meta( $post_id, '_rental_charge_locations', true );

			// var_dump($charge_locations);
			?>
            <table class="widefat">
                <thead>

                <tr>

                    <th><?php echo esc_html__('start locations', 'rentit' ) ?></th>
                    <th><?php esc_html_e( 'End location', 'rentit' ); ?></th>
                    <th><?php esc_html_e( 'days to free', 'rentit' ); ?></th>
                    <th><?php esc_html_e( 'Cost ' . "(" . get_woocommerce_currency_symbol() . ')', 'rentit' ); ?></th>

                </tr>
                </thead>
                <tbody>
				<?php
				$j =0;
				if ( $charge_locations ) {
					foreach ( $charge_locations as $key => $charge_location ) {


						include( 'html-charge_locations.php' );
						$j++;
					}
				}
				?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <a href="#" class="button insert_charge_locations" data-row="<?php
						$file = array(
							'file' => '',
							'name' => ''
						);
						ob_start();
						include( 'html-charge_locations-blank.php' );
						echo esc_attr( ob_get_clean() );
						?>"><?php esc_html_e( 'Add items', 'rentit' ); ?></a>
                    </th>
                </tr>
                </tfoot>
            </table>


        </div>
        <hr>
        <div class="rental-unavailable-date">


            <p>
                <strong><?php esc_html_e( 'Unavailable date', 'rentit' ); ?></strong><br>
            </p>
            <table class="widefat">
                <thead>

                <tr>

                    <th><?php echo esc_html( 'Start unavailable date', 'rentit' ) ?></th>
                    <th><?php esc_html_e( 'End unavailable date', 'rentit' ); ?></th>

                </tr>
                </thead>
                <tbody>
				<?php

				$resources = get_post_meta( $post_id, '_rental_unavailable_date', true );

				if ( $resources ) {
					foreach ( $resources as $key => $unavailable ) {
						include( 'html-unavailable_date.php' );
					}
				}
				?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <a href="#" class="button insert" data-row="<?php
						$file = array(
							'file' => '',
							'name' => ''
						);
						ob_start();
						include( 'html-unavailable_date_blank.php' );
						echo esc_attr( ob_get_clean() );
						?>"><?php esc_html_e( 'Add unavailable date
', 'rentit' ); ?></a>
                    </th>
                </tr>
                </tfoot>
            </table>


        </div>
        <hr>


        <div class="rental-discounts"><p>


                <strong><?php esc_html_e( 'Discounts', 'rentit' ); ?></strong><br>
				<?php esc_html_e( 'Example – Segway rental  1 Hour=$30, 3 Hours=$48.                 
                (for this select in Cost $30  in  Duration 1 / Hours(s) and Cost $16  Duration 3 / Hours(s)', 'rentit' ); ?>

            </p>
            <table class="widefat">
                <thead>

                <tr>

                    <th><?php echo esc_html__( 'Cost (' . get_woocommerce_currency_symbol() . ')' ) ?></th>
                    <th><?php esc_html_e( 'Duration', 'rentit' ); ?></th>

                </tr>
                </thead>
                <tbody>
				<?php

				$resources = get_post_meta( $post_id, '_rental_discounts', true );


				if ( $resources ) {
					foreach ( $resources as $key => $discounts ) {
						include( 'html-discounts.php' );
					}
				}
				?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <a href="#" class="button insert" data-row="<?php
						$file = array(
							'file' => '',
							'name' => ''
						);
						ob_start();
						include( 'html-discounts-blank.php' );
						echo esc_attr( ob_get_clean() );
						?>"><?php esc_html_e( 'Add discounts', 'rentit' ); ?></a>
                    </th>
                </tr>
                </tfoot>
            </table>


        </div>
			<?php
			
		/*MYEDIT>*/
		if(function_exists('RentIt_Percentage_Discount_show_options')){
			RentIt_Percentage_Discount_show_options();
		}
		/*<MYEDIT*/

		?>
        <p>
            <strong><?php

				echo esc_html__( 'Resources', 'rentit' ); ?></strong>
        </p>

        <p class="form-field">
            <!---
			<label for="bulk-resources-select"><?php echo esc_html__( 'Bulk Resources', 'rentit' ); ?></label>

			<?php
			$bulk_resources_saved = get_post_meta( $post_id, '_rental_bulk_resources', true );
			?>

			<select multiple="multiple" class="multiselect wc-enhanced-select" name="_bulk_resources[]"
			        style="width: 50%;" data-placeholder="<?php echo esc_html__( 'Select resources', 'rentit' ); ?>">
				<?php

			$args = array(
				'post_type' => 'rental_resource',
				'posts_per_page' => - 1
			);

			$bulk_resources = get_posts( $args );

			if ( count( $bulk_resources ) > 0 ):
				foreach ( $bulk_resources as $resource ) {
					$id = $resource->ID;
					$cost = get_post_meta( $id, '_rental_resource_cost', true );
					$duration = get_post_meta( $id, '_rental_resource_duration', true );
					$timeframe = get_post_meta( $id, '_rental_resource_timeframe_type', true );
					$is_flat_cost = get_post_meta( $id, '_rental_resource_is_flat_cost', true );

					if ( $is_flat_cost == 'yes' ) {
						$note = get_woocommerce_currency_symbol() . ' ' . $cost . ' (' . esc_html__( 'Flat cost', 'rentit' ) . ') ';
					} else {
						$note = get_woocommerce_currency_symbol() . ' ' . $cost . ' (' . esc_html__( 'per ', 'rentit' ) . $timeframe . ')';
					}

					echo '<option value="' . esc_attr( $id ) . '" ' . selected( in_array( $id, $bulk_resources_saved ), true ) . '>' . esc_html( get_the_title( $id ) ) . ' - ' . esc_html( $note ) . '</option>';
				}

			else:
				echo '<option value="">' . esc_html__( 'No resources found.', 'rentit' ) . '</option>';
			endif;


			?>

			</select>
--->
        </p>
        <hr>
        <p>
            <strong><?php esc_html_e( 'Select Resources', 'rentit' ); ?></strong><br>


        </p>

        <div class="rental-resources">
            <table class="widefat">
                <thead>
                <tr>
                    <th><?php esc_html_e( 'Item name', 'rentit' ); ?></th>
                    <th><?php esc_html_e( 'Quantity', 'rentit' ); ?></th>
                    <th><?php echo esc_html( 'Cost (' . get_woocommerce_currency_symbol() . ')' ) ?></th>
                    <th><?php esc_html_e( 'Duration', 'rentit' ); ?></th>
                    <th colspan="2"><?php esc_html_e( 'Flat cost?', 'rentit' ) ?> <span class="tips"
                                                                                        data-tip="<?php echo esc_html__( 'Single cost with no duration applied.', 'rentit' ); ?>">[?]</span>
                    </th>
                </tr>
                </thead>
                <tbody>
				<?php

				$resources = get_post_meta( $post_id, '_rental_resources', true );

				if ( $resources ) {
					foreach ( $resources as $key => $resource ) {
						include( 'html-resources.php' );
					}
				}
				?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <a href="#" class="button insert" data-row="<?php
						$file = array(
							'file' => '',
							'name' => ''
						);
						ob_start();
						include( 'html-resources-blank.php' );
						echo esc_attr( ob_get_clean() );
						?>"><?php esc_html_e( 'Add Resources', 'rentit' ); ?></a>
                    </th>
                </tr>
                </tfoot>
            </table>

            <hr>
            <p class="form-field _base_cost_field ">
                <label for="_car_year"><i class="fa fa-car"></i>
					<?php esc_html_e( 'Car year', 'rentit' ); ?>
                </label>
                <input type="text" class="short" name="_rental_car_year"
                       id="_car_year"
                       value="<?php echo esc_html( get_post_meta( $post_id, '_rental_car_year', true ) ? get_post_meta( $post_id, '_rental_car_year', true ) : "2015" ); ?>"
                       placeholder="<?php esc_html_e( '2015', 'rentit' ); ?>">
            </p>

            <p class="form-field _base_cost_field ">
                <label for="_car_engine"><i class="fa fa-dashboard"></i>
					<?php esc_html_e( 'Car engine', 'rentit' ); ?>
                </label>
                <input type="text" class="short" name="_rental_car_engine"
                       id="_car_engine"
                       value="<?php echo esc_html( get_post_meta( $post_id, '_rental_car_engine', true ) ? get_post_meta( $post_id, '_rental_car_engine', true ) : esc_html__( "Diesel", "rentit" ) ); ?>"
                       placeholder="<?php esc_html_e( 'Diesel', 'rentit' ); ?>">
            </p>

            <p class="form-field _base_cost_field ">
                <label for="_car_transmission"><i class="fa fa-cog"></i>
					<?php esc_html_e( 'Car Transmission', 'rentit' ); ?>
                </label>
                <input type="text" class="short" name="_rental_car_transmission"
                       id="_car_transmission"
                       value="<?php echo esc_html( get_post_meta( $post_id, '_rental_car_transmission', true ) ? get_post_meta( $post_id, '_rental_car_transmission', true ) : esc_html__( "Auto", "rentit" ) ); ?>"

            </p>
            <p class="form-field _base_cost_field ">
                <label for="_car_mileage"><i class="fa fa-road"></i>
					<?php esc_html_e( 'Car Mileage', 'rentit' ); ?>
                </label>
                <input type="text" class="short" name="_rental_car_mileage"
                       id="_car_mileage" placeholder="<?php esc_html_e( '25000', 'rentit' ); ?>"
                       value="<?php echo esc_html( get_post_meta( $post_id, '_rental_car_mileage', true ) ? get_post_meta( $post_id, '_rental_car_mileage', true ) : "25000" ); ?>"

                >
            </p>


            <p class="form-field _base_cost_field ">
                <label for="_rental_car_stars"><i class="fa fa-star"></i>
					<?php esc_html_e( 'Car stars', 'rentit' );
					$rentit_stars = get_post_meta( $post_id, '_rental_car_stars', true ) ? get_post_meta( $post_id, '_rental_car_stars', true ) : 5;


					?>


                </label>
                <select id="_rental_car_stars" class="short" name="_rental_car_stars">
                    <option <?php selected( $rentit_stars, 1 ); ?> value="1">1</option>
                    <option <?php selected( $rentit_stars, 2 ); ?> value="2">2</option>
                    <option <?php selected( $rentit_stars, 3 ); ?> value="3">3</option>
                    <option <?php selected( $rentit_stars, 4 ); ?> value="4">4</option>
                    <option <?php selected( $rentit_stars, 5 ); ?> value="5">5</option>

                </select>
            </p>


        </div>
        <hr>
        <table class="widefat">
            <thead>

            <tr>
                <th><?php esc_html_e( 'Min rent date', 'rentit' ); ?></th>
                <th><?php esc_html_e( 'Max rent date', 'rentit' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="duration" width="49%">
    <span class="wrap">
      <input name="_rental_min_date_day"
             value="<?php $rental_min_date_day = get_post_meta( $post_id, '_rental_min_date_day', true );
             if ( $rental_min_date_day != false ) {
	             echo esc_html( $rental_min_date_day );
             } ?>" placeholder="">


    </span>
                </td>
                <td class="duration" width="49%">
    <span class="wrap">
     <input type="text"
            name="_rental_max_date_day"
            value="<?php $_rental_max_date_day = get_post_meta( $post_id, '_rental_max_date_day', true );
            if ( $_rental_max_date_day != false ) {
	            echo esc_html( $_rental_max_date_day );
            } ?>">

    </span>
                </td>
                <td width="1%"><?php esc_html_e( 'Days', 'rentit' ); ?></td>

            </tr>

            <tr>
                <td class="duration" width="49%">
    <span class="wrap">
      <input name="_rental_min_date_hours"
             value="<?php $_rental_min_date_hours = get_post_meta( $post_id, '_rental_min_date_hours', true );
             if ( $_rental_min_date_hours != false ) {
	             echo esc_html( $_rental_min_date_hours );
             } ?>">


    </span>
                </td>
                <td class="duration" width="49%">
    <span class="wrap">
     <input type="text"
            name="_rental_max_date_hours"
            value="<?php $_rental_max_date_hours = get_post_meta( $post_id, '_rental_max_date_hours', true );
            if ( $_rental_max_date_hours != false ) {
	            echo esc_html( $_rental_max_date_hours );
            } ?>">

    </span>
                </td>
                <td width="1%"><?php esc_html_e( 'Hours', 'rentit' ); ?></td>

            </tr>
            </tbody>
            <tfoot>
            <tr>

            </tr>
            </tfoot>
        </table>


    </div>


</div><!-- /#rental_cost_and_resources -->
