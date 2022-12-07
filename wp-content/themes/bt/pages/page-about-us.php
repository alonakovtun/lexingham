<?php

/* template name: About Us */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

?>

<!--div class="guideline"></div-->

<div class="about-banner site-bg" style="background-image: url( '<?= esc_url( get_field( 'banner-image' )['url'] ); ?>' );">
	<div class="display-table width-100-pc full-height-percent">
		<div class="display-table-cell middle font25em text-center content-no-margin-top-bottom coresans-300"><?= get_field( 'banner-text' ); ?></div>
	</div>
</div>

<main class="about-page">

	<div class="top-paragraph text-center font30px-to-em content-no-margin-top-bottom coresans-300"><?= get_field( 'top-paragraph' )['paragraph']; ?></div>
	
	<div class="left-right-content-wrapper clear-float">
		<div class="left-content-wrapper pull-left width-50-pc">
			<?php $left_content = get_field( 'left-side-content' ); ?>
			<div class="image-wrapper image-one line-height-0" data-aos="fade-up" data-aos-duration="1000">
				<img src="<?= $left_content['image-one']['url']; ?>" alt="<?= $left_content['image-one']['alt']; ?>">
			</div>
			<div class="paragraph-wrapper paragraph-one font30px-to-em content-no-margin-top-bottom coresans-300" data-aos="fade-up" data-aos-duration="1000"><?= $left_content['paragraph-one']; ?></div>
			<div class="image-wrapper image-two line-height-0" data-aos="fade-up" data-aos-duration="1000">
				<img src="<?= $left_content['image-two']['url']; ?>" alt="<?= $left_content['image-two']['alt']; ?>">
			</div>
		</div>
		<div class="right-content-wrapper pull-left width-50-pc">
			<?php $right_content = get_field( 'right-side-content' ); ?>
			<div class="image-wrapper image-one line-height-0" data-aos="fade-up" data-aos-duration="1000" dir="rtl">
				<img src="<?= $right_content['image-one']['url']; ?>" alt="<?= $right_content['image-one']['alt']; ?>">
			</div>
			<div class="paragraph-wrapper paragraph-one font18px-to-em content-no-margin-top-bottom" data-aos="fade-up" data-aos-duration="1000"><?= $right_content['paragraph-one']; ?></div>
			<div class="image-wrapper image-two line-height-0" data-aos="fade-up" data-aos-duration="1000" dir="rtl">
				<img src="<?= $right_content['image-two']['url']; ?>" alt="<?= $right_content['image-two']['alt']; ?>">
			</div>
		</div>
	</div>

	<div class="center-image-wrapper">
		<?php $center_image = get_field( 'center-image' ); ?>
		<div class="image-wrapper line-height-0" data-aos="fade-up" data-aos-duration="1000">
			<img src="<?= $center_image['image']['url']; ?>" alt="<?= $center_image['image']['alt']; ?>" class="display-block margin-center">
		</div>
	</div>

	<div class="bottom-paragraphs-wrapper clear-float">
		<div class="left-paragraph pull-left width-50-pc">
			<?php $bottom_left_paragraph = get_field( 'bottom-left-paragraph' ); ?>
			<div class="paragraph font30px-to-em content-no-margin-top-bottom coresans-300" data-aos="fade-up" data-aos-duration="1000"><?= $bottom_left_paragraph['paragraph']; ?></div>
		</div>
		<div class="right-block">
			<div class="width-50-pc"></div>
		<div class="right-paragraph pull-left width-50-pc">
			<?php $bottom_right_paragraph = get_field( 'bottom-right-paragraph' ); ?>
			<div class="paragraph font18px-to-em content-no-margin-top-bottom" data-aos="fade-up" data-aos-duration="1000"><?= $bottom_right_paragraph['paragraph']; ?></div>
		</div>
		</div>
		
	</div>

</main>

<?php get_footer(); ?>