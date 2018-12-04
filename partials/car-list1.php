<?php
$Rent_IT_class = rentit_get_Rent_IT_class();
$post_id       = get_the_ID();
?>

<div class="thumbnail no-border no-padding thumbnail-car-card">
	<div class="media">
		<a class="media-link" data-gal="prettyPhoto"
		   href="<?php $Rent_IT_class->get_post_thumbnail( $post_id, 370, 220, true ); ?>">
			<?php if ( has_post_thumbnail() ) { ?>

                <img src="<?php the_post_thumbnail_url( 'rentit-image-370x230-croped' ); ?>"
                     alt="<?php the_title(); ?>">

			<?php } ?>
                                                    <span class="icon-view">
                                                        <strong>
	                                                        <i class="fa fa-eye"></i>
                                                        </strong>
                                                    </span>
		</a>
	</div>
	<div class="caption text-center">
		<h4 class="caption-title"><a
				href="<?php echo esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
		</h4>
		<div class="caption-text">

			<?php
			echo wp_kses_post( $Rent_IT_class->get_price_with_text() ); ?>
		</div>
		<div class="buttons">

			<?php
			$url = get_the_permalink();

			if ( isset( $_COOKIE['rentit_order_id']{2} ) && isset( $_GET['edit_car'] ) ) {
				$data = array();
				if ( isset( $_GET['dropin'] ) ) {
					$data['dropin'] = urldecode( $_GET['dropin'] );
				}

				if ( isset( $_GET['dropoff'] ) ) {
					$data['dropoff'] = urldecode( $_GET['dropoff'] );
				}

				if ( isset( $_GET['start_date'] ) ) {
					$data['start_date'] = urldecode( $_GET['start_date'] );
				}

				if ( isset( $_GET['end_date'] ) ) {
					$data['end_date'] = urldecode( $_GET['end_date'] );
				}



				$url = rentit_get_permalink_by_template( 'template-order_edit.php' ) . '?order_id=' . $_COOKIE['rentit_order_id'] . '&last_name=' . $_COOKIE['rentit_billing_last_name'] . '&addcar_id=' . get_the_ID();
			}
			?>
			<a data-action="<?php echo esc_html( get_the_ID() ); ?>" class="btn btn-theme btn-theme-dark"
			   href="<?php echo esc_url( $url ); ?>"> <?php echo esc_html( apply_filters( 'rentit_rentit_text', esc_html__( 'Rent It', 'rentit' ) ) ); ?></a>
		</div>
		<table class="table">
			<tr>
				<td>
					<i class="fa fa-car"></i> <?php echo esc_html( get_post_meta( $post_id, '_rental_car_year', true ) ? get_post_meta( $post_id, '_rental_car_year', true ) : "2015" ); ?>
				</td>
				<td>
					<i class="fa fa-dashboard"></i> <?php echo esc_html( get_post_meta( $post_id, '_rental_car_engine', true ) ? get_post_meta( $post_id, '_rental_car_engine', true ) : esc_html__( "Diesel", "rentit" ) ); ?>
				</td>
				<td>
					<i class="fa fa-cog"></i> <?php echo esc_html( get_post_meta( $post_id, '_rental_car_transmission', true ) ? get_post_meta( $post_id, '_rental_car_transmission', true ) : esc_html__( "Auto", "rentit" ) ); ?>
				</td>
				<td>
					<i class="fa fa-road"></i> <?php echo esc_html( get_post_meta( $post_id, '_rental_car_mileage', true ) ? get_post_meta( $post_id, '_rental_car_mileage', true ) : "25000" ); ?>
				</td>
			</tr>
		</table>
	</div>
</div>