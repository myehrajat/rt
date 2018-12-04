<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 22.12.2015
 * Time: 14:33
 */

get_header();
?>

<!-- CONTENT AREA -->
<div class="content-area">

    <!-- PAGE -->
    <section class="page-section text-center error-page light">
        <div class="container">
            <h3> <?php  esc_html_e('404', 'rentit') ?></h3>

            <h2><i class="fa fa-warning"></i>
                <?php  esc_html_e(' Oops! The Page you requested was not found!' . 'rentit') ?>

            </h2>
            <p><a class="btn btn-theme btn-theme-dark" href="<?php echo esc_url(get_home_url('/')) ?>">
                    <?php  esc_html_e(' Back to Home', 'rentit') ?>
                </a>
            </p>
        </div>
    </section>
    <!-- /PAGE -->
    <?php
    $shortcode = get_theme_mod('rentit_c_form_s_val');
    if (isset($shortcode) && !empty($shortcode))
        echo do_shortcode($shortcode);
    ?>

</div>
<!-- /CONTENT AREA -->
<?php get_footer(); ?>


