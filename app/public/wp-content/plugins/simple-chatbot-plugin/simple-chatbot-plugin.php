<?php
/*
Plugin Name: Simple Chatbot Plugin
Description: A simple chatbot interface for WordPress.
Version: 1.0
Author: Your Name
*/

function enqueue_chatbot_assets() {
    // Enqueue CSS file
    wp_enqueue_style('chatbot-style', plugins_url('style.css', __FILE__));

    // Enqueue JavaScript file
    wp_enqueue_script('chatbot-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}

// Hook into the WordPress enqueue_scripts action
add_action('wp_enqueue_scripts', 'enqueue_chatbot_assets');

function display_chatbot_interface() {
    ob_start(); ?>
    <div id="chatbot-container">
        <div id="chatbot-messages"></div>
        <div id="user-input-container">
            <input type="text" id="user-input" placeholder="Type your message...">
            <button id="send-btn">Send</button>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// Add the chatbot interface to the footer
function add_chatbot_interface_to_footer() {
    echo display_chatbot_interface();
}

// Hook into the WordPress wp_footer action
add_action('wp_footer', 'add_chatbot_interface_to_footer');
?>
