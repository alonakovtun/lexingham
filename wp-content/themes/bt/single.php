<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

$post_categories = get_the_category();

if ( !function_exists( 'the_post_categories_html' ) ) {

	function the_post_categories_html ( $post_categories ) {

		$category_separator = get_field( 'category-separator', 'option' );
		
		$html = '';

		foreach ( $post_categories as $category ) {

			$html .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . $category->name . '" class="transition-030 category-link">';
			$html .= $category->name;
			$html .= '</a>' . $category_separator;

		}

		$html = rtrim( trim( $html, $category_separator ) );

		echo $html;

	}

}

?>

<main class="site-light-gray-bg">

	<?php if ( !empty( $inner_banner_image = get_field( 'inner-post-image' ) ) ) : ?>
	<div class="top-post-image-wrapper">
		<img src="<?= $inner_banner_image['url']; ?>" alt="<?= $inner_banner_image['alt']; ?>">
	</div>
	<?php endif; ?>

	<div class="headlines-wrapper text-center">
		<div class="post-date-category-wrapper font18px-to-em coresans-300">
			<span><?= get_the_date(); ?></span><span><?php the_field( 'date-and-category-separator', 'option' ); ?></span><span><?php the_post_categories_html( $post_categories ); ?></span>
		</div>
		<h1 class="no-margin font30px-to-em margin-top-5 coresans-300 font400"><?php the_title(); ?></h1>
		
			<div class="post-tags margin-top-20 ">
					<ul class="clear-float display-block text-center">
						<?php

						$post_tags = get_the_tags();

						foreach ( $post_tags as $tag ) :

						?>
						<li class="display-inline-block margin-left-20">
							<a href="<?= get_tag_link( $tag->term_id ); ?>" class="display-block site-blue-link"><?= strtoupper( $tag->name ); ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
	</div>
	
	
	

	<div class="post-main-content container-1400 main-post-wrapper">
	<?php
$thecontent = get_the_content();
if(!empty($thecontent)) { ?>
		<div class="main-content-wrap content-section font18px-to-em line-height-15 padding-bottom-30 open-300">
			<?php the_content(); ?>
		</div>
		
		<?php } ?> 
		
		<?php if ( have_rows( 'post-content' ) ) : while ( have_rows( 'post-content' ) ) : the_row(); ?>
		<div class="content-section">
			<div class="paragraphs-wrapper clear-float">
				<?php
				$left_content = get_sub_field( 'left-content' );
				if ( !empty( $left_content['paragraph'] ) ) :
				?>
				<div class="left pull-left width-50-pc boxed content-no-margin-top-bottom font30px-to-em coresans-300 line-height-15"><?= $left_content['paragraph']; ?></div>
				<?php endif; ?>
				<?php
				$right_content = get_sub_field( 'right-content' );
				if ( !empty( $right_content['paragraph'] ) ) :
				?>
				<div class="right pull-right width-50-pc boxed content-no-margin-top-bottom font30px-to-em line-height-15"><?= $right_content['paragraph']; ?></div>
				<?php endif; ?>
			</div>
			<?php
			$image = get_sub_field( 'image' );
			if ( !empty( $image['image'] ) ) :
			?>
			<div class="image-wrapper">
				<img src="<?= $image['image']['url'] ?>" alt="<?= $image['image']['alt'] ?>">
			</div>
			<?php endif; ?>
		</div>
		
		<?php endwhile; endif; wp_reset_postdata(); ?>


					<section class="more-posts clear-float padding-bottom-100">
				<h4 class="font600 text-center margin-bottom-40">MORE POSTS</h4>
				<?php

				$args = [
					'post_type' 	 => 'post',
					'posts_per_page' => 3
				];
				
				$start = 1;

				$articles = new WP_Query( $args );

				if ( $articles->have_posts() ) : while ( $articles->have_posts() ) : $articles->the_post();

				if ( get_the_title() === $current_post_title ) {
					continue;
				}
				
				if ( $start === 4 ) {
					break;
				}
				
				?>

				<article class=" pull-left">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="image-wrapper site-bg" style="background-image: url( '<?= get_the_post_thumbnail_url(); ?>' );">
				<img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php bt_the_post_thumbnail_alt( get_the_ID() ); ?>">
			</div>
			</a>
					<div class="content-wrapper margin-center">
				<div class="post-date font18px-to-em"><?php the_date(); ?></div>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title coresans-300 font30px-to-em padding-top-15 position-relative display-block transition-030"><?php the_title(); ?>
					<?php $mp_plus_icon = get_field( 'mp-plus-icon', 'option' ); ?>
					<img src="<?= $mp_plus_icon['url']; ?>" alt="<?= $mp_plus_icon['alt']; ?>">
				</a>
				<div class="short-desc font18px-to-em line-height-15 padding-top-35 content-no-margin-top-bottom open-300"><?php the_excerpt(); ?></div>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="icon-after-sd display-block">
					<img src="<?= $mp_plus_icon['url']; ?>" alt="<?= $mp_plus_icon['alt']; ?>">
				</a>
			</div>
				</article>

				<?php $start++; endwhile; endif; wp_reset_postdata(); ?>
			</section>
		</div>
</main>

<?php get_footer(); ?>