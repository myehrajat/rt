<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Advanced search widget
 * @package Rent It
 * @since Rent It 1.0
 */


class rentit_Widget_Advanced_Search extends rentit_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'rentit-widget-advanced-search widget';
		$this->widget_description = esc_html__( "Display advanced search form.2", 'rentit' );
		$this->widget_id          = 'rentit_widget_advanced_search';
		$this->widget_name        = esc_html__( 'Advanced Search', 'rentit' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Advanced Search', 'rentit' ),
				'label' => esc_html__( 'Title', 'rentit' )
			)
		);

		parent::__construct();
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );

			include(locate_template('template-parts/advanced-search.php'));

		$this->widget_end( $args );

	}


}
