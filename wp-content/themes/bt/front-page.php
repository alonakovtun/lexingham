<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

?>

<main>

	<div class="catalog-wrapper site-light-gray-bg clear-float">
		<?php

		$args = [
			'taxonomy' 	 => 'product_cat',
			'hide_empty' => 0,
			'menu_order' => 'asc'
		];

		$categories = get_categories( $args );

		foreach ( $categories as $key => $category ) :
		?>

		<style>
			.cw-<?= $key; ?> {
				border-bottom: 13px solid <?php the_field( 'color', $category ); ?>;
			}

			.cw-<?= $key; ?> a:before {
				background-color: <?php the_field( 'color', $category ); ?>;
			}
		</style>

		<div class="category-wrapper cw-<?= $key ?> boxed full-height-percent width-20-pc pull-left transition-050">
			<a href="<?= esc_url( get_category_link( $category->cat_ID ) ); ?>" title="<?= esc_html( $category->name ); ?>" class="display-block full-height-percent position-relative">
				<div class="category-image-wrapper display-table width-100-pc">
					<div class="display-table-cell middle">
						<?php
						$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id );
						?>
						<img src="<?= $image; ?>" alt="<?= get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ); ?>" class="display-block margin-center transition-050">
					</div>
				</div>
				<div class="category-desc-wrapper boxed width-100-pc transition-050 coresans-500">
					<div class="headline text-center display-table width-100-pc">
						<div class="display-table-cell middle">
							<?= esc_html( $category->name ); ?>
						</div>
					</div>
					<div class="desc text-center content-no-margin-top-bottom"><?php the_field( 'description', $category ); ?></div>
					<div class="plus-icon text-center padding-top-35 padding-bottom-35">
						<?php $plus_icon = get_field( 'hp-plus-icon', 'option' ); ?>
						<img src="<?= $plus_icon['url']; ?>" alt="<?= $plus_icon['alt']; ?>">
					</div>
				</div>
			</a>
		</div>
		<?php endforeach; wp_reset_postdata(); ?>
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

				$categories = get_categories( $args );

				foreach ( $categories as $key => $category ) :

				?>

				<div class="swiper-slide mobile-category-wrapper boxed full-height-percent site-white" style="background-color: <?php the_field( 'color', $category ); ?>;">
					<a href="<?= esc_url( get_category_link( $category->cat_ID ) ); ?>" title="<?= esc_html( $category->name ); ?>" class="display-block full-height-percent position-relative">
						<div class="category-image-wrapper display-table width-100-pc">
							<div class="display-table-cell middle">
								<?php
								$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
								$image = wp_get_attachment_url( $thumbnail_id );
								?>
								<img src="<?= $image; ?>" alt="<?= get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ); ?>" class="display-block margin-center transition-050">
							</div>
						</div>
						<div class="category-desc-wrapper boxed width-100-pc absolute-bottom-center coresans-300">
							<div class="headline text-center padding-bottom-20">
								<?= esc_html( $category->name ); ?>
							</div>
							<div class="desc text-center content-no-margin-top-bottom"><?php the_field( 'description', $category ); ?></div>
							<div class="plus-icon text-center padding-top-25 padding-bottom-25">
								<?php $plus_icon = get_field( 'hp-plus-icon', 'option' ); ?>
								<img src="<?= $plus_icon['url']; ?>" alt="<?= $plus_icon['alt']; ?>">
							</div>
						</div>
					</a>
				</div>
				<?php endforeach; wp_reset_postdata(); ?>
			</div>
		</div>
		<div class="cwmn-btn cwmn-btn-right z-index-2">
			<img src="<?= BPATH . '/wp-content/uploads/2019/04/mobile-nav-right-icon-white.png'; ?>" class="absolute-center">
		</div>
		<div class="cwmn-btn cwmn-btn-left z-index-2">
			<img src="<?= BPATH . '/wp-content/uploads/2019/04/mobile-nav-left-icon-white.png'; ?>" class="absolute-center">
		</div>
	</div>

</main>

<?php get_footer(); ?>