<?php
/**
 * Show messages
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!$messages) {
    return;
}

if (get_option('woocommerce_cart_redirect_after_add') == 'yes' && $_SERVER['REQUEST_URI'] == '/checkout/') {

} else {
    ?>

    <?php foreach ($messages as $message) : ?>

        <div class="alert alert-success fade in">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <?php echo wp_kses_post($message); ?>
        </div>
    <?php endforeach;
}
?>
