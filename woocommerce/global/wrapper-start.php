<?php
/**
 * Content wrappers
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.4.3
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$template = get_option( 'template' );

$class = '';
if ( is_shop() ) {
	$class = '';
}


$classs_col = 'col-md-9';
if ( get_theme_mod( 'rentit_shop_view_full' ) == true ) {
	$classs_col = 'col-md-12';
}
if ( isset( $_GET['full'] ) ) {
	$classs_col = 'col-md-12';
}

echo '<div class="' . $classs_col . ' content  ' . $class . '" id="content">';
