<div class="post-meta">
    <?php
    // post meta

    $sep = apply_filters('rentit_meta_separator', ' / ');
    $output = '';
    $output .= esc_html__('By ', 'rentit') . '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_the_author() . '</a>';
    $output .= $sep;
    $output .= '<a href="' . esc_url(get_permalink()) . '">' . get_the_date() . '</a>';
    $output .= $sep;
    $categories = get_the_category($post->ID);
    foreach ($categories as $category) {
        $output .= (' <a href="' . esc_url(get_category_link($category->term_id)) . '" >' . $category->name . '</a></li>');
    }
    if (comments_open()) :
        $output .= $sep;
        $output .= get_post_reply_link(array(
                'reply_text' => get_comments_number() . esc_html__(' Comment', 'rentit')
            )
        );
    endif;

    echo wp_kses_post($output);
    ?>
    <?php echo esc_html($sep . ' ' . esc_html((int)get_post_meta(get_the_ID(), '_rentit_post_like', true))); ?>
    <?php  esc_html_e('Likes', 'rentit'); ?>
</div><!-- /.post-meta -->