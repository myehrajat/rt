<tr class="t_season__it">
    <td class="cost">
        <input type="text" class="input_text cost " placeholder="<?php esc_html_e('Cost', 'rentit'); ?>"
               name="_rental_season_discount[0][cost][]" value="">
    </td>
    <td class="duration">
                  <span class="wrap">
                     <input type="text" class="input_text short duration_val" placeholder="" name="_rental_season_discount[0][duration_val][]"
                            value="">

                     <select class="short duration_type" name="_rental_season_discount[0][duration_type][]">
                       <option value="hours"><?php esc_html_e('Hour(s)', 'rentit'); ?></option>
          <option value="days"><?php esc_html_e('Day(s)', 'rentit'); ?></option>

                     </select>
                  </span>
    </td>
    <td width="1%"><a href="#" class="delete"><?php esc_html_e('x', 'rentit'); ?></a></td>
</tr>