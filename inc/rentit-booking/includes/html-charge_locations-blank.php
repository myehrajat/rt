<?php
global $j;
 $charge_location = null;
if ( !$j ) {
	$j = 0;
}



?>

<tr class="tbody_charge_locations_tr">

    <td class="cost" width="11%">
		<?php

		$locations_saved = $charge_location['drop-in'];

		?>

        <select multiple="multiple" class="multiselect wc-enhanced-select drop-in"
                name="_rental_charge_locations[<?php echo esc_attr( $j ); ?>][drop-in][]" style="width: 90%;"
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

    </td>
    <td class="duration" width="15%">

		<?php
		$locations_saved_2 = isset($charge_location['drop-off']) ? $charge_location['drop-off'] : ''


		?>


        <select multiple="multiple" class="multiselect wc-enhanced-select drop-off"
                name="_rental_charge_locations[<?php echo esc_attr( $j ); ?>][drop-off][]" style="width: 90%;"
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
					if ( is_array( $locations_saved_2 ) ) {

						echo '<option value="' . esc_html( get_the_title( $id ) ) . '" ' . selected( in_array( get_the_title( $id ), $locations_saved_2 ), true ) . '>' .
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

    </td>
    <td class="duration" width="15%">
        <input type="text" class="input_text days"
               placeholder="days" name="_rental_charge_locations[<?php echo esc_attr( $j ); ?>][days][]" value="<?php
		if(isset($charge_location['days'])) echo ($charge_location['days'][0]); ?>">

    </td>
    <td class="duration" width="5%">
        <input style="width: 100%" type="text" class="input_text cost" placeholder="cost" name="_rental_charge_locations[<?php echo esc_attr( $j ); ?>][cost][]"
               value="<?php
		       if(isset($charge_location['cost'])) echo ($charge_location['cost'][0]); ?>">

    </td>
    <td width="1%"><a href="#" class="delete">x</a></td>


</tr>