<?php
/**
 * Template Name: List Book
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();

$prefix = $GLOBALS['vi'] ? '/vi' : '';

$queryFirst = new WP_Query( 
	array(
		'paged'         => 1, 
		'order'         => 'desc',
		'post_status'   => 'publish',
		'nopaging'		=> false,
		'posts_per_page'=> 1,
		'offset'       	=> 0,
		'post_type'		=> 'book',
		'orderby'		=> 'date',
	)
);


?>

<main id="site-content" role="main">
	<?php echo do_shortcode('[signup2]'); ?>
</div>
<div class="section-inner book-section">

<div class="first-book">
<?php 	if ($queryFirst->have_posts()) {
		while ($queryFirst->have_posts()) {  

			$queryFirst->the_post(); 
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;
			 
			?>
			<div class="first-book-left"><?php  echo $img; ?></div>
			<div class="first-book-right">
				<h4>ESSENTIAL READS 2020</h4>
				<a href="<?php the_permalink() ?>" ><h3><?php the_title() ?></h3></a>
				<p><?php the_excerpt() ?></p>
				<p>By <b><?php the_author() ?></b> | <?php the_date() ?></p>
						<?php } }  ?>
				</div>
				</div>
	<?php

	$param = array(
		'paged'         => 1, 
		'order'         => 'desc',
		'post_status'   => 'publish',
		'nopaging'		=> false,
		'posts_per_page'=> 4,
		'offset'       	=> 0,
		'post_type'		=> 'book',
		'orderby'		=> 'date'
	);

	$query = new WP_Query($param);

	?>

	<h3>LASTEST BOOK REVIEWS</h3>
<?php

	if ($query->have_posts()) {
		echo '<div class="list-book">';
		while ($query->have_posts()) { 
			$query->the_post(); 
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
  			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;

			$item = '';
			$item .= '<div  class="post-book">';
			$item .= $img;
			$item .= '<div class="post-book-content">';
			$item .= '<a href="'.get_the_permalink().'"><h4 class="title">'.get_the_title().'</h4></a>';
			$item .= '<p>'.get_the_excerpt().'</p>';
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
	<h3>MOST POPUPLAR</h3>

	<?php


$param = array(
	'paged'         => $paged, 
	'order'         => 'desc',
	'post_status'   => 'publish',
	'nopaging'		=> false,
	'posts_per_page'=> 15,
	'offset'       	=> 0,
	'post_type'		=> 'book',
	'orderby'		=> 'comment_count'
);

$query = new WP_Query($param);



	if ($query->have_posts()) {
		echo '<div class="list-book">';
		while ($query->have_posts()) { 
			$query->the_post(); 
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
  			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;

			$item = '';
			$item .= '<div  class="post-book">';
			$item .= $img;
			$item .= '<div class="post-book-content">';
			$item .= '<a href="'.get_the_permalink().'"><h4 class="title">'.get_the_title().'</h4></a>';
			$item .= '<p>'.get_the_excerpt().'</p>';
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
