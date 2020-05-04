<?php get_header();

$vi = $GLOBALS['vi'];
?>


<main id="site-content" role="main">
	<div class="section-inner">

	<h4><?php echo $vi ? 'Kết quả tìm kiếm': 'Search result'?>: <?php echo $s; ?></h4>


<?php
$s=get_search_query();

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;


$args = array( 
	's' =>$s, 
        'post_type' =>  array('news', 'library', 'podcast', 'event'),
		'paged'         => $paged, 
'order'         => 'desc',
'post_status'   => 'publish',
'nopaging'		=> false,
'posts_per_page'=> 15,
'orderby'		=> 'date' );
$query = new WP_Query( $args );



if ($query->have_posts()) {
	echo '<div class="list-post">';
	while ($query->have_posts()) { 
		$query->the_post(); 

		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
		  $first_img = $matches [1] [0];
		$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;
		
		$categoryName = get_field('tag') ? get_field('tag') : 'Execution';
		$item = '';
		$item .= '<div class="post">';
		$item .= '<div class="img">'.$img.'</div>';
		$item .= '<a  href="'.get_the_permalink().'" ><h3 class="title">'.get_the_title().'</h3></a>';
		$item .= '<p class="content">'.get_the_excerpt().'</p>';
		$item .= '<div class="author">'.get_avatar(get_the_author_meta('ID')).'
					<span>'.get_the_author().'</span><span>|</span>
					<span>'.get_the_date().'</span>
					</div>';
		$item .= '<div class="category">'.$categoryName.'</div>';
		$item .= '</div>';

		echo $item;

	}
	echo '</div>';
	wp_reset_postdata();

}else{
	echo '<div class="npost"><p>'.($vi ? 'Không tìm thấy bài viết': 'No post available' ).'</p></div>';
}
 ?>

<?php 
		$totalPage =  $query->max_num_pages;

		echo '<div class="paging-navigation" page="'.$paged.'">';
		if($paged <= 1){
			echo '<a class="next disabled" >Prev</a>';
		}else{
			echo '<a class="next" href="/?s-'.$s.'&paged='.($paged -1).'">Prev</a>';
	
		}
		if( $paged -2 > 0){
			echo '<a href="?s='. $s .'&paged='.($paged -2) .'" >' . ($paged - 2) . '</a>';
		} 
		if( $paged - 1 > 0){
			echo '<a href="/?s='. $s .'&paged='.($paged -1 ).'" >' . ($paged - 1) . '</a>';
		} 
		echo '<a href="'. $s .'&paged='.$paged.'"  class="current-page"  >' . ($paged) . '</a>';
		if( $paged + 1 <= $totalPage){
			echo '<a href="/?s='. $s .'&paged='.($paged + 1) .'" >' . ($paged + 1) . '</a>';
		} 
		if( $paged + 2 <= $totalPage){
			echo '<a href="/?s='. $s .'&paged='.($paged + 2) .'" >' . ($paged + 2) . '</a>';
		} 
		if($totalPage <=  $paged){
			echo '<a class="next disabled" >Next</a>';
		}else{
			echo '<a class="next"  href="/?s='. $s .'&paged='.($paged + 1).'">Next</a>';
			
		}
		echo '</div>';
	 ?>

</div>
</div>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>

 