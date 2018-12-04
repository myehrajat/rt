<?php
/**
 * Template Name: coming soon
 * Preview:
 *
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body id="home" class="wide coming-soon">
<?php if (get_theme_mod('performans_preloader',true)): ?>
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
            <div id="preloader-title">  <?php  esc_html_e('Loading', 'rentit'); ?> </div>
        </div>
    </div>
    <!-- /PRELOADER -->

<?php endif; ?>

<!-- WRAPPER -->
<div class="wrapper">

    <!-- HEADER -->
    <header class="header fixed">
        <div class="header-wrapper">
            <div class="container">

                <!-- Logo -->
                <!-- Logo -->

                <div class="logo">
                    <?php $logo = (get_theme_mod('themeslug_logo', get_stylesheet_directory_uri() . '/img/logo-rentit.png'));
                    if (strlen($logo) < 10) {
                        $logo = get_stylesheet_directory_uri() . '/img/logo-rentit.png';
                    }
                    ?>
                    <a href="<?php echo esc_url(get_home_url('/')); ?>"><img
                            src="<?php echo esc_url($logo); ?>"
                            alt="<?php echo  esc_attr(get_bloginfo('name')); ?>"/></a>
                </div>

            </div>
        </div>

    </header>
    <!-- /HEADER -->

    <!-- CONTENT AREA -->
    <div class="content-area">

        <!-- PAGE -->
        <section class="page-section no-padding slider">
            <div class="container full-width">

                <div class="main-slider">
                    <div class="owl-carousel-off" id="main-slider-off">

                        <!-- Slide 3 -->
                        <div class="item page slide3- dark-">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <h2 class="caption-title">
                                                    <?php  esc_html_e('Coming soon', 'rentit'); ?>
                                                </h2>

                                                <div class="countdown-wrapper">
                                                    <div id="dealCountdown2" class="defaultCountdown clearfix"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Slide 3 -->

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

    </div>
    <!-- /CONTENT AREA -->

</div>


<script type="text/javascript">
    jQuery(document).ready(function () {
        if (jQuery().countdown) {
            var austDay = new Date();
            austDay = new Date( <?php echo esc_attr(get_theme_mod('rentit_COMING_SOON_y',true)); ?>, <?php  echo esc_attr(get_theme_mod('rentit_COMING_SOON_m',true)); ?>, <?php echo esc_attr(get_theme_mod('rentit_COMING_SOON_d',true));  ?>);
            jQuery('#dealCountdown2').countdown({until: austDay});

        }
        jQuery('.page').css('height', jQuery(window).height());
        jQuery('.page').css('min-height', jQuery(window).height());
    });
    jQuery(window).load(function () {
        jQuery('.page').css('height', jQuery(window).height());
        jQuery('.page').css('min-height', jQuery(window).height());
    });
    jQuery(window).resize(function () {
        jQuery('.page').css('height', jQuery(window).height());
        jQuery('.page').css('min-height', jQuery(window).height());
    });
</script>

<?php wp_footer(); ?>
</body>
</html>