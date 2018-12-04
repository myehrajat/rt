<?php
$Rent_IT_class = rentit_get_Rent_IT_class();
$terms = get_the_terms($post->ID, 'portfolio_categories');
?>
<div class="thumbnail no-border no-padding">
    <div class="media">
        <img src="<?php $Rent_IT_class->get_post_thumbnail(get_the_ID(), 600, 400); ?>"
             alt="<?php the_title(); ?>">
        <div class="caption hovered">
            <div class="caption-wrapper div-table">
                <div class="caption-inner div-cell">
                    <p class="caption-buttons">
                        <a href="<?php $Rent_IT_class->get_post_thumbnail(get_the_ID(), 600, 400, true); ?>"
                           class="btn caption-zoom" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
                        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn caption-link"><i
                                class="fa fa-link"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="caption">
        <h3 class="caption-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="caption-category">
            <?php
            $j = 0;
            if (!empty($terms)):
                foreach ($terms as $v) {
                    if ($j != 0) {
                        ?> , <?php } ?>
                    <a href="<?php echo esc_url(get_term_link($v->term_id, 'portfolio_categories')); ?> "><?php echo esc_html($v->name); ?></a>
                    <?php
                    $j++;
                }
            endif;
            ?>
        </p>
    </div>
</div>