<?php

$post_id = get_the_ID();

?>

<div class="options_group rentit_general_product_data show_if_rentit_rental">

    <p class="form-field">

		<?php

		// sinii
		$fixed_rental = rentit_is_fixed_rental($post_id);
		$attribute = array();
		if($fixed_rental ){
			$attribute['disabled'] = 'disabled';
		}

		woocommerce_wp_text_input( array(
			'id' => '_min_duration',
			'label' => esc_html__( 'Minimum duration', 'rentit' ),
			'custom_attributes' => $attribute
		) );
		?>

		<?php
		woocommerce_wp_text_input( array(
			'id' => '_max_duration',
			'label' => esc_html__( 'Maximum duration', 'rentit' ),
			'custom_attributes' => $attribute
		) );
		?>


		<?php
		/*
		woocommerce_wp_text_input( array(
		  'id' => '_block_duration',
		  'label' => esc_html__( 'Block duration', 'rentit' )
		) );
		*/
		?>

    </p>

</div>
