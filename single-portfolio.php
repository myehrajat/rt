<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 20.01.2016
 * Time: 11:01
 */
$Rent_IT_class = rentit_get_Rent_IT_class();
get_header();
$Rent_IT_class = rentit_get_Rent_IT_class();
?>
    <div class="content-area">
        <!-- BREADCRUMBS -->
        <section class="page-section breadcrumbs text-center">
            <div class="container">
                <div class="page-header">
                    <h1><?php the_title(); ?></h1>
                </div>
                <?php echo wp_kses_post($Rent_IT_class->breadcrumbs()); ?>
            </div>
        </section>
        <!-- /BREADCRUMBS -->
        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section sub-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-12 project-media">
                        <div class="img-carouse mh">
                            <?php
                            rentit_post_gallery_slide(true);
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-7">
                        <div class="project-overview">
                            <h3 class="block-title"><span>
                                <?php  esc_html_e('Project Overview', 'rentit'); ?>
                                </span></h3>
                            <?php the_content(); ?>
                        </div>
                        <div class="project-details">
                            <h3 class="block-title"><span><?php  esc_html_e('Project Details', 'rentit'); ?></span></h3>
                            <dl class="dl-horizontal">
                                <dt><?php  esc_html_e('Client', 'rentit'); ?></dt>
                                <dd><?php echo esc_html(get_post_meta(get_the_ID(), '_rentit_portfolio_client', true)); ?></dd>
                                <dt><?php  esc_html_e('Skills', 'rentit'); ?></dt>
                                <dd>
                                    <?php $terms = get_the_terms(get_the_ID(), 'portfolio_categories');
                                    $j = 0;
                                    if (!empty($terms)):
                                        foreach ($terms as $v) {
                                            if ($j != 0) {
                                                ?> , <?php } ?>
                                            <a href="<?php echo esc_url(get_term_link($v->term_id, 'portfolio_categories')); ?> ">
                                                <?php echo esc_html($v->name); ?>
                                            </a>
                                            <?php
                                            $j++;
                                        }
                                    endif;
                                    ?>
                                </dd>
                                <dt><?php  esc_html_e('Release Date', 'rentit'); ?></dt>
                                <dd><?php echo esc_html(get_the_date('d M, Y')); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <hr class="page-divider"/>
                <div class="pager">
                    <?php
                    //post link
                    echo wp_kses_post(get_previous_post_link(' %link', '<i  class="fa fa-angle-double-left"></i> ' . esc_html__('Older', 'rentit')));
                    echo  wp_kses_post(get_next_post_link(' %link', esc_html__('Newer', 'rentit') . ' <i class="fa fa-angle-double-right"></i>'));
                    ?>
                </div>
                <hr class="page-divider half"/>
                <h2 class="block-title"><?php  esc_html_e('Related project', 'rentit'); ?></h2>
                <div class="row thumbnails portfolio">
                    <?php
                    $rentit_new_arr = array(
                        'paged' => 1,
                        'showposts' => 4,
                        'post_status' => 'publish',
                        'post_type' => 'portfolio',
                        'post__not_in' => array((int)get_the_ID()),
                        'orderby' => 'date'
                    );
                    
                    $rentit_custom_query = new WP_Query($rentit_new_arr);
                    if ($rentit_custom_query->have_posts()):
                        while ($rentit_custom_query->have_posts()) {
                            $rentit_custom_query->the_post();
                            ?>
                            <div class="col-sm-6 col-md-3">
                                <?php get_template_part('partials/porfolio', 'default'); ?>
                            </div>
                            <?php
                        }
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
    </div>
<?php get_footer(); ?>