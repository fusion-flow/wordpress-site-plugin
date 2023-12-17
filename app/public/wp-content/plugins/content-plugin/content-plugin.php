<?php

/**
 * Plugin Name: test-plugin
 * Plugin URI: https://www.your-site.com/
 * Description: Test.
 * Version: 0.1
 * Author: your-name
 * Author URI: https://www.your-site.com/
 **/

function modify_read_more_link()
{
    return '<a class="more-link" href="' . get_permalink() . '">Click to Read!</a>';
}
add_filter('the_content_more_link', 'modify_read_more_link');
