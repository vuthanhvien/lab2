<?php
/**
 * Template Name: Content page
 * Template Post Type:  page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">
	<div class="section-inner" style="background: white; padding: 15px">
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content-page-content', get_post_type() );
		}
	}

	?>
	</div>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
