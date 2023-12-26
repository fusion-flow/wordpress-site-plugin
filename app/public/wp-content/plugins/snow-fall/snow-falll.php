<?php
/*
Plugin Name: Snow Fall
Description: Add a snowfall effect to your website.
Version: 1.0
Author: Your Name
*/

// Enqueue the script and styles
function snow_fall_enqueue_scripts() {
    wp_enqueue_script('snowstorm', plugins_url('/snowstorm.js', __FILE__), array(), '1.0', true);
    wp_enqueue_style('snow-fall-style', plugins_url('/snow-fall.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'snow_fall_enqueue_scripts');
?>
