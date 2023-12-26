<?php
/*
Plugin Name: Custom Heading Plugin
Description: A simple plugin to customize the output of a heading block.
Version: 1.0
Author: Your Name
*/

function custom_heading_output($block_content, $block) {
    // Check if it's a heading block and contains "Who we are"
    if ($block['blockName'] === 'core/heading' && strpos($block_content, 'Who we are') !== false) {
        // Replace "Who we are" with "Where we are"
        $block_content = str_replace('Who we are', 'Where we are', $block_content);
    }

    return $block_content;
}

// Hook into the block editor content filter
add_filter('render_block', 'custom_heading_output', 10, 2);
?>
