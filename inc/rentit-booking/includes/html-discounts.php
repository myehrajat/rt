<tr>
    
    <td class="cost" width="11%">
        <input type="text" class="input_text" placeholder="<?php esc_html_e('Cost', 'rentit'); ?>"
               name="_rental_discount_cost[]" value="<?php echo esc_attr($discounts['cost']); ?>"/>
    </td>
    <td class="duration" width="26%">
    <span class="wrap">
      <input type="text" class="input_text short" placeholder="<?php esc_html_e('', 'rentit'); ?>"
             name="_rental_discount_duration_val[]" value="<?php echo esc_attr($discounts['duration_val']); ?>"/>
      <select class="short" name="_rental_discount_duration_type[]">
          <option
              value="hours" <?php echo ($discounts['duration_type'] == 'hours') ? 'selected="selected"' : ''; ?>><?php esc_html_e('Hour(s)', 'rentit'); ?></option>
          <option
              value="days" <?php echo ($discounts['duration_type'] == 'days') ? 'selected="selected"' : ''; ?>><?php esc_html_e('Day(s)', 'rentit'); ?></option>

      </select>
    </span>
    </td>

    <td width="1%"><a href="#" class="delete"><?php esc_html_e('x', 'rentit'); ?></a></td>

    
</tr>
