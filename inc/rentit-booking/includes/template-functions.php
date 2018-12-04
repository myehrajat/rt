<?php

/**
 * Template functions
 * @package Rent It
 * @since Rent It 1.0
 */



function rentit_inline_booking_form_data(){
 
}

/**
 * Get maximum rental duration
 * @package Rent It
 * @since Rent It 1.0
 */


if ( ! function_exists( 'rentit_rental_maximum_rental_duration_timestamp' ) ) :

 function rentit_rental_maximum_rental_duration_timestamp($post_id = null){
   global $post;
   $id = ($post_id) ? $post_id : $post->ID;

   $timeframe = get_post_meta($id, '_rental_time_frame', true);
   $min_duration = (int)get_post_meta($id, '_min_duration', true);
   $max_duration = (int)get_post_meta($id, '_max_duration', true);

   $one_hour = 60*60;
   $one_day = $one_hour * 24;

   $duration = 0;

   if($timeframe == 'rental_hourly'){
     if($min_duration == $max_duration){
       $duration = $one_hour;
     }else{
       $duration = (($max_duration - $min_duration)*$one_hour)+$one_hour;
     }
   }

   if($timeframe == 'rental_daily'){
     if($min_duration == $max_duration){
       $duration = $one_day;
     }else{
       $duration = (($max_duration - $min_duration)*$one_day)+$one_day;
     }
   }

   return $duration;

 }

endif;



/**
 * Maximum rental duration in hour
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_rental_maximum_rental_duration_hour' ) ) :

  function rentit_rental_maximum_rental_duration_hour(){

    $maximum_duration_hour = rentit_rental_maximum_rental_duration_timestamp();

    return $maximum_duration_hour/3600;

  }

endif;



/**
 * Minimum fixed duration
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_minimum_fixed_duration_timestamp' ) ) :

  function rentit_minimum_fixed_duration_timestamp($post_id = null){

    global $post;
    $id = ($post_id) ? $post_id : $post->ID;

    $is_fixed = rentit_is_fixed_rental($id);

    if(!$is_fixed){
      return;
    }

    $timeframe = get_post_meta($id, '_rental_time_frame', true);
    $fixed_duration = get_post_meta($id, '_rental_duration', true);

    $one_hour = 60*60;
    $one_day = $one_hour * 24;

    $duration = 0;

    if($timeframe == 'rental_hourly'){
      $duration = $fixed_duration*$one_hour;
    }

    if($timeframe == 'rental_daily'){
      $duration = $fixed_duration*$one_day;
    }

    return $duration;

  }

endif;


/**
 * Drop-in date timestamp
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_dropin_date_timestamp' ) ) :

  function rentit_dropin_date_timestamp(){

    if( !isset($_POST['dropin-date']) ){
      return;
    }

    $dropin_date  = isset($_POST['dropin-date']) ? $_POST['dropin-date'] : '';
    $dropin_time  = isset($_POST['dropin-time']) ? $_POST['dropin-time'] : '';
    $dropin_int = strtotime($dropin_date .' '. $dropin_time);

    return $dropin_int;

  }

endif;


/**
 * Drop-off date timestamp
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_dropoff_date_timestamp' ) ) :

  function rentit_dropoff_date_timestamp(){

    if( !isset($_POST['dropoff-date']) ){
      return;
    }

    $dropoff_date  = isset($_POST['dropoff-date']) ? $_POST['dropoff-date'] : '';
    $dropoff_time = isset($_POST['dropoff-time']) ? $_POST['dropoff-time'] : '';
    $dropoff_int = strtotime($dropoff_date . ' '. $dropoff_time);

    return $dropoff_int;

  }

endif;



/**
 * Get user selected schedule
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_user_selected_schedule_timestamp' ) ) :

  function rentit_user_selected_schedule_timestamp(){

    if( !isset($_POST['dropin-date']) ){
      return;
    }

    $dropin_date  = isset($_POST['dropin-date']) ? $_POST['dropin-date'] : '';
    $dropin_time  = isset($_POST['dropin-time']) ? $_POST['dropin-time'] : '';

    $dropoff_date  = isset($_POST['dropoff-date']) ? $_POST['dropoff-date'] : '';
    $dropoff_time = isset($_POST['dropoff-time']) ? $_POST['dropoff-time'] : '';

    $dropin_int = strtotime($dropin_date .' '. $dropin_time);
    $dropoff_int = strtotime($dropoff_date . ' '. $dropoff_time);

    $selected_duration = $dropoff_int - $dropin_int;

    return $selected_duration;

  }

endif;




/**
 * Get user schedule duration
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_user_selected_schedule_duration' ) ) :

  function rentit_user_selected_schedule_duration(){
    if( !isset($_POST['dropin-date']) ){
      return;
    }

    $duration_timestamp = rentit_user_selected_schedule_timestamp();

    $hours = $duration_timestamp / 3600;

    return $hours;

  }

endif;




/**
 * Check if user selected date is in schedule
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_check_rental_schedule_is_available' ) ) :

  function rentit_check_rental_schedule_is_available($id = null){
    if( !isset($_POST['dropin-date']) ){
      return;
    }

    $selected_duration = rentit_user_selected_schedule_timestamp();
    $max_duration = rentit_rental_maximum_rental_duration_timestamp($id);

    if($selected_duration > $max_duration){
      return false;
    }else{
      return true;
    }

  }

endif;


/**
 * Bookable check
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_is_bookable' ) ) :

  function rentit_is_bookable($id){
    $bookable = rentit_check_rental_schedule_is_available($id);

    if($bookable == true){
      return true;
    }else{
      return false;
    }
  }

endif;


/**
 * Calculate base cost multiplier
 * @package Rent It
 * @since Rent It 1.0
 */








if ( ! function_exists( 'rentit_calculate_base_cost_multiplier' ) ) :

  function rentit_calculate_base_cost_multiplier($post_id = null, $schedule = null){


    global $post;

    @$id = ($post_id) ? $post_id : $post->ID;

    $duration = get_post_meta($id, '_rental_duration', true);
    $timeframe = get_post_meta($id, '_rental_time_frame', true);

    $multiplier = 0;
    switch ($timeframe) {
      case 'rental_hourly':
        $multiplier = $schedule / 1;
        break;
      case 'rental_daily':
        $multiplier = $schedule / 24;
        break;
    }

    return round($multiplier);

  }

endif;



/**
 * Retal resources
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_rental_resources' ) ) :

  function rentit_rental_resources($post_id = null){

    global $post;
    $id = ($post_id) ? $post_id : $post->ID;

    $resources = get_post_meta($id, '_rental_resources', true);

    return $resources;

  }

endif;


/**
 * Rental defined resources
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_bulk_rental_resources' ) ) :

  function rentit_bulk_rental_resources($post_id = null){

    global $post;
    $id = ($post_id) ? $post_id : $post->ID;

    $resources = get_post_meta($id, '_rental_bulk_resources', true);

    return $resources;

  }

endif;



/**
 * Check if rental duration type is fixed
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_is_fixed_rental' ) ) :

function rentit_is_fixed_rental($post_id = null){

  global $post;
  $id = ($post_id) ? $post_id : $post->ID;

  $rental_type = get_post_meta($id, '_rental_duration_type', true);

  if($rental_type == 'fixed_rental'){
    return true;
  }else{
    return false;
  }

}

endif;



/**
 * Check if rental duration type is flexible
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_is_flexible_rental' ) ) :

function rentit_is_flexible_rental($post_id = null){

  global $post;
  $id = ($post_id) ? $post_id : $post->ID;

  $rental_type = get_post_meta($id, '_rental_duration_type', true);

  if($rental_type == 'flexible_rental'){
    return true;
  }else{
    return false;
  }

}

endif;



/**
 * Cost resource multiplier
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! function_exists( 'rentit_resource_cost_multiplier' ) ) :

function rentit_resource_cost_multiplier($rental_duration = null, $resource_duration = null, $resource_duration_type=null, $is_flat_cost=null){

  if($is_flat_cost == 'yes'){
    return 1;
  }

  $resource_multiplier = 0;

  switch ($resource_duration_type) {
    case 'hours':
      $resource_multiplier = $resource_duration / 1;
      break;
    case 'days':
      $resource_multiplier = $resource_duration / 24;
      break;
  }

  $multiplier = $resource_multiplier*$rental_duration;

  return (int) $multiplier;

}

endif;
