<?php

/**
 * Template Name: Full width page with container
 * Preview:
 *
 */

get_header();

?>
<div class="content-area">
    <div class="container">
        <br>
        <?php
        the_post();
        the_content();
        ?></div>
</div>
<?php
get_footer();
?>
