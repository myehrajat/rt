<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 14.01.2016
 * Time: 12:51
 */

function rentit_ajax_get_car_list()
{
    global $wpdb;
    $get = array();
    if (!empty($_POST['GET'])) {
        $get = array_map('sanitize_text_field', $_POST['GET']);

    }

    $posts_per_page = (int)sanitize_text_field(get_option('posts_per_page'));

    $rentit_new_arr = array(
        'paged' => (int)$_POST['page_no'],
        'showposts' => (int)$posts_per_page,
        'post_status' => 'publish',
        'post_type' => 'product',
        'orderby' => 'date'
    );


    if (isset($get['c_cat']) && $get['c_cat'] > 0) {
        $rentit_new_arr['tax_query'] =
            array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => array(sanitize_text_field($get['c_cat']))
                )
            );
    }

    //booking filter location
    if (isset($get['dropin']) && !empty($get['dropin']) && isset($get['dropoff']) && !empty($get['dropoff']))
        $rentit_new_arr['meta_query'] = $rentit_new_arr['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => '_rental_dropin_locations2',
                'value' => sanitize_text_field($get['dropin']),
                'compare' => 'LIKE',
            ),

            array(
                'key' => '_rental_dropoff_locations2',
                'value' => sanitize_text_field($get['dropoff']),
                'compare' => 'LIKE',
            ),

        );
    //booking filter date
    if (isset($get['start_date']) &&  rentit_plugin_activate() && !empty($get['start_date']) && isset($get['start_date']) && !empty($get['start_date'])) {

        $start_date = strtotime(sanitize_text_field(urldecode($get['start_date'])));
        $res = $wpdb->get_results(
            $wpdb->prepare("SELECT product_id  FROM `{$wpdb->prefix}rentit_booking` WHERE ( %d >=`dropin_date` AND %d <= `dropoff_date`)",
                $start_date,
                $start_date
            )

        );
        foreach ($res as $item) {
            $rentit_new_arr['post__not_in'][] = $item->product_id;
        }

    }

    $rentit_custom_query = new WP_Query($rentit_new_arr);


    if ($rentit_custom_query->have_posts()):
        while ($rentit_custom_query->have_posts()):
            $rentit_custom_query->the_post();
            ?>

            <div class="col-md-6">
                <?php get_template_part('partials/car', 'list1'); ?>

            </div>
            <?php


        endwhile;
        wp_reset_postdata();
    endif;


    wp_die();
    exit;
}

add_action('wp_ajax_rentit_ajax_get_car_list', 'rentit_ajax_get_car_list');
add_action('wp_ajax_nopriv_rentit_ajax_get_car_list', 'rentit_ajax_get_car_list');
