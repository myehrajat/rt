<?php


add_action('add_meta_boxes', 'rentit_custom_meta_box');

function rentit_custom_meta_box($postType)
{

    $postType = (isset($postType)) ? $postType : "post";
    add_meta_box('rentit_meta_box',
        esc_html__('Page sittings', 'rentit'),
        'rentit_footer_meta_box',
        'page',
        'side',
        'low');

    add_meta_box('rentit_meta_box',
        esc_html__('Client', 'rentit'),
        'rentit_Client_meta_box',
        'portfolio',
        'side',
        'low');
}

add_action('save_post', 'rentit_save_metabox');

function rentit_save_metabox()
{
  
    global $post;

    if (isset($post->ID)) {
        if (isset($_POST["rentit_hide_footer"])) {
            $meta_element_class = $_POST['rentit_hide_footer'];
            update_post_meta($post->ID, 'rentit_hide_footer', sanitize_text_field($meta_element_class));
        } else {
            @delete_post_meta($post->ID, 'rentit_hide_footer');
        }
        if (isset($_POST["rentit_portfolio_client"])) {
            $meta_element_class = $_POST['rentit_portfolio_client'];
            update_post_meta($post->ID, '_rentit_portfolio_client', sanitize_text_field($meta_element_class));
        } else {
            @delete_post_meta($post->ID, '_rentit_portfolio_client');
        }


        if (isset($_POST["rentit_breadcrumbs_aling"])) {
            $meta_element_class = $_POST['rentit_breadcrumbs_aling'];
            update_post_meta($post->ID, '_rentit_breadcrumbs_aling', sanitize_text_field($meta_element_class));
        } else {
            @delete_post_meta($post->ID, '_rentit_breadcrumbs_aling');
        }
        if (isset($_POST["_rentit_shortcode_footer"])) {
            $meta_element_class = $_POST['_rentit_shortcode_footer'];
            update_post_meta($post->ID, '_rentit_shortcode_footer', sanitize_text_field($meta_element_class));
        } else {
            @delete_post_meta($post->ID, '_rentit_shortcode_footer');
        }
    }

}

/*
 * drav metabox client
 */
function rentit_Client_meta_box($post)
{
    $rentit_clent = get_post_meta($post->ID, '_rentit_portfolio_client', true);

    ?>

    <label><strong><?php echo esc_html('Client', 'rentit'); ?></strong>
        <input class=" wide-fate code" type="text" name="rentit_portfolio_client"
               value="<?php if (!empty($rentit_clent)) echo esc_html($rentit_clent); ?>"/>
    </label>


    <?php
}

function rentit_footer_meta_box($post)
{
    $rentit_header = get_post_meta($post->ID, 'rentit_hide_footer', true);
    $rentit_breadcrumbs = get_post_meta($post->ID, '_rentit_breadcrumbs_aling', true);
    if (!empty($rentit_breadcrumbs)) {
        $rentit_breadcrumbs;
    } else {
        $rentit_breadcrumbs = "right";
    }

    $val = get_post_meta($post->ID, '_rentit_shortcode_footer', true);
    ?>
    <div class="inside">
        <label><strong><?php echo esc_html__('Small footer', 'rentit'); ?></strong>
            <input type="checkbox" name="rentit_hide_footer" <?php checked($rentit_header, 'on'); ?> />
        </label>


    </div>
    <div class="inside">
        <label for="rentit_breadcrumbs_aling"><strong><?php echo esc_html__('breadcrumbs aling', 'rentit'); ?></strong>

        </label>

        <select id="rentit_breadcrumbs_aling" name="rentit_breadcrumbs_aling">
            <option <?php selected($rentit_breadcrumbs, "right"); ?>
                value="right"> <?php esc_html_e('right', 'rentit') ?></option>
            <option <?php selected($rentit_breadcrumbs, "center"); ?>
                value="center"><?php esc_html_e('center', 'rentit') ?></option>
            <option <?php selected($rentit_breadcrumbs, "left"); ?>
                value="left"><?php esc_html_e('left', 'rentit') ?></option>
        </select>
    </div>
    <div class="inside">
        <label
            for="rentit_shortcode_footer"><strong><?php echo esc_html__('Shortcode for footer', 'rentit'); ?></strong>
        </label>

        <textarea class="large-text code" id="rentit_shortcode_footer" name="_rentit_shortcode_footer"><?php

            if (isset($val) && !empty($val)) {
                echo wp_kses_post($val);
            } ?></textarea>


    </div>
    <?php
}


add_action('add_meta_boxes', 'rentit_adding_new_metaabox');
function rentit_adding_new_metaabox($postType)
{
    $postType = (isset($postType)) ? $postType : "post";
    $types = array('post', 'page');

}

function rentit_my_output_function($post)
{
    //so, dont ned to use esc_attr in front of get_post_meta
    $valueeee2 = get_post_meta((int)$_GET['post'], 'rentit_short_description', true);
    wp_editor(htmlspecialchars_decode($valueeee2), 'mettaabox_ID_stylee',
        $settings = array('textarea_name' => 'rentit_Inputdesc',
            'textarea_rows' => 3, 'media_buttons' => false));
}


function rentit_save_my_postdata($post_id)
{
    /*
         * rentit_lat_long
         * rentit_formatted_address
         * rentit_meta_phone
         * rentit_meta_website
         */

    if (!empty($_POST['rentit_lat_long'])) {
        update_post_meta($post_id, 'rentit_lat_long', sanitize_text_field($_POST['rentit_lat_long']));
    }
    if (!empty($_POST['rentit_formatted_address'])) {
        update_post_meta($post_id, 'rentit_formatted_address', sanitize_text_field($_POST['rentit_formatted_address']));
    }
    if (!empty($_POST['rentit_meta_phone'])) {
        update_post_meta($post_id, 'rentit_meta_phone', sanitize_text_field($_POST['rentit_meta_phone']));
    }
    if (!empty($_POST['rentit_meta_website'])) {
        update_post_meta($post_id, 'rentit_meta_website', sanitize_text_field($_POST['rentit_meta_website']));
    }
    if (!empty($_POST['location_lon'])) {
        update_post_meta($post_id, '_location_lon', sanitize_text_field($_POST['location_lon']));
    }

    if (!empty($_POST['location_lat'])) {
        update_post_meta($post_id, '_location_lat', sanitize_text_field($_POST['location_lat']));
    }

}

add_action('save_post', 'rentit_save_my_postdata');


?>