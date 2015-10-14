<?php
/**
 * @author: Vladimir Martynyuk
 */

add_action('init', 'register_services2_form');
function register_services2_form() {

    $labels = array(
        'name' => _x('Список сервисов', 'services2'),
        'singular_name' => _x('Сервисы v2', 'services2'),
        'add_new' => _x('Добавить новый', 'services2'),
        'add_new_item' => _x('Добавить новый сервис', 'services2'),
        'edit_item' => _x('Редактировать сервис', 'services2'),
        'new_item' => _x('Новый сервис', 'services2'),
        'view_item' => _x('Просмотреть сервис', 'services2'),
        'search_items' => _x('Поиск сервисов', 'services2'),
        'not_found' => _x('Не найдено ни одного сервиса', 'services2'),
        'not_found_in_trash' => _x('Не найдено ни одного сервиса в корзине', 'services2'),
        'parent_item_colon' => _x('Родительский сервис:', 'services2'),
        'menu_name' => _x('Сервисы', 'services2'),
        'all_items' => _x('Все сервисы', 'services2'),
        'show_in_menu' => 'post.php?post=%d',


    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => '',
        'supports' => array('thumbnail', 'revisions'),
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

    register_post_type('services2', $args);

    flush_rewrite_rules();
}

add_action('add_meta_boxes', 'descs_meta_box_add');
function descs_meta_box_add()
{
    add_meta_box('services2-desc2', 'Описание проекта', 'desc2_meta_box_name', 'services2', 'normal', 'high');
}

function desc2_meta_box_name($post)
{

    wp_nonce_field(basename(__FILE__), 'desc_nonce');
    $color_stored_meta = get_post_meta($post->ID);
    ?>
    <div id="titlediv">
        <div id="titlewrap">
            <textarea placeholder="Краткое описание сервиса" name="ru_desc" style="width: 100%; height: 200px"><?php if (isset ($color_stored_meta['ru_desc'])) echo $color_stored_meta['ru_desc'][0]; ?></textarea>
        </div>
        <div style="padding: 5px"></div>
        <div id="titlewrap">
            <textarea placeholder="Short service description" name="en_desc" style="width: 100%; height: 200px"><?php if (isset ($color_stored_meta['en_desc'])) echo $color_stored_meta['en_desc'][0]; ?></textarea>
        </div>

    </div>
    <?php
}

add_action('save_post', 'desc2_meta_save');
function desc2_meta_save($post_id)
{

    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['desc_nonce']) && wp_verify_nonce($_POST['desc_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if (isset($_POST['ru_desc'])) {
        update_post_meta($post_id, 'ru_desc', sanitize_text_field($_POST['ru_desc']));
    }
    if (isset($_POST['en_desc'])) {
        update_post_meta($post_id, 'en_desc', sanitize_text_field($_POST['en_desc']));
    }

}


add_action('add_meta_boxes', 'runame2_meta_box_add');
function runame2_meta_box_add()
{
    add_meta_box('services2-runame2', 'Заголовок', 'runame2_meta_box_name', 'services2', 'advanced', 'high');
}

function runame2_meta_box_name($post)
{

    wp_nonce_field(basename(__FILE__), 'runame_nonce');
    $color_stored_meta = get_post_meta($post->ID);
    ?>
    <div id="titlediv">
        <div id="titlewrap">
            <input placeholder="Введите заголовок" type="text" name="ru_title" size="30"
                   style="padding: 3px 8px; font-size: 1.7em; line-height: 100%; height: 1.7em;  width: 100%;  outline: 0;  margin: 0 0 3px;  background-color: #fff;"
                   value="<?php if (isset ($color_stored_meta['ru_title'])) echo $color_stored_meta['ru_title'][0]; ?>"
                   id="ru_title" spellcheck="true" autocomplete="off">
        </div>
        <div style="padding: 5px"></div>
        <div id="titlewrap">
            <input placeholder="Put title" type="text" name="en_title" size="30"
                   style="padding: 3px 8px; font-size: 1.7em; line-height: 100%; height: 1.7em;  width: 100%;  outline: 0;  margin: 0 0 3px;  background-color: #fff;"
                   value="<?php if (isset ($color_stored_meta['en_title'])) echo $color_stored_meta['en_title'][0]; ?>"
                   id="en_title" spellcheck="true" autocomplete="off">
        </div>
    </div>
    <?php
}

add_action('save_post', 'runame2_meta_save');
function runame2_meta_save($post_id)
{

    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['runame_nonce']) && wp_verify_nonce($_POST['runame_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if (isset($_POST['ru_title'])) {
        update_post_meta($post_id, 'ru_title', sanitize_text_field($_POST['ru_title']));
    }
    if (isset($_POST['en_title'])) {
        update_post_meta($post_id, 'en_title', sanitize_text_field($_POST['en_title']));
    }

}

add_filter('manage_edit-services2_columns', 'add_new_services2_columns');
function add_new_services2_columns($gallery_columns)
{
    $new_columns['cb'] = '<input type="checkbox" />';

    $new_columns['s2_icon'] = __('', 'column_icon');
    $new_columns['s2_title'] = __('Заголовок', 'column_title');

//    $new_columns['date'] = _x('Дата', 'column name');

    return $new_columns;
}

add_action('manage_services2_posts_custom_column', 'manage_services2_columns', 10, 2);
function manage_services2_columns($column_name, $id)
{
    global $wpdb;
    switch ($column_name) {

        case 's2_title':
            echo "<table><tr><td>";
            $ru_title = get_post_meta($id, 'ru_title');
            $en_title = get_post_meta($id, 'en_title');
            $edit_link = get_edit_post_link( $id );
            $delete_link = get_delete_post_link( $id );
            echo "<strong><a class='row-title' title='Редактировать' href='{$edit_link}'>{$ru_title[0]} / {$en_title[0]}</a></strong>";
            echo '<div class="row-actions">';
            echo "<span class='edit'><a title='Edit species' href='{$edit_link}'>Редактировать</a></span> | ";
            echo "<span class='trash'><a title='Edit species' href='{$delete_link}'>Удалить</a></span>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";

            break;
        case 's2_icon':
            echo get_the_post_thumbnail($id);
            break;
        default:
            break;
    } // end switch
}

function custom_admin_services2_css()
{
    echo '<style>

    .column-s2_icon {
   		width: 55px;
	}

   	</style>';
}

add_action('admin_head', 'custom_admin_services2_css');

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

