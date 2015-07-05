<?php
/**
 * @author: Vladimir Martynyuk
 */

define('THEME_URL', get_template_directory_uri());

add_action('wp_print_styles', 'meta_enqueue_style');
function meta_enqueue_style() {

    wp_enqueue_style('font-awesome', THEME_URL . '/font-awesome-4.3.0/css/font-awesome.min.css');

    wp_enqueue_style('main', THEME_URL . '/css/main.css');
    wp_enqueue_style('animation', THEME_URL . '/css/animation.css');
    wp_enqueue_style('slick', THEME_URL . '/css/slick.css');
    wp_enqueue_style('jquery-ui', THEME_URL . '/css/jquery-ui.css');

}

add_action('wp_enqueue_scripts', 'meta_enqueue_script');
function meta_enqueue_script() {

    wp_enqueue_script( 'jquery' );

    wp_enqueue_script('angular', '/wp-content/themes/metadigital/js/angular.min.js');
    wp_enqueue_script('angular-app', '/wp-content/themes/metadigital/js/angular-app.js');
    wp_enqueue_script('main-controller', '/wp-content/themes/metadigital/js/mainController.js');
    wp_enqueue_script('ng_animate', THEME_URL . '/js/angular-animate.min.js');
    wp_enqueue_script('jquery-ui', THEME_URL . '/js/jquery-ui.min.js');

    wp_enqueue_script('main', THEME_URL . '/js/main.js');
    wp_enqueue_script('zoom_map', THEME_URL . '/js/zoom_map.js');
    wp_enqueue_script('scroller', THEME_URL . '/js/scroller.js');
    wp_enqueue_script('slick', THEME_URL . '/js/slick.min.js');
    wp_enqueue_script('dialog-message', THEME_URL . '/js/dialog-message.js');

}

add_theme_support( 'post-thumbnails' );

function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );

    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);
