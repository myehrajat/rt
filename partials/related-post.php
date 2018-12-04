<?php


$Rent_IT_class = rentit_get_Rent_IT_class();
$post_id = get_the_ID();

$terms_array = array(0);

$category_terms = wp_get_post_terms($post_id, 'category');
$tag_terms = wp_get_post_terms($post_id, 'post_tag');

$category_terms_array = array(0);
foreach ($category_terms as $term) {
    $category_terms_array[] = $term->term_id;
}

$tag_terms_array = array(0);
foreach ($tag_terms as $term) {
    $tag_terms_array[] = $term->term_id;
}

// Don't bother if none are set
if (sizeof($category_terms_array) == 0 || sizeof($tag_terms_array) == 0) {
    $related_posts = array();
} else {

    // Sanitize
    $exclude_ids = array(0, $post_id);

    // Generate query
    $query = array();

    $query['fields'] = "SELECT DISTINCT ID FROM {$wpdb->posts} p";
    @$query['join'] = " INNER JOIN {$wpdb->term_relationships} tr ON (p.ID = tr.object_id)";
    $query['join'] .= " INNER JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)";
    $query['join'] .= " INNER JOIN {$wpdb->terms} t ON (t.term_id = tt.term_id)";

    $query['where'] = " WHERE 1=1";
    $query['where'] .= " AND p.post_status = 'publish'";
    $query['where'] .= " AND p.post_type = 'post'";
    $query['where'] .= " AND p.ID NOT IN ( " . implode(',', $exclude_ids) . " )";

    $query['where'] .= " AND ( tt.taxonomy = 'category' AND t.term_id IN ( " . implode(',', $category_terms_array) . " ) )";

    $andor = 'OR';

    $query['where'] .= " {$andor} ( ( tt.taxonomy = 'post_tag' AND t.term_id IN ( " . implode(',', $tag_terms_array) . " ) )";
    $query['where'] .= " AND p.ID NOT IN ( " . implode(',', $exclude_ids) . " ) )";

    $limit = 4;

    $query['limits'] = " LIMIT {$limit} ";

    // Get the posts
    $related_posts = $wpdb->get_col(implode(' ', $query));


}

$related = $related_posts;

if (sizeof($related) < 1) {
    return;
}

$posts_per_page = 2;
$args = array(
    'post_type' => 'post',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => 1,
    'posts_per_page' => $posts_per_page,
    'post__in' => $related,
    'post__not_in' => array($post_id)
);


$posts = get_posts($args);


?>

<?php if ($posts) : ?>

    <section class="page-section related-posts of-visible">
        <?php   if (get_theme_mod('rentit_rp_related_posts', true)) : ?>
        <h2 class="block-title"><?php echo esc_html__('Related Posts', 'rentit'); ?></h2>

        <div class="masonry-grid-wrap-outer">

            <div class="row masonry-grid-wrap">

                <?php foreach ($posts as $post) : setup_postdata($post); ?>


                    <div class="col-md-6 masonry-grid">
                        <div class="recent-post alt">
                            <div class="media">
                                <a class="media-link" href="<?php echo esc_url(get_permalink(get_the_ID())); ?>">

                                    <?php
                                    $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
                                    $image_size = 'rentit-post-slider-wide';
                                    $image = get_the_post_thumbnail($post->ID, $image_size, array(
                                        'title' => $image_title,
                                        'alt' => $image_title,
                                        'class' => 'media-object'
                                    ));

                                    if ($image) {
                                        ?>
                                        <a class="media-link" href="<?php echo esc_url(get_the_permalink()); ?>">

                                            <div class="badge type"> <?php
                                                $post_categories = wp_get_post_categories($post->ID);
                                                $cats = array();

                                                foreach ($post_categories as $c) {
                                                    $cat = get_category($c);


                                                    ?>
                                                    <?php echo esc_html($cat->name); ?>
                                                    <?php
                                                }

                                                ?>
                                            </div>

                                            <?php
                                            $post_format = get_post_format();
                                            if ($post_format == 'video' || $post_format == 'gallery' || $post_format == 'image') {
                                                $icon = '';
                                                switch ($post_format) {
                                                    case 'video':
                                                        $icon = 'fa-video-camera';
                                                        break;
                                                    case 'gallery':
                                                    case 'image':
                                                        $icon = 'fa-image';
                                                        break;
                                                    default:
                                                        // Display nothing
                                                        $icon = '';
                                                        break;
                                                }

                                                ?>
                                                <div class="badge post">
                                                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                                </div>
                                            <?php } else { ?>
                                                <div class="badge post">
                                                    <i class="fa fa-image"></i>
                                                </div>
                                            <?php } ?>

                                            <img
                                                src="<?php $Rent_IT_class->get_post_thumbnail(get_the_ID(), 490, 194); ?>"
                                                class="media-object wp-post-image"
                                                alt=""
                                            title="<?php  the_title(); ?>"

                                            >
                                            <i class="fa fa-plus"></i>
                                        </a>

                                    <?php } ?>


                                </a>

                                <div class="media-left">
                                    <div class="meta-date">
                                        <div class="day"><?php echo esc_html(get_the_date('d')); ?></div>
                                        <div class="month"><?php echo   esc_html(get_the_date('M')); ?></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-meta">

                                        <?php
                                        $author = esc_html__('By ', 'rentit') . '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_the_author() . '</a>';
                                        echo wp_kses_post($author);
                                        ?>

                                        <?php if (comments_open()) : ?>
                                            <span class="divider">|</span><a
                                                href="<?php echo esc_url(get_post_reply_link()) ?>">
                                                <i class="fa fa-comment"></i><?php echo esc_html(get_comments_number()); ?></a>
                                        <?php endif; ?>
                                        <a data-id="<?php echo esc_html(get_the_ID()); ?>" class="heart_post_like"
                                           href="#">
                                            <i class="fa fa-heart"> </i>
                                            <?php echo esc_html((int)get_post_meta(get_the_ID(), '_rentit_post_like', true)); ?>
                                        </a>


                                    </div>
                                    <h4 class="media-heading">
                                        <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>">
                                            <?php echo esc_html(get_the_title(get_the_ID())); ?>
                                        </a>
                                    </h4>
                                    <?php

                                    $excerpt_limit = (!empty($atts['excerpt_limit'])) ? (int)$atts['excerpt_limit'] : 40;
                                    echo wp_kses_post(rentit_limit_excerpt($excerpt_limit));

                                    ?>
                                </div>
                            </div>
                            <!-- /.media -->
                        </div>
                        <!-- /.recent-post -->
                    </div><!-- /.col-md-6 -->


                <?php endforeach;
                wp_reset_postdata(); ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.masonry-grid-wrap -->
        <?php  endif; ?>
    </section>

    <?php
    wp_reset_postdata();
endif; ?>
