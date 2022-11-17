<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/** remove actions / filters **/
require THEME_DIR . 'inc/woocommerce/remove.php';

/** everything action related ( not including remove ) **/
require THEME_DIR . 'inc/woocommerce/actions.php';

/** everything filter related ( not including remove ) **/
require THEME_DIR . 'inc/woocommerce/filters.php';

/** Default woocommerce template extensions **/
require THEME_DIR . 'inc/woocommerce/template-extensions.php';