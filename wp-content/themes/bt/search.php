<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

$searched_term = filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);

?>

<main class="site-light-gray-bg">
<div class="clear-float">

		<h1 class="headline cinzel-400 font22em site-blue no-margin padding-bottom-30 margin-bottom-30 margin-top-30 text-center">Search results for: <?= get_search_query(); ?></h1>

	
		<div class="woocommerce woocommerce-search">

			<ul class="products display-flex-wrap columns-5">

				<?php if ( have_posts() ) : ?>

				<?php
				while ( have_posts() ) : the_post();
				if ( get_post_type( get_the_ID() ) === 'product' ) :
				$product_id = get_the_ID();
				?>

				<li class="product search-product-li">
					<a href="<?php the_permalink( $product_id ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
<div>
						<div class="product-list-img-wrap">
							<img src="<?= get_the_post_thumbnail_url( $product_id, 'full' ); ?>" class="img-responsive" >
						</div>
			<div class="text-center padding-top-35 coresans-300"><?php the_title(); ?></div>
					


						</div>	
					</a>
				</li>
				
			
				<?php endif; ?>

				<?php endwhile; ?>
			</ul>
		</div>
	
	

		<?php
		the_posts_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . __( '<i class="fas fa-angle-double-right"></i>', 'bt' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( '<i class="fas fa-angle-double-left"></i>', 'bt' ) . '</span>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'bt' ) . ' </span>',
		) );
		?>
		<?php else: ?>
			<p class="search-results text-center font15em site-blue">No results for: <?= get_search_query(); ?></p>  
		<?php endif; ?>
	</div>
	</main>

	<?php get_footer(); ?>