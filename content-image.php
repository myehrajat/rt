<article <?php post_class('post-wrap'); ?>>
    <?php if( !is_singular() ) { ?>
        <?php
        echo rentit_limit_excerpt(rentit_words_limit());
        ?>
        <div class="post-header">
            <?php
            the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            ?>
            <?php get_template_part('meta'); ?>
        </div>
        <div class="post-footer">
            <span class="post-read-more"><a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-theme btn-theme-transparent btn-icon-left"><?php echo apply_filters('rentit_readmore_text', esc_html__('Read More','rentit')); ?></a></span>
        </div>
    <?php } else { ?>
        <div class="post-header">
            <?php the_title( '<h2 class="post-title">', '</h2>' ); ?>
            <?php get_template_part('meta'); ?>
        </div>
        <?php
        echo rentit_limit_excerpt(rentit_words_limit());
        ?>
    <?php } ?>
</article>