<?php

/*
Controller name: Gallery
Controller description: Data manipulation methods for gallery
*/

class JSON_API_Gallery_Controller
{

    public function get_all_galleries()
    {
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

                    $p['image_id'] = $posts_list[$i]->ID;
                    $p['title'] = $posts_list[$i]->post_title;
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($posts_list[$i]->ID), 'medium');
                    $p['thumbnail'] = $thumb[0];
                    $p['img'] = wp_get_attachment_url(get_post_thumbnail_id($posts_list[$i]->ID));
//                    $p['thumbnail'] = "test";

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

    public function get_all_galleries_localized()
    {
        $posts_list = get_posts(array(
            'post_type' => 'wdm_gallery2',
            'posts_per_page' => -1,
        ));

        $posts = array();
        for ($i = 0; $i < count($posts_list); $i++) {
            $id = $posts_list[$i]->ID;
            $post = null;
            $post['id'] = $id;
            $post_title = get_post_meta($id, 'ru_title');
            $post['ru']['title'] = $post_title[0];
            $post_desc = get_post_meta($id, 'ru_desc');
            $post['ru']['description'] = $post_desc[0];
            $post_title = get_post_meta($id, 'en_title');
            $post['en']['title'] = $post_title[0];
            $post_desc = get_post_meta($id, 'en_desc');
            $post['en']['description'] = $post_desc[0];

            $images = array();

            $gallery_img_ids = get_post_gallery($id, false);

            foreach (explode(",", $gallery_img_ids['ids']) as $i_id) {
                $image = null;
                $thumb = wp_get_attachment_image_src($i_id, 'medium');
                $image['thumbnail'] = $thumb[0];
                $img = wp_get_attachment_image_src($i_id, 'full');
                $image['full'] = $img[0];

                array_push($images, $image);
            }

            $post['images'] = $images;

            array_push($posts, $post);
        }


        return $posts;
    }
}