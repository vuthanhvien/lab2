<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">


	<?php

	$currentUrl = $_SERVER['REQUEST_URI'];
	$archive_title    = '';
	$archive_subtitle = '';


	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
		
	}
	if ( $archive_title || $archive_subtitle ) {

		?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

		<?php
    }

    ?>

<div class="section-inner">
	<?php

// echo $currentUrl;
	echo '<br />';
    echo '<br />';
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$tag = get_query_var( 'tag' );
    // echo 	$tag;
	$queryArr = array(
		'paged'         => $paged, 
		'order'         => 'desc',
		'post_status'   => 'publish',
		'nopaging'		=> false,
		'posts_per_page'=> 15,
		'post_type'		=> array('news', 'library', 'podcast', 'event', 'book', 'partner-program', 'partner', 'insiders'),
        'orderby'		=> 'date',
        'tag'              => $tag
	);
	// if($tag){
	// 	$queryArr['category_name'] = $tag;
	// }
	$query = new WP_Query( $queryArr );


	if ($query->have_posts()) {
		echo '<div class="list-post">';
		while ($query->have_posts()) { 
			$query->the_post(); 

			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
  			$first_img = $matches [1] [0];
			$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;
			
			$categoryName = get_field('tag') ? get_field('tag') : 'Execution';

			$tags  = get_the_category();
			$tag = [];
			foreach ($tags as &$t) {
				array_push($tag, $t->name);
			}


			$item = '';
			$item .= '<div class="post">';
			$item .= '<div class="img">'.$img.'</div>';
			$item .= '<a  href="'.get_the_permalink().'" ><h3 class="title">'.get_the_title().'</h3></a>';
			$item .= '<p class="content">'.get_the_excerpt().'</p>';
			$item .= '<div class="author">'.get_avatar(get_the_author_meta('ID')).'
						<span>'.get_the_author().'</span><span>|</span>
						<span>'.get_the_date().'</span>
						</div>';
			$item .= '<div class="category">'.implode(', ', $tag).'</div>';
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
    <?php
    get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
