<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();

?>

<main class="page-404 site-light-gray-bg">
	<section class="container-1020 text-center full-height-percent">
		<div class="display-table full-height-percent width-100-pc">
			<div class="display-table-cell middle">
				<h1 class="no-margin font50em font400 coresans-300">404</h1>
				<h2 class="font15em font400 coresans-300">You seem to be lost, use the navigation above or click the link below to get back to us.</h2>
				<a href="<?= BPATH; ?>" class="font15em coresans-300" style="text-decoration:underline;">Home page</a>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>