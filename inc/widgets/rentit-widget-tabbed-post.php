<?php

if (!defined('ABSPATH')) {
    exit;
}


/**
 * Tabbed posts widget
 * @package Rent It
 * @since Rent It 1.0
 */
class rentit_Widget_Tabbed_Post extends rentit_Widget
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->widget_cssclass = 'widget widget-tabs alt';
        $this->widget_description = esc_html__("Display the tabbed posts in the sidebar.", 'rentit');
        $this->widget_id = 'rentit_widget_tabbed_post';
        $this->widget_name = esc_html__('Rent It Tabbed Post', 'rentit');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => esc_html__('Cart', 'rentit'),
                'label' => esc_html__('Title', 'rentit')
            ),
            'recent_posts_title' => array(
                'type' => 'text',
                'std' => esc_html__('Recent Posts', 'rentit'),
                'label' => esc_html__('Recent Posts title', 'rentit')
            ),
            'recent_posts_limit' => array(
                'type' => 'number',
                'std' => 5,
                'label' => esc_html__('Recent Posts Limit', 'rentit')
            ),
            'popular_posts_title' => array(
                'type' => 'text',
                'std' => esc_html__('Popular Posts', 'rentit'),
                'label' => esc_html__('Popular Posts title', 'rentit')
            ),
            'popular_posts_limit' => array(
                'type' => 'number',
                'std' => 5,
                'label' => esc_html__('Popular Posts Limit', 'rentit')
            ),
            'url' => array(
                'type' => 'text',
                'std' => '#',
                'label' => esc_html__('Insert url to all post', 'rentit')
            ),
        );

        parent::__construct();
    }

    /**
     * widget function.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        
        global $Rent_IT_class;
        ?>
        <div class="widget widget-tabs alt">
            <div class="widget-content">

                <ul id="alt-tabs" class="nav nav-justified">
                    <li class="active">
                        <a href="#alt-tab-s1" data-toggle="tab">
                            <?php echo esc_html($instance['recent_posts_title']); ?>
                        </a>
                    </li>
                    <li><a href="#alt-tab-s2"
                           data-toggle="tab"><?php echo esc_html($instance['popular_posts_title']); ?></a></li>
                </ul>

                <div class="tab-content">
                    <!-- tab 1 -->
                    <div class="tab-pane fade in active" id="alt-tab-s1">

                        <?php
                        $max = $instance['recent_posts_limit'];
                        $post_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => $max,
                            'ignore_sticky_posts' => 1,
                            'meta_query' => array(array('key' => '_thumbnail_id'))
                        );


                        $post = new WP_Query($post_args);
                        ?>

                        <?php if ($post->have_posts()) : ?>


                            <div class="recent-post">

                                <?php while ($post->have_posts()) : $post->the_post(); ?>

                                    <div class="media">
                                        <?php if (has_post_thumbnail()): ?>
                                            <a class="pull-left media-link"
                                               href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                                <img
                                                    src="<?php $Rent_IT_class->get_post_thumbnail($post->ID, 70, 70); ?>"
                                                    alt="<?php the_title(); ?>">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        <?php endif; ?>
                                        <div class="media-body">
                                            <div class="media-meta">
                                                <?php echo esc_html(get_the_date()); ?>
                                                <?php if (comments_open()) : ?>
                                                    <span class="divider">/</span><a href="#"><i
                                                            class="fa fa-comment"></i>
                                                        <?php echo esc_html(get_comments_number()); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <h4 class="media-heading"><a
                                                    href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a>
                                            </h4>
                                        </div>
                                    </div><!-- /.media -->

                                <?php endwhile; ?>

                            </div><!-- /.recent-post -->
                        <?php endif;
                        wp_reset_postdata();
                        ?>

                    </div><!-- /.tab-pane -->

                    <!-- tab 2 -->
                    <div class="tab-pane fade" id="alt-tab-s2">

                        <?php
                        $max = $instance['popular_posts_limit'];
                        $post_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => $max,
                            'ignore_sticky_posts' => 1,
                            'meta_key' => 'rentit_post_views_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'meta_query' => array(array('key' => '_thumbnail_id'))
                        );

                        $post = new WP_Query($post_args);
                        ?>

                        <?php if ($post->have_posts()) : ?>

                            <div class="recent-post">

                                <?php while ($post->have_posts()) : $post->the_post(); ?>

                                    <div class="media">
                                        <?php if (has_post_thumbnail()): ?>
                                            <a class="pull-left media-link"
                                               href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                                <img
                                                    src="<?php $Rent_IT_class->get_post_thumbnail($post->ID, 70, 70); ?>"
                                                    alt="<?php the_title(); ?>">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        <?php endif; ?>
                                        <div class="media-body">
                                            <div class="media-meta">
                                                <?php echo esc_html(get_the_date()); ?>
                                                <?php if (comments_open()) : ?>
                                                    <span class="divider">/</span><a href="#"><i
                                                            class="fa fa-comment"></i>
                                                        <?php echo esc_html(get_comments_number()); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <h4 class="media-heading"><a
                                                    href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a>
                                            </h4>
                                        </div>
                                    </div><!-- /.media -->

                                <?php endwhile; ?>

                            </div><!-- /.recent-post -->

                        <?php endif;
                        wp_reset_postdata(); ?>

                    </div>

                </div>
                <a class="btn btn-theme btn-theme-transparent btn-theme-sm btn-block"
                   href="<?php
                   if (isset($instance['url'][0]))
                       echo esc_url($instance['url']); ?>"><?php echo esc_html__('More Posts', 'rentit'); ?></a>
            </div>

        </div>

        <?php

       
    }
}
