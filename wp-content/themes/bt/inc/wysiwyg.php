<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

function tnl_add_nofollow () {
    wp_deregister_script('wplink');
    wp_register_script('wplink',  get_template_directory_uri() . '/assets/js/nofollow.min.js', ['jquery'], '', true);
    wp_enqueue_script('wplink');
    wp_localize_script('wplink', 'wpLinkL10n', array(
        'title' => __('Insert/edit link'),
        'update' => __('Update'),
        'save' => __('Add Link'),
        'noTitle' => __('(no title)'),
        'labelTitle' => __( 'Title' ),
        'noMatchesFound' => __('No results found.'),
        'noFollow' => __(' Add <code>rel="nofollow"</code> to link', 'title-and-nofollow-for-links')
    ));
}
add_action('wp_enqueue_editor', 'tnl_add_nofollow', 99999);

function tnl_add_nofollow_early () {

    if ( ! wp_script_is( 'wplink', 'registered' ) ) {
        return;
    }

    wp_deregister_script('wplink');
    wp_register_script('wplink', get_template_directory_uri() . '/assets/js/nofollow.min.js', ['jquery', 'wp-a11y'], '', true);
    wp_localize_script('wplink', 'wpLinkL10n', array(
        'title' => __('Insert/edit link'),
        'update' => __('Update'),
        'save' => __('Add Link'),
        'noTitle' => __('(no title)'),
        'labelTitle' => __( 'Title' ),
        'noMatchesFound' => __('No results found.'),
        'noFollow' => __(' Add <code>rel="nofollow"</code> to link', 'title-and-nofollow-for-links')
    ));
    
}
add_action('admin_enqueue_scripts', 'tnl_add_nofollow_early', 99999 );

function update_tinymc_height ( $initArray ) {
    $initArray['height'] = '170px';
    return $initArray;
}
add_filter( 'tiny_mce_before_init', 'update_tinymc_height' );