<?php get_header();
?>
	<div class="content-area">
		<!-- BREADCRUMBS -->
		<!-- BREADCRUMBS -->
		<?php
		$brdc               = get_post_meta( $post->ID, '_rentit_breadcrumbs_aling', true );
		$rentit_breadcrumbs = ! empty( $brdc ) ? $brdc : "right";
		?>
		<section class="page-section breadcrumbs text-<?php echo esc_attr( $rentit_breadcrumbs ); ?>">
			<div class="container">
				<div class="page-header">
					<h1><?php the_title(); ?></h1>
				</div>
				<ul class="breadcrumb">
					<li><a href="<?php echo esc_url( get_home_url( '/' ) ); ?>">
							<?php esc_html_e( 'Home', 'rentit' ) ?>
						</a></li>
					<li class="active"> <?php the_title(); ?></li>
				</ul>
			</div>
		</section>
		<!-- /BREADCRUMBS -->
		<section class="page-section with-sidebar sub-page">
			<div class="container">
				<div class="row">
					<?php
					if ( get_theme_mod( 'rentit_sidebar_position', 's1' ) == 's1' ) {
						get_sidebar();
					}
					?>
					<!-- CONTENT -->
					<div class="col-md-9 content post-body" id="content">
						<?php if ( have_posts() ) : ?>
							<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();
								the_content();
							endwhile;
						else :
							// If no content, include the "No posts found" template.

						endif;
						if ( comments_open() || get_comments_number() ) :?>
							<section class="page-section no-padding of-visible">
								<h4 class="block-title">
									<?php esc_html_e( 'Comments', 'rentit' ); ?>
									<small class="thin">(<?php comments_number(); ?>)</small>
								</h4>
								<?php

								comments_template();
								?>
							</section>
						<?php endif; ?>
						<!-- /PAGE -->
					</div>
					<!-- /CONTENT -->
					<?php
					if ( get_theme_mod( 'rentit_sidebar_position', 's1' ) == 's2' ) {
						get_sidebar();
					}
					?>
				</div>
			</div>
		</section>
	</div>
<?php get_footer(); ?>