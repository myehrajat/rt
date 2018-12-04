<?php
/**
 * Template Name: Full width page
 * Preview:
 *
 */
get_header();
?>
    <div class="content-area">
        <?php
        the_post();
        the_content();
        ?>
    </div>
<?php
get_footer();