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


?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php if($isView){  the_content(); }else{ ?>

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
	</div>

	<div class="post-content">
				<div class="post-header">
					<div class="post-author"><?php echo get_avatar( get_the_author_meta( 'ID' )) ?></div>
					<span class="post-author-name"><? echo get_the_author_meta('display_name') ?></span>
					<div class="post-space"></div>
						<img class="icon" src="/assets/heart.png" />
						<?php echo get_comments_number() ?>
						<img  class="icon" src="/assets/share.png" />
						<?php echo get_comments_number() ?>
						<img  class="icon" src="/assets/chat.png" />
						<?php echo get_comments_number() ?>
						
				</div>
				<div class="post-text">

				<?php the_excerpt(); ?>
				<div style="background: #f4f4f4; border: 1px solid #ccc; padding: 20px">
					<p>You don't have permission to read  this article, please login or subscice </p>
					<a style="color: #0D87D0" class="btn" href="/login"><b>Go to login</b></a> or <a style="color: #0D87D0"  class="btn" href="/subscrice"><b>Go to subscrice</b></a>
				</div>
			</div>
	</div>
	</div>
		<br />
		<br />
		<br />

		<?php }	?>

	

</article><!-- .post -->
