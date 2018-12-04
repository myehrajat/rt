<?php
get_header();
$Rent_IT_class = rentit_get_Rent_IT_class();

?>
    <div class="content-area">
        <!-- BREADCRUMBS -->
        <!-- BREADCRUMBS -->
        <?php
        $brdc = get_post_meta($post->ID, '_rentit_breadcrumbs_aling', true);
        $rentit_breadcrumbs = !empty($brdc) ? $brdc : "right";
        ?>
        <section class="page-section breadcrumbs text-<?php echo esc_attr($rentit_breadcrumbs); ?>">
            <div class="container">
                <div class="page-header">
                    <h1><?php the_title();

                        ?></h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="<?php echo esc_url(get_home_url('/')); ?>">
                            <?php esc_html_e('Home', 'rentit') ?>
                        </a></li>
                    <li class="active"> <?php the_title(); ?></li>
                </ul>
            </div>
        </section>
        <!-- /BREADCRUMBS -->
        <!-- /BREADCRUMBS -->
        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar">
            <div class="container">
                <div class="row">
                    <!-- SIDEBAR -->
                    <?php
                    if (get_theme_mod('rentit_sidebar_position', 's1') == 's1')
                        get_sidebar();
                    ?>
                    <!-- /SIDEBAR -->
                    <div class="col-md-9 content" id="content">
                        <?php if (have_posts()) : ?>
                            <?php
                            // Start the Loop.
                            while (have_posts()) : the_post();
                                ?>
                                <?php get_template_part('content', get_post_format()); ?>
                            <?php endwhile;
                        else :
                            // If no content, include the "No posts found" template.

                        endif; ?>
                        <!-- About the author --> <?php if (get_theme_mod('rentit_author_the_author', true)): ?>
                            <div class="about-the-author clearfix">

                                <div class="media">
                                    <?php
                                    // get all users date
                                    $my_post = get_post(get_the_ID());  // $id - ID Post
                                    $user_date = get_userdata($my_post->post_author);
                                    $my_post = get_post(get_the_ID());  // $id - ID Post
                                    $user_date = get_userdata($my_post->post_author);
                                    if ($user_date == false) {
                                        $user_date = get_userdata(1);
                                    }
                                    ?>
                                    <img class="media-object pull-left"
                                         src="<?php echo esc_url($Rent_IT_class->get_url_img_avatar($my_post->post_author, 150, 140, '', true));
                                         ?>"
                                         alt="<?php echo esc_attr($my_post->post_author); ?>">
                                    <div class="media-body">
                                        <?php
                                        $aud = the_author_meta('description');
                                        $desc = (!empty( $aud)) ? $aud  : ""; ?>
                                        <p class="media-category"><?php echo esc_html($user_date->roles[0]); ?></p>
                                        <h4 class="media-heading"><a href="#"><?php the_author(); ?></a></h4>
                                        <p><?php echo esc_html($desc); ?></p>
                                    </div>
                                </div>

                            </div>   <?php endif; ?>
                        <!-- /About the author -->
                        <?php


                        get_template_part('partials/related', 'post');

                        ?>

                        <section class="page-section no-padding of-visible">
                            <h4 class="block-title"> <?php esc_html_e('Comments', 'rentit'); ?>
                                <small class="thin">(<?php comments_number(); ?>)</small>
                            </h4>
                            <?php
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif; ?>
                        </section>
                        <!-- /PAGE -->
                    </div>
                    <!-- CONTENT -->
                    <?php
                    if (get_theme_mod('rentit_sidebar_position', 's1') == 's2')
                        get_sidebar();
                    ?>
                    <!-- /CONTENT -->
                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
    </div>
<?php get_footer(); ?>