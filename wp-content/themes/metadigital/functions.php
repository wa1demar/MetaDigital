<?php
/**
 * @author: Vladimir Martynyuk
 */

function enqueue_our_required_stylesheets(){
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/font-awesome-4.3.0/css/font-awesome.min.css');
    wp_enqueue_script('angular', '/wp-content/themes/metadigital/js/angular.min.js');
    wp_enqueue_script('angular-app', '/wp-content/themes/metadigital/js/angular-app.js');
    wp_enqueue_script('main-controller', '/wp-content/themes/metadigital/js/mainController.js');
    wp_enqueue_script( 'jquery' );

}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');

require_once 'functions/init.php';
require_once 'functions/services_post_type.php';
require_once 'functions/gallery_post_type.php';
require_once 'functions/siteinfo_post_type.php';
