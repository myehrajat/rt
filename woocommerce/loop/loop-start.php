<?php
/**
 * Product Loop Start
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version    3.3.0
 */

$view_type = get_theme_mod('rentit_shop_view_setting', 'standard');


if (isset($_GET['view']) && $_GET['view'] == 'grid') {
    $view_type = 'grid';
} elseif (isset($_GET['view']) && $_GET['view'] == 'standard') {
    $view_type = 'standard';
}elseif (isset($_GET['view']) && $_GET['view'] == 'grid3'){
    $view_type = 'grid3';
}
$class = 'car-listing';
if ($view_type == 'grid' || $view_type == 'grid3') $class = 'row';


?>

<div class="<?php echo esc_attr($class); ?>  columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
