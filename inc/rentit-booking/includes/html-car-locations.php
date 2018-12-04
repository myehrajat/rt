<tr>

  <td class="drop_in">

    <input type="text" class="input_text" placeholder="<?php  esc_html_e( 'Address', 'rentit' ); ?>" name="_car_drop_in_location[]" value="<?php echo esc_attr( $location['drop_in'] ); ?>" />

    <?php /*
    <input type="text" class="input_text" placeholder="<?php  esc_html_e( 'File Name', 'rentit' ); ?>" name="_wc_file_names[]" value="<?php echo esc_attr( $file['name'] ); ?>" />
    */ ?>

  </td>

  <td class="drop_off">

    <input type="text" class="input_text" placeholder="<?php  esc_html_e( 'Address', 'rentit' ); ?>" name="_car_drop_off_location[]" value="<?php echo esc_attr( $location['drop_off'] ); ?>" />

  
  </td>


  <td width="1%"><a href="#" class="delete"><?php  esc_html_e( 'x', 'rentit' ); ?></a></td>

</tr>
