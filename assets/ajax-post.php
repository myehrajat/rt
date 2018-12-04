<?php
/**
 * Ajax like post
 *
 * */


function rentit_ajax_post_like()
{

    if($_POST['minus'] == false) {
        $pre_likes = get_post_meta((int)$_POST['id'], '_rentit_post_like', true);
        update_post_meta((int)$_POST['id'], '_rentit_post_like', (int)$pre_likes + 1);
        $res = (int)$pre_likes + 1;
    } else {
        $pre_likes = get_post_meta((int)$_POST['id'], '_rentit_post_like', true);
        update_post_meta((int)$_POST['id'], '_rentit_post_like', (int)$pre_likes - 1);
        $res = (int)$pre_likes - 1;
    }
    echo esc_html($res);

    wp_die();
    exit;
}

add_action('wp_ajax_rentit_ajax_post_like', 'rentit_ajax_post_like');
add_action('wp_ajax_nopriv_rentit_ajax_post_like', 'rentit_ajax_post_like');


