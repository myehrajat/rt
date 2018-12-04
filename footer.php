<!-- FOOTER -->
<?php
$val           = wp_kses_post( get_post_meta( @$post->ID, '_rentit_shortcode_footer', true ) );
$rentit_header = wp_kses_post( get_post_meta( @$post->ID, 'rentit_hide_footer', true ) );
$is_shop       = false;
// contact form in shop
if ( function_exists( 'is_shop' ) && is_shop() ) {
	$is_shop   = true;
	$shortcode = wp_kses_post( get_theme_mod( 'rentit_c_form_s_val' ) );
	if ( isset( $shortcode ) && ! empty( $shortcode ) ) {
		echo do_shortcode( $shortcode );
	}
}
$hide_footer = get_post_meta( get_the_ID(), 'rentit_hide_footer', false );
//var_dump(get_post_meta());
if ( is_front_page() || $rentit_header == true || $is_shop ) { ?>
	<?php if ( isset( $val ) && ! empty( $val ) ):
		echo do_shortcode( wp_kses_post( $val ) );
	endif; ?>

	<footer class="footer">
		<?php if ( get_theme_mod( "footer_wigets", false ) == true ||  $hide_footer == false ): ?>
			<div class="footer-widgets">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'rentit_footer' ); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="footer-meta">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<p class="btn-row text-center">
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_facebook' ) ) > 8 ): ?>
								<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_facebook' ) ); ?>"
								   class="btn btn-theme btn-icon-left facebook"><i class="fa fa-facebook"></i>
									<?php esc_html_e( 'FACEBOOK', 'rentit' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_twitter' ) ) > 8 ): ?>
								<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_twitter' ) ); ?>"
								   class="btn btn-theme btn-icon-left twitter"><i class="fa fa-twitter"></i>
									<?php esc_html_e( 'TWITTER', 'rentit' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_PINTEREST' ) ) > 8 ): ?>
								<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_PINTEREST' ) ); ?>"
								   class="btn btn-theme btn-icon-left pinterest"><i class="fa fa-pinterest"></i>
									<?php esc_html_e( 'PINTEREST', 'rentit' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_google' ) ) > 8 ): ?>
								<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_google' ) ); ?>"
								   class="btn btn-theme btn-icon-left google"><i class="fa fa-google"></i>
									<?php esc_html_e( 'google', 'rentit' ) ?>
								</a>
							<?php endif; ?>
						</p>
						<div class="copyright">

							<?php

							$footer_copyright = get_theme_mod( "footer_copyright" );

							if ( strlen( $footer_copyright ) > 5 ) {
								echo( $footer_copyright );
							} else {
								?>
								&copy;      <?php echo esc_html( get_the_time( 'Y' ) ); ?>
								<?php esc_html_e( '  Rent It — An One Page Rental Car Theme made with passion by
                                jThemes Studio1', 'rentit' ); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
<?php } else { ?>
	<!-- FOOTER -->
	<?php if ( isset( $val ) && ! empty( $val ) ):
		echo do_shortcode( wp_kses_post( $val ) );
	endif; ?>
	<footer class="footer">
		<?php if ( $hide_footer == false ): ?>
			<div class="footer-widgets">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'rentit_footer' ); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="footer-meta">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<p class="btn-row text-center">
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_facebook' ) ) > 8 ): ?>
								<a href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_facebook' ) ); ?>"
								   class="btn btn-theme btn-icon-left facebook"><i class="fa fa-facebook"></i>
									<?php esc_html_e( 'FACEBOOK', 'rentit' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_twitter' ) ) > 8 ): ?>
								<a href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_twitter' ) ); ?>"
								   class="btn btn-theme btn-icon-left twitter"><i class="fa fa-twitter"></i>
									<?php esc_html_e( 'TWITTER', 'rentit' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_PINTEREST' ) ) > 8 ): ?>
								<a href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_PINTEREST' ) ); ?>"
								   class="btn btn-theme btn-icon-left pinterest"><i class="fa fa-pinterest"></i>
									<?php esc_html_e( 'PINTEREST', 'rentit' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( strlen( get_theme_mod( 'sotial_networks_control_google' ) ) > 8 ): ?>
								<a href="<?php echo esc_url( get_theme_mod( 'sotial_networks_control_google' ) ); ?>"
								   class="btn btn-theme btn-icon-left google"><i class="fa fa-google"></i>
									<?php esc_html_e( 'google', 'rentit' ) ?>
								</a>
							<?php endif; ?>
						</p>
						<div class="copyright">

							<?php
							$footer_copyright = get_theme_mod( "footer_copyright" );
							if ( strlen( $footer_copyright ) > 5 ) {
								echo( $footer_copyright );
							} else {
								?>
								&copy;      <?php echo esc_html( get_the_time( 'Y' ) ); ?>
								<?php esc_html_e( '  Rent It — An One Page Rental Car Theme made with passion by
                                jThemes Studio1', 'rentit' ); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /FOOTER -->
<?php } ?>
<!-- /FOOTER -->
<div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>
</div>
<!-- /WRAPPER -->

<script>
	jQuery(document).ready(function ($) {

		$('#tabs1 li a').click(function () {
			jQuery(window).trigger('resize');
		});
	});
</script>
<?php wp_footer(); ?>
</body>
</html>