<?php
/**
 * Template Name: List Job search
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();

$search = $_GET['search'];
$location = $_GET['location'];

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$param = array(
	'paged'         => $paged, 
	'order'         => 'desc',
	'post_status'   => 'publish',
	'posts_per_page'=> 20,
	'offset'       	=> 0,
	'post_type'		=> 'job',
	'orderby'		=> 'date'
);
$query = new WP_Query($param);

$searchObj = array(
	'LOCATION' =>  array(
		'Hà Nội' => true,
		'Hồ Chí Minh' => false,
		'Đà Nãng' => true,
		'Singapore' => true,
	),
	'FUNCTION' =>  array(
		'Hà Nội' => true,
		'Hồ Chí Minh' => false,
		'Đà Nãng' => false,
		'Singapore' => false,
	),
	'YEARS OF EXP' =>  array(
		'Hà Nội' => false,
		'Hồ Chí Minh' => true,
		'Đà Nãng' => true,
		'Singapore' => true,
	),
	'INDUSTRY' =>  array(
		'Hà Nội' => false,
		'Hồ Chí Minh' => true,
		'Đà Nãng' => true,
		'Singapore' => true,
	),
	'TYPE' =>  array(
		'Full time' => false,
		'Part time' => false,
		'Remote' => false,
		'Freelancer' => false,
	),
	'SALARY' =>  array(
		'Dynamic' => false,
		'0-500' => false,
		'500-1000' => false,
		'1000-2000' => false,
		'2000-3000' => false,
		'3000+' => false,
	),
);




?>
<main id="site-content" role="main">

	<div class="search-job section-inner">
		<div class="form-search">
			<i style="position: absolute;  margin-top: 20px;  margin-left: 10px;" class="fa fa-search"></i>
			<input value="<?php  echo $search ?>" placeholder="Search by job title, company or skill" />
			<div class="dropdown-list">
				<?php foreach ($searchObj as $key => $obj){ ?>
				<div class="dropdown" id="dropdown-<?php echo $key ?>">
					<a><?php echo $key ?> <i class="fa fa-chevron-down" style="font-size: 12px" ></i></a>
					<div class="dropdown-menu">
						<i style="position: absolute;  margin-top: 15px;  margin-left: 10px;"  class="fa fa-search"></i>
						<input class="dropdown-filter"  placeholder="Filter"/>
						<?php foreach ($obj as $k => $option){ ?>
						<div class="dropdown-item <?php echo $option ? 'active' : '' ?>"><i class="fa fa-check" ></i> <?php echo $k ?></div>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<hr style="margin: 20px 0" />
		<div class="search-result" style="min-height: 500px">

		<?php

		if ($query->have_posts()) {

			while ($query->have_posts()) { 
				$query->the_post(); 

				?>

				<div class="job-detail">
					<div class="job-logo">
					
					
					</div>
					<div class="job-detail">
						<h4><?php the_title() ?></h4>
						<p>Copany name</p>
						<p><?php get_field('location') ?></p>
						<p><?php get_field('	') ?></p>
						<p><?php get_field('skills') ?></p>
					
					</div>
				</div>

				<?php
				print_r(get_field('company'));
				echo '<br />';

			}
			
		}else{
			echo 'No job avalaible';
		}
		?>
		</div>
	</div>
</main>

<script>
jQuery('.dropdown-item').click(function(){
	if(jQuery(this).hasClass('active') ){
		jQuery(this).removeClass('active');
	}else{
		jQuery(this).addClass('active');
	}
	
})
</script>
<style>
.search-job{
	background: white;
	padding: 50px 20px;
	margin-top: 100px;
	margin-bottom: 100px;
}
.form-search {
	padding: 0 100px;

}
.form-search > input{
	border: 0;
	border-bottom: 1px solid #ccc;
	padding: 20px;
	display: block;
	width: 100%;
	font-size: 16px;
	font-weight: bold;
	margin-bottom: 15px;
	padding-left: 40px;
}
.search-job .dropdown{
	position: relative;
	display: inline-block;
	
}
.search-job .dropdown .dropdown-menu{
	display: none;
	position: absolute;
	top: 50px;
	left: 0;
	background: white;
	padding: 10px;
	box-shadow: 0px 0 5px rgba(0,0,0,0.2);
	min-width: 300px;
	max-height: 600px;
	overflow: auto;

}
.search-job .dropdown:hover .dropdown-menu,
.search-job .dropdown:active .dropdown-menu{
	display: block;
}
.search-job .dropdown .dropdown-menu input{
	font-size: 16px;
	display: block;
	padding: 15px 30px;
	width: 100%;
	padding-left: 40px;
	border: 0;
	border-bottom: 1px solid #ccc;
}

.search-job .dropdown a{
	display: inline-block;
	font-size: 16px;
	padding: 15px 10px;
	color: #555;
}
.search-job .dropdown .dropdown-menu .dropdown-item{
	font-weight: bold;
	opacity: 0.4;
	padding: 10px;
	cursor: pointer;
}
.search-job .dropdown .dropdown-menu .dropdown-item.active{
	opacity: 1;
}

.search-job .dropdown .dropdown-menu .dropdown-item.active i{
	color: #555;
}

.search-job .dropdown .dropdown-menu .dropdown-item:hover{
	background: #eee;
}

.search-job .dropdown .dropdown-menu .dropdown-item i{
	border: 1px solid #999;
	padding: 2px;
	font-size: 12px;
	width: 18px;
	display: inline-block;
	height: 18px;
	color: white;
	margin-right: 5px;
}
</style>


<?php echo do_shortcode('[signup]'); ?>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>
