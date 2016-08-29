<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying all single posts and attachments
 */
$us_layout = US_Layout::instance();
// Needed for canvas class
//$us_layout->titlebar = 'default';
get_header();

$template_vars = array(
	'metas' => (array) us_get_option( 'post_meta', array() ),
	'show_tags' => in_array( 'tags', us_get_option( 'post_meta', array() ) ),
);
?>
<!-- MAIN -->
<div class="l-main">
	<div class="l-main-h i-cf">

		<main class="l-content" role="main" itemprop="mainContentOfPage">

			<?php do_action( 'us_before_single' ) ?>
			<?php
			while ( have_posts() ){
				the_post();

				us_load_template( 'templates/blog/single-post', $template_vars );
			}
			?>

			<?php do_action( 'us_after_single' ) ?>

		</main>

		<?php if ( $us_layout->sidebar_pos == 'left' OR $us_layout->sidebar_pos == 'right' ): ?>
			<aside class="l-sidebar at_<?php echo $us_layout->sidebar_pos ?>" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
				<?php generated_dynamic_sidebar(); ?>
			</aside>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
