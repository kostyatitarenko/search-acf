<?php
/*
Plugin Name: Search ACF
Plugin URI:
Description:
Version: 1.0.0
Author: Kostya
Author URI:
*/

function search_acf_install()
{
}

function search_acf_uninstall()
{
}

function search_acf_delete()
{
}

register_activation_hook(__FILE__, 'search_acf_install');
register_deactivation_hook(__FILE__, 'search_acf_uninstall');
register_uninstall_hook(__FILE__, 'search_acf_delete');

function search_acf_admin_menu()
{
    add_menu_page('Search ACF', 'Search ACF', 8, 'search_acf', 'search_acf_editor', 'dashicons-menu');
}
add_action('admin_menu', 'search_acf_admin_menu');

function search_acf_editor()
{
    include_once("includes/view_admin.php");
}


function show_search_acf()
{
    include_once("includes/show_search_acf.php");
}
add_action('admin_init', 'show_search_acf');



function search_acf_scripts()
{
    wp_enqueue_script('button_menu_script', plugins_url('includes/assets/js/common.js', __FILE__), array('jquery'), null);
    wp_enqueue_style('button_menu_style', plugins_url('includes/assets/css/style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'search_acf_scripts');

function search_acf_scripts_admin()
{
    wp_enqueue_script('button_menu_script', plugins_url('includes/assets/js/common-admin.js', __FILE__), '', null);
    wp_enqueue_script('wp-color-picker');
    
    wp_enqueue_style('button_menu_style', plugins_url('includes/assets/css/style-admin.css', __FILE__), '', null);
}
add_action('admin_footer', 'search_acf_scripts_admin');
