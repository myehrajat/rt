<?php
ini_set( 'zlib.output_handler', '' );
ini_set( 'zlib.output_compression', 0 );
ini_set( 'output_handler', '' );
ini_set( 'output_buffering', false );
ini_set( 'implicit_flush', true );


define( 'rentit_INC', get_template_directory_uri() . '/inc' );
define( 'rentit_LIB', get_template_directory_uri() . '/inc/library' );
define( 'rentit_CSS', get_template_directory_uri() . '/css' );
define( 'rentit_JS', get_template_directory_uri() . '/js' );
define( 'rentit_ASSETS', get_template_directory_uri() . '/assets' );

add_filter( 'loop_shop_per_page', 'rentit_limited_dunc', 20 );


function rentit_limited_dunc() {

	$posts_per_page = (int) sanitize_text_field( get_option( 'posts_per_page' ) );

	if ( get_theme_mod( 'rentit_shop_view_per_page' ) > 0 ) {
		$posts_per_page = get_theme_mod( 'rentit_shop_view_per_page' );
	}

	if ( get_theme_mod( 'rentit_shop_view_all_products' ) == true ) {
		$posts_per_page = 1000;
	}

	return $posts_per_page;
}


/**
 * Class rentit
 */
class Rent_IT_class {
	public function __construct() {
		// Include required files
		$this->includes();
		/**
		 * Hooks
		 */
		//live edit
		add_action( 'init', array( $this, 'rentit_init_site' ) );
		add_action( 'wp_head', array( $this, 'rentit_buffer_start' ) );
		add_action( 'wp_head', array( $this, 'rentit_theme_slug_render_title' ) );
		add_action( 'wp_footer', array( $this, 'rentit_buffer_end' ) );
		// widgets
		add_action( 'widgets_init', array( $this, 'rentit_arphabet_widgets_init' ) );
		add_action( 'after_setup_theme', array( $this, 'rentit_crucial_setup' ) );
		add_action( 'current_screen', array( $this, 'rentit_my_theme_add_editor_styles' ) );
		//update key in ttshowcase
		add_action( 'save_post', array( $this, 'rentit_add_ttshowcase_post' ) );
		/**
		 * filters
		 * */
		add_filter( 'body_class', array( $this, 'rentit_add_body_class' ) );
		add_filter( 'bp_get_add_friend_button', array( $this, 'rentit_my_add_friend_link_text' ) );
		add_filter( 'the_category', array( $this, 'the_category_filter' ) );
		add_filter( 'term_description', array( $this, 'rentit_clear_term_description_image_shortcode' ) );
		add_filter( 'preprocess_comment', array( $this, 'rentit_check_coments' ) );
		add_filter( 'wp_title', array( $this, 'rentit_title_2' ), 900 );
		add_filter( 'get_the_excerpt', array( $this, 'rentit_cutoff_the_excerpt' ), 900 );
		add_filter( 'the_content', array( $this, 'remove_gallery_from_portfolio' ) );
		add_filter( 'next_post_link', array( $this, 'posts_link_next_class' ) );
		add_filter( 'previous_post_link', array( $this, 'posts_link_prev_class' ) );
		add_filter( 'generate_rewrite_rules', array( $this, 'taxonomy_slug_rewrite' ) );
		add_filter( 'rentit_readmore_text', array( $this, 'rentit_readmore_text' ) );
		add_filter( 'rentit_rentit_text', array( $this, 'rentit_rentit_text' ) );

		//theme support
		$this->theme_support_setting();
	}

	/**
	 * theme support setting
	 */
	function theme_support_setting() {
		//add_theme_support('custom-background');
		add_theme_support( "title-tag" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( "custom-header", array() );
		add_theme_support( 'post-thumbnails' );
		// Add default posts and comments RSS feed links to head.

		// Support for Woocommerce
		add_theme_support( 'woocommerce' );;
		add_post_type_support( 'places', array( 'comments' ) );
		add_image_size( "rentit_panorama", 1111, 400, true );
		add_image_size( "rentit_square200", 200, 200, true );
		add_image_size( "rentit_squarex320x201", 320, 201, true );
		add_image_size( "rentit-image-370x230-croped", 370, 230, true );
		set_post_thumbnail_size( 1111, 400, true );
		register_nav_menus(
			array(
				'rentit_topmenu' => esc_html__( 'Header menu', "rentit" ),

			)
		);

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat'
		) );
	}

	/**
	 * require files and function
	 */
	function includes() {
		//# Part 1. Includes

		require get_template_directory() . '/assets/BFI_Thumb.php';

		if ( function_exists( 'get_theme_file_path' ) ) {
			require get_theme_file_path( '/assets/widgets.php' );
		} else {
			require get_template_directory() . '/assets/widgets.php';
		}

		require get_template_directory() . '/assets/mailchimp.php';
		require get_template_directory() . '/assets/customizer.php';
		require get_template_directory() . '/assets/style_scripts.php';
		require get_template_directory() . '/assets/metaboxes.php';
		require get_template_directory() . '/assets/coment_walker.php';
		require get_template_directory() . '/assets/page_map_get_marker.php';
		require get_template_directory() . '/assets/return_html.php';
		require get_template_directory() . '/assets/mega_menu.php';
		require get_template_directory() . '/assets/ajax_load-map-cars.php';
		require get_template_directory() . '/assets/ajax-post.php';
		require get_template_directory() . '/assets/ajax-sent-mail.php';
		require get_template_directory() . '/assets/tgm.php';
		require get_template_directory() . '/assets/ajax-orders.php';
		require get_template_directory() . '/inc/woocommerce-hooks.php';
		require get_template_directory() . '/inc/rentit-booking/init.php';
		require get_template_directory() . '/inc/widgets/init.php';


	}

	/************************************************************
	 *                           Hooks Action
	 ************************************************************/
	function rentit_init_site() {
		if ( get_theme_mod( 'rentit_COMING_SOON_close', false ) && get_current_user_id() < 1 ) {
			if ( !preg_match( '#wp-admin#', $_SERVER["REQUEST_URI"] ) and !preg_match( '#wp-login.php#', $_SERVER["REQUEST_URI"] ) ) {
				die( get_template_part( 'template-coming-soon' ) );
			}
		}

	}

	/**
	 * Live edit on site
	 *
	 * @param $buffer
	 *
	 * @return mixed
	 */
	function rentit_replace_edited_section( $buffer ) {
		$all_options = wp_load_alloptions();
		$my_options = array();
		foreach ( $all_options as $name => $value ) {
			if ( strstr( $name, 'edited_' ) ) {
				$buffer = preg_replace( "#id='" . $name . "'.*?>([^<]*?)<#", "id='" . $name .
				                                                             "' data-original='$1'>" . $value . "<", $buffer );
				$buffer = preg_replace( "#id='" . $name . "'>([^<]*?)<#", "id='" . $name . "' data-original='$1'>" .
				                                                          $value . "<", $buffer );
			}
		}
		$buffer = preg_replace( "#body.custom-background { background-image: url\('(.*?)'\)#",
			".custom-background { background-image: url('$1')!important", $buffer );
		//if (!current_user_can("administrator")){
		$buffer = preg_replace( "#\[fa(.*?)\]#", '<i class="fa fa$1"></i>', $buffer );
		//}
		$buffer = str_replace( '<table id="wp-calendar">',
			'<table id="wp-calendar" class="table" >', $buffer );
		$buffer = str_replace( 'F !important; }</style>);</script>', 'F !important; }</style>");</script>', $buffer ); //slider revolution small bug fix
		$buffer = str_replace( 'F !important; }</style>);</script>', 'F !important; }</style>");</script>', $buffer ); //slider revolution small bug fix
		$buffer = str_replace( 'Wordpress', 'WordPress', $buffer );
		$buffer = str_replace( array( '[vc_column_text]', '[/vc_column_text]' ), array( '', '' ), $buffer );

		if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) { //HTTPS
			$buffer = str_replace( 'http://', 'https://', $buffer );
		}

		return $buffer;
	}

	/**
	 *buffer start
	 */
	function rentit_buffer_start() {
		ob_start( array( $this, "rentit_replace_edited_section" ) );
	}

	/**
	 *buffer end
	 */
	function rentit_buffer_end() {
		@ob_end_flush();
	}

	function rentit_theme_slug_render_title() {
		if ( !function_exists( '_wp_render_title_tag' ) ) {
			?>
            <title><?php wp_title( '|', true, 'right' ); ?></title>
			<?php
		}
	}
	/**
	 * Cut shortcodes
	 *
	 * @param string $param preg replace
	 *
	 * @return mixed
	 */
	/**
	 *Register fields for widgets
	 */
	function rentit_arphabet_widgets_init() {
		register_sidebar( array(
			'name' => esc_html__( 'sidebar', "rentit" ),
			'id' => 'rentit_sidebar',
			'before_widget' => '<aside id="%1$s" class="widget shadow rentit_card-widget %2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1><div class="widget-content">',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'sidebar shop', "rentit" ),
			'id' => 'rentit_sidebar_shop',
			'before_widget' => '<aside id="%1$s" class="widget shadow rentit_card-widget %2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1><div class="widget-content">',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'sidebar booking ', "rentit" ),
			'id' => 'rentit_sidebar_booking',
			'before_widget' => '<aside id="%1$s" class="widget shadow rentit_card-widget %2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1><div class="widget-content">',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'sidebar page', "rentit" ),
			'id' => 'rentit_sidebar_page',
			'before_widget' => '<aside id="%1$s" class="widget shadow rentit_card-widget %2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1><div class="widget-content">',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Footer area', "rentit" ),
			'id' => 'rentit_footer',
			'before_widget' => '<div class="col-md-3"><div class="widget">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4 class="widget-title">',
		) );
	}

	/**
	 * Specify the domain for translation
	 *
	 * language translator for rentit
	 */
	function rentit_crucial_setup() {
		load_theme_textdomain( 'rentit', get_template_directory() . '/languages' );
		add_theme_support( 'woocommerce' );
	}

	/**
	 * add editor styles
	 */
	function rentit_my_theme_add_editor_styles() {
		add_editor_style( 'editor_styles.css' );
	}
	/************************************************************
	 *                           Filters
	 ************************************************************/
	/**
	 * add custom body class
	 *
	 * @param string $classes
	 *
	 * @return array
	 */
	function rentit_add_body_class( $classes ) {
		global $post;
		if ( isset( $post ) ) {
			$classes[] = $post->post_type . '-' . $post->post_name;
			if ( $this->rentit_request_url() == home_url( '/' ) && get_theme_mod( 'home_effects_effect', true ) == true ) {
				$classes[] = 'home_page';
			}
			if ( get_post_meta( $post->ID, 'rentit_hide_header', false ) ) {
				$classes[] = " small_header ";
			}
		}
		$rentit_user_info = sanitize_text_field( get_theme_mod( 'site_Identity_layout', 's1' ) );
		$classes[] = " wide";

		return sanitize_html_class( $classes );
	}

	/**
	 * @param $button
	 *
	 * @return mixed
	 */
	function rentit_my_add_friend_link_text( $button ) {
		$button['link_class'] .= " btn btn-primary";

		return $button;
	}

	/**
	 *  replace the [fa]
	 *
	 * @param $cats
	 *
	 * @return string
	 */
	public
	function the_category_filter(
		$cats
	) {
		$item = $cats;
		preg_match_all( "#\[fa(.*?)\]#", $item, $arr );
		if ( isset( $arr[1][0] ) ) {
			foreach ( $arr[1] as $new_arr ) {
				$item = str_replace( "[fa" . $new_arr . "]", '', $item );
			}
		}

		return sanitize_text_field( $item );
	}

	/**
	 * @param $value
	 *
	 * @return mixed
	 */
	function rentit_clear_term_description_image_shortcode( $value ) {
		$out = str_replace( "<p>", "", $value );

		return str_replace( "</p>", "", $out );
	}

	/**
	 * Function limits for comments to 200 characters, and check for empty and cut all tags ntml
	 *
	 * @param string $commentdata array of comments
	 *
	 * @return mixed
	 */
	function rentit_check_coments( $commentdata ) {
		$coment = preg_replace( "/<.*?>/", "", $commentdata['comment_content'] );
		if ( strlen( $coment ) < 1 ) {
			wp_die( esc_html__( 'Comment is empty', 'rentit' ) );
			exit;
		}
		if ( strlen( $coment ) > 200 ) {
			wp_die( esc_html__( 'Comment more than 200 characters', 'rentit' ) );
			exit;
		}

		return $commentdata;
	}

	/**
	 * Adds the id of the current locations in key _insert post which is associated with  ttshowca     post
	 *
	 * @param int $post_id
	 */
	function rentit_add_ttshowcase_post( $post_id ) {
		if ( ( get_post_type( $post_id ) == 'ttshowcase' ) && isset( $_COOKIE['rentit_post_id'] ) ) {
			add_post_meta( $post_id, '_insetr_post', sanitize_text_field( $GLOBALS["rentit_post_ID"] ) );
			update_post_meta( $post_id, '_insetr_post', sanitize_text_field( @$_COOKIE['rentit_post_id'] ) );
		}
	}

	/**
	 * Cut the Title shortcodes
	 *
	 * @param $title
	 *
	 * @return mixed
	 */
	function rentit_title_2( $title ) {
		return sanitize_text_field( preg_replace( "#\[fa(.*?)\]#", '', $title ) );
	}

	function rentit_cutoff_the_excerpt( $text ) {
		$out = $text;
		$out = iconv_substr( $out, 0, 220, 'utf-8' );

		return preg_replace( '@(.*)\s[^\s]*$@s', '\\1 ...', $out );
	}

	/**
	 * remove shortcode gallery from post
	 *
	 * @param $content
	 *
	 * @return mixed
	 */
	function remove_gallery_from_portfolio( $content ) {
		global $post;
		if ( isset( $post->post_type ) && $post->post_type == 'portfolio' ) {
			$content = preg_replace( '/\[gallery.*?\]/', '', $content );
		}

		return $content;
	}

	/**
	 * add class to posts_link_next
	 *
	 * @param $format
	 *
	 * @return mixed
	 */
	function posts_link_next_class( $format ) {
		$format = str_replace( 'href=', 'class="btn btn-theme btn-theme-transparent pull-right btn-icon-right" href=', $format );

		return $format;
	}

	/**
	 * add class to link prev
	 *
	 * @param $format
	 *
	 * @return mixed
	 */
	function posts_link_prev_class( $format ) {
		$format = str_replace( 'href=', 'class="btn btn-theme btn-theme-transparent pull-left btn-icon-left" href=', $format );

		return $format;
	}

	/**
	 * rewrite rules to portfolio cats
	 *
	 * @param $wp_rewrite
	 */
	function taxonomy_slug_rewrite( $wp_rewrite ) {
		$rules = array();
		// get all custom taxonomies
		$taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
		// get all custom post types
		$post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
		foreach ( $post_types as $post_type ) {
			foreach ( $taxonomies as $taxonomy ) {
				// go through all post types which this taxonomy is assigned to
				foreach ( $taxonomy->object_type as $object_type ) {
					// check if taxonomy is registered for this custom type
					if ( $object_type == $post_type->rewrite['slug'] ) {
						// get category objects
						$terms = get_categories( array(
							'type' => $object_type,
							'taxonomy' => $taxonomy->name,
							'hide_empty' => 0
						) );
						// make rules
						foreach ( $terms as $term ) {
							$rules[$object_type . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
						}
					}
				}
			}
		}
		// merge with global rules
		$wp_rewrite->rules = $rules + $wp_rewrite->rules;
	}

	/** return new text
	 *
	 * @param $text
	 *
	 * @return string
	 */
	function rentit_readmore_text( $text ) {
		return get_theme_mod( 'rentit_blog_list_read_more', esc_html__( 'Read More', 'rentit' ) );
	}

	function rentit_rentit_text( $text ) {
		return get_theme_mod( 'rentit_shop_other_renit_text', esc_html__( 'Rent It', 'rentit' ) );
	}
	/************************************************************
	 *                          Metods
	 ************************************************************/
	/**
	 * Performs sql query and RETURN it
	 *
	 * @param string $sql
	 *
	 * @return mixed
	 */
	public
	static function rentit_q(
		$sql
	) {
		global $wpdb;
		$wpdb->hide_errors();

		return $wpdb->query( $sql );
	}
	/**
	 * @param $filter
	 *
	 * @return mixed
	 */
//cuts JS code
	function rentit_esc_js( $filter ) {
		return preg_replace( '/<script.*?<\/script>/', '', $filter );
	}

	/**
	 * @param $maxchar
	 */
	function truncate_str( $maxchar ) { //Specifies the number of characters
		$out = get_the_excerpt();
		$out = iconv_substr( $out, 0, $maxchar, 'utf-8' );
		$out = preg_replace( '@(.*)\s[^\s]*$@s', '\\1 ', $out );
		echo wp_kses_post( $out );
	}

	/**
	 * @return string
	 */
	function rentit_container_class() {
		$mod = get_theme_mod( "site_Identity_layout", 's2' );
		if ( $mod == "s2" ) {
			return "container-fluid container-fluid_pad_off";
		}

		return "container";
	}
	/****************************************************
	 *                  Helper methods
	 * **************************************************
	 */
	/**
	 * replace the [fa] to <i class="fa fa></i>
	 *
	 * @param $item
	 *
	 * @return string
	 */
	function icon_converter( $item, $count = false ) {
		$i = 0;
		preg_match_all( "#\[fa(.*?)\]#", $item, $arr );
		if ( isset( $arr[1][0] ) ) {
			foreach ( $arr[1] as $new_arr ) {
				$i ++;
				$item = str_replace( "[fa" . $new_arr . "]", ' <i class="fa fa' . $new_arr .
				                                             '"></i> ', $item . $i );
			}
		}

		return $item;
	}

	/**
	 * @return array empty id of places
	 */
	function get_empty_places() {
		global $wpdb;
		$empty_post = $wpdb->get_results( $wpdb->prepare(
			"SELECT ID FROM `$wpdb->posts` WHERE `post_title` = %s OR `post_title` = %s ",
			esc_html__( 'Enter the place name', "rentit" ),
			''
		) );
		$empty_post_id = array();
		//get empty posts
		foreach ( $empty_post as $item ) {
			$empty_post_id[] = esc_html( $item->ID );
		}

		return $empty_post_id;
	}

	/**
	 *Check for the existence of posts on the second page
	 *
	 * @param $args
	 *
	 * @return bool
	 */
	function check_post_in_second_page( $args ) {
		$args['paged'] = 2;
		$c_query = new WP_Query( $args );
		if ( $c_query->post_count > 0 ) {
			$return = true;
		} else {
			$return = false;
		}
		wp_reset_postdata();

		return $return;
	}

	/**
	 * return number of cats in category
	 * @return int|void
	 */
	function ajax_get_the_category() {
		$category = get_category( get_query_var( 'cat' ) );
		$rentit_cat = (int) $category->cat_ID;
		$count = (int) $category->count;
		if ( isset( $wp_query->query["pagename"] ) ) {
			if ( $wp_query->query["pagename"] == 'blogfeed' ) {
				return 0;
			} else {
				return $cat;
			}
		} else {
			return $cat;
		}
	}

	/**
	 * Prepares correct the url to google font
	 *
	 * @param $fonts_param
	 *
	 * @return string url google fonts
	 */
	function google_fonts_url( $fonts_param ) {
		$font_url = '';
		/*
        Translators: If there are characters in your language that are not supported
        by chosen font(s), translate this to 'off'. Do not translate into your own language.
         */
		if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'rentit' ) ) {
			$font_url = add_query_arg( 'family', urlencode( $fonts_param ), "//fonts.googleapis.com/css" );
		}
		$font_url = str_replace( '%2B', '+', $font_url );

		return $font_url;
	}

	function get_pots_image_url() {
		$thumbnail = get_the_post_thumbnail( get_the_id(), 'panorama' );
		preg_match_all( '#src="(.*?)"#si', $thumbnail, $thumb_url );
		if ( isset( $thumb_url[1][0] ) ) {
			return esc_url( $thumb_url[1][0] );
		} else {
			return false;
		}
	}

	/**
	 * @param $string
	 * @param bool|false $return
	 *
	 * @return string
	 */
	function get_fa_icons( $string, $return = false ) {
		preg_match_all( "#\[fa(.*?)\]#", $string, $arr );
		if ( isset( $arr[1][0] ) ) {
			$item = str_replace( "[fa" . $arr[1][0] . "]", ' <i class="fa fa' . $arr[1][0] .
			                                               '"></i> ', $string );
		} else {
			$item = $string;
		}
		$allowed_html = array( 'i' => array( 'class' => array() ) );
		if ( $return == false ) {
			echo wp_kses( $item, $allowed_html );
		} else {
			return wp_kses( $item, $allowed_html );
		}
	}

	/**
	 * @param null $theid
	 * @param int $widht
	 * @param int $height
	 * @param bool|false $big_src if is true the get full img
	 * @param bool|true $default if there is no plug pictures
	 * @param bool|false $return
	 *
	 * @return string url new img
	 */
	function get_post_thumbnail( $theid = null, $widht = 848, $height = 360, $big_src = false, $default = true, $return = false ) {
		if ( $theid == null ) {
			$theid = get_the_ID();
		}
		$thumbnail = get_the_post_thumbnail( $theid, 'full' );
		preg_match_all( '#src="(.*?)"#si', $thumbnail, $thumb_url );
		$thumb = "";
		$params = array( 'width' => $widht, 'height' => $height, 'crop' => true );
		if ( isset( $thumb_url[1][0] ) ) {
			$thumb = esc_url( $thumb_url[1][0] );
		} elseif ( $default ) {
			$thumb = get_template_directory_uri() . '/img/preview/cars/car-370x220x1.jpg';
		}
		if ( $big_src ) {
			if ( $return ) {
				return esc_url( $thumb );
			} else {
				echo esc_url( $thumb );
			}
		} else {
			if ( $return ) {
				return esc_url( bfi_thumb( $thumb, $params ) );
			} else {
				echo esc_url( bfi_thumb( $thumb, $params ) );
			}
		}
	}

	/**
	 * method return new size img
	 *
	 * @param int $widht
	 * @param int $height
	 *
	 * @return string
	 */
	function trim_img_by_url( $thumb, $widht = 848, $height = 400 ) {
		$params = array( 'width' => $widht, 'height' => $height, 'crop' => true );

		return esc_url( bfi_thumb( $thumb, $params ) );
	}

	/**
	 * @param string $before
	 * @param string $after
	 * @param bool|true $echo
	 * @param array $args
	 * @param null $wp_query
	 *
	 * @return int|string pagination in categorias
	 */
	function renita_pagenavi( $max_page = false, $before = '', $after = '', $echo = true, $args = array(), $wp_query = null ) {
		if ( !$wp_query ) {
			global $wp_query;
		}
		// the default settings
		$default_args = array(
			'text_num_page' => '',
			// Text before pagination. {current} - current; {last} - last (pr. 'Page {current} of {last}' get 'Page 4 of 60 ")
			'num_pages' => 10,
			// how many links to display
			'step_link' => 10,
			// Links increments (value - the number, the step size (at. 1,2,3 ... 10,20,30). Put 0 if such references are not needed.
			'dotright_text' => '',
			// intermediate text "to".
			'dotright_text2' => '',
			//intermediate text "after."
			'back_text' => '<i class="fa fa-angle-double-left"></i> ' . esc_html__( 'Previous', 'rentit' ),
			// text "go to the previous page." Put 0 if this reference is not needed
			'next_text' => esc_html__( 'Next', 'rentit' ) . ' <i class="fa fa-angle-double-right"></i>',
			// text "go to the next page." Put 0 if this reference is not needed.
			'first_page_text' => 0,
			// text "to the first page." Put 0 if instead of text you need to show a page number.
			'last_page_text' => 0,
			// text "to the last page." Put 0 if instead of text you need to show a page number.
		);
		$default_args = apply_filters( 'rentit_pagenavi_args', $default_args ); //to be able to establish their default values
		$args = array_merge( $default_args, $args );
		extract( $args );
		$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
		$paged = (int) $wp_query->query_vars['paged'];
		if ( $max_page == false ) {
			$max_page = $wp_query->max_num_pages;
		}
		//check the need for navigation
		if ( $max_page <= 1 ) {
			return false;
		}
		if ( empty( $paged ) || $paged == 0 ) {
			$paged = 1;
		}
		$pages_to_show = intval( $num_pages );
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor( $pages_to_show_minus_1 / 2 ); // how many links to the current page
		$half_page_end = ceil( $pages_to_show_minus_1 / 2 ); // how many links after current page
		$start_page = $paged - $half_page_start; //first page
		$end_page = $paged + $half_page_end; // the last page (conditionally)
		if ( $start_page <= 0 ) {
			$start_page = 1;
		}
		if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if ( $end_page > $max_page ) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = (int) $max_page;
		}
		if ( $start_page <= 0 ) {
			$start_page = 1;
		}
		// display navigation
		$out = '';
		// Create a base to cause get_pagenum_link once
		$link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );
		$first_url = get_pagenum_link( 1 );
		if ( false === strpos( $first_url, '?' ) ) {
			$first_url = user_trailingslashit( $first_url );
		}
		$out .= $before . "<ul class='pagination'>\n";
		if ( $text_num_page ) {
			$text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
			$out .= sprintf( "<li><span class='pages'>$text_num_page</span></li> ", $paged, $max_page );
		}
		// ago
		if ( $back_text && $paged != 1 ) {
			$out .= '<li><a class="prev" href="' . ( ( $paged - 1 ) == 1 ? $first_url : str_replace( '___', ( $paged - 1 ), $link_base ) ) . '">' . $back_text . '</li></a> ';
		} else {
			$out .= '<li class="disabled"><a>' . $back_text . '</li></a> ';
		}
		// to the begining
		if ( $start_page >= 2 && $pages_to_show < $max_page ) {
			$out .= '<li><a class="first" href="' . $first_url . '">' . ( $first_page_text ? $first_page_text : 1 ) . '</li></a> ';
			if ( $dotright_text && $start_page != 2 ) {
				$out .= '<li><span class="extend">' . $dotright_text . '</span> </li>';
			}
		}
		// pagination
		for ( $i = $start_page; $i <= $end_page; $i ++ ) {
			if ( $i == $paged ) {
				$out .= '<li class="active">' . '<a href="#">' . $i . ' <span class="sr-only">(current)</span></a>' . '</li> ';
			} elseif ( $i == 1 ) {
				$out .= '<li><a href="' . $first_url . '">1</li></a> ';
			} else {
				$out .= '<li><a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</li></a> ';
			}
		}
		// links increments
		$dd = 0;
		if ( $step_link && $end_page < $max_page ) {
			for ( $i = $end_page + 1; $i <= $max_page; $i ++ ) {
				if ( $i % $step_link == 0 && $i !== $num_pages ) {
					if ( ++ $dd == 1 ) {
						$out .= '<span class="extend">' . $dotright_text2 . '</span> ';
					}
					$out .= '<li><a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</li></a> ';
				}
			}
		}
		// In the end
		if ( $end_page < $max_page ) {
			if ( $dotright_text && $end_page != ( $max_page - 1 ) ) {
				$out .= '<span class="extend">' . $dotright_text2 . '</span> ';
			}
			$out .= '<li><a class="last" href="' . str_replace( '___', $max_page, $link_base ) . '">' . ( $last_page_text ? $last_page_text : $max_page ) . '</li></a> ';
		}
		// forward
		if ( $next_text && $paged != $end_page ) {
			$out .= '<li><a class="next" href="' . str_replace( '___', ( $paged + 1 ), $link_base ) . '">' . $next_text . '</li></a> ';
		} else {
			$out .= '<li class="disabled"><a class="next" href="' . '">' . $next_text . '</li></a> ';
		}
		$out .= "</ul>" . $after . "\n";
		$out = apply_filters( 'kama_pagenavi', $out );
		if ( $echo ) {
			return print $out;
		}

		return $out;
	}


	function get_url_img_avatar( $user_ID, $width = 128, $height = 128, $class = "", $return = false ) {
		$params = array( 'width' => $width, 'height' => $height, 'crop' => true );
		preg_match( "/src=(.*?) /i", get_avatar( $user_ID, 120 ), $matches );
		$img_url = bfi_thumb( substr( trim( $matches[1] ), 1, - 1 ), $params );
		if ( $return ) {
			return esc_url( $img_url );
		} else {
			echo '<img src="' . esc_url( $img_url ) . '" class="' . esc_attr( $class ) . '" height="' . esc_attr( $height ) . '" width="' . esc_attr( $width ) . '" alt="">';
		}
	}

	/***
	 *
	 * @return string price
	 */
	function get_price_with_text() {

		$text = esc_html__( 'Start from', 'rentit' ) . " ";
		$text .= rentit_get_formatted_price();
		$text .= esc_html__( ' / per day', 'rentit' );

		return $text;
	}
	/*
     *
     */


	/**
	 * @param string $separator
	 * @param string $home
	 *
	 * @return string
	 */
	function breadcrumbs(
		$separator = '&#187;',
		$home = 'Home'
	) {
		$path = array_filter( explode( '/', parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) ) );
		$base_url = esc_url( get_home_url( '/' ) );
		ob_start();
		?>
        <li><a href="<?php echo esc_url( get_home_url( '/' ) ); ?>"> <?php esc_html_e( 'Home', 'rentit' ); ?></a>
		<?php
		$breadcrumbs = array( ob_get_clean() );
		$last = array_keys( $path );
		$last = end( $last );
		foreach ( $path AS $x => $crumb ) {
			$title = ucwords( str_replace( array( '.php', '_' ), Array( '', ' ' ), $crumb ) );
			if ( strlen( $title ) > 2 ) {
				if ( $x != $last ) {
					$breadcrumbs[] = '<li><a href="' . $base_url . $crumb . '">' . $title . '</a></li>';
				} else {
					$breadcrumbs[] = '<li class="active">' . $title . '</li>';
				}
			}
		}

		return ' <ul class="breadcrumb">' . implode( ' ', $breadcrumbs ) . ' </ul>';
	}

	/**
	 * return current url
	 * @return string
	 */
	function rentit_request_url() {
		$result = '';
		$rentit_port = 80;
		if ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) {
			$result .= 'https://';
			$rentit_port = 443;
		} else {
			$result .= 'http://';
		}
		$result .= $_SERVER['SERVER_NAME'];
		if ( $_SERVER['SERVER_PORT'] != $rentit_port ) {
			$result .= ':' . $_SERVER['SERVER_PORT'];
		}
		$result .= $_SERVER['REQUEST_URI'];

		return $result;
	}
}

$GLOBALS['Rent_IT_class'] = new Rent_IT_class();
add_filter( 'get_the_excerpt', 'rentit_exc', 90 );
function rentit_request_url() {
	$result = '';
	$rentit_port = 80;
	if ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) {
		$result .= 'https://';
		$rentit_port = 443;
	} else {
		$result .= 'http://';
	}
	$result .= $_SERVER['SERVER_NAME'];
	if ( $_SERVER['SERVER_PORT'] != $rentit_port ) {
		$result .= ':' . $_SERVER['SERVER_PORT'];
	}
	$result .= $_SERVER['REQUEST_URI'];

	return $result;
}

/**
 * carves out a brief description of shortcodes
 *
 * @param $param
 *
 * @return mixed
 */
function rentit_exc( $param ) {
	$param = preg_replace( "/\[.*?\].*?\[\/.*?\]/", "", $param );
	$param = preg_replace( "/<.*?>/", "", $param );

	return $param;
}

function rentit_newBasename( $path = false, $is_page = false ) {
	if ( $path == false && $is_page = false ) {
		$path = get_page_template();
	}
	if ( $path == false && $is_page = true && is_page() ) {
		$path = get_page_template();
	}
	$path = str_replace( '\\', '/', $path );
	$path_array = explode( '/', $path );

	return array_pop( $path_array );
}

function rentit_wp_comments_corenavi() {
	$pages = '';
	$max = get_comment_pages_count();
	$page = get_query_var( 'cpage' );
	if ( !$page ) {
		$page = 1;
	}
	$a['current'] = $page;
	$a['echo'] = false;
	$total = 0; //1 - display text "Page N of N", 0 - not to withdraw
	$a['mid_size'] = 3; // how many links to display on the left and right of the current
	$a['end_size'] = 1; // how many links to show the beginning and the end
	$a['prev_text'] = '&laquo;'; // link text "Previous"
	$a['next_text'] = '&raquo;'; // link text "Next page"
	if ( $max > 1 ) {
		echo '<div class="commentNavigation">';
	}
	echo esc_attr( $pages ) . paginate_comments_links( $a );
	if ( $max > 1 ) {
		echo '</div>';
	}
}

add_filter( 'single_cat_title', 'rentit_get_fa_icons_cat_title', 10, 1 );
function rentit_get_fa_icons_cat_title( $n ) {
	return $GLOBALS['Rent_IT_class']->get_fa_icons( $n, true );
}

function rentit_get_url_by_avatar( $get_avatar ) {
	preg_match( '/src="(.*?)"/i', $get_avatar, $matches );

	return $matches[1];
}

function rentit_get_visited2( $id ) {
	global $wpdb;
	$wpdb->hide_errors();
	$id = (int) $id;
	$sql = $wpdb->prepare( "SELECT * FROM follow WHERE user1 = '%s' AND user2 < 0", $id );
	$followers = $wpdb->get_results( $sql );
	$ids = array();
	foreach ( $followers as $lover ) {
		$ids[] = $lover->user2 * - 1;
	}

	return $ids;
}

function rentit_link_pages() {
	/* ================ Settings ================ */
	$text_num_page = ''; // The text for the number of pages. {current} is replaced by the current, and {last} the last. Example: "Page {current} of {last} '= Page 4 of 60
	$num_pages = 10; // how many links to display
	$stepLink = 10; // after the navigation links to specific step (value = the number (a pitch) or '' if you do not need to show). Example: 1,2,3 ... 10,20,30
	$dotright_text = '...';
	$dotright_text2 = '...';
	$backtext = '&#171;';
	$nexttext = '&raquo;';
	$first_page_text = ''; //  text "to the first page" or put '', instead of the text if you need to show a page number.
	$last_page_text = ''; // text "to the last page 'or write' 'if, instead of the text you need to show a page number.
	/* ================ End Settings ================ */
	global $page, $numpages;
	$paged = (int) $page;
	$max_page = $numpages;
	if ( $max_page <= 1 ) {
		return false;
	} //check the need for navigation
	if ( empty( $paged ) || $paged == 0 ) {
		$paged = 1;
	}
	$pages_to_show = intval( $num_pages );
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor( $pages_to_show_minus_1 / 2 ); //how many links to the current page
	$half_page_end = ceil( $pages_to_show_minus_1 / 2 ); //how many links after current page
	$start_page = $paged - $half_page_start; //first page
	$end_page = $paged + $half_page_end; //last page (conditionally)
	if ( $start_page <= 0 ) {
		$start_page = 1;
	}
	if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if ( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}
	if ( $start_page <= 0 ) {
		$start_page = 1;
	}
	$out = '';
	$out .= "<div class='pagination'>\n";
	if ( $text_num_page ) {
		$text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
		$out .= sprintf( "<span class='pages'>$text_num_page</span>", $paged, $max_page );
	}
	if ( $backtext && $paged != 1 ) {
		$out .= _wp_link_page( ( $paged - 1 ) ) . $backtext . '</a>';
	}
	if ( $start_page >= 2 && $pages_to_show < $max_page ) {
		$out .= _wp_link_page( 1 ) . ( $first_page_text ? $first_page_text : 1 ) . '</a>';
		if ( $dotright_text && $start_page != 2 ) {
			$out .= '<span class="extend">' . $dotright_text . '</span>';
		}
	}
	for ( $i = $start_page; $i <= $end_page; $i ++ ) {
		if ( $i == $paged ) {
			$out .= '<span class="page-numbers current">' . $i . '</span>';
		} else {
			$out .= '<a href="' . _wp_link_page( $i ) . '">' . $i . '</a>';
		}
	}
	//Links increments
	if ( $stepLink && $end_page < $max_page ) {
		for ( $i = $end_page + 1; $i <= $max_page; $i ++ ) {
			if ( $i % $stepLink == 0 && $i !== $num_pages ) {
				if ( ++ $dd == 1 ) {
					$out .= '<span class="extend">' . $dotright_text2 . '</span>';
				}
				$out .= '<a href="' . _wp_link_page( $i ) . '">' . $i . '</a>';
			}
		}
	}
	if ( $end_page < $max_page ) {
		if ( $dotright_text && $end_page != ( $max_page - 1 ) ) {
			$out .= '<span class="extend">' . $dotright_text2 . '</span>';
		}
		$out .= _wp_link_page( $max_page ) . ( $last_page_text ? $last_page_text : $max_page ) . '</a>';
	}
	if ( $nexttext && $paged != $end_page ) {
		$out .= _wp_link_page( ( $paged + 1 ) ) . $nexttext . '</a>';
	}
	$out .= "</div>";
	$out = str_replace( '"<a href="', '"', $out );
	$out = str_replace( '">">', '">', $out );

	return wp_kses_post( $out );
}

function rentit_get_member_permalink( $uid ) {
	$pgs = get_pages( array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'template-members-list.php'
	) );
	if ( !isset( $pgs[0]->ID ) ) {
		return "#";
	}
	$editlink = add_query_arg( 'page', $uid, get_permalink( $pgs[0]->ID ) );

	return $editlink;
}

if ( !isset( $content_width ) ) {
	$content_width = 1170;
}
function rentit_get_permalink_by_template( $template, $pageid = null ) {
	$pgs = get_pages( array(
		'meta_key' => '_wp_page_template',
		'meta_value' => $template
	) );
	if ( !isset( $pgs[0]->ID ) ) {
		return false;
	}
	if ( $pageid == null ) {
		return get_permalink( $pgs[0]->ID );
	}
	if ( '' != get_option( 'permalink_structure' ) ) {
		// using pretty permalinks, append to url
		return user_trailingslashit( get_permalink( $pgs[0]->ID ) . $pageid ); // www.example.com/pagename/test
	} else {
		return add_query_arg( 'page', $pageid, get_permalink( $pgs[0]->ID ) );
	}
}

/**
 * @param $value
 *
 * @return mixed|null
 */
function rentit_get_youtube_id( $value ) {
	$id = null;
	if ( preg_match( '/youtu.be\/(.*)/', $value, $math ) ) {
		$id = $math[1];
	} elseif ( preg_match( '/youtube.com.*?v=(.*)/', $value, $math ) ) {
		$id = $math[1];
	} else {
		$id = $value;
	}

	$id = str_replace( "http://", '', $id );
	$id = str_replace( "https://", '', $id );

	return $id;
}

function rentit_video_patern( $carry, $item ) {
	if ( strpos( $item, '#' ) === 0 ) {
		// Assuming '#...#i' regexps.
		$item = substr( $item, 1, - 2 );
	} else {
		// Assuming glob patterns.
		$item = str_replace( '*', '(.+)', $item );
	}

	return $carry ? $carry . ')|(' . $item : $item;
}

if ( !function_exists( 'rentit_theme_oembed_videos' ) ) :
	function rentit_theme_oembed_videos() {
		global $post;
		if ( $post && $post->post_content ) {
			global $shortcode_tags;
			// Make a copy of global shortcode tags - we'll temporarily overwrite it.
			$theme_shortcode_tags = $shortcode_tags;
			// The shortcodes we're interested in.
			$shortcode_tags = apply_filters( 'rentit_vide_embed_tags', array(
				'video' => $theme_shortcode_tags['video'],
				'embed' => $theme_shortcode_tags['embed']
			), $theme_shortcode_tags );
			// Get the absurd shortcode regexp.
			$video_regex = '#' . get_shortcode_regex() . '#i';
			// Restore global shortcode tags.
			$shortcode_tags = $theme_shortcode_tags;
			$pattern_array = array( $video_regex );
			$pattern_array = array_merge( $pattern_array, array_keys( $providers = array(
				'#http://((m|www)\.)?youtube\.com/watch.*#i' => array( 'http://www.youtube.com/oembed', true ),
				'#https://((m|www)\.)?youtube\.com/watch.*#i' => array(
					'http://www.youtube.com/oembed?scheme=https',
					true
				),
				'#http://((m|www)\.)?youtube\.com/playlist.*#i' => array( 'http://www.youtube.com/oembed', true ),
				'#https://((m|www)\.)?youtube\.com/playlist.*#i' => array(
					'http://www.youtube.com/oembed?scheme=https',
					true
				),
				'#http://youtu\.be/.*#i' => array( 'http://www.youtube.com/oembed', true ),
				'#https://youtu\.be/.*#i' => array(
					'http://www.youtube.com/oembed?scheme=https',
					true
				),
				'http://blip.tv/*' => array( 'http://blip.tv/oembed/', false ),
				'#https?://(.+\.)?vimeo\.com/.*#i' => array(
					'http://vimeo.com/api/oembed.{format}',
					true
				),
				'#https?://(www\.)?dailymotion\.com/.*#i' => array(
					'http://www.dailymotion.com/services/oembed',
					true
				),
				'http://dai.ly/*' => array(
					'http://www.dailymotion.com/services/oembed',
					false
				),
				'#https?://(www\.)?flickr\.com/.*#i' => array(
					'https://www.flickr.com/services/oembed/',
					true
				),
				'#https?://flic\.kr/.*#i' => array(
					'https://www.flickr.com/services/oembed/',
					true
				),
				'#https?://(.+\.)?smugmug\.com/.*#i' => array(
					'http://api.smugmug.com/services/oembed/',
					true
				),
				'#https?://(www\.)?hulu\.com/watch/.*#i' => array(
					'http://www.hulu.com/api/oembed.{format}',
					true
				),
				'http://i*.photobucket.com/albums/*' => array(
					'http://photobucket.com/oembed',
					false
				),
				'http://gi*.photobucket.com/groups/*' => array(
					'http://photobucket.com/oembed',
					false
				),
				'#https?://(www\.)?scribd\.com/doc/.*#i' => array(
					'http://www.scribd.com/services/oembed',
					true
				),
				'#https?://wordpress.tv/.*#i' => array( 'http://wordpress.tv/oembed/', true ),
				'#https?://(.+\.)?polldaddy\.com/.*#i' => array( 'https://polldaddy.com/oembed/', true ),
				'#https?://poll\.fm/.*#i' => array( 'https://polldaddy.com/oembed/', true ),
				'#https?://(www\.)?funnyordie\.com/videos/.*#i' => array(
					'http://www.funnyordie.com/oembed',
					true
				),
				'#https?://(www\.)?twitter\.com/.+?/status(es)?/.*#i' => array(
					'https://api.twitter.com/1/statuses/oembed.{format}',
					true
				),
				'#https?://vine.co/v/.*#i' => array(
					'https://vine.co/oembed.{format}',
					true
				),
				'#https?://(www\.)?soundcloud\.com/.*#i' => array( 'http://soundcloud.com/oembed', true ),
				'#https?://(.+?\.)?slideshare\.net/.*#i' => array(
					'https://www.slideshare.net/api/oembed/2',
					true
				),
				'#https?://instagr(\.am|am\.com)/p/.*#i' => array(
					'https://api.instagram.com/oembed',
					true
				),
				'#https?://(www\.)?rdio\.com/.*#i' => array(
					'http://www.rdio.com/api/oembed/',
					true
				),
				'#https?://rd\.io/x/.*#i' => array(
					'http://www.rdio.com/api/oembed/',
					true
				),
				'#https?://(open|play)\.spotify\.com/.*#i' => array(
					'https://embed.spotify.com/oembed/',
					true
				),
				'#https?://(.+\.)?imgur\.com/.*#i' => array( 'http://api.imgur.com/oembed', true ),
				'#https?://(www\.)?meetu(\.ps|p\.com)/.*#i' => array( 'http://api.meetup.com/oembed', true ),
				'#https?://(www\.)?issuu\.com/.+/docs/.+#i' => array( 'http://issuu.com/oembed_wp', true ),
				'#https?://(www\.)?collegehumor\.com/video/.*#i' => array(
					'http://www.collegehumor.com/oembed.{format}',
					true
				),
				'#https?://(www\.)?mixcloud\.com/.*#i' => array(
					'http://www.mixcloud.com/oembed',
					true
				),
				'#https?://(www\.|embed\.)?ted\.com/talks/.*#i' => array(
					'http://www.ted.com/talks/oembed.{format}',
					true
				),
				'#https?://(www\.)?(animoto|video214)\.com/play/.*#i' => array(
					'http://animoto.com/oembeds/create',
					true
				),
				'#https?://(.+)\.tumblr\.com/post/.*#i' => array(
					'https://www.tumblr.com/oembed/1.0',
					true
				),
				'#https?://(www\.)?kickstarter\.com/projects/.*#i' => array(
					'https://www.kickstarter.com/services/oembed',
					true
				),
				'#https?://kck\.st/.*#i' => array(
					'https://www.kickstarter.com/services/oembed',
					true
				),
				'#https?://cloudup\.com/.*#i' => array( 'https://cloudup.com/oembed', true ),
			) ) );
			// Or all the patterns together.

			$pattern = '#(' . array_reduce( $pattern_array, "rentit_video_patern" ) . ')#is';
			// Simplistic parse of content line by line.
			$lines = explode( "\n", $post->post_content );
			$i = 0;
			foreach ( $lines as $line ) {
				$line = trim( $line );
				if ( preg_match( $pattern, $line, $matches ) && $i == 0 ) {
					if ( strpos( $matches[0], '[' ) === 0 ) {
						$ret = do_shortcode( $matches[0] );
					} elseif ( preg_match( '#youtu#', $matches[0] ) ) {
						ob_start();
						?>
                        <a href="http://youtu.be/<?php echo esc_attr( rentit_get_youtube_id( $matches[0] ) ); ?>"
                           data-gal="prettyPhoto" class="media-link">
                            <span class="btn btn-play"><i class="fa fa-play"></i></span>
                            <img
                                    src="http://img.youtube.com/vi/<?php echo esc_attr( rentit_get_youtube_id( $matches[0] ) ); ?>/sddefault.jpg"
                                    alt="<?php the_title(); ?>">
                        </a>

						<?php
						$ret = ob_get_clean();
						$i ++;
						//$ret = '<' . 'iframe' . ' src="https://www.youtube.com/embed/' . sanitize_text_field() . '?feature=oembed" frameborder="0" allowfullscreen></iframe>';

					} elseif ( preg_match( '#vimeo.com#', $matches[0] ) ) {

						ob_start();
						?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?php echo esc_url( $matches[0] ); ?>"></iframe>
                        </div>

						<?php
						$i ++;
						$ret = ob_get_clean();
					} else {
						$i ++;
						$ret = wp_video_shortcode( array( 'src' => $matches[0] ) );
					}
					$ret = preg_replace( '/width=".*?"/', '', $ret );
					$ret = preg_replace( '/height=".*?"/', '', $ret );
					$ret = '<div class="embed-responsive embed-responsive-16by9">' . $ret;
					$ret = $ret . '</div>';
					print( $ret );
				}
			}
		}
	}
endif;
if ( !function_exists( 'rentit_post_gallery_slide' ) ) :
	function rentit_post_gallery_slide( $cut = true, $width = 870, $height = 370 ) {
		global $post, $Rent_IT_class;
		// Make sure the post has a gallery in it
		if ( !has_shortcode( $post->post_content, 'gallery' ) ) {
			//return;
		}
		$params = array( 'width' => $width, 'height' => $height, 'crop' => true );
		//add_filter( 'shortcode_atts_gallery', 'rentit_shortcode_atts_gallery' );
		$gallery = get_post_gallery_images( $post );
		$feature_img = '';
		if ( has_post_thumbnail() ) {
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			$feature_src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
			$feature_img .= '<div class="item">';
			$feature_img .= '<a href="' . esc_url( $Rent_IT_class->get_pots_image_url() ) . '" data-gal="prettyPhoto">';
			if ( $cut == true ) {
				$feature_img .= '<img src=" ' . esc_url( bfi_thumb( $Rent_IT_class->get_pots_image_url(), $params ) )
				                . '" >';
			} else {
				$feature_img .= '<img src=" ' . esc_url( $Rent_IT_class->get_pots_image_url() ) . '" >';
			}
			$feature_img .= '</div>';
		}
		// Loop through each image in each gallery
		$image_list = '<div class="owl-carousel img-carousel">';
		$image_list .= $feature_img;
		foreach ( $gallery as $image_url ) {
			$image_list .= '<div class="item iim">';
			$image_list .= '<a href="' . esc_url( $image_url ) . '" data-gal="prettyPhoto">';
			if ( $cut == true ) {
				// $image_list .= '<img src="' . esc_url($Rent_IT_class->trim_img_by_url($image_url),6000, 1400) . '">';
				$image_list .= '<img src="' . esc_url( bfi_thumb( $image_url, $params ) ) . '">';
			} else {
				$image_list .= '<img src="' . esc_url( $image_url ) . '">';
			}
			$image_list .= '</a>';
			$image_list .= '</div>';
		}
		$image_list .= '</div>';
		echo( $image_list );
	}
endif;
function rentit_shortcode_atts_galler() {
}

if ( !function_exists( 'rentit_limit_excerpt' ) ) :
	function rentit_limit_excerpt( $limit, $content = null ) {
		if ( empty( $content ) ) {
			$content = get_the_excerpt();
		}
		$excerpt = explode( ' ', $content, $limit + 1 );
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( " ", $excerpt );
		} else {
			$excerpt = implode( " ", $excerpt );
		}

		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );


		$output = $excerpt;

		return strip_tags( $output );
	}
endif;
if ( !function_exists( 'rentit_words_limit' ) ) :
	function rentit_words_limit() {
		$limit = null; // rentit_get_option('rentit_opt_excerpt_limit');
		if ( empty( $limit ) ) {
			return 30;
		}

		return $limit;
	}
endif;
if ( !function_exists( 'rentit_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since Rent It 1.0
	 */
	function rentit_post_thumbnail() {
		global $Rent_IT_class;
		if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
			return;
		} ?>

        <a href="<?php echo esc_url( $Rent_IT_class->get_pots_image_url() ); ?>"
           data-gal="prettyPhoto"><img
                    src=" <?php echo esc_url( $Rent_IT_class->get_post_thumbnail( get_the_ID(), 870, 370 ) ); ?>"
                    alt="<?php esc_attr( get_the_title() ); ?> ">
        </a>

		<?php // End is_singular()
	}
endif;
function rentit_get_option( $id ) {
	global $rentit_opt;

	return $rentit_opt[$id];
}

/**
 * @param $items
 * @param $args
 *
 * @return string
 */
function rentit_social_menu_item( $items, $args ) {
	$newitems = $items;
	if ( get_option( 'rentit_one_page_menu' ) == true ) {
		$menu = get_option( 'rentit_one_page_menu' ) . $newitems;
		if ( !is_front_page() ) {
			$menu = str_replace( '#', get_home_url( '/' ) . '/#', $menu );
		}
		$newitems = $menu;
	}
	if ( get_option( 'rentit_one_page_menu_right' ) == true ) {
		$menu = get_option( 'rentit_one_page_menu_right' );
		if ( !is_front_page() ) {
			$menu = str_replace( '#', get_home_url( '/' ) . '/#', $menu );
		}
		$newitems .= $menu;
	}
	if ( $args->theme_location == 'rentit_topmenu' ) {
		$newitems .= renit_socials_on_main_nav();
	}

	return $newitems;
}

add_filter( 'wp_nav_menu_items', 'rentit_social_menu_item', 10, 2 );
if ( !function_exists( 'renit_socials_on_main_nav' ) ) :
	function renit_socials_on_main_nav() {
		ob_start();
		$social_shortcode = get_theme_mod( 'sotial_networks_control_social_shortcode' );
		?>
        <li>
            <ul class="social-icons">
				<?php
				if ( function_exists( 'rentit_social_links_function' ) ) {
					if ( isset( $social_shortcode{1} ) ) {
						echo do_shortcode( $social_shortcode );
					} else {
						//echo do_shortcode('[rentit_social_links url="https://www.facebook.com/" class="fa-facebook"][rentit_social_links url="https://twitter.com/" class="fa-twitter"][rentit_social_links url="https://www.instagram.com/" class="fa-instagram"][rentit_social_links url="https://pinterest.com/" class="fa-pinterest"]');
					}
				} ?>
            </ul>
        </li>
		<?php
		return ob_get_clean();
	}
endif;
add_filter( 'woocommerce_attribute', 'rentit_woocommerce_attribute_filter' );
function rentit_woocommerce_attribute_filter( $atrr ) {
	$atrr = str_ireplace( '<p>', '', $atrr );
	$atrr = str_ireplace( '</p>', '', $atrr );

	return $atrr;
}

add_filter( 'oa_social_login_link_css', 'rentit_oa_social_login_link_css' );
function rentit_oa_social_login_link_css( $str ) {
	return get_template_directory_uri() . "/css/theme.css";
}

add_filter( 'woocommerce_add_to_cart_validation', 'rentit_cart_validation', 21, 4 );

/** Validate date to adt woocomrce
 *
 * @param bool $passed
 * @param $product_id
 * @param $quantity
 * @param string $variation_id
 *
 * @return bool
 */
function rentit_cart_validation( $passed = true, $product_id, $quantity, $variation_id = '' ) {

	$eable_car_seless = get_post_meta( $product_id, '_rentit_disable_rent', 1 );

	if ( !$eable_car_seless ):
		$dropin_location = @$_POST["dropin_location"];
		// var_dump($dropin_location);
		$dropoff_location = @$_POST["dropoff_location"];
		//start date
		$dropin_date = @$_POST["dropin_date"];
		//end date
		$dropoff_date = @$_POST["dropoff_date"];


		/****************************************************************************/
		$arrayOfDates = array();
		if ( rentit_plugin_activate() ) {

			global $wpdb;

			//get all unix dates
			$res = $wpdb->get_results( $wpdb->prepare(
				"SELECT  dropin_date,dropoff_date FROM  `{$wpdb->prefix}rentit_booking`  WHERE product_id = %d ", $product_id
			) );


			/*
         * The way to check for double-booking is this:

If the existing reseveration starts at B0 (beginning 0) and ends at E0 (end 0), and the time period you want to check is from B1 to E1, then you want to check all existing reservations where:

(B0 < E1) && (B1 < E0)
         */
			// get date period

			$date_rent_not_avable = false;
			$start_date = strtotime( $dropin_date );
			$end_date = strtotime( $dropoff_date );
			foreach ( $res as $v ) {


				if ( ( $start_date < $v->dropoff_date ) && ( $v->dropin_date < $end_date ) ) {
					$date_rent_not_avable = true;
				}

				$num_days = floor( $v->dropoff_date - $v->dropin_date ) / ( 60 * 60 * 24 );
				$next_monday = $v->dropin_date;
				for ( $i = 0; $i < $num_days; $i ++ ) {
					$next_day = strtotime( "+" . $i . " day", $next_monday );
					$arrayOfDates[] = date_i18n( "m/d/Y H:m", $next_day );
				}

			}


			$resources = get_post_meta( $product_id, '_rental_unavailable_date', true );

			if ( $resources ) {

				foreach ( $resources as $v ) {

					$num_days = ceil( strtotime( $v['discount_unavailable_date_end'] ) - strtotime( $v['discount_unavailable_date'] ) ) / ( 60 * 60 * 24 );
					if ( ( $start_date < strtotime( $v['discount_unavailable_date_end'] ) ) && ( strtotime( $v['discount_unavailable_date'] ) < $end_date ) ) {
						$date_rent_not_avable = true;
					}
					$next_monday = strtotime( $v['discount_unavailable_date'] );
					for ( $i = 0; $i < $num_days; $i ++ ) {
						$next_day = strtotime( "+" . $i . " day", $next_monday );
						$arrayOfDates[] = date_i18n( "m/d/Y H:m", $next_day );
					}


				}
			}
			/// if this not stock product then check date
			/*if ( get_post_meta( $product_id, '_manage_stock', true ) != 'yes' ) {
				if ( $date_rent_not_avable ) {
					wc_add_notice( esc_html__( 'Please select another date.', 'rentit' ), 'error' );
					$passed = false;
				}
			}*/


		}

		/****************************************************************************/
		if ( function_exists( 'rentit_DateDiff' ) ) {
			$days = rentit_DateDiff( 'd', strtotime( $dropin_date ), strtotime( $dropoff_date ) );

			$hour = rentit_DateDiff( 'h', strtotime( $dropin_date ), strtotime( $dropoff_date ) );

			$min_duration = get_post_meta( $product_id, '_min_duration', true );
			$max_duration = get_post_meta( $product_id, '_max_duration', true );
			if ( (int) $min_duration > 0 && (int) $max_duration > 1 ) {
				if ( $days < $min_duration || $days > $max_duration ) {
					wc_add_notice( esc_html__( '1Minimum rental period of days', 'rentit' ) . ' ' . esc_html( $min_duration ) . ' ' . esc_html__( 'Maximum rental period in days', 'rentit' ) . ' ' . esc_html( $max_duration ), 'error' );
					$passed = false;
				}
			}


			$rental_min_date_day = get_post_meta( $product_id, '_rental_min_date_day', true );
			$_rental_max_date_day = get_post_meta( $product_id, '_rental_max_date_day', true );


			$_rental_min_date_hours = get_post_meta( $product_id, '_rental_min_date_hours', true );
			$_rental_max_date_hours = get_post_meta( $product_id, '_rental_max_date_hours', true );





				if ( ($days < $rental_min_date_day || $days > $_rental_max_date_day) && $rental_min_date_day > 0 &&  $_rental_max_date_day > 0) {
					wc_add_notice( $_rental_max_date_day.  esc_html__( 'Minimum rental period of days', 'rentit' ) . ' ' . esc_html( $rental_min_date_day ) . ' ' .
					               esc_html__( 'Maximum rental period in days', 'rentit' ) . ' '
					               . esc_html( $_rental_max_date_day ), 'error' );
					$passed = false;
				}



			if ( (int) $rental_min_date_day > 0 && (int) $_rental_max_date_day > 1 ) {
				// echo  $_rental_max_date_day . ' ' .$days;

				if ( $days < $rental_min_date_day || $days > $_rental_max_date_day ) {
					wc_add_notice( esc_html__( 'Minimum rental period of days', 'rentit' ) . ' ' . esc_html( $rental_min_date_day ) . ' ' .
					               esc_html__( 'Maximum rental period in days', 'rentit' ) . ' '
					               . esc_html( $_rental_max_date_day ), 'error' );
					$passed = false;
				}
			} else {
				if ( (int) $rental_min_date_day > 0 || (int) $_rental_max_date_day > 1 ) {
					// echo  $_rental_max_date_day . ' ' .$days;

					if ( $days < $rental_min_date_day ) {
						wc_add_notice( esc_html__( 'Minimum rental period of days', 'rentit' ) . ' ' . esc_html( $rental_min_date_day ) . ' '
							, 'error' );
						$passed = false;
					}
					if ( $days > $_rental_max_date_day && ( (int) $_rental_max_date_day > 1 ) ) {
						wc_add_notice(
							esc_html__( 'Maximum rental period in days ', 'rentit' ) . ' '
							. esc_html( $_rental_max_date_day ), 'error' );
						$passed = false;
					}
				}
			}

			if ( (int) $_rental_min_date_hours > 0 && (int) $_rental_max_date_hours > 1 ) {
				if ( $hour < $_rental_min_date_hours || $hour > $_rental_max_date_hours ) {
					wc_add_notice( esc_html__( 'Minimum rental period of hours', 'rentit' ) . ' ' . esc_html( $_rental_min_date_hours ) . ' ' .
					               esc_html__( 'Maximum rental period in hours', 'rentit' ) . ' '
					               . esc_html( $_rental_max_date_hours ), 'error' );
					$passed = false;
				}
			} else {

				if ( (int) $_rental_min_date_hours > 0 || (int) $_rental_max_date_hours > 1 ) {
					// echo  $_rental_max_date_day . ' ' .$days;

					if ( $hour < $_rental_min_date_hours ) {
						wc_add_notice( esc_html__( 'Minimum rental period of hours', 'rentit' ) . ' ' . esc_html( $_rental_min_date_hours ) . ' '
							, 'error' );
						$passed = false;
					}
					if ( $hour > $_rental_max_date_hours && ( (int) $_rental_max_date_hours > 1 ) ) {
						wc_add_notice(
							esc_html__( 'Maximum rental period in hours ', 'rentit' ) . ' '
							. esc_html( $_rental_max_date_hours ), 'error' );
						$passed = false;
					}

				}

			}


		}
		$dropin_location_arr = get_post_meta( $product_id, '_rental_dropin_locations2', true );

		if ( isset( $dropin_location ) && empty( $dropin_location ) ) {
			if ( $dropin_location_arr ) {
				wc_add_notice( esc_html__( 'Please provide Picking Up Location location.', 'rentit' ), 'error' );
				$passed = false;
			}
		} else {

			if ( $dropin_location_arr && !in_array( $dropin_location, $dropin_location_arr ) ) {

				wc_add_notice( esc_html__( 'Please provide correct Picking Up Location ', 'rentit' ), 'error' );
				$passed = false;
			}
		}

		$dropoff_location_arr = get_post_meta( $product_id, '_rental_dropoff_locations2', true );

		if ( isset( $dropoff_location ) && empty( $dropoff_location ) ) {
			// ["_rental_dropoff_locations2"]=>
			if ( $dropoff_location_arr ) {
				wc_add_notice( esc_html__( 'Please provide Dropping Off Location', 'rentit' ), 'error' );
				$passed = false;
			}
		} else {
			if ( $dropoff_location_arr && !in_array( $dropoff_location, $dropoff_location_arr ) ) {
				wc_add_notice( esc_html__( 'Please provide correct Dropping Off Location.', 'rentit' ), 'error' );
				$passed = false;
			}

		}
		if ( isset( $dropin_date ) && empty( $dropin_date ) ) {
			//  ["_rental_dropin_locations2"]=>
			wc_add_notice( esc_html__( 'Please provide drop-in date.', 'rentit' ), 'error' );
			$passed = false;
		}


		if ( isset( $dropoff_date ) && empty( $dropoff_date ) ) {
			wc_add_notice( esc_html__( 'Please provide drop-off date.', 'rentit' ), 'error' );
			$passed = false;
		}

	endif;


	//_min_quantity
	$min_quantity = get_post_meta( $product_id, '_rentit_min_quantity', true );

	if ( $min_quantity > 0 && isset( $_POST['quantity'] ) ) {
		if ( (int) $_POST['quantity'] < (int) $min_quantity ) {
			wc_add_notice( esc_html__( 'Minimum quantity is ', 'rentit' ) . $min_quantity, 'error' );
			$passed = false;
		}
	}


	return $passed;
}

add_filter( 'woocommerce_disable_admin_bar', 'rentit_false_disable_afmin_bar' );
function rentit_false_disable_afmin_bar( $res ) {
	return false;
}


//
add_action( 'save_post', 'rentit_my_save_post_function', 10, 3 );

/*
 * generate one page menu
 */
function rentit_my_save_post_function( $post_ID, $post, $update ) {

	$frontpage_id = get_option( 'page_on_front' );
	if ( $post_ID == $frontpage_id ) {
		$post_content = wp_unslash( !empty( $_REQUEST['content'] ) ? $_REQUEST['content'] : $post_data['content'] );

		preg_match_all( '#\[rentit_one_page_section.*?title="(.*?)".*?id="(.*?)".*?\]#', $post_content, $math );


		if ( isset( $math[2] ) ) {

			$arr_items = array();
			$i = 0;
			$right_menu = false;
			$left_menu = false;
			// ob_start();
			//var_dump( $math[0]);
			foreach ( $math[2] as $item ) {
				if ( preg_match( '#right_s="1"#', $math[0][$i] ) ) {
					$right_menu .= '<li><a hre' . 'f="' . esc_attr( "#" . $item ) . '">' .
					               esc_html( $math[1][$i] ) . '</a></li>';


				} else {

					$left_menu .= '<li><a hre' . 'f="' . esc_attr( "#" . $item ) . '">' .
					              esc_html( $math[1][$i] ) . '</a></li>';

				}
				$i ++;
			}

			update_option( 'rentit_one_page_menu', $left_menu );
			update_option( 'rentit_one_page_menu_right', $right_menu );

		} else {
			delete_option( 'rentit_one_page_menu' );
			delete_option( 'rentit_one_page_menu_right' );

		}


	}

}

function rentit_get_date_s_r( $name ) {
	if ( isset( $_COOKIE[$name] ) && !empty( $_COOKIE[$name] ) ) {
		return wp_kses_post( $_COOKIE[$name] );
	} elseif ( isset( $_SESSION[$name] ) && !empty( $_SESSION[$name] ) ) {
		return wp_kses_post( $_SESSION[$name] );
	}
}


/**
 * gets the current price of the product taking into account sales
 *
 * @param $product_id
 *
 * @return mixed
 */
function rentit_get_current_price_product( $product_id, $seson = true ) {
	$sale_cost = get_post_meta( $product_id, "_sale_cost", true );
	$base_price = get_post_meta( $product_id, "_base_cost", true );
	if ( $seson ) {
		$Season_price = get_post_meta( $product_id, "_base_cost_" . renit_getSeason(), true );
	}


	if ( isset( $Season_price{0} ) && !empty( $Season_price ) ) {
		$base_price = $Season_price;
	}

	if ( isset( $_GET['start_date']{1} ) && isset( $_GET['end_date'] ) ) {

		if ( rentit_get_season_price_between_two_dates( $product_id, sanitize_text_field( $_GET['start_date'] ), sanitize_text_field( $_GET['end_date'] ) ) ) {
			return rentit_get_season_price_between_two_dates( $product_id, sanitize_text_field( $_GET['start_date'] ), sanitize_text_field( $_GET['end_date'] ) );
		}
	}
	if ( function_exists( 'rentit_get_date_s' ) && is_single()

	) {

		$start_date = rentit_get_date_s_r( 'dropin_date' );
		$end_date = rentit_get_date_s_r( 'dropoff_date' );
		if ( rentit_get_season_price_between_two_dates( $product_id, sanitize_text_field( $start_date ), sanitize_text_field( $end_date ) ) ) {
			return rentit_get_season_price_between_two_dates( $product_id, sanitize_text_field( $start_date ), sanitize_text_field( $end_date ) );
		}

	}

	if ( rentit_get_season_price_by_current_day( $product_id ) ) {
		return rentit_get_season_price_by_current_day( $product_id );
	}

	if ( isset( $sale_cost{0} ) && $sale_cost < $base_price ) {
		return apply_filters( 'alg_rentit_product_sale_price', $sale_cost, wc_get_product( $product_id ) );
	} elseif ( isset( $base_price{0} ) ) {
		return apply_filters( 'alg_rentit_product_price', $base_price, wc_get_product( $product_id ) );

	} else {
		return 0;
	}
}


function rentit_get_season_price_between_two_dates( $product_id, $star_date, $end_date ) {
	$season_date = get_post_meta( $product_id, '_rental_season_date', true );


	$days = rentit_DateDiff( 'd', strtotime( $star_date ), strtotime( $end_date ) );
	$hour = rentit_DateDiff( 'h', strtotime( $star_date ), strtotime( $end_date ) );


	if ( $days < 1 ) {
		$days = 1;
	}

	$star_date = strtotime( $star_date );
	if ( $season_date ) {
		foreach ( $season_date as $key => $date ) {

			$contractDateBegin = strtotime( $date['start_date'] );
			$contractDateEnd = strtotime( $date['end_date'] );

			if ( ( $star_date > $contractDateBegin && $star_date < $contractDateEnd ) && $end_date < $contractDateEnd ) {


				if ( isset( $date['rental_season_discount'] ) ) {
					$rental_season_discount = $date['rental_season_discount'];


					$arr_day = array();
					$arr_hour = array();
					if ( $rental_season_discount ) {

						//	var_dump($rental_season_discount);
						for ( $i = 0; $i < count( $rental_season_discount['cost'] ); $i ++ ) {
							//var_dump($rental_season_discount['duration_val']);

							if ( isset( $rental_season_discount['duration_type'][$i] ) && $rental_season_discount['duration_type'][$i] == 'days' ) {
								if ( !empty( $rental_season_discount['cost'][$i] ) ) {

									$arr_day[$rental_season_discount['duration_val'][$i]] = array(
										'cost' => $rental_season_discount['cost'][$i],

									);
								}
							}

							if ( isset( $rental_season_discount['duration_type'][$i] ) && $rental_season_discount['duration_type'][$i] == 'hours' ) {
								if ( !empty( $rental_season_discount['cost'][$i] ) ) {

									$arr_hour[$rental_season_discount['duration_val'][$i]] = array(
										'cost' => $rental_season_discount['cost'][$i],

									);
								}
							}


						}


						krsort( $arr_day );
						krsort( $arr_hour );
						$price = null;


						foreach ( $arr_day as $k => $price_disc ) {

							if ( $days >= $k ) {
								$price = $price_disc['cost'];

								break;
							}

						}

						if ( $arr_hour && $hour < 24 ) {

							///determine the largest number to the specified
							foreach ( $arr_hour as $k => $price_disc ) {
								if ( $hour >= $k ) {
									$price = $price_disc['cost'];
									break;
								}

							}
						}

					}

				}
				if ( isset( $price ) && !empty( $price ) ) {
					return $price;
				}
				return $date['price'];
			}


		}
	}
	return false;

}

/***
 *
 * @param $product_id
 * @return bool
 */
function rentit_get_season_price_by_current_day( $product_id ) {
	$season_date = get_post_meta( $product_id, '_rental_season_date', true );


	if ( $season_date ) {
		$paymentDate = strtotime( current_time( "Y-m-d H:i:s" ) );
		foreach ( $season_date as $key => $date ) {


			$contractDateBegin = strtotime( $date['start_date'] );
			$contractDateEnd = strtotime( $date['end_date'] );

			if ( $paymentDate > $contractDateBegin && $paymentDate < $contractDateEnd ) {

				if ( isset( $date['rental_season_discount'] ) ) {
					$rental_season_discount = $date['rental_season_discount'];


					$arr_day = array();
					$arr_hour = array();
					$days = 1;
					if ( $rental_season_discount ) {

						//	var_dump($rental_season_discount);
						for ( $i = 0; $i < count( $rental_season_discount['cost'] ); $i ++ ) {
							//var_dump($rental_season_discount['duration_val']);

							if ( isset( $rental_season_discount['duration_type'][$i] ) && $rental_season_discount['duration_type'][$i] == 'days' ) {
								if ( !empty( $rental_season_discount['cost'][$i] ) ) {

									$arr_day[$rental_season_discount['duration_val'][$i]] = array(
										'cost' => $rental_season_discount['cost'][$i],

									);
								}
							}

							if ( isset( $rental_season_discount['duration_type'][$i] ) && $rental_season_discount['duration_type'][$i] == 'hours' ) {
								if ( !empty( $rental_season_discount['cost'][$i] ) ) {

									$arr_hour[$rental_season_discount['duration_val'][$i]] = array(
										'cost' => $rental_season_discount['cost'][$i],

									);
								}
							}


						}


						krsort( $arr_day );
						krsort( $arr_hour );
						$price = null;


						foreach ( $arr_day as $k => $price_disc ) {

							if ( $days >= $k ) {
								$price = $price_disc['cost'];

								break;
							}

						}


					}

				}
				if ( isset( $price ) && !empty( $price ) ) {
					return $price;
				}
				return $date['price'];
			}

		}
	}
	return false;

}

if ( !function_exists( 'rentit_get_season_price_by_between_two_days' ) ) {
	function rentit_get_season_price_by_between_two_days( $product_id, $star_date, $end_date ) {
		$season_date = get_post_meta( $product_id, '_rental_season_date', true );
		$star_date = strtotime( $star_date );
		if ( $season_date ) {
			foreach ( $season_date as $key => $date ) {

				$contractDateBegin = strtotime( $date['start_date'] );
				$contractDateEnd = strtotime( $date['end_date'] );


				if ( ( $star_date > $contractDateBegin && $star_date < $contractDateEnd ) && $end_date < $contractDateEnd ) {

					return $date['price'];
				}


			}
		}
		return false;

	}
}


function rentit_get_current_type( $product_id ) {

	return esc_html__( ' /for 1 day(s)', 'rentit' );
}

/**
 * @param $filter
 *
 * @return mixed
 */
//cuts JS code
function rentit_esc_js( $filter ) {
	return preg_replace( '/<script.*?<\/script>/', '', $filter );
}

/**
 * @return mixed
 */
function rentit_get_Rent_IT_class() {
	global $Rent_IT_class;

	return $Rent_IT_class;
}

/**
 * @return null|WC_Product
 */
function rentit_get_global_product() {
	global $product;

	return $product;
}

/**
 * @return int|mixed|void
 */
function rentit_get_global_woocommerce_loop() {
	global $woocommerce_loop;

	return $woocommerce_loop;
}

/**
 * @return mixed
 */
function rentit_get_global_wp_query() {
	global $wp_query;

	return $wp_query;
}

/**
 * @param bool $max_page
 * @param string $before
 * @param string $after
 * @param bool $echo
 * @param array $args
 * @param null $wp_query
 *
 * @return int|string
 */
function renita_pagenavi( $max_page = false, $before = '', $after = '', $echo = true, $args = array(), $wp_query = null, $posts_per_page = null ) {
	global $rentit_custom_query;
	if ( isset( $rentit_custom_query ) ) {
		$max_page = $rentit_custom_query->max_num_pages;
		if ( $max_page <= 1 ) {
			return;
		}
		$wp_query = $rentit_custom_query;
	} else {
		if ( !$wp_query ) {
			global $wp_query;
		}
		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}
	}
	// the default settings
	$default_args = array(
		'text_num_page' => '',
		// Text before pagination. {current} - current; {last} - last (pr. 'Page {current} of {last}' get 'Page 4 of 60 ")
		'num_pages' => 10,
		// how many links to display
		'step_link' => 10,
		// Links increments (value - the number, the step size (at. 1,2,3 ... 10,20,30). Put 0 if such references are not needed.
		'dotright_text' => '',
		// intermediate text "to".
		'dotright_text2' => '',
		//intermediate text "after."
		'back_text' => '<i class="fa fa-angle-double-left"></i> ' . esc_html__( 'Previous', 'rentit' ),
		// text "go to the previous page." Put 0 if this reference is not needed
		'next_text' => esc_html__( 'Next', 'rentit' ) . ' <i class="fa fa-angle-double-right"></i>',
		// text "go to the next page." Put 0 if this reference is not needed.
		'first_page_text' => 0,
		// text "to the first page." Put 0 if instead of text you need to show a page number.
		'last_page_text' => 0,
		// text "to the last page." Put 0 if instead of text you need to show a page number.
	);
	$default_args = apply_filters( 'rentit_pagenavi_args', $default_args ); //to be able to establish their default values
	$args = array_merge( $default_args, $args );
	extract( $args );
	if ( !$posts_per_page ) {
		$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
	}

	$paged = (int) $wp_query->query_vars['paged'];
	if ( $max_page == false ) {
		$max_page = $wp_query->max_num_pages;
	}
	//check the need for navigation
	if ( $max_page <= 1 ) {
		return false;
	}
	if ( empty( $paged ) || $paged == 0 ) {
		$paged = 1;
	}
	$pages_to_show = intval( $num_pages );
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor( $pages_to_show_minus_1 / 2 ); // how many links to the current page
	$half_page_end = ceil( $pages_to_show_minus_1 / 2 ); // how many links after current page
	$start_page = $paged - $half_page_start; //first page
	$end_page = $paged + $half_page_end; // the last page (conditionally)
	if ( $start_page <= 0 ) {
		$start_page = 1;
	}
	if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if ( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}
	if ( $start_page <= 0 ) {
		$start_page = 1;
	}
	// display navigation
	$out = '';
	// Create a base to cause get_pagenum_link once
	$link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );
	$first_url = get_pagenum_link( 1 );
	if ( false === strpos( $first_url, '?' ) ) {
		$first_url = user_trailingslashit( $first_url );
	}
	$out .= $before . "<ul class='pagination'>\n";
	if ( $text_num_page ) {
		$text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
		$out .= sprintf( "<li><span class='pages'>$text_num_page</span></li> ", $paged, $max_page );
	}
	// ago
	if ( $back_text && $paged != 1 ) {
		$out .= '<li><a class="prev" href="' . ( ( $paged - 1 ) == 1 ? $first_url : str_replace( '___', ( $paged - 1 ), $link_base ) ) . '">' . $back_text . '</li></a> ';
	} else {
		$out .= '<li class="disabled"><a>' . $back_text . '</li></a> ';
	}
	// to the begining
	if ( $start_page >= 2 && $pages_to_show < $max_page ) {
		$out .= '<li><a class="first" href="' . $first_url . '">' . ( $first_page_text ? $first_page_text : 1 ) . '</li></a> ';
		if ( $dotright_text && $start_page != 2 ) {
			$out .= '<li><span class="extend">' . $dotright_text . '</span> </li>';
		}
	}
	// pagination
	for ( $i = $start_page; $i <= $end_page; $i ++ ) {
		if ( $i == $paged ) {
			$out .= '<li class="active">' . '<a href="#">' . $i . ' <span class="sr-only">(current)</span></a>' . '</li> ';
		} elseif ( $i == 1 ) {
			$out .= '<li><a href="' . $first_url . '">1</li></a> ';
		} else {
			$out .= '<li><a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</li></a> ';
		}
	}
	// links increments
	$dd = 0;
	if ( $step_link && $end_page < $max_page ) {
		for ( $i = $end_page + 1; $i <= $max_page; $i ++ ) {
			if ( $i % $step_link == 0 && $i !== $num_pages ) {
				if ( ++ $dd == 1 ) {
					$out .= '<span class="extend">' . $dotright_text2 . '</span> ';
				}
				$out .= '<li><a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</li></a> ';
			}
		}
	}
	// In the end
	if ( $end_page < $max_page ) {
		if ( $dotright_text && $end_page != ( $max_page - 1 ) ) {
			$out .= '<span class="extend">' . $dotright_text2 . '</span> ';
		}
		$out .= '<li><a class="last" href="' . str_replace( '___', $max_page, $link_base ) . '">' . ( $last_page_text ? $last_page_text : $max_page ) . '</li></a> ';
	}
	// forward
	if ( $next_text && $paged != $end_page ) {
		$out .= '<li><a class="next" href="' . str_replace( '___', ( $paged + 1 ), $link_base ) . '">' . $next_text . '</li></a> ';
	} else {
		$out .= '<li class="disabled"><a class="next" href="' . '">' . $next_text . '</li></a> ';
	}
	$out .= "</ul>" . $after . "\n";
	$out = apply_filters( 'kama_pagenavi', $out );
	if ( $echo ) {
		return print $out;
	}

	return $out;
}


/**
 * @return bool
 */
function rentit_plugin_activate() {
	return wp_validate_boolean( in_array( "rentit_plugin/index.php", get_option( 'active_plugins', array() ) ) );


}


/**
 * @return mixed
 */
function renit_getSeason() {
	$seasons = array(
		0 => 'winter',
		1 => 'spring',
		2 => 'summer',
		3 => 'autumn'
	);

	return $seasons[floor( date( 'n' ) / 3 ) % 4];
}

/**
 * @return mixed
 */
function renit_getSeason_reserve( $date ) {
	$seasons = array(
		0 => 'winter',
		1 => 'spring',
		2 => 'summer',
		3 => 'autumn'
	);

	return $seasons[floor( $date / 3 ) % 4];
}

/*
 * return price WC
 */
function rentit_get_formatted_price( $arr = false ) {
	//get formatted price
	extract( apply_filters( 'wc_price_args', wp_parse_args( array(), array(
		'ex_tax_label' => false,
		'currency' => '',
		'decimal_separator' => wc_get_price_decimal_separator(),
		'thousand_separator' => wc_get_price_thousand_separator(),
		'decimals' => wc_get_price_decimals(),
		'price_format' => get_woocommerce_price_format()
	) ) ) );
	$price = rentit_get_current_price_product( get_the_ID() );
	$negative = $price < 0;
	$price = apply_filters( 'raw_woocommerce_price', floatval( $negative ? $price * - 1 : $price ) );
	$price = apply_filters( 'formatted_woocommerce_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

	if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $decimals > 0 ) {
		$price = wc_trim_zeros( $price );
	}


	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, get_woocommerce_currency_symbol( $currency ), $price );


	return wp_kses_post( $formatted_price );
}


/**
 * @param $price
 * @return string
 */
function rentit_get_formatted_price_extras( $price ) {
	//get formatted price
	extract( apply_filters( 'wc_price_args', wp_parse_args( array(), array(
		'ex_tax_label' => false,
		'currency' => '',
		'decimal_separator' => wc_get_price_decimal_separator(),
		'thousand_separator' => wc_get_price_thousand_separator(),
		'decimals' => wc_get_price_decimals(),
		'price_format' => get_woocommerce_price_format()
	) ) ) );

	$negative = $price < 0;
	$price = apply_filters( 'raw_woocommerce_price', floatval( $negative ? $price * - 1 : $price ) );
	$price = apply_filters( 'formatted_woocommerce_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

	if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $decimals > 0 ) {
		$price = wc_trim_zeros( $price );
	}


	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, get_woocommerce_currency_symbol( $currency ), $price );


	return wp_kses_post( $formatted_price );
}


function rentit_single_formatted_price() {

	extract( apply_filters( 'wc_price_args', wp_parse_args( array(), array(
		'ex_tax_label' => false,
		'currency' => '',
		'decimal_separator' => wc_get_price_decimal_separator(),
		'thousand_separator' => wc_get_price_thousand_separator(),
		'decimals' => wc_get_price_decimals(),
		'price_format' => get_woocommerce_price_format()
	) ) ) );
	$price = rentit_get_current_price_product( get_the_ID() );

	$negative = $price < 0;
	$price = apply_filters( 'raw_woocommerce_price', floatval( $negative ? $price * - 1 : $price ) );
	$price = apply_filters( 'formatted_woocommerce_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

	if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $decimals > 0 ) {
		$price = wc_trim_zeros( $price );
	}


	echo $formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, get_woocommerce_currency_symbol( $currency ), ' <strong>' . $price . '</strong>' );


}


add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
	global $woocommerce;
	if ( isset( $_REQUEST['add-to-cart'] ) ) {
		$woocommerce->cart->empty_cart();
	}
}

/**
 * @param $url
 * @return string
 */
function get_youtube_embed_url( $url ) {
	$id = '';

	if ( preg_match( '#\/embed/(.*)#', $url, $math ) ) {
		$id = $math[1];
		return 'https://www.youtube.com/embed/' . $id . '?autoplay=1&showinfo=0&controls=0&loop=1&playlist=' . $id;

	} else {

		return 'https://www.youtube.com/embed/' . rentit_get_youtube_id( $url ) . '?autoplay=1&showinfo=0&controls=0&loop=1&playlist=' . rentit_get_youtube_id( $url );
	}

}

add_filter( 'js_escape', 'js_escape_nested', 10, 2 );

function js_escape_nested( $safe_text, $text ) {

	if ( is_array( $text ) ) {
		return str_replace( '"', "'", json_encode( $text ) );
	}

	return $safe_text;
}