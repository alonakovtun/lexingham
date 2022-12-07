<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>

<footer class="main-site-footer site-ex-light-gray-bg coresans-300">
	<div class="find-us-link">
		<?php $find_us_link = get_field('find_us_link', 'option');
		if ($find_us_link) :
			$link_url = $find_us_link['url'];
			$link_title = $find_us_link['title'];
			$link_target = $find_us_link['target'] ? $find_us_link['target'] : '_self';

		?>
			<a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"> <?php echo esc_html($link_title); ?></a>
		<?php endif; ?>
	</div>
	<div class="container-1020 footer-content">

		<?php
		for ($i = 1; $i < 3; $i++) :
			$col_group = get_field('col-' . $i, 'option');
		?>
			<div class="col boxed line-height-15">
				<div class="inner-col position-relative">
					<div class="content content-no-margin-top-bottom footer-text"><?= $col_group['content']; ?></div>
					<?php if ($i == 1) : ?>
						<?php if (!empty($col_group['social_links'])) : ?>

							<div class="links-wrapper coresans-500 social-links">
								<?php foreach ($col_group['social_links'] as $social_links) : ?>
									<?php foreach ($social_links as $social_link) : ?>


										<?php
										$link_url = $social_link['url'];
										$link_title = $social_link['title'];
										$link_target = $social_link['target'] ? $social_link['target'] : '_self';
										// var_dump($link_url);

										?>
										<a class="link site-blue-link" target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>
									<?php endforeach; ?>
								<?php endforeach; ?>

							</div>

							<div class="links-wrapper coresans-400 links">
								<?php foreach ($col_group['links'] as $links) : ?>
									<?php foreach ($links as $link) : ?>


										<?php
										$link_url = $link['url'];
										$link_title = $link['title'];
										$link_target = $link['target'] ? $link['target'] : '_self';
										// var_dump($link_url);

										?>
										<a class="link site-blue-link" target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>
									<?php endforeach; ?>
								<?php endforeach; ?>

							</div>

						<?php endif; ?>

					<?php endif; ?>
					<?php if ($i == 2) : ?>
						<?php if (!empty($col_group['group_links'])) : ?>
							<div class="row logos-row">
								<ul class="logos-list">

									<?php foreach ($col_group['group_links'] as $group_links) : ?>
										<?php if ($group_links['image']) : ?>


											<?php
											$link_url = $group_links['link']['url'];
											$link_title = $group_links['link']['title'];
											$link_target = $group_links['link']['target'] ? $group_links['link']['target'] : '_self';
											// var_dump($link_url);

											?>
											<li>
												<a class="link site-blue-link" target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?>
													<img src="<?php echo $group_links['image'] ?>" alt="">
												</a>
											</li>
										<?php endif; ?>

									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>





					<?php endif; ?>

				</div>
			</div>
		<?php endfor; ?>
	</div>
</footer>
<div class="copyright-wrapper font14px-to-em padding-top-35 padding-bottom-35 coresans-300 container-1020">
	<div class="col copyright-wrapper-left">
		<?php
		$copyright_icon_position = get_field('copyright-icon-position', 'option');
		if ($copyright_icon_position === 'left') :
		?>
			<span>&copy;</span><span><?= esc_html(get_field('left-copy', 'option')); ?></span>
		<?php elseif ($copyright_icon_position === 'middle') : ?>
			<?= esc_html(get_field('middle-copy-left', 'option')); ?><span>&copy;</span><?= esc_html(get_field('middle-copy-right', 'option')); ?>
		<?php elseif ($copyright_icon_position === 'right') : ?>
			<span><?= esc_html(get_field('right-copy', 'option')); ?></span><span>&copy;</span>
		<?php endif; ?>
	</div>

	<div class="col copyright-wrapper-right">
		<a href="https://parishendzelstudio.com/" class="created-by"><?php _e('by PHS', 'bt') ?></a>
	</div>



</div>

<?php wp_footer(); ?>
</div>
</body>

</html>