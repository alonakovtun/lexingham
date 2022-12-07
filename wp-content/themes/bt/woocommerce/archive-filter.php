<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_product_category() || is_shop() ) :

?>
<div class="filters-wrapper site-white coresans-300 site-blue-bg">
	<div class="filters-wrapper-btn-wrapper width-20-pc">
		<div class="filters-wrapper-btn display-table text-center site-blue-bg">
			<span><?php the_field( 'filter-button-text-when-closed', 'option' ); ?></span>
			<span><?php the_field( 'filter-button-text-when-open', 'option' ); ?></span>
		</div>
	</div>
	<div class="filters-content clear-float">
		<?= do_shortcode( '[woof]' ); ?>
		<?php if ( isset( $_GET['swoof'] ) ) : ?>
		<div class="custom-woof-filters-reset text-center">
			<a href="<?= CPATH; ?>" title="Reset all filters" class=""><?php _e('Reset all filters', 'bt')?></a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>