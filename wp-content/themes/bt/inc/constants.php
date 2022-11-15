<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

define( 'BREADCRUMBS_HOME_PAGE_NAME', 'בית' );
define( 'BPATH', get_site_url() );
define( 'FPATH', filter_var( BPATH . $_SERVER['REQUEST_URI'] , FILTER_SANITIZE_URL ) );
define( 'CPATH', explode( '?',FPATH )[0] );
define('CLANG', ICL_LANGUAGE_CODE);