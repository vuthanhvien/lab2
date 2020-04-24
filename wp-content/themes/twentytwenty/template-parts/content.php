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

$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
$first_img = $matches [1] [0];
$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = urlencode($actual_link);


$post_type = get_post_type();

$user = wp_get_current_user();

$fields =  get_fields('user_'.$user->ID); 
$isView = false;

$isPremimum = get_field('is_premium');
$isStandard = get_field('is_standard');
if( $fields['date_end_premium'] > date('Y-m-d')  ){
    $isView = true;
}else{
	if($fields['date_end_standard'] > date('Y-m-d') && !$isPremimum ){
		$isView = true;
	}
}

if(!$isPremimum && !$isPremimum){
	$isView = true;
}

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-detail">
		<div class="post-banner">
			<?php echo $img ?>
		<div class="post-banner-content">
			<h1><?php echo get_the_title() ?></h1>
			<h3><?php echo get_the_date() ?></h3>
		</div>
		</div>
		<div class="post-main">
			<div class="post-sidebar">

			<p>Share</p>
				<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $actual_link ?>" class="post-share">
					<i class="fa fa-twitter"></i>
					<span>Tweet</span>
				</a>
				<a  target="_blank" href="https://www.facebook.com/sharer/sharer.php=<?php echo $actual_link ?>" class="post-share">
					<i class="fa fa-facebook"></i>
					<span>Share</span>
				</a>
				<a  target="_blank" href="https://www.linkedin.com/shareArticle?mini=<?php echo $actual_link ?>" class="post-share">
					<i class="fa fa-linkedin"></i>
					<span>Post</span>
				</a>
				<a  target="_blank" href="mailto:sample@gmail.com?subject=Chienluocso&body=<?php echo $actual_link ?> " class="post-share">
					<i class="fa fa-envelope"></i>
					<span>Sent</span>
				</a>
			
			</div>
			<div class="post-content">
				<div class="post-header">
					<div class="post-author"><?php echo get_avatar( get_the_author_meta( 'ID' )) ?></div>
					<span class="post-author-name"><? echo get_the_author_meta('display_name') ?></span>
					<div class="post-space"></div>
					<?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_ID().'" style="wpulike-heart"]'); ?>
					<img  class="icon  post-count-comment" src="/assets/chat.png" />
					<?php echo get_comments_number() ?>

					<div class="post-tag"><?php echo get_field('tag') ? get_field('tag') : 'Execution' ?></div>
						
				</div>
				<div class="post-video">
				<?php if(get_field('video_url')){
					?>
						<iframe width="100%" height="500" src="<?php echo get_field('video_url') ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<?php
				} ?>
				</div>
				<div class="post-text">
				<?php if($isView){  
					
					the_content(); 

					?>

				<hr>
					<div class="post-action">
						<?php echo do_shortcode('[wp_ulike for="post" id="'.get_the_ID().'" style="wpulike-heart"]'); ?>
					<button class="btn btn-warning" id="view-comment">
						<!-- <img class="icon" src="/assets/chat.png" /> -->
						<?php echo get_comments_number() ?> comments
					</button>

					</div>
					<hr>
				</div>

					<div class="post-next">
						<h3>Up Next</h3>
						<?php echo do_shortcode('[posts limit="4" fields="img,category,title" type="'.$post_type.'"]'); ?>
					</div>
					

					<?php
					
				}else{
					the_excerpt();
					?>
					<div style="background: #f4f4f4; border: 1px solid #ccc; padding: 20px">
						<p>You don't have permission to read  this article, please login or subscice </p>
						<a style="color: #0D87D0" class="btn" href="/login"><b>Go to login</b></a> or <a style="color: #0D87D0"  class="btn" href="/subscrice"><b>Go to subscrice</b></a>
					</div>
					<?php
				 }?>

					

			

				</div>
			</div>
		</div>

		<div class="post-relate-outer">
		<h3>Related Articles</h3>

		<div class="post-relate">
			<div class="post-relate-left">
			<?php 
			echo do_shortcode('[posts limit="1" fields="img,category,title" type="'.$post_type.'"]'); ?>
			</div>
			<div class="post-relate-right">
			<?php echo do_shortcode('[posts limit="4" fields="img,category,title" type="'.$post_type.'"]'); ?>
			</div>
		
		</div>
		</div>

	</div>


	<div class="post-comment-out">
	<div class="post-comment">
	<?php

		if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
			?>

			<div class="comments-wrapper section-inner">

				<?php comments_template(); ?>

			</div><!-- .comments-wrapper -->

			<?php
		}
		?>
		</div>
		</div>
 
	</div>
	</div>
</article><!-- .post -->
