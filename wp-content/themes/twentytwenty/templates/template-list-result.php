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



$searchObj = array(
	'location' =>  array(
		'Hà Nội' => false,
		'Hồ Chí Minh' => false,
		'Đà Nẵng' => false,
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
	'experience' =>  array(
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


				<button class="submit pull-right" style="height: 40px; padding: 10px;font-size: 14px; background-color: #F8A54A !important ">&nbsp;&nbsp;<i class="fa fa-search" ></i> Search &nbsp;&nbsp;</button>
				<a href="/jobs" style="padding: 10px" class="btn-sm pull-right" >Reset</a>
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
		

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$get_params = $_GET;
		$param = array(
			'paged'         => $paged, 
			'order'         => 'desc',
			'post_status'   => 'publish',
			'posts_per_page'=> 15,
			'offset'       	=> 0,
			'post_type'		=> 'job',
			'orderby'		=> 'date',
			'meta_query'	=> array(
				'relation'		=> 'AND'
			)
		);
		$arrayKey  = array(
			'location',
			'function',
			'experience',
			'industry',
			'type',
			'salary'
		);

		foreach($arrayKey as $key){

			if($get_params[$key]){
				$locations = explode(',', $get_params[$key]);
				foreach($locations as $l){
					array_push($param['meta_query'], array(
						'key'		=> $key,
						'value'		=> $l,
						'compare'	=> 'LIKE'
					));
				}
			}
		}

		if($search){
			$param['s'] = $search;
		}

 

		$query = new WP_Query($param);


		if ($query->have_posts()) {
			while ($query->have_posts()) { 
				$query->the_post(); 
				$companyId = get_field('company');
				$industry = get_field('industry') ? join(', ', get_field('industry')) : '';
				$type = get_field('type') ? join(', ', get_field('type')) : '';
				$function = get_field('function') ? join(', ', get_field('function')) : '';
				?>
				<div class="job-detail">
					<div class="job-logo">
						<img src="<?php echo get_field('logo',$companyId ) ?>" />
					</div>
					<div class="job-text">
						<a href="<?php the_permalink() ?>"><h4><?php the_title() ?></h4></a>
						<p class="blue"><?php echo get_the_title($companyId) ?></p>
						<p><?php echo join(', ', get_field('location')) ?></p>
						<p class="blue"><?php echo  get_field('salary') ?></p>
						<p class="mt-2">
						<?php echo $function ?>,
						<?php echo $type ?>,
						<?php echo $industry ?>
						</p>
					</div>
					<div class="job-time">
						<p class="blue"><?php the_modified_date() ?></p>
				</div>
				</div>

				<?php
				echo '<br />';
				wp_reset_postdata();

			}
			
		}else{
			echo '<div style="text-align:center; padding: 300px 0">No job avalaible</div>';
		}
		$totalPage =  $query->max_num_pages;

		function build_http_query( $q ){
			$query_array = array();
			foreach( $q as $key => $key_value ){
				$query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
			}
			return implode( '&', $query_array );
		}
		function get_permalink_page($page){
			$queryPage = $_GET;
			$queryPage['paged'] = $page;
			return get_permalink().'?'. build_http_query($queryPage);
		}
		echo '<div class="paging-navigation" page="'.$paged.'">';
		if($paged <= 1){
			echo '<a class="next disabled" >Prev</a>';
		}else{
			echo '<a class="next" href="'. get_permalink_page($paged -1).'">Prev</a>';
	
		}
		if( $paged -2 > 0){
			echo '<a href="'. get_permalink_page($paged -2) .'" >' . ($paged - 2) . '</a>';
		} 
		if( $paged - 1 > 0){
			echo '<a href="'. get_permalink_page($paged -1 ).'" >' . ($paged - 1) . '</a>';
		} 
		echo '<a href="'. get_permalink_page($paged).'"  class="current-page"  >' . ($paged) . '</a>';
		if( $paged + 1 <= $totalPage){
			echo '<a href="'. get_permalink_page($paged + 1) .'" >' . ($paged + 1) . '</a>';
		} 
		if( $paged + 2 <= $totalPage){
			echo '<a href="'. get_permalink_page($paged + 2) .'" >' . ($paged + 2) . '</a>';
		} 
		if($totalPage <=  $paged){
			echo '<a class="next disabled" >Next</a>';
		}else{
			echo '<a class="next"  href="'. get_permalink_page($paged + 1).'">Next</a>';
			
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

jQuery('.dropdown-filter').keyup(function(){
	var s = jQuery(this).val();
	var parent = jQuery(this).parent();
	parent.find('.dropdown-item').each(function(el){
		var text = jQuery(this).text();
		if(text.indexOf(s) > -1){
			jQuery(this).removeClass('hide');
		}else{
			jQuery(this).addClass('hide');
		}
	})
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
.job-detail{
	/* display: flex; */
	/* flex-direction: row; */
	border-bottom: 1px solid #eee;
	padding: 40px 0;

}
.job-logo {
	width: 150px;
	display: inline-block;
	vertical-align: top;
}
.job-time {
	width: 150px;
	vertical-align: top;
	display: inline-block;
	font-size: 16px;
	color: #888;
	text-align: right;
}
.job-text {
	width: calc( 100% - 350px);
	vertical-align: top;
	display: inline-block;
	padding-left: 40px;
}
.job-text h4{
	font-size: 18px;
	color: #333;
	margin: 10px 0;
}

.job-text p{
	font-size: 16px;
	color: #888;
	/* font-weight: */
}

.job-text p.blue{
	color: #0D87D0;
}
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
	padding: 50px 0 50px 50px;
	margin-top: 30px;
	margin-bottom: 30px;
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
	min-width:350px;
	max-height: 500px;
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
.search-job .dropdown .dropdown-menu .dropdown-item.hide{
	display: none;
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
