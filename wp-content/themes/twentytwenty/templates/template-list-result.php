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
	'location' =>  array(
		'Hà Nội' => false,
		'Hồ Chí Minh' => false,
		'Đà Nãng' => false,
		'Singapore' => false,
	),
	'function' =>  array(
		'Web development' => false,
		'Sales & Business Development' => false,
		'Finance, Legal & Accounting' => false,
		'Marketing & PR' => false,
		'Enterprise Software & Systems' => false,
		'Data & Analytics' => false,
		'Project & Product management' => false,
		'Human Resource' => false,
		'UI/UX Design' => false,
		'DevOps & Cloud Management' => false,
		'Customer Service' => false,
		'Logistics & Operations' => false,
	),
	'year_of_exp' =>  array(
		'0-1 year' => false,
		'1-3 years' => false,
		'3-5 years' => false,
		'5+ year' => false,
	),
	'industry' =>  array(
		'Ecommerce' => false,
		'Professional Services' => false,
		'Financial Tech' => false,
		'Clean Tech' => false,
		'Health' => false,
		'General Internet' => false,
		'Software as a service' => false,
		'AI' => false,
		'Meida' => false,
		'Gaming' => false,
		'Logictics & Transportation' => false,
	),
	'type' =>  array(
		'Full time' => false,
		'Part time' => false,
		'Remote' => false,
		'Freelancer' => false,
	),
	'salary' =>  array(
		'Dynamic' => false,
		'$0-$500' => false,
		'$500-$1000' => false,
		'$1000-$2000' => false,
		'$2000-$3000' => false,
		'$3000+' => false,
	),
);
foreach ($searchObj as $key => $type){
	foreach($type as $menu => $child){
		if(isset($_GET[$key]) && $_GET[$key]){
			$arrayCheck = explode(',', $_GET[$key]);
			if(in_array($menu, $arrayCheck)){
				$searchObj[$key][$menu]= true;
			}
		}
	}
}
    



?>
<main id="site-content" role="main">

	<div class="search-job section-inner">
		<form class="form-search">
			<i style="position: absolute;  margin-top: 20px;  margin-left: 10px;" class="fa fa-search"></i>
			<input name="search" value="<?php  echo $search ?>" placeholder="Search by job title, company or skill" />
			
			<div class="dropdown-list">
				<?php foreach ($searchObj as $key => $obj){ 
					$isHave = false;
					foreach ($obj as $k => $option){
						if($option) {$isHave = true;}
					}
					?>
					<input type="hidden" name="<?php echo $key ?>" id="input-<?php echo $key ?>" />
					<div class="dropdown <?php echo $isHave ? 'active' : '' ?> " id="dropdown-<?php echo $key ?>">
						<a><?php echo $key ?> <i class="fa fa-chevron-down" style="font-size: 12px" ></i></a>
						<div class="dropdown-menu">
							<i style="position: absolute;  margin-top: 15px;  margin-left: 10px;"  class="fa fa-search"></i>
							<input class="dropdown-filter"  placeholder="Filter"/>
							<?php foreach ($obj as $k => $option){ ?>
							<div data-type="<?php echo $key ?>" class="dropdown-item <?php echo $option ? 'active' : '' ?>"><i class="fa fa-check" ></i><?php echo $k ?></div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>

				<button class="submit pull-right" style="height: 40px; padding: 10px;font-size: 14px"><i class="fa fa-search" ></i> Search</button>
			</div>
		</form>
		<hr style="margin: 20px 0" />
		<div class="tags">

		<?php 
			foreach ($searchObj as $key => $type){
				foreach($type as $menu => $child){
					if($child){
						$haveChild = true;
						echo '<div class="tag" data-type="'.$key.'">'.$menu.' <i class="fa fa-times"></i></div>';
					}
				}
			}
		?>
		
		</div>
		<?php echo $haveChild ? '<hr style="margin: 20px 0" />' : ''  ?>
		<div class="search-result" style="min-height: 500px">
		<?php

		if ($query->have_posts()) {
			while ($query->have_posts()) { 
				$query->the_post(); 
				$company = get_field('company');
				var_dump($company);
				?>
				<div class="job-detail">
					<div class="job-logo">
					
					
					</div>
					<div class="job-detail">
						<h4><?php the_title() ?></h4>
						<p>Company name</p>
						<p><?php get_field('location') ?></p>
						<p><?php get_field('') ?></p>
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
		$totalPage =  $query->max_num_pages;

		echo '<div class="paging-navigation" page="'.$paged.'">';
		if($paged <= 1){
			echo '<a class="next disabled" >Prev</a>';
		}else{
			echo '<a class="next" href="'. get_permalink() .'?paged='.($paged -1).'">Prev</a>';
	
		}
		if( $paged -2 > 0){
			echo '<a href="'. get_permalink() .'?paged='.($paged -2) .'" >' . ($paged - 2) . '</a>';
		} 
		if( $paged - 1 > 0){
			echo '<a href="'. get_permalink() .'?paged='.($paged -1 ).'" >' . ($paged - 1) . '</a>';
		} 
		echo '<a href="'. get_permalink() .'?paged='.$paged.'"  class="current-page"  >' . ($paged) . '</a>';
		if( $paged + 1 <= $totalPage){
			echo '<a href="'. get_permalink() .'?paged='.($paged + 1) .'" >' . ($paged + 1) . '</a>';
		} 
		if( $paged + 2 <= $totalPage){
			echo '<a href="'. get_permalink() .'?paged='.($paged + 2) .'" >' . ($paged + 2) . '</a>';
		} 
		if($totalPage <=  $paged){
			echo '<a class="next disabled" >Next</a>';
		}else{
			echo '<a class="next"  href="'. get_permalink() .'?paged='.($paged + 1).'">Next</a>';
			
		}
		echo '</div>';

?>
		</div>
	</div>
</main>

<script>
function setInput(){
	var data = {};
	jQuery('.dropdown-item').each(function(i){
		var type = jQuery(this).data('type');
		data[type] = data[type] || [];
		if(jQuery(this).hasClass('active')){
			data[type].push(jQuery(this).text())
		}
	})
	Object.keys(data).forEach(function(key){
		jQuery('#input-'+key).val(data[key].join(','));
		if(data[key] && data[key].length){
			jQuery('#dropdown-'+key).addClass('active')
		}else{
			jQuery('#dropdown-'+key).removeClass('active')
		}
	})
}
setInput();
jQuery('.dropdown-item').click(function(){
	if(jQuery(this).hasClass('active') ){
		jQuery(this).removeClass('active');
	}else{
		jQuery(this).addClass('active');
	}
	setInput();
	
})

jQuery('.tags .tag i').click(function(){
	var parent  = jQuery(this).parent();
 	var type = jQuery(parent).data('type');
	var text = jQuery(parent).text().trim();

	var values = jQuery('#input-'+type).val();
	values = values.split(',');
	values = values.filter(function(a){
		return a != text;
	})
	jQuery('#input-'+type).val(values.join(','));
	jQuery('.dropdown-list button.submit').click();
		
})

</script>
<style>
.tags{
	padding: 0 20px;
}
.tags .tag{
	background: #0D87D0;
	padding: 5px 20px;
	display: inline-block;
	color: white;
	font-size: 16px;
	font-weight: bold;
	border-radius: 5px;
	margin: 5px 10px;
}
.tags .tag i{
	cursor: pointer;
}
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
.search-job .dropdown.active a{
	font-weight: bold;
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
	max-height: 400px;
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
	text-transform: uppercase;
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
