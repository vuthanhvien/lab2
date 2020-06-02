<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" class="company" role="main">
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();


			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() :  $first_img ;

			?>
				<div class="company-banner text-center" style="background-image: url(<?php echo $img; ?>)">
				<div class="blur" ></div>
				<div class="section-inner">
					<h3><?php the_title() ?></h3>
					<a>VIEW JOBS</a>
				</div>
				</div>
				<div class="company-content">
				<?php the_content() ?>
				</div>
				<div class="company-job">
				</div>
			<?php
		}
	}

	?>
	<style>
		.company-banner{
			padding: 200px 0  100px;
			background-size: cover;
			background-position: center;
			position: relative;

		}
		.company-banner .blur{
			position: absolute;
			top: 0;
			left:0;
			width: 100%;
			height: 100%;
			background: rgba(0,0,0,0.5);
		}
		.company-banner h3{
			font-size: 42px;
			position: relative;
			color: white;
			z-index: 1;
			margin-bottom: 70px;
		}
		.company-banner a{
			position: relative;
			z-index: 1;

			font-weight: bold;

			font-size: 18px;
			background: black;
			color: white;
			padding: 20px 20px;
			border-radius: 10px;
		}
		.company-content .blocks-gallery-grid {
			white-space: nowrap;
			display: block;
			overflow: hidden;
			padding-bottom: 180px;
			padding-top: 180px;
		}
		.company-content .blocks-gallery-grid .blocks-gallery-item{
			display: inline-block;
			width: 33%;
			
		}
		.company-content  .blocks-gallery-item figure{
			height: 300px;
			width: 100%;
		}
		.company-content  .blocks-gallery-item figure img{
			height: 100%;
			width: 100%;
			object-fit: cover;
			object-position: center;
		}
		.company-content .wp-block-columns {
			background-color: #ddd;
			margin-bottom: 0;
			height: 400px;
			overflow: hidden;
		}
		.company-content .wp-block-column:not(:first-child){
			margin-left: 0;
			padding-left: 0;
		}

		.company-content .wp-block-column p,
		.company-content .wp-block-column h4{
			padding-left: 50px;
			width: 500px;
			max-width: 100%;
			margin: 10px 0;
			text-align: justify;
		}
		.company-content .wp-block-columns:nth-child(2n + 1) p,
		.company-content .wp-block-columns:nth-child(2n + 1) h4{
			margin-left: calc((100vw - 1170px) / 2);
			
		}
		.company-content .wp-block-column h4{
			font-weight: normal;
			font-size: 50px;
		}
	</style>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
