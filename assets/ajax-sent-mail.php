<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 14.01.2016
 * Time: 12:51
 */

function rentit_ajax_sent_mail()
{
    if ((isset($_POST['name'])) && (strlen(trim($_POST['name'])) > 0)) {
        $name = stripslashes(strip_tags($_POST['name']));
    } else {
        $name = esc_html__('No name entered','rentit');
    }
    if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
        $email = stripslashes(strip_tags($_POST['email']));
    } else {
        $email =  esc_html__('No email entered','rentit');
    }
    if ((isset($_POST['subject'])) && (strlen(trim($_POST['subject'])) > 0)) {
        $subject = stripslashes(strip_tags($_POST['subject']));
    } else {
        $subject =  esc_html__('No subject entered','rentit');
    }
    if ((isset($_POST['message'])) && (strlen(trim($_POST['message'])) > 0)) {
        $message = stripslashes(strip_tags($_POST['message']));
    } else {
        $message = 'No message entered';
    }
    ob_start();
    ?>
    <html>
    <head>
    </head>
    <body>
    <table width="550" border="0" cellspacing="0" cellpadding="15">
        <tr bgcolor="#eeffee">
            <td><?php  esc_html_e('Name', 'rentit'); ?></td>
            <td><?php echo esc_html($name); ?></td>
        </tr>
        <tr bgcolor="#eeeeff">
            <td><?php  esc_html_e('Email', 'rentit'); ?></td>
            <td><?php echo esc_html($email); ?></td>
        </tr>
        <tr bgcolor="#eeeeff">
            <td><?php  esc_html_e('Subject', 'rentit'); ?></td>
            <td><?php echo esc_html($subject); ?></td>
        </tr>
        <tr bgcolor="#eeffee">
            <td><?php  esc_html_e('Message', 'rentit'); ?></td>
            <td><?php echo esc_html($message); ?></td>
        </tr>
    </table>
    </body>
    </html>
    <?php
    $body = ob_get_clean();

    $to =  esc_html(get_option('admin_email'));
    
    $blogname = esc_html(get_option('blogname'));

    $headers[] = "From:  $blogname  <$to >";
    $headers[] = 'content-type: text/html';


    $send = wp_mail($to, $subject, $body, $headers);
    if ($send == true) {

        wp_die("<strong>" . esc_html__('Contact Form Submitted!', 'rentit') . "</strong>" . esc_html__(' We will be in touch soon', 'rentit'));

    } else {
        wp_die("<strong>" . esc_html__('error', 'rentit') . "</strong>");


    }
    wp_die();
    exit;
}

add_action('wp_ajax_rentit_ajax_sent_mail', 'rentit_ajax_sent_mail');
add_action('wp_ajax_nopriv_rentit_ajax_sent_mail', 'rentit_ajax_sent_mail');


