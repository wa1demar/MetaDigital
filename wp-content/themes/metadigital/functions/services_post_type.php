<?php
/**
 * @author: Vladimir Martynyuk
 */

add_action('init', 'register_services_form');
function register_services_form() {

    $labels = array(
        'name' => _x('Список сервисов', 'services'),
        'singular_name' => _x('Сервисы', 'services'),
        'add_new' => _x('Добавить новый', 'services'),
        'add_new_item' => _x('Добавить новый сервис', 'services'),
        'edit_item' => _x('Редактировать сервис', 'services'),
        'new_item' => _x('Новый сервис', 'services'),
        'view_item' => _x('Просмотреть сервис', 'services'),
        'search_items' => _x('Поиск сервисов', 'services'),
        'not_found' => _x('Не найдено ни одного сервиса', 'services'),
        'not_found_in_trash' => _x('Не найдено ни одного сервиса в корзине', 'services'),
        'parent_item_colon' => _x('Родительский сервис:', 'services'),
        'menu_name' => _x('Сервисы', 'services'),
        'all_items' => _x('Все сервисы', 'services'),
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
        'menu_icon' => 'dashicons-admin-tools',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => false,
        'rewrite' => true,
        'capability_type' => 'post',

    );

    register_post_type('services', $args);

    flush_rewrite_rules();
}

add_action('init', 'create_services_taxonomies', 0);
function create_services_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('Категории'),
        'singular_name' => __('Категории'),
        'search_items' => __('Поиск категорий'),
        'all_items' => __('Все категории'),
        'parent_item' => __('Родительская категория'),
        'parent_item_colon' => __('Родительская категория'),
        'edit_item' => __('Редактировать категорию'),
        'update_item' => __('Редактировать категорию'),
        'add_new_item' => __('Добавить категорию'),
        'new_item_name' => __('Название категории'),
        'menu_name' => __('Категории'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'services_category'),
        'can_export' => TRUE,
        'show_in_nav_menus' => false
    );


    register_taxonomy('services_category', 'services', $args);
}