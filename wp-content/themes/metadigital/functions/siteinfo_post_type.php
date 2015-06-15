<?php
/**
 * @author: Vladimir Martynyuk
 */

add_action('init', 'register_siteinfo_form');
function register_siteinfo_form() {

    $labels = array(
        'name' => _x('О нас', 'siteinfo'),
        'singular_name' => _x('О нас', 'siteinfo'),
        'add_new' => _x('Добавить', 'siteinfo'),
        'add_new_item' => _x('Добавить', 'siteinfo'),
        'edit_item' => _x('Редактировать', 'siteinfo'),
        'new_item' => _x('Новый', 'siteinfo'),
        'view_item' => _x('Просмотреть', 'siteinfo'),
        'search_items' => _x('Поиск', 'siteinfo'),
        'not_found' => _x('Не найдено', 'siteinfo'),
        'not_found_in_trash' => _x('Не найдено', 'siteinfo'),
        'parent_item_colon' => _x('Родительский:', 'siteinfo'),
        'menu_name' => _x('О нас', 'siteinfo'),
        'all_items' => _x('Все', 'siteinfo'),
        'show_in_menu' => 'post.php?post=%d',


    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => '',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-money',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => false,
        'rewrite' => true,
        'capability_type' => 'post',

    );

    register_post_type('siteinfo', $args);

    flush_rewrite_rules();
}
