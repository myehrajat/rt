<?php if (!is_single()) { ?>
    <article class="post-wrap">
        <div class="post-media">
            <?php rentit_post_thumbnail(); ?>
        </div>
        <div class="post-header">
            <h2 class="post-title"><a
                    href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
            </h2>

            <?php get_template_part('meta'); ?>
        </div>
        <div class="post-body">
            <div class="post-excerpt">
                <p><?php the_excerpt(); ?></p>
            </div>
        </div>
        <div class="post-footer">
             <span class="post-read-more">
                 <a href="<?php echo esc_url(get_the_permalink()); ?>"
                    class="btn btn-theme btn-theme-transparent btn-icon-left">
                     <?php echo apply_filters('rentit_readmore_text', esc_html__('Read More', 'rentit')); ?>
                 </a>

             </span>
        </div>
    </article>

<?php } else { ?>
    <article <?php post_class('post-wrap'); ?>>

        <div class="post-media">
            <?php rentit_post_thumbnail(); ?>
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

        <?php

        // post content

        ?>

        <div class="post-body">
            <div class="post-excerpt">

                <?php
                the_content();
                ?>

            </div>
        </div>

        <?php if (!is_single()) : ?>

            <div class="post-footer">
                <span class="post-read-more">
                    <a href="<?php echo esc_url(get_permalink()); ?>"
                       class="btn btn-theme btn-theme-transparent btn-icon-left">
                        <?php echo apply_filters('rentit_readmore_text', esc_html__('Read More','rentit')); ?>
                    </a>
                </span>
            </div>

        <?php endif; ?>

    </article>

<?php } ?>