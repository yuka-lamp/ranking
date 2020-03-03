<?php
if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'lamp_add_style', 9);
    function lamp_register_style()
    {
        wp_register_style('base-css', get_template_directory_uri().'/base.css');
        wp_register_style('main-css', get_stylesheet_directory_uri().'/style.css', array('base-css'));
        wp_register_style('font-awesome', get_template_directory_uri().'/lib/css/font-awesome.min.css');
    }
    function lamp_add_style()
    {
        lamp_register_style();
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('base-css');
        wp_enqueue_style('main-css');
    }
}

if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'lamp_add_script');
    function lamp_register_script()
    {
        wp_register_script('app', get_template_directory_uri().'/lib/js/app.js', array('jquery'), false, true);
        wp_register_script('pagetop', get_template_directory_uri().'/lib/js/jquery.pagetop.js', array('jquery'), false, true);
    }
    function lamp_add_script()
    {
        lamp_register_script();
        wp_enqueue_script('app');
        wp_enqueue_script('pagetop');
    }
}
add_action('admin_enqueue_scripts', 'lamp_admin_asset');

function lamp_admin_asset()
{
    wp_register_style('lamp_admin_css', get_template_directory_uri().'/lib/css/style_admin.css');
    wp_register_style('font-awesome', get_template_directory_uri().'/lib/css/font-awesome.min.css');
    wp_enqueue_style('lamp_admin_css');
    wp_enqueue_style('font-awesome');
    wp_register_script('lamp_admin_js', get_template_directory_uri().'/lib/js/lamp-admin.js', array('jquery'));
    wp_enqueue_script('lamp_admin_js');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
}