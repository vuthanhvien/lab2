<?php
/**
 * Template Name: List Partner
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
// $vi = $GLOBALS['vi'];

$vi = $_SERVER['HTTP_HOST'] == 'chienluocso.vn';


get_header();
	$type = $post->post_name;
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	?>

<main id="site-content" role="main">

<?php  if($type  == 'insiders') { ?>
	<div class="list-banner">
	<div class="section-inner">
		<?php 
		echo $post->post_content;
		echo '<div class="line" ></div>'
		?>
	</div>
</div>
<?php } ?>

<?php  if($type  == 'partner') { ?>
	<div class="section-inner">
	<h3><?php 
		echo $vi ? 'Đối tác' :'Partners';
		?></h3>
</div>
<?php } ?>



<div class="section-inner">
	<?php
	$query = new WP_Query( 
		array(
			'paged'         => $paged, 
			'order'         => 'desc',
			'post_status'   => 'publish',
			'nopaging'		=> false,
			'posts_per_page'=> 15,
			'post_type'		=> $type,
			'orderby'		=> 'date',
			// 'author__in'		=> $authors
			 
		)
	);
 
	echo '<br />';
	echo '<br />';

	if ($query->have_posts()) {
		echo '<div class="list-post">';
		while ($query->have_posts()) { 
			$query->the_post(); 

			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
  			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;
			
			// $categoryName = get_field('tag') ? get_field('tag') : 'Execution';
			$item = '';
			$item .= '<div class="post">';
			$item .= '<div class="img">'.$img.'</div>';
			$item .= '<a  href="'.get_the_permalink().'" ><h3 class="title">'.get_the_title().'</h3></a>';
			$item .= '<p class="content">'.get_the_excerpt().'</p>';
			$item .= '<div class="author">'.get_avatar(get_the_author_meta('ID')).'
						<span>'.get_the_author().'</span><span>|</span>
						<span>'.get_the_date().'</span>
						</div>';
			// $item .= '<div class="category">'.$categoryName.'</div>';
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


<div class="top-partner">
	<div class="section-inner">
	<?php 
	if($vi){
		if($type == 'partner'){
			echo '<h3>Đối tác nổi bật</h3>';
		}
		if($type == 'insiders'){
			echo '<h3>Insider</h3>';
		}
	}else{
		if($type == 'partner'){
			echo '<h3>Top partners</h3>';
		}
		if($type == 'insiders'){
			echo '<h3>Top insiders</h3>';
		}
	}
	
	?>
</div>
<div class="partner-list-wrap">
<div class="partner-list">
	<?php 
	if($type == 'partner'){
		$users = get_field('user_list');
	}
	if($type == 'insiders'){
		$users = get_field('user_list');
	}

	foreach($users as $user_id){
		$first_name =  get_user_meta(  $user_id, 'first_name', true );
		$last_name =  get_user_meta(  $user_id, 'last_name', true );

		$title = get_field('title', 'user_'.$user_id);

		$desc = get_user_meta(  $user_id, 'description', true );
		$desc = implode(' ', array_slice(explode(' ', $desc), 0, 15));

		$desc = get_user_meta(  $user_id, 'description', true );

		?>
			<a href="/user/<?php  echo $user_id ?>" class="partner">
				 <?php echo get_avatar($user_id) ?>
				<p style="font-size: 16px"><b><?php echo $first_name ?> <?php echo $last_name ?> </b> </p>
				<p style="font-size: 15px"><i><?php echo $title ?></i> </p>
				<p style="font-size: 16px" class="content"><?php echo $desc ?> ... </p>
				</a>
		<?php
	}

	
?>
</div>
</div>
<br />
<br />
<br />

<?php 

if($type == 'partner'){
	$t = $vi ? 'Trở thành đối tác' : 'Become our Partner';
	echo '<div class="text-center">
		<button id="become-partner" class="btn">'.$t.' &nbsp; <i class="fa fa-long-arrow-right" ></i> </button>
	</div>';
}
if($type == 'insiders'){
	$t = $vi ? 'Trở thành insider' : 'Become an Insider';
	echo '<div class="text-center">
		<button id="become-insider" class="btn">'.$t.' &nbsp; <i class="fa fa-long-arrow-right" ></i> </button>
	</div>';
}

?>
</div>
<div class="media-partner bg-white" style="padding: 50px 0">
<div class="section-inner">

<?php  if($type  == 'partner') { ?>
		<?php 
		echo $post->post_content;
		?>
</div>
<?php } ?>

</div>

</div>

</main><!-- #site-content -->

<?php echo do_shortcode('[signup]'); ?>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php echo do_shortcode('[contact-form-7 id="444" title=":enPartner:"]'); ?>
<?php echo do_shortcode('[contact-form-7 id="445" title=":enInsider:"]') ?>
<?php get_footer(); ?>
