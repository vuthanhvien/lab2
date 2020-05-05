<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */


$user = wp_get_current_user();

$vi = $GLOBALS['vi'];

$prefix = $vi ? '/vi' : '';


?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link rel="stylesheet" id="twentytwenty-style-css" href="/wp-content/themes/twentytwenty/custom.css?ver=1.1" type="text/css" media="all">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&display=swap&subset=vietnamese" rel="stylesheet">

        <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  
        <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
        <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>


		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();

		$currentPath = $_SERVER['REQUEST_URI'];
		if($vi) {
			$currentPath = substr($currentPath, 3); 
		}else{
			$currentPath = $currentPath;
		}
		?>

			<div class="header-top">
				<div class="section-inner">
					<a href="/en<?php echo $currentPath ?>">English</a>
					<a href="/vi<?php echo $currentPath ?>">Tiếng Việt</a>

					<?php 
						if($user->exists()){
							?>
								<a class="avatar-profile" href="<?php echo $prefix  ?>/profile"><?php echo get_avatar($user->ID); echo ' '; echo $user->user_login; ?> </a>
								<a class="button" href="<?php echo $prefix  ?>/subscribe"><?php echo $vi ?  'Subscribe'  : 'Subscribe' ?></a>
							<?php

						}else{
							?>
								<a class="button" href="<?php echo $prefix  ?>/login"><?php echo $vi ?  'Đăng nhập'  : 'Login' ?> </a>
								<a class="button" href="<?php echo $prefix  ?>/subscribe"><?php echo $vi ?  'Subscribe'  : 'Subscribe' ?></a>
							<?php

						}
					?>
				</div>
			</div>

			<header id="site-header" class="header-footer-group" role="banner">
			<div class="header-inner ">
			<div class=" section-inner">
				<div class="header-left">
					<?php $enable_header_search = get_theme_mod( 'enable_header_search', true ); if ( $enable_header_search === true ) {
						?>
						<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php twentytwenty_the_theme_svg( 'search' ); ?>
								</span>
								<span class="toggle-text"><?php _e( 'Search', 'twentytwenty' ); ?></span>
							</span>
						</button><!-- .search-toggle -->
					<?php } ?>

					<div class="header-titles">
						<?php
							twentytwenty_site_logo();
						?>
					</div> 

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
						</span>
					</button><!-- .nav-toggle -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-right">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">
								<ul class="primary-menu reset-list-style">
								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}

					if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<!-- <div class="header-toggles hide-no-js"> -->

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<!-- <div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu"> -->

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							<!-- </div>.nav-toggle-wrapper -->

							<?php
						}

						if ( true === $enable_header_search ) {
							?>

							<!-- <div class="toggle-wrapper search-toggle-wrapper"> -->

								<button class="search" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
								<img src="/assets/search.png" />	
							</button><!-- .search-toggle -->

							<!-- </div> -->

							<?php
						}
						?>

						<!-- </div>.header-toggles -->
						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->
			</div><!-- .header-inner -->

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>

		</header><!-- #site-header -->

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
