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

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = urlencode($actual_link);




if ( have_posts() ) {

	while ( have_posts() ) {
		the_post();

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

if(!$isPremimum && !$isStandard){
	$isView = true;
}

$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
$first_img = $matches [1] [0];
$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;

$vi = $GLOBALS['vi'];
?>

<main id="site-content" class="book" role="main" style="background: white">
	 

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="section-inner book-detail">
		<h4>FULFILLING READING</h4>
		<h3 class="book-title"><?php the_title() ?></h3>
		<p>By <b><?php get_the_author_meta('display_name') ?></b> | <?php the_date() ?> <?php  echo get_field('minread')?> minute read </p>
		<br />
		<?php   echo $img ?>
		<br />
		<br />
		<div class="book-text">
			<div>
				<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $actual_link ?>" class="book-share">
					<i class="fa fa-twitter"></i>
				</a>
				<a  target="_blank" href="https://www.facebook.com/sharer/sharer.php=<?php echo $actual_link ?>" class="book-share">
					<i class="fa fa-facebook"></i>
				</a>
				<a  target="_blank" href="https://www.linkedin.com/shareArticle?mini=<?php echo $actual_link ?>" class="book-share">
					<i class="fa fa-linkedin"></i>
				</a>
				<a  target="_blank" href="mailto:sample@gmail.com?subject=Chienluocso&body=<?php echo $actual_link ?> " class="book-share">
					<i class="fa fa-envelope"></i>
				</a>
				<?php echo $post->comment_count ?>

			</div>
				<hr>
			<div class="book-content">
				<?php if($isView){   echo $post->post_content;  ?>
				<?php
				}else{
					the_excerpt();
					?>
					<div style="background: #f4f4f4; border: 1px solid #ccc; padding: 20px">
					<p>
					<?php echo $vi ? 'Bạn không có quyền xem bài viết, hãy đăng nhập hoặc subscribe' : "You don't have permission to read  this article, please login or subscice" ?>
						</p>
						<a style="color: #0D87D0" class="btn" href="/login"><b><?php echo !$vi ? 'Go to login' : 'Đi tới đăng nhập' ?></b></a> - 
						 <a style="color: #0D87D0"  class="btn" href="/Subscribe"><b><?php echo !$vi ? 'Go to login' : 'Đi tới đăng ký' ?> </b></a>
					</div>
					<?php
				 }
				 ?>
			</div>
		</div>
	</div>
	<div class="section-inner book-relative">
		<h4>FULFILLING READING</h4>
		<div>

		<?php echo do_shortcode('[posts type="book" limit=3 fields="img,title,content"]') ?>
		</div>
	</div>
	<div class="section-inner book-relative">
	<div class="book-comment-out">
		<h4>COMMENTS</h4>
	<div class="book-comment">
	<?php

		if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
			?>

			<div class="comments-wrapper section-inner">

				<?php comments_template(); ?>

			</div><!-- .comments-wrapper -->

			<?php
		}
	}
}
		?>
		</div>
		</div>
		</div>
 
	</div>
	</div>
</article>

<style>
	.comment-respond .comment-reply-title{
		display: none;
	}
	.book-comment #comments{
		/* display: none; */
	}
	.book-relative .post img{
		width: 100%;
		height: 200px;
		overflow: hidden;
		object-fit: cover;
		object-position: center; 
	}
	.book-relative .post h5.title{
		color: #333;
		margin: 15px 0;
		font-size: 20px;
	}

	.book-relative .post{
		width: calc((100% - 60px) / 3);
		margin-right: 30px;
		display: inline-block;
		vertical-align: top;
	}
	.book-relative .post:nth-child(3n){
		margin-right: 0;
	}
	.book-relative .post h5 a{
		color: #333;
	}
	.book-title{
		margin: 30px 0;
		font-size: 40px;
		color: #333;
	}
	.book-share{
		background: #333;
		color: white;
		font-size: 32px;
		border-radius: 30px;
		height: 60px;
		padding: 10px;
		width: 60px;
		margin-right: 20px;
		display: inline-block; 
		text-align: center;
	}
	.book-detail img{
		width: 100%
	}

.book-relative h4,
.book-detail h4{
	margin: 0;
	padding: 20px 0;
	text-decoration: underline;
	font-size: 24px;
	padding-top: 80px;
	color: #333;
}
.book-text p ,
.book-text h1,
.book-text h2,
.book-text h3,
.book-text h4,
.book-text h5,
.book-text h6,
.book-text li{
	padding-left: 30px;
	padding-right: 30px;
}
</style>
</main>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php echo do_shortcode('[contact-form-7 id="1476" title="Candidate"]'); ?>

<?php get_footer(); ?>
