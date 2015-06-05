<?php

/**
 * @author: Vladimir Martynyuk
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
            return  $json_api->error("No posts found at category");
        }

    }
}