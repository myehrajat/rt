<?php get_header();

$Rent_IT_class = rentit_get_Rent_IT_class();
?>
<div class="content-area">

    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1><?php  esc_html_e('Blog', 'rentit') ?></h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="<?php echo esc_url(get_home_url('/')); ?>">
                        <?php  esc_html_e('Home', 'rentit') ?>

                    </a></li>
                <li class="active"> <?php
                    if(!is_array(get_the_category(' ')))    echo esc_html(get_the_category(' ')); ?></li>
            </ul>
        </div>
    </section>
    <!-- /BREADCRUMBS -->

    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar">
        <div class="container">
            <div class="row">
                <!-- SIDEBAR -->
                <?php
                $positin_sidebar = "";

                if (get_theme_mod('rentit_sidebar_position', 's1') == 's1') {
                    $positin_sidebar = 'left';
                } else {
                    $positin_sidebar = 'right';
                }

                if (isset($_GET['showas']) && $_GET['showas'] == 'left') {
                    $positin_sidebar = 'left';
                } elseif (isset($_GET['showas']) && $_GET['showas'] == 'right') {
                    $positin_sidebar = 'right';
                }

                if ($positin_sidebar == 'left')
                    get_sidebar();
                ?>
                <!-- /SIDEBAR -->

                <!-- CONTENT -->
                <div class="col-md-9 content" id="content">

                    <!-- Blog posts -->
                    <?php if (have_posts()) : ?>
                        <?php
                        // Start the Loop.
                        while (have_posts()) : the_post();
                            
                      
                     
                            get_template_part('content', get_post_format());
                            ?>


                        <?php endwhile;
                        wp_reset_postdata();


                    else :
                        // If no content, include the "No posts found" template.


                    endif; ?>
                    <div class="pagination-wrapper">
                        <?php
                        $Rent_IT_class->renita_pagenavi();
                        ?>
                        <?php

                        wp_link_pages(array(
                            'echo' => 0
                        ));

                        ?>
                        <?php
                        ob_start();
                        posts_nav_link('', 'previous page', 'next page');
                        ob_get_clean();
                        ?>
                    </div>

                </div>
                <!-- /CONTENT -->
                <?php
                if ($positin_sidebar == 'right')
                    get_sidebar();
                ?>
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->

</div>
<?php get_footer(); ?>
