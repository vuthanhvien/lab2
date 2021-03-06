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

 $vi = $GLOBALS['vi'];

$prefix =  $vi ? '' : '';

?>
			<footer id="site-footer">
				<div class="section-inner">
				<p>
					Copyright © 2020 Digital Strategy Lab.  All Rights Reserved.
				</p><!-- .footer-copyright -->
				<p>
                    <!-- <a href="<?php echo $prefix ?>/advertise"   ><?php echo $vi ? 'Quảng cáo' : 'Advertise' ?></a> | -->
                    <a href="<?php echo $prefix ?>/terms-of-use"  ><?php echo $vi ? 'Điều khoản sử dụng' : 'Terms of Use' ?></a> |
				<a href="<?php echo $prefix ?>/privacy"  ><?php echo $vi ? 'Chính sách bảo mật' : 'Privacy Policy' ?></a>
					</p>
				</div>
			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>

	<script>


		jQuery('.slider-post').append('<div class="dots"><div class="dot dot-1  active"/><div class="dot dot-2"/><div class="dot dot-3"/></div>');	

		// var s_width = jQuery('.slider-post').get()[0].scrollWidth;
		// 	var es_width = jQuery('.slider-post-wrap').width();
		// 	var html = '<div class="dots">'
		// 	console.log(p_width , e_width)
		// 	for(var i = 1; i<=  Math.ceil(p_width / e_width)  ; i++ ){
		// 		var p = i;
		// 		if(i == 1){
		// 			html += '<div  data-page="'+i+'" class="dot active dot-'+i+'"/>';

		// 		}else{
		// 			html += '<div data-page="'+i+'"  class="dot dot-'+i+'"/>';

		// 		}
		// 	}
		// 	html += ' </div>'


		jQuery('.slider-post').append('<div class="next"><i class="fa fa-chevron-right" /></div>');	
		// jQuery('.slider-post').append('<div class="back"><i class="fa fa-chevron-left" /></div>'); 


		jQuery('.slider-post').on('click', '.next', function() {
			var sl = jQuery(this).parent();
			var el = sl.find('.post-slide');
			if(el.scrollLeft() <= el[0].scrollWidth - sl.width()){
				el.animate( { scrollLeft: '+='+ sl.width() }, 100);
			}else{
				el.animate( { scrollLeft: 0 }, 100);
			}
			setActive(sl);
		});

		jQuery('.slider-post').on('click', '.dot-1', function() {
			var sl = jQuery(this).parent().parent();
			sl.find('.post-slide').animate( { scrollLeft: 0 }, 100);
			setActive(sl);
		});
		jQuery('.slider-post').on('click', '.dot-2', function() {
			var sl = jQuery(this).parent().parent();
			sl.find('.post-slide').animate( { scrollLeft: sl.width() }, 100);
			setActive(sl);
		});
		jQuery('.slider-post').on('click', '.dot-3', function() {
			var sl = jQuery(this).parent().parent();
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

			jQuery('.partner-list-wrap').append('<div class="next"><i class="fa fa-chevron-right" /></div>');	


			var p_width = jQuery('.partner-list').get()[0].scrollWidth;
			var e_width = jQuery('.partner-list-wrap').width();
			var html = '<div class="dots">'
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
				var sl = jQuery(this).parent().parent();
				sl.find('.partner-list').animate( { scrollLeft: (p - 1) *  sl.width() }, 100);
				jQuery(this).addClass('active')
			});

			jQuery('.partner-list-wrap').on('click', '.next', function() {
				jQuery('.partner-list-wrap .dot').removeClass('active');
				console.log( )
				if(jQuery('.partner-list').scrollLeft() >=  p_width - e_width - 100 ){
					jQuery('.partner-list').animate( { scrollLeft: 0}, 100);
				}else{
					jQuery('.partner-list').animate( { scrollLeft: '+='+e_width}, 100);
				}

				var dot = Math.ceil((jQuery('.partner-list').scrollLeft() + e_width) / e_width) 
				
				jQuery('.partner-list-wrap .dot-'+dot).addClass('active');


			});

		 
		}
	
		jQuery('.post-comment-close').on('click',  function(){
			jQuery('.post-comment-out').hide();
		})
		jQuery('.post-count-comment').on('click',  function(){
			jQuery('.post-comment-out').show();
		})
		jQuery('#view-comment').on('click',  function(){
			jQuery('.post-comment-out').show();
		})
		jQuery('.post-comment-out').on('click',  function(e){
			jQuery('.post-comment-out').hide();
		})
		jQuery(".post-comment-out .post-comment").click(function(e) {
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

	jQuery('.wpcf7').on('click', '.continue', function(e){
		jQuery('.wpcf7').hide();
	})


	jQuery('#apply-job').click(function(){
		jQuery('#wpcf7-f1476-o1').css('display', 'flex');
	})


	jQuery('.wpcf7').on('click', function(e) {
		if (e.target !== this){return}
			jQuery(this).hide();
		});


	// var totalChild = jQuery('.post-text  >*' ).length;
	// var child = '.post-text  >*:nth-child('+Math.floor((totalChild - 3 )/2)+')';
	// jQuery(child).append(jQuery('<div style="text-align:center; margin: 30px"><a href="<?php echo  $prefix ?>/subscribe" target="_blank" class="button btn" style="padding: 22px 60px"><?php echo $vi ? 'Subscribe ngay' : 'Subscribe now' ?></a></div>'))
	jQuery('#menu-item-451 > a').html('More &nbsp; <i class="fa fa-sort-desc"></i>')


	jQuery('#post-1678 .action .has-text-align-left.tmp a').removeAttr("href");
	jQuery('#post-1678 .action .has-text-align-left.tmp a').click(function(){
		jQuery('#wpcf7-f2334-p1678-o1').css('display', 'flex');
	
	})



	</script>
</html>



