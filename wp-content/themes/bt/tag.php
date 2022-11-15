<?php

/**
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lexingham
 */

get_header();

?>

<main class="site-light-gray-bg">
		<?php
		$tag = get_queried_object();
		
		?>
	<div class="headlines-wrapper text-center">
			<h2 class="no-margin font30px-to-em coresans-300 font400 margin-top-5">Tag</h2>
		<h1 class="no-margin font30px-to-em coresans-300 font400"><?= ucfirst( $tag->name ); ?></h1>
	</div>

	<?php

	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	
	$args = [
		'post_type' 	 => 'post',
		'posts_per_page' => 8,
		'orderby' 		 => 'date',
		'order' 		 => 'desc',
		'paged' 		 => $paged,
'tag_id'         => $tag->term_id
	];

	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : ?>

	<div class="posts-wrapper clear-float display-flex-wrap">

		<?php while ( $posts->have_posts() ) : $posts->the_post();

		?>
		<div class="post-wrapper boxed width-50-pc pull-left">
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
		</div>
		<?php endwhile; ?>

	</div>

	<div class="pagination-wrap padding-top-60">
		<?php
		echo paginate_links( array(
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'total'        => $posts->max_num_pages,
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'format'       => '?paged=%#%',
			'show_all'     => false,
			'type'         => 'list',
			'end_size'     => 1,
			'mid_size'     => 1,
			'prev_next'    => false,
			'prev_text'    => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
			'next_text'    => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
			'add_args'     => false,
			'add_fragment' => '',
		) );
		?>
	</div>

	<?php endif; wp_reset_postdata(); ?>

</main>

<?php get_footer(); ?>