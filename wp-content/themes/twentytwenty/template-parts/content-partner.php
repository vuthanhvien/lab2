<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */ 
$currentUrl = $_SERVER['REQUEST_URI'];

	$paths = explode( '/', $currentUrl);
$userId = 	$paths[2];

$name = get_user_meta($userId, 'first_name', true).' '. get_user_meta($userId, 'last_name', true);
$description = get_user_meta($userId, 'description', true);

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="partner-detail section-inner">
	 	<div class="partner-profile">
			 <div class="partner-avatar">
				 <?php echo get_avatar($userId) ?>
			 </div>
			 <div class="partner-content">
				 <h2><?php echo $name ?></h2>
				 <h4><?php echo $title ?></h4>
				 <p><?php get_field('total_follow') ?> <?php get_field('total_post') ?></p>
				 <p><?php echo $description ?></p>
			 </div>
			 <div class="partner-action">
				 <!-- <button class="btn">Follow</button> -->

				 <div>
					 <a><i class="fa fa-facebook"></i></a>
					 <a><i class="fa fa-twitter"></i></a>
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

</article><!-- .post -->
