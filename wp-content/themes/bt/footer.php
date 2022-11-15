<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<footer class="main-site-footer site-ex-light-gray-bg coresans-300">
	<div class="container-1020 clear-float">

		<div class="footer-badge pull-left col  boxed line-height-15">
			<?php $footer_badge = get_field( 'badge_img', 'option' ); ?>
			<div class="badge-img-wraper">
				<img src="<?= $footer_badge['url']; ?>" alt="<?= $footer_badge['alt']; ?>" class="display-block margin-center width-100-pc">
			</div>
		</div>

		<?php
		for ( $i = 1; $i < 4; $i++ ) :
		$col_group = get_field( 'col-' . $i, 'option' );
		?>
		<div class="col pull-left boxed line-height-15">
			<div class="inner-col position-relative">
				<div class="content content-no-margin-top-bottom<?= ( !empty( $col_group['links'] ) ) ? ' padding-bottom-10' : ''; ?>"><?= $col_group['content']; ?></div>
				<?php if ($i == 3) : ?>
				<div class="row logos-row">
					<ul class="logos-list">
						<?php
						$links = [
							[
								'img' => [
									'src' => 'https://lexingham.com/wp-content/uploads/2021/12/zzoom-logo.png',
									'alt' => 'Z-Zoom',
								],
								'url' => 'https://z-zoom.co.uk/'
							],
							[
								'img' => [
									'src' => 'https://lexingham.com/wp-content/uploads/2021/12/travel-blue-logo2.png',
									'alt' => 'Travel Blue',
								],
								'url' => 'https://travel-blue.com/'
							],
							[
								'img' => [
									'src' => 'https://lexingham.com/wp-content/uploads/2021/12/anomeo-logo.png',
									'alt' => 'Anomeo',
								],
								'url' => 'https://anomeo.com/'
							],
						];
						?>
						<?php foreach ($links as $link) : ?>
						<li>
							<a href="<?= $link['url']; ?>" title="<?= $link['img']['alt']; ?>">
								<img src="<?= $link['img']['src']; ?>" alt="<?= $link['img']['alt']; ?>">
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php if ( !empty( $col_group['links'] ) ) : ?>
				<div class="links-wrapper coresans-500<?= ( $i === 3 ) ? ' site-blue-link' : ''; ?>">
					<?php foreach ( $col_group['links'] as $link ) : ?>
					<a href="<?= esc_url( urldecode( $link['link'] ) ); ?>" title="<?= esc_html( $link['link-title'] ); ?>" target="<?= $link['target']; ?>" class="link site-blue-link"><?= esc_html( $link['link-text'] ); ?></a>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endfor; ?>
	</div>
</footer>
<div class="copyright-wrapper text-center font14px-to-em padding-top-35 padding-bottom-35 coresans-300">
	<?php
	$copyright_icon_position = get_field( 'copyright-icon-position', 'option' );
	if ( $copyright_icon_position === 'left' ) :
	?>
	<span>&copy;</span><span><?= esc_html( get_field( 'left-copy', 'option' ) ); ?></span>
	<?php elseif ( $copyright_icon_position === 'middle' ) : ?>
	<?= esc_html( get_field( 'middle-copy-left', 'option' ) ); ?><span>&copy;</span><?= esc_html( get_field( 'middle-copy-right', 'option' ) ); ?>
	<?php elseif ( $copyright_icon_position === 'right' ) : ?>
	<span><?= esc_html( get_field( 'right-copy', 'option' ) ); ?></span><span>&copy;</span>
	<?php endif; ?>

	<div class="simplyad text-center margin-top-20" style="font-size: 16px;">
		<a href="https://www.simplyad.co.il/" title="" style="font-size: 16px;" target="_blank">
			<img src="/wp-content/uploads/2019/05/simplyadlogo.png" alt="" border="0" style="margin: 0px; width: 118px; height: 19px; border: none; font-size: 16px;">
		</a>
	</div>
</div>

<!--

Animate on scroll library - AOS

The MIT License (MIT)

Copyright (c) 2015 Michał Sajnóg

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

Animate on scroll library - AOS

-->

<?php wp_footer(); ?>
</body>
</html>