<?php
/**
 * Template Name: User Template
 * Template Post Type:  page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
$currentUrl = $_SERVER['REQUEST_URI'];

	$paths = explode( '/', $currentUrl);
$userId = 	$paths[2];

$name = get_user_meta($userId, 'first_name', true).' '. get_user_meta($userId, 'last_name', true);
$description = get_user_meta($userId, 'description', true);
$title = get_user_meta($userId, 'title', true);

$facebook = get_user_meta($userId, 'facebook', true);
$twitter = get_user_meta($userId, 'twitter', true);



get_header();
?>

<main id="site-content" role="main">

	<div class="partner-detail section-inner">
	 	<div class="partner-profile">
			 <div class="partner-avatar">
				 <?php echo get_avatar($userId) ?>
			 </div>
			 <div class="partner-content">
				 <h2><?php echo $name ?></h2>
				 <p><i><?php echo $title ?></i></p>
				 <p><?php get_field('total_follow') ?> <?php get_field('total_post') ?></p>
				 <p><?php echo $description ?></p>
			 </div>
			 <div class="partner-action">
				 <!-- <button class="btn">Follow</button> -->

				 <div>
				 	<?php echo $facebook ? '<a href="'.$facebook.'"><i class="fa fa-facebook"></i></a>' : '' ?>
				 	<?php echo $twitter ? '<a href="'.$twitter.'"><i class="fa fa-twitter"></i></a>' : '' ?>
				 </div>
			 </div>
		 </div>
		 <div class="partner-bottom">
		 <div class="partner-posts">
			<?php echo do_shortcode('[posts fields="img,min-read,title,content,tag" author="'.$userId.'" limit="10"]') ?>
		 <div>
		 <div class="partner-sidebar">
			 <!-- <div class="news"></div> -->
		 </div>
		 <div>
	</div>

</main><!-- .post -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
