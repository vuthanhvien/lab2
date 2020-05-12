<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );



$currenturl = $_SERVER['REQUEST_URI'];
$path = explode("/", $currenturl);

global $vi;
$domain = $_SERVER['HTTP_HOST'];
if($domain == 'digitalstrategy.vn'){
    $vi = false;
}else{
    $vi = true;
}

    

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
