<?php

/**
 * @author: Vladimir Martynyuk
 */
class JSON_API_General_Controller
{

    public function get_site_info()
    {

        global $json_api;
        $lang = $json_api->query->lang;
        if (!$lang) $lang = 'ru';

        $posts_list = get_posts(array(
            'post_type' => 'siteinfo',
            'lang' => $lang
        ));

        $info = array();

        for ($i = 0; $i < count($posts_list); $i++) {
            $l['description'] = $posts_list[$i]->post_content;
            $l['lang'] = $lang;

            array_push($info, $l);
            unset($l);

        }

        return $info;
    }
}