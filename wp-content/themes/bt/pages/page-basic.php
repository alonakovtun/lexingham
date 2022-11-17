<?php

/* template name: Basic Page */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

?>

<main class="site-light-gray-bg">
	<div class="content-section">
	<div class="post-main-content container-1400">
	<div class="headlines-wrapper text-center ">

		<h1 class=" no-margin margin-top-5 font30px-to-em  coresans-300 font400 "><?php the_title(); ?></h1>
	</div>


	<?php
$thecontent = get_the_content();
if(!empty($thecontent)) { ?>
		<div class="main-content-wrap content-section font18px-to-em line-height-15 padding-bottom-30">
			<?php the_content(); ?>
		</div>
		
		<?php } ?> 

	</div>
	</div>
</main>

<?php get_footer(); ?>