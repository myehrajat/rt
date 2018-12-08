<?php

add_action( 'wp_head', 'rentit_add_header_fun', 99 );

function rentit_add_header_fun() {
	?>
	<script type="text/javascript">
        <?php
        $s = get_theme_mod( 'map_stylemap_json', '[]' );

	if ( !isset( $s{3} ) ) {
		$glbal_style = "[]";
	} else {
		$glbal_style = $s;
	} ?>

       var global_map_style = <?php echo $glbal_style; ?>;

    </script>
	<?php
}


function renita_remove_style() {

	wp_deregister_style( 'facebook-login' );
}

add_action( 'facebook_login_button', 'renita_remove_style', 99 );


add_action( 'customize_preview_init', 'rentit_custum_color_p', 500 );

/**
 *
 */
function rentit_custum_color_p() {

	if ( strlen( get_theme_mod( 'rentit_content_color' ) ) > 2 && get_theme_mod( 'rentit_content_color' ) != '#000000' ) {
		$OLD_CSS = '
       #contact-form .alert {background-color: #89c144; }
        .spinner > div { background-color: #89c144; height: 100%; width: 20px; display: inline-block; -webkit-animation: stretchdelay 1.2s infinite ease-in-out; animation: stretchdelay 1.2s infinite ease-in-out; } .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 { font-family: \'Raleway\', sans-serif; color: #89c144; } a:not(.btn-theme) { color: #89c144; } .footer a:not(.btn-theme):hover, .footer a:not(.btn-theme):active, .footer a:not(.btn-theme):focus { color: #89c144; } .block-title.alt .fa.color { background-color: #89c144; } .block-title.alt2 .fa.color { background-color: #89c144; } .text-color { color: #89c144; } .drop-cap { display: block; float: left; font-size: 44px; line-height: 37px; margin: 0 10px 0 0; color: #89c144; } blockquote { background-color: #89c144; border: none; color: #ffffff; } .btn-theme { color: #ffffff; border-width: 1px; background-color: #89c144; border-color: #89c144; padding: 13px 20px; font-family: \'Raleway\', sans-serif; font-size: 14px; font-weight: 600; line-height: 1; text-transform: uppercase; -webkit-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out; } .btn-theme-dark:hover { background-color: #89c144; border-color: #89c144; color: #ffffff; } a:hover .btn-play, .btn-play:hover { background-color: #ffffff; color: #89c144; } .content-area.scroll .open-close-area a:hover { background-color: #89c144; } .logo { width: 220px; height: 100px; line-height: 100px; background-color: #89c144; position: absolute; z-index: 999; top: 0; left: 15px; } .navigation ul.social-icons li a:hover { background-color: transparent; color: #89c144; } .sf-menu.nav > li > a:hover:before, .sf-menu.nav > li > a:focus:before { content: \'\'; position: absolute; top: 0; left: 0; height: 5px; width: 100%; background-color: #89c144; } .sf-arrows > li > .sf-with-ul:focus:after, .sf-arrows > li:hover > .sf-with-ul:after, .sf-arrows > .sfHover > .sf-with-ul:after { border-top-color: #89c144; } .sf-arrows ul li > .sf-with-ul:focus:after, .sf-arrows ul li:hover > .sf-with-ul:after, .sf-arrows ul .sfHover > .sf-with-ul:after { border-left-color: #89c144; } .sf-menu li.megamenu ul a:hover { color: #89c144; } .sf-menu li.sale > a:hover, .sf-menu li.sale > a { background-color: #89c144; color: #ffffff; } .full-screen-map .menu-toggle:hover { border-color: #89c144; background-color: #89c144; color: #ffffff; } .sf-menu > li > a:hover { background-color: #ffffff !important; color: #89c144; } .sf-menu li.active > a:hover { color: #89c144 !important; } .sf-menu li.sale > a, .sf-menu li.sale > a:hover { background-color: #89c144 !important; columns: #ffffff !important; } .full-screen-map .sf-menu > li > a:hover { background-color: #ffffff !important; color: #89c144; } .full-screen-map .sf-menu li.active > a:hover { color: #89c144 !important; } .full-screen-map .sf-menu li.sale > a, .full-screen-map .sf-menu li.sale > a:hover { background-color: #89c144 !important; columns: #ffffff !important; } .sign-in-menu li a:hover, .sign-in-menu li.active a { color: #13181c; border-top: solid 5px #89c144; } .main-slider .owl-theme .owl-controls .owl-nav [class*=owl-]:hover { background: #89c144; border-color: #89c144; color: #ffffff; opacity: 1; } .main-slider .btn-theme:hover { border-color: #89c144; background-color: #89c144; color: #ffffff; } .main-slider .ver3 .caption-subtitle { color: #89c144; } .main-slider .ver3 .btn-theme:hover { background-color: #89c144; border-color: #89c144; color: #ffffff; } .main-slider .ver4 .caption-subtitle { color: #89c144; } .main-slider .ver4 .btn-theme:hover { background-color: #89c144; border-color: #89c144; color: #ffffff; } .main-slider .form-search .btn-submit { padding: 15px 50px; background-color: #89c144; border-color: #89c144; color: #ffffff; } .main-slider .form-search.light .row-submit a:hover { color: #89c144; } .coming-soon .main-slider .page .countdown-amount { margin: 0 0 0 0; font-size: 24px; font-weight: 700; line-height: 1; text-transform: uppercase; color: #89c144; } .swiper-container .swiper-pagination-bullet { width: 14px; height: 14px; border: solid 4px #89c144; background-color: transparent; opacity: 1; } .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active { background-color: #89c144; } .pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus { border-color: #89c144; background-color: #89c144; color: #ffffff; } .message-box { padding: 15px; position: relative; text-align: center; background-color: #89c144; color: #ffffff; } .content-tabs .nav-tabs > li.active > a { background-color: #ffffff; border-color: #e9e9e9 #e9e9e9 transparent; border-top: solid 1px #14181c; color: #89c144; } .accordion .panel-title a:hover { color: #89c144; } .post-title a:hover { color: #89c144; } .post-meta a:hover { color: #89c144; } .about-the-author .media-heading a:hover { color: #89c144; } .post-wrap blockquote { padding: 20px 20px 50px 20px; border-top: solid 6px #89c144; background-color: #14181c; position: relative; } .recent-post .media-category { font-size: 16px; font-weight: 900; line-height: 18px; margin-bottom: 7px; color: #89c144; } .recent-post .media-heading a:hover { color: #89c144; } .recent-post .media-link .badge.type { background-color: #89c144; } .widget .recent-post .media-meta a:hover { color: #89c144; } .comment-author a:hover { color: #89c144; } .comment-date .fa { color: #89c144; margin-left: 10px; } .tabs li.active { background-color: #89c144; } .tabs li.active:first-child:before { /*border-right: 25px solid #89c144;*/ } .tabs li.active:last-child:before { border-left: 25px solid #89c144; } .tabs.awesome-sub li.active { background-color: #89c144; color: #ffffff; } .tabs.awesome-sub li.active:before { content: \'\' !important; display: block !important; position: absolute; width: 0; height: 0; border-top: 35px solid transparent; border-left: 35px solid #89c144; border-bottom: 35px solid transparent; border-right: none; left: auto; right: 0; top: 0; margin-right: -35px; z-index: 2; } .caption-title a:hover { color: #89c144; } .thumbnail.thumbnail-banner .btn-theme:hover { background-color: #89c144; border-color: #89c144; } .thumbnail .price ins { padding-right: 5px; text-decoration: none; color: #89c144; } .product-single .reviews:hover, .product-single .add-review:hover { color: #89c144; } .product-single .product-availability strong { color: #89c144; } .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus { background-color: #89c144; } .products.list .thumbnail .reviews:hover { color: #89c144; } .products.list .thumbnail .availability strong { color: #89c144; } .thumbnail.thumbnail-featured.hover, .thumbnail.thumbnail-featured:hover { background: #89c144; } .thumbnail.thumbnail-counto.hover .caption-icon, .thumbnail.thumbnail-counto:hover .caption-icon, .thumbnail.thumbnail-counto.hover .caption-number, .thumbnail.thumbnail-counto:hover .caption-number, .thumbnail.thumbnail-counto.hover .caption-title, .thumbnail.thumbnail-counto:hover .caption-title { color: #89c144; } .car-listing .thumbnail-car-card .caption-title-sub { font-size: 14px; font-weight: 700; padding-left: 30px; padding-right: 30px; padding-bottom: 15px; color: #89c144; } .car-listing .thumbnail-car-card .table td.buttons .btn-theme:hover { border-color: #89c144; background-color: #89c144; } .car-big-card .car-details .title h2 span { color: #89c144; } .car-big-card .car-details .price i { color: #89c144; } .car-big-card .car-details ul li:before { content: \'\f058\'; font-family: \'FontAwesome\'; position: absolute; top: 7px; left: 0; color: #89c144; } .car-big-card .car-thumbnails .swiper-pagination-bullet.swiper-pagination-bullet-active a { border-color: #89c144 !important; } .widget.widget-filter-price #slider-range .ui-widget-header { background-color: #89c144; background-image: none; height: 4px; } .widget.widget-find-car .btn-theme-dark:hover { background-color: #89c144; border-color: #89c144; color: #ffffff; } .widget.widget-shop-deals .countdown-amount { margin: 0 0 0 0; font-size: 15px; font-weight: 700; line-height: 1; text-transform: uppercase; color: #89c144; } .widget.widget-tabs .nav-justified > li.active > a, .widget.widget-tabs .nav-justified > li > a:hover, .widget.widget-tabs .nav-justified > li > a:focus { border-color: #89c144; background-color: #89c144; color: #ffffff; } .widget.widget-tabs.alt .nav-justified > li.active > a:before { content: \'\'; display: block; position: absolute; top: -5px; left: 0; width: 100%; height: 5px; border-top: solid 5px #89c144; } .widget.car-categories ul a:hover { color: #89c144; } .widget-flickr-feed ul a:hover { border-color: #89c144; } .recent-tweets .media .fa { color: #89c144; } .spinner > div { background-color: #89c144} .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 { color: #89c144} a:not(.btn-theme) { color: #89c144} .footer a:not(.btn-theme):hover, .footer a:not(.btn-theme):active, .footer a:not(.btn-theme):focus { color: #89c144} .block-title.alt .fa.color { background-color: #89c144} .block-title.alt2 .fa.color { background-color: #89c144} .text-color { color: #89c144}.drop-cap { color: #89c144}blockquote { background-color: #89c144} .btn-theme { border-color: #89c144} .btn-theme-dark:hover { border-color: #89c144} a:hover .btn-play, .btn-play:hover { color: #89c144} .content-area.scroll .open-close-area a:hover { background-color: #89c144} .logo { background-color: #89c144} .navigation ul.social-icons li a:hover { color: #89c144} .sf-menu.nav > li > a:hover:before, .sf-menu.nav > li > a:focus:before { background-color: #89c144} .sf-arrows > li > .sf-with-ul:focus:after, .sf-arrows > li:hover > .sf-with-ul:after, .sf-arrows > .sfHover > .sf-with-ul:after { border-top-color: #89c144} .sf-arrows ul li > .sf-with-ul:focus:after, .sf-arrows ul li:hover > .sf-with-ul:after, .sf-arrows ul .sfHover > .sf-with-ul:after { border-left-color: #89c144} .sf-menu li.megamenu ul a:hover { color: #89c144} .sf-menu li.sale > a:hover, .sf-menu li.sale > a { background-color: #89c144} .full-screen-map .menu-toggle:hover { background-color: #89c144} .sf-menu > li > a:hover { color: #89c144} .sf-menu li.active > a:hover { color: #89c144 !important}.sf-menu li.sale > a, .sf-menu li.sale > a:hover { background-color: #89c144 !important} .full-screen-map .sf-menu > li > a:hover { color: #89c144} .full-screen-map .sf-menu li.active > a:hover { color: #89c144 !important}.full-screen-map .sf-menu li.sale > a, .full-screen-map .sf-menu li.sale > a:hover { background-color: #89c144 !important} .sign-in-menu li a:hover, .sign-in-menu li.active a { border-top: solid 5px #89c144} .main-slider .owl-theme .owl-controls .owl-nav [class*=owl-]:hover { border-color: #89c144} .main-slider .btn-theme:hover { background-color: #89c144} .main-slider .ver3 .caption-subtitle { color: #89c144} .main-slider .ver3 .btn-theme:hover { border-color: #89c144} .main-slider .ver4 .caption-subtitle { color: #89c144} .main-slider .ver4 .btn-theme:hover { border-color: #89c144} .main-slider .form-search .btn-submit { border-color: #89c144} .main-slider .form-search.light .row-submit a:hover { color: #89c144} .coming-soon .main-slider .page .countdown-amount { color: #89c144} .swiper-container .swiper-pagination-bullet { border: solid 4px #89c144}.swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active { background-color: #89c144} .pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus { background-color: #89c144} .message-box { background-color: #89c144} .content-tabs .nav-tabs > li.active > a { color: #89c144} .accordion .panel-title a:hover { color: #89c144} .post-title a:hover { color: #89c144} .post-meta a:hover { color: #89c144} .about-the-author .media-heading a:hover { color: #89c144} .post-wrap blockquote { border-top: solid 6px #89c144} .recent-post .media-category { color: #89c144} .recent-post .media-heading a:hover { color: #89c144} .recent-post .media-link .badge.type { background-color: #89c144} .widget .recent-post .media-meta a:hover { color: #89c144} .comment-author a:hover { color: #89c144} .comment-date .fa { color: #89c144} .tabs li.active { background-color: #89c144} .tabs li.active:first-child:before { border-right: 25px solid #89c144}.tabs li.active:last-child:before { border-left: 25px solid #89c144} .tabs.awesome-sub li.active { background-color: #89c144}.tabs.awesome-sub li.active:before { border-left: 35px solid #89c144} .caption-title a:hover { color: #89c144} .thumbnail.thumbnail-banner .btn-theme:hover { border-color: #89c144} .thumbnail .price ins { color: #89c144} .product-single .reviews:hover, .product-single .add-review:hover { color: #89c144} .product-single .product-availability strong { color: #89c144} .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus { background-color: #89c144} .products.list .thumbnail .reviews:hover { color: #89c144} .products.list .thumbnail .availability strong { color: #89c144} .thumbnail.thumbnail-featured.hover, .thumbnail.thumbnail-featured:hover { background: #89c144} .thumbnail.thumbnail-counto.hover .caption-icon, .thumbnail.thumbnail-counto:hover .caption-icon, .thumbnail.thumbnail-counto.hover .caption-number, .thumbnail.thumbnail-counto:hover .caption-number, .thumbnail.thumbnail-counto.hover .caption-title, .thumbnail.thumbnail-counto:hover .caption-title { color: #89c144} .car-listing .thumbnail-car-card .caption-title-sub { color: #89c144} .car-listing .thumbnail-car-card .table td.buttons .btn-theme:hover { background-color: #89c144} .car-big-card .car-details .title h2 span { color: #89c144} .car-big-card .car-details .price i { color: #89c144} .car-big-card .car-details ul li:before { color: #89c144} .car-big-card .car-thumbnails .swiper-pagination-bullet.swiper-pagination-bullet-active a { border-color: #89c144 !important} .widget.widget-filter-price #slider-range .ui-widget-header { background-color: #89c144} .widget.widget-find-car .btn-theme-dark:hover { border-color: #89c144} .widget.widget-shop-deals .countdown-amount { color: #89c144} .widget.widget-tabs .nav-justified > li.active > a, .widget.widget-tabs .nav-justified > li > a:hover, .widget.widget-tabs .nav-justified > li > a:focus { background-color: #89c144} .widget.widget-tabs.alt .nav-justified > li.active > a:before { border-top: solid 5px #89c144} .widget.car-categories ul a:hover { color: #89c144} .widget-flickr-feed ul a:hover { border-color: #89c144} .recent-tweets .media .fa { color: #89c144}';
		$new_css = str_replace( '#89c144', sanitize_text_field( get_theme_mod( 'rentit_content_color' ) ), $OLD_CSS );

		update_option( 'rentit_color', ( $new_css ) );

	} else {
		delete_option( 'rentit_color' );
	}


}


/**
 * We print the scripts and styles in the frontend
 */

add_action( 'wp_enqueue_scripts', 'renita_style_scripts', 500 );


/**
 *
 */
function renita_style_scripts() {
	global $wp_customize, $post, $wpdb, $Rent_IT_class;
	/*---------------------css------------------------------------------------*/
	wp_enqueue_style( 'renita_bootstrap.min', get_template_directory_uri() . "/js/bootstrap/css/bootstrap.min.css" );
	wp_enqueue_style( 'renita_bootstrap-select', get_template_directory_uri() . "/js/bootstrap-select/css/bootstrap-select.min.css" );

	/*-- CSS Global --*/
	wp_enqueue_style( 'renita_font-awesome', get_template_directory_uri() . "/js/fontawesome/css/font-awesome.min.css" );
	wp_enqueue_style( 'renita_prettyPhoto', get_template_directory_uri() . "/js/prettyphoto/css/prettyPhoto.css" );
	wp_enqueue_style( 'renita_owl.carousel.min', get_template_directory_uri() . "/js/owl-carousel2/assets/owl.carousel.min.css" );
	wp_enqueue_style( 'renita_owl.theme.default.min', get_template_directory_uri() . "/js/owl-carousel2/assets/owl.theme.default.min.css" );
	wp_enqueue_style( 'renita_animate.min', get_template_directory_uri() . "/js/animate/animate.min.css" );
	wp_enqueue_style( 'renita_swiper.min', get_template_directory_uri() . "/js/swiper/css/swiper.min.css" );
	wp_enqueue_style( 'renita_bootstrap-datetimepicker', get_template_directory_uri() . "/js/datetimepicker/css/bootstrap-datetimepicker.min.css" );

	$bg = get_header_image();;
	if ( isset( $bg{1} ) ) {
		$ncss = ".page-section.breadcrumbs  {  background: url('$bg') 50%  no-repeat !important; 
		 background-size : cover;
   }
		";
		wp_add_inline_style( 'renita_bootstrap-datetimepicker', $ncss );
	}
	$tmrc = get_theme_mod( 'rentit_rlt_control', false );
	if ( $tmrc == true ) {
		wp_enqueue_style( 'renita_bootstrap-rtl', get_template_directory_uri() . "/js/bootstrap/css/bootstrap-rtl.css" );

	}
	/*-- Theme CSS --*/
	if ( get_theme_mod( 'rentit_rlt_control', false ) == true ) {
		wp_enqueue_style( 'renita_theme1', get_template_directory_uri() . "/css/rtl/theme.css" );
	} else {
		wp_enqueue_style( 'renita_theme1', get_template_directory_uri() . "/css/theme.css" );

	}
	$color_control = get_theme_mod( 'Color_them_control_color' );
	if ( !empty( $color_control ) ) {
		if ( get_theme_mod( 'rentit_rlt_control', false ) == true ) {
			wp_enqueue_style( 'renita_theme2', get_template_directory_uri() . "/css/rtl/" . "theme-" . get_theme_mod( 'Color_them_control_color' ) . '.css' );
		} else {
			wp_enqueue_style( 'renita_theme2', get_template_directory_uri() . "/css/" . "theme-" . get_theme_mod( 'Color_them_control_color' ) . '.css' );

		}
	}
	wp_enqueue_style( 'renita_wp', get_stylesheet_directory_uri() . "/style.css" );

	if ( strlen( get_theme_mod( 'rentit_content_color' ) ) > 2 ) {
		if ( strlen( get_option( 'rentit_color' ) ) > 2 ) {
			wp_add_inline_style( 'renita_wp', ( get_option( 'rentit_color' ) ) );
		}
	}
	if ( is_user_logged_in() && !isset( $wp_customize ) ) {
		wp_enqueue_style( 'renita_is_admin', get_template_directory_uri() .
		                                     "/css/is_admin.css" );


	}

	if ( class_exists( 'WC' ) && get_current_user_id() < 1 ) {
		wp_enqueue_style( 'renita_bootstrap-datetimepicker', WC()->plugin_url() . '/assets/css/auth.css' );

	}

	/*-------------------------------------------google fonts -------------------------------------------------------*/
	$m = sanitize_text_field( get_theme_mod( 'fonts_url' ) );
	$f_name = sanitize_text_field( get_theme_mod( 'fonts_name' ) );
	if ( isset( $m{2} ) && strlen( $f_name ) > 3 ) {
		$url = explode( '=', $m );

		wp_enqueue_style( 'rentit_fonts_google_custum1', urldecode( $Rent_IT_class->google_fonts_url( $url[1] ) ) );

		if ( preg_match( '/font-family/', $f_name ) ) {


			$custom_css_f = "h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6 {
               " . str_replace( ";", "", $f_name ) . "   ;
           }";
		} else {
			$custom_css_f = "h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6 {
                 font-family: '" . $f_name . "' ;
           }";
		}

		wp_add_inline_style( 'rentit_fonts_google_custum1', $custom_css_f );
	}

	/*
	 * default fonts
	 */

	$m = sanitize_text_field( get_theme_mod( 'fonts_d_url' ) );
	$f_name = sanitize_text_field( get_theme_mod( 'fonts_d_name' ) );
	if ( isset( $m{2} ) && strlen( $f_name ) > 3 ) {
		$url = explode( '=', $m );

		wp_enqueue_style( 'rentit_fonts_google_custum_d', urldecode( $Rent_IT_class->google_fonts_url( $url[1] ) ) );

		if ( preg_match( '/font-family/', $f_name ) ) {


			$custom_css_f = ' .btn-theme , .navigation .nav.sf-menu , .main-slider .caption-subtitle ,
 .main-slider .ver3 .caption-title , .main-slider .ver4 .caption-title , .main-slider .sub .caption-title ,  .main-slider .sub .caption-subtitle ,
 .recent-post .meta-date , .recent-post .media-link .badge , .tabs li , .thumbnail-banner.alt-font .caption-title , .thumbnail-banner.alt-font .caption-sub-title ,
 .car-big-card .car-details .price strong  {
               ' . str_replace( ";", "", $f_name ) . "   ;
           }";
		} else {
			$custom_css_f = " .btn-theme , .navigation .nav.sf-menu , .main-slider .caption-subtitle ,
 .main-slider .ver3 .caption-title , .main-slider .ver4 .caption-title ,
 .main-slider .sub .caption-title ,  .main-slider .sub .caption-subtitle ,
 .recent-post .meta-date , .recent-post .media-link .badge , .tabs li ,
 .thumbnail-banner.alt-font .caption-title , .thumbnail-banner.alt-font .caption-sub-title ,
 .car-big-card .car-details .price strong  {
                 font-family: '" . $f_name . "' ;
           }";
		}

		wp_add_inline_style( 'rentit_fonts_google_custum_d', $custom_css_f );
	}

	/*
	 * default fonts body
	 */

	$m = sanitize_text_field( get_theme_mod( 'fonts_body_url' ) );
	$f_name = sanitize_text_field( get_theme_mod( 'fonts_body_name' ) );
	if ( isset( $m{2} ) && strlen( $f_name ) > 3 ) {
		$url = explode( '=', $m );

		wp_enqueue_style( 'rentit_fonts_google_custum_d', urldecode( $Rent_IT_class->google_fonts_url( $url[1] ) ) );

		if ( preg_match( '/font-family/', $f_name ) ) {


			$custom_css_f = ' .gm-style , body ,  .main-slider .caption-title , .wishlist td.total a .fa-close:before , .payments-options .panel-title  {
               ' . str_replace( ";", "", $f_name ) . " ;
           }";
		} else {
			$custom_css_f = " .gm-style,  body ,  .main-slider .caption-title , .wishlist td.total a .fa-close:before , .payments-options .panel-title  {
                 font-family: '" . $f_name . "' ;
           }";
		}

		wp_add_inline_style( 'rentit_fonts_google_custum_d', $custom_css_f );
	}
	/*---------------------------------------- JS --------------------------------------------------------------------------*/

	/* /*-- JS Global --*/

	wp_enqueue_script( 'renita_html5shiv', get_template_directory_uri() . '/js/iesupport/html5shiv.js' );
	wp_script_add_data( 'renita_html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'renita_respond', get_template_directory_uri() . '/js/iesupport/respond.min.js' );
	wp_script_add_data( 'renita_respond', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_style( 'renita_jquery-style', get_template_directory_uri() . '/css/jquery-ui.css' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'renita_bootstrap_min_js', get_template_directory_uri() . "/js/bootstrap/js/bootstrap.js", array( 'jquery' ), '1', true );


	$arr_location = array();
	$args = array(
		'showposts' => 10000,
		'post_status' => 'publish',
		'post_type' => 'rental_location',
		'orderby' => 'title',
		'order' => 'ASC'

	);
	unset( $terms );
	$rentit_custom_query = new  WP_Query( $args );
	if ( $rentit_custom_query->have_posts() ):
		while ( $rentit_custom_query->have_posts() ):
			$rentit_custom_query->the_post();
			$arr_location[] = wp_kses_post( get_the_title() );
		endwhile;
		wp_reset_postdata();
	endif;


	// We get the date for the product
	$arrayOfDates = array();
	if ( isset( $post->post_type ) && ( $post->post_type == "product" ) && rentit_plugin_activate() ) {


		$product_id = $post->ID;
		if ( function_exists( 'icl_get_languages' ) ) {
			global $sitepress;
			$default_language = $sitepress->get_default_language();


			$curr_lang = ICL_LANGUAGE_CODE;

			if ($curr_lang != $default_language) {
				$product_id = icl_object_id(get_the_ID(), 'product', false, $default_language);
			}
			else {
				$product_id = get_the_ID();
			}
		}

		if ( (int) get_post_meta( $post->ID, '_stock', 1 ) < 1 ) {
			//get all unix dates
			$res = $wpdb->get_results( $wpdb->prepare(
				"SELECT  dropin_date,dropoff_date FROM  `{$wpdb->prefix}rentit_booking`  WHERE product_id = %d ", $product_id
			) );

			// get date period
			foreach ( $res as $v ) {
				$num_days = floor( $v->dropoff_date - $v->dropin_date ) / ( 60 * 60 * 24 );
				$next_monday = $v->dropin_date;
				for ( $i = 0; $i < $num_days; $i ++ ) {
					$next_day = strtotime( "+" . $i . " day", $next_monday );
					$arrayOfDates[] = date_i18n( "m/d/Y H:m", $next_day );
				}

			}

		}


		$resources = get_post_meta( $product_id, '_rental_unavailable_date', true );

		if ( $resources ) {

			foreach ( $resources as $v ) {

				$num_days = ceil( strtotime( $v['discount_unavailable_date_end'] ) - strtotime( $v['discount_unavailable_date'] ) ) / ( 60 * 60 * 24 );

				$next_monday = strtotime( $v['discount_unavailable_date'] );
				for ( $i = 0; $i < $num_days; $i ++ ) {
					$next_day = strtotime( "+" . $i . " day", $next_monday );
					$arrayOfDates[] = date_i18n( "m/d/Y H:m", $next_day );
				}


			}
		}


	}

	//get map option
	$options2 = explode( ',', get_theme_mod( 'Coordinates_map', '35.126413,33.429858999999965' ) );
	//Coordinates_map
	$zum = (int) get_theme_mod( 'map_zoom_map', '9' );
	$santize_get = array();
	if ( isset( $_GET ) && !empty( $_GET ) ) {
		$santize_get = array_map( 'sanitize_text_field', $_GET );
	}
	$currency_symbol = "";
	if ( function_exists( 'get_woocommerce_currency_symbol' ) ) {

		$currency_symbol = get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) );
	}

	$price_group_arr = array();

	$cats = get_categories( "taxonomy=product_group" );
	if ( count( $cats ) ):
		foreach ( $cats as $cat ) {
			if ( isset( $cat->name ) ) {
				@$price_group_arr[] = @$cat->name;
			}
		}
	endif;
	$terms = "";
	$args = array(
		'numberposts' => 10,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'product',
		'post_status' => 'publish',
		'suppress_filters' => true
	);

	$recent_posts = @wp_get_recent_posts( $args, ARRAY_A );
	foreach ( $recent_posts as $item ) {
		$rentit_lat_long = get_post_meta( $item['ID'], 'rentit_lat_long', true );
		if ( isset( $rentit_lat_long{4} ) ) {
			$last_post_id = $item['ID'];
			$terms = wp_get_post_terms( $last_post_id, 'product_cat' );
			if ( !is_wp_error( $terms ) && isset( $terms[0] ) ) {
				break;
			}


		}
	}

	unset( $recent_posts );
	if ( isset( $last_post_id{0} ) ) {
		$terms = wp_get_post_terms( $last_post_id, 'product_cat' );
	}


	if ( is_wp_error( $terms ) ) {
		unset( $terms );
		$terms = "";
	}

	/*MYEDIT>*/
	//$date_format = get_theme_mod( 'Other_date_format_calendar' );
	$date_format = cal_format;
	/*<MYEDIT*/

	if ( !isset( $date_format{2} ) ) {
		$date_format = 'MM/DD/YYYY H:mm';
	}
	/*MYEDIT>*/
	//$lang = get_theme_mod( 'Other_date_format_lang' );
	$lang = cal_lang;
	/*<MYEDIT*/

	if ( !isset( $lang{1} ) ) {
		$lang = 'en';
	}



	$args = array(
		'theme_url' => esc_url( get_template_directory_uri() ),
		'date_format' => sanitize_text_field( $date_format ),
		'lang' => sanitize_text_field( $lang ),
		'plugin_activate' => rentit_plugin_activate(),
		'plugin_error_message' => esc_html__( 'Error: Activate rentit plugin!', 'rentit' ),
		'themeurl' => esc_url( get_template_directory_uri() ),
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
		'lat' => isset( $options2[0] ) ? $options2[0] : "",
		'longu' => isset( $options2[1] ) ? $options2[1] : "",
		'global_map_style' => trim( get_theme_mod( 'map_stylemap_json', '[]' ) ),

		'zum' => esc_attr( $zum ),
		'location' => $arr_location,
		'price_group' => $price_group_arr,
		'reserved_date' => $arrayOfDates,
		'GET' => $santize_get,
		'currency' => sanitize_text_field( $currency_symbol ),
		'last_cat' => isset( $terms[0]->slug ) ? esc_attr( $terms[0]->slug ) : "",
		'rtl' => esc_html( get_theme_mod( 'rentit_rlt_control', false ) ),
		'currency_pos' => sanitize_text_field( get_option( 'woocommerce_currency_pos' ) )

	);

	wp_localize_script( 'renita_bootstrap_min_js', 'rentit_obj', $args
	);

	wp_enqueue_script( 'renita_bootstrap-select.min', get_template_directory_uri() . "/js/bootstrap-select/js/bootstrap-select.min.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_superfish.min.js', get_template_directory_uri() . "/js/superfish/js/superfish.min.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_prettyPhot', get_template_directory_uri() . "/js/prettyphoto/js/jquery.prettyPhoto.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_owl.carousel.min', get_template_directory_uri() . "/js/owl-carousel2/owl.carousel.min.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_query.sticky.min.js', get_template_directory_uri() . "/js/jquery.sticky.min.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_jquery.easing.min.js', get_template_directory_uri() . "/js/jquery.easing.min.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_smoothscroll.min', get_template_directory_uri() . "/js/jquery.smoothscroll.min.js", array( 'jquery' ), '1', true );

	wp_enqueue_script( 'renita_swiper', get_template_directory_uri() . "/js/swiper/js/swiper.jquery.min.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_moment-with-locales', get_template_directory_uri() . "/js/datetimepicker/js/moment-with-locales.min.js", array( 'jquery' ), '1', true );
	wp_enqueue_script( 'renita_bootstrap-datetimepicker', get_template_directory_uri() . "/js/datetimepicker/js/bootstrap-datetimepicker.min.js", array( 'renita_moment-with-locales' ), '1', true );

	/*-- JS Page Level*/
	wp_enqueue_script( 'renita_theme-ajax-mail', get_template_directory_uri() . "/js/theme-ajax-mail.js", array( 'jquery' ), '1', true );

	wp_enqueue_script( 'renita_theme', get_template_directory_uri() . "/js/theme.js", array( 'renita_bootstrap-datetimepicker' ), '1', true );

	wp_enqueue_script( 'renita_main', get_template_directory_uri() . "/js/main.js", array( 'renita_bootstrap-datetimepicker' ), '1', true );


	wp_enqueue_script( 'renita_clustern', get_template_directory_uri() . "/js/clustern.js", array( 'jquery' ), '1', true );

	wp_enqueue_script( 'renita_map_int', get_template_directory_uri() . "/js/map_init.js", array( 'renita_clustern' ), '1', true );

	wp_enqueue_script( 'rentit_maps_googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCsbzuJDUEOoq-jS1HO-LUXW4qo0gW9FNs&libraries=places&callback=initialize_map',
		array( 'jquery' ), 3, true );
	wp_enqueue_script( 'renita_bootstrap-typeahead', get_template_directory_uri() . "/js/bootstrap-typeahead.js", array( 'renita_clustern' ), '1', true );


	wp_enqueue_script( 'renita_countdown_jquery', get_template_directory_uri() . "/js/countdown/jquery.plugin.min.js", array( 'renita_clustern' ), '1', true );

	wp_enqueue_script( 'renita_vjquery.countdown.min.js', get_template_directory_uri() . "/js/countdown/jquery.countdown.min.js", array( 'renita_clustern' ), '1', true );

	$qvt = get_query_var( 'taxonomy' );
	$tax = ( !empty( $qvt ) ) ? $qvt : "";

	//if ( $tax == "portfolio_categories" || ( get_query_var( "post_type" ) == "portfolio" ) ) {
	wp_enqueue_script( 'renita_jquery.isotope.min.js', get_template_directory_uri() . "/js/jquery.isotope.min.js", array( 'renita_bootstrap-datetimepicker' ), '1', true );
	//}


}


//init scripts and style


/**
 * init admin scripts and style
 */
function renita_style_scripts_admin( $hook ) {
	//Geocoding google
	global $post;

	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
		if ( 'product' === $post->post_type ) {
			wp_enqueue_script( 'rentit_googleapis_js_places', "https://maps.googleapis.com/maps/api/js?key=AIzaSyCsbzuJDUEOoq-jS1HO-LUXW4qo0gW9FNs&libraries=places&callback=initialize_map", array( 'jquery' ), false, true );
		}
	}

	wp_enqueue_style( 'renita_admin_metabox', get_template_directory_uri() .
	                                          "/css/admin/admin.css" );
	wp_enqueue_style( 'renita_font-awesome', get_template_directory_uri() . "/js/fontawesome/css/font-awesome.min.css" );

}

add_action( 'admin_enqueue_scripts', 'renita_style_scripts_admin' );

