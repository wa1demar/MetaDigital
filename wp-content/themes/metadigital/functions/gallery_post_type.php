<?php
/**
 * @author: Vladimir Martynyuk
 */

add_action('init', 'register_gallery_form');
function register_gallery_form() {

    $labels = array(
        'name' => _x('Список изображений', 'gallery'),
        'singular_name' => _x('Изображения', 'gallery'),
        'add_new' => _x('Добавить новое', 'gallery'),
        'add_new_item' => _x('Добавить новое изображение', 'gallery'),
        'edit_item' => _x('Редактировать изображение', 'gallery'),
        'new_item' => _x('Новое изображение', 'gallery'),
        'view_item' => _x('Просмотреть изображение', 'gallery'),
        'search_items' => _x('Поиск изображений', 'gallery'),
        'not_found' => _x('Не найдено ни одного изображения', 'gallery'),
        'not_found_in_trash' => _x('Не найдено ни одного изображения в корзине', 'gallery'),
        'parent_item_colon' => _x('Родительское изображение:', 'gallery'),
        'menu_name' => _x('Галерея', 'gallery'),
        'all_items' => _x('Все изображения', 'gallery'),
        'show_in_menu' => 'post.php?post=%d',


    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => '',
        'supports' => array('title', 'thumbnail', 'revisions'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-images-alt',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => false,
        'rewrite' => true,
        'capability_type' => 'post',

    );

    register_post_type('gallery', $args);

    flush_rewrite_rules();
}

add_action('init', 'create_gallery_taxonomies', 0);
function create_gallery_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('Проект'),
        'singular_name' => __('Проекты'),
        'search_items' => __('Поиск проектов'),
        'all_items' => __('Все проекты'),
        'parent_item' => __('Родительский проект'),
        'parent_item_colon' => __('Родительский проект'),
        'edit_item' => __('Редактировать проект'),
        'update_item' => __('Редактировать проект'),
        'add_new_item' => __('Добавить проект'),
        'new_item_name' => __('Название проекта'),
        'menu_name' => __('Проекты'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'gallery_category'),
        'can_export' => TRUE,
        'show_in_nav_menus' => false
    );


    register_taxonomy('gallery_category', 'gallery', $args);
}

add_filter('manage_edit-gallery_columns', 'add_new_gallery_columns');
function add_new_gallery_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';

    $new_columns['wc_avatar'] = __('Аватар');
    $new_columns['title'] = _x('Заголовок', 'column name');

    $new_columns['date'] = _x('Дата', 'column name');

    return $new_columns;
}

add_action('manage_gallery_posts_custom_column', 'manage_gallery_columns', 10, 2);
function manage_gallery_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
        case 'id':
            echo $id;
            break;

        case 'wc_avatar':
            $post_featured_image = get_the_post_thumbnail( $id, 'thumbnail' );;
            if ($post_featured_image) {

                echo $post_featured_image;
            }
            break;

        default:
            break;
    } // end switch
}

function custom_admin_gallery_css() {
    echo '<style>
   	#wc_avatar {
   		width: 150px;
	}

	#wc_content {
  		width: 60%;
	}

   	</style>';
}
add_action('admin_head', 'custom_admin_gallery_css');

