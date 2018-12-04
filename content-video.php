<article <?php post_class("post-wrap"); ?>>

        <div class="post-media">
            <?php rentit_theme_oembed_videos(); ?>
        </div>

    <div class="post-header">

        <?php
        if (is_single()) :
            the_title('<h2 class="post-title">', '</h2>');
        else :
            the_title(sprintf('<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        endif;
        ?>
        <?php get_template_part('meta'); ?>
    </div>
    <div class="post-body">
        <div class="post-excerpt">
            <p>
            <?php
            if (is_single()) {
                //rentit_remove_video_from_content();
                ob_start();
                the_content();
                echo preg_replace('/<iframe.*?>/','',ob_get_clean(),1);
            } else {
                // Remove embed.
                $content = preg_replace("/<embed[^>]+>/i", "", rentit_limit_excerpt(rentit_words_limit()), 1);
                echo wp_kses_post($content);
            }
            ?></p>
        </div>
    </div>
    <?php if (!is_single()) : ?>
        <div class="post-footer">
            <span class="post-read-more">
                <a href="<?php echo esc_url(get_permalink()); ?>"
                   class="btn btn-theme btn-theme-transparent btn-icon-left">
                    <?php echo apply_filters('rentit_readmore_text', esc_html__('Read More', 'rentit')); ?>
                </a>
            </span>
        </div>
    <?php endif; ?>
</article>