<?php

add_action( 'widgets_init', 'rentit_widgets_int' );


/*popular_places*/
function rentit_widgets_int() {


	//sidibar widget
	register_widget( 'rentit_searh_Wigdet_class' );
	register_widget( 'rentit_CATEGORIES_Wigdet_class' );
	register_widget( 'rentit_twiter_Wigdet' );
	register_widget( 'rentit_ARCHIVES_Wigdet_class' );
	register_widget( 'rentit_HELPING_CENTER_Wigdet_class' );
	register_widget( 'rentit_TESTIMONIALS_Wigdet_class' );
	register_widget( 'rentit_TAG_Wigdet_class' );
	register_widget( 'rentit_Flickr_Images_class' );

	//footer widget
	register_widget( 'rentit_ABOUT_US_Wigdet_class' );
	register_widget( 'rentit_menu_Wigdet_class' );
	register_widget( 'rentit_NEWS_LETTER_class' );
	register_widget( 'rentit_ITEM_TAGS_class' );

	//Shop widget

	register_widget( 'rentit_FIND_BEST_RENTAL_CAR_class' );
	register_widget( 'rentit_PRICE_FILTER_class' );
	register_widget( 'rentit_DETAIL_RESERVATION_class' );
	register_widget( 'rentit_Car_tab_class' );

	//register_widget( 'rentit_order_manage' );


}


//sidibar widget


class rentit_searh_Wigdet_class extends WP_Widget {
	/**
	 * Register the new widget
	 */

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It Search', 'rentit' ),
			'description' => esc_html__( 'It displays a Search form', 'rentit' ),
			'classname'   => 'rentit_Search'
		);
		parent::__construct( 'rentit_Search', 'Rent It Searchb', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		extract( $instance );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'placeholder' ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>


		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		?>
		<div class="widget shadow">
			<div class="widget-search">
				<form action=" <?php echo esc_url( get_home_url( '/' ) ); ?>" method="get">
					<input name="s" class="form-control" type="text"
					       placeholder="<?php esc_html_e( 'Search', 'rentit' ); ?>">
					<button><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
		<?php


	}

	/*
  * a method which, when the update of the widget is executed
  *
  * @param $new_instance
  * @param $old_instance
  * @return mixed
  */
	function update( $new_instance, $old_instance ) {
		$new_instance['placeholder'] = ! empty( $new_instance['placeholder'] ) ? esc_attr( $new_instance['placeholder'] ) :
			esc_html__( "Search", 'rentit' );


		return $new_instance;
	}

}


class rentit_CATEGORIES_Wigdet_class extends WP_Widget {
	/**
	 * Register the new widget
	 */

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It CATEGORIES', 'rentit' ),
			'description' => esc_html__( 'It displays a Categories list ', 'rentit' ),
			'classname'   => 'rentit_Search'
		);
		parent::__construct( 'rentit_Categories', 'Rent It Categories', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		extract( $instance );
		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } else {
				       esc_html_e( 'CATEGORIES', 'rentit' );
			       } ?>">
		</p>


		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */

	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => esc_html__( 'Categories', 'rentit' ), // Legacy.


			)
		);
		extract( $instance );

		$title = sanitize_text_field( apply_filters( 'widget_title', $title ) );

		?>
		<div class="widget shadow car-categories">
			<?php

			$categories = get_categories( '' );

			?>
			<h4 class="widget-title"><?php echo esc_html( $title ); ?></h4>

			<div class="widget-content">
				<ul>
					<?php

					$rentit_cat_parent_arr = array();
					$categories            = get_categories( "parent=0&taxonomy=category&hide_empty=0" );
					$category              = array();
					foreach ( $categories as $cat ) {
						//parent cat
						$chald = get_term_children( $cat->term_id, 'category' );
						$chald = implode( ',', $chald );
						?>
						<li>
							<?php
							// if this is chald cat
							if ( ! ( empty( $chald ) ) ) {
								$args        = array(
									'taxonomy'   => 'category',
									'hide_empty' => 0,
									'include'    => $chald
								);
								$categories2 = get_categories( $args );
								?>
								<span class="arrow"><i class="fa fa-angle-down"></i></span>
								<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">  <?php echo esc_html( $cat->name ); ?></a>

								<ul class="children active">
									<?php
									foreach ( $categories2 as $cat_chald ) {
										// if($cat_chald->count < 1) continue;

										?>
										<li>
											<a href="<?php echo esc_url( get_category_link( $cat_chald->term_id ) ); ?>"> <?php echo esc_html( $cat_chald->name ); ?>
												<span
													class="count"><?php echo esc_html( $cat_chald->count ); ?></span></a>
										</li>
										<?php
									} ?>
								</ul>
								<?php
							} else {
								?>
								<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">  <?php echo esc_html( $cat->name ); ?></a>

								<?php
							}

							?>
						</li>
						<?php
					}
					?>
				</ul>

			</div>
		</div>
		<?php


	}

	/*
  * a method which, when the update of the widget is executed
  *
  * @param $new_instance
  * @param $old_instance
  * @return mixed
  */
	function update( $new_instance, $old_instance ) {
		$new_instance['title'] = ( ! empty( $new_instance['title'] ) && strlen( $new_instance['title'] ) > 1 ) ? esc_attr( $new_instance['title'] ) :
			esc_html__( "CATEGORIES", 'rentit' );

		return $new_instance;
	}

}

class rentit_twiter_Wigdet extends WP_Widget {
	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It  Tweets', 'rentit' ),
			'description' => esc_html__( 'It displays a list of tweets', 'rentit' ),
			'classname'   => 'rentit_twiter'
		);
		parent::__construct( 'rentit_twiter', esc_html__( 'Rent It Tweets', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {

		extract( $instance );


		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"> <?php esc_html_e( 'Name:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'Name' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'Name' ) ); ?>" type="text"
			       value="<?php if ( isset( $Name ) ) {
				       echo esc_attr( $Name );
			       } ?>">
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"> <?php esc_html_e( 'How many show Tweets?',
					'rentit' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text"
			       value="<?php
			       if ( isset( $text ) ) {
				       echo esc_attr( $text );
			       }
			       ?>">

		</p>


		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );


		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => esc_html__( 'TWEETS', 'rentit' ), // Legacy.
				'Name'  => '',
				'text'  => 3


			)
		);
		extract( $instance );
		// Create a filter to the other plug-ins can change them
		$title         = sanitize_text_field( apply_filters( 'widget_title', $title ) );
		$before_widget = str_replace( 'class="', 'class=" widget shadow widget-twitter ', $before_widget );
		echo wp_kses_post( $before_widget . "" );

		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );


		global $wp_filesystem;

		//the existence check
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}


		$rentit_upload_dir = wp_upload_dir();
		//We get the correct path to the file
		$rentit_filename = trailingslashit( $rentit_upload_dir['basedir'] ) . $title . "twitcache.XML";

		//if it took more than an hour the update cache
		if ( get_option( $title . "last_twitupdate" ) < time() - 3600 ) {
			$file = $wp_filesystem->get_contents( 'http://twitrss.me/twitter_user_to_rss/?user=' . $Name );
			update_option( $title . "last_twitupdate", time() );
			$wp_filesystem->put_contents( $rentit_filename, $file, FS_CHMOD_FILE );

		} else {

			$file = $wp_filesystem->get_contents( $rentit_filename );

		}
		?>
		<div class="">
			<div class="recent-tweets">
				<?php


				if ( strlen( $file ) > 10 ) {
					$movies = new SimpleXMLElement( $file );


					for ( $i = 0; $i < $text; $i ++ ) {
						?>
						<div class="media">
							<div class="media-body">
								<p><i class="fa fa-twitter"></i> <a
										href="<?php echo esc_url( $movies->channel->item[ $i ]->link ); ?>"
										class="tweets_a">@ <?php echo
										esc_attr( $Name ); ?></a>
									<?php echo esc_attr( $movies->channel->item[ $i ]->title ); ?>
									<small><?php
										$d1         = strtotime( $movies->channel->item[ $i ]->pubDate );
										$date2      = date( "U", $d1 );
										$human_time = human_time_diff( $date2, current_time( 'timestamp' ) );
										printf( '%s ' . esc_html__( 'ago', 'rentit' ), $human_time );
										?> </small>
							</div>
						</div>

						<?php
					}
				}


				?>      </div>
		</div>


		<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title'] = ! empty( $new_instance['title'] ) ? esc_attr( $new_instance['title'] ) :
			"";
		$new_instance['text']  = ( (int) $new_instance['text'] ) ? $new_instance['text'] : 2;

		return $new_instance;
	}


}

class rentit_ARCHIVES_Wigdet_class extends WP_Widget {
	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It  ARCHIVES', 'rentit' ),
			'description' => esc_html__( 'It displays a list of ARCHIVES', 'rentit' ),
			'classname'   => 'car-categories'
		);
		parent::__construct( 'car-categories', esc_html__( 'Rent It ARCHIVES', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number' => 20 ) );
		extract( $instance );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"><?php esc_html_e( 'Title:', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $title ) ); ?>"/></p>
		<p>
		<p><label
				for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'How show post in months?', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
			       type="number" value="<?php echo esc_attr( esc_attr( $number ) ); ?>"/></p>
		<p>


		<?php

	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'  => esc_html__( 'archives', 'rentit' ),
			'number' => 20
		) );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		extract( $args );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Archives', 'rentit' ) : $instance['title'], $instance, $this->id_base );


		echo wp_kses_post( $before_widget );

		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );

		?>
		<div class="">
			<ul>

				<?php
				global $wpdb, $wp_locale;

				$results = $wpdb->get_results(
					$wpdb->prepare( "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC LIMIT %d", 300 )
				);
				foreach ( (array) $results as $result ) {
					$url = @get_month_link( $result->year, $result->month );

					/* translators: 1: month name, 2: 4-digit year */
					$text = @sprintf( ( '%1$s %2$d' ), @$wp_locale->get_month( @$result->month ), @$result->year );
					/* if ($results['show_post_count']) {
                         $results['after'] = '&nbsp;(' . $result->posts . ')';


                     }*/
					$args = array(
						'posts_per_page' => (int) $instance['number'],
						'orderby'        => 'date',
						'order'          => 'DESC',
						'year'           => $result->year,
						// add the year/month query here:
						'monthnum'       => @$result->month

					);

					$wp_query = new WP_Query( $args );
					if ( $wp_query->post_count < 1 ) {
						continue;
					}
					?>
					<li>
						<span class="arrow"><i class="fa fa-angle-down"></i></span>
						<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?><span
								class="count"><?php echo esc_html( $wp_query->post_count ); ?></span></a>
						<ul class="children" style="display: none;">
							<?php

							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								?>
								<li>
									<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
								</li>
								<?php

							}
							wp_reset_postdata();
							?>
						</ul>
					</li>
					<?php
				}

				?>
			</ul>
		</div>
		<?php

		echo wp_kses_post( $after_widget );
	}

	public function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$new_instance       = wp_parse_args( (array) $new_instance, array(
			'title'    => '',
			'count'    => 0,
			'dropdown' => ''
		) );
		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = $new_instance['number'] ? (int) sanitize_title( $new_instance['number'] ) : 20;

		return $instance;
	}


}


class rentit_HELPING_CENTER_Wigdet_class extends WP_Widget {
	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It Helping Center', 'rentit' ),
			'description' => esc_html__( 'It displays a Helping Center', 'rentit' ),
			'classname'   => 'widget-helping-center'
		);
		parent::__construct( 'widget-helping-center', esc_html__( 'Rent It Helping Center', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance,
			array(
				'title'        => esc_html__( ' HELPING CENTER', 'rentit' ),
				'text'         => esc_html__( 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.', 'rentit' ),
				'phone_number' => '+90 555 444 66 33',
				'email'        => 'support@supportcenter.com',
				'url'          => '#'
			)
		);
		extract( $instance );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"><?php esc_html_e( 'Title:', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $title ) ); ?>"/></p>
		<p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"> <?php esc_html_e( 'Text:',
					'rentit' ); ?></label>
            <textarea cols="10" rows="10" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
                      name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"
            ><?php if ( isset( $text ) ) {
		            echo do_shortcode( $text );
	            } ?></textarea>
		</p>

		<p><label
				for="<?php echo esc_attr( $this->get_field_id( 'phone_number' ) ); ?>"><?php esc_html_e( 'Phone number', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'phone_number' ) ); ?>"
			       type="tel" value="<?php echo esc_attr( esc_attr( $phone_number ) ); ?>"/></p>
		<p>


		<p><label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'email' ) ) ); ?>"><?php esc_html_e( 'email:', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'email' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'email' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $email ) ); ?>"/></p>
		<p>
		<p><label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'url' ) ) ); ?>"><?php esc_html_e( 'url:', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'url' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'url' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $url ) ); ?>"/></p>
		<p>
		<?php

	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'title'        => esc_html__( 'HELPING CENTER', 'rentit' ),
				'text'         => esc_html__( 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.', 'rentit' ),
				'phone_number' => '+90 555 444 66 33',
				'email'        => 'support@supportcenter.com',
				'url'          => '#'
			)
		);
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		extract( $args );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Archives', 'rentit' ) : $instance['title'], $instance, $this->id_base );


		echo wp_kses_post( $before_widget );

		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );

		?>
		<div class="widget-content">
		<p><?php echo do_shortcode( $text ); ?></p>
		<h5 class="widget-title-sub"><?php echo esc_html( $phone_number ); ?></h5>

		<p>
			<a href="mailto:<?php echo antispambot( esc_html( $email ) ); ?>"><?php echo antispambot( esc_html( $email ) ); ?></a>
		</p>

		<div class="button">
			<a href="<?php echo esc_url( $url ); ?>" class="btn btn-block btn-theme btn-theme-dark">
				<?php esc_html_e( 'Support Center', 'rentit' ); ?>

			</a>
		</div>
		</div>
		<?php

		echo wp_kses_post( $after_widget );
	}

	/*public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array)$new_instance, array('title' => '', 'count' => 0, 'dropdown' => ''));
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = $new_instance['number'] ? (int)sanitize_title($new_instance['number']) : 20;

        return $instance;
    }*/

}

class rentit_TESTIMONIALS_Wigdet_class extends WP_Widget {
	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It TESTIMONIALS', 'rentit' ),
			'description' => esc_html__( 'It displays a TESTIMONIALS', 'rentit' ),
			'classname'   => 'widget-TESTIMONIALS-center'
		);
		parent::__construct( 'widget-TESTIMONIALS_center', esc_html__( 'Rent It TESTIMONIALS', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance,
			array(
				'title' => esc_html__( 'TESTIMONIALS', 'rentit' ),
				'text'  => ''

			)
		);
		extract( $instance );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"><?php esc_html_e( 'Title:', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $title ) ); ?>"/></p>
		<p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"> <?php esc_html_e( 'text:',
					'rentit' ); ?></label>
            <textarea cols="10" rows="10" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
                      name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"
            ><?php if ( isset( $text ) ) {
		            echo esc_attr( $text );
	            } ?></textarea>
		</p>
		<?php

	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {

		$instance = wp_parse_args( (array) $instance,
			array(
				'title'  => esc_html__( 'TESTIMONIALS', 'rentit' ),
				'number' => 3,
				'text'   => ''
			)
		);
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		extract( $args );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Archives', 'rentit' ) : $instance['title'], $instance, $this->id_base );


		echo wp_kses_post( $before_widget );

		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );

		?>


		<div class="testimonials-carousel">
			<div class="owl-carousel" id="testimonials">
				<?php
				/* $args = array(
                    // args here
                    'number' => (int)$number
                );

                // The Query
                $comments_query = new WP_Comment_Query;
                $comments = $comments_query->query($args);

                // Comment Loop
                $i = 1;
                if ($comments) {
                    foreach ($comments as $comment) {
                        if ($i > (int)$number)
                            break;
                        ?>
                        <div class="testimonial">
                            <div class="media">
                                <div class="media-body">
                                    <div class="testimonial-text">   <?php
                                        echo wp_kses_post($comment->comment_content); ?>
                                    </div>
                                    <div class="testimonial-name"><?php echo esc_html($comment->comment_author); ?>
                                        <span
                                            class="testimonial-position"> <?php esc_html_e('Co- founder at Rent It', 'rentit') ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    wp_reset_postdata();
                } else {
                    echo 'No comments found.';
                }*/

				echo do_shortcode( $text );

				?>
			</div>
		</div>

		<?php

		echo wp_kses_post( $after_widget );
	}

}

class rentit_TAG_Wigdet_class extends WP_Widget {
	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It TAG', 'rentit' ),
			'description' => esc_html__( 'It displays a list of TAG', 'rentit' ),
			'classname'   => 'widget-tag-cloud'
		);
		parent::__construct( 'widget-tag-cloud', esc_html__( 'Rent It TAG', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'title'    => '',
				'type_tag' => '0',
				'number'   => 20
			) );
		extract( $instance );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"><?php esc_html_e( 'Title:', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $title ) ); ?>"/></p>
		<p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'type_tag' ) ); ?>"><?php esc_html_e( 'Select type tag', 'rentit' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'type_tag' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'type_tag' ) ); ?>">
				<option value="0" <?php selected( $type_tag, '0' ); ?>>
					<?php esc_html_e( 'Post tags', 'rentit' ); ?>
				</option>
				<option
					value="1" <?php selected( $type_tag, '1' ); ?>>
					<?php esc_html_e( 'Product tags', 'rentit' ); ?>
				</option>

			</select>
		</p>
		<?php

	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'title'    => esc_html__( 'TAGS', 'rentit' ),
				'number'   => 20,
				'type_tag' => '0',
			) );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		extract( $args );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Tags', 'rentit' ) : $instance['title'], $instance, $this->id_base );

		ob_start();
		the_tags();
		ob_get_clean();

		?>
		<div class="widget widget-tag-cloud">
			<h4 class="widget-title"><span><?php echo esc_attr( $title ); ?></span></h4>

			<ul>
				<?php
				if ( $type_tag == '0' ) {
					$posttags = get_tags();
					if ( $posttags ) {
						foreach ( $posttags as $tag ) {
							?>
							<li>
								<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
							</li>
							<?php
						}
					}
				} else {

					$args     = array(
						'smallest'  => 16					,
						'largest'   => 16					,
						'unit'      => 'px'					,
						'number'    => 45					,
						'format'    => 'array'					,
						'separator' => "\n"					,
						'orderby'   => 'name'					,
						'order'     => 'ASC'					,
						'taxonomy'  => 'product_tag'					,
						'echo'      => false					);
					$tags_arr = wp_tag_cloud( $args );
					if ( count( $tags_arr ) > 0 ) {
						foreach ( $tags_arr as $tag ) {
							?>
							<li>
								<?php echo wp_kses_post( $tag ); ?>
							</li>
							<?php
						}
					}
				}
				?>

			</ul>
		</div>
		<?php

	}

	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$new_instance         = wp_parse_args( (array) $new_instance, array(
			'title'    => '',
			'count'    => 0,
			'dropdown' => ''
		) );
		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['number']   = $new_instance['number'] ? (int) sanitize_title( $new_instance['number'] ) : 20;
		$instance['type_tag'] = $new_instance['type_tag'] ? (int) sanitize_title( $new_instance['type_tag'] ) : '0';

		return $instance;
	}


}

class rentit_Flickr_Images_class extends WP_Widget {

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It Flickr Images', 'rentit' ),
			'description' => esc_html__( 'It displays a list of Flickr Images', 'rentit' ),
			'classname'   => 'rentit_flickr_Images'
		);
		parent::__construct( 'rentit_flickr_Images', esc_html__( 'Rent It Flickr Images', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'title'     => esc_html__( 'FLICKR IMAGES', 'rentit' ),
				'number'    => 9,
				'fliker_id' => '71865026@N00'
			) );
		extract( $instance );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"><?php esc_html_e( 'Title:', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $title ) ); ?>"/></p>
		<p>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'number' ) ) ); ?>"><?php esc_html_e( 'How many show images? (max 10)', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'number' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'number' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $number ) ); ?>"/></p>
		<p>

		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'fliker_id' ) ) ); ?>"><?php esc_html_e( 'user id fliker', 'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'fliker_id' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'fliker_id' ) ) ); ?>"
			       type="text" value="<?php echo esc_attr( esc_attr( $fliker_id ) ); ?>"/></p>
		<p>

		<?php

	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {

		$instance = wp_parse_args( (array) $instance,
			array(
				'title'     => esc_html__( 'FLICKR IMAGES', 'rentit' ),
				'number'    => 9,
				'fliker_id' => '71865026@N00'
			) );
		extract( $instance );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'FLICKR IMAGES', 'rentit' ) : $instance['title'], $instance, $this->id_base );

		$transName = 'list-flikers' . $this->id; // Name of value in database.
		$cacheTime = 60; // Time in minutes between updates.

		if ( false === ( $twitterData = get_transient( $transName ) ) ) {
			//Get new $twitterData

			$request = wp_remote_get( 'http://www.flickr.com/badge_code_v2.gne?count=' . (int) $number . '&display=latest&size=s&layout=x&source=user&user=' . $fliker_id );
			// Get tweets into an array.
			if ( ! is_wp_error( $request ) ) {
				$twitterData = $request['body'];
				preg_match_all( '/src="(.*?\.jpg)"/', $request['body'], $img_arr );
				preg_match_all( '/href="(.*?)"/', $request['body'], $href_arr );

				ob_start();
				foreach ( $img_arr[1] as $k => $item ) {


					?>
					<li><a target="_blank" href="<?php echo esc_url( $href_arr[1][ $k ] ); ?>"><img
								src="<?php echo esc_url( $item ); ?>"
								alt=""></a></li>
					<?php

				}
				$data = ob_get_clean();
				set_transient( $transName, $data, 60 * $cacheTime );
			}
		}
		?>
		<div class="widget widget-flickr-feed">

			<h4 class="widget-title"><span><?php echo esc_html( $title ); ?></span></h4>
			<ul>
				<?php

				echo wp_kses_post( get_transient( $transName ) );
				?>

			</ul>
		</div>
		<?php


	}

	public function update( $new_instance, $old_instance ) {
		$instance  = $old_instance;
		$transName = 'list-flikers' . $this->id;
		delete_transient( $transName );
		$new_instance          = wp_parse_args( (array) $new_instance,
			array(
				'title'     => esc_html__( 'FLICKR IMAGES', 'rentit' ),
				'fliker_id' => '71865026@N00',
				'number'    => 9,
			) );
		$instance['title']     = $new_instance['title'] ? sanitize_title( $new_instance['title'] ) : esc_html__( 'FLICKR IMAGES', 'rentit' );
		$instance['number']    = $new_instance['number'] ? (int) sanitize_title( $new_instance['number'] ) : 9;
		$instance['fliker_id'] = $new_instance['fliker_id'] ? ( $new_instance['fliker_id'] ) : '71865026@N00';
		delete_transient( 'list-flikers' . $this->id );

		return $instance;
	}


}


//footer widget

class rentit_ABOUT_US_Wigdet_class extends WP_Widget {

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It ABOUT_US', 'rentit' ),
			'description' => esc_html__( 'It displays ABOUT_US', 'rentit' ),
			'classname'   => 'rentit_tABOUT_US'
		);
		parent::__construct( 'rentit_ABOUT_US', esc_html__( 'Rent It Tweets', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {

		extract( $instance );


		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"> <?php esc_html_e( 'text:',
					'rentit' ); ?></label>
            <textarea cols="10" rows="10" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
                      name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"
            ><?php if ( isset( $text ) ) {
		            echo esc_attr( $text );
	            } ?></textarea>
		</p>

		<p>
			<?php $social = ( isset( $social ) ) ? $social : 'on'; ?>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>"> <?php esc_html_e( 'Show social network link?',
					'rentit' ); ?></label>
			<input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>"
				<?php checked( 'on', $social ); ?>
			>


		</p>

		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		// Create a filter to the other plug-ins can change them
		$title  = ( ! isset( $title ) || empty( $title ) ) ? esc_html_e( 'ABOUT US', 'rentit' ) : $title;
		$social = ( ! isset( $social ) || empty( $social ) ) ? 'on' : $social;
		$title  = sanitize_text_field( apply_filters( 'widget_title', $title ) );
		$text   = ( ! isset( $text ) || empty( $text ) ) ? "" : $text;
		echo wp_kses_post( $before_widget );

		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );


		?>


		<p><?php echo wp_kses_post( $text ); ?></p>
		<?php if ( $social == 'on' ):
			$social_shortcode = get_theme_mod( 'sotial_networks_control_social_shortcode' );
			?>

			<ul class="social-icons">
				<?php
				if ( isset( $social_shortcode{1} ) ) {
					echo do_shortcode( $social_shortcode );
				} else {
					/*echo do_shortcode( '
					 [rentit_social_links url="https://www.facebook.com/"  class="fa-facebook"]
					 [rentit_social_links url="https://twitter.com/" class="fa-twitter"]
					 [rentit_social_links url="https://www.instagram.com/" class="fa-instagram"]
					 [rentit_social_links url="https://pinterest.com/" class="fa-pinterest"]' );
				*/ } ?>


			</ul>

		<?php endif; ?>


		<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {

		return $new_instance;
	}


}

class rentit_menu_Wigdet_class extends WP_Nav_Menu_Widget {

	/**
	 * Sets up a new Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 */
	public function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It Menu', 'rentit' ),
			'description' => esc_html__( 'It displays Menu', 'rentit' ),
			'classname'   => 'rentit_Menu'
		);
		parent::__construct( 'nav_menu', esc_html__( 'Rent It Menu', 'rentit' ), $args );


	}

	/**
	 * Outputs the content for the current Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Custom Menu widget instance.
	 */
	public function widget( $args, $instance ) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo wp_kses_post( $args['before_widget'] );
		?>
		<div class="widget-categories">
			<?php
			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );
			}

			$nav_menu_args = array(
				'fallback_cb' => '',
				'menu'        => $nav_menu
			);

			wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

			?>
		</div>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Handles updating settings for the current Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( stripslashes( $new_instance['title'] ) );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}

		return $instance;
	}

	/**
	 * Outputs the settings form for the Custom Menu widget.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) {
			echo ' style="display:none" ';
		} ?>>
			<?php
			if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( esc_html__( esc_html__( 'No menus have been created yet.', "rentit" ) . '<a href="%s">' . esc_html__( "Create some", "rentit" ) . '</a>.' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) {
			echo ' style="display:none" ';
		} ?>>
			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'rentit' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				       value="<?php echo esc_attr( $title ); ?>"/>
			</p>

			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'Select Menu:', 'rentit' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"
				        name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
					<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'rentit' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option
							value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}

class rentit_NEWS_LETTER_class extends WP_Widget {

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It NEWS LETTER', 'rentit' ),
			'description' => esc_html__( 'It displays NEWS LETTER', 'rentit' ),
			'classname'   => 'rentit_NEWS_LETTER_'
		);
		parent::__construct( 'rentit_NEWS_LETTER_', esc_html__( 'Rent It Tweets', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'       => esc_html__( 'NEWS LETTER', 'rentit' ), // Legacy.
				'text'        => '', // Legacy URL field.
				'placeholder' => esc_html__( 'Enter Your Mail and Get $10 Cash', 'rentit' ),
				'text_button' => esc_html__( 'Subscribe', 'rentit' )
			)
		);

		extract( $instance );

		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"> <?php esc_html_e( 'text:',
					'rentit' ); ?></label>
            <textarea cols="10" rows="10" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
                      name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"
            ><?php if ( isset( $text ) ) {
		            echo esc_attr( $text );
	            } ?></textarea>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"> <?php esc_html_e( 'Text placeholder:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'placeholder' ) ); ?>" type="text"
			       value="<?php if ( isset( $placeholder ) ) {
				       echo esc_attr( $placeholder );
			       } ?>">
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'text_button' ) ); ?>"> <?php esc_html_e( 'Text button:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_button' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'text_button' ) ); ?>" type="text"
			       value="<?php if ( isset( $text_button ) ) {
				       echo esc_attr( $text_button );
			       } ?>">
		</p>


		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		//default values
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'       => esc_html__( 'NEWS LETTER', 'rentit' ), // Legacy.
				'text'        => '', // Legacy URL field.
				'placeholder' => esc_html__( 'Enter Your Mail and Get $10 Cash', 'rentit' ),
				'text_button' => esc_html__( 'Subscribe', 'rentit' )
			)
		);

		extract( $args );
		extract( $instance );

		// Create a filter to the other plug-ins can change them
		$title = sanitize_text_field( apply_filters( 'widget_title', $title ) );
		echo wp_kses_post( $before_widget . "" );
		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );


		?>

		<p><?php echo wp_kses_post( $text ); ?></p>

		<form class="form-subscribe2" action="#" method="post">
			<div class="form-group">
				<input class="form-control subsciber_email" type="text"
				       placeholder="<?php echo esc_attr( $placeholder ); ?>"/>

				<p class="e-mail_result col-md-12"></p>
			</div>
			<div class="form-group">
				<button type="submit"
				        class="btn btn-theme btn-theme-transparent subscriber_go"> <?php echo esc_attr( $text_button ); ?> </button>
			</div>
		</form>
		<script>
			jQuery(document).ready(function ($) {
				$(document).on("click", '.subscriber_go', function (e) {
					e.preventDefault();
					$(".e-mail_result").html(" ");
					var email = $(".subsciber_email");
					email.removeClass('error');
					var thisbtn = $(this);


					if (isValidEmailAddress(email.val())) {
						thisbtn.prop('disabled', true);

						$.ajax({
							url: rentit_obj.ajaxurl,
							type: 'POST',
							data: "action=rentit_mailchimp_send&email=" + email.val(),
							success: function (date) {
								/* jQuery(".e-mail_result").html(date);
								 setTimeout(function () {
								 // $(".e-mail_result").html(" ");
								 }, 3500)*/
								$('.form-subscribe2').append("<div class=\"alert alert-success fade in\">" +
									"<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>" +
									"" + date + "" +
									"</strong></div>");
								$('.form-subscribe2')[0].reset();
								thisbtn.prop('disabled', false);
							}

						});
					} else {
						email.addClass('error');

					}
				});
			});
			function isValidEmailAddress(emailAddress) {
				var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
				return pattern.test(emailAddress);
			}
		</script>
		<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}


}


class rentit_ITEM_TAGS_class extends WP_Widget {

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It ITEM TAGS', 'rentit' ),
			'description' => esc_html__( 'It displays ITEM TAGS', 'rentit' ),
			'classname'   => 'widget-tag-cloud'
		);
		parent::__construct( 'rentit_ITEM TAGS', esc_html__( 'Rent It ITEM TAGS', 'rentit' ), $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => esc_html__( 'ITEM TAGS', 'rentit' ), // Legacy.

			)
		);

		extract( $instance );

		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>

		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		//default values
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'       => esc_html__( 'ITEM TAGS', 'rentit' ), // Legacy.
				'text'        => '', // Legacy URL field.
				'placeholder' => esc_html__( 'Enter Your Mail and Get $10 Cash', 'rentit' ),
				'text_button' => esc_html__( 'Subscribe', 'rentit' )
			)
		);

		extract( $args );
		extract( $instance );

		// Create a filter to the other plug-ins can change them
		$title         = sanitize_text_field( apply_filters( 'widget_title', $title ) );
		$before_widget = str_ireplace( 'class="widget"', 'class="widget widget-tag-cloud"', $before_widget );
		echo wp_kses_post( $before_widget . "" );
		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );
		?>

		<ul class="tags_list clearfix">
			<?php
			$args     = array(
				'smallest'  => 16
			,
				'largest'   => 16
			,
				'unit'      => 'px'
			,
				'number'    => 45
			,
				'format'    => 'array'
			,
				'separator' => "\n"
			,
				'orderby'   => 'name'
			,
				'order'     => 'ASC'
			,
				'taxonomy'  => 'product_tag'
			,
				'echo'      => false
			);
			$tags_arr = wp_tag_cloud( $args );
			if ( count( $tags_arr ) > 0 ) {
				foreach ( $tags_arr as $tag ) {
					?>
					<li>
						<?php echo wp_kses_post( $tag ); ?>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}


}


/*
 * Shop widgets
 */

class rentit_FIND_BEST_RENTAL_CAR_class extends WP_Widget {

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent It FIND BEST RENTAL CAR', 'rentit' ),
			'description' => esc_html__( 'It displays Filter BEST RENTAL CAR', 'rentit' ),
			'classname'   => 'widget-find-car'
		);
		parent::__construct( '', '', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => esc_html__( 'FIND BEST RENTAL CAR', 'rentit' ), // Legacy.

			)
		);

		extract( $instance );

		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>

		<?php
	}


	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		//default values
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => esc_html__( 'FIND BEST RENTAL CAR', 'rentit' ), // Legacy.

			)
		);

		extract( $args );
		extract( $instance );

		// Create a filter to the other plug-ins can change them
		$title         = sanitize_text_field( apply_filters( 'widget_title', $title ) );
		$before_widget = str_ireplace( 'class="widget"', 'class="widget widget-tag-cloud"', $before_widget );
		echo wp_kses_post( $before_widget . "" );
		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );
		?>


		<div class="">
			<!-- Search form -->
			<div class="form-search light">
				<form action="<?php echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) ); ?>"
				      method="get">


					<div class="form-group has-icon has-label">
						<label
							for="formSearchUpLocation3"><?php esc_html_e( 'Picking Up Location', 'rentit' ); ?></label>
						<input name="dropin" type="text" class="form-control formSearchUpLocation"
						       id="formSearchUpLocation3"
						       placeholder="<?php esc_html_e( 'Picking Up From', 'rentit' ); ?>"
						       value="<?php

						       if ( isset( $_GET['dropin'] ) ) {
							       echo esc_html( $_GET['dropin'] );
						       } else {
							       if ( function_exists( 'rentit_get_date_s' ) ) {
								       rentit_get_date_s( 'dropin_location' );
							       }
						       }
						       ?>"
						>
						<span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
					</div>


					<div class="form-group has-icon has-label">
						<label
							for="formSearchOffLocation3 ">  <?php esc_html_e( 'Dropping Off Location', 'rentit' ); ?></label>
						<input name="dropoff" type="text" class="form-control formSearchUpLocation"
						       id="formSearchOffLocation3"
						       placeholder="<?php esc_html_e( 'Dropping Off To', 'rentit' ); ?>"

						       data-provide="typeahead" data-items="4"
						       value="<?php
						       if ( isset( $_GET['dropoff'] ) ) {
							       echo esc_html( $_GET['dropoff'] );
						       } else {
							       if ( function_exists( 'rentit_get_date_s' ) ) {
								       rentit_get_date_s( 'dropoff_location' );
							       }
						       }


						       ?>"
						>

						<span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
					</div>

					<div class="form-group has-icon has-label">
						<label for="formSearchUpDate30"> <?php esc_html_e( ' Picking Up Date', 'rentit' ); ?></label>
						<input name="start_date" type="text" class="form-control" id="formSearchUpDate30"

						       placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>"
						       value="<?php
						       if ( isset( $_GET['start_date'] ) && ! empty( $_GET['start_date'] ) ) {
							       echo esc_attr( $_GET['start_date'] );
						       }
						       ?>"
						>
						<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
					</div>
	<div class="form-group has-icon has-label">
						<label for="formSearchUpDate30"> <?php esc_html_e( 'Dropping Off Date', 'rentit' ); ?></label>
						<input name="end_date" type="text" class="form-control" id="formSearchOffDate300"

						       placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>"
						       value="<?php
						       if ( isset( $_GET['end_date'] ) && ! empty( $_GET['end_date'] ) ) {
							       echo esc_attr( $_GET['end_date'] );
						       }
						       ?>"
						>
						<span class="form-control-icon"><i class="fa fa-calendar"></i></span>
					</div>


					<div class="form-group selectpicker-wrapper">
						<label><?php esc_html_e( 'Select type', 'rentit' ); ?></label>
						<?php
						$cat = ( isset( $_GET['cat'] ) ) ? $_GET['cat'] : "";

						$args = array(
							'class'       => 'selectpicker input-price',
							'name'        => 'c_cat',
							'show_count'  => 0,
							'hierarchica' => 1,
							'taxonomy'    => 'product_group',
							'selected'    => $cat,
							'echo'        => 0,

						);
						?>

						<select name="Car_Group"
						        class="selectpicker input-price" data-live-search="true"
						        data-width="100%"
						        data-toggle="tooltip" title="<?php esc_html_e( 'Select', 'rentit' ); ?>">
							<option value="-1">---</option>
							<?php
							$cats     =  get_terms('product_group','hide_empty=1' );



							$cat_get  = ( isset( $_GET['c_cat'] ) ) ? (int) $_GET['c_cat'] : "";
							$cat_grup = '';
							if ( isset( $_GET['Car_Group']{0} ) ) {
								$cat_grup = sanitize_text_field( $_GET['Car_Group'] );
							}


							foreach ( $cats as $cat ) {
								if ( ! isset( $cat->name ) ) {
									continue;
								}
								//var_dump($cat);
								?>
								<option
									value='<?php echo (int) $cat->term_id ?>'
									<?php
									if ( is_numeric( $cat_grup ) && (int) $cat_grup > 0 ) {

										if ( (int) $cat->term_id == $cat_grup ) {
											echo 'selected="selected"';
										}
									} else {

										if ( md5( trim( $cat->name ) ) == md5( trim( $cat_grup ) ) ) {
											echo 'selected="selected"';
										}
									}

									?>

								><?php echo esc_html( $cat->name ); ?></option>
							<?php } ?>
						</select>


					</div>
					<div class="form-group selectpicker-wrapper">
						<label><?php esc_html_e( 'Select Category', 'rentit' ); ?></label>
						<?php
						$cat = ( isset( $_GET['cat'] ) ) ? $_GET['cat'] : "";

						$args = array(
							'class'       => 'selectpicker input-price',
							'name'        => 'c_cat',
							'show_count'  => 0,
							'hierarchica' => 1,
							'taxonomy'    => 'product_cat',
							'selected'    => $cat,
							'echo'        => 0,

						);





							//************************************************/
						?>

						<select name="c_cat"
						        class="selectpicker input-price" data-live-search="true"
						        data-width="100%"
						        data-toggle="tooltip" title="<?php esc_html_e( 'Select', 'rentit' ); ?>">
							<option value="-1">---</option>
							<?php
							$cats    = get_terms('product_cat','hide_empty=1' );


							$cat_get = ( isset( $_GET['c_cat'] ) ) ? (int) $_GET['c_cat'] : "";

							foreach ( $cats as $cat ) {
								if ( ! isset( $cat->name ) ) {
									continue;
								}
								?>
								<option
									value='<?php echo (int) $cat->term_id ?>' <?php if ( (int) $cat->term_id == $cat_get ) {
									echo 'selected="selected"';
								} ?>><?php echo esc_html( $cat->name ); ?></option>
							<?php } ?>
						</select>


					</div>

					<button type="submit" id="formSearchSubmit3"
				        class="btn btn-submit btn-theme btn-theme-dark btn-block"> <?php  esc_html_e('Find','rentit'); ?>
					</button>

				</form>
			</div>
			<!-- /Search form -->
		</div>
		<?php
		echo wp_kses_post( $after_widget );
	}


	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}


}

class rentit_PRICE_FILTER_class extends WP_Widget {

	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent IT PRICE filter', 'rentit' ),
			'description' => esc_html__( 'It displays Filter price', 'rentit' ),
			'classname'   => 'widget-filter-price'
		);
		parent::__construct( '', '', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'       => esc_html__( 'PRICE', 'rentit' ), // Legacy.
				'text_button' => esc_html__( 'Filter', 'rentit' ), // Legacy.

			)
		);

		extract( $instance );

		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'text_button' ) ) ); ?>"> <?php esc_html_e( 'text_button:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'text_button' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'text_button' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $text_button ) ) {
				       echo esc_attr( $text_button );
			       } ?>">
		</p>
		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		//default values
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'       => esc_html__( 'PRICE', 'rentit' ), // Legacy.
				'text_button' => esc_html__( 'Filter', 'rentit' ), // Legacy.

			)
		);


		extract( $args );
		extract( $instance );

		// Create a filter to the other plug-ins can change them
		$title         = sanitize_text_field( apply_filters( 'widget_title', $title ) );
		$before_widget = str_ireplace( 'class="widget"', 'class="widget widget-tag-cloud"', $before_widget );
		echo wp_kses_post( $before_widget . "" );
		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );
		?>

		<div class="">
			<form action="<?php echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) ); ?>"
			      method="get">
				<div id="slider-range"></div>
				<?php

				if ( isset( $_GET['price_filter'] ) ) {
					$price = sanitize_text_field( urldecode( @$_GET['price_filter'] ) );

					$price = explode( ',', $price );
					?>
					<input
						data-min="<?php echo (int) esc_attr( get_theme_mod( 'rentit_filter_price_min', '1' ) ); ?>"
						data-max="<?php echo (int) esc_attr( get_theme_mod( 'rentit_filter_price_max', '300' ) ); ?>"
						data-value_min="<?php echo esc_attr( $price[0] ); ?>"
						data-value_max="<?php echo esc_attr( $price[1] ); ?>" value=""
						type="text" id="amount" readonly/>
					<?php
				} else {
					?>
					<input
						data-min="<?php echo (int) esc_attr( get_theme_mod( 'rentit_filter_price_min', '1' ) ); ?>"
						data-max="<?php echo (int) esc_attr( get_theme_mod( 'rentit_filter_price_max', '300' ) ); ?>"
						data-value_min="<?php echo (int) esc_attr( get_theme_mod( 'rentit_filter_price_min', '1' ) ); ?>"
						data-value_max="<?php echo (int) esc_attr( get_theme_mod( 'rentit_filter_price_max', '300' ) ); ?>"
						value=""
						type="text" id="amount" readonly/>
					<?php
				}
				?>

				<input name="price_filter" type="hidden" id="amout_rating" value="">
				<button type="submit" class="btn btn-theme btn-theme-dark">
					<?php echo esc_html( $text_button ); ?>
				</button>
			</form>
		</div>

		<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}


}

class  rentit_DETAIL_RESERVATION_class extends WP_Widget {
	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent IT DETAIL RESERVATION', 'rentit' ),
			'description' => esc_html__( 'It displays DETAIL RESERVATION', 'rentit' ),
			'classname'   => 'widget-details-reservation'
		);
		parent::__construct( '', '', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => esc_html__( 'DETAIL RESERVATION', 'rentit' ), // Legacy.


			)
		);

		extract( $instance );

		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"> <?php esc_html_e( 'Title:',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'title' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'title' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $title ) ) {
				       echo esc_attr( $title );
			       } ?>">
		</p>
		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
	function widget( $args, $instance ) {
		//default values
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => esc_html__( 'DETAIL RESERVATION', 'rentit' ), // Legacy.

			)
		);


		extract( $args );
		extract( $instance );
		?>

		<?php
		global $wpdb;
		// Create a filter to the other plug-ins can change them
		$title         = sanitize_text_field( apply_filters( 'widget_title', $title ) );
		$before_widget = str_ireplace( 'class="widget"', 'class="widget widget-tag-cloud"', $before_widget );
		$res           = null;
		if ( rentit_plugin_activate() ) {
			$res = $wpdb->get_results(
				$wpdb->prepare( "SELECT  *  FROM `{$wpdb->prefix}rentit_booking` WHERE `user_id` = %d",
					get_current_user_id()

				)

			);
		}
		if ( count( $res ) < 1 ) {
			return;
		}
		echo wp_kses_post( $before_widget . "" );
		echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );


		?>
		<div class="">
			<?php
			
			if ( function_exists( 'wc_get_order' ) && count( $res ) > 0 && get_current_user_id() > 0 ) {
				foreach ( $res as $item1 ) {
					$order_id = $item1->order_id;
					$arr_ress = array();


					/*****************************************************************/
					$order = wc_get_order( $item1->order_id );
					if ( method_exists( $order, 'get_items' ) ) {

						$line_items = $order->get_items( apply_filters( 'woocommerce_admin_order_item_types', 'line_item' ) );

						foreach ( $line_items as $item_id => $item2 ) {
							if ( $metadata = $order->has_meta( $item_id ) ) {

								foreach ( $metadata as $meta ) {

									// Skip hidden core fields
									if ( in_array( $meta['meta_key'], apply_filters( 'woocommerce_hidden_order_itemmeta', array(
										'_qty',
										'_tax_class',
										'_product_id',
										'_variation_id',
										'_line_subtotal',
										'_line_subtotal_tax',
										'_line_total',
										'_line_tax',
									) ) ) ) {
										continue;
									}     // Skip serialised meta
									if ( is_serialized( $meta['meta_value'] ) ) {
										continue;
									}

									//}
									if ( ( $meta['meta_key'] ) == 'Dropping Off Location' ) {
										$arr_ress['Dropping'] = $meta['meta_value'];
									}

									if ( ( $meta['meta_key'] ) == 'Picking Up Location' ) {
										$arr_ress['Picking'] = $meta['meta_value'];
									}


								}

								?>

								<h5 class="widget-title-sub">
									<?php esc_html_e( 'Picking Up Location', 'rentit' ); ?>
								</h5>
								<div class="media">
									<span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
									<div class="media-body"><p>
											<?php echo date_i18n( "d M Y / h:m", $item1->dropin_date ); ?>
										</p></div>
								</div>
								<div class="media">
									<span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
									<div class="media-body">
										<p> <?php esc_html_e( 'From', 'rentit' ); ?><?php echo esc_html( $arr_ress['Picking'] ); ?></p>
									</div>
								</div>
								<h5 class="widget-title-sub"> <?php esc_html_e( 'Droping Off Location', 'rentit' ); ?></h5>
								<div class="media">
									<span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
									<div class="media-body"><p>
											<?php echo date_i18n( "d M Y / h:m", $item1->dropoff_date ); ?></p></div>
								</div>
								<div class="media">
									<span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
									<div class="media-body">
										<p> <?php esc_html_e( 'From', 'rentit' ); ?><?php echo esc_html( $arr_ress['Dropping'] ); ?></p>
									</div>
								</div>


								<?php


							}
						}
						/********************************************************************/
					}
				}
			} else {
				?>
				<h5 class="widget-title-sub"><?php esc_html_e( 'You have not selected any car...', 'rentit' ); ?> </h5>
				<?php

			}
			?>


			<!--div class="button">
                <a href="#" class="btn btn-block btn-theme btn-theme-dark">Update Reservation</a>
            </div-->
		</div>

		<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

}


class  rentit_Car_tab_class extends WP_Widget
{
	function __construct() {
		$args = array(
			'name'        => esc_html__( 'Rent IT Cars Tab', 'rentit' ),
			'description' => esc_html__( 'It displays product', 'rentit' ),
			'classname'   => 'widget-tabs'
		);
		parent::__construct( '', '', $args );

	}

	/**
	 * method to display in the admin
	 *
	 * @param $instance
	 */
	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'text_button' => esc_html__( 'View More', 'rentit' ), // Legacy.
				'max'         => 3, // Legacy.
				'more_url'    => "#"


			)
		);

		extract( $instance );

		?>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'max' ) ) ); ?>"> <?php esc_html_e( 'How showas items?',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'max' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'max' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $max ) ) {
				       echo esc_attr( $max );
			       } ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'more_url' ) ) ); ?>"> <?php esc_html_e( 'Insert url View More ',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'more_url' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'more_url' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $more_url ) ) {
				       echo esc_attr( $more_url );
			       } ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'text_button' ) ) ); ?>"> <?php esc_html_e( 'View More text',
					'rentit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'text_button' ) ) ); ?>"
			       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'text_button' ) ) ); ?>" type="text"
			       value="<?php if ( isset( $text_button ) ) {
				       echo esc_attr( $text_button );
			       } ?>">
		</p>
		<?php
	}

	/**
	 * frontend for the site
	 *
	 * @param $args
	 * @param $instance
	 */
function widget( $args, $instance )
{
	//default values
	global $Rent_IT_class;
	$instance = wp_parse_args(
		(array) $instance,
		array(
			'text_button' => esc_html__( 'View More', 'rentit' ), // Legacy.
			'max'         => 3, // Legacy.
			'more_url'    => "#"


		)
	);

	extract( $args );
	extract( $instance );
	?>

	<div class="widget widget-tabs">
		<div class="">
			<ul id="tabs" class="nav nav-justified">
				<li><a href="#tab-s1" data-toggle="tab">
						<?php esc_html_e( 'Top', 'rentit' ); ?>
					</a>
				</li>
				<li class="active"><a href="#tab-s2" data-toggle="tab">
						<?php esc_html_e( 'Sale Off', 'rentit' ); ?>
					</a>
				</li>

			</ul>
			<div class="tab-content">
				<!-- tab 1 -->
				<?php


				$post_args = array(
					'post_type'           => 'product',
					'posts_per_page'      => $max,
					'ignore_sticky_posts' => 1,
					'orderby'             => 'rand',
					'meta_query'          => array(
						array( 'key' => '_thumbnail_id' ),
						array(
							'key'     => '_base_cost',
							'value'   => 0,
							'compare' => '>',
						)
					)
				);


				$post     = new WP_Query( $post_args );
				$currency = get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) );
				?>
				<div class="tab-pane fade" id="tab-s1">
					<div class="product-list">


						<?php if ( $post->have_posts() ) : ?>
							<?php while ( $post->have_posts() ) : $post->the_post(); ?>
								<div class="media">
									<a class="pull-left media-link" href="#">
										<img src="<?php $Rent_IT_class->get_post_thumbnail( $post->ID, 70, 70 ); ?>"
										     alt="<?php the_title(); ?>">
										<i class="fa fa-plus"></i>
									</a>
									<div class="media-body">
										<h4 class="media-heading">
											<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php the_title(); ?></a>
										</h4>
										<div class="rating">
											<span class="star active"></span>
											<span class="star active"></span>
											<span class="star active"></span>
											<span class="star active"></span>
											<span class="star active"></span>
										</div>
										<div class="price">
											<ins><?php
												echo esc_html( $currency . " " . rentit_get_current_price_product( get_the_ID() ) ); ?>
											</ins>
											<?php $sale_cost = get_post_meta( get_the_ID(), "_sale_cost", true );
											if ( isset( $sale_cost{0} ) ): ?>
												<del> <?php echo esc_html( $currency . " " . $sale_cost ); ?></del>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif;
						wp_reset_postdata(); ?>
					</div>
				</div>

				<!-- tab 2 -->

				<?php


				$post_args = array(
					'post_type'           => 'product',
					'posts_per_page'      => $max,
					'ignore_sticky_posts' => 1,
					'meta_query'          => array( array( 'key' => '_thumbnail_id' ), array( 'key' => '_sale_cost' ) )
				);


				$post = new WP_Query( $post_args );

				?>
				<div class="tab-pane fade active in" id="tab-s2">
					<div class="product-list">


						<?php if ( $post->have_posts() ) : ?>
							<?php while ( $post->have_posts() ) : $post->the_post(); ?>
								<div class="media">
									<a class="pull-left media-link" href="#">
										<img src="<?php $Rent_IT_class->get_post_thumbnail( $post->ID, 70, 70 ); ?>"
										     alt="<?php the_title(); ?>">
										<i class="fa fa-plus"></i>
									</a>
									<div class="media-body">
										<h4 class="media-heading">
											<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php the_title(); ?></a>
										</h4>
										<div class="rating">
											<span class="star active"></span>
											<span class="star active"></span>
											<span class="star active"></span>
											<span class="star active"></span>
											<span class="star active"></span>
										</div>
										<div class="price">
											<ins><?php
												$base_cost = get_post_meta( get_the_ID(), "_base_cost", true );
												echo esc_html( $currency . " " . $base_cost ); ?>
											</ins>
											<?php $sale_cost = get_post_meta( get_the_ID(), "_sale_cost", true );
											if ( isset( $sale_cost{0} ) ): ?>
												<del> <?php echo esc_html( $currency . " " . $sale_cost ); ?></del>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif;
						wp_reset_postdata(); ?>
					</div>
				</div>


			</div>
			<a class="btn btn-theme btn-theme-dark btn-theme-sm btn-block"
			   href="<?php echo esc_url( $more_url ); ?>"><?php esc_html_e( 'View More', 'rentit' ); ?></a>
		</div>


		<?php
		echo wp_kses_post( $after_widget );
		}

		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}

		}




class  rentit_order_manage extends WP_Widget
		{
		function __construct() {
			$args = array(
				'name'        => esc_html__( 'Rent order manager', 'rentit' ),
				'description' => esc_html__( 'order manager', 'rentit' ),
				'classname'   => 'widget-manager '
			);
			parent::__construct( '', '', $args );

		}


		/**
		 * method to display in the admin
		 *
		 * @param $instance
		 */
		function form( $instance ) {
			$instance = wp_parse_args(
				(array) $instance,
				array(
					'text_button' => esc_html__( 'View More', 'rentit' ), // Legacy.
					'max'         => 3, // Legacy.
					'more_url'    => "#"


				)
			);

			extract( $instance );

			?>
			<p>
				<label
					for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'max' ) ) ); ?>"> <?php esc_html_e( 'How showas items?',
						'rentit' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'max' ) ) ); ?>"
				       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'max' ) ) ); ?>" type="text"
				       value="<?php if ( isset( $max ) ) {
					       echo esc_attr( $max );
				       } ?>">
			</p>
			<p>
				<label
					for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'more_url' ) ) ); ?>"> <?php esc_html_e( 'Insert url View More ',
						'rentit' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'more_url' ) ) ); ?>"
				       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'more_url' ) ) ); ?>" type="text"
				       value="<?php if ( isset( $more_url ) ) {
					       echo esc_attr( $more_url );
				       } ?>">
			</p>
			<p>
				<label
					for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'text_button' ) ) ); ?>"> <?php esc_html_e( 'View More text',
						'rentit' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( esc_attr( $this->get_field_id( 'text_button' ) ) ); ?>"
				       name="<?php echo esc_attr( esc_attr( $this->get_field_name( 'text_button' ) ) ); ?>" type="text"
				       value="<?php if ( isset( $text_button ) ) {
					       echo esc_attr( $text_button );
				       } ?>">
			</p>
			<?php
		}

		/**
		 * frontend for the site
		 *
		 * @param $args
		 * @param $instance
		 */
		function widget( $args, $instance )
		{
		//default values
		global $Rent_IT_class;
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'text_button' => esc_html__( 'View More', 'rentit' ), // Legacy.
				'max'         => 3, // Legacy.
				'more_url'    => "#"


			)
		);

		extract( $args );
		extract( $instance );
		//echo wp_kses_post( $before_widget . "" );
	//	echo wp_kses_post( $before_title ) . esc_attr( $title ) . wp_kses_post( $after_title );

		?>
<div class="widget widget-tabs alt row">
   <div class="widget-content">
      <ul id="alt-tabs" class="nav nav-justified">
         <li class="active">
            <a href="#alt-tab-s1" data-toggle="tab">
            <?php  esc_html_e('RESERVE','rentit'); ?>
            </a>
         </li>
         <li><a href="#alt-tab-s2"
            data-toggle="tab"><?php esc_html_e('MODIFY','rentit')   ?>
            </a>
         </li>
      </ul>
      <div class="tab-content">
         <!-- tab 1 -->
         <div class="tab-pane fade in active" id="alt-tab-s1">
            <div class="form-search light ">
            <form action="<?php
                                if (function_exists('wc_get_page_id')) {
                                    echo esc_url(get_permalink(wc_get_page_id(('shop'))));
                                }

                                ?>">


                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                        for="formSearchUpLocation2">     <?php esc_html_e('Picking Up Location', 'rentit'); ?></label>
                                                    <input name="dropin" type="text"
                                                           class="form-control formSearchUpLocation"
                                                           placeholder="<?php esc_html_e('Airport or Anywhere',
                                                               'rentit'); ?>"
                                                           value="<?php
                                                           if (function_exists('rentit_get_date_s'))
                                                               {rentit_get_date_s('dropin_location');}
                                                           ?>"

                                                    >

                                                    <span class="form-control-icon"><i
                                                            class="fa fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                        for="formSearchOffLocation2">   <?php esc_html_e('Dropping Off Location', 'rentit'); ?></label>
                                                    <input name="dropoff" type="text"
                                                           class="form-control formSearchUpLocation"
                                                           value="<?php
                                                           if (function_exists('rentit_get_date_s'))
                                                               {rentit_get_date_s('dropoff_location');}
                                                           ?>"
                                                           placeholder="<?php esc_html_e('Airport or Anywhere', 'rentit'); ?>">
                                                                    <span class="form-control-icon"><i
                                                                            class="fa fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                        for="formSearchUpDate50">    <?php esc_html_e(' Picking Up Date', 'rentit'); ?></label>
                                                    <input name="start_date" type="text" class="form-control"
                                                           id="formSearchUpDate50"
                                                           value="<?php
                                                           if (function_exists('rentit_get_date_s'))
                                                               {rentit_get_date_s('dropin_date');}
                                                           ?>"
                                                           placeholder="<?php esc_html_e('dd/mm/yyyy', 'rentit'); ?>">
                                                                    <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label for="formSearchOffDate50">
                                                        <?php esc_html_e('Dropping Off Date', 'rentit'); ?></label>
                                                    <input name="end_date" type="text" class="form-control"
                                                           id="formSearchOffDate50"
                                                           value="<?php
                                                           if (function_exists('rentit_get_date_s'))
                                                               {rentit_get_date_s('dropoff_date');}
                                                           ?>"
                                                           placeholder="<?php esc_html_e('dd/mm/yyyy', 'rentit'); ?>">
                                                                    <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-submit">
                                        <div class="row container-fluid">
                                            <div class="inner">
                                                <i class="fa fa-plus-circle"></i> <a
                                                    href="<?php
                                                    if (function_exists('wc_get_page_id'))
                                                        {echo esc_url(get_permalink(wc_get_page_id(('shop'))));} ?>">
                                                    <?php esc_html_e(' Advanced Search', 'rentit'); ?>
                                                </a>
                                                <button type="submit" id="formSearchSubmit2"
                                                        class="btn btn-submit btn-theme ripple-effect pull-right">
                                                    <?php esc_html_e('RESERVE','rentit'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form> </div>
         </div>
         <!-- /.tab-pane -->
         <!-- tab 2 -->
         <div class="tab-pane fade" id="alt-tab-s2">
            <div class="recent-post">
test
            </div>
            <!-- /.recent-post -->
         </div>
      </div>

   </div>
</div>
	<?php
	//echo wp_kses_post( $after_widget );
}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

}



