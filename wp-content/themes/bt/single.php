<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();

$post_categories = get_the_category();

if (!function_exists('the_post_categories_html')) {

	function the_post_categories_html($post_categories)
	{

		$category_separator = get_field('category-separator', 'option');

		$html = '';

		foreach ($post_categories as $category) {

			$html .= '<a href="' . get_category_link($category->term_id) . '" title="' . $category->name . '" class="transition-030 category-link">';
			$html .= $category->name;
			$html .= '</a>' . $category_separator;
		}

		$html = rtrim(trim($html, $category_separator));

		echo $html;
	}
}

?>

<main class="site-light-gray-bg">

	<?php if (!empty($inner_banner_image = get_field('inner-post-image'))) : ?>
		<div class="top-post-image-wrapper">
			<img src="<?= $inner_banner_image['url']; ?>" alt="<?= $inner_banner_image['alt']; ?>">
		</div>
	<?php endif; ?>

	<div class="headlines-wrapper text-center">
		<div class="post-date-category-wrapper font18px-to-em coresans-300">
			<span><?= get_the_date(); ?></span><span><?php the_field('date-and-category-separator', 'option'); ?></span><span><?php the_post_categories_html($post_categories); ?></span>
		</div>
		<h1 class="no-margin font30px-to-em margin-top-20 coresans-300 font400"><?php the_title(); ?></h1>


	</div>




	<div class="post-main-content container-1400 main-post-wrapper">
		<?php
		$thecontent = get_the_content();
		if (!empty($thecontent)) { ?>
			<div class="main-content-wrap content-section font18px-to-em line-height-15 padding-bottom-30 open-300">
				<?php the_content(); ?>
			</div>

		<?php } ?>

		<?php if (have_rows('post-content')) : while (have_rows('post-content')) : the_row(); ?>
				<div class="content-section">
					<div class="paragraphs-wrapper clear-float">
						<?php
						$left_content = get_sub_field('left-content');
						if (!empty($left_content['paragraph'])) :
						?>
							<div class="left pull-left width-50-pc boxed content-no-margin-top-bottom font30px-to-em coresans-300 line-height-15"><?= $left_content['paragraph']; ?></div>
						<?php endif; ?>
						<?php
						$right_content = get_sub_field('right-content');
						if (!empty($right_content['paragraph'])) :
						?>
							<div class="right pull-right width-50-pc boxed content-no-margin-top-bottom font30px-to-em line-height-15"><?= $right_content['paragraph']; ?></div>
						<?php endif; ?>
					</div>
					<?php
					$image = get_sub_field('image');
					if (!empty($image['image'])) :
					?>
						<div class="image-wrapper">
							<img src="<?= $image['image']['url'] ?>" alt="<?= $image['image']['alt'] ?>">
						</div>
					<?php endif; ?>
				</div>

		<?php endwhile;
		endif;
		wp_reset_postdata(); ?>



	</div>
</main>

<?php get_footer(); ?>