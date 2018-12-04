<?php
/**
 * Template Name: Login register
 */
get_header();
?>
    <!-- CONTENT AREA -->
    <div class="content-area">
        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-center">
            <div class="container">
                <div class="page-header">
                    <h1><?php the_title(); ?></h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo esc_url(get_home_url('/')); ?>">
                            <?php esc_html_e('Home', 'rentit') ?>
                        </a></li>
                    <li class="active"> <?php the_title(); ?></li>
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->
        <!-- PAGE -->
        <section class="page-section color">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="block-title"><span>
                               <?php esc_html_e('Login', 'rentit');
                               ?>
                               </span></h3>
                        <?php if (get_current_user_id() < 1) { ?>
                            <form action="#" class="form-login">
                                <div class="row">
                                    <div class="col-md-12 hello-text-wrap">
                                    <span class="hello-text text-thin">
                                        <?php esc_html_e('Hello, welcome to your account', 'rentit'); ?>
                                        </span>
                                    </div>
                                    <?php
                                    ?>
                                    <?php if (function_exists('rentit_get_faceook_register_link') && rentit_get_faceook_register_link()): ?>
                                        <div class="col-md-12 col-lg-6">
                                            <a class="btn btn-theme btn-block btn-icon-left facebook"
                                               href="<?php
                                               if (function_exists('rentit_get_faceook_register_link'))
                                                   echo (rentit_get_faceook_register_link());

                                               ?>">
                                                <i class="fa fa-facebook"></i>
                                                <?php esc_html_e('Sign in with Facebook', 'rentit'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (function_exists('rentit_get_faceook_register_link') && rentit_get_twiter_link()): ?>
                                        <div class="col-md-12 col-lg-6">
                                            <a class="btn btn-theme btn-block btn-icon-left twitter"
                                               href="<?php
                                               if (function_exists('rentit_get_twiter_link'))
                                                   echo esc_url(rentit_get_twiter_link()); ?>"><i
                                                    class="fa fa-twitter"></i>
                                                <?php esc_html_e(' Sign in with Twitter', 'rentit'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="user_login"
                                                   class="form-control"
                                                   type="text"
                                                   placeholder="<?php esc_html_e('User name or email', 'rentit'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="user_password" class="form-control"
                                                   type="password"
                                                   placeholder="<?php esc_html_e('Your password', 'rentit'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="checkbox">
                                            <input name="remeber" id="checkbox1" class="styled" type="checkbox">
                                            <label for="checkbox1">
                                                <?php esc_html_e('Remember me', 'rentit'); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 text-right-lg">
                                        <a class="forgot-password"
                                           href="<?php echo esc_url(wp_lostpassword_url(home_url('/'))); ?>"><?php esc_html_e('forgot password?', 'rentit'); ?></a>
                                    </div>
                                    <div class="col-md-6">
                                        <button id="login" type="submit" class="btn btn-theme btn-block btn-theme-dark"
                                        ><?php esc_html_e('Login', 'rentit'); ?></button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <?php esc_html_e('Hi ', 'rentit'); ?><?php
                            $current_user = wp_get_current_user();
                            echo esc_html($current_user->display_name);
                            ?>
                            <a href="<?php echo esc_url(wp_logout_url()); ?>"><?php esc_html_e('Logout?', 'rentit') ?></a>
                        <?php } ?>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="block-title"><span><?php esc_html_e('Create New Account', 'rentit'); ?></span></h3>
                        <form action="#" class="create-account">
                            <div class="row">
                                <div class="col-md-12 hello-text-wrap">
                                    <span
                                        class="hello-text text-thin"><?php esc_html_e('Create Your Account', 'rentit'); ?></span>
                                </div>
                                <div class="col-md-12">
                                    <?php if (have_posts()) {
                                        while (have_posts()) {
                                            the_post();
                                            the_content();
                                        }
                                    } ?>
                                </div>
                                <?php if (get_current_user_id() < 1): ?>
                                    <div class="col-md-6">
                                        <a id="tryreg" class="btn btn-block btn-theme btn-theme-dark btn-create"
                                           href="#"><?php esc_html_e('Create
                                        Account', 'rentit'); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </form>
                        <script>
                            jQuery(document).ready(function ($) {
                                $('.js-fbl').addClass('btn btn-theme btn-block btn-icon-left facebook');
                                $('.js-fbl').html('   <i class="fa fa-facebook"></i> <?php   esc_html_e('Sign in with Facebook', 'rentit'); ?>');
                                jQuery('.form-login').serialize();
                                $('.form-login').submit(function (e) {
                                    e.preventDefault();
                                    jQuery.ajax({
                                        url: rentit_obj.ajaxurl,
                                        type: 'POST',
                                        data: 'action=rentit_auth&' + $(this).serialize(),
                                        success: function (html) {
                                            if (html == "1") {
                                                window.location = '/';
                                            } else {
                                                var htm = "<div class=\"alert alert-danger fade in\">" +
                                                    "<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button>"
                                                    + "" + html + "" +
                                                    "</div>";
                                                $('.form-login').append(htm);
                                            }
                                            console.log(html);
                                        }
                                    });
                                });
                                $(document).on("click", '#tryreg', function (e) {
                                    jQuery.ajax({
                                        url: rentit_obj.ajaxurl,
                                        type: 'POST',
                                        data: 'action=rentit_reg&' + $('.form-login').serialize(),
                                        success: function (html) {
                                            if (html == "1") {

                                            } else {
                                                var htm = "<div class=\"alert alert-danger fade in\">" +
                                                    "<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button>"
                                                    + "" + html + "" +
                                                    "</div>";
                                                $('.form-login').append(htm);
                                            }
                                            console.log(html);
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </section>
        <!-- /PAGE -->
    </div>
    <!-- /CONTENT AREA -->
<?php
get_footer();