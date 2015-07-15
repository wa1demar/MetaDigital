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


add_action('add_meta_boxes', 'technologies_meta_box_add');
function technologies_meta_box_add()
{
    add_meta_box(
        'metaname_id',
        __( 'Технологии', 'metaname_textdomain'),
        'metaname_custom_box',
        'services',
        'normal'
    );
}

function metaname_custom_box()
{

    global $post;
    wp_nonce_field( plugin_basename( __FILE__ ), 'metaname_noncename' );
    $data = get_post_meta($post->ID, 'metaname_custom_box', true);

    wp_editor($data,"metaname_custom_box", array('textarea_rows'=>12, 'editor_class'=>'mytext_class'));

}

add_action('save_post', 'metaname_save');
function metaname_save($post_id) {
    global $post;

    // Verify
    if ( !wp_verify_nonce( $_POST['metaname_noncename'], plugin_basename(__FILE__) )) {
        return $post_id;
    }
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ))
            return $post_id;
    } else {
        if ( !current_user_can( 'edit_post', $post_id ))
            return $post_id;
    }

    $key = 'metaname_custom_box';
    $data = wpautop($_POST[$key]);

    // New, Update, and Delete
    if(get_post_meta($post_id, $key) == "")
        add_post_meta($post_id, $key, $data, true);
    elseif($data != get_post_meta($post_id, $key, true))
        update_post_meta($post_id, $key, $data);
    elseif($data == "")
        delete_post_meta($post_id, $key, get_post_meta($post_id, $key, true));
}


class MyCustom {

    private static $instance;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if (!MyCustom::$instance instanceof self) {
            MyCustom::$instance = new self();
        }
        return MyCustom::$instance;
    }

    public function c_get_post_galleries( $post, $html = true ) {
        if (!$post = get_post($post))
            return array();

        $content_arr = get_post_meta($post->ID, "metaname_custom_box");
        $content = $content_arr[0];

        if (!has_shortcode($content, 'gallery'))
            return array();

        $galleries = array();
        if (preg_match_all('/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $shortcode) {
                if ('gallery' === $shortcode[2]) {
                    $srcs = array();

                    $gallery = do_shortcode_tag($shortcode);
                    if ($html) {
                        $galleries[] = $gallery;
                    } else {
                        preg_match_all('#src=([\'"])(.+?)\1#is', $gallery, $src, PREG_SET_ORDER);
                        if (!empty($src)) {
                            foreach ($src as $s)
                                $srcs[] = $s[2];
                        }

                        $data = shortcode_parse_atts($shortcode[3]);
                        $data['src'] = array_values(array_unique($srcs));
                        $galleries[] = $data;
                    }
                }
            }
        }

        return $galleries[0];
    }
}

