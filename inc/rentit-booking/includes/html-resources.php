<tr>

  <td class="item_name" width="40%">
    <input type="text" class="input_text" placeholder="<?php  esc_html_e( 'Item name', 'rentit' ); ?>" name="_rental_resource_item_name[]" value="<?php echo esc_attr( $resource['item_name'] ); ?>" />
  </td>
  <td class="quantity" width="11%">
    <input type="text" class="input_text" placeholder="<?php  esc_html_e( 'Qty', 'rentit' ); ?>" name="_rental_resource_quantity[]" value="<?php echo esc_attr( $resource['quantity'] ); ?>" />
  </td>
  <td class="cost" width="11%">
    <input type="text" class="input_text" placeholder="<?php  esc_html_e( 'Cost', 'rentit' ); ?>" name="_rental_resource_cost[]" value="<?php echo esc_attr( $resource['cost'] ); ?>" />
  </td>
  <td class="duration" width="26%">
    <span class="wrap">
      <input type="text" class="input_text short" placeholder="<?php  esc_html_e( '', 'rentit' ); ?>" name="_rental_resource_duration_val[]" value="<?php echo esc_attr( $resource['duration_val'] ); ?>" />
      <select class="short" name="_rental_resource_duration_type[]">
        <option value="hours" <?php echo ($resource['duration_type'] == 'hours' ) ? 'selected="selected"' : ''; ?>><?php  esc_html_e('Hour(s)', 'rentit'); ?></option>
        <option value="days" <?php echo ($resource['duration_type'] == 'days' ) ? 'selected="selected"' : ''; ?>><?php  esc_html_e('Day(s)', 'rentit'); ?></option>
        <option value="total" <?php echo ($resource['duration_type'] == 'total' ) ? 'selected="selected"' : ''; ?>><?php  esc_html_e('Total', 'rentit'); ?></option>
        <option value="Included" <?php echo ($resource['duration_type'] == 'Included' ) ? 'selected="selected"' : ''; ?>><?php  esc_html_e('Included', 'rentit'); ?></option>
 <option value="fixed_change" <?php echo ($resource['duration_type'] == 'fixed_change' ) ? 'selected="selected"' : ''; ?>><?php  esc_html_e('Fixed charge', 'rentit'); ?></option>


      </select>
    </span>
  </td>
  <td class="flat_cost" width="11%">
    <?php /*
    <input type="checkbox" name="_rental_resource_flat_cost[]" value="yes" <?php echo ($resource['is_flat_cost'] == 'yes' ) ? 'checked="checked"' : ''; ?> /> <?php echo esc_html__('Yes', 'rentit'); ?>
    */ ?>
    <select name="_rental_resource_flat_cost[]">
      <option value="no" <?php echo ($resource['is_flat_cost'] == 'no' ) ? 'selected="selected"' : ''; ?>><?php  esc_html_e('No', 'rentit'); ?></option>
      <option value="yes" <?php echo ($resource['is_flat_cost'] == 'yes' ) ? 'selected="selected"' : ''; ?>><?php  esc_html_e('Yes', 'rentit'); ?></option>
    </select>
  </td>
  <td width="1%"><a href="#" class="delete"><?php  esc_html_e( 'x', 'rentit' ); ?></a></td>

</tr>
