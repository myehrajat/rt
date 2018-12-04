<?php
/**
 * This function via Ajax sends a post request to the server MailChimp
 */

function rentit_mailchimp_send()
{
	//get api kode
	preg_match("/(.*?)-(us+?)/", sanitize_text_field(get_theme_mod('mailchimp_api_control')), $math);

	@$api_key = (isset($math[1])) ? $math[1] : "";


	$list_id = sanitize_text_field(get_theme_mod('mailchimpid_list_control'));
	if (strlen($list_id) < 5) {
		echo esc_attr( esc_html__('You have incorrect id list ', 'rentit'));
		exit;
		die();
	}


	$dataCenter = substr(get_theme_mod('mailchimp_api_control'),strpos(get_theme_mod('mailchimp_api_control'),'-')+1);

	if( !isset($dataCenter{1})) {
		echo esc_attr( esc_html__('You have incorrect API key  ', 'rentit'));
		exit;
		die();
	}

	$email = sanitize_email($_POST['email']);
	$url = "https://$dataCenter.api.mailchimp.com/2.0/lists/subscribe.json";
	$request = wp_remote_post( 	sanitize_text_field($url), array('body' => json_encode(array(
		'apikey' => sanitize_text_field($api_key),
		'id' =>sanitize_text_field($list_id),
		'email' => array('email' => $email),
	)),));
	//var_dump($request);
	$result = json_decode(wp_remote_retrieve_body($request));
//var_dump($result);
	/*if have error then echo this*/
	if (isset($result->error)) {
		echo esc_attr($result->error);
	} elseif (isset($result->email)) {
		echo esc_html__('Email Submitted! You subscribe as  ', 'rentit') . esc_attr($result->email);
	}
	wp_die();
	exit;
}
add_action('wp_ajax_rentit_mailchimp_send', 'rentit_mailchimp_send'); // for logged in user
add_action('wp_ajax_nopriv_rentit_mailchimp_send', 'rentit_mailchimp_send'); // if user not logged in
