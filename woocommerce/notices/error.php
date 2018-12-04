<?php
/**
 * Show error messages
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version 3.3.4
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !$messages ) {
	return;
}

?>
<div class="woocommerce-error">
	<?php foreach ( $messages as $message ) : ?>
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <strong><?php echo wp_kses_post( $message ); ?></strong></div>

	<?php endforeach; ?>
</div>
