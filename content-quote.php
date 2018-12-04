<article <?php post_class('post-wrap'); ?>>
    <?php the_content(); ?>
    <div class="post-header">
        <?php get_template_part('meta'); ?>
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