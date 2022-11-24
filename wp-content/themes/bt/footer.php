<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<footer class="main-site-footer site-ex-light-gray-bg coresans-300">
	<div class="container-1020 footer-content">

		<?php
		for ( $i = 1; $i < 4; $i++ ) :
		$col_group = get_field( 'col-' . $i, 'option' );
		?>
		<div class="col boxed line-height-15">
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
<div class="copyright-wrapper font14px-to-em padding-top-35 padding-bottom-35 coresans-300 container-1020">
	<div class="col copyright-wrapper-left">
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
	</div>

	<div class="col"></div>
	
	<div class="col copyright-wrapper-right">
		<a href="https://parishendzelstudio.com/" class="created-by"><?php _e('by PHS', 'bt')?></a>
	</div>


	
</div>

<?php wp_footer(); ?>
</body>
</html>