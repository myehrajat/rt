<!-- SIDEBAR -->
<aside class="col-md-3 sidebar" id="sidebar">
    <?php
    if(!is_page()) {
        @dynamic_sidebar('rentit_sidebar');
    }else {
        @dynamic_sidebar('rentit_sidebar_page');
    }
    ?>
</aside>
<!-- /SIDEBAR -->