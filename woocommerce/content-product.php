<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version  3.5.0
 * */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$Rent_IT_class    = rentit_get_Rent_IT_class();
$product          = rentit_get_global_product();
$woocommerce_loop = rentit_get_global_woocommerce_loop();
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes   = array();
$classes[] = 'product-list-item thumbnail no-border no-padding thumbnail-car-card clearfix';
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
$post_id = get_the_ID();
?>
<!-- Car Listing -->


<div <?php post_class( $classes ); ?> class="thumbnail no-border no-padding thumbnail-car-card clearfix">
	<div class="media">
		<a class="media-link" data-gal="prettyPhoto"
		   href="<?php $Rent_IT_class->get_post_thumbnail( $post->ID, 370, 220, true ); ?>">
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			//do_action('woocommerce_before_shop_loop_item_title');


			?>
			<?php if ( has_post_thumbnail() ) { ?>

                <img src="<?php the_post_thumbnail_url( 'rentit-image-370x230-croped' ); ?>"
                     alt="<?php the_title(); ?>">

			<?php } ?>
			<span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
		</a>
	</div>
	<div class="caption">
		<div class="rating">
			<?php
			$star_active = get_post_meta( $post_id, '_rental_car_stars', true ) ? get_post_meta( $post_id, '_rental_car_stars', true ) : 5;
			$star        = 5 - $star_active;
			echo wp_kses_post( str_repeat( ' <span class="star"></span>', $star ) );
			echo wp_kses_post( str_repeat( ' <span class="star active"></span>', $star_active ) );
			?>

		</div>
		<h4 class="caption-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
		<h5 class="caption-title-sub">
			<?php echo esc_html( $Rent_IT_class->get_price_with_text() ); ?>
		</h5>

		<div class="caption-text"><?php
			//the_excerpt();
			echo wp_kses_post(strip_tags(rentit_limit_excerpt( 35, get_the_content() ))); ?></div>
		<table class="table">
			<tr>
				<td><i class="fa fa-car"></i>
					<?php echo esc_html( get_post_meta( $post_id, '_rental_car_year', true ) ? get_post_meta( $post_id, '_rental_car_year', true ) : "2015" ); ?>
				</td>
				<td><i class="fa fa-dashboard"></i>
					<?php echo esc_html( get_post_meta( $post_id, '_rental_car_engine', true ) ? get_post_meta( $post_id, '_rental_car_engine', true ) : esc_html__( "Diesel", "rentit" ) ); ?>
				</td>
				<td><i class="fa fa-cog"></i>
					<?php echo esc_html( get_post_meta( $post_id, '_rental_car_transmission', true ) ? get_post_meta( $post_id, '_rental_car_transmission', true ) : esc_html__( "Auto", "rentit" ) ); ?>
				</td>
				<td>
					<i class="fa fa-road"></i> <?php echo esc_html( get_post_meta( $post_id, '_rental_car_mileage', true ) ? get_post_meta( $post_id, '_rental_car_mileage', true ) : "25000" ); ?>
				</td>
				<td class="buttons">

					<?php
					$url = get_the_permalink();

					if ( isset( $_COOKIE['rentit_order_id']{2} ) && isset( $_COOKIE['rentit_billing_last_name']{2} ) &&
					     isset( $_GET['edit_car'] )
					) {
						$url = get_the_permalink();


						$data = array();
						if ( isset( $_GET['dropin'] ) ) {
							$data['dropin'] = urldecode( $_GET['dropin'] );
						}

						if ( isset( $_GET['dropoff'] ) ) {
							$data['dropoff'] = urldecode( $_GET['dropoff'] );
						}

						if ( isset( $_GET['start_date'] ) ) {
							$data['start_date'] = urldecode( $_GET['start_date'] );
						}

						if ( isset( $_GET['end_date'] ) ) {
							$data['end_date'] = urldecode( $_GET['end_date'] );
						}


						$url = rentit_get_permalink_by_template( 'template-order_edit.php' ) . '?order_id=' . $_COOKIE['rentit_order_id'] . '&last_name=' . $_COOKIE['rentit_billing_last_name'] . '&addcar_id=' . get_the_ID() . '&' . http_build_query( $data );
					}
					?>
					<a data-action="<?php echo esc_html( get_the_ID() ); ?>" class="btn btn-theme btn-theme-dark"
					   href="<?php echo esc_url( $url ); ?>"> <?php echo esc_html( apply_filters( 'rentit_rentit_text', esc_html__( 'Rent It', 'rentit' ) ) ); ?></a>

				</td>
			</tr>
		</table>

		<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );

		?>

	</div>
</div>
<!-- /Car Listing -->
