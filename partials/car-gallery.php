<?php
/**
 * Car gallery
 * User: Pro
 * Date: 08.01.2016
 * Time: 13:23
 */
$Rent_IT_class = rentit_get_Rent_IT_class();
$image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
$image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
$image_link = wp_get_attachment_url(get_post_thumbnail_id());
$image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array(
    'title' => $image_title,
    'alt' => $image_title
));
?>
<div class="col-md-8">
    <div class="owl-carousel img-carousel">
        <div class="item">
            <a class="btn btn-zoom"
               href="<?php echo esc_url($image_link); ?>"
               data-gal="prettyPhoto">
                <i class="fa fa-arrows-h"></i></a>
            <a href="<?php echo esc_url($image_link); ?>"
               data-gal="prettyPhoto">
                <img class="img-responsive"
                     src="<?php echo esc_url(
                         $Rent_IT_class->trim_img_by_url($image_link, 600, 426)
                     ); ?>"
                     alt=""/>
            </a>
        </div>
        <?php
        $arr_image_gallery = explode(',', get_post_meta($post->ID, '_product_image_gallery', true));
        $j = 0;
        if( isset($arr_image_gallery[0]{0})) {
            foreach ($arr_image_gallery as $img_id) {
                $image_attributes = wp_get_attachment_image_src($img_id, 'full');
                ?>
                <div class="item">
                    <a class="btn btn-zoom"
                       href="<?php echo esc_url($image_attributes[0]); ?>"
                       data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                    <a href="<?php echo esc_url($image_attributes[0]); ?>"
                       data-gal="prettyPhoto">
                        <img class="img-responsive"
                             src="<?php echo esc_url(
                                 $Rent_IT_class->trim_img_by_url($image_attributes[0], 600, 426)
                             ); ?>"
                             alt=""/></a>
                </div>
                <?php
                $j++;
            }
        }


        ?>
    </div>
    <?php if ($j >= 1) { ?>
        <div class="row car-thumbnails">

            <div class="col-xs-2 col-sm-2 col-md-3">
                <a href="#"
                   onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0,300]);">
                    <img
                        src="<?php echo esc_url($Rent_IT_class->trim_img_by_url($image_link, 70, 70)); ?>"
                        alt="<?php the_title(); ?>"/>
                </a>
            </div>
            <?php
            //echo "88888888888888888888_";
            $arr_image_gallery = explode(',', get_post_meta($post->ID, '_product_image_gallery', true));
            //ar_dump($arr_image_gallery);
           if( isset($arr_image_gallery[0]{0})) {
               $j = 1;
               $n =0;
               foreach ($arr_image_gallery as $img_id) {
                   if($n >= 5) continue;
                   $image_attributes = wp_get_attachment_image_src($img_id, 'full');
                   ?>
                   <div class="col-xs-2 col-sm-2 col-md-3">
                       <a href="#"
                          onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [<?php echo esc_attr($j) ?>,300]);">
                           <img
                               src="<?php echo esc_url(
                                   $Rent_IT_class->trim_img_by_url($image_attributes[0], 70, 70));
                               ?>" alt="<?php the_title(); ?>"/></a>
                   </div>
                   <?php
                   $j++;
                   $n++;
               }
           }
            ?>
        </div>
    <?php } ?>
</div>