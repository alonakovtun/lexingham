<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$product_id 	   = $product->get_id();
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
	'position-relative'
) );

$product_categories 	= get_the_terms( $product_id, 'product_cat' )[0];
$product_caregory_color = get_field( 'color', $product_categories );

?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out; background-color: <?= $product_caregory_color; ?>;">
	<div class="product-images-wrapper swiper-container absolute-center">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="display-table width-100-pc full-height-percent">
					<div class="display-table-cell middle line-height-0 text-center">
						<img src="<?= get_the_post_thumbnail_url($product_id, 'full' ); ?>" alt="<?= bt_the_post_thumbnail_alt( $product_id ); ?>">
					</div>
				</div>
			</div>
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		</div>
	</div>
	<div class="custom-swiper-nav width-100-pc absolute-bottom-center z-index-3 clear-float">
		<?php
		$gallery_right_icon = get_field( 'gallery-right-icon', 'option' );
		$gallery_left_icon = get_field( 'gallery-left-icon', 'option' );
		?>
		<div class="swiper-nav-right icon pull-right padding-left-15">
			<img src="<?= $gallery_right_icon['url']; ?>" alt="<?= $gallery_right_icon['alt']; ?>">
		</div>
		<div class="swiper-nav-left icon pull-left padding-right-15">
			<img src="<?= $gallery_left_icon['url']; ?>" alt="<?= $gallery_left_icon['alt']; ?>">
		</div>
	</div>
</div>