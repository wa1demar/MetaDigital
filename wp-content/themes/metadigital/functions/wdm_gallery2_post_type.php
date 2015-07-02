<?php
/**
 * @author: Vladimir Martynyuk
 */
add_action('init', 'register_wdm_gallery2_form');
function register_wdm_gallery2_form()
{

    $labels = array(
        'name' => _x('Список проектов', 'wdm_gallery2'),
        'singular_name' => _x('Проекты', 'wdm_gallery2'),
        'add_new' => _x('Добавить проект', 'wdm_gallery2'),
        'add_new_item' => _x('Добавить новый проект', 'wdm_gallery2'),
        'edit_item' => _x('Редактировать проект', 'wdm_gallery2'),
        'new_item' => _x('Новый проект', 'wdm_gallery2'),
        'view_item' => _x('Просмотреть проект', 'wdm_gallery2'),
        'search_items' => _x('Поиск проектов', 'wdm_gallery2'),
        'not_found' => _x('Не найдено ни одного проекта', 'wdm_gallery2'),
        'not_found_in_trash' => _x('Не найдено ни одного проекта в корзине', 'wdm_gallery2'),
        'parent_item_colon' => _x('Родительский проект:', 'wdm_gallery2'),
        'menu_name' => _x('Портфолио', 'wdm_gallery2'),
        'all_items' => _x('Все проекты', 'wdm_gallery2'),
        'show_in_menu' => 'post.php?post=%d',


    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => '',
        'supports' => array('editor', 'revisions'),
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

    register_post_type('wdm_gallery2', $args);

    flush_rewrite_rules();
}


add_action('add_meta_boxes', 'desc_meta_box_add');
function desc_meta_box_add()
{
    add_meta_box('wdm_gallery2-desc', 'Описание проекта', 'desc_meta_box_name', 'wdm_gallery2', 'normal', 'high');
}

function desc_meta_box_name($post)
{

    wp_nonce_field(basename(__FILE__), 'desc_nonce');
    $color_stored_meta = get_post_meta($post->ID);
    ?>
    <div id="titlediv">
        <div id="titlewrap">
            <textarea placeholder="Краткое описание проекта" name="ru_desc" style="width: 100%; height: 200px"><?php if (isset ($color_stored_meta['ru_desc'])) echo $color_stored_meta['ru_desc'][0]; ?></textarea>
        </div>
        <div style="padding: 5px"></div>
        <div id="titlewrap">
            <textarea placeholder="Short project description" name="en_desc" style="width: 100%; height: 200px"><?php if (isset ($color_stored_meta['en_desc'])) echo $color_stored_meta['en_desc'][0]; ?></textarea>
        </div>

    </div>
<?php
}

add_action('save_post', 'desc_meta_save');
function desc_meta_save($post_id)
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

add_action('add_meta_boxes', 'runame_meta_box_add');
function runame_meta_box_add()
{
    add_meta_box('wdm_gallery2-runame', 'Заголовок', 'runame_meta_box_name', 'wdm_gallery2', 'advanced', 'high');
}

function runame_meta_box_name($post)
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

add_action('save_post', 'runame_meta_save');
function runame_meta_save($post_id)
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


add_action('edit_form_after_title', function () {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});

add_filter('manage_edit-wdm_gallery2_columns', 'add_new_wdm_gallery2_columns');
function add_new_wdm_gallery2_columns($gallery_columns)
{
    $new_columns['cb'] = '<input type="checkbox" />';

    $new_columns['wc_avatar'] = __('');
    $new_columns['wc_title'] = __('Заголовок');
    $new_columns['wc_count'] = __('Изображения');

//    $new_columns['date'] = _x('Дата', 'column name');

    return $new_columns;
}

add_action('manage_wdm_gallery2_posts_custom_column', 'manage_wdm_gallery2_columns', 10, 2);
function manage_wdm_gallery2_columns($column_name, $id)
{
    global $wpdb;
    switch ($column_name) {
        case 'id':
            echo $id;
            break;

        case 'wc_avatar':
            $gallery_img_ids_ = get_post_gallery($id, false);

            if ($gallery_img_ids_) {
                $gallery_img_ids = explode(",", $gallery_img_ids_['ids']);
                shuffle($gallery_img_ids);
                $thumb = wp_get_attachment_image_src($gallery_img_ids[0], 'medium');

                    echo "<img class='wdm_gallery2_image' src='$thumb[0]' />";

            }
            unset ($gallery_img_ids);
            break;
        case 'wc_title':
            echo "<table><tr><td>";
            $ru_title = get_post_meta($id, 'ru_title');
            $en_title = get_post_meta($id, 'en_title');
            $edit_link = get_edit_post_link( $id );
            $delete_link = get_delete_post_link( $id );
            $ru_desc = get_post_meta($id, 'ru_desc');
            $en_desc = get_post_meta($id, 'en_desc');
            echo "<strong><a class='row-title' title='Редактировать галерею' href='{$edit_link}'>{$ru_title[0]} / {$en_title[0]}</a></strong>";
            echo '<div class="row-actions">';
            echo "<span class='edit'><a title='Edit species' href='{$edit_link}'>Редактировать</a></span> | ";
            echo "<span class='trash'><a title='Edit species' href='{$delete_link}'>Удалить</a></span>";
            echo "</td></tr>";
            echo "<tr><td>";
            echo substr($ru_desc[0], 0, 251) . "... <br> " . substr($en_desc[0], 0, 150) . "...";
            echo "</td></tr></table>";

            break;

        case 'wc_count':

            echo count(get_post_gallery_images($id));
            break;

        default:
            break;
    } // end switch
}

function custom_admin_wdm_gallery2_css()
{
    echo '<style>

    #wc_avatar {
   		width: 310px;
	}

	#wc_count {
   		width: 100px;
	}

   	</style>';
}

add_action('admin_head', 'custom_admin_wdm_gallery2_css');
