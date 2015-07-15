<?php
/*
Controller name: Service
Controller description: Data manipulation methods for service
*/
class JSON_API_Service_Controller
{

    public function posts_by_category()
    {
        global $json_api;

        $category = $json_api->query->cat;
        $lang = $json_api->query->lang;

        $args = array(
            'post_type' => 'services',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'services_category' => $category,
            'lang' => $lang
        );

        $query = new WP_Query($args);

        if ($query->posts)
            return array("posts" => $query->posts);
        else {
            return $json_api->error("No posts found at category");
        }

    }

    public function get_all_categories()
    {
        global $json_api;
        global $polylang;
        global $mycustom;

        $lang = $json_api->query->lang;
        if (!$lang) $lang = 'ru';

        $args = array(
            'type' => 'post',
            'hide_empty' => 0,
            'taxonomy' => 'services_category',
            'lang' => $lang

        );

        $categories = get_categories($args);

        $obj = array();

        foreach ($categories as $cat) {

            $c = array();

            $c['cat_id'] = $cat->cat_ID;
            $c['name'] = $cat->name;
            $c['slug'] = $cat->slug;
            $icon = get_tax_meta($cat->cat_ID,'image_field_id');
            $c['icons']['default'] = $icon['url'];
            $active_icon = get_tax_meta($cat->cat_ID,'active_image_field_id');
            $c['icons']['active'] = $active_icon['url'];
            $c['lang'] = $lang;

            $posts_list = get_posts(array(
                'services_category' => $cat->slug,
                'lang' => $lang,
                'post_type' => 'services'
            ));

            $posts = array();
            for ($i = 0; $i < count($posts_list); $i++) {
                $p['post_id'] = $polylang->get_translations('post', $posts_list[$i]->ID, 'en');
                $p['title'] = $posts_list[$i]->post_title;
                if ($lang == 'en') {
                    $p['slug'] = $posts_list[$i]->post_name;
                } else {
                    $ids = $polylang->get_translations('post', $posts_list[$i]->ID, 'en');
                    $id = $ids['en'];
                    $p['slug'] = get_post($id)->post_name;
                }

                $s = strip_tags($posts_list[$i]->post_content);
                $p['exerpt'] = mb_substr($s, 0, 500) . "...";
                $p['content'] = $posts_list[$i]->post_content;

                $gallery_img_ids = MyCustom::getInstance()->c_get_post_galleries($posts_list[$i], false);
                $technologies = array();
                foreach (explode(",", $gallery_img_ids['ids']) as $i_id) {
                    $img = wp_get_attachment_image_src($i_id, 'full');
                    $image['src'] = $img[0];
                    array_push($technologies, $image);
                }

                $p['technologies'] = $technologies;
                $p['lang'] = $lang;

                array_push($posts, $p);
                unset($p);
            }

            $c['posts'] = $posts;

            unset($posts);


            array_push($obj, $c);
            unset($c);
        }

        return $obj;
    }
}