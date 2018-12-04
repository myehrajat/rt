<?php

/**
 * @return maps point by term slug
 * @param $terms
 * @param string $ids
 * @return string
 */
function rentit_init_maps_point_by_term_slug($terms, $ids = "")
{
    global $Rent_IT_class, $post;
    ob_start();
    $args = array(
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => sanitize_text_field($terms)
            )

        ),
        'post_type' => 'product',
        'orderby' => 'post_date',

    );


    /*
     *
     * */


    //booking filter location
    if (isset($_GET['dropin']) && !empty($_GET['dropin']) && isset($_GET['dropoff']) && !empty($_GET['dropoff']))
        $args['meta_query'] = $rentit_new_arr['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => '_rental_dropin_locations2',
                'value' => sanitize_text_field($_GET['dropin']),
                'compare' => 'LIKE',
            ),
            array(
                'key' => '_rental_dropoff_locations2',
                'value' => sanitize_text_field($_GET['dropoff']),
                'compare' => 'LIKE',
            ),
        );
    //booking filter date
    if (isset($_GET['start_date']) && !empty($_GET['start_date']) && isset($_GET['start_date']) && !empty($_GET['start_date']) && rentit_plugin_activate()) {
global $wpdb;
        $start_date = strtotime(sanitize_text_field(urldecode($_GET['start_date'])));
        $res = $wpdb->get_results(
            $wpdb->prepare("SELECT product_id  FROM `{$wpdb->prefix}rentit_booking` WHERE ( %d >=`dropin_date` AND %d <= `dropoff_date`)",
                $start_date,
                $start_date
            )
        );
        foreach ($res as $item) {
            $args['post__not_in'][] = $item->product_id;
        }
    }

    /*
     *
     */

    if ($ids) {
        $args["post__in"] = $ids;
    }
    $rentit_pmgm_query = new WP_Query($args);
    global $post;
    $points = array();

    if ($rentit_pmgm_query->have_posts()):
        while ($rentit_pmgm_query->have_posts()) {

            $rentit_pmgm_query->the_post();


            ob_start();
            $term_list = wp_get_post_terms(get_the_ID(), 'product_cat', array("fields" => "ids"));

            $cordinats = esc_html(get_post_meta(get_the_ID(), 'rentit_lat_long', true));
            if (!in_array($terms, $term_list))
                continue;

            if(strlen($cordinats) < 5) continue;

            preg_match("/(.*?),(.*?)$/", $cordinats, $math);

            $location_latitude = esc_attr($math[1]);
            $location_longitude = esc_attr($math[2]);
            if (!$location_latitude) continue;

            $img = esc_url(get_template_directory_uri()) . "/img/img.png";
            $post_id = get_the_ID();
            ?>

            {
            name: '<?php
            echo esc_html(get_the_title());
            ?>',
            location_latitude: <?php
            echo esc_html($location_latitude);
            ?>,
            location_longitude:  <?php
            echo esc_html($location_longitude);
            ?>,
            map_image_url: '<?php
              $Rent_IT_class->get_post_thumbnail(null,270,220);
            //echo esc_url($img);
            ?>',
            name_point: '<?php
            echo esc_html(get_the_title());
            ?>',
            fa_icon: '<?php  echo esc_url(get_template_directory_uri().'/img/icon-google-map.png') ?>',

            description_point: '<?php
            $out = esc_html(get_the_excerpt());
            $out = iconv_substr($out, 0, 120, 'utf-8'); // $out = "324";
	        $out = str_replace( "\n", ' ', $out );
            if (strlen(get_the_title()) < 17)
                echo '<p>' . esc_attr($out) . '</p>';
            ?>',
            url_point: '<?php
            echo esc_url(get_permalink());
            ?>',
            transmission: '<?php echo esc_html(get_post_meta($post_id, '_rental_car_transmission', true) ? get_post_meta($post_id, '_rental_car_transmission', true) : esc_html__( "Auto","rentit")); ?>',
            engine: '<?php echo esc_html(get_post_meta($post_id, '_rental_car_engine', true) ? get_post_meta($post_id, '_rental_car_engine', true) : esc_html__( "Diesel","rentit")); ?>',
            year:'<?php echo esc_html(get_post_meta($post_id, '_rental_car_year', true) ? get_post_meta($post_id, '_rental_car_year', true) : "2015"); ?>',
            moreinfo: '<?php echo esc_html(apply_filters('rentit_rentit_text', esc_html__('Rent It', 'rentit'))); ?>',

            }
            <?php

            $points[] = ob_get_clean();
            
        }
    endif;
    echo implode(",", $points);
    wp_reset_postdata();
    $res = ob_get_clean();

    return $res;
}

?>