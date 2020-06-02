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

<h3 class="text-center">Featured Companies</h3>
<p class="text-center">Browse through our featured companies of the week</p>
<?php 

	$paramFirst = array(
		'paged'         => 0, 
		'order'         => 'desc',
		'post_status'   => 'publish',
		'posts_per_page'=> 1,
		'offset'       	=> 0,
		'post_type'		=> 'company',
		'orderby'		=> 'date'
	);
	$queryFirst = new WP_Query($paramFirst);
	if ($queryFirst->have_posts()) {
		echo '<div class="list-company">';
		while ($queryFirst->have_posts()) { 
			$queryFirst->the_post(); 

	?>
	<div class="company-first" style="background-image: url(<?php echo $img; ?>)">
	<div class="company-logo"><img src="<?php echo get_field('logo') ?>" /></div>
		<h3><?php the_title() ?></h3>
		<h5><?php echo join(', ', get_field('location')) ?></h5>
		<a class="button btn">View jobs</a>
	</div>
	<?php
		}
	}


	$param = array(
		'paged'         => 0, 
		'order'         => 'desc',
		'post_status'   => 'publish',
		'posts_per_page'=> 6,
		'offset'       	=> 1,
		'post_type'		=> 'company',
		'orderby'		=> 'date'
	);
	$query = new WP_Query($param);

	

	if ($query->have_posts()) {
		echo '<div class="list-company">';
		while ($query->have_posts()) { 
			$query->the_post(); 

			$item .= '<div  class="company-detail">';
			$item .= '<div class="company-detail-banner">'.get_the_post_thumbnail().'</div>';

			$item .= '<div class="company-logo"><img src="'.get_field('logo').'" /></div>';
			$item .= '<div class="company-content">';
			$item .= '<h5 class="text-center">'.get_the_title().'</h5>'; 
			$item .= '<p><i class="fa fa-tags" ></i>'.get_field('type').'</p>'; 
			$item .= '<p><i class="fa fa-map-marker" ></i>'.join(', ', get_field('location')).'</p>'; 
			$item .= '<p><i class="fa fa-users" ></i>'.get_field('total_employees').'</p>'; 
			$item .= '<p><i class="fa fa-star" ></i>'.get_field('description').'</p>'; 
			$item .= '</div>';
			$item .= '<div class="company-action">';
			$item .= '<button class="company-view-job">View jobs</button>';
			$item .= '<button class="company-view-company">View company</button>';
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
.company-first{
	margin: 50px 0;
	padding: 100px 20px;
}
.company-first h5,
.company-first h3{
	color: white;
	margin: 20px 0;
}
.company-first a{
	height: 55px !important;
}
.company-detail-banner{
	height: 200px;
	overflow: hidden;
}
.company-content h5{
	margin-top: 30px;
}
.company-content{
	padding: 15px;
}
.company-content p{
	font-weight: bold;
	color: #555;
}
.company-content p i{
	width: 30px;
}
.company-action{

}
.company-view-company,
.company-view-job{
	border-radius: 0;
	font-weight: bold;
	color: white;
	font-size: 16px;
	width: 50%;
	padding: 25px 0;
}
.company-view-job{
	border-right: 1px solid #fff3;
}
button.company-view-company:hover,
button.company-view-job:hover{
	background-color: #f9a64b;
}
	.company-detail{
		background: white;
		display: inline-block;
		width: calc((100% - 60px)/ 3);
		vertical-align: top;
		margin-right: 30px;
		margin-bottom: 40px;
		position: relative;
		overflow: hidden;
		border-radius: 10px;
	}

	.company-detail:nth-child(3n) {
    margin-right: 0;
}

	.company-detail .company-logo{
	    height: 100px;
		width: 100px;
		border-radius: 50px;
		background: white;
		z-index: 1;
		position: relative;
		margin: -50px auto -20px auto;
		border: 1px solid #eee;
		overflow: hidden;
	}
	.company-detail .company-logo img{
		height: 100%;
		width: 100%;
		object-fit: contain;
		object-position: center;
	}
	.jobs-banner{
		padding: 300px 0  100px;
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
		padding: 60px 20px;
	}
	.jobs-search select,
	.jobs-search input{
		width: 40%;
		height: 60px;
		background: #eee;
		border: 1px solid #ccc;
		padding-left: 20px;
		border-radius: 5px;
		font-weight:bold;
		font-size: 16px;
		vertical-align: top;
	}
	.jobs-search select{
		width: 20%;
		margin: 0 20px;
	}
	.jobs-search button{
		margin: 0 20px;
		vertical-align: top;
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
