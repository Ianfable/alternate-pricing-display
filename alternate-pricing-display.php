<?php
/*
Plugin Name: Alternate Pricing Display
Description: Enrich your store by displaying extra prices for diverse products such as beers, coffees, and more. This plugin enhances your WooCommerce shop by showing additional pricing options to your customers, providing flexibility and clarity.
Version: 1.0
Author: Marko Jankovic
Text Domain: alternate-pricing-display
*/


// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}


// Include frontend and admin files
include_once plugin_dir_path(__FILE__) . 'admin/index.php';
include_once plugin_dir_path(__FILE__) . 'public/index.php';

add_action('admin_enqueue_scripts', 'remove_admin_notices');

function remove_admin_notices() {
    global $pagenow;
   
    if ($pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == 'alternate-pricing-display-settings') {
    
        remove_all_actions('admin_notices');
    }
}


function custom_plugin_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=alternate-pricing-display-settings">Settings</a>';
    array_unshift($links, $settings_link); 
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'custom_plugin_settings_link');



