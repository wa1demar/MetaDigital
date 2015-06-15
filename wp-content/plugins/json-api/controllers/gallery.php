<?php

/**
 * @author: Vladimir Martynyuk
 */
class JSON_API_Gallery_Controller {

    public function get_all_galleries() {
        global $json_api;
        $lang = $json_api->query->lang;
        if (!$lang) $lang = 'ru';

        $args = array(
            'type' => 'post',
            'hide_empty' => 0,
            'taxonomy' => 'gallery_category',
            'lang' => $lang

        );

        $categories = get_categories($args);

        $obj = array();

        foreach ($categories as $cat) {
            $c = array();

            $c['cat_id'] = $cat->cat_ID;
            $c['name'] = $cat->name;
            $c['description'] = $cat->description;
            $c['lang'] = $lang;

            $posts_list = get_posts(array(
                'gallery_category' => $cat->slug,
                'post_type' => 'gallery'
            ));

            $posts = array();
            for ($i = 0; $i < count($posts_list); $i++) {

                if (has_post_thumbnail($posts_list[$i]->ID)) {

                    $p['post_id'] = $posts_list[$i]->ID;
                    $p['title'] = $posts_list[$i]->post_title;
                    $p['img'] = wp_get_attachment_image_src(get_post_thumbnail_id($posts_list[$i]->ID), 'single-post-thumbnail')[0];

                    array_push($posts, $p);
                    unset($p);
                }
            }

            $c['images'] = $posts;

            unset($posts);


            array_push($obj, $c);
            unset($c);
        }

        return $obj;
    }
}