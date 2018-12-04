<?php
/**
 * Template Name: blog
 */
?>
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
                        </a>
                    </li>
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
                    if ($positin_sidebar == 'left') {
                        ?>
                        <!-- SIDEBAR -->
                        <aside class="col-md-3 sidebar" id="sidebar">
                            <?php
                            dynamic_sidebar('rentit_sidebar');
                            ?>
                        </aside>
                        <!-- /SIDEBAR -->
                        <?php
                    }
                    ?>
                    <!-- /SIDEBAR -->
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                        <!-- Blog posts -->
                        <?php
                        $posts_per_page = (int)esc_html(get_option('posts_per_page'));
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array('paged' => $paged, 'posts_per_page' => $posts_per_page,
                            'post_type' => 'post');
                        $query = new WP_Query($args);
                        if ($query->have_posts()) : ?>
                            <?php
                            // Start the Loop.
                            while ($query->have_posts()) : $query->the_post();
                              
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
                        </div>
                    </div>
                    <!-- /CONTENT -->
                    <?php
                    if ($positin_sidebar == 'right') {
                        ?>
                        <!-- SIDEBAR -->
                        <aside class="col-md-3 sidebar" id="sidebar">
                            <?php
                            dynamic_sidebar('rentit_sidebar');
                            ?>
                        </aside>
                        <!-- /SIDEBAR -->
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
    </div>
<?php get_footer(); ?>