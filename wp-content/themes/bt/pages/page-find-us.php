<?php

/* template name: Find Us */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();

?>

<main class="site-light-gray-bg find-us-page">
	<div class=" clear-float">

		<div class="contact-headline-paragraph text-center">
			<h1 class="font30px-to-em no-margin font400 coresans-300 padding-bottom-25"><?php the_field('title'); ?></h1>
			<div class="paragraph line-height-15 font18px-to-em content-no-margin-top-bottom "><?php the_field('top_content'); ?></div>
		</div>

		<div class="repeater-blocks container-1020">
			<?php if (have_rows('first_col')) : ?>
				<div class="find-content">
					<?php while (have_rows('first_col')) : the_row();

						$title = get_sub_field('title');
						$content = get_sub_field('content');
					?>

						<p class="title coresans-500"><?= $title; ?></p>
						<div class="content">
							<?= $content; ?>
						</div>




					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<?php if (have_rows('second_col')) : ?>
				<div class="find-content">
					<?php while (have_rows('second_col')) : the_row();

						$title = get_sub_field('title');
						$content = get_sub_field('content');
					?>

						<p class="title coresans-500"><?= $title; ?></p>
						<div class="content">
							<?= $content; ?>
						</div>




					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<?php if (have_rows('third_col')) : ?>
				<div class="find-content">
					<?php while (have_rows('third_col')) : the_row();

						$title = get_sub_field('title');
						$content = get_sub_field('content');
					?>

						<p class="title coresans-500"><?= $title; ?></p>
						<div class="content">
							<?= $content; ?>
						</div>




					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>

	</div>
</main>

<?php get_footer(); ?>