<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 19.01.2016
 * Time: 19:47
 */
$Rent_IT_class = rentit_get_Rent_IT_class();

get_header();
?>

    <!-- CONTENT AREA -->
    <div class="content-area">

        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-center">
            <div class="container">
                <div class="page-header">
                    <h1><?php  esc_html_e('Portfolio', 'rentit'); ?></h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo esc_url(get_home_url('/')); ?>">
                            <?php  esc_html_e('Home', 'rentit') ?>
                        </a></li>
                    <li class="active">
                        <?php  echo esc_html(get_query_var('portfolio_categories')); ?></li>
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section sub-page">
            <div class="container">

                <div class="clearfix text-center">
                    <ul id="filtrable" class="filtrable clearfix">
                        <li class="all current"><a href="#" data-filter="*">
                                <?php  esc_html_e('All', 'rentit'); ?> </a>
                        </li>

                    </ul>
                </div>

                <div class="row thumbnails portfolio isotope isotope-items">
                    <?php
                    if (have_posts()):
                        while (have_posts()) {
                            the_post();
                           
                            $terms = get_the_terms($post->ID, 'portfolio_categories');
                          

                            $view = sanitize_text_field(get_theme_mod('rentit_portfolio_view', 'standard'));


                            $params = array('standard','4col','alt');
                            if(isset($_GET['showas']) && !empty($_GET['showas']) && in_array($_GET['showas'],$params)) {
                            $view = sanitize_text_field($_GET['showas']);
                            }
                            $class = ($view == 'standard') ? "col-md-4 col-sm-6" : "col-md-3 col-sm-6";

                            ?>


                            <div class="<?php echo esc_attr($class); ?> isotope-item  <?php
                            if (!empty($terms)):
                                foreach ($terms as $v) {
                                    echo esc_html($v->slug . " ");
                                }
                            endif; ?>">

                                <?php
                                if ($view != 'alt') {
                                    get_template_part('partials/porfolio', 'default');
                                } else {
                                    get_template_part('partials/porfolio', 'alt');
                                }
                                ?>
                            </div>
                            <?php
                        }


                    endif;
                    ?>


                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <?php
                    $args = array(
                        'back_text' => '<i class="fa fa-angle-double-left"></i>',
                        'next_text' => '<i class="fa fa-angle-double-right"></i>'
                    );
                    $Rent_IT_class->renita_pagenavi(false, '', '', true, $args);
                    ?>
                </div>
                <!-- /Pagination -->

            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->

    </div>
    <!-- /CONTENT AREA -->
<?php

get_footer();