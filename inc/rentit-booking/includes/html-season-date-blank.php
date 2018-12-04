<tr class="tbody_season_tr">
	<?php global $j; ?>
	<td class="duration" width="6%" style="max-width: 25px;">

    <span class="wrap">
      <input
	      name="_rental_season_price[]"
	      value="">

    </span>
	</td>
	<td class="duration" style="max-width: 185px;">

    <span class="wrap">
      <input data-id="rentit_season_startdate<?php echo esc_attr($j); ?>"
             class="rentit_startdate rentit_startdate<?php echo esc_attr($j); ?>"
             name="_rental_season_start_date[]"
             value="">

    </span>
	</td>


	<td class="duration" style="max-width: 185px;" width="20%">
    <span class="wrap">
     <input style="width: 100%;"  type="text" data-id="rentit_season_enddate<?php echo esc_attr($j); ?>"
            class="rentit_enddate rentit_enddate<?php echo esc_attr($j); ?>" name="_rental_season_end_date[]"
            value="">

    </span>
	</td>

        <!----------------------------->
    <td class="cost">

        <table class="widefat t_season_discounts">
            <thead>
            <tr>
                <th><?php esc_html_e('Cost', 'rentit'); ?></th>
                <th><?php esc_html_e('Duration', 'rentit'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr class="t_season__it">
                <td class="cost">
                    <input type="text" class="input_text cost rentit_startdate_m12" placeholder="Cost" name="_rental_season_discount[1][cost][]" value="">
                </td>
                <td class="duration">

                               <span class="wrap">
                                    <input data-cloudzoom="duration_val" type="text" class="input_text short duration_val rentit_startdate_m13" placeholder="" name="_rental_season_discount[1][duration_val][]" value="">
                                  <select class="short duration_type" name="_rental_season_discount[1][duration_type][]">
                                        <option value="hours"><?php esc_html_e('Hour(s)', 'rentit'); ?></option>
                                        <option value="days" selected="selected">
                                            <?php esc_html_e('Day(s)', 'rentit'); ?>
                                            </option>
                                    </select>
                                 </span>

                </td>
                <td width="1%"><a href="#" class="delete"><?php esc_html_e( 'x', 'rentit' ); ?></a></td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <th colspan="6">
                    <a href="#" class="button insert_season_discounts" data-row='<?php
		            $file = array(
			            'file' => '',
			            'name' => ''
		            );
		            ob_start();
		            include( 'html-sesonal-discounts-blank.php' );
		            echo esc_attr( ob_get_clean() );
		            ?>'><?php esc_html_e( 'Add discounts', 'rentit' ); ?></a>
                </th>
            </tr>
            </tfoot>
        </table>
    </td>
        <!------------->
	<td width="1%"><a href="#" class="delete"><?php esc_html_e('x', 'rentit'); ?></a></td>

</tr>



