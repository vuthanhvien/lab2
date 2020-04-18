<?php
/**
 * Template Name: List Event
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
$category = $post->post_name;

$queryFirst = new WP_Query( 
	array(
		'paged'         => 1, 
		'order'         => 'desc',
		'post_status'   => 'publish',
		'nopaging'		=> false,
		'posts_per_page'=> 1,
		'offset'       	=> 0,
		'post_type'		=> 'event',
		'orderby'		=> 'date',
		'meta_key'		=> 'highlight',
		'meta_value'	=> 1
	)
);


?>

<main id="site-content" role="main">
	<div class="event-banner">
		<?php 
		if ($queryFirst->have_posts()) {
			while ($queryFirst->have_posts()) { 
				$queryFirst->the_post(); 
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
				$first_img = $matches [1] [0];
				$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;
				
				echo $img;
				echo '<div class="blur"></div> ';
				echo'<div class="event-banner-content">';
				echo '<p class="hash">HIGHLIGH EVENT</p>';
				echo '<h3 class="title">'.get_the_title().'</h3>';
				echo '<a href="'.get_the_permalink().'" class="tag">DISCOVER MORE</a>';
				echo'</div>';
			}
		}
		wp_reset_postdata();
		?>
</div>
<div class="section-inner">
	<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$type = $_GET['type'];

	$param = array(
		'paged'         => $paged, 
		'order'         => 'asc',
		'post_status'   => 'publish',
		'nopaging'		=> false,
		'posts_per_page'=> 15,
		'offset'       	=> 1,
		'post_type'		=> $category,
		'orderby'		=> 'desc'
	);

	if($type != 'all'){
		$param['meta_key'] = 'highlight';
		$param['meta_value'] = 1;
	}
	$query = new WP_Query($param);


	echo $post->post_content;

	if($type == 'all'){
		echo '<div class="tab-event"><a href="/event/?type=highlight" >HIGHLIGHTED EVENT</a><a href="/event/?type=all" class="active">ALL EVENT</a></div>';
	}else{
		echo '<div class="tab-event"><a href="/event/?type=highlight" class="active">HIGHLIGHTED EVENT</a><a href="/event/?type=all">ALL EVENT</a></div>';
	}

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

	}else{
		echo '<div class="npost"><p>No post</p></div>';
	}
 
	?>
	<?php 
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
</main><!-- #site-content -->

<?php echo do_shortcode('[signup]'); ?>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>
