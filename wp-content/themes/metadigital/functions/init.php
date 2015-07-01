<?php
/**
 * @author: Vladimir Martynyuk
 */

define('THEME_URL', get_template_directory_uri());

add_action('wp_print_styles', 'meta_enqueue_style');
function meta_enqueue_style() {

    wp_enqueue_style('main', THEME_URL . '/css/main.css');

}

add_action('wp_enqueue_scripts', 'meta_enqueue_script');
function meta_enqueue_script() {

    wp_enqueue_script('main', THEME_URL . '/js/main.js');
    wp_enqueue_script('zoom_map', THEME_URL . '/js/zoom_map.js');
    wp_enqueue_script('scroller', THEME_URL . '/js/scroller.js');

}

add_theme_support( 'post-thumbnails' );

