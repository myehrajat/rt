<?php
/**
 * Template Name: Full width page breadcrumb
 * Preview:
 *
 */
get_header();
?>
    <div class="content-area">
        <!-- BREADCRUMBS -->
        <?php
        $brdc = get_post_meta($post->ID, '_rentit_breadcrumbs_aling', true);
        $rentit_breadcrumbs = !empty($brdc) ? $brdc : "right";
        ?>
        <section class="page-section breadcrumbs text-<?php echo esc_attr($rentit_breadcrumbs); ?>">
            <div class="container">
                <div class="page-header">
                    <h1><?php the_title(); ?></h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo esc_url(get_home_url('/')); ?>">
                            <?php  esc_html_e('Home', 'rentit') ?>
                        </a></li>
                    <li class="active"> <?php the_title(); ?></li>
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->
        <?php
        the_post();
        the_content();
        ?>
    </div>
<?php
get_footer();