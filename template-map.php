<?php
/**
 * Template Name: Home 6 Map
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body id="home" class="wide full-screen-map">
<?php if (get_theme_mod('performans_preloader', true)): ?>
    <!-- PRELOADER -->
    <div id="preloader">
        <div id="preloader-status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
            <div id="preloader-title">  <?php esc_html_e('Loading', 'rentit'); ?> </div>
        </div>
    </div>
    <!-- /PRELOADER -->
<?php endif; ?>
<!-- Google map -->
<script>
    var
        mapObject,
        markers = [],
        markersData = {
            <?php
            if (isset($_GET['c_cat']) && $_GET['c_cat'] > 0) {

            }
            $rentit_categories = get_categories("taxonomy=product_cat&hide_empty=0");
            $places_categories = array();

            foreach ($rentit_categories as $rentit_place_cat) {
                $rentit_init_maps_point_by_term_slug = rentit_init_maps_point_by_term_slug($rentit_place_cat->term_id);
                if (!$rentit_init_maps_point_by_term_slug) continue;
                $places_categories[] = "'" . esc_html($rentit_place_cat->slug) . "': [" . print_r($rentit_init_maps_point_by_term_slug, true) . "]";
            }
            echo wp_kses_post(implode(",", $places_categories));
            ?>
        };
    function initialize_map() {
        loadScript("<?php echo esc_url(get_template_directory_uri()); ?>/js/infobox.js", after_load);
    }
    function after_load() {
        initialize_new();
        mapObject.setOptions({scrollwheel: true});
    }
    function loadScript(src, callback) {
        var s,
            r,
            t;
        r = false;
        s = document.createElement('script');
        s.type = 'text/javascript';
        s.src = src;
        s.onload = s.onreadystatechange = function () {
            if (!r && (!this.readyState || this.readyState == 'complete')) {
                r = true;
                callback();
            }
        };
        t = document.getElementsByTagName('script')[0];
        t.parentNode.insertBefore(s, t);
    }
</script>
<!-- Google map -->
<div class="google-map">
    <div class="map-canvas" id="map-canvas"></div>
</div>
<!-- /Google map -->
<!-- /Google map -->
<!-- WRAPPER -->
<div class="wrapper opened">
    <!-- HEADER -->
    <header class="header fixed">
        <div class="header-wrapper">
            <div class="container">
                <!-- Logo -->
                <div class="logo">
                    <?php $logo = (get_theme_mod('themeslug_logo', get_stylesheet_directory_uri() . '/img/logo-rentit.png'));
                    if (strlen($logo) < 10) {
                        $logo = get_stylesheet_directory_uri() . '/img/logo-rentit.png';
                    }
                    ?>
                    <a href="<?php echo esc_url(get_home_url('/')); ?>">
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                    </a>
                </div>
                <!-- /Logo -->
                <!-- Mobile menu toggle button -->
                <a href="#" class="menu-toggle btn btn-theme-transparent"><i class="fa fa-bars"></i></a>
                <!-- /Mobile menu toggle button -->
                <ul class="sign-in-menu">
                    <?php
                    if (get_current_user_id() < 1) { ?>
                        <li class="sign-in">
                            <a href="<?php echo esc_url(rentit_get_permalink_by_template('template-login.php')); ?>"><i
                                    class="fa fa-user"></i>
                                <span class="text"><?php esc_html_e('Sign In', 'rentit') ?> </span>
                            </a>
                        </li>
                        <li class="register active">
                            <a href="<?php echo esc_url(rentit_get_permalink_by_template('template-login.php')); ?>"><i
                                    class="fa fa-sign-in"></i>
                                <span class="text"><?php esc_html_e('Register', 'rentit'); ?> </span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="register active">
                            <a href="<?php echo esc_url(wp_logout_url(get_home_url('/'))); ?>"><i
                                    class="fa fa-sign-in"></i>
                                <span class="text"><?php esc_html_e('Logout?', 'rentit'); ?> </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- Navigation -->
                <?php get_template_part('partials/header', 'navigation') ?>
                <!-- /Navigation -->
            </div>
        </div>
    </header>
    <!-- /HEADER -->
    <!-- CONTENT AREA -->
    <div class="content-area scroll">
        <div class="open-close-area" id="open-close-area"><a href="#"><i class="fa fa-angle-left"></i></a></div>
        <div class="helping-center-line">
            <div class="container">
                <h4><?php echo esc_html(get_theme_mod('Other_control_Helping-text', 'Helping Center')); ?></h4>
                <span><?php echo esc_html(get_theme_mod('Other_control_phone', '+90 555 444 66 33')); ?></span>
                <a href="<?php echo esc_url(get_theme_mod('Other_control_urlsupport', 'https://www.zendesk.com/')); ?>"
                   class="btn btn-theme btn-theme-dark"> <?php esc_html_e('Write Ticket', 'rentit'); ?> </a>
            </div>
        </div>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <!-- PAGE -->
                <section class="page-section">
                    <div class="container">
                        <hr class="page-divider small transparent"/>
                        <h3 class="block-title alt2"><i class="fa fa-angle-down"></i>
                            <?php esc_html_e('Find Best Rental Car', 'rentit'); ?>
                        </h3>
                        <!-- Search form -->
                        <div class="form-search light">
                            <form action="" method="get">
                                <div class="row row-inputs">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group has-icon has-label">
                                            <label for="formSearchUpLocation2">
                                                <?php esc_html_e('Picking Up Location', 'rentit') ?>
                                            </label>
                                            <input name="dropin" type="text" class="form-control"
                                                   id="formSearchUpLocation2"
                                                   placeholder="<?php esc_html_e('Airport or Anywhere', 'rentit'); ?>"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropin_location');
                                                   ?>"
                                            >
                                            <span class="form-control-icon">
                                                <i class="fa fa-location-arrow"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group has-icon has-label">
                                            <label for="formSearchOffLocation2">
                                                <?php esc_html_e('Picking Off Location', 'rentit') ?>
                                            </label>
                                            <input name="dropoff" type="text" class="form-control"
                                                   id="formSearchOffLocation2"
                                                   placeholder="<?php esc_html_e('Airport or Anywhere', 'rentit'); ?>"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropoff_location');
                                                   ?>"
                                            >
                                            <span class="form-control-icon">
                                                <i class="fa fa-location-arrow"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-inputs">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group has-icon has-label">
                                            <label for="formSearchUpDate3">
                                                <?php esc_html_e('Picking Up Date', 'rentit') ?>
                                            </label>
                                            <input name="start_date" type="text" class="form-control"
                                                   id="formSearchUpDate3"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropin_date');
                                                   ?>"
                                                   placeholder="<?php esc_html_e('dd/mm/yyyy', 'rentit'); ?>">
                                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group has-icon has-label">
                                            <label for="formSearchOffDate3">
                                                <?php esc_html_e('Picking Off Date', 'rentit') ?>
                                            </label>
                                            <input name="end_date" type="text" class="form-control"
                                                   id="formSearchOffDate3"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropoff_date');
                                                   ?>"
                                                   placeholder="<?php esc_html_e('dd/mm/yyyy', 'rentit'); ?>">
                                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-submit">
                                    <div class="container-fluid">
                                        <div class="inner">
                                            <i class="fa fa-plus-circle"></i>
                                            <a href="<?php if (function_exists('wc_get_page_id')) echo esc_url(get_permalink(wc_get_page_id(('shop')))); ?>">
                                                <?php esc_html_e('Advanced Search', 'rentit'); ?>
                                            </a>
                                            <button type="submit" id="formSearchSubmit2"
                                                    class="btn btn-submit btn-theme pull-right">
                                                <?php esc_html_e(' Find Car', 'rentit'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /Search form -->
                        <hr class="page-divider half transparent"/>
                        <h3 class="block-title alt2"><i class="fa fa-angle-down"></i>
                            <?php esc_html_e('Result Rental Car', 'rentit'); ?>
                        </h3>
                        <div class="row  ajax-car-list">
                            <?php
                            $paged = (int)sanitize_text_field(get_query_var('paged'));
                            $posts_per_page = (int)sanitize_text_field(get_option('posts_per_page'));
                            $rentit_new_arr = array(
                                'paged' => $paged,
                                'showposts' => $posts_per_page,
                                'post_status' => 'publish',
                                'post_type' => 'product',
                                'orderby' => 'date'
                            );
                            if (isset($_GET['c_cat']) && $_GET['c_cat'] > 0) {
                                $rentit_new_arr['tax_query'] =
                                    array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'id',
                                            'terms' => array(sanitize_text_field($_GET['c_cat']))
                                        )
                                    );
                            }
                            //booking filter location
                            if (isset($_GET['dropin']) && !empty($_GET['dropin']) && isset($_GET['dropoff']) && !empty($_GET['dropoff']))
                                $rentit_new_arr['meta_query'] = $rentit_new_arr['meta_query'] = array(
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

                                $start_date = strtotime(sanitize_text_field(urldecode($_GET['start_date'])));
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
                            ?>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->
            </div>
        </div>
        <!-- Add Scroll Bar -->
        <div class="swiper-scrollbar"></div>
    </div>
    <!-- /CONTENT AREA -->
    <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>
</div>
<!-- /WRAPPER -->
<!-- JS Global -->
<?php wp_footer(); ?>
</body>
</html>