<?php
/**
 * Template Name: List Job
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
the_post();

?>

<main id="site-content" role="main">
<?php 
			$img = get_the_post_thumbnail_url();
			?>
				<div class="jobs-banner text-center" style="background-image: url(<?php echo $img; ?>)">
				<div class="blur" ></div>
				<div class="section-inner">
				<div class="jobs-search">
					<input placeholder="Search" />
					<select>
						<option>Hồ Chí Minh</option>
						<option>Hồ Chí Minh</option>
						<option>Hồ Chí Minh</option>
						<option>Hồ Chí Minh</option>
						<option>Hồ Chí Minh</option>
						<option>Hồ Chí Minh</option>
						<option>Hồ Chí Minh</option>
					</select>
					<button>Search</button>
				</div>
				</div>
				</div>
			<?php
?>
<div class="section-inner">
	<?php
	$param = array(
		'paged'         => $paged, 
		'order'         => 'asc',
		'post_status'   => 'publish',
		'nopaging'		=> false,
		'posts_per_page'=> 1,
		'offset'       	=> 0,
		'post_type'		=> 'company',
		'orderby'		=> 'desc'
	);
	$query = new WP_Query($param);

	?>
	<h3 class="text-center">Featured Companies</h3>
	<p class="text-center">Browse through our featured companies of the week</p>
	<?php 

	if ($query->have_posts()) {
		echo '<div class="list-post">';
		while ($query->have_posts()) { 
			$query->the_post(); 

			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
  			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;

			$item = '';
			$item .= '<div  class="post-event">';
			$item .= $img;

			$item .= '<div class="blur"></div>';
			$item .= '<div class="partner-img"><img src="'.get_field('partner_logo').'" /></div>';
			$item .= '<div class="post-event-content">';
			$item .= '<h2 class="partner">'.get_field('partner_name').'</h2>'; 
			$item .= '<a href="'.get_the_permalink().'"><h3 class="title">'.get_the_title().'</h3></a>';
			$item .= '</div>';
			$item .= '</div>';

			echo $item;

		}
		echo '</div>';
		wp_reset_postdata();
	}
 
	?>
</div>
</main><!-- #site-content -->

<style>
		.jobs-banner{
			padding: 300px 0  200px;
			background-size: cover;
			background-position: center;
			position: relative;

		}
		.jobs-banner .blur{
			position: absolute;
			top: 0;
			left:0;
			width: 100%;
			height: 100%;
			background: rgba(0,0,0,0.5);
		}
		 .jobs-search{
			position: relative;
			z-index: 1;
			background: white;
			border-radius: 10px;
			padding: 20px;
		}
		.jobs-search select,
		.jobs-search input{
			width: 40%;
			height: 60px;
			background: #ddd;
			border: 1px solid #ccc;
			padding-left: 20px;
			border-radius: 5px;
			font-weight:bold;
			font-size: 16px;
		}
		.jobs-search button{
			height: 60px;
			border-radius: 5px;
			width: 20%;
			background: black;
			font-size: 16px;
			font-weight:bold;
			text-align: center;

		}
</style>

<?php echo do_shortcode('[signup]'); ?>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>
