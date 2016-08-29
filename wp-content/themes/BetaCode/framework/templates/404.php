<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying the 404 page
 */
US_Layout::instance()->sidebar_pos = 'none';
?>
<?php get_header() ?>
<div class="l-main">
	<div class="l-main-h i-cf">

		<div class="l-content">

			<section class="l-section">
				<div class="l-section-h i-cf">

					<?php do_action( 'us_before_404' ) ?>

					<div class="page-404">

						<?php

						$the_content = '<h1 style="font-family:ubuntu">'.__( 'Page Not Found', 'us' ).'</h1>
									<p style="font-family:ubuntu">'.__( 'Maaf, halaman ini tidak tersedia.', 'us' ).'</p>
									<p style="font-family:ubuntu">'.__( 'Tautan yang Anda ikuti mungkin telah rusak, atau halaman telah dihapus..', 'us' ).'</p>';
						echo apply_filters( 'us_404_content', $the_content );

						?>

					</div>

					<?php do_action( 'us_after_404' ) ?>

				</div>
			</section>

		</div>

	</div>
</div>
<?php get_footer() ?>
