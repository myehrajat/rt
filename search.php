<?php
/**
 *
 */
get_header();
?>
    <!--Places grid2-->
<?php
get_sidebar();
$rentit_points = array();
?>
    <div>
        <div class="site-overlay"></div>
        <div id="container">
            <!--header-->
            <div class="container page_info visible-md visible-lg">
                <div id="content" class="site-content color_white " role="main">
                    <?php if (have_posts()) : ?>
                        <div class="page-header">
                            <h1 class="page-title"><?php printf(esc_html( esc_html__('Search Results for: %s', 'rentit')), esc_html(get_search_query())); ?></h1>
                        </div>
                        <!-- .page-header -->
                        <?php
                        // Start the Loop.
                        while (have_posts()) : the_post();
                            ?>
                            <h3><?php the_title(); ?></h3>
                            <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_url(get_the_permalink()); ?></a>
                            <?php
                        endwhile;
                    else :

                        ?>
                        <div class="page-header ph_mw800">
                            <h1 class="page-title"> <?php  esc_html_e('Nothing Found', 'rentit'); ?> </h1>
                        </div>
                        <!-- .page-header -->
                        <?php
                    endif;
                    ?>
                    <script> function initialize_map() {
                        }</script>
                </div>
                <!-- #content -->
            </div>
        </div>
    </div>
<?php get_footer(); ?>