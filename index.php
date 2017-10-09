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
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );

// function getUserIP(){
    // $client  = @$_SERVER['HTTP_CLIENT_IP'];
    // $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    // $remote  = $_SERVER['REMOTE_ADDR'];

    // if(filter_var($client, FILTER_VALIDATE_IP)){
        // $ip = $client;
    // }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        // $ip = $forward;
    // } else {
        // $ip = $remote;
    // }
    // return $ip;
// }
// Function to get the client IP address
// comment due to ticket https://jmango360.atlassian.net/browse/WEB-25
// function get_client_ip() {
//     $ipaddress = '';
//     if (getenv('HTTP_CLIENT_IP'))
//         $ipaddress = getenv('HTTP_CLIENT_IP');
//     else if(getenv('HTTP_X_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
//     else if(getenv('HTTP_X_FORWARDED'))
//         $ipaddress = getenv('HTTP_X_FORWARDED');
//     else if(getenv('HTTP_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_FORWARDED_FOR');
//     else if(getenv('HTTP_FORWARDED'))
//        $ipaddress = getenv('HTTP_FORWARDED');
//     else if(getenv('REMOTE_ADDR'))
//         $ipaddress = getenv('REMOTE_ADDR');
//     else
//         $ipaddress = 'UNKNOWN';
//     return $ipaddress;
// }

// // var_dump
// // write_log
// $user_ip = get_client_ip();
// write_log('log user ip: '.$user_ip); // display IP address

// $user_agent = $_SERVER['HTTP_USER_AGENT'];
// write_log('log user agent: '.$user_agent);

// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// write_log('log actual link: '.$actual_link);

// write_log('log link referer: '.$_SERVER["HTTP_REFERER"]);

