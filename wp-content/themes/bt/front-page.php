<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();

?>

<main>

	<?php if (have_rows('home_slider')) : ?>
		<div class="home-top-slider top-block">
			<div class="swiper-wrapper">
				<?php
				while (have_rows('home_slider')) : the_row();
					$text = get_sub_field('text'); ?>

					<div class="swiper-slide">

						<div class="home-slider-text">
							<div class="main-text">
								<?= $text ?>
							</div>
							<div class="link-text">
								<?php
								$slider_link = get_sub_field('link');
								if ($slider_link) :
									$link_url = $slider_link['url'];
									$link_title = $slider_link['title'];
									$link_target = $slider_link['target'] ? $slider_link['target'] : '_self';

								?>
									<a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>
								<?php endif; ?>
							</div>

						</div>
						<div class="main-img">
							<img class="home-slider-img" src="<?php the_sub_field('image'); ?>" alt="">
						</div>


					</div>


				<?php
				endwhile; ?>

			</div>

			<div class="swiper-pagination"></div>


		</div>
	<?php
	endif; ?>

	<div class="catalog-wrapper site-light-gray-bg clear-float">

		<div class="category-wrapper boxed full-height-percent width-20-pc pull-left transition-050 home-all-category">
			<a href="<?= get_permalink(wc_get_page_id('shop')) ?>" class="display-block full-height-percent position-relative">
				<div class="category-image-wrapper display-table width-100-pc">
					<div class="display-table-cell middle">
						<div class="display-block margin-center transition-050 all-category-text"><?= get_field('all_category_text') ?></div>

					</div>
				</div>
				<div class="category-desc-wrapper boxed width-100-pc transition-050 coresans-500">
					<div class="headline text-center display-table width-100-pc">
						<div class="display-table-cell middle all-category-link">
							<?= __('Check All', 'bt') ?>
						</div>
					</div>
				</div>
			</a>
		</div>
		<?php

		$args = [
			'taxonomy' 	 => 'product_cat',
			'hide_empty' => 0,
			'menu_order' => 'asc'
		];

		$categories = get_categories($args);

		foreach ($categories as $key => $category) :
		?>

			<style>
				.cw-<?= $key; ?> a:before {
					background-color: <?php the_field('color', $category); ?>;
				}
			</style>

			<div class="category-wrapper cw-<?= $key ?> boxed full-height-percent width-20-pc pull-left transition-050">
				<a href="<?= esc_url(get_category_link($category->cat_ID)); ?>" title="<?= esc_html($category->name); ?>" class="display-block full-height-percent position-relative">
					<div class="category-image-wrapper display-table width-100-pc">
						<div class="display-table-cell middle">
							<?php
							$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
							$image = wp_get_attachment_url($thumbnail_id);
							?>
							<img src="<?= $image; ?>" alt="<?= get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>" class="display-block margin-center transition-050">
						</div>
					</div>
					<div class="category-desc-wrapper boxed width-100-pc transition-050 coresans-500">
						<div class="headline text-center display-table width-100-pc">
							<div class="display-table-cell middle">
								<?= esc_html($category->name); ?>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?php endforeach;
		wp_reset_postdata(); ?>
	</div>

	<div class="catalog-wrapper-mobile position-relative">
		<div class="swiper-container full-height-percent">
			<div class="swiper-wrapper">

				<?php

				$args = [
					'taxonomy' 	 => 'product_cat',
					'hide_empty' => 0,
					'menu_order' => 'asc'
				];

				$categories = get_categories($args);

				foreach ($categories as $key => $category) :

				?>

					<div class="swiper-slide mobile-category-wrapper boxed full-height-percent site-white" style="background-color: <?php the_field('color', $category); ?>;">
						<a href="<?= esc_url(get_category_link($category->cat_ID)); ?>" title="<?= esc_html($category->name); ?>" class="display-block full-height-percent position-relative">
							<div class="category-image-wrapper display-table width-100-pc">
								<div class="display-table-cell middle">
									<?php
									$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
									$image = wp_get_attachment_url($thumbnail_id);
									?>
									<img src="<?= $image; ?>" alt="<?= get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>" class="display-block margin-center transition-050">
								</div>
							</div>
							<div class="category-desc-wrapper boxed width-100-pc absolute-bottom-center coresans-300">
								<div class="headline text-center padding-bottom-20">
									<?= esc_html($category->name); ?>
								</div>
								<div class="desc text-center content-no-margin-top-bottom"><?php the_field('description', $category); ?></div>
								<div class="plus-icon text-center padding-top-25 padding-bottom-25">
									<?php $plus_icon = get_field('hp-plus-icon', 'option'); ?>
									<img src="<?= $plus_icon['url']; ?>" alt="<?= $plus_icon['alt']; ?>">
								</div>
							</div>
						</a>
					</div>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</div>
		</div>
		<div class="cwmn-btn cwmn-btn-right z-index-2">
			<img src="<?= BPATH . '/wp-content/uploads/2019/04/mobile-nav-right-icon-white.png'; ?>" class="absolute-center">
		</div>
		<div class="cwmn-btn cwmn-btn-left z-index-2">
			<img src="<?= BPATH . '/wp-content/uploads/2019/04/mobile-nav-left-icon-white.png'; ?>" class="absolute-center">
		</div>
	</div>

	<div class="tip-block">

		<div class="tip-content">
			<div class="tip-title"><?= get_field('tip_title') ?></div>
			<div class="tip-text"><?= get_field('tip_text') ?></div>

			<div class="tip-img-block">
				<img class="tip-img" src="<?php the_field('tip_image'); ?>" alt="">
			</div>


			<div class="tip-link">
				<?php
				$slider_link = get_field('tip_link');
				if ($slider_link) :
					$link_url = $slider_link['url'];
					$link_title = $slider_link['title'];
					$link_target = $slider_link['target'] ? $slider_link['target'] : '_self';

				?>
					<a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>
				<?php endif; ?>
			</div>
		</div>


	</div>

	<div class="posts-block">
		<div class="top-posts-content">
			<div class="posts_block-title"><?= get_field('posts_block_title') ?></div>
			<div class="posts-block-link">
				<?php
				$slider_link = get_field('posts_block_link');
				if ($slider_link) :
					$link_url = $slider_link['url'];
					$link_title = $slider_link['title'];
					$link_target = $slider_link['target'] ? $slider_link['target'] : '_self';

				?>
					<a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<div class="post-items">

			<?php
			$featured_posts = get_field('posts_block_item');
			if ($featured_posts) : ?>

				<?php foreach ($featured_posts as $featured_post) :
					$permalink = get_permalink($featured_post->ID);
					$title = get_the_title($featured_post->ID);
					$image = get_the_post_thumbnail_url($featured_post);
					$createDate = new DateTime($featured_post->post_date);


				?>
					<div class="post-wrapper boxed width-50-pc">
						<a href="<?= $permalink; ?>" title="<?= $title ?>" class="post-bg-link">
							<div class="image-wrapper site-bg" style="background-image: url( '<?= $image ?>' );">
							</div>


						</a>
						<div class="content-wrapper margin-center">
							<div class="post-date font18px-to-em"><?php echo $createDate->format('d.m.Y') ?></div>
							<a href="<?= $permalink; ?>" title="<?= $title ?>" class="post-title coresans-300 font30px-to-em padding-top-15 position-relative display-block transition-030"><?= $title ?>
							</a>
							<div class="short-desc font18px-to-em line-height-15 padding-top-35 content-no-margin-top-bottom"><?= $featured_post->post_content; ?></div>

							<div class="read-more">
								<a href="<?= $permalink; ?>"><?php _e('Read', 'bt') ?></a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

			<?php endif; ?>

		</div>


	</div>

	<div class="check-social-media">
		<div class="social-media-top">
			<p class="social-media-title">
				<?= the_field('social_media_title') ?>
			</p>

			<div class="social-media-text">
				<?= the_field('social_media_text') ?>
			</div>
		</div>


		<?php if (have_rows('social_media_images')) : ?>
			<div class="social_media_images">
				<div class="swiper-wrapper">
					<?php
					while (have_rows('social_media_images')) : the_row(); ?>
						<div class="swiper-slide social_media_image">
							<?php
							$slider_link = get_sub_field('link');
							if ($slider_link) :
								$link_url = $slider_link['url'];
								$link_title = $slider_link['title'];
								$link_target = $slider_link['target'] ? $slider_link['target'] : '_self';

							?>
								<a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>">
									<img class="" src="<?php the_sub_field('image'); ?>" alt=""></a>
							<?php endif; ?>


						</div>

					<?php
					endwhile; ?>

				</div>
				<div class="swiper-button swiper-button-prev"></div>
      			<div class="swiper-button swiper-button-next"></div>
			</div>

		<?php
		endif; ?>



	</div>


</main>

<?php get_footer(); ?>