<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//if (! is_user_logged_in()) :
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-24222569-3"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-24222569-3');
		</script>
		<script src="/wp-content/themes/bt/assets/choises.js/assets/scripts/dist/choices.js"></script>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php the_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="mobile-web-app-capable" content="yes">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<div id="loading">
			<?php $site_loader = get_field( 'loader-image', 'option' )['sizes']['thumbnail']; ?>

			<div class="spinner absolute-center"> <img id="spinner" src="<?= $site_loader; ?>"/></div>

		</div>

		<div id="page">

		

		<header class="main-site-header clear-float position-relative">
			<nav class="main-nav ">
				<?php
				$defaults = [
					'container' => false,
					'theme_location' => 'main-site-menu-left',
					'menu_class' => 'header-menu'
				];
				wp_nav_menu( $defaults );
				?>
			</nav>
			<div class="site-logo ">
				<?php $site_logo = get_field( 'site-logo', 'option' ); ?>
				<a href="<?php // CLANG != 'en' ? BPATH . '/' . CLANG : BPATH; ?>" title="<?= $site_logo['alt']; ?>" class="display-table width-100-pc line-height-0">					<div class="display-table-cell middle">
						<img src="<?= $site_logo['url']; ?>" alt="<?= $site_logo['alt']; ?>" class="display-block margin-center">
					</div>
				</a>
			</div>
			<nav class="main-nav ">
				<?php
				$defaults = [
					'container' => false,
					'theme_location' => 'main-site-menu-right',
					'menu_class' => 'header-menu'
				];
				wp_nav_menu( $defaults );
				?>
				<?php
				// $search_icon 	   			 = get_field( 'search-icon', 'option' );
				// $search_icon_title 			 = get_field( 'search-icon-title', 'option' );
				// $search_box_placeholder_text = get_field( 'search-box-placeholder-text', 'option' );
				?>
				<!-- <div class="search-btn width-10-pc pull-left">
					<a href="javascript:void(0);" title="<?= $search_icon_title; ?>" class="display-table text-center full-height-percent width-100-pc">
						<div class="display-table-cell middle">
							<img src="<?php // $search_icon['url']; ?>" alt="<?php // $search_icon_title; ?>" class="search-custom-icon">
						</div>
					</a>
				</div>
				<div class="search-form boxed site-white-bg z-index-11">
					<div class="width-80-pc margin-center full-height-percent clear-float">
						<div class="display-table full-height-percent width-5-pc pull-left">
							<div class="display-table-cell middle">
								<img src="<?php //$search_icon['url']; ?>" alt="Search icon" class="search-custom-icon">
							</div>
						</div>
						<form action="<?php //BPATH; ?>" method="get" class="display-table width-90-pc full-height-percent pull-left">
							<div class="display-table-cell middle">
								<label for="sf-search" class="visually-hidden"><?php //$search_box_placeholder_text; ?></label>
								<input type="text" name="s" id="sf-search" placeholder="<?php //$search_box_placeholder_text; ?>">
							</div>
						</form>
						<div class="full-height-percent width-5-pc pull-left">
							<a href="javascript:void(0);" title="Close the search" class="display-table width-100-pc full-height-percent close-search-btn">
								<div class="display-table-cell middle text-right">
									<span class="font11em">X</span>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="search-quick-links boxed site-white-bg z-index-11 padding-top-30 padding-bottom-30">
					<div class="width-80-pc margin-center">
						<div class="headline padding-bottom-20"><?php //the_field( 'quick-links-headline', 'option' ); ?></div>
						<div class="quick-links-nav">
							<?php
							// $defaults = [
							// 	'container' => false,
							// 	'theme_location' => 'search-quick-links',
							// ];
							// wp_nav_menu( $defaults );
							?>
						</div>
					</div>
				</div> -->
			</nav>

			<div class="mobile-nav-btn">
				<img src="<?= BPATH . '/wp-content/uploads/2019/04/mobile-open-nav-icon.png'; ?>" class="absolute-center transition-030">
				<img src="<?= BPATH . '/wp-content/uploads/2019/04/mobile-close-nav-icon.png'; ?>" class="absolute-center transition-030">
			</div>
			<div class="mobile-search-btn">
				<img src="<?= $search_icon['url']; ?>" alt="<?= $search_icon_title; ?>" class="absolute-center search-custom-icon">
			</div>
			<div class="mobile-close-sub-menu">
				<img src="<?= BPATH . '/wp-content/uploads/2019/04/mobile-nav-left-icon.png'; ?>" class="absolute-center">
			</div>
			<div class="mobile-nav transition-030">
				<ul>
					<?php
					$defaults = [
						'container' 	 => false,
						'theme_location' => 'main-site-menu-left',
						'items_wrap' 	 => '%3$s'
					];
					wp_nav_menu( $defaults );
					$defaults = [
						'container' 	 => false,
						'theme_location' => 'main-site-menu-right',
						'items_wrap' 	 => '%3$s'
					];
					wp_nav_menu( $defaults );
					?>
				</ul>
			</div>
		</header>