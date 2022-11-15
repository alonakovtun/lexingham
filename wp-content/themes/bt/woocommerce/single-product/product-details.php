<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// if (current_user_can('administrator')) {
// 	echo '<pre>';
// 	print_r(get_post_meta($product->get_id()));
// 	echo '</pre>';
// }
?>
<div class="product-details-wrapper site-white-bg" id="product-details">
	<div class="container-1490 clear-float">
		<div class="col col-left pull-left line-height-15">
			<?php
			$left_col 			 = get_field( 'left-col', 'option' );
			$product_left_column = get_field( 'product-left-column' );
			$product_sku 		 = $product->get_sku();
			?>
			<div class="col-content-wrap">
			<div class="headline coresans-500"><?= $left_col['headline']; ?></div>
			<div class="details content-no-margin-top-bottom"><?= $product_left_column['details-paragraph']; ?></div>
		
			</div></div>
		<div class="col col-middle pull-left line-height-15">
			<div class="col-content-wrap">
			<?php $product_middle_column = get_field( 'product-middle-column' ); ?>
			<div class="content content-no-margin-top-bottom "><?= $product_middle_column['paragraph']; ?></div>
	
			</div>
		</div>
		<div class="col col-right pull-left line-height-15">
			<div class="col-content-wrap">
					<?php if ( !empty( $product_sku ) ) : ?>
			<div class="sku"><?= $left_col['sku-paragraph-format'] . $product_sku; ?></div>
			<?php endif; ?>
						<div class="warranty coresans-500">
				<?php
				
				$warranty = get_field( 'product-middle-column' );
				
				if ( $warranty['warranty'] === 'default' ) {
					$warranty = get_field( 'middle-col', 'option' );
				}
				
				if ( $warranty['default-warranty-link-type'] === 'url' ) {
					$href = $warranty['default-warranty-link-url'];
				} elseif ( $warranty['default-warranty-link-type'] === 'file' ) {
					$href = $warranty['default-warranty-file']['url'];
				}
				
				?>
				<a href="<?= $href; ?>" target="_blank" title="<?= $warranty['default-warranty-link-title']; ?>"><?= $warranty['default-warranty-paragraph']; ?></a>
			</div>
			<?php $product_right_column = get_field( 'product-right-column' ); ?>
			<div class="content content-no-margin-top-bottom"><?= $product_right_column['paragraph']; ?></div>
			</div>
		</div>
	
		</div>
				<div class="paragraph-full-content ">
			<div class="content "><?php the_field('paragraph'); ?></div>
			</div>
		</div>
	</div>
</div>