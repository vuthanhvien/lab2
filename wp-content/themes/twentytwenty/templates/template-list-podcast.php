<?php
/**
 * Template Name: List Podcast
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">
<div class="list-banner">
	<div class="section-inner">
		<?php 
		echo $post->post_content;
		?>
	</div>
</div>
<div class="section-inner">
	<?php
	$category = $post->post_name;
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
 
	$query = new WP_Query( 
		array(
			'paged'         => $paged, 
			'order'         => 'desc',
			'post_status'   => 'publish',
			'nopaging'		=> false,
			'posts_per_page'=> 15,
			'post_type'		=> $category,
			'orderby'		=> 'date'
		)
	);
 
	$i = 1;
	if ($query->have_posts()) {
		echo '<div class="list-podcast">';
		while ($query->have_posts()) { 
			$query->the_post(); 

			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
  			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;

			if(in_array($i, [1,2,6,10,11,12])){
				if($i == 1 || $i == 10 || $i ==11){
					echo '<div class="col big">';
				}else{
					echo '<div class="col">';
				}
			}
			
			$item = '';
			$item .= '<div class="post">';
			$item .= '<div class="img">'.$img.'</div>';
			$item .= '<a  href="'.get_the_permalink().'" ><h3 class="title">'.get_the_title().'</h3></a>';
			$item .= '<div class="author">'.get_avatar(get_the_author_meta('ID')).'
						<span>'.get_the_author().'</span>
						</div>';
			$item .= '</div>';

			echo $item;

			if(in_array($i, [1,5,9,10,11,15])){
				echo '</div>';
			}
			$i = $i + 1;

		}
		if(in_array($i, [2,3,4,6,7,8, 11,12,13])){
			echo '</div>';
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
