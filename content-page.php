<article <?php post_class('post-wrap'); ?>>
    <?php if(has_post_thumbnail()): ?>
        <div class="post-media">
            <?php rentit_post_thumbnail(); ?>
        </div>
    <?php endif; ?>
    <?php
    the_content();
    ?>
</article>
