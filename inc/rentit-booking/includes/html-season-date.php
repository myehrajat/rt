<tr class="tbody_season_tr">
	<?php global $j;
	if ( !$j ) {
		$j = 0;
	}

	?>
    <td class="duration" width="6%" style="max-width: 25px;">
      <span class="wrap">
      <input style="max-width: 50px;"
             name="_rental_season_price[]"
             value="<?php echo esc_html( $unavailable['price'] ); ?>">
      </span>
    </td>
    <td class="duration" style="max-width: 185px;">
      <span class="wrap">
      <input style="width: 100%;" data-id="rentit_season_startdate<?php echo esc_attr( $j ); ?>"
             class="rentit_startdate rentit_startdate<?php echo esc_attr( $j ); ?>"
             name="_rental_season_start_date[]"
             value="<?php echo esc_html( $unavailable['start_date'] ); ?>">
      </span>
    </td>
    <td class="duration" style="max-width: 185px;" width="20%">
      <span class="wrap">
      <input style="width: 100%;" type="text" data-id="rentit_season_enddate<?php echo esc_attr( $j ); ?>"
             class="rentit_enddate rentit_enddate<?php echo esc_attr( $j ); ?>" name="_rental_season_end_date[]"
             value="<?php if ( isset( $unavailable['end_date'] ) ) {
	             echo esc_html( $unavailable['end_date'] );
             } ?>">
      </span>
    </td>
    <!---------------------------------->
    <td class="cost">
        <form action="#">
            <table class="widefat t_season_discounts">
                <thead>
                <tr>
                    <th><?php esc_html_e('Cost', 'rentit'); ?></th>
                    <th><?php esc_html_e('Duration', 'rentit'); ?></th>
                </tr>
                </thead>
                <tbody>
				<?php


                if ( isset($unavailable['rental_season_discount']) ) {
					for ( $k = 0; $k < count( $unavailable['rental_season_discount']['cost'] ); $k ++ ) {


						?>
                        <tr class="t_season__it">
                            <td class="cost">
                                <input type="text" class="input_text cost" placeholder="Cost"
                                       name="_rental_season_discount[<?php echo esc_attr( $j ); ?>][cost][]"
                                       value="<?php if ( isset( $unavailable['rental_season_discount']['cost'][$k] ) ) {
									       echo esc_html( $unavailable['rental_season_discount']['cost'][$k] );
								       } ?>">
                            </td>
                            <td class="duration">

                               <span class="wrap">
                                    <input data-cloudzoom="duration_val" type="text"
                                           class="input_text short duration_val"
                                           placeholder=""
                                           name="_rental_season_discount[<?php echo esc_attr( $j ); ?>][duration_val][]"
                                           value="<?php if ( isset( $unavailable['rental_season_discount']['duration_val'][$k] ) ) {
	                                           echo esc_html( $unavailable['rental_season_discount']['duration_val'][$k] );
                                           } ?>">
                                  <select class="short duration_type"
                                          name="_rental_season_discount[<?php echo esc_attr( $j ); ?>][duration_type][]">
                                        <option
                                                value="hours" <?php  if(isset($unavailable['rental_season_discount']['duration_type'][$k])) echo  ( $unavailable['rental_season_discount']['duration_type'][$k] == 'hours' ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Hour(s)', 'rentit' ); ?></option>
                                        <option
                                                value="days" <?php  if(isset($unavailable['rental_season_discount']['duration_type'][$k]))  echo ( $unavailable['rental_season_discount']['duration_type'][$k] == 'days' ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Day(s)', 'rentit' ); ?></option>
                                    </select>
                                 </span>

                            </td>
                            <td width="1%"><a href="#" class="delete"><?php esc_html_e( 'x', 'rentit' ); ?></a></td>
                        </tr>
					<?php }
				} ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <a href="#" class="button insert_season_discounts" data-row="<?php
						$file = array(
							'file' => '',
							'name' => ''
						);
						ob_start();
						include( 'html-sesonal-discounts-blank.php' );
						echo esc_attr( ob_get_clean() );
						?>"><?php esc_html_e( 'Add discounts', 'rentit' ); ?></a>
                    </th>
                </tr>
                </tfoot>
            </table>
    </td>
    <td width="1%"><a href="#" class="delete"><?php esc_html_e( 'x', 'rentit' ); ?></a></td>
</tr>