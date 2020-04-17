<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
			<footer id="site-footer">
				<div class="section-inner">
				<p>
					Copyright © 2019 Digital Strategy Lab.  All Rights Reserved.
				</p><!-- .footer-copyright -->
				</div>
			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>

	<script>

		var $ = jQuery;

		jQuery('.slider-post').append('<div class="dots"><div class="dot-1  active"/><div class="dot-2"/><div class="dot-3"/></div>');	
		jQuery('.slider-post').append('<div class="next"><i class="fa fa-chevron-right" /></div>');	
		jQuery('.slider-post').append('<div class="back"><i class="fa fa-chevron-left" /></div>'); 


		jQuery('.slider-post').on('click', '.next', function() {
			var sl = $(this).parent();
			sl.find('.post-slide').animate( { scrollLeft: '+='+sl.width() }, 100);
			setActive(sl);
		});

		jQuery('.slider-post').on('click', '.back', function() {
			var sl = $(this).parent();
			sl.find('.post-slide').animate( { scrollLeft: '-='+sl.width() }, 100);
			setActive(sl);
		});
		jQuery('.slider-post').on('click', '.dot-1', function() {
			var sl = $(this).parent().parent();
			sl.find('.post-slide').animate( { scrollLeft: 0 }, 100);
			setActive(sl);
		});
		jQuery('.slider-post').on('click', '.dot-2', function() {
			var sl = $(this).parent().parent();
			sl.find('.post-slide').animate( { scrollLeft: sl.width() }, 100);
			setActive(sl);
		});
		jQuery('.slider-post').on('click', '.dot-3', function() {
			var sl = $(this).parent().parent();
			sl.find('.post-slide').animate( { scrollLeft: 2 * sl.width() }, 100);
			setActive(sl);
		});

		function setActive(sl){
			setTimeout(function(){
				var p = sl.find('.post-slide').scrollLeft();
			sl.find('.dot-1').removeClass('active');
			sl.find('.dot-2').removeClass('active');
			sl.find('.dot-3').removeClass('active');
			if(p <  sl.width() ){
				sl.find('.dot-1').addClass('active');

			}else if(p >=  sl.width() -100 && p < 2 * sl.width() - 100){
				sl.find('.dot-2').addClass('active');

			} else{
					sl.find('.dot-3').addClass('active');
			}

			}, 200)
		
		};

		

		jQuery('.sliders-signup').append('<div class="next"><i class="fa fa-chevron-right" /></div>');	


		jQuery('.sliders-signup').on('click', '.next', function() {
			gotoSlider();
		});

		var sliderStep = 0;

		gotoSlider();
		function gotoSlider(){
			sliderStep = sliderStep + 1;


			for(var i = 0; i<3; i++){
				var p = jQuery('.sliders-signup').children().eq(i);
				p.removeClass('post-1');
				p.removeClass('post-2');
				p.removeClass('post-3');

				var index =( sliderStep + i )%3 + 1
				p.addClass('post-'+index)
			}
		
		};

		// setInterval(() => {
		// 	jQuery('.slider-post .next').click();
		// 	jQuery('.sliders-signup .next').click();
		// }, 3000);

		
		jQuery('.partner-list-wrap').append('<div class="dots"><div class="dot-1  active"/><div class="dot-2"/><div class="dot-3"/></div>');	
	

		jQuery('.partner-list-wrap').on('click', '.dot-1', function() {
			this.addClass('active')
			var sl = $(this).parent().parent();
			sl.find('.partner-list').animate( { scrollLeft: 0 }, 100);
			console.log(sl);
		});
		jQuery('.partner-list-wrap').on('click', '.dot-2', function() {
			var sl = $(this).parent().parent();
			sl.find('.partner-list').animate( { scrollLeft: sl.width() }, 100);
		});
		jQuery('.partner-list-wrap').on('click', '.dot-3', function() {
			var sl = $(this).parent().parent();
			sl.find('.partner-list').animate( { scrollLeft: 2 * sl.width() }, 100);
		});


	</script>
	<style>
	.slider-post{
		position: relative;

	}
		.post-slide{
			overflow: hidden;
			white-space: nowrap;
		}
		.sliders-signup .next,
		.slider-post .back,
		.slider-post .next{
			position:absolute;
			top: 50%;
			right: -70px;
			background: #ccc;
			height: 60px;
			width: 60px;
			border-radius: 30px;
			background: white;
			padding-top: 20px;
			text-align: center;
		}
		.slider-post .back{
			left: -70px;
		}
		.sliders-signup .next{
			right: 30px;
			z-index: 4;

		}

		  .dots {
			text-align:center;
		}
		  .dots .dot-1,
		  .dots .dot-2,
		  .dots .dot-3{
			height: 8px;
			width: 8px;
			margin: 5px;
			display: inline-block;
			background: #ccc;
			border-radius:4px;
			margin-top: 30px;
			cursor: pointer;
		}
		 .dots .dot-1.active,
		  .dots .dot-2.active,
		 .dots .dot-3.active{
			background: #555;
		}
	</style>
</html>



