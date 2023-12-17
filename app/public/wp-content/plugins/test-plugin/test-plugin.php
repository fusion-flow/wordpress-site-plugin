<?php
/*
Plugin Name: My Dummy Plugin
Description: A simple dummy WordPress plugin.
Version: 1.0
Author: Your Name
*/

// Define a shortcode function
function dummy_shortcode() {
    return "Hello, this is a dummy shortcode!";
}

// Register the shortcode
add_shortcode('dummy', 'dummy_shortcode');
