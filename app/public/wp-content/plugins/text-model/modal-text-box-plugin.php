<?php
/*
Plugin Name: Modal Text Box Plugin
Description: A simple plugin to add a text box with a modal.
Version: 1.0
Author: Your Name
*/

function enqueue_modal_text_box_assets() {
    // Enqueue CSS file
    wp_enqueue_style('modal-text-box-style', plugins_url('style.css', __FILE__));

    // Enqueue JavaScript file
    wp_enqueue_script('modal-text-box-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}

// Hook into the WordPress enqueue_scripts action
add_action('wp_enqueue_scripts', 'enqueue_modal_text_box_assets');

function display_modal_text_box() {
    ob_start(); ?>
    <div class="modal-text-box">
        <input type="text" id="customTextBox" placeholder="Type something...">
        <button id="openModalBtn">Open Modal</button>
        <div class="modal" id="customModal">
            <div class="modal-content">
                <span class="close" id="closeModalBtn">&times;</span>
                <p>You typed: <span id="typedText"></span></p>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// Add the text box with modal to the footer
function add_modal_text_box_to_footer() {
    echo display_modal_text_box();
}

// Hook into the WordPress wp_footer action
add_action('wp_footer', 'add_modal_text_box_to_footer');
?>
