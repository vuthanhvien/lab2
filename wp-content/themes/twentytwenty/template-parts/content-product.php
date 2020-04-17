<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
	get_template_part( 'template-parts/entry-header' );
	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

    <?php
        $category = $post->post_name;
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $query = new WP_Query( 
            array(
                'paged'         => $paged, 
                'order'         => 'asc',
                // 'orderby'         => 'date',
				'post_status'   => 'publish',
				'nopaging'		=> false,
                'posts_per_page'=> 12,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'section',
                        'field' => 'slug',
                        'terms' => $category,
                    ),
                ),
            )
		);
        if ($query->have_posts()) {
			echo '<div class="product-list">';

               while ($query->have_posts()) { 
			   $query->the_post(); 
			   $postId = get_the_ID();
			   $metadata = get_post_meta($postId, '');
			   $price = get_post_meta($postId, 'Giá', true);
			//    $code = get_post_meta($postId, 'code', true);
			//    $status = get_post_meta($postId, 'status', true);
			   $content = get_post_meta($postId, 'content', true);
			   $output = preg_match_all('#<img(.+?)src=(.+?)\/>#', get_the_content(), $matches);
			   $images = $matches[0];

			   $meta = '';
			   foreach ($metadata as $key=>$value) {
				   if($key[0]!= '_' && $key != 'Giá' && $key != 'content' && $key != 'show_home'){
					$meta .= "<p>".$key.": <span>".$value[0]."</span></p>";
				   }
			   }
			   $meta = nl2br($meta);
			   $content = nl2br($content);



			   ?>
				<div class="product-detail" id="news-<?php the_ID(); ?>">
					<?php the_post_thumbnail('large') ?>
					<a class="button" href="#" data-toggle="modal" data-target="#product-<?php echo the_ID() ?>"> Xem chi tiết <i class="fa fa-search"></i></a>
					<div class="product-content">
					<?php the_title('<h2 class="entry-title">', '</h2>' ); ?>
					<p class="price"><?php echo $price ?>&nbsp;</p>
					</div>
					
				</div> 

				<div class="modal fade" id="product-<?php echo the_ID() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						 	<div class="product-popup row">
							 <div class="image col-md-5">
							 	<?php the_post_thumbnail('large') ?>

								<div class="image-slide">
									<div class="image-slider-item">
							 	<?php the_post_thumbnail('large') ?>
									</div>
									<?php 
									foreach ($images as $img) {
										echo '<div class="image-slider-item">'.$img.'</div>';
									}
									 ?>
									</div>
							 </div>
							 <div class="info col-md-7">
							 <?php the_title('<h2 class="entry-title">', '</h2>' ); ?>
							<?php echo $meta ?>
							
							 <div class="product-footer">
								 <?php if($price){
									  echo '  <p>'.$price.'</p> ';
								 }
								 ?>
							 <div class="button-action">
								 <div class="row">
									 <div class="col-md-6 offset-md-6">
								 		<a class="button-call" href="tel:18001504" style="display: block">
											<img src="/wp-content/uploads/2020/01/Screen-Shot-2020-01-13-at-15.36.39.png" />
											<p>18001504</p>
											<p class="mute">Tư vấn - Hỗ trợ đặt hàng</p>
								 		</a>
									 </div>
									 <!-- <div class="shipping col-md-6" >
									 <img src="/wp-content/uploads/2020/01/Screen-Shot-2020-01-13-at-15.36.33.png" />
									 <p>Giao hàng tận nơi <br> Miễn phí lắp đặt</p> -->
								 <!-- </div> -->
									 <!-- <div class="col-sm-6">
								 		<div class="button red-bg button-block">Đặt mua</div>
								 	</div> -->
								</div> 
								<!-- <div class="row">
									 <div class="col-sm-6">
										 <input placeholder="Để lại số điện thoại nhận tư vấn" />
								 	</div>
									 <div class="col-sm-6">
								 		<div class="button button-block">Đăng ký tư vấn</div>
								 	</div>
								 	</div>-->
								 </div> 
							 </div>
							 </div>
							 </div>
						</div>
					</div>
				</div>

                <?php
			}
            wp_reset_postdata();
			
			echo '</div>';
		
		}

		$totalPage =  $query->max_num_pages;
		
		echo '<div class="paging-navigation">';
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
		echo '</div>';
		?>
		
		

	<div class="section-inner">
		<?php
		// wp_link_pages(
		// 	array(
		// 		'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
		// 		'after'       => '</nav>',
		// 		'link_before' => '<span class="page-number">',
		// 		'link_after'  => '</span>',
		// 	)
		// );

		// edit_post_link();

	 
		?>

	</div><!-- .section-inner -->

	<?php
		get_template_part( 'template-parts/navigation-paging' );
	?>

</article><!-- .post -->
