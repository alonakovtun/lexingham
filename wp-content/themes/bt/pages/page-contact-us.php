<?php

/* template name: Contact Us */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

?>

<main class="site-light-gray-bg">
	<div class=" clear-float">
		
	
	<div class="contact-headline-paragraph text-center">
		<h1 class="line-height-15 font30px-to-em no-margin font400 coresans-300 padding-bottom-25"><?php the_field( 'inner-headline' ); ?></h1>
		<div class="paragraph line-height-15 font18px-to-em content-no-margin-top-bottom "><?php bt_the_content(); ?></div>
	</div>
	<div class="contact-form-wrapper container-1520 ">
		<?= do_shortcode( '[contact-form-7 id="429" title="Contact from"]' ); ?>
	</div>
		</div>
</main>

<?php get_footer(); ?>