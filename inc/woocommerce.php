<?php

/**
 * Custom WooCommerce functions.
 * @since Rent It 1.0
 */




/**
 * Shop header.
 */

if ( ! function_exists( 'rentit_shop_header' ) ) :
  function rentit_shop_header(){

    ?>
    <!-- CONTENT AREA -->
    <div class="content-area">

      <?php do_action('rentit_content_area_open'); ?>

      <!-- PAGE WITH SIDEBAR -->
      <section class="page-section with-sidebar page-section-outer">
          <div class="container content-wrapper">
              <div class="row">
    <?php
  }
endif;
add_action('rentit_after_header', 'rentit_shop_header', 10);


/**
 * Shop footer
 */

if ( ! function_exists( 'rentit_shop_footer' ) ) :
  function rentit_shop_footer(){
    ?>

          </div><!-- /.row -->
        </div><!-- /.container -->
      </section>
      <!-- /PAGE WITH SIDEBAR -->

    </div>
    <!-- /CONTENT AREA -->

    <?php get_template_part('footer', 'contact'); ?>

    <?php
  }
endif;
add_action('rentit_before_footer', 'rentit_shop_footer');


/**
 * Before product summary in single product page
 */
if ( ! function_exists( 'rentit_before_product_summary' ) ) :
  function rentit_before_product_summary(){
    echo '<div class="col-md-4">';
  }
endif;
add_action('woocommerce_before_single_product_summary', 'rentit_before_product_summary', 100);



/**
 * After product summary in single product page
 */
if ( ! function_exists( 'rentit_after_product_summary' ) ) :
  function rentit_after_product_summary(){
    echo '</div><!-- /.col-md-4 -->';
    echo '</div><!-- /.row -->';
    echo '</div><!-- /.car-big-card.alt -->';
  }
endif;
add_action('woocommerce_after_single_product_summary', 'rentit_after_product_summary', 1);


/**
 * Override default product rating
 */
if ( ! function_exists( 'rentit_product_rating_html' ) ) :
  function rentit_product_rating_html($rating){

    $rating_html = '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong></span>';

    $html  = '<div class="rating">';
    $html .= $rating_html;
    $html .= '</div>';

    return wp_kses_post($html);

  }
endif;
add_filter('woocommerce_product_get_rating_html', 'rentit_product_rating_html');


/**
 * Product thumbnail.
 */
if ( ! function_exists( 'rentit_get_product_thumbnail' ) ) :
function rentit_get_product_thumbnail( $size = 'shop_catalog' ) {

  global $post;
  if ( has_post_thumbnail() ) {

    $img_full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');

    $html = '<a class="media-link" href="'.esc_html($img_full[0]).'" data-gal="prettyPhoto">';
    $html .= get_the_post_thumbnail( $post->ID, $size );
    $html .= '<span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>';
    $html .= '</a>';

    return wp_kses_post($html);

  } elseif ( wc_placeholder_img_src() ) {

    return wc_placeholder_img( $size );

 }

}
endif;

/**
 * Product thumbnail html
 */
if ( ! function_exists( 'rentit_template_loop_product_thumbnail' ) ) :
function rentit_template_loop_product_thumbnail(){

  echo wp_kses_post(rentit_get_product_thumbnail('shop_catalog'));

}
endif;


/**
 * Products details in list
 * @package Rent It
 * @since Rent It 1.0
 */
if ( ! function_exists( 'rentit_product_details_in_list' ) ) :

function rentit_product_details_in_list($post_id = null){

  global $post;

  $id = $post->ID;
  if( !empty($post_id) ){
    $id = $post_id;
  }

  $data_details = get_post_meta($post->ID, '_rentit_prod_list_detail_group', true);


  if ( !empty($data_details) && count($data_details) > 0 ) {

    echo '<ul>';
    foreach ($data_details as $data) {
      echo wp_kses_post('<li>'.$data['_rentit_prod_list_detail_item'].'</li>');
    }
    echo '</ul>';

  }

}

endif;
add_action('woocommerce_single_product_summary', 'rentit_product_details_in_list', 21);



/**
 * Single product checkout
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_checkout_form_in_single_product' ) ) :

function rentit_checkout_form_in_single_product(){

  get_template_part( 'template-parts/form', 'booking' );

}

endif;
add_action('woocommerce_after_single_product_summary', 'rentit_checkout_form_in_single_product', 9);







/**
 * Single add to cart button
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_booking_button_text' ) ) :
function rentit_booking_button_text(){

  return esc_html__('Reservation Now', 'rentit');

}
endif;
add_filter('woocommerce_product_single_add_to_cart_text', 'rentit_booking_button_text' );





/**
 * Product advanced search
 * @package Rent It
 * @since Rent It 1.0
 */


if ( ! function_exists( 'rentit_product_advanced_search' ) ) :

  function rentit_product_advanced_search($query){
    if( isset($_GET['search-car']) && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] =='product' ) {

        // Test
 
        if(isset($_GET['pickup-location']) && $_GET['pickup-location'] != '' ){
          $query->set('meta_query', array(
            array(
              'key'     => '_rentit_car_location_map_val',
              'value'   => $_GET['pickup-location'],
              'compare' => 'LIKE'
            ),
          ));
        }

        if(isset($_GET['car-category']) && $_GET['car-category'] != '' && isset($_GET['car-type']) && $_GET['car-type'] != '' ):

          $query->set('tax_query', array(
              'relation' => 'OR',
              array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $_GET['car-category']
              ),
              array(
                'taxonomy' => 'product_group',
          			'field'    => 'term_id',
          			'terms'    => $_GET['car-type']
              ),
            )
          );

        else :

          if(isset($_GET['car-category']) && $_GET['car-category'] != '' ){
            $query->set('tax_query', array(
          			'taxonomy' => 'product_cat',
          			'field'    => 'term_id',
          			'terms'    => $_GET['car-category']
          		)
            );
          }

          if(isset($_GET['car-type']) && $_GET['car-type'] != '' ){
            $query->set('tax_query', array(
          			'taxonomy' => 'product_group',
          			'field'    => 'term_id',
          			'terms'    => $_GET['car-type']
          		)
            );
          }

        endif;


    }
    return $query;
  }

endif;
add_action( 'pre_get_posts', 'rentit_product_advanced_search' );
