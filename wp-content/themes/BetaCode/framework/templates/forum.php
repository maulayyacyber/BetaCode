<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying all single posts and attachments
 */
$us_layout = US_Layout::instance();

$us_layout->sidebar_pos = us_get_option( 'forum_sidebar', 'none' );
$us_layout->titlebar = ( us_get_option( 'titlebar_content', 'all' ) == 'hide' ) ? 'none' : 'default';

get_header();
us_load_template( 'templates/titlebar' );
?>
<!-- MAIN -->
<div class="l-main">
	<div class="l-main-h i-cf">

		<main class="l-content" role="main" itemprop="mainContentOfPage">
			<section class="l-section for_forum">
				<div class="l-section-h i-cf">
				<?php do_action( 'us_before_single' ) ?>

				<?php
				while ( have_posts() ){
					the_post();

					the_content();
				}
				?>

				<?php do_action( 'us_after_single' ) ?>
				</div>
			</section>
		</main>

		<?php if ( $us_layout->sidebar_pos == 'left' OR $us_layout->sidebar_pos == 'right' ): ?>
			<aside class="l-sidebar at_<?php echo $us_layout->sidebar_pos ?>" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
				<?php dynamic_sidebar( 'bbpress_sidebar' ); ?>
			</aside>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
