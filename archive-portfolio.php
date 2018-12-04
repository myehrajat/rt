<?php
get_header();

?>


    <!-- CONTENT AREA -->
    <div class="content-area">

        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-center">
            <div class="container">
                <div class="page-header">
                    <h1><?php   esc_html_e('Portfolio','rentit') ?></h1>
                </div>
                <?php echo wp_kses_post($Rent_IT_class->breadcrumbs()); ?>
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section sub-page">
            <div class="container">

                <div class="clearfix text-center">
                    <ul id="filtrable" class="filtrable clearfix">
                        <li class="all current"><a href="#"
                                                   data-filter="*"> <?php  esc_html_e('All', 'rentit'); ?></a></li>
                        <?php

                      
                        $terms = get_terms('portfolio_categories', array('hide_empty' => true));
                        foreach ($terms as $v) {
                          
                            ?>
                            <li class="all "><a href="#"
                                                data-filter=".<?php echo esc_attr($v->slug); ?>"><?php echo esc_html($v->name); ?></a>
                            </li>
                            <?php

                        }

                        ?>

                    </ul>
                </div>

                <div class="row thumbnails portfolio isotope isotope-items">
                    <?php
                    $paged = (int)sanitize_text_field(get_query_var('paged'));
                    $posts_per_page = (int)sanitize_text_field(get_option('posts_per_page'));

                    $rentit_new_arr = array(
                        'paged' => $paged,
                        'showposts' => $posts_per_page +100,
                       
                        'post_status' => 'publish',
                        'post_type' => 'portfolio',
                        'orderby' => 'date'
                    );
               
                    $rentit_custom_query = new WP_Query($rentit_new_arr);
                    if ($rentit_custom_query->have_posts()):
                        while ($rentit_custom_query->have_posts()) {
                            $rentit_custom_query->the_post();                       
                           
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
                        wp_reset_postdata();


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
                 //   $Rent_IT_class->renita_pagenavi(false, '', '', true, $args,null,$posts_per_page +100);
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
