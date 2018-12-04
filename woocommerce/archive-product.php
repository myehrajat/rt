<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.5.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( isset( $_GET['showas'] ) && $_GET['showas'] == 'map' ) {
	get_template_part( 'template', 'map' );
	die();
}

$sidebar_show = true;
if ( get_theme_mod( 'rentit_shop_view_full' ) == true ) {
	$sidebar_show = false;
}

if ( isset( $_GET['full'] ) ) {
	$sidebar_show = false;
}

get_header( 'shop' ); ?>
<div class="content-area">

    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
            </div>
			<?php
			$args = array(
				'delimiter' => ' ',
				'wrap_before' => '<ul class="breadcrumb">',
				'wrap_after' => '</ul>',
				'before' => '<li>',
				'after' => '</li>',
				'home' => esc_html_x( 'Home', 'breadcrumb', "rentit" )
			);

			woocommerce_breadcrumb( $args ); ?>


        </div>
    </section>
    <!-- /BREADCRUMBS -->

    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar sub-page">
        <div class="container">

            <div class="row">

				<?php
				if ( get_theme_mod( 'rentit_shop_sidebar_pos', 's2' ) == 's1' && $sidebar_show ) {
					?>
                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
						<?php
						@dynamic_sidebar( 'rentit_sidebar_shop' );
						?>
                    </aside>
                    <!-- /SIDEBAR -->
					<?php
				}

				?>


				<?php
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
				?>

				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

				<?php endif; ?>

				<?php
				/**
				 * woocommerce_archive_description hook
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );

				?>

				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>

					<?php
					/**
					 * woocommerce_before_shop_loop hook
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */

					do_action( 'woocommerce_before_shop_loop' );
					?>

					<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php


					$paged = (int) sanitize_text_field( get_query_var( 'paged' ) );
					$posts_per_page = (int) sanitize_text_field( get_option( 'posts_per_page' ) );
					//taxanomia array
					$new_tax_q = array();

					$WC_Query = new WC_Query();

					$array = $WC_Query->get_catalog_ordering_args();


					if ( get_theme_mod( 'rentit_shop_view_per_page' ) > 0 ) {
						$posts_per_page = get_theme_mod( 'rentit_shop_view_per_page' );
					}
					if ( get_theme_mod( 'rentit_shop_view_all_products' ) == true ) {
						$posts_per_page = 1000;
					}


					$rentit_new_arr = array(

						'paged' => $paged,
						'posts_per_page' => $posts_per_page,
						'post_status' => 'publish',
						'post_type' => 'product',

					);


					$rentit_new_arr = array_merge( $rentit_new_arr, $array );


					$rentit_new_arr['tax_query'] = array();


					// filter y product grup


					$filter_arr = array();

					if ( isset( $_GET['price_filter'] ) ) {
						$price = sanitize_text_field( urldecode( @$_GET['price_filter'] ) );

						$price = explode( ',', $price );

						$filter_arr[] = array(
							'relation' => 'AND',
							array(
								'key' => '_base_cost',
								'value' => (int) $price[0],
								'compare' => '>=',
								'type' => 'NUMERIC'
							),
							array(
								'key' => '_base_cost',
								'value' => (int) $price[1],
								'compare' => '<=',
								'type' => 'NUMERIC'
							)
						);
						// _base_cost
					}


					if ( isset( $_GET['location_lon'] ) && !empty( $_GET['location_lon'] ) ) {

						$lon_min = $_GET['location_lon'] - 0.11;
						$lon_max = $_GET['location_lon'] + 0.11;

						$lat_min = $_GET['location_lat'] - 0.11;
						$lat_max = $_GET['location_lat'] + 0.11;

						$filter_arr[] = array(
							'relation' => 'AND',
							array(
								'key' => "_location_lon",
								'value' => array( $lon_min, $lon_max ),
								'compare' => 'BETWEEN'

							),
							array(
								'key' => "_location_lat",
								'value' => array( $lat_min, $lat_max ),
								'compare' => 'BETWEEN'

							)

						);

					}


					//cat filter


					/**********CAR group********/
					if ( isset( $_GET['Car_Group']{0} ) ) {


						if ( is_numeric( $_GET['Car_Group'] ) && (int) $_GET['Car_Group'] > 0 ) {
							$new_tax_q[] = array(
								'taxonomy' => 'product_group',
								'terms' => array( sanitize_text_field( $_GET['Car_Group'] ) ),
								'field' => 'id'
							);
						} elseif ( isset( $_GET['Car_Group']{4} ) ) {
							$new_tax_q[] = array(
								'taxonomy' => 'product_group',
								'terms' => array( sanitize_text_field( $_GET['Car_Group'] ) ),
								'field' => 'name'
							);
						}


					}

					/********************** Product cat *******************/


					if ( isset( $_GET['c_cat']{0} ) && $_GET['c_cat'] > 0 ) {
						$rentit_new_arr['tax_query'] =
						$new_tax_q[] = array(
							'taxonomy' => 'product_cat',
							'terms' => array( sanitize_text_field( $_GET['c_cat'] ) ),
							'field' => 'id'
						);

					}


					$tag = get_query_var( 'product_tag' );
					if ( isset( $tag{1} ) ) {
						$rentit_new_arr['tax_query'] =
						$new_tax_q[] = array(
							'taxonomy' => 'product_tag',
							'terms' => array( $tag ),
							'field' => 'slug'
						);
					}

					// get standard $wp_query queries for filters
					$new_arr = array();

					if ( isset( $wp_query->tax_query ) ) {
						foreach ( $wp_query->tax_query as $k => $v ) {
							$new_arr[$k] = $v;


						}
					}

					if ( isset( $new_arr['queries'] ) ) {

						$rentit_new_arr['tax_query'] = array_merge( $new_tax_q, $new_arr['queries'] );
					} else {
						$rentit_new_arr['tax_query'] = $new_tax_q;
					}


					// end queries


					$qv = get_query_var( 'product_group' );
					if ( !empty( $qv ) ) {
						$rentit_new_arr['tax_query'] =
							array(
								array(
									'taxonomy' => 'product_group',
									'field' => 'slug',
									'terms' => array( get_query_var( 'product_group' ) )
								)
							);
					}

					$qv2 = get_query_var( 'product_cat' );
					if ( !empty( $qv2 ) ) {
						$rentit_new_arr['tax_query'] =
							array(
								array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									'terms' => array( get_query_var( 'product_cat' ) )
								)
							);
					}


					//booking filter location
					if ( isset( $_GET['dropin'] ) && !empty( $_GET['dropin'] ) ) {
						$filter_arr[] = array(
							'relation' => 'AND',
							array(
								'key' => '_rental_dropin_locations2',
								'value' => sanitize_text_field( $_GET['dropin'] ),
								'compare' => 'LIKE',
							)

						);
					}


					if ( isset( $_GET['dropoff'] ) && !empty( $_GET['dropoff'] ) ) {
						$filter_arr[] = array(
							'relation' => 'AND',
							array(
								'key' => '_rental_dropoff_locations2',
								'value' => sanitize_text_field( $_GET['dropoff'] ),
								'compare' => 'LIKE',
							)
						);
					}
					if ( $filter_arr ) {

						$rentit_new_arr['meta_query'] = $rentit_new_arr['meta_query'] = array(
							'relation' => 'AND',
							$filter_arr

						);
					}

					//booking filter date
					if ( isset( $_GET['start_date'] ) && !empty( $_GET['start_date'] ) && isset( $_GET['start_date'] ) && !empty( $_GET['start_date'] ) ) {

						$start_date = strtotime( sanitize_text_field( urldecode( $_GET['start_date'] ) ) );
						$res = $wpdb->get_results(
							$wpdb->prepare( "SELECT product_id  FROM `{$wpdb->prefix}rentit_booking` WHERE ( %d >=`dropin_date` AND %d <= `dropoff_date`)",
								$start_date,
								$start_date
							)

						);

						foreach ( $res as $item ) {
							$rentit_new_arr['post__not_in'][] = $item->product_id;
						}

					}

					if ( isset( $rentit_new_arr['meta_key'] ) && $rentit_new_arr['meta_key'] === '_price' ) {
						$rentit_new_arr['meta_key'] = '_sale_cost';
					}
					$w_order_by = get_option( 'woocommerce_default_catalog_orderby' );

					if ( $w_order_by == 'price' ) {

						$rentit_new_arr['meta_key'] = '_base_cost';
						$rentit_new_arr['orderby'] = 'meta_value_num';


					} elseif ( $w_order_by == 'price-desc' ) {

						$rentit_new_arr['meta_key'] = '_base_cost';
						$rentit_new_arr['orderby'] = 'meta_value_num';

					}

					$rentit_custom_query = new WP_Query( $rentit_new_arr );

					//	price-desc

					$view_type = get_theme_mod( 'rentit_shop_view_setting', 'standard' );


					if ( isset( $_GET['view'] ) && $_GET['view'] == 'grid' ) {
						$view_type = 'grid';
					} elseif ( isset( $_GET['view'] ) && $_GET['view'] == 'standard' ) {
						$view_type = 'standard';
					} elseif ( isset( $_GET['view'] ) && $_GET['view'] == 'grid3' ) {
						$view_type = 'grid3';
					}


					if ( $rentit_custom_query->have_posts() ) {
						while ( $rentit_custom_query->have_posts() ):
							$rentit_custom_query->the_post();
							if ( $view_type == 'standard' ) {
								wc_get_template_part( 'content', 'product' );
							} else {
								//get_template_part('partials/car', 'list1');

								$class = 'col-md-6';
								if ( $view_type == 'grid3' ) {
									$class = 'col-md-4';
								}
								?>
                                <div class="<?php echo esc_attr( $class ); ?>">
									<?php get_template_part( 'partials/car', 'list1' ); ?>
                                </div>
								<?php
							}

						endwhile;
						wp_reset_postdata();
					} else {
						?>
                        <h1> <?php esc_html_e( 'Sorry, but nothing matched your search terms.', 'rentit' ); ?>  </h1>
						<?php
					}
					?>


					<?php woocommerce_product_loop_end(); ?>

					<?php
					/**
					 * woocommerce_after_shop_loop hook
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					if ( $rentit_custom_query->have_posts() ) {
						do_action( 'woocommerce_after_shop_loop' );
					}

					?>

				<?php elseif ( !woocommerce_product_subcategories( array(
					'before' => woocommerce_product_loop_start( false ),
					'after' => woocommerce_product_loop_end( false )
				) )
				) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

				<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
				?>

				<?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */

				?>

				<?php
				if ( get_theme_mod( 'rentit_shop_sidebar_pos', 's2' ) == 's2' && $sidebar_show ) {
					?>
                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar  mmmmmg" id="sidebar">
						<?php
						@dynamic_sidebar( 'rentit_sidebar_shop' );
						?>
                    </aside>
                    <!-- /SIDEBAR -->
					<?php
				}

				?>


            </div>
        </div>
    </section>
    <!-- /PAGE -->

</div>
<!-- /CONTENT AREA -->


<?php get_footer( 'shop' ); ?>
