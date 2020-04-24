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
					Copyright © 2020 Digital Strategy Lab.  All Rights Reserved.
				</p><!-- .footer-copyright -->
				</div>
			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>

	<script>

		var $ = jQuery;

		jQuery('.slider-post').append('<div class="dots"><div class="dot dot-1  active"/><div class="dot dot-2"/><div class="dot dot-3"/></div>');	
		jQuery('.slider-post').append('<div class="next"><i class="fa fa-chevron-right" /></div>');	
		// jQuery('.slider-post').append('<div class="back"><i class="fa fa-chevron-left" /></div>'); 


		jQuery('.slider-post').on('click', '.next', function() {
			var sl = $(this).parent();
			var el = sl.find('.post-slide');
			if(el.scrollLeft() <= el[0].scrollWidth - sl.width()){
				el.animate( { scrollLeft: '+='+ sl.width() }, 100);
			}else{
				el.animate( { scrollLeft: 0 }, 100);
			}
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
				sl.find('.dot').removeClass('active');
				if(p <  sl.width() - 100 ){
					sl.find('.dot-1').addClass('active');

				}else if(p >=  sl.width() - 100 && p < 2 * sl.width() - 100){
					console.log(p, sl.width())
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

		if(jQuery('.partner-list').get()[0]){

		var p_width = jQuery('.partner-list').get()[0].scrollWidth;
		var e_width = jQuery('.partner-list-wrap').width();
		var html = '<div class="dots">'
		console.log(p_width , e_width)
		for(var i = 1; i<=  Math.ceil(p_width / e_width)  ; i++ ){
			var p = i;
			if(i == 1){
				html += '<div  data-page="'+i+'" class="dot active dot-'+i+'"/>';

			}else{
				html += '<div data-page="'+i+'"  class="dot dot-'+i+'"/>';

			}
		}
		 html += ' </div>'
		jQuery('.partner-list-wrap').append(html);	

			jQuery('.partner-list-wrap').on('click', '.dot', function() {

				var  p = jQuery(this).data('page')
					jQuery('.partner-list-wrap .dot').removeClass('active');
					var sl = $(this).parent().parent();
					sl.find('.partner-list').animate( { scrollLeft: (p - 1) *  sl.width() }, 100);
					jQuery(this).addClass('active')
					console.log('p_' + p);
				});

		 
			}
	
 
		jQuery('.post-count-comment').on('click',  function(){
			jQuery('.post-comment-out').show();
		})
		jQuery('#view-comment').on('click',  function(){
			jQuery('.post-comment-out').show();
		})
		jQuery('.post-comment-out').on('click',  function(e){
			jQuery('.post-comment-out').hide();
		})
		$(".post-comment-out .post-comment").click(function(e) {
			e.stopPropagation();
	});

	var pathName = window.location.pathname;
	pathName = pathName.split('/');
	if(pathName && pathName[1]){
		var current = pathName[1];
		var map = {
			'partner': '#menu-item-40',
			'job': '#menu-item-41',
			'podcast': '#menu-item-42',
			'event': '#menu-item-43',
			'insiders': '#menu-item-44',
			'news': '#menu-item-46',
			'library': '#menu-item-45'
		}
		jQuery(map[current]).addClass('current-menu-item')
	}

	jQuery('#become-insider').click(function(){
		jQuery('#wpcf7-f445-o2').css('display', 'flex');
	})

	jQuery('#become-partner').click(function(){
		jQuery('#wpcf7-f444-o1').css('display', 'flex');
	})


	jQuery('.wpcf7').on('click', function(e) {
		if (e.target !== this){return}
			jQuery(this).hide();
		});


	var totalChild = jQuery('.post-text .the-article-body>*' ).length;
		var child = '.post-text .the-article-body>*:nth-child('+Math.floor(totalChild/2)+')';
		console.log(jQuery(child));
	jQuery(child).append(jQuery('<div style="text-align:center; margin: 30px"><a href="/subscrice" target="_blank" class="button btn" style="padding: 22px 60px">Subscire now</a></div>'))

	console.log(totalChild);

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
		.dots .dot{
			height: 8px;
			width: 8px;
			margin: 5px;
			display: inline-block;
			background: #ccc;
			border-radius:4px;
			margin-top: 30px;
			cursor: pointer;
		}
		 .dots  .dot.active{
			background: #555;
		}
	</style>
</html>



