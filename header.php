<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <?php  wp_head(); ?>
</head>
<body id="home"  <?php body_class('wide'); ?> >
<?php if (get_theme_mod('performance_preloader', true)): ?>
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
                <!-- /Logo -->
                <!-- Mobile menu toggle button -->
                <a href="#" class="menu-toggle btn ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>
                <!-- /Mobile menu toggle button -->
                <!-- Navigation -->
                <?php get_template_part('partials/header', 'navigation') ?>
                <!-- /Navigation -->
            </div>
        </div>
    </header>
    <!-- /HEADER -->
