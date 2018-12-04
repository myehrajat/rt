<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
get_header('shop'); ?>
<div class="content-area">



    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1><?php echo esc_html(get_bloginfo('name')); ?></h1>
            </div>
            <?php
            $args = array(
                'delimiter' => ' ',
                'wrap_before' => '<ul class="breadcrumb">',
                'wrap_after' => '</ul>',
                'before' => '<li>',
                'after' => '</li>',
                'home' => esc_html_x('Home', 'breadcrumb', "rentit")
            );

            woocommerce_breadcrumb($args); ?>


        </div>
    </section>
    <!-- /BREADCRUMBS -->

    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar sub-page">
        <div class="container">

            <div class="row">
                <?php
                if (get_theme_mod('rentit_shop_sidebar_pos', 's2') == 's1') {
                    ?>
                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                        <?php dynamic_sidebar('rentit_sidebar_booking'); ?>
                    </aside>
                    <!-- /SIDEBAR -->
                    <?php
                }

                ?>

                <?php
                /**
                 * woocommerce_before_main_content hook.
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action( 'woocommerce_before_main_content' );
                ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php wc_get_template_part( 'content', 'single-product' ); ?>

                <?php endwhile; // end of the loop. ?>

                <?php
                /**
                 * woocommerce_after_main_content hook.
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action( 'woocommerce_after_main_content' );
                ?>
                <?php
                /**
                 * woocommerce_sidebar hook
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                //do_action('woocommerce_sidebar');


                ?>


                <?php
                if (get_theme_mod('rentit_shop_sidebar_pos', 's2') == 's2') {
                    ?>
                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                        <?php dynamic_sidebar('rentit_sidebar_booking'); ?>
                    </aside>
                    <!-- /SIDEBAR -->
                    <?php
                }

                ?>


            </div>
        </div>
    </section>
    <!-- /PAGE -->

</div>

<!-- /CONTENT AREA -->

<?php get_footer('shop'); ?>
