<?php
/**
 * Template Name: all product
 * Preview:
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (isset($_GET['showas']) && $_GET['showas'] == 'map') {
    get_template_part('template', 'map');
    die();
}

$sidebar_show = true;
if (get_theme_mod('rentit_shop_view_full') == true)
    $sidebar_show = false;

if (isset($_GET['full']))
    $sidebar_show = false;

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
                if (get_theme_mod('rentit_shop_sidebar_pos', 's2') == 's1' && $sidebar_show) {
                    ?>
                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                        <?php
                        @dynamic_sidebar('rentit_sidebar_shop');
                        ?>
                    </aside>
                    <!-- /SIDEBAR -->
                    <?php
                }

                ?>

                <?php
                /**
                 * woocommerce_before_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action('woocommerce_before_main_content');
                ?>

                <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

                <?php endif; ?>

                <?php
                /**
                 * woocommerce_archive_description hook
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action('woocommerce_archive_description');

                ?>

                <?php if (have_posts()) : ?>

                    <?php
                    /**
                     * woocommerce_before_shop_loop hook
                     *
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */

                    do_action('woocommerce_before_shop_loop');
                    ?>

                    <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php


                    $paged = (int)sanitize_text_field(get_query_var('paged'));
                    $posts_per_page = (int)sanitize_text_field(get_option('posts_per_page'));
                    //taxanomia array
                    $new_tax_q = array();
                    $WC_Query = new WC_Query();

                    $array =$WC_Query ->get_catalog_ordering_args();

                    $rentit_new_arr = array(

                        'showposts' => 1000,
                        'post_status' => 'publish',
                        'post_type' => 'product',

                    );

                    $rentit_new_arr = array_merge($rentit_new_arr,$array) ;
                    $rentit_new_arr['tax_query'] = array();


                    // filter y product grup





                    $rentit_custom_query = new WP_Query($rentit_new_arr);

                    $view_type = get_theme_mod('rentit_shop_view_setting', 'standard');

                    $view_type = get_theme_mod('rentit_shop_view_setting', 'standard');


                    if (isset($_GET['view']) && $_GET['view'] == 'grid') {
                        $view_type = 'grid';
                    } elseif (isset($_GET['view']) && $_GET['view'] == 'standard') {
                        $view_type = 'standard';
                    }


                    if ($rentit_custom_query->have_posts()) {
                        while ($rentit_custom_query->have_posts()):
                            $rentit_custom_query->the_post();
                            if ($view_type == 'standard') {
                                wc_get_template_part('content', 'product');
                            } else {
                                //get_template_part('partials/car', 'list1');
                                ?>
                                <div class="col-md-4">

                                    <?php get_template_part('partials/car', 'list1'); ?>
                                </div>
                                <?php
                            }

                        endwhile;
                        wp_reset_postdata();
                    }else {
                        ?>
                        <h1> <?php  esc_html_e('Sorry, but nothing matched your search terms.','rentit'); ?>  </h1>
                        <?php
                    }
                    ?>


                    <?php woocommerce_product_loop_end(); ?>

                    <?php
                    /**
                     * woocommerce_after_shop_loop hook
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    if ($rentit_custom_query->have_posts())
                        do_action('woocommerce_after_shop_loop');

                    ?>

                <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                    <?php wc_get_template('loop/no-products-found.php'); ?>

                <?php endif; ?>

                <?php
                /**
                 * woocommerce_after_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action('woocommerce_after_main_content');
                ?>

                <?php
                /**
                 * woocommerce_sidebar hook
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */

                ?>


                <?php
                if (get_theme_mod('rentit_shop_sidebar_pos', 's2') == 's2' && $sidebar_show) {
                    ?>
                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar  mmmmmg" id="sidebar">
                        <?php
                        @dynamic_sidebar('rentit_sidebar_shop');
                        ?>
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
